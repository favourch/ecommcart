<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->text('name')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->decimal('value', 20, 6)->nullable();
            $table->decimal('min_order_amount', 20, 6)->nullable();
            $table->enum('type', ['amount', 'percent'])->default('amount');
            // $table->boolean('partial_use')->nullable();
            // $table->boolean('limited')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('quantity_per_customer')->nullable();
            $table->timestamp('starting_time')->nullable();
            $table->timestamp('ending_time')->nullable();
            // $table->boolean('exclude_offer_items')->nullable();
            // $table->boolean('exclude_tax_n_shipping')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('coupon_shipping_zone', function (Blueprint $table) {
            $table->bigInteger('coupon_id')->unsigned()->index();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->integer('shipping_zone_id')->unsigned()->index();
            $table->foreign('shipping_zone_id')->references('id')->on('shipping_zones')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('coupon_customer', function (Blueprint $table) {
            $table->bigInteger('coupon_id')->unsigned()->index();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_shipping_zone');
        Schema::dropIfExists('coupon_customer');
        Schema::dropIfExists('coupons');
    }
}
