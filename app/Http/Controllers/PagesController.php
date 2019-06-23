<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Topic;
use Illuminate\Http\Request;
use App\Category;
use App\Sessions;

class PagesController extends Controller
{
    public function index(){
        $categories = Category::all();
        $forums = Forum::all();

        return view('base.index')->with('categories', $categories)->with('forums', $forums);
    }

    public function team(){
        return view('base.team');
    }

    public function members(){
        return view('base.members');
    }

}
