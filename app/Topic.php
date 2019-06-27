<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //Table Name
    protected $table = 'topics';

    //Primary Key
    public $primaryKey = 'id';

    public $timestamps = false;
}
