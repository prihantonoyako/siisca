function Meteogram(json, container) {
    this.cuaca = [];
    this.angin = [];
    this.suhu = [];
    this.kelembapan = [];
    this.json = json;
    this.container = container;
    this.mulai;
    this.parseJsonData();
}

Meteogram.prototype.suhuTooltip = function (data) {
    var i = data.length;
    while (i--) {
        data[i].value = value = data[i].y;
    }
};

Meteogram.prototype.drawWeatherSymbols = function (chart) {
    var meteogram = this;

    chart.series[0].data.forEach((point, i) => {
        chart.renderer
                .image(
                    meteogram.cuaca[i],
                    point.plotX + chart.plotLeft - 8,//8
                    point.plotY + chart.plotTop - 40, //30
                    30,
                    30
                )
                .attr({
                    zIndex: 5 //5
                })
                .add();
    
    });
};

Meteogram.prototype.getTitle = function () {
    return "Statistik Wilayah " + this.json.wilayah;
};

/**
 * Build and return the Highcharts options structure
 */
Meteogram.prototype.getChartOptions = function () {
    var meteogram = this;

    return {
        chart: {
            renderTo: this.container,
            marginBottom: 70,
            marginRight: 40,
            marginTop: 50,
            plotBorderWidth: 1,
            height: 310,
            alignTicks: false,
            scrollablePlotArea: {
                minWidth: 720
            }
        },

        title: {
            text: this.getTitle(),
            align: 'left',
            style: {
                whiteSpace: 'nowrap',
                textOverflow: 'ellipsis'
            }
        },

        credits: {
            text: 'Forecast from <a href="https://data.bmkg.go.id">BMKG</a>',
            href: 'https://data.bmkg.go.id/',
            position: {
                x: -40
            }
        },

        tooltip: {
            shared: true,
            useHTML: true,
            headerFormat:
                // '<small>{point.x:%H}</small><br>' +
                '<b>{point.point.symbolName}</b><br>'

        },

        xAxis: [{ // Bottom X axis
            type: 'datetime',
            tickInterval: 6*36e5,
            minorTickInterval: 36e5, // one hour
            // tickLength: 4,
            // gridLineWidth: 4,
            gridLineColor: 'rgba(128, 128, 128, 0.1)',
            // startOnTick: false,
            // endOnTick: false,
            // minPadding: 0,
            // maxPadding: 0,
            // offset: 30,
            // showLastLabel: true,
            labels: {
                format: '{value:%H:%M}'
                
            },
            crosshair: true,
        }, { // Top X axis
            linkedTo: 0,
            type: 'datetime',
            tickInterval: 24*36e5,
            labels: {
                format: '{value:<span style="font-size: 12px; font-weight: bold">%a</span> %b %e}',
                align: 'left',
                x: 3,
                y: -5
            },
            opposite: true,
            tickLength: 20,
            gridLineWidth: 1
        }],

        yAxis: [{ // temperature axis
            title: {
                text: null
            },
            labels: {
                format: '{value}°',
                style: {
                    fontSize: '10px'
                },
                x: -3
            },
            plotLines: [{ // zero plane
                value: 0,
                color: '#BBBBBB',
                width: 1,
                zIndex: 2
            }],
            maxPadding: 0.3,
            minRange: 8,
            tickInterval: 1,
            gridLineColor: 'rgba(128, 128, 128, 0.1)',
        },
         { // Kelembapan axis
            allowDecimals: false,
            title: { // Title on top of axis
                text: '%RH',
                offset: 0, //0
                align: 'high',
                rotation: 0,
                style: {
                    fontSize: '10px',
                    color: Highcharts.getOptions().colors[2]
                },
                textAlign: 'left',
                x: 3 //3
            },
            labels: {
                style: {
                    fontSize: '8px',
                    color: Highcharts.getOptions().colors[2]
                },
                y: 2,
                x: 3
            },
            gridLineWidth: 0,
            opposite: true,
            showLastLabel: false
        }],

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                pointPlacement: 'on'
            }
        },


        series: [{
            name: 'suhu',
            data: this.suhu,
            type: 'spline',
            marker: {
                enabled: false,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{point.color}">\u25CF</span> ' +
                    '{series.name}: <b>{point.value}°C</b><br/>'
            },
            zIndex: 1, //1
            color: '#FF3333',
            negativeColor: '#48AFE8'
        }, {
            name: 'kelembapan',
            color: Highcharts.getOptions().colors[2],
            data: this.kelembapan,
            marker: {
                enabled: false
            },
            shadow: false,
            tooltip: {
                valueSuffix: ' %RH'
            },
            dashStyle: 'shortdot',
            yAxis: 1
        }, {
            name: 'angin',
            type: 'windbarb',
            id: 'anginbar',
            color: Highcharts.getOptions().colors[1],
            lineWidth: 1.5,
            data: this.angin,
            vectorLength: 18,
            yOffset: -15,
            tooltip: {
                valueSuffix: ' mph'
            }
        }]
    };
};

/**
 * Post-process the chart from the callback function, the second argument to Highcharts.Chart.
 */
Meteogram.prototype.onChartLoad = function (chart) {

    this.drawWeatherSymbols(chart);
    // this.drawBlocksForWindArrows(chart);
};

/**
 * Create the chart. This function is called async when the data file is loaded and parsed.
 */
Meteogram.prototype.createChart = function () {
    var meteogram = this;
    this.chart = new Highcharts.Chart(this.getChartOptions(), function (chart) {
        meteogram.onChartLoad(chart);
    });
};

Meteogram.prototype.error = function () {
    document.getElementById('loading').innerHTML = '<i class="fa fa-frown-o"></i> Failed loading data, please try again later';
};

Meteogram.prototype.parseJsonData = function () {

    let meteogram = this,
        json = this.json,
        pointStart,
        forecast = json && json.hasOwnProperty('data');

    if (!forecast) {
        return this.error();
    }

    json.data.forEach((time, i) => {
        let date = new Date(Date.parse(time.datetime));
        if(i==0){
            meteogram.mulai = date;
        }
        //plus 7 dari data asli
        date.setHours(date.getHours()+7);
        meteogram.cuaca.push(
            time.cuacaKode
        );
        meteogram.suhu.push({
            x: date,
            y: parseInt(time.suhuCelcius),
            symbolName: time.cuacaNama
        });
       
        meteogram.angin.push({
            x: date,
            value: parseFloat(time.kecepatanAngin),
            direction: parseFloat(time.arahAngin)
        });
        
        meteogram.kelembapan.push({
            x: date,
            y: parseInt(time.kelembapan)
        });
    });
    // Smooth the line
    this.suhuTooltip(this.suhu);
    // Create the chart when the data is loaded
    this.createChart();
};
// End of the Meteogram protype