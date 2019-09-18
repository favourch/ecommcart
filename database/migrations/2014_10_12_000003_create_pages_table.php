<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('shop_id')->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->text('title')->nullable();
            $table->string('slug', 200)->unique();
            $table->longtext('content')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('visibility')->default(1);
            $table->string('position', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
