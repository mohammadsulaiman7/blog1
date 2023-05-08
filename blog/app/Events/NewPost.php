<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewPost implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $media;
    public $content;
    public $name;
    public $title;
    // public $commentNum;
    public function __construct($title,$media,$content,$name)
    {
        $this->title=$title;
        $this->media=$media;
        $this->content=$content;
        $this->name=$name;
        // $this->commentNum = $commentNum;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return ['my-channel'];
    }
    public function broadcastAs()
    {
        return 'my-event1';
    }
    public function broadcastWith()
    {
        return ['media'=>$this->media ,'name'=>$this->name , 'content' => $this->content , 'title'=>$this->title];
    }
}
