<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use softDeletes;
    protected $table = 'boards';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'BOD-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($board_id){
        $data = Board::where('board_id', $board_id)->first();

        return $data;
    }

    /**
     * @param string
     * @param string
     * @return object
     */
    public static function getBoardId( $user_id_1, $user_id_2 ){
        $data = Board::where('user_id_1', $user_id_1)
                      ->where('user_id_2', $user_id_2)
                      ->first();
        if(!$data){
            $data = Board::where('user_id_1', $user_id_2)
                          ->where('user_id_2', $user_id_1)
                          ->first();
        }

        return $data? $data->board_id: NULL;
    }

    public static function getYourUserId($board){
        $my_user_id = \Auth::user()->user_id;
        if($board->user_id_1 == $my_user_id){
            return $board->user_id_2;
        }else{
            return $board->user_id_1;
        }
    }

    public static function createBoard($user_id_1, $user_id_2){
        $data = new Board;
        $data->board_id = Board::getNewId();
        $data->user_id_1 = $user_id_1;
        $data->user_id_2 = $user_id_2;
        $data->save();
    }

}
