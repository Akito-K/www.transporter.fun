<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\UserToAuthority;
use App\Model\Authority;
use App\Model\Pagemeta;
use App\Model\Log;
use App\Model\Upload;
use App\Model\S3;
use App\Model\Pref;

class userController extends adminController
{

    Public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('AD-USR-01');
        $users = MyUser::getUsers();
        $authorities = Authority::getNames();

        return view('admin.user.list', compact('pagemeta', 'users', 'authorities'));
    }

    public function showDetail($hashed_id){
        $data = MyUser::getUser($hashed_id);
        Log::saveData( __METHOD__ , 'user_id', $data->user_id, true );
        $pagemeta = Pagemeta::getPagemeta('AD-USR-02');
        $authorities = Authority::getNames();
        $prefs = Pref::getNames();

        return view('admin.user.detail', compact('pagemeta', 'data', 'authorities', 'prefs'));
    }

    public function create(){
        Log::saveData( __METHOD__ );

        $pagemeta = Pagemeta::getPagemeta('AD-USR-03');
        $authorities = Authority::getNames();
        $prefs = Pref::getNames();

        return view('admin.user.create', compact('pagemeta', 'authorities', 'prefs'));
    }

    public function edit($hashed_id){
        $data = MyUser::getUser($hashed_id);
        Log::saveData( __METHOD__ , 'user_id', $data->user_id, true);
        $pagemeta = Pagemeta::getPagemeta('AD-USR-06');
        $authorities = Authority::getNames();
        $prefs = Pref::getNames();

        return view('admin.user.edit', compact('pagemeta', 'data', 'authorities', 'prefs'));
    }



    public function insert(Request $request){
        // Validation
        $this->validationInsert($request);

        $user_id = MyUser::getNewId();
        // 画像保存
        if($request['upload_id']){
            $upload = Upload::getData($request['upload_id']);
            $s3 = new S3();
            $icon_filepath = Upload::saveResizedImages($upload, $s3, 'md');
            $http = env('S3_SSL', 'http');
            $request['icon_filepath'] = $http.'://'.$s3->getBucket().'/'.$icon_filepath;
        }

        // ユーザー情報挿入
        MyUser::insertData($request, $user_id);
        // 権限更新
        UserToAuthority::updateDatas($request, $user_id);

        Log::saveData( __METHOD__ , 'user_id', $user_id, true );

        return redirect('admin/user/'.sha1($user_id).'/detail');
    }


    public function update(Request $request){
        $hashed_id = $request['hashed_id'];
        $user = MyUser::getData($hashed_id);

        // Validation
        if($request['login_id'] != $user->login_id){
            $this->validationUpdate1($request);
        }else{
            $this->validationUpdate2($request);
        }

        // 画像保存
        if($request['upload_id']){
            $upload = Upload::getData($request['upload_id']);
            $s3 = new S3();
            $icon_filepath = Upload::saveResizedImages($upload, $s3, 'md');
            $http = env('S3_SSL', 'http');
            $request['icon_filepath'] = $http.'://'.$s3->getBucket().'/'.$icon_filepath;
        }

        // ユーザー情報更新
        MyUser::updateData($request, ['zip1', 'zip2', 'pref_id', 'city', 'address']);
        // 権限更新
        UserToAuthority::updateDatas($request, $user->user_id);

        Log::saveData( __METHOD__ , 'user_id', $user->user_id, true );

        return redirect('admin/user/'.$hashed_id.'/detail');
    }

    public function delete($hashed_id){
        $user = MyUser::getData($hashed_id);
        Log::saveData( __METHOD__ , 'user_id', $user->user_id, true );
        MyUser::deleteData($hashed_id);
        UserToAuthority::deleteData($user->user_id);

        return redirect('admin/user');
    }

    public function ban($hashed_id){
        $user = MyUser::getData($hashed_id);
        Log::saveData( __METHOD__ , 'user_id', $user->user_id, true );
        MyUser::ban($hashed_id);

        return redirect('admin/user');
    }


    public function validationInsert($request){
        $validates = [
            'login_id' => 'required|min:4|max:32|unique:users',
            'password' => 'required|min:8|max:32|confirmed',
            'name' => 'required|max:10',
            'sei' => 'required|max:20',
            'mei' => 'required|max:20',
            'sei_kana' => 'required|max:20',
            'mei_kana' => 'required|max:20',
            'email' => 'required|max:50',
            ];
        $this->validate($request, $validates);
    }

    public function validationUpdate1($request){
        $validates = [
            'login_id' => 'required|min:4|max:32|unique:users',
            'password' => 'required|min:8|max:32',
            'sei' => 'required|max:20',
            'mei' => 'required|max:20',
            'sei_kana' => 'required|max:20',
            'mei_kana' => 'required|max:20',
            ];
        $this->validate($request, $validates);
    }

    public function validationUpdate2($request){
        $validates = [
            'sei' => 'required|max:20',
            'mei' => 'required|max:20',
            'sei_kana' => 'required|max:20',
            'mei_kana' => 'required|max:20',
            ];
        $this->validate($request, $validates);
    }


}
