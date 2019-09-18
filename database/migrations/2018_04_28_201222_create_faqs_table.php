<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->enum('for', ['Merchant', 'Customer'])->default('Merchant');
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faq_topic_id')->unsigned()->nullable();
            $table->text('question')->nullable();
            $table->longtext('answer')->nullable();
            $table->timestamps();

            $table->foreign('faq_topic_id')->references('id')->on('faq_topics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('faq_topics');
    }
}
