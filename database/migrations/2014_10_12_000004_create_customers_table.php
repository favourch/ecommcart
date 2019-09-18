<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nice_name')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->date('dob')->nullable();
            $table->string('sex')->nullable();
            $table->longtext('description')->nullable();
            $table->timestampTz('last_visited_at')->nullable();
            $table->ipAddress('last_visited_from')->nullable();
            // $table->string('braintree_id')->nullable();
            $table->string('stripe_id')->nullable();
            $table->text('card_holder_name')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('accepts_marketing')->nullable();
            $table->string('verification_token', 100)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        // Schema::create('customer_settings', function (Blueprint $table) {
        //     $table->bigInteger('customer_id')->unsigned()->primary();
        //     $table->string('messages_signature')->nullable();
        //     $table->boolean('support_message_updated_notification')->default(true);
        //     $table->timestamps();

        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('customer_settings');
        Schema::dropIfExists('customers');
    }
}
