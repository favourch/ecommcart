<?php

namespace App\Charts;

use App\Helpers\CharttHelper;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class VisitorTypes extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($labels = [])
    {
        parent::__construct();

		$this->height(300)->width(0)
			->labels($labels)
			->options([
				'tooltip' => [
				    'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>',
				],
				'colors' => [
					'#ff0000', '#00ff00',
				],
				'plotOptions' => [
					// 'series' => [
					// 	'colorByPoint' => true,
					// ],
					'pie' => [
						'allowPointSelect' => true,
						'cursor' => 'pointer',
						'dataLabels' => [
							'enabled' => true,
							'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
						],
					],
				],
				'credits' => [
					'enabled' => false,
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
