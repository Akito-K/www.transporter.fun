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

    public static function saveData($request_data, $estimate_id){
        $request_data = (object) $request_data;
        if(!empty($request_data->items)){
            foreach($request_data->items as $num => $item){
                $data = new Estimate;
                $data->estimate_id = $estimate_id;
                $data->code = $item->item_code;
                $data->name = $item->item_name?: '';
                $data->amount = $item->item_amount?: 0;
                $data->count = $item->item_count?: 0;
                $data->notes = $item->item_notes;
                $data->save();
            }
        }
    }

}
