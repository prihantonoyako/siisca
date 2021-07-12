@extends('layout.statistik')

@section('head')
<link href="{{ asset('menu/statistik/css/meteogram.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('datetimepicker-master/build/jquery.datetimepicker.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <label for="provinsi">Provinsi</label>
                            <select id="provinsi" name="provinsi" class="form-control">
                                @foreach($provinsi as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 my-1">
                            <label for="from">From</label>
                            <input type="text" id="from" name="from" class="form-control">
                        </div>
                        <div class="col-sm-3 my-1">
                            <label for="to">to</label>
                            <input type="text" id="to" name="to" class="form-control">
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary show_data">Display</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">STATISTIK</h6>
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container" style="max-width: 1080px; min-width: 380px; height: 310px; margin: 0 auto">
                            <div style="margin-top: 100px; text-align: center" id="loading">
                                <i class="fa fa-spinner fa-spin"></i> Please wait a moment! Something incredible might happen!
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
</div>
@endsection

@section('footer-script')
<script src="{{ asset('menu/statistik/meteogram-demo.js') }}"></script>
<script src="{{ asset('jQuery/UI/jquery-ui.min.js') }}"></script>
<script src="{{ asset('datetimepicker-master/build/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('menu/statistik/overview.js') }}"></script>
<script>
$(document).ready(function () {
    $(".show_data").click(function () {
        var url = "{{ url('statistik/overview/show') }}";
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}',
                areaId: $('#provinsi').val(),
                fromDate: $('#from').val(),
                toDate: $('#to').val(),
            },
            dataType: "json",
            success: function (response) {
                swal({
                    title: "Success",
                    text: "Data has been fetched",
                    icon: "success",
                    timer: 1000
                });
                window.meteogram = new Meteogram(response, 'container');
            },
            error: function (jqXHR,textStatus,errorThrown) {
                swal({
                    title: "Error",
                    text: jqXHR.responseText,
                    icon: "error",
                    timer: 5000
                });
            }
        });
    });
});
</script>
@endsection