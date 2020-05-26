<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    public function reply(){
        return $this->hasMany('\App\comment','parent_id');
    }
}
