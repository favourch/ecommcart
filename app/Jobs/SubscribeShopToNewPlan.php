<?php

namespace App\Jobs;

use App\User;
use App\Shop;
use Carbon\Carbon;
use App\SubscriptionPlan;
use Illuminate\Foundation\Bus\Dispatchable;

class SubscribeShopToNewPlan
{
    use Dispatchable;

    protected $merchant;
    protected $plan;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @param  User  $merchant
     * @param  str  $plan
     * @param  str/Null  $token
     * @return void
     */
    public function __construct(User $merchant, $plan, $token = Null)
    {
        $this->merchant = $merchant;
        $this->plan = $plan;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $shop = $this->merchant->owns;

        // Create subscription intance
        $subscriptionPlan = SubscriptionPlan::findOrFail($this->plan);
        $subscription = $shop->newSubscription($subscriptionPlan->name, $this->plan);

        $trialDays = (bool) config('system_settings.trial_days') ? config('system_settings.trial_days') : Null;

        // If the merchant has generic trial
        if($shop->trial_ends_at){
            // Subtract the used trial days with the new subscription
            $trialDays = Carbon::now()->lt($shop->trial_ends_at) ? Carbon::now()->diffInDays($shop->trial_ends_at) : Null;
        }

        // Set trial days
        if($trialDays)
            $subscription->trialDays($trialDays);

        if ($this->token) {
            $subscription->create($this->token, [
                'email' => $this->merchant->email
            ]);
        }
        else if($this->merchant->hasBillingToken()){
            $subscription->create();

            $this->adjustGenericTrial($shop);
        }
        else if ( ! config('system_settings.required_card_upfront') && (bool) config('system_settings.trial_days') )
        {
            $trial_ends_at = $shop->trial_ends_at ?: Carbon::now()->addDays($trialDays);

            $this->adjustGenericTrial($shop, $trial_ends_at);
        }
    }

    /**
     * Adjust Generic Trial information in shop table
     *
     * @param  App\Shop   $shop
     * @param  [type] $trialEnds
     *
     * @return bool
     */
    private function adjustGenericTrial(Shop $shop, $trialEnds = Null){
        return $shop->forceFill([
                        'current_billing_plan' => $this->plan,
                        'trial_ends_at' => $trialEnds
                    ])->save();
    }
}
