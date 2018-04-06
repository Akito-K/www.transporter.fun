<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_id', 32);
            $table->string('target', 32);
            $table->string('name', 32);
            $table->datetime('validated_at');
            $table->datetime('period_at');
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
        Schema::dropIfExists('evaluation_items');
    }
}
