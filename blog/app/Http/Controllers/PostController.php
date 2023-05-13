<?php

namespace App\Http\Controllers;

use App\Events\DeletePost;
use App\Events\NewPost;
use App\Events\UpdatePost;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $post = Post::create($request->all() + ['user_id' => Auth::user()->id]);
        // if ($post->save())
        // {
        //     event(new NewPost($post->title,$post->content));
        //     return redirect()->route('posts.index')->with('success', 'Create post successfuly');
        // }
        // else
        //     return abort(403);
        $request->validate([
            'title'=>'required|max:100|string',
            'content'=>'required|string',
            'media' =>'mimes:jpg,webp,png,gif',
        ]);
        $post = Post::create($request->all() + ['user_id' => Auth::user()->id]);
        if ($request->has('media')) {
            $mediaFile = $request->file('media');
            $mediaName = $post->id . '.' . $mediaFile->extension();
            $mediaFile->storeAs('posts-media', $mediaName, 'public');
            $post->media = $mediaName;
        }
        $post->save();
        event(new NewPost($post->title,$post->media, $post->content,$post->user->name));
        return redirect()->route('posts.index')->with('success', 'added post successfuly');
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', 'LIKE', $post->id)->with('user')->get();
        return view('posts.show', compact('post', 'comments'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->title=$request->title;
        $post->content=$request->content;
        if ($request->hasFile('media')) {
            Storage::delete('public/posts-media/'.$post->media);
            $mediaFile = $request->file('media');
            $mediaName = $post->id . '.' . $mediaFile->extension();
            $mediaFile->storeAs('posts-media', $mediaName, 'public');
            $post->media = $mediaName;
        }
        $post->update();
        event(new UpdatePost($post->media, $post->content));
        return redirect()->route('posts.index')->with('success', 'updated post successfuly');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        event(new DeletePost($post->id));
        $media = $post->media;
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }
        if ($post->delete()) {
            Storage::disk('public')->delete('posts-media/' . $media);
            return redirect()->route('posts.index')->with('success', 'delete post successfuly');
        } else
            return back()->with('error', 'Failed in deleting post');
    }
    public function readMore(Post $post){
        
        return view('posts.read-more',compact('post'));
    }
    
}
