<?php

namespace App\Http\Traits;

use App\news;
use Carbon\Carbon;

trait newsTrait {
    //main news
    public function getMainNews($id,$slug_title){
//        if($this->view_news($request->ip(),$id))
        return $news = news::where('id','=',$id)->where('status','=','1')->with('author','cat')->withCount('comment_num')->first();
    }


    public function page_sidebar_more_news(Request $request){

        $request->validate([
            'skip' => ['bail','required','numeric'],
            'id' => ['bail','required','numeric'],
        ]);

        $skip = $request->post('skip');
        $cat_id = $request->post('id');

        return [
            "news" => news::whereDate('published_at','>=', Carbon::today())->where('cat_id','=',$cat_id)->where('status','=','1')->orderByDesc('viewer')->skip($skip*1)->take($skip*1)->get(),
            "more_news" => $this->moreNewsCheck($cat_id, 20 , ( $skip * 20 )),
        ];
    }

    private function moreNewsCheck($cat, $numberOfReturningNews , $skip = 0){
        $result = news::whereDate('published_at','>=', Carbon::today())->where('cat_id','=',$cat)->where('status','=','1')->get('id');
        if($result != null && $result->count() > $numberOfReturningNews+$skip ){
            $this->morePageNews = true;
        }
        return $this->morePageNews;
    }

    public function saved($id,$user){
        return (bool) news::savedNews()->where('user_id',$user)->first();
    }

}
