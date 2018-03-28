<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MessageUnopen extends Model
{
    protected $table = 'message_unopens';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getUnreadMessageCount($user_id=NULL){
        $user_id = $user_id?: \Auth::user()->user_id;

        return MessageUnopen::where('receiver_user_id', $user_id)->orderBy('id', 'ASC')->count();
    }

    public static function getCount($board_id){
        $user_id = \Auth::user()->user_id;
        $count = MessageUnopen::where('board_id', $board_id)->where('receiver_user_id', $user_id)->count();

        return $count;
    }

    public static function openMessage($messages){
        $user_id = \Auth::user()->user_id;
        if(!empty($messages)){
            foreach($messages as $message){
                MessageUnopen::where('message_id', $message->message_id)->where('receiver_user_id', $user_id)->delete();
            }
        }
    }

    // 未読に追加
    public static function putMessage($message_id, $board_id, $receiver_user_id){
        MessageUnopen::insert([
            'message_id' => $message_id,
            'board_id' => $board_id,
            'receiver_user_id' => $receiver_user_id,
        ]);
    }

    public static function deleteDatas($user_id){
        MessageUnopen::where('receiver_user_id', $user_id)->delete();
        $message_ids = Message::getDatasByUserId($user_id);
        if(!empty($message_ids)){
            foreach($message_ids as $message_id){
                MessageUnopen::where('message_id', $message_id)->delete();
            }
        }
    }
/*
    public static function addReceivers($message_id, $board_id, $board_user_id){
        if(\Auth::user()->flag_staff){
            // 職員から
            MessageUnopen::putMessage($message_id, $board_id, $board_user_id);
        }else{
            // 利用者から
            $facilities = UserToFacility::getFacilityIds($board_user_id);
            $facility_id = $facilities[0];
            $staff_user_ids = UserToFacility::getStaffIds($facility_id);
            if(!empty($staff_user_ids)){
                foreach($staff_user_ids as $staff_user_id){
                    MessageUnopen::putMessage($message_id, $board_id, $staff_user_id);
                }
            }
        }
    }
*/
}
