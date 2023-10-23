<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
//use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Slack\SlackMessage;
use Illuminate\Notifications\Notification;

class VehicleStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $vehicle;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail', 'slack', 'database'];
        //return ['database'];
        return ['slack'];
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
                    ->subject('Status des Fahrzeugs hat sich auf '.$this->vehicle->status.' geändert')
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                    ->from('Tomasz', ':ghost:')
                    ->to('#log')
                    ->content('Nachricht von Laravel');
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
            'data' => 'Status des Fahrzeugs wurde auf '.$this->vehicle->status.' geändert',
        ];
    }
}
