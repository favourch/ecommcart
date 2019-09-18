<?php

namespace App\Notifications\System;

use App\System;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SystemInfoUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $system;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(System $system)
    {
        $this->system = $system;
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
        ->subject( trans('notifications.system_info_updated.subject', ['marketplace' => get_platform_title()]) )
        ->markdown('admin.mail.system.info_updated', ['url' => route('admin.setting.system.config'), 'system' => $this->system]);
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
            'status' => trans('messages.system_info_updated'),
        ];
    }
}
