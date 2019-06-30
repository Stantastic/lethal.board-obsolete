<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sessions;
use App\Category;
use App\Forum;
use Illuminate\Support\Facades\Session;

class NodesController extends Controller
{

    public function index()
    {
        $categories = Category::all()->sortBy('order');
        $forums = Forum::all()->sortBy('order');
        return view('admin.nodes.index')->with('categories', $categories)->with('forums', $forums);
    }


    /**
     * Store the defined order of nodes to the database.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $input = $request->all();

        function displayArrayRecursively($arr) {
            global $order;
            global $current_cat;

            if ($arr) {
                foreach ($arr as $value) {
                    if (is_array($value)) {
                        displayArrayRecursively($value);
                    } else {

                        $order ++;

                        if (strpos($value, 'c-') !== false) {

                            $get_cat = explode("-", $value);
                            $current_cat = $get_cat[1];

                            DB::table('categories')->where('id', $current_cat)
                                ->update(['order' => $order]);
                        }

                        if (strpos($value, 'f-') !== false) {

                            $get_for = explode("-", $value);
                            $current_for = $get_for[1];

                            DB::table('forums')->where('id', $current_for)
                                ->update(['order' => $order,
                                    'category' => $current_cat
                                ]);

                        }

                    }
                }
            }
        }

        displayArrayRecursively($input);
    }


}
