<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    //Table Name
    protected $table = 'categories';

    //Primary Key
    public $primaryKey = 'id';

    public $timestamps = false;

    public static function getCategoryName($id){
       return DB::table('categories')->where('id', '>=', $id)->value('name');
    }

}
