<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function ($table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->string('name');
            // $table->string('braintree_id');
            // $table->string('braintree_plan');
            $table->string('stripe_id');
            $table->string('stripe_plan');
            $table->integer('quantity');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });

        Schema::create('subscription_plans', function ($table) {
            // $table->increments('id');
            $table->string('name')->unique();
            $table->string('plan_id')->primary();
            $table->string('best_for')->nullable();
            $table->decimal('cost')->default(0);
            $table->decimal('transaction_fee')->default(0);
            $table->decimal('marketplace_commission')->default(0);
            $table->integer('order_per_month')->nullable();
            $table->integer('revenue_per_month')->nullable();
            $table->integer('team_size')->default(1);
            $table->integer('inventory_limit')->default(0);
            $table->boolean('featured')->default(0);
            $table->integer('order')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->primary('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
        Schema::dropIfExists('subscriptions');
    }
}
