<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MulutBusuk\Workspaces\Repositories\Traits\ServerInformasi;
use Illuminate\Support\Facades\Auth;
use App\Jalan\Models\Jalan;
use App\Jalan\Models\JalanDetil;
use Carbon\Carbon;
use DataTables;
use DB;
use Config;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\RepositoryInterface as StatistikRepository;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\RepositoryInterface as ModeratorRepository;
use App\Jalan\Contracts\RepositoryInterface as JalanRepository;
class ApiCtrl extends Controller
{
    use ServerInformasi;
    public function __construct(StatistikRepository $sr,ModeratorRepository $md,JalanRepository $jalan)
    {
        $this->statistikrepo = $sr;
        $this->moderatorrepo = $md;
        $this->jalanrepo = $jalan;
    }
    function getprovinsi($id = '')
    {
        $provinsi = DB::table('wilayah_provinsi')->orderBy('nama_provinsi', 'ASC')->get();
        return response()->json(['data' => $provinsi], 200);
    }

    function getkabupaten($id = '')
    {
        $kabupaten = DB::table('wilayah_kabupaten')->where('kode_prov', $id)->orderBy('nama_kabupaten', 'ASC')->get();
        return response()->json(['data' => $kabupaten], 200);
    }
    public function getkecamatan($id)
    {
        # 
        if (strpos($id, ',') !== false) {
            $id = explode(',', $id);
        } else {
            $id = array($id);
        }
        $kecamatan = DB::table('wilayah_kecamatan')->whereIn('kode_kab', $id)->get();
        return response()->json(['data' => $kecamatan], 200);
    }

    public function getdesa($id='')
    {
        if (strpos($id,',')) {
            $ex = explode(',',$id);
            $l = [];$t = [];
            foreach($ex as $a){
                $l[] += intval($a);
                array_push($t,'?');
            }
            $w = 'kode_kec in('.join(',',$t).')';
        }else{
            $w = 'kode_kec = ?';
            $l = array($id);
        }
        $desa = DB::table('wilayah_desa')->whereRaw($w, $l)->get();
        
        return response()->json(['data' => $desa], 200, [], JSON_NUMERIC_CHECK);
    }
    public function serverinformasi()
    {
        $memory = $this->shapeSpace_memory_usage();
        $countproc = $this->shapeSpace_number_processes();
        $server_uptime = $this->shapeSpace_server_uptime();
        $kernel_version = $this->shapeSpace_kernel_version();
        $diskusage = $this->shapeSpace_disk_usage();
        $server_memory_usage = $this->shapeSpace_server_memory_usage();
      // $http_connections=$this->shapeSpace_http_connections();
        $system_cores = $this->shapeSpace_system_cores();
        $system_load = $this->shapeSpace_system_load();

        return response()->json([
            'memory' => $memory,
            'countproc' => $countproc,
            'server_uptime' => $server_uptime,
            'kernel_version' => $kernel_version,
            'diskusage' => $diskusage,
            'server_memory_usage' => $server_memory_usage,
        // 'http_connections'=>$http_connections,
            'system_cores' => $system_cores,
            'system_load' => $system_load,
        ], 200);
    }
    public function login()
    {
        if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $user->api_token = $success['token'];
            $user->latest_login = Carbon::now();
            $user->save();
            return response()->json(['success' => true, 'data' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => true, 'message' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            return response()->json(['success' => true, 'data' => $user], $this->successStatus);
        }
        return response()->json(['error' => true, 'message' => 'Data Tidak ada'], $this->successStatus);

    }
    public function getUser()
    {
        $user = User::orderBy('id');
        $countuser = $user->count();
        return response()->json(['user' => $user, 'countuser' => $countuser], 200);
    }

    public function getDTJalan(Request $request)
    {
        $connection = config('database.default');
        if ($connection == 'pgsql' || 'pgsqlheroku') {
            $jalan = Jalan::orderBy('jalan.id')
                ->select(
                    'jalan.id',
                    'jalan.no_ruas',
                    'nama_ruas',
                    DB::raw('concat(ROUND((panjang)::numeric,2),\' Km\') as panjang'),
                    DB::raw('concat(ROUND((lebar)::numeric,2),\' m\') as lebar'),
                    DB::raw('CASE WHEN akses_jalan=\'N\' THEN \'Nasional\' WHEN akses_jalan=\'P\' THEN \'Provinsi\' ELSE \'Kabupaten\' END AS akses_jalan'),
                    DB::raw('(ROUND((ptjp_aspal)::numeric,2)) as ptjp_aspal'),
                    DB::raw('CASE WHEN ptjp_beton is not null THEN (ROUND((ptjp_beton)::numeric,2)) ELSE 0 END as ptjp_beton'),
                    DB::raw('CASE WHEN ptjp_kerikil is not null THEN (ROUND((ptjp_kerikil)::numeric,2)) ELSE 0 END as ptjp_kerikil'),
                    DB::raw('CASE WHEN ptjp_tanah is not null THEN (ROUND((ptjp_tanah)::numeric,2)) ELSE 0 END as ptjp_tanah'),
                    'no_ruas_pangkal',
                    'no_ruas_ujung',
                    'pembiayaan',
                    'akses_jalan',
                    'tahun',
                    'jalan.kode_kec'
                );
        } else {
            $jalan = Jalan::leftjoin('wilayah_kecamatan', 'jalan.kode_kec', '=', 'wilayah_kecamatan.kode_kec')
                ->orderBy('jalan.id')
                ->select(
                    'jalan.id',
                    'jalan.no_ruas',
                    'nama_ruas',
                    DB::raw('concat(panjang),\' Km\') as panjang'),
                    DB::raw('concat(lebar),\' m\') as lebar'),
                    DB::raw('CASE WHEN akses_jalan=\'N\' THEN \'Nasional\' WHEN akses_jalan=\'P\' THEN \'Provinsi\' ELSE \'Kabupaten/Kota\' END AS akses_jalan'),
                    DB::raw('(ROUND((ptjp_aspal)::numeric,2)) as ptjp_aspal'),
                    DB::raw('CASE WHEN ptjp_beton is not null THEN (ROUND((ptjp_beton)::numeric,2)) ELSE 0 END as ptjp_beton'),
                    DB::raw('CASE WHEN ptjp_kerikil is not null THEN (ROUND((ptjp_kerikil)::numeric,2)) ELSE 0 END as ptjp_kerikil'),
                    DB::raw('CASE WHEN ptjp_tanah is not null THEN (ROUND((ptjp_tanah)::numeric,2)) ELSE 0 END as ptjp_tanah'),
                    'no_ruas_pangkal',
                    'no_ruas_ujung',
                    'wilayah_kecamatan.nama_kecamatan'
                );
        }

        return Datatables::of($jalan)
            ->editColumn('akses_jalan', function ($data) {
                $aj = $data->akses_jalan;
                if ($aj == 'N') {
                    $status = 'Nasional';
                } else if ($aj == 'P') {
                    $status = 'Provinsi';
                } else {
                    $status = 'Kabupaten / Kota';
                }
                return $status;
            })
            ->addColumn('action', function ($data) {
                if (auth('api')->user()->isSuper() || auth('api')->user()->isRole('admin')  ) {
                    return '<div class="input-group-btn"><button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="' . route('backend.jalan.formskj', [$data->id]) . '" class="btn-skj dropdown-item"><i class="fa fa-road"></i> SKJ</a></li>
                        <li><a href="#" class="btn-stripmap dropdown-item"><i class="fa fa-road" style="color:#DE0"></i> Stripmap</a></li>
                        <li class="divider"></li>
                        <li><a href="' . route('backend.jalan.edit', [$data->id]) . '" class="btn-edit dropdown-item"><i class="fa fa-edit"></i> Edit</a></li>
                        <li><a href="#" class="btn-delete dropdown-item"><i class="fa fa-trash"></i> Hapus</a></li>
                    </ul>
                    </div>
                ';
                }
                return '<div class="btn-group"><a href="' . route('backend.jalan.viewjalan', [$data->id]) . '" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Lihat</a></div>';
            })
            ->addColumn('nama_kecamatan', function ($data) {
                $json = $this->getkecamatan(3271);
                $s = [];
                $r = [];
                $a = json_decode(json_encode($json), true);

                foreach ($a['original']['data'] as $k) {
                    $s[] = $k['kode_kec'];
                    $r[] = $k['nama_kecamatan'];
                }
                return str_replace($s, $r, $data->kode_kec);
            })
            ->filter(function ($query)
                use ($request) {
                if ($request->has('q')) {
                    $query
                        ->whereRaw('UPPER(jalan.no_ruas) like ?', array(strtoupper("%{$request->get('q')}%")))
                        ->orWhereRaw('UPPER(jalan.nama_ruas) like ?', array(strtoupper("%{$request->get('q')}%")))
                        ->orWhereRaw('UPPER(jalan.akses_jalan) like ?', array(strtoupper("%{$request->get('q')}%")));
                }
            })
            ->make(true);
    }
    public function getDTJalanKondisiJalan(Request $request)
    {
        $connection = config('database.default');
        if ($connection == 'pgsql' || 'pgsqlheroku') {
            $jalan = JalanKondisi
                ::orderBy('jalan_kondisi.id')->groupBy('jalan_kondisi.id')
                ->select(
                    'jalan_kondisi.id',
                    'jalan_kondisi.no_ruas',
                    'nama_ruas',
                    DB::raw('concat(panjang,\' Km\') as panjang'),
                    DB::raw('concat(ROUND((lebar)::numeric,2),\' m\') as lebar'),
                    'kecamatan_dilalui',
                    'tahun',
                    'pembiayaan',
                    DB::raw('REPLACE(SUM(CAST(biaya as money))::character varying,\'$\',\'Rp. \') as biaya'),
                    DB::raw('CASE WHEN jenis=\'1\' THEN \'Pemeliharaan\' WHEN jenis=\'2\' THEN \'Peningkatan\' ELSE \'Pembangunan\' END AS jenis'),
                    DB::raw('substring(ket,0,250) as ket'),
                    DB::raw('row_number() OVER (ORDER BY jalan_kondisi.id) AS no')
                );
        } else {
            $jalan = Jalan::select();
        }

        return Datatables::of($jalan)
            ->addColumn('action', function ($data) {

                if (auth('api')->user()->hasRole('superadmin')) {
                    return '<div class="input-group-btn"><button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="' . route('backend.jalankondisi.edit', [$data->id]) . '" class="btn-edit"><i class="fa fa-edit"></i> Edit</a></li>
                        <li><a href="#" class="btn-delete"><i class="fa fa-trash"></i> Hapus</a></li>
                    </ul>
                    </div>
                ';
                }
                return '<div class="btn-group"><a href="' . route('backend.jalan.viewjalan', [$data->id]) . '" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Lihat</a></div>';
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('q')) {
                    $query
                        ->whereRaw('UPPER(jalan_kondisi.no_ruas) like ?', array(strtoupper("%{$request->get('q')}%")))
                        ->orWhereRaw('UPPER(jalan_kondisi.nama_ruas) like ?', array(strtoupper("%{$request->get('q')}%")))
                        ->orWhereRaw('cast(jalan_kondisi.tahun as CHARACTER VARYING) like ?', array("%" . $request->get('q') . "%"))
                        ->orWhereRaw('UPPER(jalan_kondisi.pembiayaan) like ?', array(strtoupper("%{$request->get('q')}%")))
                        ->orWhereRaw('UPPER(jalan_kondisi.jenis) like ?', array(strtoupper("%{$request->get('q')}%")));
                }
            })
            ->make(true);
    }
    public function getDetilJalanDT($id)
    {
        $jalan = JalanDetil::where('jalan_id', $id)->orderBy('id', 'DESC')->select();
        return Datatables::of($jalan)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group"><a class="btn btn-edit btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a><a class="btn btn-delete btn-xs btn-danger" data-title="Hapus Detil ini?" data-message="Yakin ?"><i class="fa fa-trash"></i> Hapus</a></div>';
            })->make(true);
    }

    public function getskjTableSummary(Request $request)
    {
        $data = [];
        $retak_luas = $request->get('retak_luas');
        $retak_lebar = $request->get('retak_lebar');
        $jumlah_lubang = $request->get('jumlah_lubang');
        $bekasroda = $request->get('bekasroda');
        if ($retak_luas == 1) {
            $sdi_retakluas = 0;
        } else if ($retak_luas == 2) {
            $sdi_retakluas = 5;
        } else if ($retak_luas == 3) {
            $sdi_retakluas = 20;
        } else if ($retak_luas == 4) {
            $sdi_retakluas = 40;
        } else {
            $sdi_retakluas = 0;
        }
        $sdi_retaklebar = ($retak_lebar == 4) ? $sdi_retakluas * 2 : 0;
        $bantu = ($sdi_retaklebar == 0) ? $sdi_retakluas : $sdi_retaklebar;

        if ($jumlah_lubang == 1) {
            $sdi_jumlahlubang = $bantu;
        } else if ($jumlah_lubang == 2) {
            $sdi_jumlahlubang = $bantu + 15;
        } else if ($jumlah_lubang == 3) {
            $sdi_jumlahlubang = $bantu + 75;
        } else if ($jumlah_lubang == 4) {
            $sdi_jumlahlubang = $bantu + 255;
        } else {
            $sdi_jumlahlubang = 0;
        }

        if ($bekasroda == 1) {
            $sdi_bekasroda = $sdi_jumlahlubang;
        } else if ($bekasroda == 2) {
            $sdi_bekasroda = $sdi_jumlahlubang + (5 * 0.5);
        } else if ($bekasroda == 3) {
            $sdi_bekasroda = $sdi_jumlahlubang + (5 * 2);
        } else if ($bekasroda == 4) {
            $sdi_bekasroda = $sdi_jumlahlubang + (5 * 4);
        } else {
            $sdi_bekasroda = 0;
        }
        $nilai_sdi = ($sdi_bekasroda > 0) ? $sdi_bekasroda : 0;

        $data['sdi_retak_luas'] = $sdi_retakluas;
        $data['sdi_retak_lebar'] = $sdi_retaklebar;
        $data['sdi_jumlahlubang'] = $sdi_jumlahlubang;
        $data['sdi_bekasroda'] = $sdi_bekasroda;
        $data['nilai_sdi'] = $nilai_sdi;
        return $data;

    }

    public function getSdiIri(Request $request)
    {
        $data = [];
        $sampai_km = $request->get('sampai_km');
        $dari_km = $request->get('dari_km');
        $nilai_sdi = (int)$request->get('nilai_sdi');
        $nilai_iri = $request->get('nilai_iri');

        $panjang_km = $sampai_km - $dari_km;
        $baik = 0;
        $sedang = 0;
        $rusakringan = 0;
        $rusakberat = 0;
        if ($nilai_sdi <= 50 && $nilai_iri < 4) {
            $baik = $panjang_km;
            $sedang = 0;
            $rusakringan = 0;
            $rusakberat = 0;
        } else if ($nilai_sdi <= 50 && ($nilai_iri >= 4 || $nilai_iri < 8)) {
            $baik = 0;
            $sedang = $panjang_km;
            $rusakringan = 0;
            $rusakberat = 0;
        } else if ($nilai_sdi <= 50 && ($nilai_iri >= 8 || $nilai_iri < 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = $panjang_km;
            $rusakberat = 0;
        } else if ($nilai_sdi <= 50 && ($nilai_iri >= 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = 0;
            $rusakberat = $panjang_km;
        } else if ($nilai_sdi >= 50 && $nilai_sdi <= 100 && ($nilai_iri < 4)) {
            $baik = 0;
            $sedang = $panjang_km;
            $rusakringan = 0;
            $rusakberat = 0;
        } else if ($nilai_sdi >= 50 && $nilai_sdi <= 100 && ($nilai_iri >= 4 || $nilai_iri < 8)) {
            $baik = 0;
            $sedang = $panjang_km;
            $rusakringan = 0;
            $rusakberat = 0;
        } else if ($nilai_sdi >= 50 && $nilai_sdi <= 100 && ($nilai_iri >= 8 || $nilai_iri < 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = $panjang_km;
            $rusakberat = 0;
        } else if ($nilai_sdi >= 50 && $nilai_sdi <= 100 && ($nilai_iri >= 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = 0;
            $rusakberat = $panjang_km;
        } else if ($nilai_sdi > 100 && $nilai_sdi <= 150 && ($nilai_iri < 4)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = $panjang_km;
            $rusakberat = 0;
        } else if ($nilai_sdi > 100 && $nilai_sdi <= 150 && ($nilai_iri >= 4 || $nilai_iri < 8)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = $panjang_km;
            $rusakberat = 0;
        } else if ($nilai_sdi > 100 && $nilai_sdi <= 150 && ($nilai_iri >= 8 || $nilai_iri < 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = $panjang_km;
            $rusakberat = 0;
        } else if ($nilai_sdi > 100 && $nilai_sdi <= 150 && ($nilai_iri >= 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = 0;
            $rusakberat = $panjang_km;
        } else if ($nilai_sdi > 150 && (($nilai_iri < 4)) || ($nilai_iri >= 4 || $nilai_iri < 8) || ($nilai_iri >= 8 || $nilai_iri < 12) || ($nilai_iri >= 12)) {
            $baik = 0;
            $sedang = 0;
            $rusakringan = 0;
            $rusakberat = $panjang_km;
        }

        $mantap = $baik + $sedang;
        $tdkmantap = $rusakringan + $rusakberat;
        $data['nilai_sdi'] = $nilai_sdi;
        $data['panjang'] = $panjang_km;
        $data['baik'] = $baik;
        $data['sedang'] = $sedang;
        $data['rusakringan'] = $rusakringan;
        $data['rusakberat'] = $rusakberat;
        $data['mantap'] = $mantap;
        $data['tdkmantap'] = $tdkmantap;


        return $data;

    }

    public function getDiagramTahunan()
    {
        $data = DB::table('jalan_kondisi')->select(
            DB::raw('cast(tahun as VARCHAR)'),
            DB::raw('SUM(CASE WHEN jenis=\'1\' then panjang ELSE 0 END ) as perbaikan'),
            DB::raw('SUM(CASE WHEN jenis=\'2\' then panjang ELSE 0 END ) as peningkatan'),
            DB::raw('SUM(CASE WHEN jenis=\'3\' then panjang ELSE 0 END ) as pembangunan'),
            // DB::raw('CASE WHEN jenis=\'1\' then \'Perbaikan\' WHEN jenis=\'2\' then \'Peningkatan\' ELSE \'Pembangunan\' END as jenis'),
            DB::raw('SUM(panjang) as panjang')
        )->groupBy('tahun')
            ->orderBy('tahun')
            ->whereBetween('tahun', array(Carbon::now()->year, Carbon::now()->addYears(10)->year))
            ->get();
        $jenis = array('Pemeliharaan', 'Peningkatan', 'Pembangunan');
        $array = array();
        $datapanjang = array();
        $category = array();
        return $data;
    }

    public function getDiagramTahunanNominal()
    {
        $data = DB::table('jalan_kondisi')->select(
            DB::raw('cast(tahun as VARCHAR)'),
            DB::raw('SUM(CASE WHEN jenis=\'1\' then biaya ELSE 0 END ) as perbaikan'),
            DB::raw('SUM(CASE WHEN jenis=\'2\' then biaya ELSE 0 END ) as peningkatan'),
            DB::raw('SUM(CASE WHEN jenis=\'3\' then biaya ELSE 0 END ) as pembangunan'),
            // DB::raw('CASE WHEN jenis=\'1\' then \'Perbaikan\' WHEN jenis=\'2\' then \'Peningkatan\' ELSE \'Pembangunan\' END as jenis'),
            DB::raw('SUM(biaya) as biaya')
        )->groupBy('tahun')
            ->orderBy('tahun')
            ->whereBetween('tahun', array(Carbon::now()->year, Carbon::now()->addYears(10)->year))
            ->get();
        $jenis = array('Pemeliharaan', 'Peningkatan', 'Pembangunan');
        $array = array();
        $datapanjang = array();
        $category = array();
        return $data;
    }

    function multiKeyExists(array $arr, $key)
    {
        // is in base array?
        if (array_key_exists($key, $arr)) {
            return true;
        }

        // check arrays contained in this array
        foreach ($arr as $element) {
            if (is_array($element)) {
                if ($this->multiKeyExists($element, $key)) {
                    return true;
                }
            }

        }

        return false;
    }

    public function checktahun($tahun){
        $category = array();
        for ($i = 0; $i < 10; $i++) {
            $tahun = Carbon::now()->addYears($i)->year;
            array_push($category, $tahun);
        }
        foreach ($category as $key => $value) {
            if ($tahun == $value) {
                return true;
            }
            return false;
        }

    }

    function curl_get_contents($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function statistiktahun(){
        $a = $this->statistikrepo->statistikByTahun();
        return response()->json(['Bulan'=>[$a[0]->januari,$a[0]->februari,$a[0]->maret,$a[0]->april,$a[0]->may,$a[0]->juni,$a[0]->juli,$a[0]->agustus,$a[0]->september,$a[0]->oktober,$a[0]->november,$a[0]->desember]]);
    }

    public function userUpdateLocation(Request $request){
        $user = Auth::guard('api');
        $this->moderatorrepo($user->id,$request);
        return response()->json($user,200);
    }

    public function getChartJenisJalan(){
        $a =  $this->jalanrepo->getJenisSumJalan();
        return response()->json($a);
    }

    public function getChartKondisiJalan(){
        $a =  $this->jalanrepo->getKondisiSumJalan();
        return response()->json($a);
    }

    public function getJalan(){
        $jalan = $this->jalanrepo->Paginate(20);
        return response()->json($jalan);
    }

    public function getKondisiJalanDetil()
    {
        $a=$this->jalanrepo->getKondisiJalanDetil();
        $arr = array();
        foreach($a as $k=>$b){
            $arr[$b->tipe] = [$b->baik,$b->sedang,$b->rusakringan,$b->rusakberat];
        }
        return response()->json($arr);
        
    }
}
