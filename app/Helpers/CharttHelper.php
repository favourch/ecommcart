<?php

namespace App\Helpers;

use Analytics;
use App\Order;
use App\Visitor;
use Carbon\Carbon;
// use App\Helpers\Period;
use Spatie\Analytics\Period;
use App\Helpers\GoogleAnalytics;
use Illuminate\Database\Eloquent\Collection;
/**
* This is a helper class to prodive data to charts
*/
class CharttHelper
{
    /**
     * Return formated days array to make labels
     *
     * @param integer $days
     * @return array
     */
   	public static function Days($days = Null, $format = 'F d', $start = Null)
    {
    	if(!$days)
    		$days = config('charts.default.days', 30);

		if(!$start)
			$start = Carbon::today();

		$data = [];
		for ($i = $days-1; $i >= 0; $i--) {
		    $data[] = $start->copy()->subDays($i)->format($format);
		}

		return $data;
    }

    /**
     * Return formated Months array to make labels
     *
     * @param integer $Months
     * @return array
     */
   	public static function Months($months = Null, $format = 'F', $start = Null)
    {
    	if(!$months)
    		$months = config('charts.default.months', 12);

		if(!$start)
			$start = Carbon::today()->startOfMonth();

		$data = [];
		for ($i = $months-1; $i >= 0; $i--) {
		    $data[] = $start->copy()->subMonths($i)->format($format);
		}

		return $data;
    }

    /**
     * Return formated sales total array to make chart
     *
     * @param integer $days
     * @return array
     */
   	public static function SalesOfLast($days = Null, $start = Null)
    {
		if(!$start)
			$start = Carbon::today();

		$dateRange = static::Days($days, 'M-d', $start);

        $sales = Order::select('total', 'created_at')
        		->mine()->withTrashed() //Include the arcived orders also
        		->whereDate('created_at', '>=', $start->subDays($days))
                ->orderBy('created_at', 'DESC')->get()
        		->groupBy(function($item){
        			return $item->created_at->format('M-d');
        		})
        		->map(function ($item) {
        		    return $item->sum('total');
        		})
        		->toArray();

		$data = [];
		foreach ($dateRange as $day) {
			if(array_key_exists($day, $sales))
				$data[] = round($sales[$day]);
			else
				$data[] = 0;
		}

    	return $data;
    }

    /**
     * Return formated sales total array to make chart
     *
     * @param integer $days
     * @return array
     */
    public static function prepareSaleTotal(Collection $salesData, $grp_by = 'M')
    {
        // $start = static::getStartDate();
        // $end = $start->copy()->subMonths(12)->startOfMonth();

        if($grp_by == 'D'){
            $grp_by = 'M-d';
            // $dateRange = static::Days(30, $grp_by, $start);
        }
        else{
            $grp_by = 'F';
            // $dateRange = static::Months(12);
        }

        $sales = $salesData->groupBy(function($item) use ($grp_by){
                    return $item->created_at->format($grp_by);
                })
                ->map(function ($item) {
                    return $item->sum('total');
                })
                ->toArray();
        return $sales;

        // $data = [];
        // foreach ($dateRange as $day) {
        //     if(array_key_exists($day, $sales))
        //         $data[] = round($sales[$day]);
        //     else
        //         $data[] = 0;
        // }

        // return $data;
    }

    /**
     * Return formated Discounts total array to make chart
     *
     * @param integer $days
     * @return array
     */
    // public static function prepareDiscountTotal(Collection $salesData, $grp_by = 'M')
    // {
    //     if($grp_by == 'D')
    //         $grp_by = 'M-d';
    //     else
    //         $grp_by = 'F';

    //     $sales = $salesData->groupBy(function($item) use ($grp_by){
    //                 return $item->created_at->format($grp_by);
    //             })
    //             ->map(function ($item) {
    //                 return $item->sum('discount');
    //             })
    //             ->toArray();
    //     return $sales;
    // }

    /**
     * Return formated visitors data array to make chart
     *
     * @param integer $months
     * @return array
     */
    // public static function VisitorsOfLast($months = Null, $start = Null)
   	public static function visitorsOfMonths($months = Null, $start = Null)
    {
        if(config('system_settings.google_analytic_report') && \App\SystemConfig::isGgoogleAnalyticConfigured()){
            //retrieve visitors and pageviews from GoogleAnalytic
            $data = static::fetchVisitorsOfMonthsFromGoogle($months, $start);

            $breackdown = config('charts.visitors.breakdown_last_days') > 0 ? config('charts.visitors.breakdown_last_days') : Null;
            if($breackdown){
                $analyticsData = static::fetchVisitorsOfDaysFromGoogle($breackdown);
                $data['visits'] = array_merge($data['visits'], $analyticsData['visits']);
                $data['sessions'] = array_merge($data['sessions'], $analyticsData['sessions']);
                $data['page_views'] = array_merge($data['page_views'], $analyticsData['page_views']);
            }

            return $data;
        }

		if(!$start)
			$start = Carbon::today()->startOfMonth();

		$monthRange = static::Months($months, 'F', $start);

        $visitors = Visitor::select('hits', 'page_views', 'updated_at')
        			->withTrashed() //Include the blocked ips also
        			->whereDate('updated_at', '>=', Carbon::today()->subMonths($months))
                    ->orderBy('updated_at', 'DESC')->get()
        			->groupBy(function($item){
        				return $item->updated_at->format('F');
        			});

		$visits = $visitors->map(function ($item) {
					    return $item->sum('hits');
					})
					->toArray();

		$page_views = $visitors->map(function ($item) {
					    return $item->sum('page_views');
					})
					->toArray();

		$visits_data = [];
		$views_data = [];
		foreach ($monthRange as $day) {
			if(array_key_exists($day, $visits)){
				$visits_data[] = round($visits[$day]);
				$views_data[] = round($page_views[$day]);
			}
			else{
				$visits_data[] = 0;
				$views_data[] = 0;
			}
		}

		$data = [
			'visits' => $visits_data,
            'page_views' => $views_data
		];

        $breackdown = config('charts.visitors.breakdown_last_days') > 0 ? config('charts.visitors.breakdown_last_days') : Null;

        if($breackdown){
            $weeks = static::visitorsOfDays($breackdown);
            $data['visits'] = array_merge($data['visits'], $weeks['visits']);
            $data['page_views'] = array_merge($data['page_views'], $weeks['page_views']);
        }

    	return $data;
	}

    /**
     * VisitorsOfDays
     *
     * @return array
     */
    public static function visitorsOfDays($days = Null, $start = Null)
    {
        if(!$start)
            $start = Carbon::today()->startOfDay();

        $visitors = Visitor::select('hits', 'page_views', 'updated_at')
                    ->withTrashed() //Include the blocked ips also
                    ->whereDate('updated_at', '>=', Carbon::today()->subDays($days))
                    ->orderBy('updated_at', 'DESC')->get()
                    ->groupBy(function($item){
                        return $item->updated_at->format('l');
                    });

        $visits = $visitors->map(function ($item) {
                        return $item->sum('hits');
                    })
                    ->toArray();

        $page_views = $visitors->map(function ($item) {
                        return $item->sum('page_views');
                    })
                    ->toArray();

        $dayRange = static::Days($days, 'l');

        $visits_data = [];
        $views_data = [];
        foreach ($dayRange as $day) {
            if(array_key_exists($day, $visits)){
                $visits_data[] = round($visits[$day]);
                $views_data[] = round($page_views[$day]);
            }
            else{
                $visits_data[] = 0;
                $views_data[] = 0;
            }
        }

        $data = [
            'visits' => $visits_data,
            'page_views' => $views_data
        ];

        return $data;
    }

    /**
     * Return formated visitors data from Google analytic to make chart
     *
     * @param integer $months
     * @return array
     */
    public static function fetchVisitorsOfMonthsFromGoogle($months = 6, $start = Null)
    {
        //retrieve visitors and pageviews since the 6 months ago
        $analyticsData = GoogleAnalytics::fetchTotalVisitorsSessionsAndPageViews(Period::months($months-1));
        // echo "<pre>"; print_r($analyticsData); echo "</pre>"; exit();
        if(!$start)
            $start = Carbon::now()->startOfMonth();

        $dateRange = static::Months($months, 'n', $start);

        $visits_data = [];
        $views_data = [];
        $sessions_data = [];
        foreach ($analyticsData->toArray() as $analytics) {
            $index = array_search($analytics['period'], $dateRange);
            $visits_data[$index] = $analytics['visitors'];
            $sessions_data[$index] = $analytics['sessions'];
            $views_data[$index] = $analytics['pageViews'];
        }

        // sort the data acconding to labals
        ksort($visits_data); ksort($sessions_data); ksort($views_data);

        $data = [
            'visits' => array_values($visits_data),
            'sessions' => array_values($sessions_data),
            'page_views' => array_values($views_data)
        ];

        return $data;
    }

    /**
     * Return formated visitors data from Google analytic to make chart
     *
     * @param integer $days
     * @return array
     */
    public static function fetchVisitorsOfDaysFromGoogle($days = 7, $start = Null)
    {
        $analyticsData = GoogleAnalytics::fetchTotalVisitorsSessionsAndPageViews(Period::days($days-1), 'date');

        if(!$start)
            $start = Carbon::today()->startOfDay();

        $dateRange = static::Days($days, 'l', $start);

        $visits_data = [];
        $views_data = [];
        $sessions_data = [];
        foreach ($analyticsData->toArray() as $analytics) {
            $day = Carbon::createFromFormat('Ymd', $analytics['period'])->format('l');

            $index = array_search($day, $dateRange);
            $visits_data[$index] = $analytics['visitors'];
            $sessions_data[$index] = $analytics['sessions'];
            $views_data[$index] = $analytics['pageViews'];
        }

        // sort the data acconding to labals
        ksort($visits_data); ksort($sessions_data); ksort($views_data);

        $data = [
            'visits' => array_values($visits_data),
            'sessions' => array_values($sessions_data),
            'page_views' => array_values($views_data)
        ];

        return $data;
    }

    /**
     * Return formated visitors data from Google analytic to make chart
     *
     * @param integer $period
     * @return array
     */
    public static function topReferrers($period = 12, $start = Null)
    {
        return Analytics::fetchTopReferrers(Period::months($period));
    }

    /**
     * Return formated visitors data from Google analytic to make chart
     *
     * @param integer $period
     * @return array
     */
    public static function userTypes($period = 12, $start = Null)
    {
        return Analytics::fetchUserTypes(Period::months($period));
    }

    /**
     * Return formated visitors data from Google analytic to make chart
     *
     * @param integer $period
     * @return array
     */
    public static function topBrowsers($period = 12, $start = Null)
    {
        return Analytics::fetchTopBrowsers(Period::months($period));
    }

    public static function topDevice($period = 12)
    {
        return GoogleAnalytics::topDevice(Period::months($period));
    }

    public static function performQuery($period, string $metrics, array $others = [])
    {
        return Analytics::performQuery(Period::months($period), $metrics, $others);
    }

    public static function getStartDate($date = Null)
    {
        if ($date)
            return Carbon::parse($date);

        return Carbon::today();
    }

    // public static function getEndDate($date = Null, $period = 'day')
    // {
    //     if ($date)
    //         return Carbon::parse($date);

    //     if($period == 'month')


    //     return $date ? Carbon::parse($date) : Carbon::today();
    //     return $start->subMonths(12)->startOfMonth();
    // }

}