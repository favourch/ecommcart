<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PackagingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packagings')->insert([
            'id' => 1,
            'shop_id' => NULL,
            'name' => 'Free Basic Packaging',
            'cost' => 0,
            'active' => 1,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
    }
}
