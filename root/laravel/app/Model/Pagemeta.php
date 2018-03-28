<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pagemeta extends Model
{
    public static function getDefault(){
        $pagemeta = new \stdClass();
        $pagemeta->title = "";
        $pagemeta->keywords = "";
        $pagemeta->description = "";
        $pagemeta->body_class = "";

        return $pagemeta;
    }
}
