<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pollQuestion;
use App\pollAnswer;
use App\poll;
use Carbon\Carbon;

class pollController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'q_id' => ['bail','required','numeric'],
            'a_id' => ['bail','required','numeric'],
        ]);
        $ip = $request->ip();
        $q_id = $request->post('q_id');
        $a_id = $request->post('a_id');
        if($this->checkPoll($ip , $q_id)){
            $poll = new poll;
            $poll->ip = $ip ;
            $poll->poll_qiestion_id = $q_id;
            if($poll->save()){
                $result = [];
                $answer = pollAnswer::find($a_id);
                $answer->increment('vote');
                $array = pollAnswer::where('poll_qiestion_id','=',$q_id)->get('vote');
                foreach($array as $item){
                    array_push($result , $item->vote);
                }
                return $result;
            }
        }
    }

    public function getPoll($request){
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
