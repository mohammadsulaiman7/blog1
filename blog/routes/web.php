<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Mail\Test;
use App\Models\Group;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('HOME');
Route::resource('posts', PostController::class)->middleware('auth');
Route::get('read-more/{post}',[PostController::class,'readMore'])->name('read-more');
Route::resource('comments', CommentController::class)->middleware('auth');
Route::get('profile/{user}', function (User $user) {
    $posts=Post::where('user_id',$user->id)->paginate(1);
    return view('profile', compact('user','posts'));
})->name('profile');
Route::get('delete-account', [HomeController::class, 'deleteUser'])->name('delete-account');
Route::get('like/{post}',[HomeController::class,'like'])->name('like');
Route::resource('groups',GroupController::class)->middleware('auth');
Route::get('join/{id}',[GroupController::class,'join'])->name('join');
Route::get('join-privacy/{id}',[GroupController::class,'joinPrivacy'])->name('join-privacy');
Route::resource('messages',MessageController::class)->middleware('auth');
Route::get('chat/{group}',function(Group $group){
    $messages=Message::where('group_id','=',$group->id)->get();
    return view('messages.index',compact('messages','group'));
})->name('chat');
Route::get('ss/{id}',function($id){
    return view('posts.create',compact('id'));
})->name('ss');
Route::get('notifications/',function(){ 
    $user=User::find(Auth::user()->id);
    return view('notifications.index',compact('user'));
})->name('notifications');
Route::get('read11/{id}',function($id){
    $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return back();
        }
})->name('read11');
Route::get('/send',function (){
    if(Mail::to('mohammadsulaiman355@gmail.com')->send(new Test()))
    return back()->with('success','email sending');
});
Route::get('pluck',function(){
    return User::pluck('name','email');
});
Auth::routes();