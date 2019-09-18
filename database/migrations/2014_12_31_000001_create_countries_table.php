<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('capital', 255)->nullable();
            $table->string('citizenship', 255)->nullable();
            $table->string('country_code', 3)->nullable();
            $table->string('currency', 255)->nullable();
            $table->string('currency_code', 255)->nullable();
            $table->string('currency_sub_unit', 255)->nullable();
            $table->string('currency_symbol', 3)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('iso_3166_2', 2)->nullable();
            $table->string('iso_3166_3', 3)->nullable();
            $table->string('name', 255);
            $table->string('region_code', 3)->nullable();
            $table->string('sub_region_code', 3)->nullable();
            $table->boolean('eea')->nullable();
            $table->string('calling_code', 3)->nullable();
            $table->string('flag', 6)->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('country_name', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('iso_3166_2', 2)->nullable();
            $table->string('region_code', 10)->nullable();
            $table->string('calling_code', 5)->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->nullable()->default(100);
            $table->string('iso_code', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('symbol', 255)->nullable();
            $table->string('disambiguate_symbol', 255)->nullable();
            $table->string('alternate_symbols', 255)->nullable();
            $table->string('subunit', 255)->nullable();
            $table->integer('subunit_to_unit')->default(100);
            $table->boolean('symbol_first')->default(1);
            $table->string('html_entity', 255)->nullable();
            $table->string('decimal_mark', 25)->nullable();
            $table->string('thousands_separator', 25)->nullable();
            $table->string('iso_numeric', 25)->nullable();
            $table->integer('smallest_denomination')->default(1);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('timezones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value')->nullable();
            $table->string('abbr')->nullable();
            $table->integer('offset')->nullable();
            $table->boolean('isdst')->nullable();
            $table->string('text')->nullable();
            $table->text('utc')->nullable();
            // $table->json('utc')->nullable();
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
        Schema::drop('timezones');
        Schema::drop('currencies');
        Schema::drop('states');
        Schema::drop('countries');
    }
}
