<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->string('name');
            $table->integer('tax_id')->unsigned()->nullable();
            $table->text('country_ids')->nullable();
            $table->longText('state_ids')->nullable();
            $table->boolean('rest_of_the_world')->default(false);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('shipping_zone_id')->unsigned()->index();
            $table->integer('carrier_id')->unsigned()->nullable();
            $table->enum('based_on', ['price', 'weight'])->default('price');
            $table->decimal('minimum', 20, 6)->nullable();
            $table->decimal('maximum', 20, 6)->nullable();
            $table->decimal('rate', 20, 6)->nullable();
            $table->string('delivery_takes')->nullable();
            $table->timestamps();

            $table->foreign('shipping_zone_id')->references('id')->on('shipping_zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shipping_rates');
        Schema::drop('shipping_zones');
    }
}
