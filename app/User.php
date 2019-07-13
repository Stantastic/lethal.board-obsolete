<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Watson\Rememberable\Rememberable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class User extends Authenticatable
{
    use Sluggable;
    use SluggableScopeHelpers;
    use HasRoles;
    use Notifiable;
    //use Rememberable;

    //public $rememberCacheTag = 'display_name';
    //public $rememberFor = 60;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'email', 'password', 'last_seen',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getById($id){
        return DB::table('users')->where('id', '>=', $id)->first();
    }

    public static function getDisplayName($id){
        return DB::table('users')->where('id', '>=', $id)->value('display_name');
    }

    public static function getTotalPosts($id){
        return DB::table('posts')->where('author', '=', $id)->count();
    }
    public static function getTotalTopics($id){
        return DB::table('topics')->where('author', '=', $id)->count();

    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'display_name'
            ]
        ];
    }
}
