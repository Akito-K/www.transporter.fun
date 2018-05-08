<?php
namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\UserToAddress;
use App\Model\Address;
use App\Model\Pagemeta;
use App\Model\Pref;
use App\Model\Log;

class addressController extends mypageController
{

    public function showList(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-01');
        $datas = Address::getDatas($me->user_id);
        Log::saveData( 'mypage\addressController@showList');

        return view('mypage.address.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($address_id, Request $request){
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-02');
        $data = Address::getData($address_id);
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);

        Log::saveData( 'mypage\addressController@showDetail', 'address_id', $address_id, true);

        return view('mypage.address.detail', compact('pagemeta', 'data', 'prefs'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-03');
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);

        Log::saveData( 'mypage\addressController@create');

        return view('mypage.address.create', compact('pagemeta', 'prefs'));
    }

    public function insert(Request $request){
        // Validation
        $this->validationInsert($request);
        $this->insertData($request);

        Log::saveData( 'mypage\addressController@insert');

        return redirect('mypage/address');
    }

    public function edit($address_id, Request $request){
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-06');
        $data = Address::getData($address_id);
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);

        Log::saveData( 'mypage\addressController@edit', 'address_id', $address_id, true);

        return view('mypage.address.edit', compact('pagemeta', 'data', 'prefs'));
    }

    public function update(Request $request){
        // Validation
        $this->validationUpdate($request);
        $this->updateData($request);

        Log::saveData( 'mypage\addressController@update');

        return redirect('mypage/address');
    }

    public function delete($address_id, Request $request){
        Log::saveData( 'mypage\addressController@delete', 'address_id', $address_id, true);

        Address::where('address_id', $request['address_id'])
                ->delete();
        UserToAddress::where('address_id', $request['address_id'] )
                        ->where('user_id', $request['me']->user_id )
                        ->delete();

        return redirect('mypage/address');
    }



    public function validationInsert($request){
        $validates = [
            'name' => 'required',
            'sei' => 'required|max:6',
            'mei' => 'required|max:6',
            'zip1' => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'zip_code' => 'requires|numeric',
            'city' => 'required',
            'address' => 'required',
        ];

        $this->validate($request, $validates);
    }

    public function validationUpdate($request){
        $validates = [
            'name' => 'sometimes|required',
            'sei' => 'required|max:6',
            'mei' => 'required|max:6',
            'zip1' => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'zip_code' => 'requires|numeric',
            'city' => 'required',
            'address' => 'required',
        ];

        $this->validate($request, $validates);
    }
    public function insertData(Request $request){
        $now_at = new \Datetime();
        $address_id = Address::getNewId();

        $data = [
            'address_id' => $address_id,
            'name' => $request['name'],
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
            'tel' => \Func::telFormat( $request['tels'] ),
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ];
        Address::create($data);

        $data = [
            'user_id' => $request['me']->user_id,
            'address_id' => $address_id,
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ];
        UserToAddress::create($data);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        $data = [
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
            'tel' => \Func::telFormat( $request['tels'] ),
            'updated_at' => $now_at,
        ];
        if( isset($request['name']) ){
            $data['name'] = $request['name'];
        }

        Address::where('address_id', $request['address_id'])
                ->update($data);
    }
}
