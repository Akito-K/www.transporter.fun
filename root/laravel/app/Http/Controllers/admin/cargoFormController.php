<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CargoForm;
use App\Model\Pagemeta;

class cargoFormController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-CGF-01');
        $datas = CargoForm::getDatas();

        return view('admin.cargo_form.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-CGF-03');

        return view('admin.cargo_form.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/cargo_form');
    }

    public function edit($form_id){
        $pagemeta = Pagemeta::getPagemeta('AD-CGF-06');
        $data = CargoForm::getData($form_id);

        return view('admin.cargo_form.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/cargo_form');
    }

    public function delete($form_id){
        CargoForm::where('form_id', $form_id)->delete();

        return redirect('admin/cargo_form');
    }

    public function validation($request){
        $validates = [
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData(Request $request){
        $now_at = new \Datetime();
        $form_id = CargoForm::getNewId();
        CargoForm::create([
            'form_id' => $form_id,
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        CargoForm::where('form_id', $request['form_id'])->update([
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);
    }

}
