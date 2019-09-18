<?php

use Illuminate\Database\Seeder;

class TicketCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_categories')->insert([
            [
                'name' => 'General query',
                // 'priority' => 'Low'
            ], [
                'name' => 'Merchant support',
                // 'priority' => 'Medium'
            ], [
                'name' => 'Technical support',
                // 'priority' => 'High'
            ], [
                'name' => 'Webmaster',
                // 'priority' => 'Critical'
            ]
        ]);
    }
}
