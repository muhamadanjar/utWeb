import React, { Component } from 'react';
import Http from '../utils/Http';
class LayerItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            layers:[],
        }
    }
    componentDidMount(){
        Http.get('/map/getdata').then((response)=>{
            this.setState({ layers:response.data});
        });
    }

    render() {
        let data = this.state.layers;
        const  { layers,layerproxy } = this.props;
        
        return (
            <div id="layer-widget">
                {data.map((layer,idx)=>{
                    let kode = layer.kodelayer.split(':')[1];
                    console.log(layer.urllayer);
                    let layerid = `{layer-kode}`;
                    let visible_lyr = `{visible_kode}`;
                    let wmsUrl = layer.urllayer;
                    let s = '';
                    let lSrc = s.concat(wmsUrl, "?request=GetLegendGraphic&format=image/png&transparent=true&layer="+layer.kodelayer)
                    return(<li key={idx} className="list-group-item" id={'layer-'+kode}>
                        <label>
                            <input type="checkbox" id={'visible_'+kode} className="visible" />
                            {layer.namalayer}
                        </label>
                        <div className="btn btn-group control-right">
                            <span className="btn btn-primary btn-sm transparan">Transparan</span>
                            <span className="btn btn-success btn-sm legenda">Legenda</span>
                            <span className="btn btn-info btn-sm zoom" data-layer="geodata:Administrasi_Kecamatan_Kota_Bogor">Zoom</span>
                        </div>
                        <fieldset id="opacity">
                            <input className="opacity" type="range" min="0" max="1" step="0.01" /></fieldset>
                        <fieldset id="legend">
                            <img src={lSrc} alt="Legenda" />
                        </fieldset>
                    </li>);
                })}
            </div>
        )
        
    }
}
export default LayerItem;
