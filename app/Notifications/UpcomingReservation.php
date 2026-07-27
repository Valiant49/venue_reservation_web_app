<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpcomingReservation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $reservation)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Upcoming Reservation Reminder')
            ->view('vendor.mail.reservation-reminder', [
                'reservation' => $this->reservation,
                'resident' => $notifiable,
                'facility' => $this->reservation->facility,
            ]);

            // ->greeting("Hi {$notifiable->first_name},")
            // ->line("You have an upcoming reservation at {$this->reservation->facility->name}.")
            // ->line("Date: {$this->reservation->date->format('M j, Y')}")
            // ->line("Time: {$this->reservation->start_time->format('h:i A')} - {$this->reservation->end_time->format('h:i A')}")
            // ->line('See you there!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
