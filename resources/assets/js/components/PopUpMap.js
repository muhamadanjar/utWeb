import React, { Component } from 'react'
export default class PopUpMap extends Component{
    render(){
        return(
            <div id="popup" className="ol-popup slimcroll">
                    <a href="#" id="popup-closer" className="ol-popup-closer">
                        <button type="button" className="btn btn-sm btn-primary"><i className="fa fa-close"></i></button>
                    </a>
                    <div id="popup-content"></div>
                </div>
        );
    }
}
