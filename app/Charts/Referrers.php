<?php

namespace App\Charts;

use App\Helpers\CharttHelper;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class Referrers extends Chart
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
