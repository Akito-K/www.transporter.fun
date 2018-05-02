<?php
namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\UserToAddress;
use App\Model\Address;
use App\Model\Pagemeta;
use App\Model\Log;

class addressController extends mypageController
{

    public function showList(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-01');
        $datas = Address::getDatas($me->user_id);
        Log::saveData( 'mypage\addressController@showList');

        return view('mypage.address.list', compact('pagemeta', 'datas', 'me'));
    }

    public function edit(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-02');
        $datas = Address::getDatas($me->user_id);
        Log::saveData( 'mypage\addressController@edit');

        return view('mypage.address.edit', compact('pagemeta', 'datas', 'me'));
    }

    public function update(Request $request){
        $me = $request['me'];
        $user = MyUser::getData($me->hashed_id);

        // Validation
        $this->validationUpdate($request, $user);

        // 画像保存
        if($request['upload_id']){
            $upload = Upload::getData($request['upload_id']);
            $s3 = new S3();
            $icon_filepath = Upload::saveResizedImages($upload, $s3, 'md');
            $http = env('S3_SSL', 'http');
            $request['icon_filepath'] = $http.'://'.$s3->getBucket().'/'.$icon_filepath;
        }
        $request['hashed_id'] = $me->hashed_id;

        // ユーザー情報更新
        MyUser::updateData($request, ['email']);

        Log::saveData( 'mypage\addressController@update');

        return redirect('mypage/account');
    }

    public function delete($address_id, Request $request){
        $me = $request['me'];

        $pagemeta = Pagemeta::getPagemeta('MY-USR-04');
        $data = MyUser::getUser($me->hashed_id);
        Log::saveData( 'mypage\addressController@delete', 'address_id', $address_id, true);

        return redirect('mypage/address');
    }

}
