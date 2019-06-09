@extends('templates::adminlte.main')
@section('content-admin')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h4 class="header-title">Driver</h4>
                </div>
                <div class="box-body">
                    <div id="driver_active"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h4 class="header-title">Rides</h4>
                </div>
                <div class="box-body">
                    <div id="ride"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Register user</h3>
                </div>
                <div class="panel-body">
                    <div id="registeruser"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Rider </h3>
                </div>
                <div class="panel-body">
                    <div id="ridelast3month"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-end')
@parent
<script src="https://code.highcharts.com/highcharts.js"></script>
<script text="text/javascript">
function drawPie(container,title,data){
    Highcharts.chart(container, {
        chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
        },
        title: { text: title },
        tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
        plotOptions: {
                pie: {allowPointSelect: true,cursor: 'pointer',dataLabels: { enabled: false },showInLegend: true }
        },
        credits:{ enabled:false},
        legend:{ enabled:false},
        series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                        name: 'Chrome',
                        y: 61.41,
                        sliced: true,
                        selected: true
                }, {
                        name: 'Internet Explorer',
                        y: 11.84
                }, {
                        name: 'Firefox',
                        y: 10.85
                }, {
                        name: 'Edge',
                        y: 4.67
                }, {
                        name: 'Safari',
                        y: 4.18
                }, {
                        name: 'Other',
                        y: 7.05
                }]
        }]
    });
}
function drawColumn(container,title,data) {
    Highcharts.chart(container, {
        chart: { type: 'column' },
        title: { text: title },
        
        xAxis: {
            type: 'category',
            labels: { rotation: -45, style: { fontSize: '13px', fontFamily: 'Verdana, sans-serif'} }
        },
        yAxis: {
            min: 0, title: { text: 'Population (millions)' }
        },
        legend: { enabled: false
        },
        tooltip: { pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'},
        series: [{
            name: 'Population',
            data: [
                ['Shanghai', 24.2],
                ['Beijing', 20.8],
                ['Karachi', 14.9],
                ['Shenzhen', 13.7],
                ['Guangzhou', 13.1],
                ['Istanbul', 12.7],
                ['Mumbai', 12.4],
                ['Moscow', 12.2],
                ['São Paulo', 12.0],
                ['Delhi', 11.7],
                ['Kinshasa', 11.5],
                ['Tianjin', 11.2],
                ['Lahore', 11.1],
                ['Jakarta', 10.6],
                ['Dongguan', 10.6],
                ['Lagos', 10.6],
                ['Bengaluru', 10.3],
                ['Seoul', 9.8],
                ['Foshan', 9.3],
                ['Tokyo', 9.3]
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
}
drawPie('driver_active',null);
drawPie('ride',null);
drawColumn('registeruser')
drawColumn('ridelast3month')
</script>
@endsection