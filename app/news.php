<?php

namespace App;

use App\Events\deleteNews;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class news extends Model
{
    use Taggable;

    protected $appends=['time_ago'];

    protected $dispatchesEvents = [
        'deleting' => deleteNews::class,
    ];

    public function getTimeAgoAttribute(){
        if($this->created_at != null)
            return $this->created_at->diffForHumans();
//        return $this->created_at->formatDifference(Carbon::now());
    }

    public function getPublishedAtAttribute($value)
    {
        $v=new Verta($value);
        return $v->format('H:i   Y/n/d');
    }

    public function author()
    {
        return $this->belongsTo('\App\User','user_id')->select('id','username','name','user_img_path');
    }

    public function cat()
    {
        return $this->belongsTo('\App\cat','cat_id')->select('id','name','slug');
    }

    public function comment_num()
    {
        return $this->hasMany('\App\comment');
    }

    public function news_viewer()
    {
        return $this->morphMany('\App\view','view');
    }

    public function savedNews()
    {
        return $this->hasMany('\App\saved_news');
    }

    public function resource(){
        return $this->hasMany('\App\resource');
    }
}
