<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default library used in charts.
    |--------------------------------------------------------------------------
    |
    | This value is used as the default chart library used when creating
    | any chart in the command line. Feel free to modify it or set it up
    | while creating the chart to ignore this value.
    |
    */
    'default_library' => 'Highcharts',

    'google_analytic' => [
        'period' => 12, //Months
    ],

    // Default values for charts
    'default' => [
        'months' => 12,
        'days' => 30,
    ],

    // Config for dashboard charts only
    'visitors' => [
        // Set how many months you want to display in the graph
        'months' => 6,
        'colors' => [
            'page_views' => '',
            'sessions' => '',
            'unique_visits' => '',
        ],

        //Set 0 if you dont want to breackdown the chart in days
        'breakdown_last_days' => 3,
    ],

    'latest_sales' => [
        'days' => 15,
        'color' => '#d3d3d3'
    ],
];
