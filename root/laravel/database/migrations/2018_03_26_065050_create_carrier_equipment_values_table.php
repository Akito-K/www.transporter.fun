<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrierEquipmentValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_equipment_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('equipment_id', 32);
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->integer('turn')->unsigned()->default(0);

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrier_equipment_values');
    }
}
