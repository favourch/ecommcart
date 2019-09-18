<?php

namespace App\Contracts\Repositories;

interface InvoiceRepository
{
    /**
     * Create a local invoice for the given billable entity.
     *
     * @param  mixzed  $billable
     * @param  \Laravel\Cashier\Invoice  $invoice
     * @return \Laravel\Spark\LocalInvoice
     */
    protected function create($billable, $invoice);
}
