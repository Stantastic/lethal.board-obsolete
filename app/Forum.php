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

}
