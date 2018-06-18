<?php
namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\Board;
use App\Model\Message;
use App\Model\MessageUnopen;

use App\Model\Pagemeta;
use App\Model\Log;

class boardController extends mypageController
{

    public function detailByCarrier( $carrier_id, Request $request ){
        Log::saveData( __METHOD__ , 'carrier_id', $carrier_id, true);
        $pagemeta = Pagemeta::getPagemeta('MY-BD-010');

        $my_user_id = \Auth::user()->user_id;
        $your_user_id = MyUser::getUserIdByCarrierId($carrier_id);

        $my_data = \Auth::user();
        $your_data = MyUser::getData( sha1($your_user_id) );
        $board_id = Board::getBoardId( $my_user_id, $your_user_id );

        if(!$board_id){
            $board_id = Board::createBoard( $my_user_id, $your_user_id );
        }

        $messages = Message::getDatas($board_id);
        $message10 = Message::getMessage10( $messages );
        $latest10 = $message10->latest;
        $over10 = $message10->over;

        // 最新10件のうち相手からのメッセージを既読にする
        MessageUnopen::openMessages($latest10);

        $request->session()->forget('over10.'.$board_id);
        $request->session()->put('over10.'.$board_id, $over10);
        $uploadable = true;

        return view('mypage.board.detail', compact('pagemeta', 'board_id', 'my_data', 'your_data', 'latest10', 'over10', 'uploadable'));
    }

}
