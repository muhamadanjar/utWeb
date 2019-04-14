import React, { Component } from 'react';
import Http from '../utils/Http';
import { jsPanel } from "jspanel4";
import Map from 'ol/Map.js';
import View from 'ol/View.js';
import Overlay from 'ol/Overlay.js';
import Feature from 'ol/Feature.js';
import {ScaleLine,ZoomToExtent} from 'ol/control';
import Geolocation from 'ol/Geolocation.js';
import Collection from 'ol/Collection.js'
import {Point} from 'ol/geom';
import ContextMenu from 'ol-contextmenu';
import OlGeocoder from 'ol-geocoder';
import {
    fromLonLat,
    // toLonLat,
    get as getProjection,
    transform
} from 'ol/proj.js';
import {toStringXY} from 'ol/coordinate'
import {GeoJSON,MVT} from 'ol/format';
import {
    OSM,
    Vector as VectorSource,
    TileWMS,
    TileJSON,
    VectorTile as VectorTileSource,
    ImageWMS
} from 'ol/source.js';
import {
    Group as LayerGroup,
    Tile as TileLayer,
    Vector as VectorLayer,
    VectorTile as VectorTileLayer,
    Image as ImageLayer
} from 'ol/layer.js';
import TileGrid from 'ol/tilegrid/TileGrid.js';
import {
    Circle as CircleStyle,
    Fill,
    Stroke,
    Style,
    Icon as StyleIcon,
    Text as StyleText
} from 'ol/style.js'
import PopUpMap from './PopUpMap'
import LayerItem from './LayerItem'
import StreetviewComponent from './StreeViewComponent'
import BasemapComponent from './BasemapComponent'

class MapComponent extends Component {
    constructor(props) {
        super(props);
        this.mapDivId = `map-${Math.random()}`;
        this.state = {
            map:'',
            value: '', layers: {}, infolayer: 'all', infomap: 'info', intLayersString: '', intLayers: '', selectedLayer: 'all', overlaysOBJ: [], DefaultCoordinate: [106.798036,-6.6033115],
            extends: [11885263.318968868, -738429.8029621213, 11892142.651514532, -734990.1366892883],
            indonesia:[10719664, -1663463, 15450199, 1252149],
            layerGroup:[],basemapGroup:[],
            WMSStoreNS:this.props.WMSStoreNS,
            LayerProxy:'',
            WFSProxy:'',
            pdurl: 'http://geospasial.bpn.go.id/mapproxy/tiledataset/tiles/hires_idn/GLOBAL_WEBMERCATOR/{z}/{x}/{y}.png',
        }
    }
    componentDidMount() {
        this.initMap();
        // this.getgroupLayer();
        var infoFeatures;
        // console.log(this.props);
        
        this.getLayerMap();
        // this.prepareLegend("#overlayitem", "#basemapitem", this.map);
        // console.log(this.map.getLayerGroup().getLayers().getArray());
        this.prepareContextMenu(this.map);
        
    }
    render() {
        return (
            <div id={this.mapDivId}>
                <PopUpMap/>
                <LayerItem layerproxy={this.state.LayerProxy} layers={this.state.layers}/>
                <StreetviewComponent></StreetviewComponent>
                <BasemapComponent></BasemapComponent>
            </div>
        )
    }

    initMap() {
        $(`#${this.mapDivId}`).height($(window).outerHeight() - $("hr").outerHeight() - $("footer").outerHeight() - $(".navbar").outerHeight());
        this.layer_global = new Collection();
        var container_popup = document.getElementById('popup');

        let pointimage = new CircleStyle({
            radius: 5,
            fill: null,
            stroke: new Stroke({ color: 'blue', width: 2 })
        });
        let styles = this.prepareStyle(pointimage);
        let styleFunction = function (feature) {
            return styles[feature.getGeometry().getType()];
        };
        
        let infoSource = new VectorSource({
            format: new GeoJSON({
                featureProjection: getProjection('EPSG:3857'),
            })
        }),
        infoLayer = new VectorLayer({
            source: infoSource,
            style: styleFunction,
            name: "info"
        });
        
        var overlay_info = new Overlay({
            element: container_popup,
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        });
        var osmSource = new OSM();
        var resolutions = [];
        var key = 'pk.eyJ1IjoibXVoYW1hZGFuamFyIiwiYSI6ImNqbG03MGN5eDE1M3IzcHQ1bjFybDg1ZWwifQ.an6RX5-JnEh_VN70pj4brQ';
        for (var i = 0; i <= 8; ++i) {
            resolutions.push(156543.03392804097 / Math.pow(2, i * 2));
        }
        // Calculation of tile urls for zoom levels 1, 3, 5, 7, 9, 11, 13, 15.
        
        let basemap_mapbox = new VectorTileLayer({
            source: new VectorTileSource({
              attributions: '© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a> ' +
                '© <a href="https://www.openstreetmap.org/copyright">' +
                'OpenStreetMap contributors</a>',
              format: new MVT(),
              tileGrid: new TileGrid({
                extent: getProjection('EPSG:3857').getExtent(),
                resolutions: resolutions,
                tileSize: 512
              }),
              tileUrlFunction: tileUrlFunction
            }),
            style: this.createMapboxStreetsV6Style(Style, Fill, Stroke, StyleIcon, StyleText),
            id:'basemap_mapbox',
            baseLayer:true
        });
        let basemap_op = new TileLayer({
            source: osmSource,
            name:'baselayer',
            id:'base',
            baseLayer:true
        })
        let view = new View({
            center: fromLonLat(this.state.DefaultCoordinate),
            zoom: 15,
            minZoom: 13,
            maxZoom: 19
        });
        let tg =new LayerGroup({
            layers: [],
            id:'lyr_grp',
            name:'Overlay Group'
        })
        this.map = new Map({
            layers: [
                basemap_mapbox,
                tg,
                infoLayer
            ],
            overlays: [overlay_info],
            view: view
        });
        let map = this.map;
        map.setTarget(this.mapDivId);

        map.addControl(new ScaleLine());
        map.addControl(new ZoomToExtent({
            extent: this.state.extends,
            tipLabel: "Zoom Bogor"
        }));

        let panel = jsPanel.create({
            theme: 'primary',
            headerTitle: 'Info',
            position: 'center-top 0 58',
            contentSize: '450 250',
            content: '<div id=\'layer-control\'></div>',
            setstatus: "minimize",
            callback: function () {
                this.content.style.padding = '20px';
            },
            onbeforeclose: function () {
                return confirm('Do you really want to close the panel?');
            }
        });

        window.setTimeout(function () {
            panel.minimize();
            console.log(map.getView().calculateExtent());
            console.log('getbound',map.getView().calculateExtent(map.getSize()))
        }, 1000);
        let infopopup = overlay_info;
        this.setState({map:map});
        this.prepareFeatureInfo(map, infopopup, infoLayer);

        function tileUrlFunction(tileCoord) {
            return ('https://{a-d}.tiles.mapbox.com/v4/mapbox.mapbox-streets-v6/' +
                '{z}/{x}/{y}.vector.pbf?access_token=' + key)
            .replace('{z}', String(tileCoord[0] * 2 - 1))
            .replace('{x}', String(tileCoord[1]))
            .replace('{y}', String(-tileCoord[2] - 1))
            .replace('{a-d}', 'abcd'.substr(
                ((tileCoord[1] << tileCoord[0]) + tileCoord[2]) % 4, 1));
        }

        var geocoder = new OlGeocoder('nominatim', {
            provider: 'osm',
            key: '__some_key__',
            lang: 'pt-BR', //en-US, fr-FR
            placeholder: 'Pencarian for ...',
            targetType: 'text-input',
            limit: 5,
            keepOpen: true
          });
          map.addControl(geocoder);
    }

    getgroupLayer() {
        let datagroup = Http.get("/map/getdata/group");
        datagroup.then(response => {
            let data = response.data;
            let store_grp =[];
            data.map((lgroup)=>{
                let Gl = new LayerGroup({
                    layers: [],
                    name:lgroup.namalayer,
                    id:lgroup.kodelayer,
                });
                store_grp.push(Gl);
                this.map.addLayer(Gl);
            });
            this.setState({
                layerGroup:store_grp
            });
            
        })
            .catch(function (error) {
                console.log(error);
            })
    }

    getLayerMap() {
        let layer = Http.get("/map/getdata");
        layer.then(response => {
            let data = response.data;
            let g = [];
            data.map((layer)=>{
                let urllayer = layer.urllayer;
                if(layer.tipelayer =='olimage'){
                    var format = 'image/png';
                    var untiled = new ImageLayer({
                        source: new ImageWMS({
                            ratio: 1,
                            url: urllayer,
                            params: {'FORMAT': format,
                                'VERSION': '1.1.1',  
                                LAYERS: layer.kodelayer,
                            }
                        }),
                        name: layer.namalayer,
                        id: layer.kodelayer,
                        visible: layer.option_visible,
                        opacity: layer.option_opacity,
                        baseLayer:false
                    });
                    this.layer_global.push(untiled);
                }else{
                    let wmsSource = new TileWMS({
                        url: urllayer,
                        params: {
                            'LAYERS': layer.kodelayer,
                            'VERSION': '1.1.1',
                            'FORMAT': 'image/png',
                            STYLES: layer.option_style || 'generic',
                            //"STYLES": '',
                            crossOrigin: 'anonymous',
                            serverType: 'geoserver',
                            tiled: true,
                        },
                    });
                    let wmsLayerTile = new TileLayer({
                        source: wmsSource,
                        visible: layer.option_visible,
                        opacity: layer.option_opacity,
                        name: layer.namalayer,
                        id: layer.kodelayer,
                        kodegroup:layer.kodegroup,
                        srs: layer.srs || 'EPSG:4326',
                        baseLayer:false
                    });
                    this.layer_global.push(wmsLayerTile);
                }
                this.updateInteractiveLayers(layer.kodelayer);
            });
            let tg = this.findBy(this.map.getLayerGroup(), 'id', 'lyr_grp');
            tg.setLayers(this.layer_global);
            this.setState({layers:this.layer_global});
            this.prepareToc(this.map);
            // this.prepareLegend('#overlayitem','#basemapitem',this.map);
            // let store_layer = this.layer_global.getArray(),lenl = store_layer.length;
            // let newLayer = store_layer.reduce(function(acc, curr) {
            //     let findIfNameExist = acc.findIndex(function(item) {
            //       return item.kodegroup === curr.get('kodegroup');
            //     });
            //     if (findIfNameExist === -1) {
            //       let obj = {
            //         'kodegroup': curr.get('kodegroup'),
            //         "layers": [curr]
            //       }
            //       acc.push(obj)
            //     } else { 
            //       acc[findIfNameExist].layers.push(curr)
            //     }
            //     return acc;
              
            // }, []);
            // console.log(newLayer);
            
            // newLayer.map((data)=>{
            //     let tg = this.findBy(this.map.getLayers(), 'id', 'group:admin');
            //     console.log(tg);
            //     // tg.setLayers(data.layers);
            // });
            
        }).catch(function (error) {
                console.log(error);
            })
    }

    updateInteractiveLayers(layer) {
        let intLayers = [...this.state.intLayers];
        let index = $.inArray(layer, intLayers);
        //console.log(index);
        if (index > -1) {
            intLayers.splice(index, 1);
        } else {
            intLayers.push(layer);
        }
        this.setState({intLayersString:intLayers.join(','),intLayers:intLayers});
    }

    findBy(layer, key, value) {
        if (layer.get(key) === value) {
            return layer;
        }
        if (layer.getLayers) {
            var layers = layer.getLayers().getArray(),
                len = layers.length, result;
            for (var i = 0; i < len; i++) {
                result = this.findBy(layers[i], key, value);
                if (result) {
                    return result;
                }
            }
        }

        return null;
    }

    prepareFeatureInfo(map, ipopup, ilayer) {
        let infocontent = document.getElementById("popup-content");
        let infocloser = document.getElementById("popup-closer");
        let isource = ilayer.getSource();//,
        let infoFeatures = [];
        let infpgsz = 0;
        infocloser.onclick = function () {
            ipopup.setPosition(undefined);
            this.blur();
            return false;
        };

        map.on('singleclick', function (evt) {
            isource.clear();
            ipopup.setPosition(undefined);
            let viewResolution = (this.getView().getResolution()),
                px = this.getEventPixel(evt.originalEvent);
            let hit = this.forEachLayerAtPixel(px, layatpix.bind({ map:this,evt: evt, viewResolution: viewResolution }), this,lyrFilter);
            if (hit) {
                ipopup.setPosition(evt.coordinate);
            }
        });

        function layatpix(lyr, colorval) {
            const layerId = lyr.get('id'); 
            const baseLayer = lyr.get('baseLayer');
            console.log(layerId,baseLayer);
            let evt = this.evt,viewResolution = this.viewResolution,olm = this.map;
            if(!baseLayer){
                let infourl = lyr.getSource().getGetFeatureInfoUrl(evt.coordinate, viewResolution, olm.getView().getProjection().getCode(), { 'INFO_FORMAT': 'application/json' });
                if(infourl){
                    Http.get(infourl).then((res)=>{
                        const response = res.data;
                        console.log(response);
            
                        infocontent.innerHTML = tablePopupItem(response.features);
                        // var feats = isource.getFormat().readFeatures(response);
                        // infoFeatures = infoFeatures.concat(feats);
                        // infpgsz += infoFeatures.length;
                        // if (feats && feats.length > 0) {
                        //     isource.refresh();
                        //     var feat = infoFeatures[0];
                        //     detilInfo({ featureId: feat.getId(), page: 1 });
                        // }
                    }).catch(e=>console.log(e)); 
                    return true;
                }
                
            }
            return false;
        }
        function lyrFilter(lyrcandidate) {
            return lyrcandidate.get("kodelayer") == "kotabogor:Administrasi_Kecamatan";
        }
        
        function navDetilInfo(navType, currPage, pageSize) {
            let pg = (navType == "prev") ? currPage - 1 : currPage + 1;
            if (infoFeatures[pg - 1])
                detilInfo({ featureId: infoFeatures[pg - 1].getId(), page: pg });
        }

        function detilInfo(params){
            isource.clear();
            //$(infocontent).load(DetilInfoAction, params);
            
            $.ajax({
                "url":  dnn.getVar("sf_siteRoot", "/") + "DesktopModules/MVC/BpnPeta/Item/DetilInfoPeta",
                "type": "POST",
                headers: {
                    "ModuleId": 122851,
                    "TabId": 42393,
                    "RequestVerificationToken": $("input[name='__RequestVerificationToken']").val()
                },
                data: {
                    featureid: params["featureId"],
                    page : params["page"]
                },
                success: function (data, textStatus, XMLHttpRequest) {
                    $('#infocontent').html(data);
                },
                error: function (a, b, c) {
                    console.log(a, b, c);
                }
            });

            let feat = infoFeatures.find(function (ft) { if (ft.getId() == params.featureId) return ft; });
            isource.addFeature(feat);
        }

        function tablePopupItem(feature){
            console.log(feature);
            let content = "";
            const ns = 'kotabogor';
            if (feature) {
                if(feature.length > 0){
                    for (var f in feature) {
                    let id_layer = feature[f].id;
                    console.log(id_layer);
                    
                    let dl = Http.get(Laravel.serverUrl+'/api/getlayerinformasi/'+ns+':'+id_layer.split('.')[0]).then((res)=> {return res.data});
                    if(f == 0 ){
                        content += "<div class='carousel-item active'>";
                    }else{
                        content += "<div class='carousel-item'>";
                    }
                    content += "<table class='table table-striped'>";
                    if(dl.id !== null && dl.hasOwnProperty('keydata')){
                        var properties = JSON.parse(dl.keydata);
                        for(i in properties){
                        var props = properties[i];
                        var fp = feature[f].properties;
                        if(props.visible){
                            if(props.fieldType =='image'){
                            content += "<tr><td><b>" + props.label + "</b></td><td><b>:</b> </td><td><image class='img-responsive' src='"+Laravel.serverUrl+"/files/uploads/asetkota/" + fp[props.fieldName] + "' width='200'/></td></tr>";
                            }else if(props.fieldType == 'video'){
                            content += "<tr><td><b>" + props.label + "</b></td><td><b>:</b> </td><td>"+
                                "<video width='100%' autoplay loop preload >"+
                                "<source src='"+Laravel.serverUrl+"/files/uploads/video/"+fp[props.fieldName]+"' type='video/mp4'>"+
                                "<source src='"+Laravel.serverUrl+"/files/uploads/video/"+fp[props.fieldName]+"' type='video/webm'>"+
                                "Your browser does not support HTML5 video."+
                                "</video>"+
                            "</td></tr>";
                            }else if(props.fieldType =='sertifikat'){
                            content += "<tr><td><b>" + props.label + "</b></td><td><b>:</b> </td><td><image class='img-responsive' src='"+Laravel.serverUrl+"/files/uploads/sertifikat/" + fp[props.fieldName] + "' width='200'/></td></tr>";
                            }else{
                            content += "<tr><td><b>" + props.label + "</b></td><td><b>:</b> </td><td>" +fp[props.fieldName]+ "</td></tr>";
                            }
                            
                        }
                        }   
                    }else{
                        content += "<tr><th colspan=3>"+id_layer.split('.')[0]+"</th></tr>";
                        for (var name in feature[f].properties) {
                        var fp = feature[f].properties;
                        if (name == 'image_link' || name == 'IMAGE_LINK' || name == 'foto' || name == 'FOTO' || name == 'URL_PHOTO' || name == 'sertifikat' || name == 'Foto') {
                            content += "<tr><td><b>" + name.replace('_'," ") + "</b></td><td><b>:</b> </td><td><image class='img-responsive' src='"+Laravel.serverUrl+"/files/uploads/asetkota/" + fp[name] + "' width='200'/></td></tr>";
                        }else if(name == 'video'){
                            content += "<tr><td><b>" + name + "</b></td><td><b>:</b> </td><td>"+
                            "<video width='100%' autoplay loop preload >"+
                                "<source src='"+Laravel.serverUrl+"/files/uploads/video/"+fp[name]+"' type='video/mp4'>"+
                                "<source src='"+Laravel.serverUrl+"/files/uploads/video/"+fp[name]+"' type='video/webm'>"+
                                "Your browser does not support HTML5 video."+
                            "</video>"+
                            "</td></tr>";
                        }else if(name == 'lampiran' || name == 'sertifikat'){
                            content += "<tr><td><b>" + name.replace('_'," ") + "</b></td><td><b>:</b> </td><td><image class='img-responsive' src='"+Laravel.serverUrl+"/files/uploads/sertifikat/" + fp[name] + "' width='200'/></td></tr>";
                        }
                        else if(name == 'bbox' || name.includes('_id') || name.includes('id_') || name.includes('_ID') || name.includes('ID_') || name.includes('ID') || name.includes('id')){
                        }else{
                            content += "<tr><td><b>" + name.replace('_'," ") + "</b></td><td><b>:</b> </td><td>" + fp[name] + "</td></tr>";
                        }
                        }
                    }
                    content += '</table>';
                    content += '</div>';
                    }
                }else{
                    content += "<table class='table table-bordered'>";
                    content += '<tr><td colspan=3>Data tidak ada</td></tr>';
                    content += '</table>';
                }
            }
          
            return content;
        }

    }

    /* LEGEND ITEM */
    prepareLegend(ovlid, bslid, map) {
        let currlyrdata, currlyritm;
        let LayerProxy = this.state.LayerProxy;
        const lyrs = this.findBy(map.getLayerGroup(),'id','lyr_grp');
        lyrs.getLayers().forEach(function (ly,idx) {
            const isBase = ly.get("baseLayer");
            
            /* Set Base Layer Legend */
            if (isBase) {
                createBaseLayerItem(ly, $(bslid));
            }else {
                /* Set Overlay Legend */
                createOverlayLayerItem(ly, $(ovlid), "layer");
            }
        });
        /* Sortable layer */
        $(".overlay-layers").sortable({
            update: function (ev, ui) {
                setLayerZIndex(this, ui);
            }
        });
        /* Set base layer on radio change */
        $('[name="basemap"]').change(function () { chgBaseLyr(this.value); });
        $('[name="basemap"]:first').prop("checked", true).trigger("change");
        /* Set font size bigger for Edge and IE */
        if (navigator.userAgent.match(/edge/i) || navigator.userAgent.match(/trident/i)) {
            $(".ol-control").css("font-size", "18px");
        }
        /* Define dialog button action */
        $('#cfmdlg>input').click(function (evt) {
            evt.preventDefault();
            if ($(this).val() == "Batal") {
                // Cancel remove layer
                $.unblockUI(); return false;
            } else {
                // Do remove layer
                doRemoveLayer();
            }
        });
        /* Listen layer's collection event */
        lyrs.on('remove', onLayersEvent.bind({ optype: "remove", baseitem: $(bslid), overlayitem: $(ovlid)} ));
        lyrs.on('add', onLayersEvent.bind({ optype: "add", baseitem: $(bslid), overlayitem: $(ovlid) }));
        lyrs.on("change", function (evt) { console.log(evt); });
        /* Functions */
        function onLayersEvent(evt) {
            var ly = evt.element,
                isBase = ly.get("baseLayer"),
                item = isBase ? this.baseitem : this.overlayitem;
            if (isBase) {
                if (this.optype == "remove") {
                    $(item).find(':input[value="' + ly.get("name") + '"]').closest("li").remove();
                } else {
                    createBaseLayerItem(ly, item);
                    $('[name="basemap"]').change(function () { chgBaseLyr(this.value); });
                    ly.setZIndex(-1);
                }
            } else {
                if (this.optype == "remove") {
                    $(item).find('li[data-layer-type="layer"][data-layer-name="' + ly.get("name") + '"]').remove();
                } else {
                    createOverlayLayerItem(ly, item, "layer");
                }
            }
        }
        function createBaseLayerItem(ly, item) {
            var baseitem = $('<li role="menuitemradio" class="list-group-item"></li>'),
                baselabel = $('<label class="baselabel"></label>'),
                baseinput = $('<input type="radio" name="basemap" value="' + ly.get("name") + '" />'),
                basespan = $('<span class="checkmark"></span>');
            $(item).append(baseitem);
            baseitem.append(baselabel);
            baselabel.append(ly.get("title"));
            baselabel.append(baseinput);
            baselabel.append(basespan);
        }
        function createOverlayLayerItem(ly, item, type) {
            /* Handle tileWMS (later maybe handle other type) */
            
            var lySrc = ly.getSource();
            let t = this;
            if (lySrc instanceof TileWMS && lySrc.getParams()["LAYERS"] != undefined) {
                /* Layer */
                var ovlitem, sublist;
                let kodelayer = ly.get('kodelayer');
                let namalayer = ly.get('namalayer');
                if (type == "layer") {
                    ovlitem = $('<li class="list-group-item" data-layer-type="layer" data-layer-name="' + kodelayer+ '"></li>');
                    var lyhead = $('<label class="layer-header"></label>'),
                        lyctrl = $('<label class="layer-control"></label>'),
                        btnrm = $('<button type="button" class="btn-xs btn-danger remove-layer" title="Hapus layer"><span class="glyphicon glyphicon-trash"></span></button>');
                    lyhead.append(namalayer);
                    lyhead.append('<input type="checkbox" data-toggle="collapse" data-target="#' + kodelayer+ '" />');
                    lyhead.append('<span class="toggle-indicator"></span>');
                    lyctrl.append('<input type="checkbox"' + (ly.getVisible() ? ' checked="checked"' : '') + ' aria-label="' + namalayer + '" />');
                    lyctrl.append('<div class="sld round" title="Sembunyikan layer"></div>');
                    lyctrl.append(btnrm);
                    /* Confirm remove layer */
                    btnrm.click({ layer: ly, type: "layer", name: kodelayer ,title: namalayer }, confirmRemoveLayer);
                    ovlitem.append(lyhead);
                    ovlitem.append(lyctrl);
                    /* Trigger change layer visibility */
                    lyctrl.find("input").change({ layer: ly, type: "layer", name: kodelayer }, setLayerVisibility);
                    sublist = $('<ul id="' + kodelayer + '" class="overlay-sublayers list-group collapse" style="padding-top:5px"></ul>');
                    ovlitem.append(sublist);
                    $(item).find(".overlay-layers").append(ovlitem);
                } else {
                    ovlitem = $(item).find('li[data-layer-name="' + kodelayer+ '"]');
                    sublist = ovlitem.find('#'.concat(namalayer));
                    sublist.empty();
                }
                /* Sub layer */
                
                var sublyrs = lySrc.get("layers"),
                    vislyrs = lySrc.getParams()["LAYERS"].split(","),
                    wmsurls = lySrc.urls,
                    lgsrc = LayerProxy.concat(wmsurls[Math.floor(Math.random() * wmsurls.length)], "request=GetLegendGraphic&format=image/png&transparent=true&layer={0}"),
                    ordered = [], filters = [];
                for (var l = 0; l < sublyrs.length; l++) {
                    var lname = sublyrs[l]["name"],
                        sublyr = $('<li class="list-group-item" data-layer-type="sublayer" data-layer-name="' + lname + '"></li>'),
                        slhead = $('<label class="layer-header"></label>'),
                        slctrl = $('<label class="layer-control"></label>'),
                        //imglg = $('<div class="legend-ctr"><img id="' + lname.replace(":", "__") + '" class="collapse" alt="..." src="' + lgsrc.replace("{0}", lname) + '" /></div>'),
                        imglg = $('<div class="legend-ctr collapse" id="' + lname.replace(":", "__") + '"><img alt="..." src="' + lgsrc.replace("{0}", lname) + '" /></div>'),
                        btnrm = $('<button type="button" class="btn-xs btn-danger remove-layer" title="Hapus layer"><span class="glyphicon glyphicon-trash"></span></button>');
                    slhead.append(sublyrs[l]["title"]);
                    slhead.append('<input type="checkbox" data-toggle="collapse" data-target="#' + lname.replace(":", "__") + '" />');
                    slhead.append('<span class="toggle-indicator"></span>');
                    slctrl.append();
                    slctrl.append('<input type="checkbox"' + (vislyrs.includes(lname) ? ' checked="checked"' : '') + ' aria-label="' + sublyrs[l]["title"] + '" />');
                    slctrl.append('<div class="sld round" title="Sembunyikan layer"></div>');
                    slctrl.append(btnrm);
                    /* Trigger change sub-layer visibility */
                    slctrl.find("input").change({ layer: ly, type: "sublayer", name: lname }, setLayerVisibility);
                    sublyr.append(slhead);
                    sublyr.append(slctrl);
                    sublyr.append(imglg);
                    sublist.append(sublyr);
                    /* Confirm remove sub-layer */
                    btnrm.click({ layer: ly, type: "sublayer", name: lname, title: sublyrs[l]["title"] }, confirmRemoveLayer);
                    if (vislyrs.includes(lname)) {
                        ordered.push(lname);
                        filters.push(sublyrs[l]["filter"] ? sublyrs[l]["filter"] : "INCLUDE");
                    }
                }
                /* Update layer params */
                lySrc.updateParams({ LAYERS: ordered.reverse().join() });
                lySrc.updateParams({ CQL_FILTER: filters.reverse().join(";") });
                /* Sortable sublayers */
                sublist.sortable({
                    update: function (ev, ui) {
                        setLayerZIndex(this, ui);
                    }
                });
            }
        }
        function chgBaseLyr(val) {
            map.getLayers().forEach(function (lyr) { if (lyr.get("baseLayer")) lyr.setVisible(lyr.get("name") == val); });
        }
        function setLayerVisibility(evt) {
            var layer = evt.data.layer,
                src = layer.getSource(),
                srclayers = src.get("layers");
            if (evt.data.type == "layer") {
                if (src.getParams()["LAYERS"].trim()) {
                    layer.setVisible(this.checked);
                }
            } else {
                var layers = [],filters = [], clayer,
                    lis = $(this).closest("ul").find("li");
                for (var i = 0; i < lis.length; i++) {
                    if ($(lis[i]).find(".layer-control input")[0].checked) {
                        layers.push($(lis[i]).data("layer-name"));
                        clayer = srclayers.find(function (ly) { return ly["name"] == $(lis[i]).data("layer-name"); });
                        filters.push(clayer["filter"] ? clayer["filter"] : "INCLUDE");
                    }
                }
                src.updateParams({ LAYERS: layers.reverse().join() });
                src.updateParams({ CQL_FILTER: filters.reverse().join(";") });
                var input = $(this).closest("ul").parent("li").find(".layer-control input[aria-label='" + namalayer + "']")[0];
                if (layers.length == 0) {
                    layer.setVisible(false);
                }
                else {
                    if (input && input.checked) {
                        layer.setVisible(true);
                    }
                }
            }
            /* Change tooltip */
            $(this).parent("label").find("div").attr("title", this.checked ? "Sembunyikan layer" : "Tampilkan layer");
        }
        function doRemoveLayer() {
            if (currlyrdata.type == "layer") {
                map.removeLayer(currlyrdata.layer);
            }
            else {
                var vislayers = currlyrdata.layer.getSource().getParams()["LAYERS"].split(",");
                var filters = [];
                vislayers.splice(vislayers.indexOf(currlyrdata.name), 1);
                if (currlyrdata.layer.getSource().get("layers")) {
                    var sublayers = currlyrdata.layer.getSource().get("layers"),
                        tlayer = sublayers.find(function (ly) { return ly["name"] == currlyrdata.name; });
                    sublayers.splice(sublayers.indexOf(tlayer), 1);
                }
                vislayers.forEach(function (lname) {
                    var clayer = currlyrdata.layer.getSource().get("layers").find(function (ly) { return ly["name"] == lname; });
                    filters.push(clayer["filter"] ? clayer["filter"] : "INCLUDE");
                });
                currlyrdata.layer.getSource().updateParams({ LAYERS: vislayers.reverse().join() });
                currlyrdata.layer.getSource().updateParams({ CQL_FILTER: filters.reverse().join(";") });
                $(currlyritm).closest("li").remove();
            }
            $.unblockUI();
        }
        function confirmRemoveLayer(evt) {
            $('#cfmdlg>p').html("Yakin menghapus layer <b>".concat(evt.data.title, "</b>?"));
            $.blockUI({ message: $('#cfmdlg') });
            currlyrdata = evt.data;
            currlyritm = this;
        }
        function setLayerZIndex(obj, ui) {
            var ltype = ui.item.data("layer-type"),
                olyers = map.getLayers().getArray();
            if (ltype == "layer") {
                var layer,
                    layers = $(obj).children("li");
                layers.each(function (idx, el) {
                    layer = olyers.find(function (ly) { return ly.get("name") == $(el).data("layer-name"); });
                    layer.setZIndex(layers.length - 1 - idx);
                });
            }
            else {
                var layers = [], filters = [], clayer,
                    layer = olyers.find(function (ly) { return ly.get("name") == obj.id; });
                $(obj).children("li").each(function (idx, el) {
                    if ($(el).find(".layer-control input").prop("checked")) {
                        layers.push($(el).data("layer-name"));
                        clayer = layer.getSource().get("layers").find(function (ly) { return ly["name"] == $(el).data("layer-name"); });
                        filters.push(clayer["filter"] ? clayer["filter"] : "INCLUDE");
                    }
                });
                layer.getSource().updateParams({ LAYERS: layers.reverse().join() });
                layer.getSource().updateParams({ CQL_FILTER: filters.reverse().join(";") });
            }
        }
    }
    /* Context Menu */
    prepareContextMenu(map){
        let contextmenu = new ContextMenu();
        map.addControl(contextmenu);
        var add_later = [
        '-', // this is a separator
        {
            text: 'Tambah Marker',
            icon: 'images/marker.png',
            //callback: marker
        },
        {
            text: 'Street View',
            icon: 'images/streetview-icon.png',
            callback: view_streetview
        }
        ];
        contextmenu.extend(add_later);

        function view_streetview(obj) {
            var coord4326 = transform(obj.coordinate, 'EPSG:3857', 'EPSG:4326'),   
            template = 'Coordinate is ({x} | {y})',
            iconStyle = new Style({
              image: new StyleIcon({ scale: .6, src: 'img/pin_drop.png' }),
              text: new StyleText({
                offsetY: 25,
                text: toStringXY(coord4326, template, 2),
                font: '15px Open Sans,sans-serif',
                fill: new Fill({ color: '#111' }),
                stroke: new Stroke({ color: '#eee', width: 2 })
              })
            }),
            feature = new Feature({
              type: 'removable',
              geometry: new Point(obj.coordinate)
            });
            // feature.setStyle(iconStyle);
            $('#formModalMap').find('.modal-title').html('Street View');
            $('#street-view').css({'height':'400px'}).appendTo($('#formModalMap').find('.modal-body'));
            
            $('#formModalMap').modal();
            initializePanorama(coord4326);
            // console.log(coord4326);
            // vectorLayer.getSource().addFeature(feature);
        }
    }

    prepareToc(map){
        map.getLayers().forEach(function(layer, i) {
            if (layer instanceof LayerGroup) {
              layer.getLayers().forEach(function(sublayer, j) {
                // console.log(sublayer.get('id'));
                bindInputs('#layer-'+sublayer.get('id').split(':')[1], sublayer);
              });
            }
        });

        function bindInputs(layerid, layer) {
            // console.log(layer);
            var visibilityInput = $(layerid + ' input.visible');
            visibilityInput.on('change', function() {
              layer.setVisible(this.checked);
            });
            visibilityInput.prop('checked', layer.getVisible());
            if(layer.getVisible()){
              $(visibilityInput).closest('li').find('div.control-right').show();
            }else{
              $(visibilityInput).closest('li').find('div.control-right').hide();
            }
            var opacityInput = $(layerid + ' input.opacity');
            opacityInput.on('input change', function() {
              layer.setOpacity(parseFloat(this.value));
            });
            opacityInput.val(String(layer.getOpacity()));
        }
        $('#layer-widget').appendTo($('#layer-control'));
    }

    prepareStyle(pointimage){
        let style = {
            'Point': new Style({
                image: pointimage
            }),
            'LineString': new Style({
                stroke: new Stroke({
                    color: 'green',
                    width: 1
                })
            }),
            'MultiLineString': new Style({
                stroke: new Stroke({
                    color: 'green',
                    width: 1
                })
            }),
            'MultiPoint': new Style({
                image: pointimage
            }),
            'MultiPolygon': new Style({
                stroke: new Stroke({
                    color: 'blue',
                    width: 1
                }),
                fill: new Fill({
                    color: 'rgba(255, 255, 0, 0.2)'
                })
            }),
            'Polygon': new Style({
                stroke: new Stroke({
                    color: 'blue',
                    lineDash: [4],
                    width: 3
                }),
                fill: new Fill({
                    color: 'rgba(0, 0, 255, 0.2)'
                })
            }),
            'GeometryCollection': new Style({
                stroke: new Stroke({
                    color: 'magenta',
                    width: 2
                }),
                fill: new Fill({
                    color: 'magenta'
                }),
                image: new CircleStyle({
                    radius: 10,
                    fill: null,
                    stroke: new Stroke({
                        color: 'magenta'
                    })
                })
            }),
            'Circle': new Style({
                stroke: new Stroke({
                    color: 'red',
                    width: 2
                }),
                fill: new Fill({
                    color: 'rgba(255,0,0,0.2)'
                })
            })
        };
        return style;
    }

    createMapboxStreetsV6Style(Style, Fill, Stroke, Icon, Text) {
        var fill = new Fill({color: ''});
        var stroke = new Stroke({color: '', width: 1});
        var polygon = new Style({fill: fill});
        var strokedPolygon = new Style({fill: fill, stroke: stroke});
        var line = new Style({stroke: stroke});
        var text = new Style({text: new Text({
          text: '', fill: fill, stroke: stroke
        })});
        var iconCache = {};
        function getIcon(iconName) {
          var icon = iconCache[iconName];
          if (!icon) {
            icon = new Style({image: new Icon({
              src: 'https://unpkg.com/@mapbox/maki@4.0.0/icons/' + iconName + '-15.svg',
              imgSize: [15, 15],
              crossOrigin: 'anonymous'
            })});
            iconCache[iconName] = icon;
          }
          return icon;
        }
        var styles = [];
        return function(feature, resolution) {
          var length = 0;
          var layer = feature.get('layer');
          var cls = feature.get('class');
          var type = feature.get('type');
          var scalerank = feature.get('scalerank');
          var labelrank = feature.get('labelrank');
          var adminLevel = feature.get('admin_level');
          var maritime = feature.get('maritime');
          var disputed = feature.get('disputed');
          var maki = feature.get('maki');
          var geom = feature.getGeometry().getType();
          if (layer == 'landuse' && cls == 'park') {
            fill.setColor('#d8e8c8');
            styles[length++] = polygon;
          } else if (layer == 'landuse' && cls == 'cemetery') {
            fill.setColor('#e0e4dd');
            styles[length++] = polygon;
          } else if (layer == 'landuse' && cls == 'hospital') {
            fill.setColor('#fde');
            styles[length++] = polygon;
          } else if (layer == 'landuse' && cls == 'school') {
            fill.setColor('#f0e8f8');
            styles[length++] = polygon;
          } else if (layer == 'landuse' && cls == 'wood') {
            fill.setColor('rgb(233,238,223)');
            styles[length++] = polygon;
          } else if (layer == 'waterway' &&
              cls != 'river' && cls != 'stream' && cls != 'canal') {
            stroke.setColor('#a0c8f0');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'waterway' && cls == 'river') {
            stroke.setColor('#a0c8f0');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'waterway' && (cls == 'stream' ||
              cls == 'canal')) {
            stroke.setColor('#a0c8f0');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'water') {
            fill.setColor('#a0c8f0');
            styles[length++] = polygon;
          } else if (layer == 'aeroway' && geom == 'Polygon') {
            fill.setColor('rgb(242,239,235)');
            styles[length++] = polygon;
          } else if (layer == 'aeroway' && geom == 'LineString' &&
              resolution <= 76.43702828517625) {
            stroke.setColor('#f0ede9');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'building') {
            fill.setColor('#f2eae2');
            stroke.setColor('#dfdbd7');
            stroke.setWidth(1);
            styles[length++] = strokedPolygon;
          } else if (layer == 'tunnel' && cls == 'motorway_link') {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'tunnel' && cls == 'service') {
            stroke.setColor('#cfcdca');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'tunnel' &&
              (cls == 'street' || cls == 'street_limited')) {
            stroke.setColor('#cfcdca');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'tunnel' && cls == 'main' &&
              resolution <= 1222.99245256282) {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'tunnel' && cls == 'motorway') {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'tunnel' && cls == 'path') {
            stroke.setColor('#cba');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'tunnel' && cls == 'major_rail') {
            stroke.setColor('#bbb');
            stroke.setWidth(2);
            styles[length++] = line;
          } else if (layer == 'road' && cls == 'motorway_link') {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'road' && (cls == 'street' ||
              cls == 'street_limited') && geom == 'LineString') {
            stroke.setColor('#cfcdca');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'road' && cls == 'main' &&
              resolution <= 1222.99245256282) {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'road' && cls == 'motorway' &&
              resolution <= 4891.96981025128) {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'road' && cls == 'path') {
            stroke.setColor('#cba');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'road' && cls == 'major_rail') {
            stroke.setColor('#bbb');
            stroke.setWidth(2);
            styles[length++] = line;
          } else if (layer == 'bridge' && cls == 'motorway_link') {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'bridge' && cls == 'motorway') {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'bridge' && cls == 'service') {
            stroke.setColor('#cfcdca');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'bridge' &&
              (cls == 'street' || cls == 'street_limited')) {
            stroke.setColor('#cfcdca');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'bridge' && cls == 'main' &&
              resolution <= 1222.99245256282) {
            stroke.setColor('#e9ac77');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'bridge' && cls == 'path') {
            stroke.setColor('#cba');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'bridge' && cls == 'major_rail') {
            stroke.setColor('#bbb');
            stroke.setWidth(2);
            styles[length++] = line;
          } else if (layer == 'admin' && adminLevel >= 3 && maritime === 0) {
            stroke.setColor('#9e9cab');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'admin' && adminLevel == 2 &&
              disputed === 0 && maritime === 0) {
            stroke.setColor('#9e9cab');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'admin' && adminLevel == 2 &&
              disputed === 1 && maritime === 0) {
            stroke.setColor('#9e9cab');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'admin' && adminLevel >= 3 && maritime === 1) {
            stroke.setColor('#a0c8f0');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'admin' && adminLevel == 2 && maritime === 1) {
            stroke.setColor('#a0c8f0');
            stroke.setWidth(1);
            styles[length++] = line;
          } else if (layer == 'country_label' && scalerank === 1) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('bold 11px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#334');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(2);
            styles[length++] = text;
          } else if (layer == 'country_label' && scalerank === 2 &&
              resolution <= 19567.87924100512) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('bold 10px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#334');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(2);
            styles[length++] = text;
          } else if (layer == 'country_label' && scalerank === 3 &&
              resolution <= 9783.93962050256) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('bold 9px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#334');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(2);
            styles[length++] = text;
          } else if (layer == 'country_label' && scalerank === 4 &&
              resolution <= 4891.96981025128) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('bold 8px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#334');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(2);
            styles[length++] = text;
          } else if (layer == 'marine_label' && labelrank === 1 &&
              geom == 'Point') {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont(
                'italic 11px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#74aee9');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'marine_label' && labelrank === 2 &&
              geom == 'Point') {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont(
                'italic 11px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#74aee9');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'marine_label' && labelrank === 3 &&
              geom == 'Point') {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont(
                'italic 10px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#74aee9');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'marine_label' && labelrank === 4 &&
              geom == 'Point') {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont(
                'italic 9px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#74aee9');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'place_label' && type == 'city' &&
              resolution <= 1222.99245256282) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('11px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#333');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'place_label' && type == 'town' &&
              resolution <= 305.748113140705) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('9px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#333');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'place_label' && type == 'village' &&
              resolution <= 38.21851414258813) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('8px "Open Sans", "Arial Unicode MS"');
            fill.setColor('#333');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
          } else if (layer == 'place_label' &&
              resolution <= 19.109257071294063 && (type == 'hamlet' ||
              type == 'suburb' || type == 'neighbourhood')) {
            text.getText().setText(feature.get('name_en'));
            text.getText().setFont('bold 9px "Arial Narrow"');
            fill.setColor('#633');
            stroke.setColor('rgba(255,255,255,0.8)');
            stroke.setWidth(1);
            styles[length++] = text;
        }
        //   } else if (layer == 'poi_label' && resolution <= 19.109257071294063 && scalerank == 1 && maki !== 'marker') {
        //     styles[length++] = getIcon(maki);
        //   } else if (layer == 'poi_label' && resolution <= 9.554628535647032 && scalerank == 2 && maki !== 'marker') {
        //     styles[length++] = getIcon(maki);
        //   } else if (layer == 'poi_label' && resolution <= 4.777314267823516 && scalerank == 3 && maki !== 'marker') {
        //     styles[length++] = getIcon(maki);
        //   } else if (layer == 'poi_label' && resolution <= 2.388657133911758 && scalerank == 4 && maki !== 'marker') {
        //     styles[length++] = getIcon(maki);
        //   } else if (layer == 'poi_label' && resolution <= 1.194328566955879 && scalerank >= 5 && maki !== 'marker') {
        //     styles[length++] = getIcon(maki);
        //   }
          styles.length = length;
          return styles;
        };
    }
}
export default MapComponent;