@extends($ctemplates.'.main')
@section('title')
<h1>
	<span>Beranda</span>
	<i class="icon-arrow-back"></i>
	<small>v. 1.0.0</small>
</h1>
@endsection
@section('breadcrumb')

	<li><a href="#"><i class="fa fa-dashboard"></i> Utama</a></li>
	<li class="active">Beranda</li>

@endsection

@section('content-admin')

<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		
		<div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Costumer</span>
				<span class="info-box-number">{{$totalcustomer}}<small></small></span>
			</div>
		</div>
	
	
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Driver</span>
					<span class="info-box-number">{{$totaldriver}}<small></small></span>
				</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pemesanan</span>
					<span class="info-box-number">{{$totalpemesanan}}<small></small></span>
				</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-bar-chart"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Pengunjung</span>
				<span class="info-box-number">{{$totalpengunjung}}<small></small></span>
			</div>
	</div>
	</div>
</div>


<div class="row">	
	<section class="col-lg-7 connectedSortable">
		<div class="box">
			<div class="box-header"></div>
			<div class="box-body">
				<div id="map" class="map"></div>
			</div>
			
		</div>
	</section>
	<section class="col-lg-5 connectedSortable">			
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Driver</h3>
			</div>
			<div class="box-body">
					<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Tersedia</a></li>
							<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Dalam Perjalanan</a></li>
							<li><a href="#tab_3" data-toggle="tab">Offline</a></li>
					</ul>
				<span>
						<input name="finddriver" class="form-control" type="text" id="finddriver" placeholder="Search Driver" onkeyup="setFilter('keyword', this.value);">
				</span>
				<div style="float: left;
				height: 320px;
				margin: 0;
				overflow-y: scroll;
				padding: 0;
				width: 100%;">
				
				<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
								<h3 class="text-center">Tersedia</h3>
								@foreach ($driver as $item)
								<div class="box">
									<img class="img-circle img-sm" src="{{ $item->fotoPath }}" alt="{{ $item->name }}">
									{{$item->name}}
								</div>      
								@endforeach
						</div>
						
						<div class="tab-pane" id="tab_2">
							
						</div>
						<div class="tab-pane" id="tab_3">
							
						</div>
					</div>
					<!-- /.tab-content -->
			</div>
                
              
			</div>
		</div>
	</section>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-body">
				<div id="driver_active"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box">
			<div class="box-body">
					<div id="ride"></div>
			</div>
		</div>
		
	</div>
</div>

<div class="row">
	<div class="col-md-12">
			<div class="box">

			
			<table class="table table-bordered">
					<thead>
						<tr>
							<td>No Transaksi</td>
							<td>Type Transaksi</td>
							<td>Di pesan</td>
							<td>Tanggal</td>
							<td>Status</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
							@foreach($listtransaksi as $k => $v)
							<tr>
								<td>{{ $v->no_transaksi}}</td>
								<td>{{ $v->trip_type}}</td>
								<td>{{ $v->trip_bookby}}</td>
								<td>{{ $v->trip_date}}</td>
								<td>{{ $v->trip_status}}</td>
								<td></td>
							</tr>
							@endforeach
					</tbody>
			</table>
		</div>
	</div>
	
</div>


@endsection
@section('style-head')
	@parent
	<link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css">
	<link rel="stylesheet" href="https://unpkg.com/ol-popup@4.0.0/src/ol-popup.css" />	
	<link href="{{ asset('/plugins/dx/css/dx.common.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/plugins/dx/css/dx.greenmist.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/plugins/dx/css/dx.light.css')}}" rel="stylesheet" type="text/css" />
	<style>
	
		.map {
        height: 400px;
        width: 100%;
      }
    
	</style>

@endsection
@section('script-end')
	@parent
	<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
	<script src="https://unpkg.com/ol-popup@4.0.0"></script>
	<script src="{{ asset('/plugins/dx/js/jszip.min.js')}}"></script>
	<script src="{{ asset('/plugins/dx/js/dx.all.js')}}"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script>
		let worker = null;
		let vectorSource =null;
		let vectorLayer = null;
		$(function () {
			worker = new Worker(`${Laravel.serverUrl}/js/webworker.js`);
			worker.addEventListener('error', function(a) {
					// console.log(a);
					console.error('Error: Line ' + a.lineno + ' in ' + a.filename + ': ' + a.message);
			}, false);

			worker.addEventListener('message', function(a) {
				if (a.data.cmd === 'resLastPosition') { resLastPosition(a.data.val); }
			});
			vectorSource = new ol.source.Vector();
      vectorLayer = new ol.layer.Vector({
            source: vectorSource,
            id:'layer_vector'
      });
			var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
					}),
					vectorLayer
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([98.669689, 3.590003]),
          zoom: 12
        })
			});

			var popup = new Popup();
			map.addOverlay(popup);

			map.on('click', function(event) {
				var coordinate = event.coordinate;
				var pixel = map.getPixelFromCoordinate(coordinate);
				map.forEachFeatureAtPixel(pixel, function(f) {
					var geometry = f.getGeometry();
					var coord = geometry.getCoordinates();
					console.log(f);
					content = `<br>${f.get('name')}`;
          // el.innerHTML += feature.get('name') + '<br>';
					popup.show(coord, content);
        });
				
				
				
			});
			function resLastPosition(a) {
			
					a.map((v,i)=>{
						var transform = ol.proj.getTransform('EPSG:4326', 'EPSG:3857');
						var coordinate = transform([parseFloat(v.longitude), parseFloat(v.latitude)]);
						var feature = new ol.Feature({
							geometry: new ol.geom.Point(coordinate),
							name: v.name,
						});
						var iconStyle = new ol.style.Style({
								image: new ol.style.Icon(({
										anchor: [0.2, 32],
										
										scale: 0.3,
										anchorXUnits: 'fraction',
										anchorYUnits: 'pixels',
										src: `${Laravel.serverUrl}/images/carMarker.png`
								}))
						});
						feature.setStyle(iconStyle);
						vectorSource.addFeature(feature);
					});
				
			}
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

			$.ajax({
				type: 'GET',
				url: `${Laravel.serverUrl}/api/jalan-data`,
				dataType: "json",
				success: function (data) {
					$("#dataGrid").dxDataGrid({
						dataSource: data.data,
						keyExpr: "id",
						columns: ["no_ruas", "nama_ruas", 'tahun', 'pembiayaan']
					});

				}
			});
			worker.postMessage({ cmd: 'reqLastPosition', val: `${Laravel.serverUrl}/api/user/location`});
			drawPie('driver_active',null);
			drawPie('ride',null);
			
		});
			
	</script>
@endsection