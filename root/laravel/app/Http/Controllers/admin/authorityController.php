<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Authority;
use App\Model\Pagemeta;

class authorityController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-AT-000');
        $datas = Authority::getAuthorities();

        return view('admin.authority.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-AT-020');

        return view('admin.authority.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/authority');
    }

    public function edit($authority_id){
        $pagemeta = Pagemeta::getPagemeta('AD-AT-050');
        $data = Authority::getData($authority_id);

        return view('admin.authority.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/authority');
    }

    public function delete($authority_id){
        Authority::where('authority_id', $authority_id)->delete();

        return redirect('admin/authority');
    }

    public function validation($request){
        $validates = [
            'authority_id' => 'required',
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData($request){
        $now_at = new \Datetime();
        Authority::create([
            'authority_id' => $request['authority_id'],
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData($request){
        $now_at = new \Datetime();
        Authority::where('id', $request['id'])->update([
            'authority_id' => $request['authority_id'],
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);
    }

}
