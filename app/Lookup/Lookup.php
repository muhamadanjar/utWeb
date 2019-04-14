<?php namespace App\Lookup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lookup extends Model {

    const TYPE_PANGKAT = 'pangkat';
    const TYPE_JABATAN = 'jabatan';
    const TYPE_KASUS = 'kasus';
    const TYPE_PENYIDIK = 'penyidik';

    const TYPE_FUNSIJALAN = 'fungsi_jalan';
    const TYPE_STATUSJALAN = 'status_jalan';
    const TYPE_SUMBERPENDANAAN = 'sumber_pendanaan';
    const TYPE_PENGELOLA = 'pengelola';
    const TYPE_KONDISI = 'kondisi';
    const TYPE_POSISIJALAN = 'posisi_jalan';

    use SoftDeletes;

    protected $table = 'lookups';

    protected $fillable = ['name', 'type'];

    public function identifiableName()
    {
        return $this->name;
    }

}
