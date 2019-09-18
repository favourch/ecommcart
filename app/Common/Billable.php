<?php

namespace App\Common;

use App\LocalInvoice;
use App\Subscription;
// use Mpociot\VatCalculator\VatCalculator;
use Laravel\Cashier\Billable as CashierBillable;

trait Billable
{
    use CashierBillable;

    /**
     * Determine if the user is connected ot any payment provider.
     *
     * @return bool
     */
    public function hasBillingProvider()
    {
        return $this->stripe_id || $this->braintree_id;
    }

    /**
     * Get all of the subscriptions for the user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get all of the local invoices.
     */
    public function localInvoices()
    {
        return $this->hasMany(LocalInvoice::class)->orderBy('id', 'desc');
    }

    /**
     * Get the tax percentage to apply to the subscription.
     *
     * @return int
     */
    // public function taxPercentage()
    // {
    //     if (! Spark::collectsEuropeanVat()) {
    //         return 0;
    //     }

    //     $vatCalculator = new VatCalculator;

    //     $vatCalculator->setBusinessCountryCode(Spark::homeCountry());

    //     return $vatCalculator->getTaxRateForCountry(
    //         $this->card_country, ! empty($this->vat_id)
    //     ) * 100;
    // }
}
