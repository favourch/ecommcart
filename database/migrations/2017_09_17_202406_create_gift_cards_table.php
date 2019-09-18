<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('pin_code')->nullable();
            $table->decimal('value', 20, 6)->nullable();
            $table->decimal('remaining_value', 20, 6)->nullable();
            $table->boolean('partial_use')->nullable();
            $table->timestamp('activation_time')->nullable();
            $table->timestamp('expiry_time')->nullable();
            $table->boolean('exclude_offer_items')->nullable();
            $table->boolean('exclude_tax_n_shipping')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('gift_cards');
    }
}
