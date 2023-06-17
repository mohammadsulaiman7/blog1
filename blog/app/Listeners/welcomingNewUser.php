<?php

namespace App\Listeners;

use App\Events\NewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class welcomingNewUser
{

    public function __construct()
    {

    }
    public function handle(NewUser $event)
    {
        if($event->check == "welcome")
        {
            return redirect()->route('posts.index')->with('welcome',"Welcome bro");
        }
        else
        return redirect()->back()->with('error');
    }
}
