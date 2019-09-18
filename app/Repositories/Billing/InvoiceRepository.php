<?php

namespace App\Repositories\Billing;

use Carbon\Carbon;
use App\SubscriptionPlan;
use Illuminate\Support\Facades\DB;
use App\Contracts\Repositories\InvoiceRepository as Contract;

class InvoiceRepository implements Contract
{
    /**
     * Create a local invoice for the given billable entity.
     *
     * @param  mixzed  $billable
     * @param  \Laravel\Cashier\Invoice  $invoice
     * @return \Laravel\Spark\LocalInvoice
     */
    protected function create($billable, $invoice)
    {
        if ($existing = $billable->localInvoices()->where('provider_id', $invoice->id)->first()) {
            return $existing;
        }

        return $billable->localInvoices()->create([
            // 'shop_id' => $billable->id,
            'provider_id' => $invoice->id,
            'total' => $invoice->rawTotal() / 100,
            'tax' => $invoice->asStripeInvoice()->tax / 100,
            'card_country' => $billable->card_country,
            'billing_state' => $billable->billing_state,
            'billing_zip' => $billable->billing_zip,
            'billing_country' => $billable->billing_country,
        ]);
    }
}
