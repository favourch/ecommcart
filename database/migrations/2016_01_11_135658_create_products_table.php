<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->integer('manufacturer_id')->unsigned()->nullable();
            $table->string('brand')->nullable();
            $table->string('name');
            $table->string('model_number')->nullable();
            $table->string('mpn')->nullable();
            $table->string('gtin')->nullable();
            $table->string('gtin_type')->nullable();
            $table->longtext('description')->nullable();
            //Admin can set a MIN and MAX price for a product
            $table->decimal('min_price', 20, 6)->default(0)->nullable();
            $table->decimal('max_price', 20, 6)->nullable();
            $table->integer('origin_country')->unsigned()->nullable();
            $table->boolean('has_variant')->nullable();
            $table->boolean('requires_shipping')->default(1)->nullable();
            $table->boolean('downloadable')->nullable();
            $table->string('slug')->unique();
            // $table->text('meta_title')->nullable();
            // $table->longtext('meta_description')->nullable();
            $table->bigInteger('sale_count')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('gtin_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->text('description');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gtin_types');
        Schema::drop('products');
    }
}
