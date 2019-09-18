<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all of the countries
        $file_path = 'data/states';

        $files = glob(__DIR__ . '/' . $file_path . '/' . '*.json');

        foreach ($files as $file)
        {
            $country_code = basename($file, ".json"); // Get the the country iso_3166_2 from file name

            $country = \DB::table('countries')->where('iso_3166_2', $country_code)->first();

            $country_id = $country->id;
            $country_name = $country->name;

            if(!$country_name) continue; //If the $country_id not found in countries table then ignore the file and move next

            $json = json_decode(file_get_contents($file), true);

            foreach ($json as $key => $state)
            {
                DB::table('states')->insert([
                    'country_id' => $country_id,
                    'country_name' => $country_name,
                    'name' => $state['name'],
                    'iso_3166_2' => isset($state['iso_3166_2']) ? $state['iso_3166_2'] : NULL,
                    'region' => isset($state['region']) ? $state['region'] : NULL,
                    'region_code' => isset($state['region_code']) ? $state['region_code'] : NULL,
                    'calling_code' => isset($state['calling_code']) ? $state['calling_code'] : NULL,
                    'active' => isset($state['active']) ? $state['active'] : 1,
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ]);
            }
        }
    }
}
