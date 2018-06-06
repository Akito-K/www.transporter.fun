<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\EvaluationItem;
use App\Model\EvaluationStar;

class Evaluation extends Model
{
    use softDeletes;
    protected $table = 'evaluations';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'EVL-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Evaluation::where('evaluation_id', $unique_id)->first();

        return $data;
    }

    public static function saveData( $type, $target_user_id, $my_user_id, $order_id, $request_data ){
        $evaluation_id = Evaluation::getNewId();
        $data = new Evaluation;
        $data->evaluation_id = $evaluation_id;
        $data->type = $type;
        $data->user_id = $target_user_id;
        $data->evaluated_by = $my_user_id;
        $data->order_id = $order_id;
        $data->save();

        $names = EvaluationItem::getActiveNames($type);
        if(!empty($request_data['evaluates'])){
            foreach($request_data['evaluates'] as $item_id => $val){
                $data = new EvaluationStar;
                $data->evaluation_id = $evaluation_id;
                $data->name = $names[$item_id];
                $data->star = $val;
                $data->save();
            }
        }

    }

}
