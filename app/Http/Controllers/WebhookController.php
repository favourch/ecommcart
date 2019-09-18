<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\InvoiceRepository;
use App\Events\Subscription\SubscriptionCancelled;
use App\Notifications\Billing\SendsInvoiceNotifications;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{

    public function handleStripeCallback()
    {
        \Log::info('Stripe response arived!');
    }

    /**
     * Handle a successful invoice payment from a Stripe subscription.
     *
     * @param  array  $payload
     * @return Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        $shop = $this->getUserByStripeId(
            $payload['data']['object']['customer']
        );

        $invoice = $shop->findInvoice($payload['data']['object']['id']);

        app(InvoiceRepository::class)->create($shop, $invoice);

        // Send invoice notification to shop owner
        $shop->owner->notify(new SendsInvoiceNotifications($shop, $invoice));
    }

    /**
     * Handle a cancelled customer from a Stripe subscription.
     *
     * @param  array  $payload
     * @return Response
     */
    protected function handleCustomerSubscriptionDeleted(array $payload)
    {
        parent::handleCustomerSubscriptionDeleted($payload);

        $user = $this->getUserByStripeId($payload['data']['object']['customer']);

        if (! $user) {
            return $this->teamSubscriptionDeleted($payload);
        }

        event(new SubscriptionCancelled(
            $this->getUserByStripeId($payload['data']['object']['customer']))
        );

        return new Response('Webhook Handled', 200);
    }

}