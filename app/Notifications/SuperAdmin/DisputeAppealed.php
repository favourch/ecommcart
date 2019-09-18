<?php

namespace App\Notifications\SuperAdmin;

use App\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DisputeAppealed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
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
        ->subject( trans('notifications.dispute_appealed.subject', ['order_id' => $this->reply->repliable->order->order_number]) )
        ->markdown('admin.mail.super_admin.dispute_appealed', ['url' => route('admin.support.dispute.show', $this->reply->repliable_id), 'reply' => $this->reply]);
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
            'id' => $this->reply->repliable_id,
            'status' => $this->reply->repliable->statusName(),
            'category' => $this->reply->repliable->dispute_type->detail,
            'order_number' => $this->reply->repliable->order_number,
            'reply' => $this->reply->reply,
        ];
    }
}
