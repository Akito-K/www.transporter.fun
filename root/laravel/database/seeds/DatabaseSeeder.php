<?php

use Illuminate\Database\Seeder;
use App\Model\MySpreadsheet;

use App\Model\Address;
use App\Model\Authority;
use App\Model\Board;
use App\Model\Car;
use App\Model\CarEmpty;
use App\Model\Cargo;
use App\Model\CargoForm;
use App\Model\CargoName;
use App\Model\CargoValue;

use App\Model\Carrier;
use App\Model\CarrierClass;
use App\Model\CarrierEquipment;
use App\Model\CarrierEquipmentValue;
use App\Model\CarrierToCar;
use App\Model\CarrierToClass;
use App\Model\CarValue;

use App\Model\Estimate;
use App\Model\EstimateItem;
use App\Model\EstimateTemp;
use App\Model\Evaluation;
use App\Model\EvaluationStar;
use App\Model\EvaluationItem;

use App\Model\Item;
use App\Model\Log;
use App\Model\Message;
use App\Model\MessageUnopen;
use App\Model\MyUser;
use App\Model\News;

use App\Model\Order;
use App\Model\OrderToCargo;
use App\Model\OrderRequest;
use App\Model\OrderRequestOption;
use App\Model\Owner;
use App\Model\Pref;
use App\Model\Report;
use App\Model\ReportTemp;
use App\Model\Status;
use App\Model\StatusLog;

use App\Model\Upload;
use App\Model\UserToAddress;
use App\Model\UserToAuthority;
use App\Model\Work;


class DatabaseSeeder extends Seeder
{
    protected $datas;
    protected $Excel;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->Excel = new MySpreadsheet();

        $datas = $this->getDatas();
        $this->datas = $this->Excel->getHashedDatas($datas);
//        \Func::var_dump($this->datas);exit;

        $this->AddressSeeder();
        $this->AuthoritySeeder();
        $this->BoardSeeder();
        $this->CarSeeder();
        $this->CarEmptySeeder();
        $this->CargoSeeder();
        $this->CargoFormSeeder();
        $this->CargoNameSeeder();
        $this->CargoValueSeeder();

        $this->CarrierSeeder();
        $this->CarrierClassSeeder();
        $this->CarrierEquipmentSeeder();
        $this->CarrierEquipmentValueSeeder();
        $this->CarrierToCarSeeder();
        $this->CarrierToClassSeeder();
        $this->CarValueSeeder();

        $this->EstimateSeeder();
        $this->EstimateItemSeeder();
        $this->EstimateTempSeeder();
        $this->EvaluationSeeder();
        $this->EvaluationStarSeeder();
        $this->EvaluationItemSeeder();

        $this->ItemSeeder();
        $this->LogSeeder();
        $this->MessageSeeder();
        $this->MessageUnopenSeeder();
        $this->MyUserSeeder();
        $this->NewsSeeder();

        $this->OrderSeeder();
        $this->OrderToCargoSeeder();
        $this->OrderRequestSeeder();
        $this->OrderRequestOptionSeeder();
        $this->OwnerSeeder();
        $this->PrefSeeder();
        $this->ReportSeeder();
        $this->ReportTempSeeder();
        $this->StatusSeeder();
        $this->StatusLogSeeder();

        $this->UploadSeeder();
        $this->UserToAddressSeeder();
        $this->UserToAuthoritySeeder();
        $this->WorkSeeder();

    }

    // エクセルからデータを取得して連想配列に
    public function getDatas() {
        $filepath = __DIR__.'/masters.xlsx';
        $datas = $this->Excel->getExcelData($filepath);

        return $datas;
    }

    public function AddressSeeder(){
        $table_name = 'addresses';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Address::create($data);
                }
            }
        }
    }

    public function AuthoritySeeder(){
        $table_name = 'authorities';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Authority::create($data);
                }
            }
        }
    }

    public function BoardSeeder(){
        $table_name = 'boards';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Board::create($data);
                }
            }
        }
    }

    public function CarSeeder(){
        $table_name = 'cars';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Car::create($data);
                }
            }
        }
    }

    public function CarEmptySeeder(){
        $table_name = 'car_empties';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarEmpty::create($data);
                }
            }
        }
    }

    public function CargoSeeder(){
        $table_name = 'cargos';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Cargo::create($data);
                }
            }
        }
    }

    public function CargoFormSeeder(){
        $table_name = 'cargo_forms';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CargoForm::create($data);
                }
            }
        }
    }

    public function CargoNameSeeder(){
        $table_name = 'cargo_names';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CargoName::create($data);
                }
            }
        }
    }

    public function CargoValueSeeder(){
        $table_name = 'cargo_values';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CargoValue::create($data);
                }
            }
        }
    }

    public function CarrierSeeder(){
        $table_name = 'carriers';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Carrier::create($data);
                }
            }
        }
    }

    public function CarrierClassSeeder(){
        $table_name = 'carrier_classes';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarrierClass::create($data);
                }
            }
        }
    }

    public function CarrierEquipmentSeeder(){
        $table_name = 'carrier_equipments';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarrierEquipment::create($data);
                }
            }
        }
    }

    public function CarrierEquipmentValueSeeder(){
        $table_name = 'carrier_equipment_values';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarrierEquipmentValue::create($data);
                }
            }
        }
    }

    public function CarrierToCarSeeder(){
        $table_name = 'carrier_to_cars';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarrierToCar::create($data);
                }
            }
        }
    }

    public function CarrierToClassSeeder(){
        $table_name = 'carrier_to_classes';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarrierToClass::create($data);
                }
            }
        }
    }

    public function CarValueSeeder(){
        $table_name = 'car_values';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    CarValue::create($data);
                }
            }
        }
    }

    public function EstimateSeeder(){
        $table_name = 'estimates';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Estimate::create($data);
                }
            }
        }
    }

    public function EstimateItemSeeder(){
        $table_name = 'estimate_items';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    EstimateItem::create($data);
                }
            }
        }
    }

    public function EstimateTempSeeder(){
        $table_name = 'estimate_temps';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    EstimateTemp::create($data);
                }
            }
        }
    }

    public function EvaluationSeeder(){
        $table_name = 'evaluations';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Evaluation::create($data);
                }
            }
        }
    }

    public function EvaluationItemSeeder(){
        $table_name = 'evaluation_items';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    EvaluationItem::create($data);
                }
            }
        }
    }

    public function EvaluationStarSeeder(){
        $table_name = 'evaluation_stars';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    EvaluationStar::create($data);
                }
            }
        }
    }

    public function ItemSeeder(){
        $table_name = 'items';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Item::create($data);
                }
            }
        }
    }

    public function LogSeeder(){
        $table_name = 'logs';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Log::create($data);
                }
            }
        }
    }

    public function MessageSeeder(){
        $table_name = 'messages';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Message::create($data);
                }
            }
        }
    }

    public function MessageUnopenSeeder(){
        $table_name = 'message_unopens';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    MessageUnopen::create($data);
                }
            }
        }
    }

    public function MyUserSeeder(){
        $table_name = 'users';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    MyUser::create($data);
                }
            }
        }
    }

    public function NewsSeeder(){
        $table_name = 'news';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    News::create($data);
                }
            }
        }
    }

    public function OrderSeeder(){
        $table_name = 'orders';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Order::create($data);
                }
            }
        }
    }

    public function OrderToCargoSeeder(){
        $table_name = 'order_to_cargos';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    OrderToCargo::create($data);
                }
            }
        }
    }

    public function OrderRequestSeeder(){
        $table_name = 'order_requests';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    OrderRequest::create($data);
                }
            }
        }
    }

    public function OrderRequestOptionSeeder(){
        $table_name = 'order_request_options';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    OrderRequestOption::create($data);
                }
            }
        }
    }

    public function OwnerSeeder(){
        $table_name = 'owners';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Owner::create($data);
                }
            }
        }
    }

    public function PrefSeeder(){
        $table_name = 'prefs';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Pref::create($data);
                }
            }
        }
    }

    public function ReportSeeder(){
        $table_name = 'reports';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Report::create($data);
                }
            }
        }
    }

    public function ReportTempSeeder(){
        $table_name = 'report_temps';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    ReportTemp::create($data);
                }
            }
        }
    }

    public function StatusSeeder(){
        $table_name = 'statuses';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Status::create($data);
                }
            }
        }
    }

    public function StatusLogSeeder(){
        $table_name = 'status_logs';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    StatusLog::create($data);
                }
            }
        }
    }

    public function UploadSeeder(){
        $table_name = 'uploads';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Upload::create($data);
                }
            }
        }
    }

    public function UserToAddressSeeder(){
        $table_name = 'user_to_addresses';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    UserToAddress::create($data);
                }
            }
        }
    }

    public function UserToAuthoritySeeder(){
        $table_name = 'user_to_authorities';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    UserToAuthority::create($data);
                }
            }
        }
    }

    public function WorkSeeder(){
        $table_name = 'works';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    Work::create($data);
                }
            }
        }
    }

}
