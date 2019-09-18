<?php

namespace App\Http\Controllers\Admin;

use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Get all of the invoices for the current user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function all(Request $request)
    {
        if (! $request->user()->hasBillingProvider()) {
            return [];
        }

        return $request->user()->localInvoices;
    }

    /**
     * Download the invoice with the given ID.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function download(Request $request, $id)
    {
        $invoice = $request->user()->localInvoices()
                            ->where('id', $id)->firstOrFail();

        return $request->user()->downloadInvoice(
            $invoice->provider_id, ['id' => $invoice->id] + Spark::invoiceDataFor($request->user())
        );
    }
}
