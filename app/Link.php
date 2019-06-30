<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //Table Name
    protected $table = 'categories';

    //Primary Key
    public $primaryKey = 'id';

    public $timestamps = false;


}
