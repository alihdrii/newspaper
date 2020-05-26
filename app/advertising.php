<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class advertising extends Model
{
    use SoftDeletes;

    public function ad_viewer(){
        return $this->morphMany('App\view','view');
    }

}
