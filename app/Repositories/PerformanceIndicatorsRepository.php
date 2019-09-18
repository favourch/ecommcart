<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\SubscriptionPlan;
use Illuminate\Support\Facades\DB;
use App\Contracts\Repositories\PerformanceIndicatorsRepository as Contract;

class PerformanceIndicatorsRepository implements Contract
{
    public function all($take = 60)
    {
      return DB::table('performance_indicators')->orderBy('created_at', 'desc')->take($take)->get();

        // return array_reverse(
        //     DB::table('performance_indicators')->orderBy('created_at', 'desc')->take($take)->get()
        // );
    }

    public function forDate(Carbon $date)
    {
        return DB::table('performance_indicators')->where('created_at', $date)->first();
    }

    public function totalRevenueForUser($user)
    {
        return DB::table('invoices')->where('user_id', $user->id)->sum('total');
    }

    public function totalVolume()
    {
        return DB::table('invoices')->sum('total');
    }

    /**
     * Get the monthly recurring revenue.
     *
     * @return float
     */
    public function monthlyRecurringRevenue()
    {
        $total = 0;
        $plans = SubscriptionPlan::all();
        foreach ($plans as $plan) {
            $total += DB::table('subscriptions')
                    ->where('stripe_plan', $plan->plan_id)
                    ->where(function ($query) {
                        $query->whereNull('trial_ends_at')
                              ->orWhere('trial_ends_at', '<=', Carbon::now());
                    })
                    ->whereNull('ends_at')
                    ->count() * $plan->cost;
        }

        return $total;
    }

    /**
     * Get the number of subscribers in plan.
     *
     * @return int
     */
    public function subscribers(SubscriptionPlan $plan)
    {
        return DB::table('subscriptions')
        ->where('stripe_plan', $plan->plan_id)
        ->where(function ($query) {
            $query->whereNull('trial_ends_at')
            ->orWhere('trial_ends_at', '<=', Carbon::now());
        })
        ->whereNull('ends_at')->count();
    }

    /**
     * Get the number of trialing users in plan.
     *
     * @return int
     */
    public function trialing(SubscriptionPlan $plan)
    {
        $stripe =  DB::table('subscriptions')
                        ->where('stripe_plan', $plan->plan_id)
                        ->where('trial_ends_at', '>', Carbon::now())
                        ->whereNull('ends_at')
                        ->count();

        $local =  DB::table('shops')
                        ->where('current_billing_plan', $plan->plan_id)
                        ->where('trial_ends_at', '>', Carbon::now())
                        ->count();

        return $stripe + $local;
    }
}
