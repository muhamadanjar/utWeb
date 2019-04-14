<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Loggable;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\RevisionableTrait;
use DB;
class Dokumen extends Model
{
    use RevisionableTrait;
    protected $table = 'tm_dokumen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul_dokumen', 'tanggal',
    ];
    public $timestamps = false;
    public static $rules = array(
		'judul_dokumen'=>'required|min:3',
        'tanggal' => 'required',
        
	);

	public static $messages = [
	    'judul_dokumen.required' => 'Nama Dokumen harus diisi!',
        'tanggal.required' => 'Tanggal harus di isi',
	];

    public function getKategori(){
        // $type = DB::select( DB::raw("SHOW COLUMNS FROM $this->table WHERE Field = 'kategori'") )[0]->Type;
        // preg_match('/^enum\((.*)\)$/', $type, $matches);
        // $enum = array();
        // foreach( explode(',', $matches[1]) as $value ){		
        //     $v = trim( $value, "'" );
        //     $enum = array_add($enum, $v, $v);
        // }
        $enum = array('dokumen','surat','uu');
        return $enum;
    }

    public function getPermalinkDownload(){
        return url('files/uploads/dokumen').DIRECTORY_SEPARATOR.'/';
    }

    public function getPathDownload(){
        return public_path('files/uploads/dokumen').DIRECTORY_SEPARATOR.'/';
    }
}
