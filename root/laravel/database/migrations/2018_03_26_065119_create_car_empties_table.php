<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarEmptiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_empties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('carrier_id', 32);
            $table->string('name', 64)->nullable();
            $table->string('car_id', 32)->nullable();
            $table->string('area', 64)->nullable();

            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->integer('count')->unsigned()->default(0);
            $table->text('notes')->nullable();
            $table->datetime('published_at')->nullable();

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
        Schema::dropIfExists('car_empties');
    }
}
