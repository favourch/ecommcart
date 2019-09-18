<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Helpers\CharttHelper;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class SalesByPeriod extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($start = Null, $end = Null, $grp_by = 'M')
    {
        parent::__construct();

        $start = CharttHelper::getStartDate($start);

        if($grp_by == 'D'){
	        $end = $end ? Carbon::parse($end) : $start->copy()->subDays(config('charts.default.days'));
        	$grp_by = 'F d';
        	$period = $start->diffInDays($end);
			$dates = CharttHelper::Days($period, $grp_by, $start);
			// $dates[$period-1] = trans('app.today');
			// $dates[$period-2] = trans('app.yesterday');
        }
        else{
	        $end = $end ? Carbon::parse($end) : $start->copy()->subMonths(config('charts.default.months'));
        	$grp_by = 'F';
        	$period = $start->diffInMonths($end);
			$dates = CharttHelper::Months($period, $grp_by);
			// $dates[$period-1] = trans('app.this_month');
        }

		$this->displayLegend(false)
		->height(200)->width(0)
		->labels($dates)
		->options([
			'yAxis' => [
				'title' => [
					'text' => null,
				],
				'labels' => [
				    'align'	=> 'right',
					'format' => config('system_settings.currency.symbol') . '{value}',
				],
			],
			'tooltip' => [
				'useHTML' => true,
				'pointFormat' => '<small>{series.name}: <b>' . config('system_settings.currency.symbol') . '{point.y}</b></small>',
			],
			'credits' => [
				'enabled' => false,
			],
		]);
    }
}
