<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class CommentNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //$this->user = $user;
        $this->user_name = $user->name;
        $this->comment = $user->comments->last()->text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //$url = url($this->user_name);
        return (new MailMessage)
                ->subject("$this->user_name is commented your post !")
                ->markdown('/message');
        // return (new MailMessage)
        //             ->success()
        //             ->subject("$this->user_name is commented your post !")
        //             ->line($this->comment);
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                ->success()
                ->content("$this->user_name is commented your post !")
                ->attachment(function ($attachment) {
                    $attachment->content($this->comment);        
                });
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
