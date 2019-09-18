<?php
    //Metrics / Key Performance Indicators...
    Route::get('shop/report/kpi', 'ShopPerformanceIndicatorsController@all')->name('shop-kpi');
    Route::get('shop/report/kpi/revenue', 'ShopPerformanceIndicatorsController@revenue')->name('shop-kpi.revenue');
