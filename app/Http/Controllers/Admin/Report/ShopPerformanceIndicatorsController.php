<?php

namespace App\Http\Controllers\Admin\Report;

use App\Shop;
use Carbon\Carbon;
use App\SubscriptionPlan;
use App\Charts\Subscribers;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\PerformanceIndicatorsRepository;

class ShopPerformanceIndicatorsController extends Controller
{
    /**
     * The performance indicators repository instance.
     *
     * @var PerformanceIndicatorsRepository
     */
    protected $indicators;

    /**
     * Create a new controller instance.
     *
     * @param  PerformanceIndicatorsRepository  $indicators
     * @return void
     */
    public function __construct(PerformanceIndicatorsRepository $indicators)
    {
        $this->indicators = $indicators;
    }

    /**
     * Get the performance indicators for the application.
     *
     * @return Response
     */
    public function all()
    {
        return view('admin.report.merchant.kpi');
    }

}
