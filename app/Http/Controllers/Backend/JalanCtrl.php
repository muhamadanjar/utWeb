<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;
use Validator;
use App\Kecamatan;
use App\Jalan\Models\Jalan;
use App\Jalan\Models\JalanDetil;
use App\Jalan\Models\JalanFile;
use App\Jalan\Models\JalanKondisi;
use App\Jalan\Contracts\RepositoryInterface;
use App\Jalan\Contracts\IJalanDetil;
use Maatwebsite\Excel\Facades\Excel;
use MulutBusuk\Workspaces\Repositories\Traits\GlobalBantuan;
class JalanCtrl extends BackendCtrl
{
    use GlobalBantuan;
    function __construct(RepositoryInterface $jalan,IJalanDetil $jd)
    {
        parent::__construct();
        $this->jalan = $jalan;
        $this->jd = $jd;

    }
    public function index()
    {
        session(['link_web' => 'prasarana']);
        return view('backend.jalan.index');

    }
    public function edit($id)
    {
        if (Gate::check('edit.jalan')) {
            session(['aksi' => 'edit']);
            $jalan = Jalan::find($id);
            
            $kecamatan = $this->GetDftrKecamatan($jalan->kode_kec);
            if ($jalan == null) {
                session(['aksi' => '']);
                return redirect()->route('backend.jalan.index');
            }
            return view('backend.jalan.form')
                ->with('id_jalan', $id)
                ->with('kecamatan', $kecamatan)
                ->withJalan($jalan);
        }
        return redirect()->route('backend.jalan.index')->with('flash.error', 'Anda Tidak diijinkan Mengakses Halaman ini');

    }
    public function create(Request $request)
    {

        if (Gate::check('create.jalan')) {
            session(['aksi' => 'add']);
            $jalan = new Jalan();
            $id_jalan = Jalan::select(DB::raw('max(id) as id'))->first()->id + 1;
            $kecamatan = $this->GetDftrKecamatan();
            //$file = JalanFile::where('jalan_id',$id)->first();
            return view('backend.jalan.form')
                ->with('id_jalan', $id_jalan)
                ->with('kecamatan', $kecamatan)
                ->withJalan($jalan);
        }
        return redirect()->route('backend.jalan.index')->with('flash.error', 'Anda Tidak diijinkan Mengakses Halaman ini');

    }
    public function formSKJ($id)
    {
        $jalan = Jalan::find($id);
        if ($jalan == null) {
            return redirect()->route('backend.jalan.index');
        }
        $jl = $jalan->jumlah_lajur;
        return view('backend.jalan.formskj')
            ->with('JalanID', $id)->withJalan($jalan);
    }
    public function post(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Jalan::$rules, Jalan::$messages);
            if (!$validator->passes()) {
                if (session('aksi') == 'edit') {
                    $form = 'edit';
                    return redirect()->route('backend.jalan.' . $form, array($request->id))
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    $form = 'create';
                    return redirect()->route('backend.jalan.' . $form)
                        ->withErrors($validator)
                        ->withInput();
                }

            }

            $jalan = (session('aksi') == 'edit') ? Jalan::find($request->id) : new Jalan();
            $jalan->no_ruas = $request->no_ruas;
            $jalan->nama_ruas = $request->nama_ruas;
            $jalan->kode_kec = implode($request->kode_kec, ",");
            $jalan->panjang = $request->panjang;
            $jalan->lebar = $request->lebar;
            $jalan->ptjp_aspal = ($request->aspal != "") ? $request->aspal : 0;
            $jalan->ptjp_beton = ($request->beton != "") ? $request->beton : 0;
            $jalan->ptjp_kerikil = ($request->kerikil != "") ? $request->kerikil : 0;
            $jalan->ptjp_tanah = ($request->belum_tembus != "") ? $request->belum_tembus : 0;

            $jalan->ptk_baik_persentase = ($request->ptk_baik_persentase != "") ? $request->ptk_baik_persentase : 0;
            $jalan->ptk_baik_km = ($request->ptk_baik_km != "") ? $request->ptk_baik_km : 0;
            $jalan->ptk_sedang_persentase = ($request->ptk_sedang_persentase != "") ? $request->ptk_sedang_persentase : 0;
            $jalan->ptk_sedang_km = ($request->ptk_sedang_km != "") ? $request->ptk_sedang_km : 0;
            $jalan->ptk_rusakringan_persentase = ($request->ptk_rusakringan_persentase != "") ? $request->ptk_rusakringan_persentase : 0;
            $jalan->ptk_rusakringan_km = ($request->ptk_rusakringan_km != "") ? $request->ptk_rusakringan_km : 0;
            $jalan->ptk_rusakberat_persentase = ($request->ptk_rusakberat_persentase != "") ? $request->ptk_rusakberat_persentase : 0;
            $jalan->ptk_rusakberat_km = ($request->ptk_rusakberat_km != "") ? $request->ptk_rusakberat_km : 0;

            $jalan->lhr_rata = ($request->lhr_rata != "") ? $request->lhr_rata : 0;
            $jalan->akses_jalan = $request->akses_jalan;
            $jalan->jumlah_lajur = $request->jumlah_lajur;
            if (empty($request->pangkal_latitude)) $request->pangkal_latitude = 0.0;
            if (empty($request->pangkal_longitude)) $request->pangkal_longitude = 0.0;
            if (empty($request->ujung_latitude)) $request->ujung_latitude = 0.0;
            if (empty($request->ujung_longitude)) $request->ujung_longitude = 0.0;

            if (strpos($request->pangkal_latitude, '°')) {
                $dms = explode(" ", $request->pangkal_latitude);
                $degree = (int)$dms[0];
                $minutes = (int)$dms[1];
                $seconds = doubleval($dms[2]);
                $direction = strtolower($dms[3]);
                $jalan->pangkal_latitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
            } else {
                $jalan->pangkal_latitude = ($request->pangkal_latitude);
            }

            if (strpos($request->pangkal_longitude, '°')) {
                $dms = explode(" ", $request->pangkal_longitude);
                $degree = (int)$dms[0];
                $minutes = (int)$dms[1];
                $seconds = doubleval($dms[2]);
                $direction = strtolower($dms[3]);
                $jalan->pangkal_longitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
            } else {
                $jalan->pangkal_longitude = ($request->pangkal_longitude);
            }

            if (strpos($request->ujung_latitude, '°')) {
                $dms = explode(" ", $request->ujung_latitude);
                $degree = (int)$dms[0];
                $minutes = (int)$dms[1];
                $seconds = doubleval($dms[2]);
                $direction = strtolower($dms[3]);
                $jalan->ujung_latitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
            } else {
                $jalan->ujung_latitude = ($request->ujung_latitude);
            }

            if (strpos($request->ujung_longitude, '°')) {
                $dms = explode(" ", $request->ujung_longitude);
                $degree = (int)$dms[0];
                $minutes = (int)$dms[1];
                $seconds = doubleval($dms[2]);
                $direction = strtolower($dms[3]);
                $jalan->ujung_longitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
            } else {
                $jalan->ujung_longitude = ($request->ujung_longitude);
            }

            $jalan->no_ruas_pangkal = $request->no_ruas_pangkal;
            $jalan->no_ruas_ujung = $request->no_ruas_ujung;
            $jalan->pembiayaan = $request->pembiayaan;
            $jalan->biaya = $request->biaya;
            $jalan->ket = $request->keterangan;
            $jalan->tahun = $request->tahun;
            $jalan->save();
            // dd($request->id);
            if (/*isset($request->foto) &&*/ $request->foto != null && !empty($request->foto)) {
                foreach ($request->foto as $key => $value) {
                    if ($value != null) {
                        $_file = new JalanFile();
                        $_file->namafile = $value;
                        $_file->keterangan = 'Foto No Ruas ' . $jalan->no_ruas;
                        $jalan->files()->save($_file);
                    }
                }

            } else {
                    // $jalan->files()->sync(array());
            }
            //}

            

        } catch (Exception $e) {
            report($e);

            return redirect()->route('backend.jalan.index')->withErrors($e);
        }
        
        //return response()->json($jalan);
        return redirect()->route('backend.jalan.index');

    }
    public function postDetil(Request $request){
        DB::beginTransaction();
        try {
            $datajalanmaster = Jalan::where('no_ruas', $request->no_ruas)->first();
            if ($request->id == null) {
                $checkdata = JalanDetil::where('no_ruas', $request->no_ruas)
                    ->where('dari_km', $request->dari_km)
                    ->where('sampai_km', $request->sampai_km)
                    ->where('tipe_jalan', $request->tipe_jalan)
                    ->where('lajur', $request->lajur)
                    ->count();
                if ($checkdata > 0) {
                    return redirect()->route('backend.jalan.formskj', array($request->jalan_id))
                        ->with('flash.error', 'Data Sudah ada');
                }
            }
            $jalan = ($request->id != null) ? JalanDetil::find($request->id) : new JalanDetil();
            $jalan->dari_km = $request->dari_km;
            $jalan->sampai_km = $request->sampai_km;
            $jalan->pp_susunan = $request->pp_susunan;
            $jalan->pp_kondisi = $request->pp_kondisi;
            $jalan->pp_penurunan = $request->pp_penurunan;
            $jalan->pp_tambalan = $request->pp_tambalan;

            $jalan->pp_kemiringan_melintang = $request->pp_kemiringan_melintang;
            $jalan->pp_erosi_permukaan = $request->pp_erosi_permukaan;

            $jalan->kerikil_ukuranterbanyak = $request->kerikil_ukuranterbanyak;
            $jalan->kerikil_teballapisan = $request->kerikil_teballapisan;
            $jalan->kerikil_distribual = $request->kerikil_distribual;

            $jalan->retak_jenis = $request->retak_jenis;
            $jalan->retak_lebar = $request->retak_lebar;
            $jalan->retak_luas = $request->retak_luas;
            $jalan->kl_jml_lubang = $request->kl_jml_lubang;
            $jalan->kl_ukuran_lubang = $request->kl_ukuran_lubang;
            $jalan->kl_bekas_roda = $request->kl_bekas_roda;
            
            $jalan->kl_bergelombang = $request->kl_bergelombang;

            $jalan->kl_kt_kiri = $request->kl_kt_kiri;
            $jalan->kl_kt_kanan = $request->kl_kt_kanan;
            $jalan->kss_kondisibahu_kiri = $request->kss_kondisibahu_kiri;
            $jalan->kss_kondisibahu_kanan = $request->kss_kondisibahu_kanan;
            $jalan->kss_permukaanbahu_kiri = $request->kss_permukaanbahu_kiri;
            $jalan->kss_permukaanbahu_kanan = $request->kss_permukaanbahu_kanan;
            $jalan->kss_kiri = $request->kss_kiri;
            $jalan->kss_kanan = $request->kss_kanan;
            $jalan->kss_kerusakanlereng_kiri = $request->kss_kerusakanlereng_kiri;
            $jalan->kss_kerusakanlereng_kanan = $request->kss_kerusakanlereng_kanan;
            $jalan->kss_trotoar_kiri = $request->kss_trotoar_kiri;
            $jalan->kss_trotoar_kanan = $request->kss_trotoar_kanan;
            $jalan->jalan_id = $request->jalan_id;
            $jalan->lajur = $request->lajur;
            $jalan->no_ruas = $request->no_ruas;
            $jalan->nilai_iri = ($request->nilai_iri != '') ? $request->nilai_iri : 0;
            $jalan->nilai_sdi = ($request->nilai_sdi != '') ? $request->nilai_sdi : 0;
            $jalan->panjang = ($request->sampai_km - $request->dari_km);
            
            $jalan->k_baik = ($request->k_baik != '') ? $request->k_baik : 0;
            $jalan->k_sedang = ($request->k_sedang != '') ? $request->k_sedang : 0;
            $jalan->k_rusakringan = ($request->k_rusakringan != '') ? $request->k_rusakringan : 0;
            $jalan->k_rusakberat = ($request->k_rusakberat != '') ? $request->k_rusakberat : 0;
            $jalan->tipe_jalan = $request->tipe_jalan;
            $jalan->save();

            if ($datajalanmaster !== null) {
                $datasum = $this->getSummaryJalanDetil($jalan->no_ruas);

                $panjang = $datasum->panjang * 0.001;
                $datajalanmaster->panjang = $panjang;

                $datajalanmaster->ptk_baik_km = $datasum->baik * 0.001;
                $datajalanmaster->ptk_baik_persentase = ($datasum->baik / $datasum->panjang) * 100;
                $datajalanmaster->ptk_sedang_km = $datasum->sedang * 0.001;
                $datajalanmaster->ptk_sedang_persentase = ($datasum->sedang / $datasum->panjang) * 100;
                $datajalanmaster->ptk_rusakringan_km = $datasum->rusakringan * 0.001;
                $datajalanmaster->ptk_rusakringan_persentase = ($datasum->rusakringan / $datasum->panjang) * 100;
                $datajalanmaster->ptk_rusakberat_km = $datasum->rusakberat * 0.001;
                $datajalanmaster->ptk_rusakberat_persentase = ($datasum->rusakberat / $datasum->panjang) * 100;

                $datajalanmaster->save();
            }
            DB::commit();
        } catch (Exception $e) {
            throw $e;
            DB::rollback();
        }
        if ($request->ajax()) {
            return response()->json($jalan, 200);
        }
        return redirect()->route('backend.jalan.formskj', array($jalan->jalan_id));
    }
    public function viewJalan($id)
    {
        $jalan = Jalan::select('jalan.*')->where('id', $id)->first();
        $file = JalanFile::where('jalan_id', $id)->get();
        return view('backend.jalan.view')->withJalan($jalan)->withFile($file);
    }
    public function destroy($id)
    {
        $jalan = Jalan::findOrFail($id);
        $file = JalanFile::where('jalan_id', $id)->delete();
        $jalan->delete();
        return redirect()->route('backend.jalan.index');
    }

    function destroyDetilJalan($id)
    {
        $jalan = JalanDetil::findOrFail($id);
        $jalan->delete();
        return redirect()->route('backend.jalan.formskj',[$jalan->jalan_id]);
    }

    public function uploadFile(Request $request){
        $arrImg = [];
        $targetDir = public_path() . DIRECTORY_SEPARATOR . $request->get('path');
        if (!$this->folder_exist($targetDir)) {
            mkdir($targetDir, 0777);
        }
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        $images_arr = array();
        foreach ($_FILES['images']['name'] as $k => $v) {
            $image_name = $_FILES['images']['name'][$k];
            $tmp_name = $_FILES['images']['tmp_name'][$k];
            $size = $_FILES['images']['size'][$k];
            $type = $_FILES['images']['type'][$k];
            $error = $_FILES['images']['error'][$k];
                // File upload path
                //$fileName = basename($_FILES['images']['name'][$k]);
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $filename = $request->get('jalanid') . time() . '_' . urlencode(pathinfo($image_name, PATHINFO_FILENAME)) . '.' . $ext;
            $targetFilePath = $targetDir . DIRECTORY_SEPARATOR . $filename;
                //array_push($arrImg,$v);
                // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {    
                    // Store images on the server
                if (move_uploaded_file($tmp_name, $targetFilePath)) {
                    $images_arr['target'] = $targetFilePath;
                    $images_arr['origin_name'] = $image_name;
                    $images_arr['filename'] = $filename;
                    $images_arr['tmp_name'] = $tmp_name;
                    $images_arr['error'] = $error;
                    $images_arr['type'] = $type;
                    array_push($arrImg, $images_arr);
                } else {
                    return json_encode(array('error' => true, 'message' => 'Upload process error'));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Tipe File tidak di ijinkan..']);
            }
        }
        return $arrImg;
    }

    public function deleteFile($id){
        $file = JalanFile::find($id);
        $lokasi = new Jalan();
        File::delete($lokasi->getPath() . $file->namafile);
        $file->delete();
        Flash::success('Gambar Berhasil di hapus');
        return redirect()->route('backend.jalan.edit', [$file->jalan_id]);
    }

    public function import(Request $request)
    {
        if (Gate::check('create.jalan')) {
            return view('backend.jalan.import');
            if ($request->isMethod('post')) {
                return $this->postImport($request);
            }
        }
        return redirect()->route('backend.jalan.index')->with('flash.error', 'Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postImport($request)
    {
        $fupload = $request->file('files');
        $vdir_upload = 'files';
        $fileName = str_random(20) . '.' . $fupload->getClientOriginalExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . $vdir_upload;
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777);
            //echo "The directory $destinationPath was successfully created.";
            //exit;
        } else {
            //echo "The directory $destinationPath exists.";
        }
        $fuploadName = $fupload->getClientOriginalName();
        $fupload->move($destinationPath, $fileName);
        $lokasi_file = $destinationPath . DIRECTORY_SEPARATOR . $fileName;

        $objReader = new \PHPExcel_Reader_Excel2007();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($lokasi_file);

        $rowIterator = $objPHPExcel->setActiveSheetIndex(0)->getRowIterator();

        $array_data = array();
        foreach ($rowIterator as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            if (1 == $row->getRowIndex()) continue;//skip first row
            if (2 == $row->getRowIndex()) continue;//skip first row
            if (3 == $row->getRowIndex()) continue;//skip first row
            if (4 == $row->getRowIndex()) continue;//skip first row
            if (5 == $row->getRowIndex()) continue;//skip first row
            if (6 == $row->getRowIndex()) continue;//skip first row
            if (7 == $row->getRowIndex()) continue;//skip first row
            if (8 == $row->getRowIndex()) continue;//skip first row
            if (9 == $row->getRowIndex()) continue;//skip first row
            if (10 == $row->getRowIndex()) continue;//skip first row

            $rowIndex = $row->getRowIndex();
            //$array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');

            foreach ($cellIterator as $cell) {
                $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
            }
        }
        //return $array_data;

        \DB::beginTransaction();

        try {
            foreach ($array_data as $val) {
                $val['V'] = ($val['V'] == '') ? '0' : $val['V'];
                if (strpos($val['V'], '°')) {
                    $dms = explode(" ", $val['V']);
                    $degree = (int)$dms[0];
                    $minutes = (int)$dms[1];
                    $seconds = doubleval($dms[2]);
                    $direction = strtolower($dms[3]);
                    $pangkal_latitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
                } else {
                    $pangkal_latitude = $val['V'];
                }
                $val['U'] = ($val['U'] == '') ? '0' : $val['U'];
                if (strpos($val['U'], '°')) {
                    $dms = explode(" ", $val['U']);
                    $degree = (int)$dms[0];
                    $minutes = (int)$dms[1];
                    $seconds = doubleval($dms[2]);
                    /*if(empty($dms[3])){
                        dd($val['U']);
                    }*/
                    $direction = strtolower($dms[3]);

                    $pangkal_longitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
                } else {
                    $pangkal_longitude = $val['U'];
                }
                $val['X'] = ($val['X'] == '') ? '0' : $val['X'];
                if (strpos($val['X'], '°')) {
                    $dms = explode(" ", $val['X']);
                    $degree = (int)$dms[0];
                    $minutes = (int)$dms[1];
                    $seconds = doubleval($dms[2]);
                    $direction = strtolower($dms[3]);
                    $ujung_latitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
                } else {
                    $ujung_latitude = $val['X'];
                }
                $val['W'] = ($val['W'] == '') ? '0' : $val['W'];
                if (strpos($val['W'], '°')) {
                    $dms = explode(" ", $val['W']);
                    $degree = (int)$dms[0];
                    $minutes = (int)$dms[1];
                    $seconds = doubleval($dms[2]);
                    $direction = strtolower($dms[3]);
                    $ujung_longitude = $this->DMS2Decimal($degree, $minutes, $seconds, $direction);
                } else {
                    $ujung_longitude = $val['W'];
                }
                $no_ruas = ($val['B'] != '') ? $val['B'] : '0';
                $nama_ruas = ($val['C'] != '') ? $val['C'] : '-';
                $kode_kec = ($val['D'] != '') ? $val['D'] : '0';
                $panjang = ($val['E'] != '') ? $val['E'] : '0';
                $lebar = ($val['F'] != '') ? $val['F'] : '0';

                $akses_jalan = ($val['T'] == '') ? '-' : $val['T'];
                $pembiayaan = ($val['AA'] != '') ? $val['AA'] : '0';

                $ptjp_aspal = ($val['G'] != '') ? $val['G'] : '0';
                $ptjp_beton = ($val['H'] != '') ? $val['H'] : '0';
                $ptjp_kerikil = ($val['I'] != '') ? $val['I'] : '0';
                $ptjp_tanah = ($val['J'] != '') ? $val['J'] : '0';

                \DB::table('jalan')->insert([
                    [
                        'no_ruas' => $no_ruas,
                        'nama_ruas' => $nama_ruas,
                        'kode_kec' => $kode_kec,
                        'panjang' => $panjang,
                        'lebar' => $lebar,
                        'ptjp_aspal' => $ptjp_aspal,
                        'ptjp_beton' => $ptjp_beton,
                        'ptjp_kerikil' => $ptjp_kerikil,
                        'ptjp_tanah' => $ptjp_tanah,

                        'ptk_baik_persentase' => ($val['K'] * 100),
                        'ptk_baik_km' => $val['L'],
                        'ptk_sedang_persentase' => ($val['M'] * 100),
                        'ptk_sedang_km' => $val['N'],
                        'ptk_rusakringan_persentase' => ($val['O'] * 100),
                        'ptk_rusakringan_km' => $val['P'],
                        'ptk_rusakberat_persentase' => ($val['Q'] * 100),
                        'ptk_rusakberat_km' => $val['R'],

                        'lhr_rata' => $val['S'],
                        'akses_jalan' => $akses_jalan,
                        'pangkal_latitude' => $pangkal_latitude,
                        'pangkal_longitude' => $pangkal_longitude,
                        'ujung_latitude' => $ujung_latitude,
                        'ujung_longitude' => $ujung_longitude,

                        'no_ruas_pangkal' => $val['Y'],
                        'no_ruas_ujung' => $val['Z'],
                        'pembiayaan' => $pembiayaan,
                        'ket' => $val['AB'],

                    ]
                ]);
            }
            \DB::commit();
            Flash::success(trans('flash/import.success'));
        } catch (Exception $e) {
            \DB::rollback();
            Flash::error(trans('flash/import.error'));
            throw $e;

        }
        \File::delete($lokasi_file);


        return redirect()->route('backend.jalan.import');
    }

    public function postImportDetilJalan(Request $request){
        try {
            if ($request->hasFile('files')) {
                $fupload = $request->file('files');
                $vdir_upload = 'files';
                $fileName = str_random(20) . '.' . $fupload->getClientOriginalExtension();
                $destinationPath = storage_path() . DIRECTORY_SEPARATOR . $vdir_upload;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                    //echo "The directory $destinationPath was successfully created.";
                    //exit;
                } else {
                    //echo "The directory $destinationPath exists.";
                }
                $fuploadName = $fupload->getClientOriginalName();
                //$fupload->move($destinationPath, $fileName);
                Storage::disk('uploads')->put($fileName, File::get($fupload));

                $lokasi_file = $destinationPath . DIRECTORY_SEPARATOR . $fileName;

                $objReader = new \PHPExcel_Reader_Excel2007();
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($lokasi_file);

                $CurrentWorkSheetIndex = 0;
                $array_data = array();
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $rowIterator = $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet))->getRowIterator();

                    $no_ruas = $worksheet->getCellByColumnAndRow('3', '3')->getValue();

                    foreach ($rowIterator as $row) {
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

                        $rowIndex = $row->getRowIndex();
                        if (1 == $row->getRowIndex()) continue;//skip first row
                        if (2 == $row->getRowIndex()) continue;//skip first row
                        if (3 == $row->getRowIndex()) continue;//skip first row
                        $array_data[$CurrentWorkSheetIndex]['no_ruas'] = $no_ruas;

                        if (4 == $row->getRowIndex()) continue;//skip first row
                        if (5 == $row->getRowIndex()) continue;//skip first row
                        if (6 == $row->getRowIndex()) continue;//skip first row
                        if (7 == $row->getRowIndex()) continue;//skip first row
                        if (8 == $row->getRowIndex()) continue;//skip first row
                        if (9 == $row->getRowIndex()) continue;//skip first row
                        if (10 == $row->getRowIndex()) continue;//skip first row
                        if (11 == $row->getRowIndex()) continue;//skip first row
                        if (12 == $row->getRowIndex()) continue;//skip first row
                        if (13 == $row->getRowIndex()) continue;//skip first row
                        if (14 == $row->getRowIndex()) continue;//skip first row
                        if (15 == $row->getRowIndex()) continue;//skip first row
                        if (16 == $row->getRowIndex()) continue;//skip first row


                        foreach ($cellIterator as $cell) {
                            $array_data[$CurrentWorkSheetIndex]['data'][$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                        }
                    }
                    $CurrentWorkSheetIndex++;
                }
                //return ($array_data);

                \DB::beginTransaction();
                foreach ($array_data as $key => $val) {

                    foreach ($val['data'] as $k => $dc) {
                        //$this->getSdiIri($request)
                        \DB::table('jalan_detil')->insert([
                            [

                                'dari_km' => $dc['B'],
                                'sampai_km' => $dc['D'],
                                'pp_susunan' => $dc['F'],
                                'pp_kondisi' => $dc['G'],
                                'pp_penurunan' => $dc['H'],
                                'pp_tambalan' => $dc['I'],

                                'retak_jenis' => $dc['J'],
                                'retak_lebar' => $dc['K'],
                                'retak_luas' => $dc['L'],

                                'kl_jml_lubang' => $dc['M'],
                                'kl_ukuran_lubang' => $dc['N'],
                                'kl_bekas_roda' => $dc['O'],
                                'kl_kt_kiri' => $dc['Q'],
                                'kl_kt_kanan' => $dc['P'],

                                'kss_kondisibahu_kiri' => $dc['S'],
                                'kss_kondisibahu_kanan' => $dc['R'],
                                'kss_permukaanbahu_kiri' => $dc['U'],
                                'kss_permukaanbahu_kanan' => $dc['T'],
                                'kss_kiri' => $dc['W'],
                                'kss_kanan' => $dc['V'],
                                'kss_kerusakanlereng_kiri' => $dc['Y'],
                                'kss_kerusakanlereng_kanan' => $dc['X'],
                                'kss_trotoar_kiri' => $dc['AA'],
                                'kss_trotoar_kanan' => $dc['Z'],
                                'jalan_id' => 0,
                                'no_ruas' => $val['no_ruas'],
                                'panjang' => (intval($dc['D']) - intval($dc['B'])),
                                'nilai_iri' => 0,
                                'nilai_sdi' => $dc['BG'],



                            ]
                        ]);
                    }
                }
                \DB::commit();
                Flash::success(trans('flash/import.success'));
            }

        } catch (Exception $e) {
            die($e->getMessage());
            Flash::error(trans('flash/import.error'));
        }

        return redirect()->route('backend.jalan.import');

    }

    public function exportExcel()
    {
        $excel2 = \PHPExcel_IOFactory::createReader('Excel2007');
        $excel2 = $excel2->load(public_path('assets') . '/sample_jalan.xlsx'); // Empty Sheet
        $excel2->setActiveSheetIndex(0);
        
        // Add column headers
        $excel2->getActiveSheet()
            ->setCellValue('A11', 'EDITED Last Name')
            ->setCellValue('B11', 'EDITED First Name')
            ->setCellValue('C11', 'EDITED Age')
            ->setCellValue('D11', 'EDITED Sex')
            ->setCellValue('E11', 'EDITED Location');
        $this->Excel2007('Laporan Jalan');
        $objWriter = \PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
        //$objWriter->save('Laporan Jalan.xlsx');
        $objWriter->save('php://output');
        exit();
    }

    public function getskjTableSummary($retak_luas = 0, $retak_lebar = 0, $jumlah_lubang = 0, $bekasroda = 0)
    {
        $data = [];
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

    public function getSdiIri($request)
    {
        $data = [];
        $sampai_km = $request->get('sampai_km');
        $dari_km = $request->get('dari_km');
        $nilai_sdi = $request->get('nilai_sdi');
        $nilai_iri = $request->get('nilai_iri');

        $panjang_km = $sampai_km - $dari_km;
        $baik = 0;
        $sedang = 0;
        $rusakringan = 0;
        $rusakberat = 0;
        if (/*$nilai_iri<=4 &&*/ $nilai_sdi <= 50) {
            $baik = $panjang_km;
        } else if (/*$nilai_iri<=4 &&*/ $nilai_sdi > 50) {
            $sedang = $panjang_km;
        } else if (/*$nilai_iri>4 &&*/ $nilai_iri <= 8 && $nilai_sdi <= 100) {
            $sedang = $panjang_km;
        } else if (/*$nilai_iri<=8 &&*/ ($nilai_sdi > 100 && $nilai_sdi <= 150)) {
            $rusakringan = $panjang_km;
        } else if (/*$nilai_iri>8 && $nilai_iri <= 12 &&*/ $nilai_sdi <= 150) {
            $rusakringan = $panjang_km;
        } else if (/*$nilai_iri>12 &&*/ $nilai_sdi > 0) {
            $rusakberat = $panjang_km;
        } else if (/*$nilai_iri<=12 &&*/ $nilai_sdi > 150) {
            $rusakberat = $panjang_km;
        }

        $mantap = $baik + $sedang;
        $tdkmantap = $rusakringan + $rusakberat;
        $data['panjang'] = $panjang_km;
        $data['baik'] = $baik;
        $data['sedang'] = $sedang;
        $data['rusakringan'] = $rusakringan;
        $data['rusakberat'] = $rusakberat;
        $data['mantap'] = $mantap;
        $data['tdkmantap'] = $tdkmantap;


        return $data;

    }

    public function getSummaryJalanDetil($no_ruas)
    {
        $data = JalanDetil::where('no_ruas', $no_ruas)
            ->select(
                DB::raw('SUM(panjang) as panjang'),
                DB::raw('SUM(k_baik) as baik'),
                DB::raw('SUM(k_sedang) as sedang'),
                DB::raw('SUM(k_rusakringan) as rusakringan'),
                DB::raw('SUM(k_rusakberat) as rusakberat')
            )
            ->first();
        return $data;
    }

    public function getJalanKondisiIndex(){
        return view('backend.jalan.kondisiIndex');
    }

    public function getJalanKondisiFormAdd(){
        session(['aksi' => 'add']);
        $id_jalan = JalanKondisi::select(DB::raw('MAX(id) as kode'))->first();
        $kecamatan = $this->GetDftrKecamatan();
        $id_jalan = $id_jalan->kode + 1;
        return view('backend.jalan.kondisiForm')
            ->with('kecamatan', $kecamatan)
            ->with('id_jalan', $id_jalan);
    }
    public function getJalanKondisiFormEdit($id){
        session(['aksi' => 'edit']);
        $jalan = JalanKondisi::find($id);
        $kecamatan = $this->GetDftrKecamatan($jalan->kecamatan_dilalui);

        return view('backend.jalan.kondisiForm')->with('kecamatan', $kecamatan)->with('jalan', $jalan);
    }

    public function postJalanKondisi(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), JalanKondisi::$rules, JalanKondisi::$messages);
            if (!$validator->passes()) {
                if (session('aksi') == 'edit') {
                    $form = 'edit';
                } else {
                    $form = 'create';

                }
                return redirect()->route('backend.jalan.kondisiindex')
                    ->withErrors($validator)
                    ->withInput();
            }


            $jalan = (session('aksi') == 'edit') ? JalanKondisi::find($request->id) : new JalanKondisi();
            $jalan->no_ruas = $request->no_ruas;
            $jalan->nama_ruas = $request->nama_ruas;
            $jalan->kecamatan_dilalui = implode($request->kec_dilalui, ",");
            $jalan->panjang = $request->panjang;
            $jalan->lebar = $request->lebar;
            $jalan->jenis = $request->jenis;
            $jalan->pembiayaan = $request->pembiayaan;
            $jalan->tahun = $request->tahun;
            $jalan->biaya = $request->biaya;
            $jalan->ket = $request->keterangan;

            $jalan->save();
            Flash::success('Data Berhasil di tambahkan');
            return redirect()->route('backend.jalan.kondisiindex');

        } catch (Exception $e) {
            report($e);

            return redirect()->route('backend.jalan.kondisiindex')->withErrors($e);
        }
    }

    public function destroyjalantahun($id)
    {
        $jalan = JalanKondisi::findOrFail($id);
        $jalan->delete();
        return redirect()->route('backend.jalan.index');
    }

    public function GetDftrKecamatan($lvl = '')
    {
        $kecamatan = Kecamatan::where('kode_kab', 3271)->get();
        $a = '';
        foreach ($kecamatan as $key => $value) {
            
            $ck = (in_array($value->kode_kec, explode(',',$lvl)) === false) ? '' : 'selected="selected"';
            $a .= "<option value='" . $value->kode_kec . "' " . $ck . ">" . $value->nama_kecamatan . "</option>";
        }
        return $a;

    }

    function strposa($haystack, $needle, $offset=0) {
        if(!is_array($needle)) $needle = array($needle);
        foreach($needle as $query) {
            if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
        }
        return false;
    }

    public function postiri(Request $request){
        try {
            if ($request->hasFile('file_upload')) {
                $fupload = $request->file('file_upload');
                
                $vdir_upload = 'files';
                $fileName = str_random(20) . '.' . $fupload->getClientOriginalExtension();
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . $vdir_upload;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                    //echo "The directory $destinationPath was successfully created.";
                    //exit;
                } else {
                    //echo "The directory $destinationPath exists.";
                }
                $fuploadName = $fupload->getClientOriginalName();
                $fupload->move($destinationPath, $fileName);
                // Storage::disk()->put($fileName, File::get($fupload));
                $lokasi_file = $destinationPath . DIRECTORY_SEPARATOR . $fileName;
                $results = Excel::load($lokasi_file)->get();
                try {
                    DB::beginTransaction();
                    foreach ($results as $k => $v) {
                        $s = floatval($v->totaldistance) * 1000;
                        $jalan = new JalanDetil();
                        $jalan->dari_km = ($s - 100);
                        $jalan->sampai_km = $s;
                        $jalan->nilai_iri = $v->iri;
                        $jalan->jalan_id = $request->jalan_id;
                        $jalan->no_ruas = $request->no_ruas;
                        $jalan->pp_penurunan = 0;
                        $jalan->tipe_jalan = 'aspal';
                        $jalan->lajur = $request->lajur_ke;
                        $jalan->save();
                        DB::commit();
                    }   
                    
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->back()->withErrors($e);
                }
                
                File::delete($lokasi_file);
                // return redirect()->route('backend.jalan.formskj',[$request->jalan_id]);
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function showstipmap($id){
        $where = array('jalan_id'=>$id);
        $jd = $this->jd->findWhere($where);
        $jumlah = 20;
        $Rows = 4; //Dynamic number for Rowss
        $Cols = 50; // Dynamic number for Colsumns
        $mod = 5001;
        $table = '';
        $i = 0;
        $a = 0;
        $row = array();
        foreach($jd as $k => $v){
            if($v->sampai_km > $mod){$i++;$mod += 5000;$a=0;}
            if($v->k_baik>0){$kondisi='B';}elseif($v->k_sedang>0){$kondisi='S';}elseif($v->k_rusakringan>0){$kondisi='RR';}else{$kondisi='RB';}
            $row[$i][$a]['sta'] = $v->sampai_km;
            $row[$i][$a]['iri'] = $v->nilai_iri;
            $row[$i][$a]['mod'] = $v->sampai_km%$mod;
            $row[$i][$a]['pos'] = $k;
            $row[$i][$a]['kondisi'] = $kondisi;
            $a++;
        }
        // return $row;
        $table = '<table class="table table-bordered">';
        foreach($row as $k => $v){
            $table .= '<tr>';
            $table .= '<th>STA</th>';
            for($j=0;$j<count($v);$j++){ 
                $pos = $v[$j]['pos'];
                $sta = $v[$j]['sta']*0.001;
                $table.='<td>'.floatval($sta).'</td>';
            }
            $table .='</tr>';

            $table .= '<tr>';
            $table .= '<th>IRI</th>';
            for($j=0;$j<count($v);$j++){ 
                $iri =$v[$j]['iri'];
                $table.='<td>'.$iri.'</td>';
            }
            $table .='</tr>';

            $table .= '<tr>';
            $table .= '<th>Kondisi</th>';
            for($j=0;$j<count($v);$j++){
                $kondisi =$v[$j]['kondisi'];
                $color = ($kondisi=='B') ? 'bg-green' : ($kondisi=='S') ? 'bg-blue' : ($kondisi=='RR') ? 'bg-orange' : 'bg-danger'; 
                $table.='<td class="'.$color.'">'.$kondisi.'</td>';
            }
            $table .='</tr>';
        }
        $table .= '</table>';
        echo $table;

    }

}
