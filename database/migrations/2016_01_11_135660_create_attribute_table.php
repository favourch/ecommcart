<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 100)->unique();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('attribute_type_id')->unsigned()->nullable();
            $table->integer('order')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('attribute_type_id')->references('id')->on('attribute_types')->onDelete('set null');
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->string('value', 100)->nullable();
            $table->string('color', 20)->nullable();
            $table->integer('attribute_id')->unsigned();
            $table->integer('order')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attribute_values');
        Schema::drop('attributes');
        Schema::drop('attribute_types');
    }
}
