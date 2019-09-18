<?php

/*
|--------------------------------------------------------------------------
| System configs
|--------------------------------------------------------------------------
|
| The application needs this config file to run properly.
| Dont change any value is you're not sure about it.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Freezed models
    |--------------------------------------------------------------------------
    |
    | This IDs associated with the models are not deletable, sometimes not editable.
    |
    */

    'freeze' => [
        'pages' => [1, 2, 3, 4, 5, 6],
        'order_statuses' => [1, 2, 3, 4, 5, 6, 7],
    ],

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    |
    | Config values for orders. System needs this to manage orders.
    |
    */
    'orders' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Inventory
    |--------------------------------------------------------------------------
    |
    | Config values for inventory. System needs this to manage inventory.
    |
    */
    'inventory' => [
        'max_key_features' => 7, // Maximum Number of key features can be added when creating an inventory
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Number of product will be display on the product lisitng page and search result.
    |
    */
    'view_listing_per_page' => 16,
    'view_blog_post_per_page' => 4,

    /*
    |--------------------------------------------------------------------------
    | Popular
    |--------------------------------------------------------------------------
    |
    | This values (Days) will be used to pick popular products.
    |
    */
    'popular' => [
        // Number of Days
        'period' => [
            'trending'  => 2,
            'weekly'    => 7
        ],
        // Number of top selling products will be picked
        'take' => [
            'trending'  => 15,
            'weekly'    => 5
        ],

        // This will use to lebel product list as hot item
        'hot_item' => [
            'period'        => 24, //hrs
            'sell_count'    => 3,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Filter
    |--------------------------------------------------------------------------
    |
    | This values (Days) will be used to filter product lintings.
    |
    */
    'filter' => [
        'new_arrival' => 7, //Days
    ],

    /*
    |--------------------------------------------------------------------------
    | Demo Mode
    |--------------------------------------------------------------------------
    |
    | This values will be used for the demo mode settings. You dont have so change this
    |
    */
    'demo' => [
        'users' => 3,
        'roles' => 3,
        'shops' => 1,
        'customers' => 1,
        'category_groups' => 9,
        'plans' => ['business', 'individual', 'professional'],
    ],

];