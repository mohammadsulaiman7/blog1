<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function deleteUser(){
        $user=User::find(Auth::user()->id);
        $profile1=Auth::user()->profile;
        if($user->delete())
        {
            if($profile1 != "no-profile.png")
            Storage::disk('public')->delete('profile-pictures/'.$profile1);
            return redirect()->route('register');
        }
        else 
        return "failed";
    }
    public function like(Post $post){
        if(Like::where('user_id',Auth::user()->id)->where('post_id',$post->id)->first())
        {
            $like=Like::where('user_id',Auth::user()->id)->where('post_id',$post->id)->first();
                $check=$like->check;
                $like->check= !$check;
                if($like->update())
                if($check)
                return back()->with('warning',"Unlike");
                else
                return back()->with('success',"Liked");
                else 
                return back()->with('error','error in liked');
        }
        else 
        {
            $like= new Like();
            $like->user_id=Auth::user()->id;
            $like->post_id=$post->id;
            $like->check=true;
            if($like->save())
            return back()->with("success",'Liked');
            else 
            return back()->with('error','sorry');
        }
    }
}
