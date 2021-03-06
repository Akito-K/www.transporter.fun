<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estimate_id', 32)->unique();
            $table->string('order_id', 32);
            $table->string('carrier_id', 32);
//            $table->string('client_name', 100);
            $table->string('order_name', 100);

            $table->text('suggest_message')->nullable();
            $table->text('place_message')->nullable();
            $table->text('receive_message')->nullable();
            $table->string('estimate_number', 64)->nullable();

            $table->datetime('estimated_at');
            $table->datetime('limit_at');
            $table->datetime('suggested_at')->nullable();
            $table->datetime('placed_at')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->datetime('received_at')->nullable();
            $table->text('notes')->nullable();
//            $table->string('payment_code', 32);

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
        Schema::dropIfExists('estimates');
    }
}
