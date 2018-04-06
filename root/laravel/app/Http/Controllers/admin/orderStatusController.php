<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OrderStatus;
use App\Model\Pagemeta;

class orderStatusController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-ORS-01');
        $datas = OrderStatus::getDatas();

        return view('admin.order_status.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-ORS-03');

        return view('admin.order_status.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/order_status');
    }

    public function edit($status_id){
        $pagemeta = Pagemeta::getPagemeta('AD-ORS-06');
        $data = OrderStatus::getData($status_id);

        return view('admin.order_status.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/order_status');
    }

    public function delete($status_id){
        OrderStatus::where('status_id', $status_id)->delete();

        return redirect('admin/order_status');
    }

    public function validation($request){
        $validates = [
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData(Request $request){
        $now_at = new \Datetime();
        $status_id = OrderStatus::getNewId();
        OrderStatus::create([
            'status_id' => $status_id,
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        OrderStatus::where('status_id', $request['status_id'])->update([
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);
    }

}
