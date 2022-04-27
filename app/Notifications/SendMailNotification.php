<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMailNotification extends Notification 
{
    use Queueable;

    protected $details;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //dd($details);
        $this->details=$details;
      
        
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
      //  dd($notifiable->p_email);
       
        return (new MailMessage)
                    ->greeting($this->details['greeting'])
                    ->line($this->details['body'])
                    ->action(
                            $this->details['actiontext'],
                            $this->details['actionurl'],
                         )
                    ->line($this->details['endpart'])
                    ->line('Thank you For Appointment!');
                    
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
