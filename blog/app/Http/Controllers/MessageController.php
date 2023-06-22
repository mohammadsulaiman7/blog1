<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessage as NotificationsNewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        // $group_id=$request->group_id;
        $groups=Group::where('user_id',Auth::user()->id)->get();
        return view('messages.index',compact('groups'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message=Message::create($request->all() + ['user_id'=>Auth::user()->id]);
        if($message->save())
        {
            event(new NewMessage($message->message));
            $users=User::join('group_user','group_user.user_id','=','users.id')
            ->where('group_user.group_id','LIKE',$request->group_id)
            ->where('user_id','!=',Auth::user()->id)
            ->get();
            Notification::send($users,new NotificationsNewMessage($message));
            return back();
        }
        else 
        return "asd";
    }
    public function show(Message $message)
    {
        
    }
    public function edit(Message $message)
    {

    }
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
