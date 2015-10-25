<div id="map"></div>

@section('styles')
@parent
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
<link rel="stylesheet" href="{{ asset('vendor/leaflet-minimap/Control.MiniMap.min.css') }}" />
<style type="text/css">
	#map { height: 480px; }

	.map-preview {
		padding:0 !important;
	}
	.icon-sm, .icon-lg  {
		text-align: center;
		color: #dd1717;
	}
	.icon-sm .fa {
		font-size: 10px;
	}
	.icon-lg .fa {
		font-size: 46px;
	}

	.leaflet-touch .leaflet-control-zoom-in,
	.leaflet-touch .leaflet-control-zoom-out,
	.leaflet-touch .leaflet-control-recenter
	{
		font-size: 19px;
	}

</style>
@endsection

@section('scripts')
@parent
<script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
<script src="{{ asset('vendor/leaflet-minimap/Control.MiniMap.min.js') }}"></script>
<script>

	var map = L.map('map', {
		zoomControl: false
	});

	var zoomControl = L.control.zoom({
		position: 'topleft',
		zoomInText: '<i class="fa fa-search-plus"></i>',
		zoomOutText: '<i class="fa fa-search-minus"></i>',
	}).addTo(map);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: '<a href="https://www.mapbox.com/about/maps/">&copy; Mapbox &copy; OpenStreetMap</a>',
		maxZoom: 18,
		minZoom: 2,
		id: 'kitbs.nppn43oj',
		accessToken: 'pk.eyJ1Ijoia2l0YnMiLCJhIjoiRUJHbUxKYyJ9.NscG42VOWgstyhpBoqZpOw'
	}).addTo(map);

	var smIcon = new L.divIcon({
		html: '<i class="fa fa-circle"></i>',
		className: 'icon-sm',
	iconSize: new L.point([10, 10]),
		iconAnchor: new L.point([5, 5])
	});

	var lgIcon = new L.divIcon({
		html: '<i class="fa fa-map-marker"></i>',
		className: 'icon-lg',
		iconSize: new L.point([27, 46]),
		iconAnchor: new L.point([13, 46])
	});

	var layer = L.geoJson(null, {
		style: {
			color: "#dd1717"
		},
		pointToLayer: function (feature, latLng) {
			return L.marker(latLng, {
				icon: lgIcon
			});
		}
	}).addTo(map);

	var miniLayer = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: '<a href="https://www.mapbox.com/about/maps/">&copy; Mapbox &copy; OpenStreetMap</a>',
		maxZoom: 18,
		id: 'kitbs.nppn43oj',
		accessToken: 'pk.eyJ1Ijoia2l0YnMiLCJhIjoiRUJHbUxKYyJ9.NscG42VOWgstyhpBoqZpOw'
	});

	layer.addData({!! json_encode($geometry->toFeature()) !!});

	var centroid = layer.getBounds().getCenter();

	map.fitBounds(layer.getBounds(), {
		maxZoom: 10
	});

	centroid = new L.marker(centroid, {icon: smIcon});

	var miniLayer = new L.LayerGroup([miniLayer, centroid]);

	var miniMap = new L.Control.MiniMap(miniLayer, {
		zoomLevelFixed: 2,
		width: 250
	}).addTo(map);

	var reCenter = L.control({ position: 'topleft'});

	reCenter.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'leaflet-control leaflet-bar')
		this._div.innerHTML = '<a class="leaflet-control-recenter" href="#" title="Center"><i class="fa fa-crosshairs"></i></a>';

		L.DomEvent
		.addListener(this._div, 'click', L.DomEvent.stopPropagation)
		.addListener(this._div, 'click', L.DomEvent.preventDefault)
		.addListener(this._div, 'click', function () {
			map.fitBounds(layer.getBounds(), {
				maxZoom: 10
			});
		});
		return this._div;
	};



	reCenter.addTo(map);



</script>
@endsection