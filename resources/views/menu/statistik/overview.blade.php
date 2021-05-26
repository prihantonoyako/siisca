@extends('layout.menu')

@section('head')
<!-- compressed version
    <script src="{{ asset('jQuery/jquery-3.6.0.min.js') }}"></script>
    uncompressed version
    <script src="{{ asset('jQuery/jquery-3.6.0.js') }}"></script>
    -->
<link rel="stylesheet" type="text/css" href="{{ asset('jQuery/UI/jquery-ui.min.css') }}">
<script src="{{ asset('jQuery/UI/jquery-ui.min.js') }}"></script>
@endsection

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 text-uppercase">{{ Route::currentRouteName() }}</h1>
    <div style="display:none">
        <div class="alert alert-success" id="success-alert">
            <button type="button" classs="close" data-dismiss="alert">x</button>
            <strong>Success! </strong> Data have been displayed
        </div>
    </div>
    <p class="mb-4">
    <form action=" {{ route('kelembapan') }}" method="GET">
        <label for="provinsi">Provinsi</label>
        <select id="provinsi" name="provinsi">
            @foreach($provinsi as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <label for="from">From</label>
        <input type="text" id="from" name="from">
        <label for="to">to</label>
        <input type="text" id="to" name="to">
        <button type="submit" class="btn btn-primary">Display</button>
    </form>
    </p>
    <br>
    <pre id="varJson"></pre>

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container" style="max-width: 800px; min-width: 380px; height: 310px; margin: 0 auto">
                            <div style="margin-top: 100px; text-align: center" id="loading">
                                <i class="fa fa-spinner fa-spin"></i> Loading data from external source
                            </div>
                        </div>
                        <p class="highcharts-description">
                            Chart showing meteorological data. This is an advanced example of using
                            Highcharts to load data from an external API, and displaying the data
                            using several custom visuals. The chart loads the data from a weather
                            forecast website. After the data is parsed, the chart is generated, then
                            the icons are added. In the end, the wind arrows are displayed.
                        </p>
                    </figure>
                    <hr>
                    Source data: <a href="https://data.bmkg.go.id/" class="card-link">Data Terbuka BMKG</a>
                </div>
            </div>
        </div>
    </div>


    @endsection

    @section('footer-script')
    <script>
        $(function() {
            var dateFormat = "mm/dd/yy",
                from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on("change", function() {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on("change", function() {
                    from.datepicker("option", "maxDate", getDate(this));
                });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });

        // var profile = {!! json_encode($profile) !!};
        // document.getElementById("varJson").textContent = JSON.stringify(profile, undefined, 2);
    </script>
    @endsection