<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Carrier;
use App\Model\Pref;
use App\Model\Car;
use App\Model\Area;
use App\Model\CarEmpty;
use App\Model\Upload;
use App\Model\S3;
use App\Model\Pagemeta;
use App\Model\Log;

class accountController extends carrierController
{
    public function showDetail(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-USR-01');
        $carrier_id = \Auth::user()->carrier_id;
        $carrier_data = Carrier::getData($carrier_id);
        $carrier_data->star = view('include.star', ['star' => $carrier_data->star])->render();
        $prefs = Pref::getNames();

        $car_datas = Car::getCars($carrier_id);
        $empty_datas = CarEmpty::getDatas($carrier_id);
        $area_names = Area::getNames();

        return view('carrier.account.detail', compact('pagemeta', 'carrier_data', 'prefs', 'car_datas', 'empty_datas', 'area_names'));
    }

    public function editCars(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-USR-02');
        $carrier_id = \Auth::user()->carrier_id;
        $car_datas = Car::getDatas($carrier_id);

        return view('carrier.account.edit_cars', compact('pagemeta', 'car_datas'));
    }

    public function updateCars( Request $request ){
        $request_data = $request->all();
        $carrier_id = \Auth::user()->carrier_id;
        Car::where('carrier_id', $carrier_id)->delete();

        if(!empty($request_data['names'])){
            foreach($request_data['names'] as $num => $name){
                $count = $request_data['counts'][$num];
                $upload_id = $request_data['upload_ids'][$num];
                $filepath = $request_data['filepathes'][$num];

                // 画像保存
                if($upload_id){
                    $upload = Upload::getData($upload_id);
                    $s3 = new S3();
                    $icon_filepath = Upload::saveResizedImages($upload, $s3, 'md');
                    $http = env('S3_SSL', 'http');
                    $filepath = $http.'://'.$s3->getBucket().'/'.$icon_filepath;
                }

                $car_id = Car::getNewId();
                $data = new Car;
                $data->car_id = $car_id;
                $data->carrier_id = $carrier_id;
                $data->name = $name;
                $data->filepath = $filepath;
                $data->count = $count;
                $data->save();
            }
        }

        return redirect('carrier/account');
    }

    public function editEmpties(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-USR-03');
        $carrier_id = \Auth::user()->carrier_id;
        $car_datas = Car::getDatas($carrier_id);
        $car_names = Car::getNames($carrier_id);
        $area_names = Area::getNames();
        $empty_datas = CarEmpty::getEmpties($carrier_id);

        return view('carrier.account.edit_empties', compact('pagemeta', 'car_names', 'car_datas', 'area_names', 'empty_datas'));
    }

    public function updateEmpties( Request $request ){
        $request_data = $request->all();
        $carrier_id = \Auth::user()->carrier_id;
        CarEmpty::where('carrier_id', $carrier_id)->delete();

        if(!empty($request_data['car_ids'])){
            foreach($request_data['car_ids'] as $num => $car_id){
                $start_at      = $request_data['hide_empty_start_'.$num.'_at'];
                $start_hour    = $request_data['empty_start_hours'][$num];
                $start_minutes = $request_data['empty_start_minuteses'][$num];

                $end_at        = $request_data['hide_empty_end_'.$num.'_at'];
                $end_hour      = $request_data['empty_end_hours'][$num];
                $end_minutes   = $request_data['empty_end_minuteses'][$num];

                $name = $request_data['names'][$num];
                $notes = $request_data['noteses'][$num];
                $area_id = $request_data['area_ids'][$num];
                $count = $request_data['counts'][$num]?: 0;

                if($car_id){
                    $data = new CarEmpty;
                    $data->carrier_id = $carrier_id;
                    $data->name = $name;
                    $data->car_id = $car_id;
                    $data->area_id = $area_id;
                    $data->start_at = new \Datetime( $start_at.''.$start_hour.':'.$start_minutes.':00' );
                    $data->end_at = new \Datetime( $end_at.''.$end_hour.':'.$end_minutes.':00' );
                    $data->notes = $notes;
                    $data->published_at = new \Datetime();
                    $data->count = $count;
                    $data->save();
                }
            }
        }

        return redirect('carrier/account');
    }
}