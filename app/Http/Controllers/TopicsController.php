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
     * @param  \Illuminate\Http\Request $request
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
        if (!empty($request->input('color'))) {
            $topic->color = $request->input('color');
        }
        if (!empty($request->input('type'))) {
            $topic->type = $request->input('type');
        }
        $topic->save();

        return redirect('/forum/' . $request->input('forum'))->with('success', trans('common.topic_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $topic = Topic::findBySlug($id);
        views($topic)->record();
        $posts = Post::where('topic', $id)
            ->orderBy('created_at', 'asc')
            ->paginate();

        return view('base.topic.show')->with('topic', $topic)->with('posts', $posts);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);

        if (!isset($topic)){
            return redirect('/acp/nodes')->with('error', trans('common.forum_not_found'));
        }

        if ($topic->author == Auth::id()){
            return view('base.topic.edit')->with('topic', $topic);
        }else{
            return back()->with('success-notify', trans('common.topic_cannot_edit'));
        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'post-body' => 'required'
        ]);
        $topic = Topic::find($id);
        $topic->title = $request->input('title');
        $topic->content = $request->input('post-body');
        $topic->forum = $request->input('forum');
        $topic->author = Auth::id();
        if (!empty($request->input('color'))) {
            $topic->color = $request->input('color');
        }
        if (!empty($request->input('type'))) {
            $topic->type = $request->input('type');
        }
        $topic->save();

        return redirect('/topic/' . $topic->slug)->with('success', trans('common.topic_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        if (!isset($topic)){
            Redirect::back()->with('error', trans('common.topic_not_found'));
        }
        if (isset($topic)){
                $topic->delete();
            return view('base.index')->with('success', trans('common.topic_deleted'));
        }
    }


    public function trigger_lock($id)
    {
        $topic = Topic::find($id);

        if($topic->locked == 0) {
            $topic->update(array('locked' => 1));
            return back()->with('success-notify', trans('common.topic_locked'));
        }elseif($topic->locked == 1) {
            $topic->update(array('locked' => 0));
            return back()->with('success-notify', trans('common.topic_unlocked'));
        }
    }

    public function trigger_stick($id)
    {
        $topic = Topic::find($id);

        if($topic->sticky == 0) {
            $topic->update(array('sticky' => 1));
            return back()->with('success-notify', trans('common.topic_sticked'));
        }elseif($topic->sticky == 1) {
            $topic->update(array('sticky' => 0));
            return back()->with('success-notify', trans('common.topic_unsticked'));
        }
    }
}
