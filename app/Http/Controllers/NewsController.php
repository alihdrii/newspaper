<?php

namespace App\Http\Controllers;

use App\cat;
use App\news;
use App\report;
use App\reported;
use App\saved_news;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class newsController extends Controller
{
    //

    public function store(){

    }

    public function edit(){

    }

    public function delete(){

    }

    private $skip;
    private $news = [];
    private $returning_news;
    private $morePageNews = false;

    public function getNewsByCategory($numberOfReturningNews,$skip=0,$orderBy='viewer')
    {
        $this->skip=$skip;
        $this->news=[];
        $cats = cat::all();
        foreach ($cats as $cat){
            array_push($this->news, $this->retrieve_news($cat->id, $numberOfReturningNews,$orderBy));
        }
        return $this->news;
    }

    public function getHotNews($numberOfReturningNews = 5 )
    {
        return news::where('status','=','1')->whereDate('published_at','>=',Carbon::now()->subDays(10))->withCount('comment_num')->orderByDesc('comment_num_count')->take($numberOfReturningNews)->get();
    }

    public function getSuggestionNews($numberOfReturningNews = 6 )
    {
        if (Auth::check()) {
            $news = news::where('status', '=', '1')->where('user_id', '<>', Auth::id())->orderByDesc('published_at')->get()->random($numberOfReturningNews);
            return $this->handleRandomSuggestionNews($news,$numberOfReturningNews);
        }

        return  news::where('status', '=', '1')->orderByRaw('RAND()')->take(10)->get();
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
    // if not exist today_news get halfWeekNews and ...
    private function retrieve_news($cat_id, $numberOfReturningNews,$orderBy)
    {
        $period=0;
        while($this->get_news_of_specific_period($period,$cat_id, $numberOfReturningNews,$orderBy)){
            $period++;
        }
        return $this->returning_news;
    }

    //best in page
    public function getBestOfCatInPeriod($cat,$period,$numOfRetNews,$skip = 0,$orderBy = 'viewer'){
        return news::whereDate('published_at','>=', Carbon::now()->subDays($period))->where('cat_id','=',$cat)->where('status','=','1')->orderByDesc($orderBy)->skip($skip)->take($numOfRetNews)->get();
    }

    public function getPageNews($cat, $numberOfReturningNews,$orderBy='viewer', $type= 'sidebar'){

        $period=0;
        while($this->get_news_of_specific_period($period,$cat, $numberOfReturningNews,$orderBy)){
            $period++;
        }

        return [
                "news" => $this->returning_news,
                "more_news" => $this->moreNewsCheck($cat, $numberOfReturningNews),
        ];

    }

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

    private function get_news_of_specific_period($index,$cat_id, $numOfRetNews,$orderBy){

        $this->returning_news = cat::where('id','=',$cat_id)->with(['news' => function($query) use ($index,$numOfRetNews,$orderBy){
            $query->whereDate('published_at','>=', Carbon::now()->subDays($index))->where('status','=','1')->orderByDesc('published_at')->orderByDesc($orderBy)->skip($this->skip)->take($numOfRetNews);
        }])->first();

        if ( $this->returning_news->news->isEmpty() || ($this->returning_news->news->count()< $numOfRetNews && $index<=2)) {
            return true;
        }
        return false;
    }

    //check view
    private function view_news($ip,$id){

        if ($this->set_news_viewer($id,$ip)) {
            $news = news::find($id);
            $news->count = $news->count + 1;
            if($news->save())
                return redirect($news->url);
        }
    }

    private function set_news_viewer($news_id,$ip)
    {
//        if(!$own_post) {
  //          if ($viewed->count() > 0) {
    //            $re = $viewed->first();
      //          if ($re->created_at->diffInSeconds(Carbon::now()) > 120) {
        //            return true;
          //      }
            //    return false;
            //}
//            return true;
  //      }
        $news = news::find($news_id);
        $view = new view;
        $view->ip_address = $ip;
        $view->user_id = $this->auth_check();

        if($news->news_viewer()->save($view))
            return true;
        return false;
    }

    private function auth_check(){

        if(Auth::check())
            return Auth::id();
        return null;
    }

    public function savedNews($id){
        if(!Auth::check()){
            return false;
        }
        $result = saved_news::where('user_id', '=', Auth::id())->where('news_id','=',$id)->count();

        if($result==1)
            return true;
        return false;
    }

    public function saveNews(Request $request){
        Auth::user()->savedNews()->attach($request->post('id'));
        return back();
    }

    public function unSaveNews(Request $request){
        Auth::user()->savedNews()->detach($request->post('id'));
        return back();
    }

    public function submitReport(Request $request,$id)
    {
        $news = news::findOrFail($id);
        $report = report::findOrFail($request->post('reportId'));
        $reported = new reported();
        $reported->user_id = Auth::id();
        $reported->news_id = $news->id;
        $reported->report_id = $report->id;
        $reported->save();

    }
}
