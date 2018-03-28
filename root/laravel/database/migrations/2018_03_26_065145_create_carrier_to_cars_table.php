<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrierToCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_to_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('carrier_id', 32);
            $table->string('car_id', 32)->nullable();
            $table->integer('count')->unsigned()->default(0);

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
        Schema::dropIfExists('carrier_to_cars');
    }
}
