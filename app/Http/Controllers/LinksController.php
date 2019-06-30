<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Category;

class LinksController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.create');
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
            'title' => 'required',
            'url' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->input('title');

        $category->description = $request->input('description');
        $category->url = $request->input('url');
        $category->type = 'link';
        $category->save();


        return redirect('/acp/nodes')->with('success', trans('common.link_created'));
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

        if (!isset($category)){
            return redirect('/acp/nodes')->with('error', trans('common.link_not_found'));
        }

        return view('admin.links.edit')->with('post', $category);
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
        $category->url = $request->input('url');
        $category->type = 'link';
        $category->save();

        return redirect('/acp/nodes')->with('success', trans('common.link_updated'));

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
            return redirect('/acp/nodes')->with('error', trans('common.link_not_found'));
        }
        if (isset($category)){

                $category->delete();
                return redirect('/acp/nodes')->with('success', trans('common.link_deleted'));

        }
    }


}
