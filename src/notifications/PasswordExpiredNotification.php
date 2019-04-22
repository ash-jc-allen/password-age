<?php

namespace AshAllenDesign\PasswordAge\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordExpiredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your system administrator has recommended that you reset your password.')
            ->line('Please use the button below to reset your password. If the button does not work, use the link at the bottom of this email.')
            ->action('Reset Password', url(config('app.url') . '/password/reset/' . $this->token))
            ->line('If you have any concerns regarding this email, please contact your system administrator');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
