<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimezonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all of the timezones
        $timezones = json_decode(file_get_contents(__DIR__ . '/data/timezones.json'), true);

        foreach ($timezones as $timezone){
            DB::table('timezones')->insert([
                'value' => ((isset($timezone['value'])) ? $timezone['value'] : null),
                'abbr' => ((isset($timezone['abbr'])) ? $timezone['abbr'] : null),
                'offset' => ((isset($timezone['offset'])) ? $timezone['offset'] : null),
                'isdst' => ((isset($timezone['isdst'])) ? $timezone['isdst'] : null),
                'text' => ((isset($timezone['text'])) ? $timezone['text'] : null),
                'utc' => ((isset($timezone['utc'])) ? json_encode($timezone['utc']) : null),
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]);
        }
    }
}
