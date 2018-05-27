<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use softDeletes;
    protected $table = 'payments';
    protected $dates = ['deleted_at', 'payed_at'];
    protected $guarded = ['id'];


    public static $payment_types = [
        '' => '--',
        'counter' => '金融機関窓口',
        'atm' => '金融機関ATM',
        'net' => 'ネットバンギング',
    ];

    public static function getTypes(){
        return Payment::$payment_types;
    }

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'PMT-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($order_id){
        return Payment::where('order_id', $order_id)->first();
    }

    public static function getPayedData($order_id){
        $data = Payment::getData($order_id);
        if($data){
            $types = Payment::getTypes();
            $data->type_str = $types[ $data->type ];
        }

        return $data;
    }

    public static function saveData($order_id, $request_data){
        $request_data = (object) $request_data;
        $payed_at = $request_data->hide_payed_at.' '.$request_data->payed_at_hour.':00:00';

        $data = new Payment;
        $data->payment_id = Payment::getNewId();
        $data->order_id   = $order_id;
        $data->payed_at = new \Datetime( $payed_at );
        $data->type = $request_data->type;
        $data->bank_name = $request_data->bank_name;
        $data->amount = $request_data->amount;
        $data->save();
    }

}
