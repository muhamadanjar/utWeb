<?php namespace App\Mobil;

use App\Jalan\Contracts\IMobilDetil as cInterface;
use MulutBusuk\Workspaces\Repositories\Eloquent\EloquentRepository as BaseInterface;
use App\Mobil\Models\MobilDetil;
use DB;
/**
 * Aset repository
 * @author Muhamad Anjar
 * @package Asset\Repository
 */
class RepositoryJalanDetil extends BaseInterface implements cInterface
{
    protected $parent;
    protected $vname;
    public function __construct()
    {
        parent::__construct(new MobilDetil());
        $this->parent = 'mobildetil/';
        $this->vname = 'lists';
    }

    public function showData()
    {
        return $this->model->select('*')
            ->where('id_kota', '3201')
            ->get();
    }


}
