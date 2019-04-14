(function ($) {
    /* WORKAROUND FOR IE */
    if (!Array.prototype.includes) {
        Object.defineProperty(Array.prototype, "includes", {
            enumerable: false,
            value: function (obj) {
                var newArr = this.filter(function (el) {
                    return el == obj;
                });
                return newArr.length > 0;
            }
        });
    }
    if (!Array.prototype.find) {
        Object.defineProperty(Array.prototype, 'find', {
            value: function (predicate) {
                if (this == null) {
                    throw new TypeError('"this" is null or not defined');
                }
                var o = Object(this);
                var len = o.length >>> 0;
                if (typeof predicate !== 'function') {
                    throw new TypeError('predicate must be a function');
                }
                var thisArg = arguments[1];
                var k = 0;
                while (k < len) {
                    var kValue = o[k];
                    if (predicate.call(thisArg, kValue, k, o)) {
                        return kValue;
                    }
                    k++;
                }
                return undefined;
            }
        });
    }
    if (!String.prototype.startsWith) {
        String.prototype.startsWith = function (str) {
            if (this.indexOf(str) === 0) {
                return true;
            } else {
                return false;
            }
        };
    }
    if (!String.prototype.endsWith) {
        String.prototype.endsWith = function (suffix) {
            return this.indexOf(suffix, this.length - suffix.length) !== -1;
        };
    }
    /* Get WFSUrl */
    function GetWFSUrl() {
        var rnd = Math.floor(Math.random() * WFSUrl.split(",").length);
        return WFSUrl.split(",")[rnd];
    }
    
    /* PREPARE ALL ON DOCUMENT READY */
    $(document).ready(function () {
        $('.select2_single').select2({ width: 'resolve', dropdownParent: $(".query-side-menu") });
        init();
        prepareLegend("#overlayitem", "#basemapitem", olm);
        prepareLiveSerch("#gSearch", "#clrSearch", olm);

    });

    /* CLEAR SELECTION */
    clearSelect = function () {
        var lyrs = olm.getLayers(), ilayer;
        lyrs.forEach(function (ly, idx) {
            if (ly.get("name") == "info") {
                ilayer = ly;
                return;
            }
        });
        ilayer.getSource().clear();
    };
    /* GOTO PERSIL */
    showInfoPersil = function (data) {
        var lyrs = olm.getLayers(), ilayer;
        lyrs.forEach(function (ly, idx) {
            if (ly.get("name") == "info") {
                ilayer = ly;
                return;
            }
        });
        if (ilayer) {
            var isource = ilayer.getSource();
            infoPopup.setPosition(undefined);
            isource.clear();
            var feats = isource.getFormat().readFeatures(data);
            if (feats && feats.length > 0) {
                var feat = feats[0];
                isource.addFeature(feat);
                infoFeatures = [feat];
                olm.getView().fit(feat.getGeometry(), { duration: 1200, nearest: false });
                infpgsz = 1;
                var params = { featureId: feat.getId(), page: 1 },
                    infocontent = document.getElementById("infocontent");
                $(infocontent).load(DetilInfoAction, params);
                infoPopup.setPosition(ol.extent.getCenter(feat.getGeometry().getExtent()));
            }
        }
    };
    /* LIVE SEARCH */
    function prepareLiveSerch(inputid, clrbtnid, map, infoLayer) {
        /* Live Search */
        $(inputid).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "//maps.google.com/maps/api/geocode/json",
                    dataType: "json",
                    data: {
                        address: encodeURIComponent(request.term),
                        region: "id",
                        sensor: false
                    },
                    success: function (data) {
                        var results = [];
                        for (var d = 0; d < data.results.length; d++) {
                            results.push({ label: data.results[d].formatted_address, value: data.results[d].formatted_address, geom: data.results[d].geometry });
                        }
                        response(results);
                    }
                });
            },
            minLength: 5,
            delay: 500,
            select: function (event, ui) {
                var sw = ui.item.geom.viewport.southwest,
                    ne = ui.item.geom.viewport.northeast,
                    vproj = map.getView().getProjection().getCode();
                var ex = ol.extent.boundingExtent([ol.proj.transform([sw.lng, sw.lat], 'EPSG:4326', vproj), ol.proj.transform([ne.lng, ne.lat], 'EPSG:4326', vproj)]);
                map.getView().fit(ex, { duration: 1200, nearest: true });
                if (!$(clrbtnid).hasClass("aktif")) $(clrbtnid).toggleClass("aktif");
            }
        });
        $(clrbtnid).click(function (e) { $(inputid).val(""); $(this).toggleClass("aktif"); });
    }
    /* LEGEND ITEM */
    function prepareLegend(ovlid, bslid, map) {
        var currlyrdata, currlyritm;
        var lyrs = map.getLayers();
        lyrs.forEach(function (ly,idx) {
            var isBase = ly.get("baseLayer");
            /* Set Base Layer Legend */
            if (isBase) {
                createBaseLayerItem(ly, $(bslid));
            }
            else {
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
            if (lySrc instanceof ol.source.TileWMS && lySrc.getParams()["LAYERS"] != undefined) {
                /* Layer */
                var ovlitem, sublist;
                if (type == "layer") {
                    ovlitem = $('<li class="list-group-item" data-layer-type="layer" data-layer-name="' + ly.get("name") + '"></li>');
                    var lyhead = $('<label class="layer-header"></label>'),
                        lyctrl = $('<label class="layer-control"></label>'),
                        btnrm = $('<button type="button" class="btn-xs btn-danger remove-layer" title="Hapus layer"><span class="glyphicon glyphicon-trash"></span></button>');
                    lyhead.append(ly.get("title"));
                    lyhead.append('<input type="checkbox" data-toggle="collapse" data-target="#' + ly.get("name") + '" />');
                    lyhead.append('<span class="toggle-indicator"></span>');
                    lyctrl.append('<input type="checkbox"' + (ly.getVisible() ? ' checked="checked"' : '') + ' aria-label="' + ly.get("title") + '" />');
                    lyctrl.append('<div class="sld round" title="Sembunyikan layer"></div>');
                    lyctrl.append(btnrm);
                    /* Confirm remove layer */
                    btnrm.click({ layer: ly, type: "layer", name: ly.get("name"), title: ly.get("title") }, confirmRemoveLayer);
                    ovlitem.append(lyhead);
                    ovlitem.append(lyctrl);
                    /* Trigger change layer visibility */
                    lyctrl.find("input").change({ layer: ly, type: "layer", name: ly.get("name") }, setLayerVisibility);
                    sublist = $('<ul id="' + ly.get("name") + '" class="overlay-sublayers list-group collapse" style="padding-top:5px"></ul>');
                    ovlitem.append(sublist);
                    $(item).find(".overlay-layers").append(ovlitem);
                } else {
                    ovlitem = $(item).find('li[data-layer-name="' + ly.get("name") + '"]');
                    sublist = ovlitem.find('#'.concat(ly.get("name")));
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
                var input = $(this).closest("ul").parent("li").find(".layer-control input[aria-label='" + layer.get("title") + "']")[0];
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
    
    /* MAP AND ALL RELATED STUFF */
    function init() {
        $("#peta").height($(window).outerHeight() - $("hr").outerHeight() - $("footer").outerHeight() - $(".navbar-header").outerHeight());
        //olm.updateSize();
        /* Info Layer & style */
        var pointimage = new ol.style.Circle({
            radius: 5,
            fill: null,
            stroke: new ol.style.Stroke({ color: 'blue', width: 2 })
        });
        var styles = {
            'Point': new ol.style.Style({
                image: pointimage
            }),
            'LineString': new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'green',
                    width: 1
                })
            }),
            'MultiLineString': new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'green',
                    width: 1
                })
            }),
            'MultiPoint': new ol.style.Style({
                image: pointimage
            }),
            'MultiPolygon': new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'blue',
                    width: 1
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 0, 0.2)'
                })
            }),
            'Polygon': new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'blue',
                    lineDash: [4],
                    width: 3
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 0, 255, 0.2)'
                })
            }),
            'GeometryCollection': new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'magenta',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'magenta'
                }),
                image: new ol.style.Circle({
                    radius: 10,
                    fill: null,
                    stroke: new ol.style.Stroke({
                        color: 'magenta'
                    })
                })
            }),
            'Circle': new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255,0,0,0.2)'
                })
            })
        };
        var styleFunction = function (feature) {
            return styles[feature.getGeometry().getType()];
        };
        /* Create an overlay to anchor the popup to the map. */
        var infopanel = document.getElementById("infopanel"),
            infopopup = new ol.Overlay({
                element: infopanel,
                autoPan: true,
                autoPanAnimation: { duration: 250 }
            }),
            infoSource = new ol.source.Vector({
                format: new ol.format.GeoJSON({
                    featureProjection: ol.proj.get('EPSG:3857'),
                })
            }),
            infoLayer = new ol.layer.Vector({
                source: infoSource,
                style: styleFunction,
                name: "info"
            });
        infoPopup = infopopup;
        /* Layer Persil */
        var plyr = new ol.layer.Tile({
            source: new ol.source.TileWMS({
                urls: WMSUrl.split(","),
                params: { LAYERS: "".concat(WMSStoreNS + ":PersilBerdasarkanJenisHak"), TILED: true, CQL_FILTER: "VALIDSAMPAI IS NULL;INCLUDE" },
                serverType: "geoserver",
                tileLoadFunction: loadMTile.bind({ lyrname: "atrbpn" })
            }),
            name: "atrbpn",
            title: "ATR/BPN Layer"
        });
        /* Add proprty 'layers' to source for further purpose */
        plyr.getSource().set("layers", [{ name: "".concat(WMSStoreNS, ":PersilBerdasarkanJenisHak"), title: "Persil Berdasarkan Jenis Hak" }, { name: "".concat(WMSStoreNS, ":ZONANILAITANAHNOLABEL"), title: "Zona Nilai Tanah", filter: "VALIDSAMPAI IS NULL" }]);
        /* Create OpenLayers Map */
        olm = new ol.Map({
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        attributions: [new ol.Attribution({ html: "<a href='//www.atrbpn.go.id/' target='_blank'><span class='glyphicon glyphicon-copyright-mark'></span>ATR/BPN RI</a>" })],
                        url: pdurl,
                        tileLoadFunction: loadMTile.bind({ lyrname: "petadasar" })
                    }),
                    name: "petadasar",
                    title: "Peta Dasar Pertanahan",
                    zIndex: 0,
                    baseLayer: true
                }),
                new ol.layer.Tile({
                    visible: false,
                    preload: Infinity,
                    baseLayer: true,
                    name: "bing",
                    title: "Bing Map Aerial",
                    zIndex: 0,
                    source: new ol.source.BingMaps({
                        key: BMK,
                        imagerySet: "AerialWithLabels"
                    })
                }),
                new ol.layer.Tile({
                    source: new ol.source.OSM(),
                    name: "osm",
                    title: "Open Street Map",
                    zIndex: 0,
                    visible: false,
                    baseLayer: true
                }),
                plyr,
                infoLayer
            ],
            overlays: [infopopup],
            target: 'peta',
            view: new ol.View({
            	center: [11888791.82, -695776.40],
                //center: [13100695.15185293, -264166.36975356936], //ol.proj.fromLonLat([4.8, 47.75]), || ol.proj.transform([117.68555, -2.372369], 'EPSG:4326', 'EPSG:3857')||ol.proj.fromLonLat([117.68555, -2.372369])
                zoom: 15
            })
        });
        /* Add Scale Line Control */
        olm.addControl(new ol.control.ScaleLine());
        olm.addControl(new ol.control.ZoomToExtent({
            extent: [10719664, -1663463, 15450199, 1252149],
            tipLabel: "Zoom Indonesia"
        }));
        /* Tile Load Function */
        function loadMTile(imageTile, src) {
            if (this.lyrname == "atrbpn") {
                imageTile.getImage().src = LayerProxy.concat(src);
            } else if (this.lyrname == "petadasar") {
                imageTile.getImage().src = src;
            }
        }
        $(".ol-zoom-extent button").html('<span class="fa fa-expand"></span>');
        /* Prepare Feature Info */
        prepareFeatureInfo(olm, infopopup, infoLayer);
    }
    /* HANDLES FOR RESIZE, MENU AND MASK */
    $(window).resize(function () {
        $("#peta").height($(window).outerHeight() - $("hr").outerHeight() - $("footer").outerHeight() - $(".navbar-header").outerHeight());
        olm.updateSize();
    });
    $(".menu-toggle").click(function (e) {
        e.preventDefault();
        $("#pmask").toggleClass("active");
        $(".peta-side-menu").toggleClass("active");
    });
    $("#pmask").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
        if ($(".peta-side-menu").hasClass("active"))
            $(".peta-side-menu").toggleClass("active");
        if ($(".query-side-menu").hasClass("active"))
            $(".query-side-menu").toggleClass("active");
    });
    $(".query-toggle").click(function (e) {
        e.preventDefault();
        $("#pmask").toggleClass("active");
        $(".query-side-menu").toggleClass("active");
    });
}(jQuery))