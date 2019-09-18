<?php

use Illuminate\Database\Seeder;

class GtinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gtin_types')->insert([
            [
                'name' => 'UPC',
                'description' => 'Universal Product Code (UPC), also called GTIN-12 and UPC-A',
            ],[
                'name' => 'EAN',
                'description' => 'European Article Number (EAN), also called GTIN-13',
            ],[
                'name' => 'JAN',
                'description' => 'Japanese Article Number (JAN), also called GTIN-13',
            ],[
                'name' => 'ISBN',
                'description' => 'International Standard Book Number (ISBN)',
            ],[
                'name' => 'ITF',
                'description' => 'ITF barcodes, also known as Interleaved 2 of 5 barcodes, encode 14 numeric digits and are generally used for the packaging level of products. Since they can deal with high printing tolerances, ITF is a good choice when barcodes need to be printed on corrugated cardboard.',
            ]

        ]);
    }
}
