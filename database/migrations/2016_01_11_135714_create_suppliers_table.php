<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact_person')->nullable();
            $table->text('url')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('address_line_1')->nullable();
            // $table->string('address_line_2')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('zip_code')->nullable();
            // // $table->string('country_name')->nullable();
            // $table->integer('country_id')->nullable();
            $table->longtext('description')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();

            // $table->unique(array('shop_id', 'email', 'name'));
            // $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers');
    }
}
