<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispute_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detail')->unique();
        });

        Schema::create('disputes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->integer('dispute_type_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->longtext('description')->nullable();
            $table->boolean('order_received')->default(1);
            $table->boolean('return_goods')->nullable();
            $table->decimal('refund_amount', 20, 6)->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('dispute_type_id')->references('id')->on('dispute_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disputes');
        Schema::dropIfExists('dispute_types');
    }
}
