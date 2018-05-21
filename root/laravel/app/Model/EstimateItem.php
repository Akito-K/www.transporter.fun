<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateItem extends Model
{
    use softDeletes;
    protected $table = 'estimate_items';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = EstimateItem::where('estimate_id', $unique_id)->get();

        return $datas;
    }

    public static function duplicateData($old_estimate_id, $new_estimate_id){
        $date_at = new \Datetime();
        $old_datas = EstimateItem::where('estimate_id', $old_estimate_id)->get();
        if($old_datas){
            foreach($old_datas as $old_data){
                $new_data = $old_data->replicate();
                $new_data->estimate_id = $new_estimate_id;
                $new_data->save();
            }
        }
    }

    public static function saveData($request_data, $estimate_id){
        $request_data = (object) $request_data;
        if(!empty($request_data->item_code)){
            foreach($request_data->item_code as $num => $v){
                $data = new EstimateItem;
                $data->estimate_id = $estimate_id;
                $data->code = $request_data->item_code[$num];
                $data->name = $request_data->item_name[$num]?: '';
                $data->amount = $request_data->item_amount[$num]?: 0;
                $data->count = $request_data->item_count[$num]?: 0;
                $data->notes = $request_data->item_notes[$num];
                $data->save();
            }
        }
    }

}
