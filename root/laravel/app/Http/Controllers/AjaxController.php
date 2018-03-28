<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Upload;
use App\Model\MyUser;
use App\Model\Board;
use App\Model\Message;
use App\Model\MessageUnopened;
use App\Model\UserToFacility;
use App\Model\NoteBathing;
use App\Model\NoteNail;
use App\Model\NoteReha;
use App\Model\NoteMeal;
use App\Model\NoteMouthcare;

class AjaxController extends Controller
{

    public function getUnreadCount(Request $request){
        $count = MessageUnopened::where('receiver_user_id', \Auth::user()->user_id)->count();
        return $count;
    }

    public function addNoteCreates(Request $request){
        $hashed_id = $request['hashed_id'];
        $data = MyUser::getCustomer($hashed_id);

        $bathings = NoteBathing::getNames();
        $nails = NoteNail::getNames();
        $rehas = NoteReha::getNames();
        $meals = NoteMeal::getNames();
        $mouthcares = Notemouthcare::getNames();
        $num = '*';

        return  json_encode([
            'view' => view('include.admin.note_creates', compact('data', 'bathings', 'nails', 'rehas', 'meals', 'mouthcares', 'num') )->render(),
            ]);
    }

    public function removeNoteCreates(Request $request){
        $hashed_id = $request['hashed_id'];
        $data = MyUser::getCustomer($hashed_id);

        return  json_encode([
            'view' => view('include.admin.note_creates_option', ['data' => $data])->render(),
            ]);
    }

    public function refreshMessages(Request $request){
        $hashed_id = $request['hashed_id'];
        $latest_message_id = $request['message_id'];

        // 新しい順に message_id を取得 -> message_ids [PHP]
        $user = MyUser::where('hashed_id', $hashed_id)->first();
        $board = Board::getDataByUserId($user->user_id);
        $messages = Message::getDatas($board->board_id);
        // 評価して latest にあたれば終了
        $views = [];
        if(!empty($messages)){
            foreach($messages as $message){
                if( $message->message_id == $latest_message_id ){
                    break;
                }else{
                    $views[] = $message;
                    // 既読にする
                    MessageUnopened::where('receiver_user_id', \Auth::user()->user_id)
                                    ->where('message_id', $message->message_id)
                                    ->delete();
                }
            }
        }

        $content = \Func::var_var_dump($views);
        \Func::myFilePutContents($content, NULL, false);

        $unread_count = MessageUnopened::where('receiver_user_id', \Auth::user()->user_id)->count();
        // あたるまでの message_id を view に突っ込む
        if(\Auth::user()->flag_staff){
            $renders = [];
            if(!empty($views)){
                foreach($views as $view){
                    $renders[ $view->message_id ] = view('include.admin.message', ['message' => $view, 'user' => $user])->render();
                }
            }

            return  json_encode([
                'views' => $renders,
                'unread_count' => $unread_count,
                ]);
        }else{

            $renders = [];
            if(!empty($views)){
                foreach($views as $view){
                    $renders[ $view->message_id ] = view('include.mypage.message', ['message' => $view, 'user' => $user])->render();
                }
            }

            return  json_encode([
                'views' => $renders,
                'unread_count' => $unread_count,
                ]);
        }
    }

    public function uploadFileAndPutBoardFile(Request $request){
        $target = $request->input('target');
        if($target != "board-file"){
            exit;
        }

        $original_filename = $request->input('name');
        $extension         = $request->input('ext');
        $posted            = $request->file('file')->isValid();

        $board_id   = $request->input('board_id');
        $memo       = $request->input('memo');
        $body       = $request->input('body');
        $upload_id  = $message_id = Message::getNewId();

        if($posted){
            $filename = $upload_id.'.'.$extension;
            // アップロード先のディレクトリを取得
            $dirs = Upload::getDirectories($target);

            // オリジナルファイルを保存
            Upload::saveFromUpload($request, $dirs['fullpath'], $filename);

            // DB Insert
            Upload::insert([
                'upload_id' => $upload_id,
                'dirpath' => $dirs['path'],
                'extension' => $extension,
                'original_filename' => $original_filename,
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
                ]);

            if( in_array($extension, ['jpg', 'gif', 'png', 'jpeg']) ){
                // 3サイズにリサイズして保存
                foreach(['lg', 'md', 'sm'] as $size){
                    $width = Upload::getWidth($size);
                    $from_fullpath = $dirs['fullpath'].'/'.$filename;
                    $to_fullpath = $dirs['fullpath'].'/'.$upload_id.'_'.$size.'.'.$extension;
                    Upload::resizeAndSave( $width, $from_fullpath, $to_fullpath );
                }

                $filepath = $dirs['path'].'/'.$upload_id.'_sm.'.$extension;
            }else{

                $filepath = $dirs['path'].'/'.$upload_id.'.'.$extension;
            }

            $pushed = Message::pushNewMessage($board_id, $body, $memo, $filepath);
/*
            $board = Board::getData($board_id);
            $user = MyUser::where('user_id', $board->user_id)->first();
            $sender_user_id = \Auth::user()->user_id;
            $message_id = Message::getNewId();

            $data = [
                'message_id' => $message_id,
                'board_id' => $board_id,
                'sender_user_id' => $sender_user_id,
                'body' => $body,
                'filepath' => $filepath,
                'flag_memo' => $memo? 1: NULL,
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ];
            Message::insert($data);
*/
            $board = $pushed->board;
            $user = $pushed->user;
            $message_id = $pushed->message_id;

            // 相手の未読に追加
            MessageUnopened::addReceivers($message_id, $board_id, $board->user_id);

            $message = Message::getData($message_id);

            if(\Auth::user()->flag_staff){

                $renders[ $message_id ] = view('include.admin.message', ['message' => $message, 'user' => $user])->render();
                return  json_encode([
                    'views' => $renders,
                    'result' => $message->message_id == $message_id? 1: 0,
                    ]);
            }else{

                $renders[ $message_id ] = view('include.mypage.message', ['message' => $message, 'user' => $user])->render();
                return  json_encode([
                    'views' => $renders,
                    'result' => $message->message_id == $message_id? 1: 0,
                    ]);
            }
        }
    }

    public function putMessage(Request $request){
        $board_id = $request['board_id'];
        $body = $request['body'];
        $memo = $request['memo'];

        $pushed = Message::pushNewMessage($board_id, $body, $memo);
/*
        $board = Board::getData($board_id);
        $user = MyUser::where('user_id', $board->user_id)->first();
        $sender_user_id = \Auth::user()->user_id;
        $message_id = Message::getNewId();

        $data = [
            'message_id' => $message_id,
            'board_id' => $board_id,
            'sender_user_id' => $sender_user_id,
            'body' => $body,
            'filepath' => NULL,
            'flag_memo' => $memo? 1: NULL,
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ];
        Message::insert($data);
*/
        $board = $pushed->board;
        $user = $pushed->user;
        $message_id = $pushed->message_id;

        // 相手の未読に追加
        MessageUnopened::addReceivers($message_id, $board_id, $board->user_id);

        $message = Message::getData($message_id);

        if(\Auth::user()->flag_staff){

            $renders[ $message_id ] = view('include.admin.message', ['message' => $message, 'user' => $user])->render();
            return  json_encode([
                'views' => $renders,
                'result' => $message->message_id == $message_id? 1: 0,
                ]);
        }else{

            $renders[ $message_id ] = view('include.mypage.message', ['message' => $message, 'user' => $user])->render();
            return  json_encode([
                'views' => $renders,
                'result' => $message->message_id == $message_id? 1: 0,
                ]);
        }
    }

    // 未読に追加
    /**
     * 職員からのメッセージの時、送信先の利用者に未読が付く
     * 利用者からのメッセージの時、所属施設の全職員に未読が付く
     */
/*
    public function addUnopened($message_id, $board_id, $board_user_id){
        if(\Auth::user()->flag_staff){
            // 職員から
            MessageUnopened::putMessage($message_id, $board_id, $board_user_id);
        }else{
            // 利用者から
            $facilities = UserToFacility::getFacilityIds($board_user_id);
            $facility_id = $facilities[0];
            $staff_user_ids = UserToFacility::getStaffIds($facility_id);
            if(!empty($staff_user_ids)){
                foreach($staff_user_ids as $staff_user_id){
                    MessageUnopened::putMessage($message_id, $board_id, $staff_user_id);
                }
            }
        }
    }
*/
    public function getOver10(Request $request){
        $board_id = $request['board_id'];
        $board = Board::getData($board_id);
        $user = MyUser::where('user_id', $board->user_id)->first();
        $over10 = $request->session()->get('over10.'.$board_id);

        $messages = [];
        $i = 0;
        if(!empty($over10)){
            foreach($over10 as $k => $data){
                if($i<10){
                    $messages[] = $data;
                    unset( $over10[$k] );
                }else{
                    break;
                }
                $i++;
            }
        }
        $request->session()->put('over10.'.$board_id, $over10);

        // 既読にする
        MessageUnopened::openMessage($messages);

        return  json_encode([
            'view' => view('include.admin.message', ['messages' => $messages, 'user' => $user])->render(),
            'remain' => count($over10),
            ]);
    }

    public function uploadFile(Request $request){
//        $upload_id         = $request->input('upload_id');
        $upload_id         = Upload::getNewId();
        $original_filename = $request->input('name');
        $extension         = $request->input('ext');
        $type              = $request->input('type');
        $target            = $request->input('target');
        $posted            = $request->file('file')->isValid();

        if($posted){
            $filename = $upload_id.'.'.$extension;
            // アップロード先のディレクトリを取得
            $dirs = Upload::getDirectories($target);

            // オリジナルファイルを保存
            Upload::saveFromUpload($request, $dirs['fullpath'], $filename);

            // DB Insert
            Upload::insert([
                'upload_id' => $upload_id,
                'dirpath' => $dirs['path'],
                'extension' => $extension,
                'original_filename' => $original_filename,
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
                ]);

            if($type == "image"){
                // 3サイズにリサイズして保存
                foreach(['lg', 'md', 'sm'] as $size){
                    $width = Upload::getWidth($size);
                    $from_fullpath = $dirs['fullpath'].'/'.$filename;
                    $to_fullpath = $dirs['fullpath'].'/'.$upload_id.'_'.$size.'.'.$extension;
                    Upload::resizeAndSave( $width, $from_fullpath, $to_fullpath );
                }

                $data = [
                    'path' => $dirs['path'],
                    'filename' => $upload_id.'_sm.'.$extension,
                    'uploaded_id' => $upload_id,
                    ];

                return json_encode($data);
            }
        }
    }
}
