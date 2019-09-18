<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Merchant::class, 1)
            ->create([
                'id' => 3,
                'shop_id' => 1,
                'role_id' => \App\Role::MERCHANT,
                'nice_name' => 'Merchant',
                'name' => 'Merchant User',
                'email' => 'merchant@demo.com',
                'password' => bcrypt('123456'),
                'active' => 1,
            ])
            ->each(function($merchant){
                $merchant->dashboard()->save(factory(App\Dashboard::class)->make());

                $merchant->addresses()->save(
                    factory(App\Address::class)->make(['address_title' => $merchant->name, 'address_type' => 'Primary'])
                );
            });


        factory(App\Merchant::class, 1)
            ->create()
            ->each(function($merchant){
                $merchant->dashboard()->save(factory(App\Dashboard::class)->make());

                $merchant->addresses()->save(
                    factory(App\Address::class)->make(['address_title' => $merchant->name, 'address_type' => 'Primary'])
                );
            });

        $this->call('ShopsSeeder');
    }
}
