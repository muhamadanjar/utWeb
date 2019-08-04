<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\EloquentRepository;
use MulutBusuk\Workspaces\Repositories\Eloquent\Menu\EloquentRepository as MenuRepository;
use DB;
use Illuminate\Support\Facades\Auth;

use App\User;

class BackendCtrl extends Controller
{
    public $r;
    public $m;
    public $user;
    public $_links;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        // $this->jalan = new RepositoryJalan();
        $this->r = new Request();
        $s = new EloquentRepository();
        $this->m = new MenuRepository();
        // $s->UpdateStatistik();
        $_uri = url()->current();
        $user = request()->user();
        
        $this->checkakses($user,$_uri);
    }

    protected function _get_menu($var = 0){
        $r = User::find($var)->roles;
        $p = $r->pluck('id');
        $a = DB::table('role_menu')->whereIn('role_id', $p)->pluck('menu_id');
        if ($a === null) {
            return array();
        }
        $b = $a->toArray();
        if (!is_array($b)) {
            return array();
        }
        // dd($b);
        $menu = $this->m->findWhereIn('id', $b);
        return $menu->toArray();
    }

    protected function _show_403($msg = '', $head = 'Access Denied'){
        $msg = (trim($msg) !== '') ? $msg : 'Full authentication is required to access this resource.<a href="mailto:arvanria@gmail.com">Report this?</a>';
        $a = (request()->ajax()) ? show_json(array('code' => 403, 'message' => $msg), 403) : show_json($msg);
        return $a;
    }
    protected function _show_link($var = '')
    {
        return in_array($var, $this->_links);
    }

    protected function checkakses($user,$uri){
        if ($user !== null) {
            $_menus = $this->_get_menu($user->id);
            if (count($_menus) <= 0) {
                return $this->_show_403();
            }
            $this->_links = array_column($_menus, 'url');
            
            if (!in_array_like($uri, $this->_links)) {
                // return $this->_show_403('Dilarang Akses '.$uri);
                return view('errors.403');
            }
        }
    }
}