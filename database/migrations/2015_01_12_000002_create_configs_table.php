<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('shop_id')->unsigned()->unique()->index();

            // Support
            $table->string('support_phone')->nullable();
            $table->string('support_phone_toll_free')->nullable();
            $table->string('support_email')->nullable();
            $table->string('default_sender_email_address')->nullable();
            $table->string('default_email_sender_name')->nullable();
            $table->longtext('return_refund')->nullable();

            // Order
            $table->string('order_number_prefix')->nullable()->default('#');
            $table->string('order_number_suffix')->nullable();
            $table->integer('default_tax_id')->unsigned()->nullable()->default(1);
            // $table->integer('default_carrier_id')->unsigned()->nullable();
            $table->decimal('order_handling_cost', 20, 6)->nullable();
            $table->boolean('auto_archive_order')->nullable()->default(false);

            // Checkout
            $table->integer('default_payment_method_id')->unsigned()->nullable();

            // Views
            $table->integer('pagination')->unsigned()->default(10);

            // Inventory
            $table->integer('alert_quantity')->nullable();
            $table->boolean('digital_goods_only')->nullable()->default(false);
            $table->integer('default_warehouse_id')->unsigned()->nullable();
            $table->integer('default_supplier_id')->unsigned()->nullable();
            $table->string('default_packaging_ids')->nullable();

            // Notification Settings
            $table->boolean('notify_new_message')->nullable();
            $table->boolean('notify_alert_quantity')->nullable();
            $table->boolean('notify_inventory_out')->nullable();
            $table->boolean('notify_new_order')->nullable()->default(true);
            $table->boolean('notify_abandoned_checkout')->nullable();
            $table->boolean('notify_new_disput')->nullable()->default(true);

            $table->boolean('maintenance_mode')->nullable()->default(true);
            $table->timestamps();

            $table->primary('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configs');
    }
}
