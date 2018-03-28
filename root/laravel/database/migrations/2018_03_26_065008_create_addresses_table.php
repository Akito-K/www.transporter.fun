<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_id', 32)->unique();
            $table->string('name', 32);
            $table->string('sei', 32)->nullable();
            $table->string('mei', 32)->nullable();

            $table->string('zip_code', 8)->nullable();
            $table->string('pref_code', 2)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('tel', 20)->nullable();

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
        Schema::dropIfExists('addresses');
    }
}
