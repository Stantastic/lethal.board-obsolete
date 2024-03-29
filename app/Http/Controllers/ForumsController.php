<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Forum;
use App\Category;
use App\Topic;



class ForumsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum = Forum::find($id);
        $topics = Topic::where('forum', $id)
            ->orderBy('sticky', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        if ($forum === null){
            return abort(404);
        }

        return view('base.forum')->with('forum', $forum)->with('topics', $topics);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.forums.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required'
        ]);

        $forum = new Forum();
        $forum->name = $request->input('title');
        $forum->description = $request->input('description');
        $forum->category = $request->input('category');
        $forum->save();


        return redirect('/acp/nodes')->with('success', trans('common.forum_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum = Forum::find($id);

        if ($forum === null){
            return abort(404);
        }

        if (!isset($forum)){
            return redirect('/acp/nodes')->with('error', trans('common.forum_not_found'));
        }

        $categories = Category::all();
        return view('admin.forums.edit')->with('post', $forum)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required'
        ]);

        $forum = Forum::find($id);
        $forum->name = $request->input('title');
        $forum->description = $request->input('description');
        $forum->type = $request->input('category');
        $forum->save();

        return redirect('/acp/nodes')->with('success', trans('common.forum_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);
        if (!isset($forum)){
            return redirect('/acp/nodes')->with('error', trans('common.forum_not_found'));
        }
        if (isset($forum)){
            if((DB::table('forums')->join('topics', 'forums.id', '=', 'topics.forum')->where('forums.id', $forum->id)->count())>0){
                return redirect('/acp/nodes')->with('error-confirm', trans('common.forum_has_topics'));
            }else{
                $forum->delete();
                return redirect('/acp/nodes')->with('success', trans('common.forum_deleted'));
            }
        }
    }
}
