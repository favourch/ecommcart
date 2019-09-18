<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('monthly_recurring_revenue', 8, 2)->nullable();
            // $table->decimal('yearly_recurring_revenue', 8, 2)->nullable();
            $table->decimal('daily_volume', 8, 2)->nullable();
            $table->integer('new_merchants');
            $table->integer('new_customers');
            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_indicators');
    }
}
