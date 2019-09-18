<?php

use Illuminate\Database\Seeder;

class AddressTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('address_types')->insert([
            [
                'type' => 'Primary',
            ], [
                'type' => 'Billing',
            ], [
                'type' => 'Shipping',
            ]
        ]);
    }
}
