<?php

use App\Events\PostComment;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
// Route::get('message', function () {
//     return view('messages.index');
// });
// TODO : route for user delete account
Route::get('delete-account', [HomeController::class, 'deleteUser'])->name('delete-account');
Auth::routes();
Route::get('like/{post}',[HomeController::class,'like'])->name('like');
Route::get('addss',function(){

});