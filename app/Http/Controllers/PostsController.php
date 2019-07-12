<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
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
    public function create($topic)
    {
        $topic = Topic::find($topic);
        return view('base.post.create')->with('topic', $topic);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = New Post();
        $post->content = $request->input('post-body');
        $post->topic = $request->input('topic');
        $post->author = Auth::id();
        $post->save();

        $topic = Topic::find($request->input('topic'));

        return redirect('/topic/' . $topic->slug)->with('success', trans('common.post_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $topic = Topic::find($post->topic);
        return view('base.post.edit')->with('topic', $topic)->with('post', $post);
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
        $post = Post::find($id);
        $post->content = $request->input('post-body');
        $post->increment('times_edited');
        $post->save();

        $topic = Topic::find($post->topic);

        return redirect('/topic/' . $topic->slug)->with('success', trans('common.post_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!isset($post)){
            return back()->with('error', trans('common.post_not_found'));
        }
        if (isset($post)){
            $post->delete();
            return back()->with('success', trans('common.post_deleted'));
        }
    }
}
