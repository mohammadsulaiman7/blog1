<?php

namespace App\Listeners;

use App\Events\NewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class welcomingNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUser $event)
    {
        if($event->check == "welcome")
        {
            return redirect()->route('posts.index')->with('welcome');
        }
        else 
        return redirect()->back()->with('error');
    }
}
