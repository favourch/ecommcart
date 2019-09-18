<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packagings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->string('name');
            $table->decimal('width', 20, 6)->nullable();
            $table->decimal('height', 20, 6)->nullable();
            $table->decimal('depth', 20, 6)->nullable();
            $table->decimal('cost', 20, 6)->nullable();
            $table->boolean('default')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('inventory_packaging', function (Blueprint $table) {
            $table->integer('packaging_id')->unsigned()->index();
            $table->foreign('packaging_id')->references('id')->on('packagings')->onDelete('cascade');
            $table->bigInteger('inventory_id')->unsigned()->index();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory_packaging');
        Schema::drop('packagings');
    }
}
