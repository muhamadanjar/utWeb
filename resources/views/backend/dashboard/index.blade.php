@extends($ctemplates.'.main')
@section('title')
<h5>
	<i class="icon-arrow-back"></i>
	<span>Dashboard</span>
	<small></small>
</h5>
@endsection
@section('breadcrumb')

@endsection

@section('content-admin')

<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>150</h3>

				<p>Pesanan</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="#" class="small-box-footer">Info Selangkapnya <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>53<sup style="font-size: 20px">%</sup></h3>

				<p>Bounce Rate</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">Info Selangkapnya <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>44</h3>

				<p>Pendaftaran User</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">Info selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>65</h3>

				<p>Pengunjung</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">Info Selangkapnya <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>


<div class="row">	
	<section class="col-lg-7 connectedSortable">
		<div id="map" class="map">

		</div>
	
	</section>
	<section class="col-lg-5 connectedSortable">

	</section>
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
	
	<!-- <script src="{{ asset('assets/limitless/js/demo_pages/charts/echarts/pies_donuts.js')}}"></script> -->


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
			
			
			
			$.ajax({
				type: 'GET',
				url: `${Laravel.serverUrl}/api/driver/jumlah`,
				dataType: "json",
				success: function (data) {
					$("#pie").dxPieChart({
						size: {
							width: 500
						},
						palette: "Soft Pastel",
						dataSource: data,
						series: [{
							argumentField: "nama",
							valueField: "total",
							label: {
								visible: true,
								// format:'percent'
							}
						}],
						title: "Data Jumlah Rambu",
						"export": {
							enabled: true
						},
						onPointClick: function (e) {
							var point = e.target;

							toggleVisibility(point);
						},
						onLegendClick: function (e) {
							var arg = e.target;

							toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
						}
					});
				}
			});

			function toggleVisibility(item) {
				if (item.isVisible()) {
					item.hide();
				} else {
					item.show();
				}
			}

			function resLastPosition(a) {
			
					a.map((v,i)=>{
						var transform = ol.proj.getTransform('EPSG:4326', 'EPSG:3857');
						var coordinate = transform([parseFloat(v.longitude), parseFloat(v.latitude)]);
						var feature = new ol.Feature({
							geometry: new ol.geom.Point(coordinate),
							name: v.user_id,
						});
						// var iconStyle = new ol.style.Style({
						// 		image: new ol.style.Icon(({
						// 				anchor: [0.2, 32],
						// 				anchorXUnits: 'fraction',
						// 				anchorYUnits: 'pixels',
						// 				src: `${Laravel.serverUrl}/images/pins/${icon}`
						// 		}))
						// });
						// feature.setStyle(iconStyle);
						vectorSource.addFeature(feature);
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
		});
			
	</script>
@endsection