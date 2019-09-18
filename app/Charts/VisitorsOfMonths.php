<?php

namespace App\Charts;

use App\Helpers\CharttHelper;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class VisitorsOfMonths extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($period = 6, $per_day_visits = 0)
    {
        parent::__construct();

		$labels = CharttHelper::Months($period);

		$labels[$period-1] = trans('app.this_month');

		$breackdown = config('charts.visitors.breakdown_last_days') > 0 ? config('charts.visitors.breakdown_last_days') : Null;

        if($breackdown){
			$lastWeek = CharttHelper::Days($breackdown, 'l');
			$lastWeek[$breackdown-1] = trans('app.today');
			$labels = array_merge($labels, $lastWeek);
		}

		$this->height(300)->width(0)
			->labels($labels)
			->options([
				'subtitle' => [
					'text' => $per_day_visits > 0 ? trans('app.visits_per_day', ['value' => $per_day_visits]) : Null,
				],
				'legend' => [
			        'layout' => 'vertical',
			        'align' => 'left',
			        'verticalAlign' => 'top',
			        'x' => 40,
			        'y' => 30,
			        'floating' => true,
			        'borderWidth' => 0,
			        'backgroundColor' => '#FFFFFF'
			    ],
				'yAxis' => [
					'title' => [
						'text' => null,
					],
				],
				'tooltip' => [
					'shared' => true,
				],
				'credits' => [
					'enabled' => false,
				],
				'plotOptions' => [
					'series' => [
						// 'fillOpacity' => 0.5,
						'marker' => [
							'enabled' => false,
						],
					],
				],
				'exporting'  => [
				    'buttons'  => [
				       	'contextButton' => [
			              	'menuItems' => ['printChart', 'downloadPNG', 'downloadCSV', 'downloadXLS']
				        ],
				    ],
				],
			]);
    }
}
