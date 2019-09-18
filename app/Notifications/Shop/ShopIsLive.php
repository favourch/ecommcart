<?php

namespace App\Notifications\Shop;

use App\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShopIsLive extends Notification implements ShouldQueue
{
    use Queueable;

    public $shop;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from(get_sender_email(), get_sender_name())
        ->subject( trans('notifications.shop_is_live.subject', ['merchant' => optional($this->shop->owner)->getName()]) )
        ->markdown('admin.mail.shop.is_live', ['url' => route('login'), 'shop' => $this->shop]);
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
            // 'user' => auth()->user()->getName(),
            'name' => $this->shop->name,
            'status' => trans('messages.shop_is_live'),
        ];
    }
}
