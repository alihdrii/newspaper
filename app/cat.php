<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class cat extends Model
{
    //

    protected $fillable=[
        'name',
    ];

    public function news()
    {
        return $this->hasMany('\App\news');
    }
}
