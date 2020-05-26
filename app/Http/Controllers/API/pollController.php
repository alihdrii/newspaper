<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\poll;
use App\pollQuestion;
use Illuminate\Http\Request;

class pollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    public function getPoll(Request $request){
        $poll = pollQuestion::where('status','=','1')->with('options')->get();

        return [
            "data" => $poll,
            "status" => $this->checkPoll($request->ip(),$poll),
        ];
    }

    private function checkPoll($ip,$q){
        if($q->count()==0)
            return false;
        $pollResult=poll::where('poll_qiestion_id','=',$q[0]->id)->where('ip','=',$ip)->count();
        if($pollResult>0)
            return false;
        return true;
    }
}
