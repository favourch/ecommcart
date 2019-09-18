<?php

namespace App\Notifications\User;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendLoginInfo extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $admin;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $admin, $password)
    {
        $this->user = $user;
        $this->admin = $admin;
        $this->password = $password;
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
        ->subject( trans('notifications.user_created.subject', ['admin' => $this->admin, 'marketplace' => get_platform_title()]) )
        ->markdown('admin.mail.user.send_login_info', [
            'url' => route('admin.account.profile'),
            'admin' => $this->admin,
            'user' => $this->user,
            'password' => $this->password
        ]);
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
            'name' => $this->user->getName(),
            'email' => $this->user->email,
            'added_by' => $this->admin
        ];
    }
}
