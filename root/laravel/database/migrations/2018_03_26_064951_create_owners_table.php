<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_id', 32)->unique();
            $table->string('company', 32)->nullable();
            $table->string('section', 32)->nullable();
            $table->string('role', 32)->nullable();
            $table->float('star', 8, 2)->nullable();

            $table->string('sei', 32)->nullable();
            $table->string('mei', 32)->nullable();
            $table->string('zip1', 3)->nullable();
            $table->string('zip2', 4)->nullable();
            $table->string('pref_id', 4)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('tel', 20)->nullable();

            $table->text('message')->nullable();
            $table->string('site_url', 64)->nullable();

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
        Schema::dropIfExists('owners');
    }
}
