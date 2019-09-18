<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->text('title');
            $table->integer('warehouse_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->string('brand')->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->string('sku', 200);
            $table->enum('condition', ['New', 'Used', 'Refurbished']);
            $table->text('condition_note')->nullable();
            $table->longtext('description')->nullable();
            $table->text('key_features')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('damaged_quantity')->nullable();

            // $table->integer('tax_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->decimal('purchase_price', 20, 6)->nullable();
            $table->decimal('sale_price', 20, 6);
            $table->decimal('offer_price', 20, 6)->nullable();
            $table->timestamp('offer_start')->nullable();
            $table->timestamp('offer_end')->nullable();

            // $table->integer('packaging_id')->unsigned()->nullable();
            // $table->decimal('shipping_width', 20, 2)->nullable();
            // $table->decimal('shipping_height', 20, 2)->nullable();
            // $table->decimal('shipping_depth', 20, 2)->nullable();
            $table->decimal('shipping_weight', 20, 2)->nullable();
            $table->boolean('free_shipping')->nullable();

            $table->timestamp('available_from')->useCurrent();
            $table->integer('min_order_quantity')->default(1);
            $table->string('slug', 200)->unique();
            $table->text('linked_items')->nullable();
            $table->text('meta_title')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->boolean('stuff_pick')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('attribute_inventory', function (Blueprint $table) {
            $table->integer('attribute_id')->unsigned()->index();
            $table->bigInteger('inventory_id')->unsigned()->index();
            $table->integer('attribute_value_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        });

        // Schema::create('attribute_value_inventory', function (Blueprint $table) {
        //     $table->integer('attribute_value_id')->unsigned()->index();
        //     $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        //     $table->bigInteger('inventory_id')->unsigned()->index();
        //     $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('attribute_value_inventory');
        Schema::drop('attribute_inventory');
        Schema::drop('inventories');
    }
}
