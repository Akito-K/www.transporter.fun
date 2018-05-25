<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public static $payment_types = [
        '' => '--',
        'counter' => '金融機関窓口',
        'atm' => '金融機関ATM',
        'net' => 'ネットバンギング',
    ];

    public static function getTypes(){
        return Payment::$payment_types;
    }

}
