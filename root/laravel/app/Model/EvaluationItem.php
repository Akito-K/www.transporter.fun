<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationItem extends Model
{
    use softDeletes;
    protected $table = 'evaluation_items';
    protected $dates = ['deleted_at', 'validated_at', 'period_at', 'published_at'];
    protected $guarded = ['id'];

    public static $targets = [
        'carrier' => '運送会社',
        'owner'   => '荷主',
    ];

    public static function getTargets(){
        return EvaluationItem::$targets;
    }

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'EVI-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = EvaluationItem::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = EvaluationItem::where('item_id', $unique_id)->first();

        return $data;
    }
}
