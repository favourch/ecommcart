<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_groups', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name')->unique();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('link')->nullable();
            $table->string('link_label', 100)->nullable();
            $table->string('bg_color', 20)->nullable();
            $table->string('group_id')->nullable();
            $table->integer('columns')->default(12)->nullable();
            $table->integer('order')->default(100)->nullable();
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
        Schema::dropIfExists('banner_groups');
        Schema::dropIfExists('banners');
    }
}
