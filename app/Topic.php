<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use Illuminate\Support\Facades\DB;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Topic extends Model implements ViewableContract
{
    use Viewable;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'topics';
    protected $fillable = ['locked', 'sticky'];
    public $primaryKey = 'id';
    public $timestamps = true;

    public static function getLatestInForum($id){
        return DB::table('topics')->where('forum', '>=', $id)->latest()->first();
    }

    public static function getLastPost($id){

        $latestPost= DB::table('topics')
            ->join('posts', 'posts.topic', '=', 'topics.id')
            ->where('topics.id', '=', $id)
            ->orderBy('posts.created_at', 'desc')
            ->first();

        if (!empty($latestPost)){
            return $latestPost;
        }else{
            return null;
        }

    }

    public static function getReplyCount($id){

        $count = DB::table('posts')
            ->where('topic', '=', $id)
            ->count();

        return $count;

    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
