<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function showNews($id,$slug_title){
        $newsController = new newsController();
        $data = [
            "general_header" => $this->getGeneralHeaderInformation('news'),
            "id" => $id
        ];
        return view('news',compact('data'));
    }

    private function getGeneralHeaderInformation($place){
        $v =  Verta(Carbon::now());
        return [
            "clock" =>  $v->format('H:i'),
            "date" => $v->formatWord('l dS F'),
            "place" => $place,
        ];
    }
}
