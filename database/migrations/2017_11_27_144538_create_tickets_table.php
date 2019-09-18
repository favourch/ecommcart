<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->enum('priority', ['Low', 'Medium', 'High', 'Critical'])->default('Low');
            $table->unique('name');
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->longtext('message')->nullable();
            $table->bigInteger('assigned_to')->unsigned()->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->integer('priority')->unsigned()->default(1);
            // $table->enum('priority', ['Low', 'Medium', 'High', 'Critical'])->default('Low');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('ticket_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_categories');
    }
}
