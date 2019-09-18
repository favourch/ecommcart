<?php

use Illuminate\Database\Seeder;

class DisputeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dispute_types')->insert([
            [
                'detail' => 'Did not receive goods',
            ], [
                'detail' => 'Counterfeit goods',
            ], [
                'detail' => 'Quantity shortage',
            ], [
                'detail' => 'Damaged goods',
            ], [
                'detail' => 'Quality not good',
            ], [
                'detail' => 'Product not as described',
            ], [
                'detail' => 'Problems with the accessories',
            ], [
                'detail' => 'Shipping method',
            ], [
                'detail' => 'Customs problem',
            ], [
                'detail' => 'Shipping address not correct',
            ]
        ]);
    }
}
