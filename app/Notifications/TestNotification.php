<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Facebook\FacebookChannel;
use NotificationChannels\Facebook\FacebookMessage;
use NotificationChannels\Facebook\Components\Button;
use NotificationChannels\Facebook\Enums\NotificationType;

class TestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FacebookChannel::class];
    }

    public function toFacebook($notifiable)
    {

        return FacebookMessage::create()
            ->to("100007996680164") // Optional
            ->text('One of your invoices has been paid!')
            ->isUpdate() // Optional
            ->isTypeRegular() // Optional
            // Alternate method to provide the notification type.
            // ->notificationType(NotificationType::REGULAR) // Optional
            ->buttons([
                Button::create('View Invoice', route('home'))->isTypeWebUrl(),
                Button::create('Call Us for Support!', '+1(212)555-2368')->isTypePhoneNumber(),
                Button::create('Start Chatting', ['invoice_id' => 1])->isTypePostback() // Custom payload sent back to your server
            ]); // Buttons are optional as well.
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
