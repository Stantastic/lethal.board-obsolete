<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;
use App\Forum;

class CategoriesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $category = Category::find($id);
        $forums = Forum::where('category', $id)
            ->orderBy('order', 'asc')
            ->paginate(10);

        if ($category === null){
            return abort(404);
        }

        return view('base.category')->with('category', $category)->with('forums', $forums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->input('title');

        $category->description = $request->input('description');
        $category->type = 'category';
        $category->save();


        return redirect('/acp/nodes')->with('success', trans('common.category_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if ($category === null){
            return abort(404);
        }

        if (!isset($category)){
            return redirect('/acp/nodes')->with('error', trans('common.category_not_found'));
        }

        return view('admin.categories.edit')->with('post', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->input('title');

        $category->description = $request->input('description');
        $category->type = 'category';
        $category->save();

        return redirect('/acp/nodes')->with('success', trans('common.category_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!isset($category)){
            return redirect('/acp/nodes')->with('error', trans('common.category_not_found'));
        }
        if (isset($category)){
            if((DB::table('categories')->join('forums', 'categories.id', '=', 'forums.category')->where('categories.id', $category->id)->count())>0){
                return redirect('/acp/nodes')->with('error-confirm', trans('common.category_has_forums'));
            }else{
                $category->delete();
                return redirect('/acp/nodes')->with('success', trans('common.category_deleted'));
            }
        }
    }
}
