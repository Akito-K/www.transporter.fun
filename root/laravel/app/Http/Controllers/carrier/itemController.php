<?php

namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Item;
use App\Model\Pagemeta;
use App\Model\Log;

class itemController extends carrierController
{

    public function showList(Request $request){
        $me = $request['me'];
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-ITM-01');
        $datas = Item::getDatas($me->carrier_id);

        return view('carrier.item.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($item_id, Request $request){
        Log::saveData( __METHOD__ , 'item_id', $item_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-ITM-02');
        $data = Item::getData($item_id);

        return view('carrier.item.detail', compact('pagemeta', 'data'));
    }

    public function create(Request $request){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-ITM-03');

        return view('carrier.item.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        Log::saveData( __METHOD__ );
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('carrier/item');
    }

    public function edit($item_id, Request $request){
        $pagemeta = Pagemeta::getPagemeta('CR-ITM-06');
        $data = Item::getData($item_id);
        Log::saveData( __METHOD__ , 'item_id', $item_id, true);

        return view('carrier.item.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        Log::saveData( __METHOD__ , 'item_id', $request['item_id'], true);
        // Validation
        $this->validation($request);
        $this->updateData($request);


        return redirect('carrier/item');
    }

    public function delete($item_id, Request $request){
        Log::saveData( __METHOD__ , 'item_id', $item_id, true);
        Item::where('item_id', $item_id)->delete();

        return redirect('carrier/item');
    }

    public function validation($request){
        $validates = [
            'name' => 'required',
            'amount' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData(Request $request){
        $now_at = new \Datetime();
        $item_id = Item::getNewId();
        Item::create([
            'item_id' => $item_id,
            'carrier_id' => $request['me']->carrier_id,
            'code' => $request['code'],
            'name' => $request['name'],
            'amount' => $request['amount'],
            'notes' => $request['notes'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        Item::where('item_id', $request['item_id'])->update([
            'code' => $request['code'],
            'name' => $request['name'],
            'amount' => $request['amount'],
            'updated_at' => $now_at,
        ]);
    }

}
