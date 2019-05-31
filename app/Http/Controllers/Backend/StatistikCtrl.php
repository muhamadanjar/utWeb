<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\RepositoryInterface as ActivityInterface;
class StatistikCtrl extends BackendCtrl{
    public function __construct(ActivityInterface $activity){
        parent::__construct();
        $this->activity=$activity;
    }
    public function index(){
        return view('backend.dashboard.statistik');
    }
}
