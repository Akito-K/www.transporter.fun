<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_name', 32);
            $table->string('unique_id', 32);
            $table->string('status_id', 32)->nullable();
            $table->string('method', 128);
            $table->string('user_id', 32);

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
        Schema::dropIfExists('status_logs');
    }
}
