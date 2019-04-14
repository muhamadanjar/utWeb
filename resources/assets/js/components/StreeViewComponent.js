import React, { Component } from 'react'
class StreetViewComponent extends Component{
    componentDidMount(){}
    componentWillUpdate(){}
    view_streetview(obj) {
        var coord4326 = ol.proj.transform(obj.coordinate, 'EPSG:3857', 'EPSG:4326'),   
        template = 'Coordinate is ({x} | {y})',
        iconStyle = new ol.style.Style({
          image: new ol.style.Icon({ scale: .6, src: 'img/pin_drop.png' }),
          text: new ol.style.Text({
            offsetY: 25,
            text: ol.coordinate.format(coord4326, template, 2),
            font: '15px Open Sans,sans-serif',
            fill: new ol.style.Fill({ color: '#111' }),
            stroke: new ol.style.Stroke({ color: '#eee', width: 2 })
          })
        }),
        feature = new ol.Feature({
          type: 'removable',
          geometry: new ol.geom.Point(obj.coordinate)
        });
        $('#formModalMap').find('.modal-title').html('Street View');
        $('#street-view').css({'height':'400px'}).appendTo($('#formModalMap').find('.modal-body'));
        
        $('#formModalMap').modal();
        initializePanorama(coord4326);
        
    }
    initializePanorama(coord) {
        if(coord == null) {lat = -6.6033115;lng=106.798036;
        }else {lat = coord[1];lng=coord[0];}
        panorama = new google.maps.StreetViewPanorama(
            document.getElementById('streetview'),{
            position: {lat: lat, lng: lng},
            pov: {heading: 165, pitch: 0},
            zoom: 1
        });
    }
    render(){
        return(
            <div className="streetview" id="streetview">

            </div>
        )
    }
}
export default StreetViewComponent