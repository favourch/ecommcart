<?php

namespace App\Http\Controllers\Selling;

use App\FaqTopic;
use App\SubscriptionPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $faqTopics = FaqTopic::merchant()->with('faqs')->get();
        $subscription_plans = SubscriptionPlan::orderBy('order', 'asc')->get();

        return view('index', compact('subscription_plans', 'faqTopics'));
    }
}
