<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all of the currencies
        $currencies = json_decode(file_get_contents(__DIR__ . '/data/currencies.json'), true);

        foreach ($currencies as $currency){
            DB::table('currencies')->insert([
                'priority' => ((isset($currency['priority'])) ? $currency['priority'] : 100),

                'iso_code' => ((isset($currency['iso_code'])) ? $currency['iso_code'] : null),

                'name' => ((isset($currency['name'])) ? $currency['name'] : null),

                'symbol' => ((isset($currency['symbol'])) ? $currency['symbol'] : null),

                'disambiguate_symbol' => ((isset($currency['disambiguate_symbol'])) ? $currency['disambiguate_symbol'] : null),

                'alternate_symbols' => ((isset($currency['alternate_symbols'])) ? json_encode($currency['alternate_symbols']) : null),

                'subunit' => ((isset($currency['subunit'])) ? $currency['subunit'] : null),

                'subunit_to_unit' => ((isset($currency['subunit_to_unit'])) ? $currency['subunit_to_unit'] : 100),

                'symbol_first' => ((isset($currency['symbol_first'])) ? $currency['symbol_first'] : 1),

                'html_entity' => ((isset($currency['html_entity'])) ? $currency['html_entity'] : null),

                'decimal_mark' => ((isset($currency['decimal_mark'])) ? $currency['decimal_mark'] : '.'),

                'thousands_separator' => ((isset($currency['thousands_separator'])) ? $currency['thousands_separator'] : ','),

                'iso_numeric' => ((isset($currency['iso_numeric'])) ? $currency['iso_numeric'] : null),

                'smallest_denomination' => ((isset($currency['smallest_denomination'])) ? $currency['smallest_denomination'] : 1),

                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]);
        }
    }
}
