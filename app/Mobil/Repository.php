<?php
namespace App\Mobil;

use MulutBusuk\Workspaces\Repositories\Contracts\RepositoryInterface;
use MulutBusuk\Workspaces\Repositories\Eloquent\EloquentRepository as baseRepository;
use App\Mobil\Models\Mobil;
use DB;

class Repository extends baseRepository implements RepositoryInterface
{
    /*
     * Created on Fri Dec 14 2018
     * Author Muhamad Anjar
     * Copyright (c) 2018 Cupplisser
     */

    protected $parent;
    protected $vname;
    public function __construct()
    {
        parent::__construct(new Mobil());
        $this->parent = 'mobil/';
        $this->vname = 'lists';
    }

    public function mobilavailable(){
        $mobil = $this->model->where('status','tersedia')->orderBy('name', 'asc')->get();
        $new = new Mobil();
        return $mobil;
    }

    

}