<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUser extends Notification
{
    use Queueable;
    public $user;
    public function __construct($user)
    {
        $this->user=$user;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];
    }
}
