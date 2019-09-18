<?php
    //Metrics / Key Performance Indicators...
    Route::get('report/kpi', 'PerformanceIndicatorsController@all')->name('kpi');
    Route::get('report/kpi/revenue', 'PerformanceIndicatorsController@revenue')->name('kpi.revenue');
    Route::get('report/kpi/plans', 'PerformanceIndicatorsController@subscribers')->name('kpi.plans');
    Route::get('report/kpi/trialing', 'PerformanceIndicatorsController@trialUsers')->name('kpi.trialing');
