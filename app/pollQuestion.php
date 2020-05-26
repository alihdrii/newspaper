<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pollQuestion extends Model
{
    public function options(){
        return $this->hasMany('\App\pollAnswer','poll_qiestion_id');
    }
}
