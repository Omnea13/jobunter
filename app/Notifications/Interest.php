<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Interest extends Notification
{
    use Queueable;
    
    private $from;
    private $to;
    private $job;
    private $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from, $to, $job, $type)
    {
        $this->from = $from;
        $this->to   = $to;
        $this->job  = $job;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

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

    public function toDatabase($notifiable)
    {

        // dd($notifiable);

        return [
            'from_id'   => $this->from,
            'to_id'     => $this->to,
            'job_id'    => $this->job,
            'type'      => $this->type
        ];
    }
}
