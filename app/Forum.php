<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Forum extends Model
{
    //Table Name
    protected $table = 'forums';

    //Primary Key
    public $primaryKey = 'id';

    public $timestamps = false;

    public static function getLastPostAuthor($id){

            $latestPostAuthor = DB::table('topics')
                ->join('posts', 'posts.topic', '=', 'topics.id')
                ->join('users', 'users.id', '=', 'posts.author')
                ->join('forums', 'topics.forum', '=', 'forums.id')
                ->where('forum', $id)
                ->orderBy('posts.created_at', 'desc')
                ->first();

            return $latestPostAuthor;
    }

}
