<?php

namespace App\Notifications\Shop;

use App\Shop;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShopConfigUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $shop;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Shop $shop, User $user)
    {
        $this->shop = $shop;
        $this->user = $user;
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
        ->subject( trans('notifications.shop_config_updated.subject') )
        ->markdown('admin.mail.shop.config_updated', ['url' => route('login'), 'shop' => $this->shop]);
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
            'user' => $this->user->getName(),
            'name' => $this->shop->name,
        ];
    }
}
