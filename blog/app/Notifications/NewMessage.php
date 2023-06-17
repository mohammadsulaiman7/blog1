<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification implements ShouldBroadcast
{
    use Queueable;
    public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }
    public function via(object $notifiable): array
    {
        return ['database']; // ['database','broadcast'];
    }
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->message->user->name,
            'group'=>$this->message->group->name
        ];
    }
    //  public function toBroadcast($notifiable): BroadcastMessage
    // {
    //     return new BroadcastMessage([
    //         'name' => 'Hello world!'
    //     ]);
    // }
}
