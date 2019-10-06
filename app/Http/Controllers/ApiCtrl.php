<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MulutBusuk\Workspaces\Repositories\Traits\ServerInformasi;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use DataTables;
use DB;
use Config;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\RepositoryInterface as StatistikRepository;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\RepositoryInterface as ModeratorRepository;
use App\User;
use App\Trip;
use App\Promo;
use App\Setting;
use App\UserLocation;
use App\UserProfile;
use App\ServiceType;
class ApiCtrl extends Controller
{
    use ServerInformasi;
    private $successStatus = 200;
    public function __construct(StatistikRepository $sr,ModeratorRepository $md){
        $this->statistikrepo = $sr;
        $this->moderatorrepo = $md;
        
    }
    function getprovinsi($id = ''){
        $provinsi = DB::table('wilayah_provinsi')->orderBy('nama_provinsi', 'ASC')->get();
        return response()->json(['data' => $provinsi], 200);
    }

    function getkabupaten($id = ''){
        $kabupaten = DB::table('wilayah_kabupaten')->where('kode_prov', $id)->orderBy('nama_kabupaten', 'ASC')->get();
        return response()->json(['data' => $kabupaten], 200);
    }
    public function getkecamatan($id){
        if (strpos($id, ',') !== false) {
            $id = explode(',', $id);
        } else {
            $id = array($id);
        }
        $kecamatan = DB::table('wilayah_kecamatan')->whereIn('kode_kab', $id)->get();
        return response()->json(['data' => $kecamatan], 200);
    }

    public function getdesa($id=''){
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
        
        return response()->json(['status'=>true,'data' => $desa], 200, [], JSON_NUMERIC_CHECK);
    }
    public function serverinformasi(){
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


    //Auth
    public function login(Request $request){
        try {
            $r_user = request('username');
            $user_email = (filter_var($r_user,FILTER_VALIDATE_EMAIL)) ? 'email' : 'username' ;
            if (Auth::attempt([$user_email => $r_user, 'password' => request('password')])) {
                $user = Auth::user();
                $token = $user->createToken('MyApp')->accessToken;
                $user->api_token = $token;
                $user->latestlogin = Carbon::now();
                $user->save();
                $du = User::join('user_profile','user_profile.user_id','users.id')
                ->where('users.id',$user->id)
                    ->select('users.*','user_profile.wallet')->first();
                $response['status'] = true;
                $response['error'] = false;
                $response['data']['token'] = $token;
                $response['data']['user'] = $du;
                $response['data']['roles'] = $user->roles;
                $response['token'] = $token;
                $response['expiresIn'] = 3600;
                
                
                return response()->json($response, $this->successStatus);
            } else {
                return response()->json(['status' => false,'error'=>true, 'message' => 'Unauthorised'], 401);
            }
            
        } catch (\Exception $th) {
            return response()->json(['error' => true,'status'=>false, 'message' => $th->getMessage()],400);
        }
        
    }
    public function register(Request $request){
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'no_telepon' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);
            if ($validator->fails()) {
                DB::rollback();
                return response()->json(['status'=>false,'error' => $validator->errors()], 200);
            }
            
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $_user = User::find($user->id);
                
            $profile = new UserProfile(['user_id'=>$user->id,'wallet'=>0,'rate'=>0,'no_telepon'=>$request->no_telepon]);
            $profile->user()->associate($user)->save();
            $user->assignRole('customer');
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['user'] = $_user;
            DB::commit();
            return response()->json(['status'=>true,'data' => $success], $this->successStatus);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>false,'message' => $e->getMessage()], 500);
        }
        
    }
    public function details(){
        $user = Auth::guard('api')->user();
        if ($user) {
            $profile = $user->profile->toArray();
            $mobil = $user->mobil->toArray();
            $ar_user = $user->toArray();
            $ar = array_merge($ar_user,$profile,$mobil);
            return response()->json(['status' => true, 'data' => $ar], $this->successStatus);
        }
        return response()->json(['error' => true, 'message' => 'Data Tidak ada'], $this->successStatus);

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

    public function curl_get_contents($url){
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
        try {
            $user = Auth::guard('api')->user();
            if($user){
                $this->moderatorrepo->updateUserLocation($user->id,$request);
                return response()->json(['status'=>true,'data'=>$user,'message'=>'driver telah update lokasi'],200);
            }else{
                return response()->json(['status'=>false,'message'=>'User tidak di temukan']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status'=>false,'message'=>$th->getMessage()]);
        }
        
    }
    public function userTopUpWallet(Request $request){
        try {
            $user = Auth::guard('api')->user();
            $up = UserProfile::where('user_id',$user->id)->first();
            if($up != null){
                $up->wallet = $request->wallet;
                $up->save();
            }else{
                $up =  new UserProfile();
                $up->user_id = $user->id;
                $up->wallet = $request->wallet;
                $up->save();
            }
            return response()->json(['status'=>true,'message'=>'Anda Berhasil Menambah Dana']);    
        } catch (\Exception $e) {
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);    
        }
        
    }
    public function userChangeOnline(){
        try {
            $user = Auth::guard('api')->user();
            $profile = UserProfile::where('user_id',$user->id)->first();
            if($profile !== null){
                $isonline = $user->profile;
                $profile = DB::table('user_profile')
                ->where('user_id',$user->id)
                ->update(['isonline'=>!$isonline->isonline]);    
            }else{
                $p = new UserProfile();
                $p->user_id = $user->id;
                $p->isonline = 1;
                $p->save();
            }
            return response()->json(['status'=>true,'data'=>$profile,'message'=>'Data Online Berhasil di ubah']);
        } catch (\Exception $e) {
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function PostBooking(Request $request){
        DB::beginTransaction();
        try {
            $trip = new Trip();
            $trip->trip_code = date('YmdHis');
            $trip->trip_job = $request->job;
            $trip->trip_bookby = $request->trip_bookby;
            $trip->trip_address_origin = $request->trip_address_origin;
            $trip->trip_address_destination = $request->trip_address_destination;
            $trip->trip_date = date('Y-m-d');
            $trip->trip_type = 2;
            $trip->trip_status = 0;
            $trip->trip_total = $request->trip_total;
            $trip->save();
                $td = [
                    'trip_id'=>$trip->getKey(),
                    'trip_or_latitude'=>$request->trip_or_latitude,
                    'trip_or_longitude'=>$request->trip_or_longitude,
                    'trip_des_latitude'=>$request->trip_des_latitude,
                    'trip_des_longitude'=>$request->trip_des_longitude,
                    'duration' => $request->duration,
                    'distance' => $request->distance
                ];
                DB::table('trip_detail')->insert(
                    $td
                );
            DB::commit();    
            return response()->json(['status'=>true,'data'=>$trip],200);
        } catch (ValidationException $e) {
            DB::rollback();
        } catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        
    }
    public function updateTripStatus(Request $request){
        try {
            $t = Trip::find($request->trip_id);
            if ($t == NULL) { return response()->json(['status'=>false,'message'=>'Data Trip tidak di temukan']);}
            $t->trip_status = $request->status;
            $t->save();
            return response()->json(['status'=>true,'message'=>'Status Trip {$t->trip_code}']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>false,'message'=>$th->getMessage()]);
        }
        
    }
    public function postReguler(Request $request){
        DB::beginTransaction();
        try {
            $trip = new Trip();
            $trip->trip_code = date('YmdHis');
            $trip->trip_job = $request->job;
            $trip->trip_bookby = $request->trip_bookby;
            $trip->trip_address_origin = $request->trip_address_origin;
            $trip->trip_address_destination = $request->trip_address_destination;
            $trip->trip_date = date('Y-m-d H:i:s');
            $trip->trip_type = 2;
            $trip->trip_status = Trip::STATUS_PENDING;
            $trip->trip_total = $request->trip_total;
            $trip->save();
                $td = [
                    'trip_id'=>$trip->getKey(),
                    'trip_or_latitude'=>$request->trip_or_latitude,
                    'trip_or_longitude'=>$request->trip_or_longitude,
                    'trip_des_latitude'=>$request->trip_des_latitude,
                    'trip_des_longitude'=>$request->trip_des_longitude,
                    'duration' => $request->duration,
                    'distance' => $request->distance,
                    'rp'=> $request->rent_package
                ];
                DB::table('trip_detail')->insert(
                    $td
                );
            
            DB::commit();    
            return response()->json(['status'=>true,'data'=>$trip],200);
        } catch (ValidationException $e) {
            DB::rollback();
        } catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
    public function getDriverNearby(Request $request){
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');
        $radius  = ($request->get('radius') == NULL ? 25: $request->get('radius') );
        $errors = [];
        
        if ($latitude != null && $longitude != null) {
            $location = UserLocation::select(DB::raw('id, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();
        }else{
            if ($latitude == null) {
                $errors['latitude'] = 'Latitude is Required';
            }
            if ($longitude == null) {
                $errors['longitude'] = 'Longitude is Required';
            }
        }
        
        if ($errors) {
            return response()->json(['status'=>false,'message'=>implode($errors,',')]);
        }
        return response()->json(['status'=>true,'data'=>$location]);
    }
    public function getHistory($type = 1){
        try {
            $auth = Auth::guard('api');
            $user = $auth->user();
            if($user->isRole('customer')){
                $trip = Trip::where('trip_bookby',$user->id)->orderBy('trip_date','DESC')->get();
                $trip_count = Trip::where('trip_bookby',$user->id)->where('trip_type',$type)->orderBy('trip_date','DESC')->count();
            }else if($user->isRole('driver')){
                $trip = Trip::where('trip_driver',$user->id)->orderBy('trip_date','DESC')->get();
                $trip_count = Trip::where('trip_driver',$user->id)->where('trip_type',$type)->orderBy('trip_date','DESC')->count();
            }
            
            if ($trip_count<=0) {
                $message = 'Anda Belum Memiliki Transaksi';
            }
            return response()->json(['status'=>true,'data'=>$trip,'message'=>$message]);
        } catch (\Exception $e) {
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function GetTypeCar(Request $request){
        $type = new \App\Mobil\Models\Type();
        if ($request->get('id') != null) {
            $id = $request->get('id');
            $data = $type->active()->where('id',$id)->get();
        }else{
            $data = $type->active()->get();
        }
        
        foreach($data as $k =>$v){
            $data[$k]->path_url = $v->imagePath;
        }
        return response()->json(['status'=>true,'data'=>$data]);
    }
    public function GetRentPackage($id = null){
        $rent = new \App\Mobil\Models\RentPackage();
        if ($id == NULL) {
            $data = $rent->active()->get();
        }else{
            $data = $rent->active()->where('rp_car_type',$id)->get();
        }
        foreach($data as $k =>$v){
            $data[$k]->path_url = $v->imagePath;
        }
        return response()->json(['status'=>true,'data'=>$data]);
    }
    public function GetUserLocation(){
        $ul = UserLocation::join('users','user_location.user_id','users.id')->select('users.*','user_location.latitude','user_location.longitude')->get();
        return response()->json(['status'=>true,'data'=>$ul],200);
    }
    public function GetPromo(){
        $response = [];
        $promo = Promo::where('tgl_mulai','>=',date('Y-m-d'))->orWhere('tgl_akhir','<=',date('Y-m-d'))->orderBy('tgl_mulai','DESC')->select()->get();
        $p = new Promo();
        foreach($promo as $key => $v){
            $v->image_path = $v->imagepath;
            $v->discount = ($v->discount === NULL) ?  0:$v->discount;
        }
        $response['status'] = true;
        $response['data'] = $promo;
        return response()->json($response,$this->successStatus);
    }

    public function GetSettings(){
        $setting = Setting::pluck('value', 'key');
        return response()->json(['status'=>true,'data'=>$setting],200);
    }

    public function check_job(Request $request){
        $res = array();
        $status = 500;
        try {
            $auth = Auth::guard('api')->user();
            $message = "User tidak di temukan";
            if ($auth !== NULL) {
                $profile = $auth->profile;
                $message = "";
                $query = Trip::where(function($q) use ($auth){
                    if ($auth->isRole('driver')) {
                        $q->where('trip_driver',$auth->id);
                    }
                    $q->where('trip_status','<',Trip::STATUS_DECLINE);
                })->join('trip_detail','trip.trip_id','trip_detail.trip_id')
                ->join('tm_customer','trip_bookby','tm_customer.id')
                ->select('trip.*','tm_customer.name as trip_customer','trip_detail.*')
                ->orderBy('trip_date','DESC');
                $sql = $query->toSql();
                $bindings = $query->getBindings();
                $cp = $query->first();
                // dd($bindings);
                $message = ($cp===NULL) ? 'Tidak ada Transaksi Perjalanan' : 'Perjalanan dengan code '.$cp->trip_code; ;
                $res['data'] = $cp;
                $res['status'] = true;
                $status = $this->successStatus;
            }
            $res['message'] = $message;
            
            
        } catch (\Exception $e) {
            $status = 400;
            $res['error'] = true;
            $res['message'] = $e->getMessage();
        }
        return response()->json($res,$status);
    }

    public function get_servicetype(){
        $res = array();
        try {
            $st = ServiceType::orderBy('id')->get();
            $res['status'] = true;
            $res['data'] = $st;
            $res['message'] = "Mengambil data Service Type";
            return response()->json($res,200);
        } catch (\Throwable $th) {
            $res['status'] = false;
            $res['message'] = "Gagal Mengambil Service Type";
            return response()->json($res,500);
        }
    }

    public function get_bank($id=NULL){
        $t = DB::table('tm_bank');
        if ($id !== NULL) {
            $t->where('bank_code',$id);
        }
        $a = $t->get();
        return response()->json(['status'=>true,'data'=>$a]);
    }

    public function post_request_saldo(Request $request){
        try {
            $auth = Auth::guard('api')->user();
            if($auth){
                $kode = DB::table('request_saldo')->max('id');
                $noUrut = (int) substr($kode, 6, 3);
                $noUrut++;
                $char = "SLD";
                $kode = $char .date('His'). sprintf("%06s", $noUrut);
                DB::table('request_saldo')->insert(
                    ['req_from'=>$request->req_from,'req_code' => $kode, 'req_saldo' => $request->req_saldo, 'req_user_id' => $auth->id]
                );
                $data = DB::table('request_saldo')->where('req_code',$kode)->first();
                return response()->json(['status'=>true,'data'=>$data]);
            }else{
                return response()->json(['status'=>false]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status'=>false,'message'=>$th->getMessage()]);
        }
        
        
    }

    public function post_upload_bukti(Request $request){
        try {
            $auth = Auth::guard('api')->user();
            if($auth){
                $kode = DB::table('request_saldo')->max('id');
                $noUrut = (int) substr($kode, 6, 3);
                $noUrut++;
                $char = "SLD";
                $kode = $char .date('His'). sprintf("%06s", $noUrut);
                
                $image = $request->image;
                $name = md5($request->name.date('His'));
                $realImage = base64_decode($image);
                $f = finfo_open();
                $mime_type = finfo_buffer($f, $realImage, FILEINFO_MIME_TYPE);
                $filename = $name.'.jpg';

                DB::table('request_saldo')->insert(
                    ['req_file'=>$filename,'req_from'=>$request->req_from,'req_code' => $kode, 'req_saldo' => $request->req_saldo, 'req_user_id' => $auth->id,'status'=>0,'req_norek'=>$request->req_norek]
                );

                file_put_contents(public_path('files/uploads/bukti').DIRECTORY_SEPARATOR.$filename, $realImage);
                return response()->json(['status'=>true,'message'=>'Image Uploaded Successfully.']);    
            }

            
        } catch (\Throwable $th) {
            return response()->json(['status'=>false,'message'=>$th->getMessage()]);
        }
        
    }

}
