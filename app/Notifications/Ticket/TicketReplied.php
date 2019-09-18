<?php

namespace App\Notifications\Ticket;

use App\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketReplied extends Notification implements ShouldQueue
{
    use Queueable;

    public $reply;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, $user)
    {
        $this->reply = $reply;
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
        ->subject( trans('notifications.ticket_replied.subject', ['user' => $this->reply->user->getName(), 'ticket_id' => $this->reply->repliable->id, 'subject' => $this->reply->repliable->subject]) )
        ->markdown('admin.mail.ticket.replied', ['user' => $this->user, 'url' => route('admin.support.ticket.show', $this->reply->repliable_id), 'reply' => $this->reply]);
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
            'id' => $this->reply->id,
            'user' => $this->reply->user->getName(),
            'ticket' => $this->reply->repliable->subject,
            'reply' => $this->reply->reply,
        ];
    }
}
