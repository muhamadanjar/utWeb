import React, { Component } from 'react'
export default class SideMenuMap extends Component{
    render(){
        return(
        <div className="peta-side-menu" id="wrapper">
            <div id="layer-control"></div>
            <div>
                <button type="button" className="close menu-toggle"><span className="glyphicon glyphicon-remove"></span></button>
                <h3>Legenda</h3>
            </div>
            <ul className="list-group">
                <li id="overlayitem" role="heading" className="dropdown-header">
                    Overlay
                    <ul className="overlay-layers list-group"></ul>
                </li>
                <li id="basemapitem" role="heading" className="dropdown-header">Base Map</li>
            </ul>
        </div>)
    }
}
