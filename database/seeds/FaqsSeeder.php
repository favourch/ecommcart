<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq_topics')->insert([
            [
                'id' => 1,
                'name' => 'Overview',
                'for' => 'merchant',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ], [
                'id' => 2,
                'name' => 'Sell your items',
                'for' => 'merchant',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ], [
                'id' => 3,
                'name' => 'Pricing',
                'for' => 'merchant',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ]
        ]);

        //Get all of the faqs
        $faqs = json_decode(file_get_contents(__DIR__ . '/data/faqs.json'), true);

        foreach ($faqs as $faq){
            DB::table('faqs')->insert([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'faq_topic_id' => $faq['faq_topic_id'],
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]);
        }
    }
}
