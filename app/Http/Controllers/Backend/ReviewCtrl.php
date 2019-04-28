<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class ReviewCtrl extends BackendCtrl
{
    public function index()
    {
        return view('backend.reviews.index');
    }

    public function show($id){
        return view('backend.reviews.show');
    }
}
