<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Topic extends Model implements ViewableContract
{
    use Viewable;

    //Table Name
    protected $table = 'topics';

    //Primary Key
    public $primaryKey = 'id';

    public $timestamps = false;
}
