<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    public function view(){
        return $this->morphTo();
    }
}
