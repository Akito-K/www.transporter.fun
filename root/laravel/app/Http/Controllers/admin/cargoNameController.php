<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CargoName;
use App\Model\Pagemeta;

class cargoNameController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-CN-000');
        $datas = CargoName::getDatas();

        return view('admin.cargo_name.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-CN-020');

        return view('admin.cargo_name.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/cargo_name');
    }

    public function edit($name_id){
        $pagemeta = Pagemeta::getPagemeta('AD-CN-050');
        $data = CargoName::getData($name_id);

        return view('admin.cargo_name.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/cargo_name');
    }

    public function delete($name_id){
        CargoName::where('name_id', $name_id)->delete();

        return redirect('admin/cargo_name');
    }

    public function validation($request){
        $validates = [
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData($request){
        $now_at = new \Datetime();
        $name_id = CargoName::getNewId();
        CargoName::create([
            'name_id' => $name_id,
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData($request){
        $now_at = new \Datetime();
        CargoName::where('name_id', $request['name_id'])->update([
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);
    }

}
