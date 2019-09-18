<?php

use Illuminate\Database\Seeder;

class BannerGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banner_groups')->insert([
            [
                'id'   => 'best_deals',
                'name' => 'Best deals'
            ], [
                'id'   => 'sidebar',
                'name' => 'Sidebar'
            ], [
                'id'   => 'bottom',
                'name' => 'Bottom'
            ], [
                'id'   => 'place_one',
                'name' => 'Place one'
            ], [
                'id'   => 'place_two',
                'name' => 'Place two'
            ], [
                'id'   => 'place_three',
                'name' => 'Place three'
            ]
        ]);
    }
}
