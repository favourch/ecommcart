<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ModulesSeeder extends Seeder
{
    /**
     * All modules and its attributes.
     * This will generate the role accesses and will be used on permission control.
     * access = Common, Platform, Merchant, and Super Admin
     * actions is the comma separated string that will be use for permission control
     *
     * @var arr
     */
    private $modules = [
        // Module name  => Access level //
        'Appearance' => [
            'access' => 'Platform',
            'actions' => 'customize'
        ],

        'Attribute' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],

        'Carrier' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Category' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],

        'Category Group' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],

        'Category Sub Group' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],

        'Config' => [
            'access' => 'Merchant',
            'actions' => 'view,edit'
        ],

        'Coupon' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Cart' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Customer' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],

        'Dispute' => [
            'access' => 'Common',
            'actions' => 'view,response'
        ],

        'Email Template' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],

        // 'Gift Card' => [
        //     'access' => 'Platform',
        //     'actions' => 'view,add,edit,delete'
        // ],

        'Inventory' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Manufacturer' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],

        'Message' => [
            'access' => 'Common',
            'actions' => 'view,add,update,delete,reply'
        ],

        'Module' => [
            'access' => 'Super Admin',
            'actions' => 'view,add,edit,delete'
        ],

        'Order' => [
            'access' => 'Merchant',
            'actions' => 'view,add,fulfill,archive'
        ],

        'Packaging' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Product' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],

        'Refund' => [
            'access' => 'Merchant',
            'actions' => 'view,initiate,update,approve'
        ],

        'Role' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],

        'Supplier' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Subscription Plan' => [
            'access' => 'Super Admin',
            'actions' => 'view,add,edit,delete'
        ],

        'Shipping Zone' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Shipping Rate' => [
            'access' => 'Merchant',
            'actions' => 'add,edit,delete'
        ],

        'System' => [
            'access' => 'Super Admin',
            'actions' => 'view,edit'
        ],

        'System Config' => [
            'access' => 'Platform',
            'actions' => 'view,edit'
        ],

        'Tax' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'Ticket' => [
            'access' => 'Platform',
            'actions' => 'view,update,reply,assign'
        ],

        'Vendor' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete,login'
        ],

        'Warehouse' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],

        'User' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete,login'
        ],

        'Utility' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->modules as $name => $attributes)
        {
            DB::table('modules')->insert(
                [
                    'name' => $name,
                    'description' => 'Manage all '.strtolower($name).'.',
                    'access' => $attributes['access'],
                    'actions' => $attributes['actions'],
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ]
            );
        }
    }

}
