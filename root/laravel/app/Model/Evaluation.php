<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\EvaluationItem;
use App\Model\EvaluationStar;
use App\Model\Carrier;
use App\Model\Owner;

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

    /**
     * @param string 'carrier' | 'owner'
     * @param string
     * @param string
     * @param string
     * @param array
     * @return void
     */
    public static function saveData( $type, $target_user_id, $my_user_id, $order_id, $request_data ){
        $evaluation_id = Evaluation::getNewId();

        $vals = [];
        $names = EvaluationItem::getActiveNames($type);
        if(!empty($request_data['evaluates'])){
            foreach($request_data['evaluates'] as $item_id => $val){
                $vals[] = $val;
                $data = new EvaluationStar;
                $data->evaluation_id = $evaluation_id;
                $data->name = $names[$item_id];
                $data->star = $val;
                $data->save();
            }
        }

        $data = new Evaluation;
        $data->evaluation_id = $evaluation_id;
        $data->type = $type;
        $data->user_id = $target_user_id;
        $data->evaluated_by = $my_user_id;
        $data->order_id = $order_id;
        $data->star = Evaluation::getThisStar($vals);
        $data->save();

        // Star 集計
        $begin_at = new \Datetime();
        $begin_at->modify('-1 year');
        $stars = Evaluation::where('created_at', '>=', $begin_at)
                            ->where('user_id', $target_user_id)
                            ->orderBy('created_at', 'DESC')
                            ->limit(30)
                            ->pluck('star')
                            ->toArray();
        $new_star = \Func::getAverage($stars);

        if($type == 'carrier'){
            $target_data = Carrier::getDataFromUserId($target_user_id);
        }elseif($type == 'owner'){
            $target_data = Owner::getDataFromUserId($target_user_id);
        }
        $target_data->star = $new_star;
        $target_data->save();
    }

    public static function getThisStar($vals){
        $star = \Func::getAverage($vals);
        if( max($vals) >= 4.5){
            $star += 1;
        }
        if( min($vals) <= 0.5){
            $star -= 1;
        }

        if($star > 5){
            $star = 5;
        }elseif($star < 0){
            $star = 0;
        }

        return $star;
    }

}
