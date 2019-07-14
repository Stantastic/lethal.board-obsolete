<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findBySlug($id);
        $profile = Profile::find($user->id);

        return view('base.user.show')->with('user', $user)->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $profile = Profile::find($user->id);

        return view('base.user.edit')->with('user', $user)->with('profile', $profile);
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
        $profile = Profile::find($id);
        $profile->discord = $request->input('inputDiscord');
        $profile->minecraft = $request->input('inputMinecraft');
        $profile->twitter = $request->input('inputTwitter');
        $profile->steam = $request->input('inputSteam');
        $profile->youtube = $request->input('inputYouTube');
        $profile->github = $request->input('inputGitHub');
        $profile->reddit = $request->input('inputReddit');
        $profile->whatsapp = $request->input('inputWhatsApp');
        $profile->bio = $request->input('bio');
        $profile->signature = $request->input('signature');
        $profile->save();

        return back()->with('success', trans('common.profile_updated'));

    }

    /**
     * Store a newly uploaded profile image in the storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeAvatar(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profileID = $request->input('profile');
        $id = $request->input('profile');
        $imageName = time() . '-user_id_' . $profileID . '.' . request()->image->getClientOriginalExtension();
        $path = '/upload/avatars/' . $imageName;

        $profile = Profile::find($id);

        if (file_exists(public_path() . $profile->avatar)) {
            @unlink(public_path() . $profile->avatar);
        }

        $profile->avatar = $path;
        $profile->save();

        request()->image->move(public_path('upload/avatars'), $imageName);

        return back()->with('success', trans('common.profile_avatar_upload_success'));
    }

    /**
     * Remove the specified profile image from the storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAvatar($id)
    {
        if (\Illuminate\Support\Facades\Auth::check()){
            if (auth()->user()->can('mod-user-edit') || auth()->user()->id == $id){
                $profile = Profile::find($id);

                if (file_exists(public_path() . $profile->avatar)) {
                    @unlink(public_path() . $profile->avatar);
                }

                $profile->avatar = null;
                $profile->save();

                return back()->with('success', trans('common.profile_avatar_remove_success'));
            }else{
                return abort(403);
            }
        }else{
            return abort(403);
        }
    }
}
