<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigPaystacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_paystacks', function (Blueprint $table) {
            $table->integer('shop_id')->unsigned()->index();
            $table->text('merchant_email')->nullable();
            $table->text('public_key')->nullable();
            $table->text('secret')->nullable();
            $table->boolean('sandbox')->nullable()->default(True);
            $table->timestamps();

            $table->primary('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_paystacks');
    }
}
