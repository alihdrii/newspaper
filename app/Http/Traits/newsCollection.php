<?php

namespace App\Http\Traits;

use App\cat;
use App\news;
use Carbon\Carbon;

trait newsCollection{

    private $skip;
    private $news = [];
    private $returning_news;
    private $morePageNews = false;

    public function getNewsByCategory($numberOfReturningNews,$skip=0,$orderBy='viewer')
    {
        $this->skip=$skip;
        $this->news=[];
        $cats = $this->getCat();
        foreach ($cats as $cat){
            array_push($this->news, $this->retrieve_news($cat->id, $numberOfReturningNews,$orderBy));
        }
        return $this->news;
    }

    public function getHotNews($numberOfReturningNews = 5 )
    {
        return news::where('status','=','1')->whereDate('published_at','>=',Carbon::now()->subDays(10))->withCount('comment_num')->orderByDesc('comment_num_count')->take($numberOfReturningNews)->get();
    }

    public function getSuggestionNews($req,$numberOfReturningNews = 6 )
    {
        if ($req->user()) {
            $news = news::where('status', '=', '1')->where('user_id', '<>', $req->user()->id)->orderByDesc('published_at')->get()->random($numberOfReturningNews);
            return $this->handleRandomSuggestionNews($news,$numberOfReturningNews);
        }

        return  news::where('status', '=', '1')->orderByRaw('RAND()')->take($numberOfReturningNews)->get();
    }

    //new news of page
    public function getPageNewNews($cat){
        return news::where('status','=','1')->where('cat_id','=',$cat)->whereDate('published_at',Carbon::now())->orderBy('published_at')->take(5)->get();
    }

    private function handleRandomSuggestionNews($news,$retNum){
        if (count($news)<$retNum){
            return $news->get()->random(count($news));
        }
        else
            return $news->random($retNum);
    }

    // retrieve today_news
    // if not exist today_news get 1 day ago and ...
    private function retrieve_news($cat_id, $numberOfReturningNews,$orderBy)
    {
        $period=0;
        while($this->getNews($period,$cat_id, $numberOfReturningNews,$orderBy)){
            $period++;
        }
        return $this->returning_news;
    }

    //best in page
    public function getBestOfCatInPeriod($cat,$period,$numOfRetNews,$skip = 0,$orderBy = 'viewer'){
        return news::whereDate('published_at','>=', Carbon::now()->subDays($period))->where('cat_id','=',$cat)->where('status','=','1')->orderByDesc($orderBy)->skip($skip)->take($numOfRetNews)->get();
    }

    public function getPageNews($cat, $numberOfReturningNews,$orderBy='viewer', $type= 'sidebar')
    {
        $period=0;
        while($this->get_news_of_specific_period($period,$cat, $numberOfReturningNews,$orderBy)){
            $period++;
        }

        return [
            "news" => $this->returning_news,
            "more_news" => $this->moreNewsCheck($cat, $numberOfReturningNews),
        ];
    }

    private function getCat()
    {
        return cat::all();
    }

    private function getNews($period,$cat_id, $numOfRetNews,$orderBy = 'viewer')
    {
        $this->returning_news = cat::where('id','=',$cat_id)->with(['news' => function($query) use ($period,$numOfRetNews,$orderBy){
            $query->whereDate('published_at','>=', Carbon::now()->subDays($period))->where('status','=','1')->orderByDesc('published_at')->orderByDesc($orderBy)->skip($this->skip)->take($numOfRetNews);
        }])->first();

        if ( $this->returning_news->news->isEmpty() || ($this->returning_news->news->count()< $numOfRetNews && $period<=2)) {
            return true;
        }
        return false;
    }

}
