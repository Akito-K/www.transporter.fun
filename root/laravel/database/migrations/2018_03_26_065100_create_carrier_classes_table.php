<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrierClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_id', 32)->unique();
            $table->string('name', 32);
            $table->integer('amount')->unsigned()->default(0);

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
        Schema::dropIfExists('carrier_classes');
    }
}
