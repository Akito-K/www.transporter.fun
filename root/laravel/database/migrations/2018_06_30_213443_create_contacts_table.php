<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_id', 32)->unique();
            $table->string('type_id', 32);
            $table->string('subject_id', 32)->nullable();
            $table->string('company', 32)->nullable();
            $table->string('section', 32)->nullable();

            $table->string('sei', 32)->nullable();
            $table->string('mei', 32)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('tel', 20)->nullable();
            $table->text('body')->nullable();

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
        Schema::dropIfExists('contacts');
    }
}
