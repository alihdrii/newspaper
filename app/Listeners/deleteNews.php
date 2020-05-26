<?php

namespace App\Listeners;

use App\comment;
use App\news;
use App\saved_news;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \App\Events\deleteNews as deleteNewsEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class deleteNews
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(deleteNewsEvent $event)
    {

        foreach($event->news->resource as $item){
            $item->delete();
        }

        foreach($event->news->news_viewer as $item){
            $item->delete();
        }
        foreach($event->news->savedNews as $item){
            $item->delete();
        }
        foreach($event->news->comment_num as $item){
            $item->delete();
        }

        Storage::delete('/public/thumbnail_post/'.$event->news->thumbnail_path);

    }
}
