<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikePost extends Notification
{
    use Queueable;

    public $like;
    public function __construct($like)
    {
        $this->like = $like;
    }
    
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toArray(object $notifiable): array
    {
        return [
            'username' => $this->like->user->name,
            'post' => $this->like->post->title,
        ];
    }
}
