<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\MyUser;
use App\Model\Car;
use App\Model\Area;
use App\Model\CarEmpty;
use App\Model\Work;
use App\Model\Estimate;

class Carrier extends Model
{
    use softDeletes;
    protected $table = 'carriers';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CRR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDataFromUserId($user_id){
        $data = MyUser::where('user_id', $user_id)->first();

        return Carrier::getData($data->carrier_id);
    }

    public static function getDatas(){
        $datas = Carrier::all();

        return $datas;
    }

    public static function getCarriers(){
        $ary = [];
        $datas = Carrier::getDatas();
        if(!empty($datas)){
            foreach($datas as $data){
                $data->star = view('include.star', ['star' => $data->star])->render();
                $data->total_cars_count    = Car::getTotalCount( $data->carrier_id );
                $data->total_empties_count = CarEmpty::getTotalCount( $data->carrier_id );
                $work_datas = Work::getDataByCarrierId( $data->carrier_id );
                // 受注数
                $data->total_worked_count    = Work::getReceivedOrderCount( $work_datas );
                // 提案数
                $data->total_estimated_order_count = Work::getSuggestedOrderCount( $work_datas );
                // 取引額
                $data->total_transaction_amount = Estimate::getTotalTransactionAmount( $work_datas );

                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getData($carrier_id){
        $data = Carrier::where('carrier_id', $carrier_id)->first();

        return $data;
    }

    public static function getCarrier($carrier_id){
        $data = Carrier::getData($carrier_id);
        if($data){
            $data->tels = \Func::telFormatDecode($data->tel);
        }

        return $data;
    }

    public static function updateData($carrier_id, $request_data){
        $data = Carrier::getData($carrier_id);
        $data->sei = $request_data['sei'];
        $data->mei = $request_data['mei'];
        $data->zip1 = $request_data['zip1'];
        $data->zip2 = $request_data['zip2'];
        $data->pref_id = $request_data['pref_id'];
        $data->city = $request_data['city'];
        $data->address = $request_data['address'];
        $data->tel = \Func::telFormat( $request_data['tels'] );
        $data->site_url = $request_data['site_url'];
        $data->message = $request_data['message'];
        $data->save();
    }

}
