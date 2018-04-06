<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use softDeletes;
    protected $table = 'news';
    protected $dates = ['date_at', 'publish_start_at', 'publish_close_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'NWS-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = News::orderBy('date_at', 'DESC')->get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = News::where('news_id', $unique_id)->first();

        return $data;
    }

}
