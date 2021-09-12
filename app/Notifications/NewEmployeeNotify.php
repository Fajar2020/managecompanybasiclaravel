<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEmployeeNotify extends Notification
{
    use Queueable;
    private $employee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($Employee)
    {
        //
        $this->employee = $Employee;
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
                    ->line('Hello...')
                    ->line('New employee has been added to your company data')
                    ->line('Name : '.$this->employee['firstName'].' '.$this->employee['lastName'])
                    ->line('Email : '.$this->employee['email'])
                    ->line('Phone : '.$this->employee['phone']);
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
            
        ];
    }
}
