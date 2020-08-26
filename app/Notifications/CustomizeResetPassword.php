<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
//use Illuminate\Http\Request;

class CustomizeResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $token;
    public $user_type;

    public function __construct($user_type = "", $Token )
    {
        $this->token = $Token;
        $this->user_type = $user_type;
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
        $route_name = 'password.reset';
        if($this->user_type !== "") {
           $route_name = $this->user_type.'.password.reset';
        }
        return (new MailMessage)
            ->subject('Your Reset Password Subject Here')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(route($route_name, [$this->token, 'email' => $notifiable->getEmailForPasswordReset()])))

            ->line('If you did not request a password reset, no further action is required.');
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
