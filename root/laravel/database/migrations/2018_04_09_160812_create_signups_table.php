<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 64)->unique();
            $table->datetime('limit_at');

            $table->string('login_id', 32)->nullable();
            $table->string('password')->nullable();
            $table->string('name', 32)->nullable();
            $table->string('email');

            $table->boolean('flag_owner')->nullable();
            $table->boolean('flag_carrier')->nullable();

            $table->string('sei', 32)->nullable();
            $table->string('mei', 32)->nullable();
            $table->string('sei_kana', 32)->nullable();
            $table->string('mei_kana', 32)->nullable();

            $table->string('zip1', 3)->nullable();
            $table->string('zip2', 4)->nullable();
            $table->string('pref_id', 4)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('address', 150)->nullable();

            $table->string('mobile', 20)->nullable();
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
        Schema::dropIfExists('signups');
    }
}
