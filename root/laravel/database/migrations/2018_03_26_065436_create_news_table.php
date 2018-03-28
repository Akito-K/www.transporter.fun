<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_id', 32)->unique();
            $table->datetime('date_at')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();

            $table->datetime('publish_start_at')->nullable();
            $table->datetime('publish_close_at')->nullable();
            $table->boolean('flag_unpublish')->index()->nullable();

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
        Schema::dropIfExists('news');
    }
}
