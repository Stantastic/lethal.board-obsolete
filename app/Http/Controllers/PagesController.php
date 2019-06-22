<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('base.index');
    }

    public function team(){
        return view('base.team');
    }

    public function members(){
        return view('base.members');
    }

}
