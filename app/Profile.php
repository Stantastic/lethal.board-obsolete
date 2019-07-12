<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public static function get($id){
        return Profile::where('user_id', $id)->first();
    }
}
