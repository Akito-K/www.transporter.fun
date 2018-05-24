<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_id', 32)->unique();
            $table->string('work_id', 32);
            $table->string('order_id', 32);
            $table->string('carrier_id', 32);

            $table->datetime('arrived_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->text('trouble')->nullable();
            $table->text('comment')->nullable();

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
        Schema::dropIfExists('reports');
    }
}
