<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\newsCollection;
use App\Http\Traits\newsTrait;
use App\news;
use Illuminate\Http\Request;

class newsController extends Controller
{
    use newsCollection,newsTrait;
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
        $news = news::findOrFail($id);
        $news->delete();
        return ["message"=>"ok"];
    }

    public function newspaperSlidebarNews()
    {
        return $this->getNewsByCategory(7);
    }

    public function newspaperBestNews()
    {
        return $this->getNewsByCategory(1);
    }

    public function newspaperHeadlineNews()
    {
        return $this->getNewsByCategory(1,1);
    }

    public  function newspaperSuggestionNews(Request $request)
    {
        return $this->getSuggestionNews($request,5);
    }
    public function newspaperHotNews()
    {
        return $this->getHotNews();
    }

    public function newsSlidebarNews()
    {
        return $this->getNewsByCategory(7);
    }

    public function getMainNews(Request $request,$id)
    {
        if($request->user()) {
            $news = news::where('id', '=', $id)->where('status', '=', '1')->with('author', 'cat')->withCount('comment_num')->first();
//            $this->sa
        }
        else{

        }
    }

}
