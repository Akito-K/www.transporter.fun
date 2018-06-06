<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\Board;
use App\Model\Message;
use App\Model\MessageUnopen;
/*
use App\Model\Owner;
use App\Model\Order;
use App\Model\Estimate;
use App\Model\Report;
use App\Model\Payment;
use App\Model\EvaluationItem;
use App\Model\Evaluation;
*/
use App\Model\Pagemeta;
use App\Model\Log;

class boardController extends ownerController
{
    public function detailByOrder( $order_id, Request $request ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-BRD-02');

        $my_user_id = \Auth::user()->user_id;
        $your_user_id = MyUser::getCarrierUserIdByOrderId($order_id);

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

        return view('owner.board.detail', compact('pagemeta', 'board_id', 'my_data', 'your_data', 'latest10', 'over10', 'uploadable'));
    }

    public function detailByEstimate( $estimate_id, Request $request ){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-BRD-02');

        $my_user_id = \Auth::user()->user_id;
        $your_user_id = MyUser::getCarrierUserIdByEstimateId($estimate_id);

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

        return view('owner.board.detail', compact('pagemeta', 'board_id', 'my_data', 'your_data', 'latest10', 'over10', 'uploadable'));
    }

}
