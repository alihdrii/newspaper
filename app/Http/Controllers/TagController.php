<?php

namespace App\Http\Controllers;

use App\news;
use Carbon\Carbon;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public static function todayTag(int $limit = 6){
        $tags = news::allTagModels()->where('updated_at','=',Carbon::today());
        if(count($tags) < $limit)
            return $tags->random(count($tags));
        return $tags->random($limit);
    }

    public static function popularTag(int $limit = 6){
        return news::popularTags($limit);
    }
}
