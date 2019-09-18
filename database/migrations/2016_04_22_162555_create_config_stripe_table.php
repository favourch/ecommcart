<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigStripeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_stripes', function (Blueprint $table) {
            $table->integer('shop_id')->unsigned()->index();
            $table->string('stripe_user_id')->nullable();
            $table->string('publishable_key')->nullable();
            $table->string('refresh_token')->nullable();
            // $table->text('secret_key')->nullable();
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
        Schema::drop('config_stripes');
    }
}
