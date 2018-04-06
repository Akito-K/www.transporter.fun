<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CargoCategory;
use App\Model\Pagemeta;

class cargoCategoryController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-CGC-01');
        $datas = CargoCategory::getDatas();

        return view('admin.cargo_category.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-CGC-03');

        return view('admin.cargo_category.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/cargo_category');
    }

    public function edit($category_id){
        $pagemeta = Pagemeta::getPagemeta('AD-CGC-06');
        $data = CargoCategory::getData($category_id);

        return view('admin.cargo_category.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/cargo_category');
    }

    public function delete($category_id){
        CargoCategory::where('category_id', $category_id)->delete();

        return redirect('admin/cargo_category');
    }

    public function validation($request){
        $validates = [
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData(Request $request){
        $now_at = new \Datetime();
        $category_id = CargoCategory::getNewId();
        CargoCategory::create([
            'category_id' => $category_id,
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        CargoCategory::where('category_id', $request['category_id'])->update([
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);
    }

}
