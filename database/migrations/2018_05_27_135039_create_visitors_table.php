<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->ipAddress('ip')->unique()->primary();
            $table->macAddress('mac')->nullable();
            $table->string('device')->nullable();
            $table->mediumInteger('hits')->default(0);
            $table->BigInteger('page_views')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->text('info')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('visitors');
    }
}
