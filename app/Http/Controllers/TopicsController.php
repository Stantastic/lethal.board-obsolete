<?php

namespace App\Http\Controllers;

use App\Forum;
use Illuminate\Http\Request;
use App\Topic;
use App\Post;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($forum)
    {
        $forum = Forum::find($forum);
        return view('base.topic.create')->with('forum', $forum);
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
            'post-body' => 'required'
        ]);

        $topic = new Topic();
        $topic->title = $request->input('title');
        $topic->content = $request->input('post-body');
        $topic->forum = $request->input('forum');
        $topic->author = Auth::id();
        $topic->save();


        return redirect('/forum/' . $request->input('forum'))->with('success', trans('common.topic_created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $topic = Topic::find($id);
        views($topic)->record();
        $posts = Post::where('topic', $id)
            ->orderBy('created_at', 'asc')
            ->paginate();

        return view('base.topic.show')->with('topic', $topic)->with('posts', $posts);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
