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

    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-01');
        $datas = Address::getDatas(\Auth::user()->user_id);

        return view('mypage.address.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($address_id){
        Log::saveData( __METHOD__ , 'address_id', $address_id, true);
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-02');

        $data = Address::getData($address_id);
        $prefs = Pref::getNames();

        return view('mypage.address.detail', compact('pagemeta', 'data', 'prefs'));
    }

    public function create(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-03');

        $prefs = Pref::getNames();

        return view('mypage.address.create', compact('pagemeta', 'prefs'));
    }

    public function insert(Request $request){
        Log::saveData( __METHOD__ );
        // Validation
        $this->validationInsert($request);
        $this->insertData($request);

        return redirect('mypage/address');
    }

    public function edit($address_id){
        Log::saveData( __METHOD__ , 'address_id', $address_id, true);
        $pagemeta = Pagemeta::getPagemeta('MY-ADR-06');

        $data = Address::getData($address_id);
        $prefs = Pref::getNames();

        return view('mypage.address.edit', compact('pagemeta', 'data', 'prefs'));
    }

    public function update(Request $request){
        Log::saveData( __METHOD__ );
        // Validation
        $this->validationUpdate($request);
        $this->updateData($request);

        return redirect('mypage/address');
    }

    public function delete($address_id){
        Log::saveData( __METHOD__ , 'address_id', $address_id, true);

        Address::where('address_id', $address_id)
                ->delete();
        UserToAddress::where('address_id', $address_id )
                        ->where('user_id', \Auth::user()->user_id )
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
            'pref_id' => 'required',
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
            'pref_id' => 'required',
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
            'pref_id' => $request['pref_id'],
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
            'pref_id' => $request['pref_id'],
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
