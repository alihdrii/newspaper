<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class journalistController extends Controller
{
    //
    public function markAsRead(){
        $unread= Auth::user()->unreadNotifications()->get();
        foreach ($unread as $notify){
            $notify->markAsRead();
        }
    }

    public function getBestJoutnalistInCat($cat_id,$numOfRet){
        return User::where('activity','=',$cat_id)->withCount('followers')->orderByDesc('followers_count')->take($numOfRet)->get();
    }
}
