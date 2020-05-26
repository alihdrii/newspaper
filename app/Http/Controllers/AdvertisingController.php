<?php

namespace App\Http\Controllers;

use App\advertising;
use App\view;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\classes\adRetrieve;
use Illuminate\Support\Facades\Auth;

class advertisingController extends Controller
{
    //
    public function store(){

    }

    public function edit(){

    }

    public function retrieve(){

    }

    public function delete(){

    }

    public function getNewspaperAd(){

        $this->CheckExpirationDate();
        $ad = [
            "ver_ad" => $this->getNewspaperVerAd(),
            "hor_ad" => $this->getNewspaperHorAd(),
            "top_mobile_ad" => $this->getTopMobileAd(),
            "bottom_mobile_ad" => $this->getBottomMobileAd()
        ];
        return $ad;
    }

    public function getNewsAd(){

        $this->CheckExpirationDate();
        $ad = [
            "ver_ad" => $this->getNewsVerAd(),
            "hor_ad" => $this->getNewsHorAd(),
            "top_mobile_ad" => $this->getTopMobileAd(),
            "bottom_mobile_ad" => $this->getBottomMobileAd()
        ];
        return $ad;
    }


    private function CheckExpirationDate(){
        $ad = advertising::all();
        foreach ($ad as $adItem){
            if( Carbon::today()->diffInDays($adItem->started_at) > $adItem->period ){
                $adItem->delete();
            }
        }
    }

    public function getNewspaperVerAd(){
        $ad_domain = ['1','3'];
        return advertising::where('ad_type','=',0)->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function getNewspaperHorAd(){
        $ad_domain = ['1','3'];
        return advertising::where('ad_type','=','1')->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function getNewsVerAd(){
        $ad_domain = ['2','3'];
        return advertising::where('ad_type','=',0)->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function getNewsHorAd(){
        $ad_domain = ['2','3'];
        return advertising::where('ad_type','=',1)->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function getTopMobileAd(){
        return advertising::where('ad_type','=','3')->where('status','=', 1)->get();
    }

    public function getBottomMobileAd(){
        return advertising::where('ad_type','=','4')->where('status','=', 1)->get();
    }

    public function view_ad(Request $request,$id){

        $ip = $request->ip();
        if ($this->set_ad_viewer($id,$ip)) {
            $ad = advertising::find($id);
            $ad->count = $ad->count + 1;
            if($ad->save())
                return redirect($ad->url);
        }
    }

    private function set_ad_viewer($ad_id,$ip)
    {
        $ad = advertising::find($ad_id);
        $view = new view;
        $view->ip_address = $ip;
        $view->user_id = $this->auth_check();

        if($ad->ad_viewer()->save($view))
            return true;
        return false;
    }

    private function auth_check(){

        if(Auth::check())
            return Auth::id();
        return null;

    }
}
