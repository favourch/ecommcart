<?php

namespace App\Notifications\Message;

use App\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Replied extends Notification implements ShouldQueue
{
    use Queueable;

    public $reply;
    public $receiver;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, $receiver)
    {
        $this->reply = $reply;
        $this->receiver = $receiver;
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
        return (new MailMessage)
        ->from(get_sender_email($this->reply->repliable->shop_id), get_sender_name($this->reply->repliable->shop_id))
        ->subject( trans('notifications.message_replied.subject', ['user' => $this->reply->user->getName(), 'subject' => $this->reply->repliable->subject]) )
        ->markdown('admin.mail.message.replied', ['url' => route('admin.support.message.show', $this->reply->repliable_id), 'reply' => $this->reply, 'receiver' => $this->receiver]);
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
