<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OrderRequestOption;
use App\Model\Pagemeta;

class orderRequestOptionController extends adminController
{

    // 希望車種
    public function showCarList(){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-000');
        $datas = OrderRequestOption::getTypeDatas('car');

        return view('admin.order_request_option.car.list', compact('pagemeta', 'datas'));
    }

    public function createCar(){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-020');

        return view('admin.order_request_option.car.create', compact('pagemeta'));
    }

    public function insertCar(Request $request){
        // Validation
        $this->validationCar($request);

        $now_at = new \Datetime();
        $option_id = OrderRequestOption::getNewId();
        OrderRequestOption::create([
            'option_id' => $option_id,
            'type' => 'car',
            'class' => $request['class'],
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);

        return redirect('admin/order_request_option/car');
    }

    public function editCar($option_id){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-050');
        $data = OrderRequestOption::getData($option_id);

        return view('admin.order_request_option.car.edit', compact('pagemeta', 'data'));
    }

    public function updateCar(Request $request){
        // Validation
        $this->validationCar($request);

        $now_at = new \Datetime();
        OrderRequestOption::where('option_id', $request['option_id'])->update([
            'class' => $request['class'],
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);

        return redirect('admin/order_request_option/car');
    }

    public function deleteCar($option_id){
        OrderRequestOption::where('option_id', $option_id)->delete();

        return redirect('admin/order_request_option/car');
    }

    public function validationCar($request){
        $validates = [
            'class' => 'required',
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }




    // 希望車種
    public function showEquipmentList(){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-001');
        $datas = OrderRequestOption::getTypeDatas('equipment');

        return view('admin.order_request_option.equipment.list', compact('pagemeta', 'datas'));
    }

    public function createEquipment(){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-021');

        return view('admin.order_request_option.equipment.create', compact('pagemeta'));
    }

    public function insertEquipment(Request $request){
        // Validation
        $this->validationEquipment($request);

        $now_at = new \Datetime();
        $option_id = OrderRequestOption::getNewId();
        OrderRequestOption::create([
            'option_id' => $option_id,
            'type' => 'equipment',
            'name' => $request['name'],
            'unit' => $request['unit'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);

        return redirect('admin/order_request_option/equipment');
    }

    public function editEquipment($option_id){
        $pagemeta = Pagemeta::getPagemeta('AD-OR-051');
        $data = OrderRequestOption::getData($option_id);

        return view('admin.order_request_option.equipment.edit', compact('pagemeta', 'data'));
    }

    public function updateEquipment(Request $request){
        // Validation
        $this->validationEquipment($request);

        $now_at = new \Datetime();
        OrderRequestOption::where('option_id', $request['option_id'])->update([
            'name' => $request['name'],
            'unit' => $request['unit'],
            'updated_at' => $now_at,
        ]);

        return redirect('admin/order_request_option/equipment');
    }

    public function deleteEquipment($option_id){
        OrderRequestOption::where('option_id', $option_id)->delete();

        return redirect('admin/order_request_option/equipment');
    }

    public function validationEquipment($request){
        $validates = [
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }




    // 希望車種
    public function showOtherList(){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-002');
        $datas = OrderRequestOption::getTypeDatas('other');

        return view('admin.order_request_option.other.list', compact('pagemeta', 'datas'));
    }

    public function createOther(){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-022');

        return view('admin.order_request_option.other.create', compact('pagemeta'));
    }

    public function insertOther(Request $request){
        // Validation
        $this->validationOther($request);

        $now_at = new \Datetime();
        $option_id = OrderRequestOption::getNewId();
        OrderRequestOption::create([
            'option_id' => $option_id,
            'type' => 'other',
            'name' => $request['name'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);

        return redirect('admin/order_request_option/other');
    }

    public function editOther($option_id){
        $pagemeta = Pagemeta::getPagemeta('AD-RO-052');
        $data = OrderRequestOption::getData($option_id);

        return view('admin.order_request_option.other.edit', compact('pagemeta', 'data'));
    }

    public function updateOther(Request $request){
        // Validation
        $this->validationOther($request);

        $now_at = new \Datetime();
        OrderRequestOption::where('option_id', $request['option_id'])->update([
            'name' => $request['name'],
            'updated_at' => $now_at,
        ]);

        return redirect('admin/order_request_option/other');
    }

    public function deleteOther($option_id){
        OrderRequestOption::where('option_id', $option_id)->delete();

        return redirect('admin/order_request_option/other');
    }

    public function validationOther($request){
        $validates = [
            'name' => 'required',
            ];

        $this->validate($request, $validates);
    }




}
