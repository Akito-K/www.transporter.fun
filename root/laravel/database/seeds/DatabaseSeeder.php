<?php

use Illuminate\Database\Seeder;
use App\Model\MySpreadsheet;

use App\Model\Address;
use App\Model\Authority;
use App\Model\Board;
use App\Model\Car;
use App\Model\Carrier;
use App\Model\CarrierClass;
use App\Model\CarrierEquipment;
use App\Model\CarrierEquipmentValue;
use App\Model\CarrierToCar;
use App\Model\CarrierToClass;
use App\Model\CarEmpty;
use App\Model\CarValue;
use App\Model\Estimate;
use App\Model\EstimateItem;
use App\Model\EstimateTemp;
use App\Model\Evaluation;
use App\Model\Item;
use App\Model\Log;
use App\Model\Message;
use App\Model\MessageUnopen;
use App\Model\MyUser;
use App\Model\News;
use App\Model\Order;
use App\Model\OrderProgress;
use App\Model\OrderStatus;
//use App\Model\OrderValue;
use App\Model\Owner;
use App\Model\Pref;
use App\Model\Report;
use App\Model\ReportTemp;
use App\Model\Upload;
use App\Model\UserToAddress;
use App\Model\UserToAuthority;

use App\Model\Cargo;
use App\Model\CargoValue;
use App\Model\OrderToCargo;
use App\Model\CargoName;
use App\Model\CargoForm;
use App\Model\EvaluationStar;
use App\Model\EvaluationItem;
use App\Model\OrderRequest;
use App\Model\OrderRequestOption;

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

        $this->MyUserSeeder();
        $this->UserToAddressSeeder();
        $this->UserToAuthoritySeeder();
        $this->OwnerSeeder();
        $this->AddressSeeder();
        $this->AuthoritySeeder();
        $this->CarrierSeeder();
        $this->CarrierEquipmentSeeder();
        $this->CarrierEquipmentValueSeeder();
        $this->CarrierClassSeeder();
        $this->CarrierToClassSeeder();
        $this->CarEmptySeeder();
        $this->CarSeeder();
        $this->CarValueSeeder();
        $this->CarrierToCarSeeder();
        //$this->OrderSeeder();
        //$this->OrderValueSeeder();
        //$this->OrderProgressSeeder();
        $this->OrderStatusSeeder();
        //$this->BoardSeeder();
        //$this->MessageSeeder();
        //$this->MessageUnopenSeeder();
        //$this->NewsSeeder();
        //$this->EvaluationSeeder();
        $this->PrefSeeder();
        //$this->UploadSeeder();
        //$this->LogSeeder();
        //$this->Seeder();
        //$this->Seeder();

        //$this->CargoSeeder();
        //$this->CargoValueSeeder();
        //$this->OrderToCargoSeeder();
        $this->CargoNameSeeder();
        $this->CargoFormSeeder();
        //$this->EvaluationStarSeeder();
        $this->EvaluationItemSeeder();
        //$this->OrderRequestSeeder();
        $this->OrderRequestOptionSeeder();

    }

    // エクセルからデータを取得して連想配列に
    public function getDatas() {
        $filepath = __DIR__.'/masters.xlsx';
        $datas = $this->Excel->getExcelData($filepath);

        return $datas;
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

    public function OrderStatusSeeder(){
        $table_name = 'order_statuses';

        DB::table( $table_name )->delete();
        if( isset( $this->datas[ $table_name ])){
            $datas = $this->datas[ $table_name ];

            if(!empty($datas)){
                foreach($datas as $data){
                    OrderStatus::create($data);
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

}
