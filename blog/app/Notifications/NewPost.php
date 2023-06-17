<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPost extends Notification
{
    use Queueable;
    
    public $post;
    public function __construct($post)
    {
        $this->post=$post;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->post->title,
            'user' => $this->post->user->name,
            'group' => $this->post->group->name,
        ];
    }
}
