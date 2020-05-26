<?php

namespace App\Http\Controllers;

use App\advertising;
use App\cat;
use App\report;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class retrieverController extends Controller
{

    //newspaper
    public function newspaper(Request $request){

        $newsController = new newsController();
        $data = [
            "Auth" => Auth::user(),
            "profile_header" => $this->getProfileHeaderInformation(),
            "general_header" => $this->getGeneralHeaderInformation('home'),
            "best_news" => $newsController->getNewsByCategory(1),
            "sidebar_news" => $newsController->getNewsByCategory(7),
            "headline_news" => $newsController->getNewsByCategory(1,1),
            "hot_news" => $newsController->getHotNews(5),
            "suggestion_news" => $newsController->getSuggestionNews(5),
            "poll" => (new pollController())->getPoll($request),
            "today_tag" => tagController::todayTag(8),
            "popular_tag" => tagController::popularTag(8),
            "ad" => (new advertisingController())->getNewspaperAd(),
            "category" => $this->get_cat()
        ];
        return view('newspaper',compact('data'));
    }

    //page
    public function page($cat){
        $cat_id=$this->getcatId($cat);
        $newsController = new newsController();
        $data = [
            "Auth" => Auth::user(),
            "profile_header" => $this->getProfileHeaderInformation(),
            "general_header" => $this->getGeneralHeaderInformation($cat),
            "new_news" => $newsController->getPageNewNews($cat_id->id),
            "sidebar" => $newsController->getPageNews($cat_id->id,20),
            "best_news" => $newsController->getBestOfCatInPeriod($cat_id->id,10,1),
            "important_news" => $newsController->getBestOfCatInPeriod($cat_id->id,5,10,1),
            "best_journalist" => (new journalistController())->getBestJoutnalistInCat($cat_id->id,3),
            "today_tag" => tagController::todayTag(8),
            "popular_tag" => tagController::popularTag(8),
            "ad" => (new advertisingController())->getNewspaperAd(),
            "category" => $this->get_cat()
        ];
        return view('page',compact('data'));
    }

    //single news
    public function news($id,$slug_title){

        $newsController = new newsController();
        $data = [
            "Auth" => Auth::user(),
            "profile_header" => $this->getProfileHeaderInformation(),
            "general_header" => $this->getGeneralHeaderInformation('news'),
            "sidebar_news" => $newsController->getNewsByCategory(7),
            "news" => $newsController->getMainNews($id,$slug_title),
            "savedNews" => $newsController->savedNews($id),
            "reportItems" => report::where('report_type','0')->get(),
            "today_tag" => tagController::todayTag(8),
            "popular_tag" => tagController::popularTag(8),
            "ad" => (new advertisingController())->getNewsAd(),
            "category" => $this->get_cat()
        ];
        return view('news',compact('data'));

    }

    //registery page
    public function registery_page(){
        $newsController = new newsController();
        $data = [
            "general_header" => $this->getGeneralHeaderInformation('video'),
            "ad" => (new advertisingController())->getNewspaperAd(),
        ];
        return view('password.registery',compact('data'));
    }

    //forget password
    public function forget_password(){
        $newsController = new newsController();
        $data = [
            "general_header" => $this->getGeneralHeaderInformation('video'),
            "ad" => (new advertisingController())->getNewspaperAd(),
        ];
        return view('password.forgetPass',compact('data'));
    }

    //validation email
    public function validation_email(){
        $newsController = new newsController();
        $data = [
            "general_header" => $this->getGeneralHeaderInformation('video'),
            "ad" => (new advertisingController())->getNewspaperAd(),
        ];
        return view('password.validationEmail',compact('data'));
    }

    private function getProfileHeaderInformation()
    {
        if (Auth::check()) {
            return [
                "unread" => Auth::user()->unreadNotifications()->get(),
                "read" => Auth::user()->readNotifications()->get(),
                "img" => Auth::user()->user_img_path,
                "username" => Auth::user()->username,
                "name" => Auth::user()->name,
            ];
        }
    }

    private function getGeneralHeaderInformation($place){
        $v =  Verta(Carbon::now());
        return [
           "clock" =>  $v->format('H:i'),
           "date" => $v->formatWord('l dS F'),
           "place" => $place,
        ];
    }

    private function get_cat(){
        return cat::all();
    }

    //get cat id by name
    private function getCatId($cat){
        return cat::where('slug' ,'=' , $cat)->first('id');
    }
}
