<?php

namespace App;

use EloquentFilter\Filterable;
//use Illuminate\Database\Eloquent\Model as BaseModel;
use Jenssegers\Mongodb\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use Filterable;

//    protected $primaryKey = 'id';
}
