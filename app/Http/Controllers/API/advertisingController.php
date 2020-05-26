<?php

namespace App\Http\Controllers\API;

use App\advertising;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class advertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function newspaperVerAd(){
        $this->CheckExpirationDate();
        $ad_domain = ['1','3'];
        return advertising::where('ad_type','=',0)->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function newspaperHorAd(){
        $this->CheckExpirationDate();
        $ad_domain = ['1','3'];
        return advertising::where('ad_type','=','1')->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function newsHorAd(){
        $this->CheckExpirationDate();
        $ad_domain = ['2','3'];
        return advertising::where('ad_type','=','1')->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    public function newsVerAd(){
        $this->CheckExpirationDate();
        $ad_domain = ['2','3'];
        return advertising::where('ad_type','=','0')->where('status','=', 1)->whereIn('ad_place', $ad_domain)->get();
    }

    private function CheckExpirationDate(){
        $ad = advertising::all();
        foreach ($ad as $adItem){
            if( Carbon::today()->diffInDays($adItem->started_at) > $adItem->period ){
                $adItem->delete();
            }
        }
    }


}
