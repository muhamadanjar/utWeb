importScripts('../ajax.js');
let timeReqLastCoord;
let timeReqLastCoordNode;
let timeReqLastSensorNode;
let timeReqMarkerClusterer;
function reqLastCoord(address) {
        ajax(address, null, 'GET', function(a) {
                self.postMessage({ cmd: 'resLastCoord', val: a });
                timeReqLastCoord = setTimeout(function() { reqLastCoord(address); }, 5000);
        });
}
function reqLastCoordNode(address) {
        ajax(address, null, 'GET', function(a) {
                self.postMessage({ cmd: 'resLastCoordNode', val: a });
                timeReqLastCoordNode = setTimeout(function() { reqLastCoordNode(address); }, 5000);
        });
}
function reqLastSensorNode(address) {
        ajax(address, null, 'GET', function(a) {
                self.postMessage({ cmd: 'resLastSensorNode', val: a });
                timeReqLastSensorNode = setTimeout(function() { reqLastSensorNode(address); }, 5000);
        });
}
function reqMarkerClusterer(address) {
        ajax(address, null, 'GET', function(a) {
                self.postMessage({ cmd: 'resMarkerClusterer', val: a });
                timeReqMarkerClusterer = setTimeout(function() { reqMarkerClusterer(address); }, 30000);
        });
}
function reqRouteList(address) {
        ajax(address, null, 'GET', function(a) { self.postMessage({ cmd: 'resRouteList', val: a }) });
}
function reqDataCoord(address){
        ajax(address, null, 'GET', function(c) {
                if (c.code === 200) {
                        let d = c.message;let e = new Array();
                        for (let f = 0; f < d.length; f++) {
                                let route_points = d[f].route_points;
                                let noroute = 1;
                                for(let g in route_points){
                                        let latlng = route_points[g]['lat']+','+route_points[g]['lng'];
                                        e.push([noroute,latlng]);noroute++}
                                }
                        self.postMessage({ cmd: 'resDataCoord', val: e });
                }
        });
}
self.addEventListener('message', function(a) {
        let b = a.data;
        let c = b.data;
        switch (b.cmd) {
                case 'endLastCoord':
                        clearTimeout(timeReqLastCoord);
                break;
                case 'endLastCoordNode':
                        clearTimeout(timeReqLastCoordNode);
                break;
                case 'endLastSensorNode':
                        clearTimeout(timeReqLastSensorNode);
                break;
                case 'endMarkerClusterer':
                        clearTimeout(timeReqMarkerClusterer);
                break;
                case 'reqLastCoord':
                        reqLastCoord(b.val);
                break;
                case 'reqLastCoordNode':
                        reqLastCoordNode(b.val);
                break;
                case 'reqLastSensorNode':
                        reqLastSensorNode(b.val);
                break;
                case 'reqMarkerClusterer':
                        reqMarkerClusterer(b.val);
                break;
                case 'reqRouteList':
                        reqRouteList(b.val);
                case 'reqDataCoord':
                        reqDataCoord(b.val);
                break;
                default:
                        self.postMessage(1/x);
        }
}, false);