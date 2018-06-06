<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Model\Board;
use App\Model\MyUser;

class Message extends Model
{
    use softDeletes;
    protected $table = 'messages';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'MSG-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    // データ取得
    public static function getDatas($board_id){
        $datas = Message::withTrashed()
                        ->where('board_id', $board_id)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        return $datas;
    }

    public static function getData($message_id){
        $data = Message::where('message_id', $message_id)->first();

        return $data;
    }

    public static function getMessage10( $messages ){
        $latest = $over = [];
        if(!empty($messages)){
            foreach($messages as $k => $message){
                if($k < 10){
                    $latest[] = $message;
                }else{
                    $over[] = $message;
                }
            }
        }
        krsort($latest);
        krsort($over);
        $data = new \stdClass();
        $data->latest = $latest;
        $data->over = $over;

        return $data;
    }

    /**
     * @param string
     * @param string
     * @param boolean
     * @return string
     */
    public static function pushNewMessage($board_data, $body, $filepath=NULL){
        //$board = Board::getData($board_data->board_id);
        //$user = MyUser::where('user_id', $board->user_id)->first();
        $sender_user_id = \Auth::user()->user_id;
        $message_id = Message::getNewId();

        $data = new Message;
        $data->message_id = $message_id;
        $data->board_id = $board_data->board_id;
        $data->sender_user_id = $sender_user_id;
        $data->body = $body;
        $data->filepath = $filepath;
        $data->save();

        return $message_id;
    }


/*
    public static function addMessageDatas(&$data){
        if($data){
            $data->messages = Message::getDatas($data->board_id);
        }
    }
*/
}
