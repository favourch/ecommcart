<?php

namespace App\Charts;

use App\Helpers\CharttHelper;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class Visitors extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($period = 6)
    {
        parent::__construct();

		$labels = CharttHelper::Months($period);

		$labels[$period-1] = trans('app.this_month');

		$this->height(300)->width(0)
			->labels($labels)
			->options([
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
