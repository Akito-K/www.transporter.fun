<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id', 32)->unique();
            $table->string('owner_id', 32)->index();
            $table->string('class_id', 32)->index();
            $table->string('name', 100)->nullable();
//            $table->integer('count')->unsigned()->default(0);

//            $table->string('send_address_id', 32)->nullable();
            $table->string('send_name', 32)->nullable();
            $table->string('send_zip1', 3)->nullable();
            $table->string('send_zip2', 4)->nullable();
            $table->string('send_pref_code', 2)->nullable();
            $table->string('send_city')->nullable();
            $table->string('send_address')->nullable();
            $table->string('send_tel', 20)->nullable();

//            $table->string('arrive_address_id', 32)->nullable();
            $table->string('arrive_name', 32)->nullable();
            $table->string('arrive_zip1', 3)->nullable();
            $table->string('arrive_zip2', 4)->nullable();
            $table->string('arrive_pref_code', 2)->nullable();
            $table->string('arrive_city')->nullable();
            $table->string('arrive_address')->nullable();
            $table->string('arrive_tel', 20)->nullable();

            $table->datetime('send_at')->nullable();
            $table->datetime('arrive_at')->nullable();
//            $table->text('body')->nullable();
            $table->text('notes')->nullable();
            $table->string('status_code', 20)->nullable();
            $table->integer('amount_hope_min')->unsigned()->default(0);
            $table->integer('amount_hope_max')->unsigned()->default(0);

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
        Schema::dropIfExists('orders');
    }
}
