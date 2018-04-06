<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CarrierClass;
use App\Model\Pagemeta;

class carrierClassController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-CCL-01');
        $datas = CarrierClass::getDatas();

        return view('admin.carrier_class.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-CCL-03');

        return view('admin.carrier_class.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/carrier_class');
    }

    public function edit($class_id){
        $pagemeta = Pagemeta::getPagemeta('AD-CCL-06');
        $data = CarrierClass::getData($class_id);

        return view('admin.carrier_class.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/carrier_class');
    }

    public function delete($class_id){
        CarrierClass::where('class_id', $class_id)->delete();

        return redirect('admin/carrier_class');
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
        $class_id = CarrierClass::getNewId();
        CarrierClass::create([
            'class_id' => $class_id,
            'name' => $request['name'],
            'amount' => $request['amount'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        CarrierClass::where('class_id', $request['class_id'])->update([
            'name' => $request['name'],
            'amount' => $request['amount'],
            'updated_at' => $now_at,
        ]);
    }

}
