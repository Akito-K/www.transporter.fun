<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarEmpty extends Model
{
    use softDeletes;
    protected $table = 'car_empties';
    protected $dates = ['start_at', 'end_at', 'published_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($carrier_id){
        $datas = CarEmpty::where('carrier_id', $carrier_id)->get();

        return $datas;
    }

    public static function getEmpties($carrier_id){
        $ary = [];

        $datas = CarEmpty::getDatas($carrier_id);
        if(!empty($datas)){
            foreach($datas as $data){
                $start_at = new \DatetimeImmutable($data->start_at);
                $end_at = new \DatetimeImmutable($data->end_at);
//                $data->start_at = $start_at;
                $data->start_hour = $start_at->format('H');
                $data->start_minutes = $start_at->format('i');
//                $data->end_at = $end_at;
                $data->end_hour = $end_at->format('H');
                $data->end_minutes = $end_at->format('i');
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getTotalCount($carrier_id){
        $datas = CarEmpty::getDatas($carrier_id);
        $count = 0;
        if(!empty($datas)){
            foreach($datas as $data){
                $count += $data->count;
            }
        }

        return $count;
    }

}
