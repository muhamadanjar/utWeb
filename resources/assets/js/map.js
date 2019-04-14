import Map from 'ol/Map.js';
import View from 'ol/View.js';
import Overlay from 'ol/Overlay.js';
import Feature from 'ol/Feature.js';
import Geolocation from 'ol/Geolocation.js';
import {
    fromLonLat,
    toLonLat
} from 'ol/proj.js';
import {
    OSM,
    TileDebug,
    Vector as VectorSource
} from 'ol/source.js';
import TileJSON from 'ol/source/TileJSON.js';
import {
    Tile as TileLayer,
    Vector as VectorLayer
} from 'ol/layer.js';
import {
    Circle as CircleStyle,
    Fill,
    Stroke,
    Style
} from 'ol/style.js';
import {
    toStringHDMS
} from 'ol/coordinate.js';


var container_popup = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');
closer.onclick = function () {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
};
var overlay = new Overlay({
    element: container_popup,
    autoPan: true,
    autoPanAnimation: {
        duration: 250
    }
});

function el(id) {
    return document.getElementById(id);
}


var osmSource = new OSM();
let view = new View({
    center: fromLonLat([106.798036, -6.6033115]),
    zoom: 13
})
var map = new Map({
    layers: [
        new TileLayer({
            source: osmSource
        }),
        new TileLayer({
            source: new TileDebug({
                projection: 'EPSG:3857',
                tileGrid: osmSource.getTileGrid()
            })
        })
    ],
    overlays: [overlay],
    target: 'map',
    view: view
});

map.on('singleclick', function (evt) {
    var coordinate = evt.coordinate;
    var hdms = toStringHDMS(toLonLat(coordinate));

    content.innerHTML = '<p>You clicked here:</p><code>' + hdms +
        '</code>';
    overlay.setPosition(coordinate);
});

var geolocation = new Geolocation({
    // enableHighAccuracy must be set to true to have the heading value.
    trackingOptions: {
        enableHighAccuracy: true
    },
    projection: view.getProjection()
});
geolocation.on('change', function () {
    el('accuracy').innerText = geolocation.getAccuracy() + ' [m]';
    el('altitude').innerText = geolocation.getAltitude() + ' [m]';
    el('altitudeAccuracy').innerText = geolocation.getAltitudeAccuracy() + ' [m]';
    el('heading').innerText = geolocation.getHeading() + ' [rad]';
    el('speed').innerText = geolocation.getSpeed() + ' [m/s]';
});

// handle geolocation error.
geolocation.on('error', function (error) {
    var info = document.getElementById('info');
    info.innerHTML = error.message;
    info.style.display = '';
});

var accuracyFeature = new Feature();
geolocation.on('change:accuracyGeometry', function () {
    accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
});

var positionFeature = new Feature();
positionFeature.setStyle(new Style({
    image: new CircleStyle({
        radius: 6,
        fill: new Fill({
            color: '#3399CC'
        }),
        stroke: new Stroke({
            color: '#fff',
            width: 2
        })
    })
}));

geolocation.on('change:position', function () {
    var coordinates = geolocation.getPosition();
    positionFeature.setGeometry(coordinates ?
        new Point(coordinates) : null);
});

new VectorLayer({
    map: map,
    source: new VectorSource({
        features: [accuracyFeature, positionFeature]
    })
});