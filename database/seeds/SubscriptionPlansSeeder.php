<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_plans')->insert([
            [
                'name' => 'Individual',
                'plan_id' => 'individual',
                'cost' => 9,
                'transaction_fee' => 2.5,
                'marketplace_commission' => 3,
                'team_size' => 1,
                'inventory_limit' => 20,
                'featured' => false,
                'order' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'name' => 'Business',
                'plan_id' => 'business',
                'cost' => 29,
                'transaction_fee' => 1.9,
                'marketplace_commission' => 2.5,
                'team_size' => 5,
                'inventory_limit' => 200,
                'featured' => true,
                'order' => 2,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'name' => 'Professional',
                'plan_id' => 'professional',
                'cost' => 49,
                'transaction_fee' => 1,
                'marketplace_commission' => 1.5,
                'team_size' => 10,
                'inventory_limit' => 500,
                'featured' => false,
                'order' => 3,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]
        ]);
    }
}
