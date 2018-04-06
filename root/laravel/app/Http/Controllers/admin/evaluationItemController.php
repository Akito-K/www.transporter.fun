<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EvaluationItem;
use App\Model\Pagemeta;

class evaluationItemController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-EVI-01');
        $datas = EvaluationItem::getDatas();
        $targets = EvaluationItem::getTargets();

        return view('admin.evaluation_item.list', compact('pagemeta', 'datas', 'targets'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-EVI-03');
        $targets = EvaluationItem::getTargets();

        return view('admin.evaluation_item.create', compact('pagemeta', 'targets'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/evaluation_item');
    }

    public function edit($item_id){
        $pagemeta = Pagemeta::getPagemeta('AD-EVI-06');
        $data = EvaluationItem::getData($item_id);
        $targets = EvaluationItem::getTargets();

        return view('admin.evaluation_item.edit', compact('pagemeta', 'data', 'targets'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/evaluation_item');
    }

    public function delete($item_id){
        EvaluationItem::where('item_id', $item_id)->delete();

        return redirect('admin/evaluation_item');
    }

    public function validation($request){
        $validates = [
            'name' => 'required',
            'hide_validated_at' => 'required',
            'hide_period_at' => 'required',
            ];

        $this->validate($request, $validates);
    }

    public function insertData(Request $request){
        $now_at = new \Datetime();
        $item_id = EvaluationItem::getNewId();
        $validated_at = ($request['hide_validated_at'])? new \Datetime($request['hide_validated_at']): null;
        $period_at = ($request['hide_period_at'])? new \Datetime($request['hide_period_at']): null;
        $published_at = ($request['publish'])? new \Datetime(): null;
        EvaluationItem::create([
            'item_id' => $item_id,
            'target' => $request['target'],
            'name' => $request['name'],
            'validated_at' => $validated_at,
            'period_at' => $period_at,
            'published_at' => $published_at,
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        $validated_at = ($request['hide_validated_at'])? new \Datetime($request['hide_validated_at']): null;
        $period_at = ($request['hide_period_at'])? new \Datetime($request['hide_period_at']): null;
        $published_at = ($request['publish'])? new \Datetime(): null;
        EvaluationItem::where('item_id', $request['item_id'])->update([
            'target' => $request['target'],
            'name' => $request['name'],
            'validated_at' => $validated_at,
            'period_at' => $period_at,
            'published_at' => $published_at,
            'updated_at' => $now_at,
        ]);
    }

}
