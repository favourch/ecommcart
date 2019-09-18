<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('label_color')->nullable();
            $table->boolean('fulfilled')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->nullable();
            $table->integer('shop_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->integer('ship_to')->unsigned()->nullable();
            $table->integer('shipping_zone_id')->unsigned()->nullable();
            $table->integer('shipping_rate_id')->unsigned()->nullable();
            $table->integer('packaging_id')->unsigned()->nullable();
            $table->integer('item_count')->unsigned();
            $table->integer('quantity')->unsigned();

            $table->decimal('taxrate', 20, 6)->nullable();
            $table->decimal('shipping_weight', 20, 6)->nullable();
            $table->decimal('total', 20, 6)->nullable();
            $table->decimal('discount', 20, 6)->nullable();
            $table->decimal('shipping', 20, 6)->nullable();
            $table->decimal('packaging', 20, 6)->nullable();
            $table->decimal('handling', 20, 6)->nullable();
            $table->decimal('taxes', 20, 6)->nullable();
            $table->decimal('grand_total', 20, 6)->nullable();

            // $table->bigInteger('billing_address')->unsigned()->nullable();
            // $table->bigInteger('shipping_address')->unsigned()->nullable();
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('tracking_id')->nullable();
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->integer('carrier_id')->unsigned()->nullable();

            $table->integer('payment_status')->default(1);
            $table->integer('payment_method_id')->unsigned();
            $table->integer('order_status_id')->unsigned()->default(1);

            $table->text('message_to_customer')->nullable();
            $table->boolean('send_invoice_to_customer')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('buyer_note')->nullable();
            $table->boolean('goods_received')->nullable();
            $table->boolean('approved')->nullable();
            $table->boolean('disputed')->nullable();
            $table->bigInteger('feedback_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });

        Schema::create('order_items', function (Blueprint $table) {

            $table->bigInteger('order_id')->unsigned()->index();
            $table->bigInteger('inventory_id')->unsigned()->index();
            $table->longtext('item_description');
            $table->integer('quantity')->unsigned();
            $table->decimal('unit_price', 20, 6);
            $table->bigInteger('feedback_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_items');
        Schema::drop('orders');
        Schema::drop('order_statuses');
    }
}
