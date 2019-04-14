<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MulutBusuk\Workspaces\Repositories\Eloquent\Map\Layer;
use MulutBusuk\Workspaces\Repositories\Eloquent\Map\Informasi;
use MulutBusuk\Workspaces\Repositories\Eloquent\Map\RepositoryInterface;
use DB;
class MapCtrl extends Controller{
    public function __construct(RepositoryInterface $layer){
        $this->layer = $layer;
    }
    public function getIndex(){
        session(['link_web'=>'si']);
        return view('backend.maps.op');
    }

    public function getViewer(){
        $layer = $this->getLayer();
        $identify = $this->getIdentify();
        return view('map.esri')->with('layer',$layer)->with('identify',$identify);
    }


    public function getOpMap(){
        return view('frontend.map.op');
    }

    public function getData(){
        $layer = Layer::join('layer as _l', 'layer.id', '=', '_l.parent_id')
		->select(
            DB::raw('layer.id AS id_group'),
            DB::raw('layer.namalayer AS namagroup'),
            DB::raw('layer.kodelayer AS kodegroup'),
            '_l.*'
		)->where('_l.aktif',1)->orderBy('_l.urutanlayer','DESC')->get();
        
        return $layer;
    }

    public function getDataGroup(){
        $layer = Layer::where('tipelayer','olgroup')->whereAktif(1)->orderBy('urutanlayer','DESC')->get();
        return json_encode($layer);
    }

    public function searchData(Request $request){
        $term = $request->term;
        $data = array();
        // buat database dan table provinsi
        //$query = "SELECT * FROM provinsi WHERE provinsi LIKE '%$term%' LIMIT 5";
        $q = DB::table('poi_pandeglang')
            ->whereRaw('UPPER(name) LIKE ? ',array('%'.strtoupper($term).'%'))
            ->limit('15')->get();
        foreach ($q as $key => $value) {
            $data[] = array('id'=>$value->gid,
                    'label'=>$value->name,
                    'value'=>$value->name
            );
        }
        return json_encode($data);

    }

    public function getLayer(){
        $layers = Layer::where('aktif','=','1')->where('tipelayer','esri')->orderBy('urutanlayer','DESC');

		$sql = $layers->toSql();
		$run_layers = $layers->get();

		$array = array(); $operationallayer = array();
			foreach ($run_layers as $klyr => $layer) {
				$optionfeature['id'] = $layer->kodelayer;
				$optionfeature['opacity'] = $layer->option_opacity;
				$optionfeature['visible'] = $layer->option_visible;
				$optionfeature['outFields'] = ['*'];
				$optionfeature['mode'] = 1;

			    $optiondynamic['id'] = $layer->kodelayer;
			    $optiondynamic['opacity'] = $layer->option_opacity;
			    $optiondynamic['visible'] = $layer->option_visible;
			    $optiondynamic['outFields'] = ['*'];
			    //$optiondynamic['imageParameters'] = '';

			    $layerControlLayerInfos['swipe'] = true;
			    $layerControlLayerInfos['metadataUrl'] = true;
			    $layerControlLayerInfos['expanded'] = false;

			    $options = ($layer->tipelayer=='esri' ?  $optiondynamic : $optionfeature);

			    $operationallayer_['type'] = 'dynamic';
			    $operationallayer_['url'] =  $layer->urllayer;
			    $operationallayer_['title'] = $layer->namalayer;
			    $operationallayer_['options'] = $options;
			    //$operationallayer_['layerControlLayerInfos'] = $layerControlLayerInfos;

			    //$layerIds = ['layerIds' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]];
			    //$operationallayer_['identifyLayerInfos'] = $layerIds;
			    $operationallayer_['roles'] = $layer->roles;
			    array_push($operationallayer, $operationallayer_);
			}

		return json_encode($operationallayer);
    }

    public function getIdentify(){
		$identify = Informasi::orderBy('layerid','ASC')->get();
		$url = url();
		$link = '';
		$arrayname = array();
		$arraylayerid = array();
		$arrayfieldinfo = array(); $arrayfieldinfos = array();
		$n = array();
		foreach ($identify as $key => $value) {
			unset($arraylayerid);
			unset($arrayfieldinfos);
			$kodec = base64_encode($value['tablename']);
			$value['keydata'] = json_decode($value['keydata']);
			$value['media'] = json_decode($value['media']);
			$arrayfieldinfo = $value['key_'];

			$arrayfieldinfos['title'] = $value->title;
			if ($value['display'] == 'keyvalue') {
				$arrayfieldinfos['fieldInfos'] = $arrayfieldinfo;
			}else{
				$arrayfieldinfos['description'] = $value['description'].$link;
			}
			$arrayfieldinfos['showAttachments'] = $value['showattachments'];
			$arrayfieldinfos['mediaInfos'] = $value['media'];

			$arraylayerid[(int)$value['layerid']] = $arrayfieldinfos;
			if(array_key_exists($value['namalayer'],$arrayname)){
				$arrayname[$value['namalayer']] += $arraylayerid;
			}else{
				$arrayname[$value['namalayer']] = $arraylayerid;
			}

		}
		return json_encode($arrayname);
	}

    public function get3D(){
        return view('map.3d');
    }

	public function getLayerInformasi($kodelayer=null)
    {
        $data = Informasi::where('layername',$kodelayer)->first();
        return response()->json($data,200);
    }
}