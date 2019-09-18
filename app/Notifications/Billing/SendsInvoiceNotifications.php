<?php

namespace App\Notifications\Billing;

use App\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendsInvoiceNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 15;

    public $shop;

    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Shop $shop, $invoice)
    {
        $this->shop = $shop;

        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $invoiceData =  [
                            'vendor' => get_platform_title(),
                            'product' => 'Subscription',
                        ];

        return (new MailMessage)
        ->from(get_sender_email(), get_sender_name())
        ->subject( trans('notifications.invoice_created.subject', ['marketplace' => get_platform_title()]) )
        ->markdown('admin.mail.billing.invoice_otification', ['url' => route('login'), 'shop' => $this->shop])
        ->attachData($this->invoice->pdf($invoiceData), 'invoice.pdf');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
