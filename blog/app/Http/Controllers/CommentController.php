<?php

namespace App\Http\Controllers;

use App\Events\DeleteComment;
use App\Events\PostComment;
use App\Events\UpdateCommentCount;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $comment=Comment::create($request->all() + ['user_id' => Auth::user()->id]);
        if($comment->save())
        {
            event(new UpdateCommentCount(Comment::count()));
            event(new PostComment($comment->comment));
            return back()->with('success','comment added successfuly');
        }
        else 
        abort(403);
    }
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        if(!Gate::allows('update-comment',$comment))
        {
            abort(403);
        }
        else 
        return "You can do it";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if($comment->update($request->all()))
        return redirect()->route('posts.show')->with('success','update comment successfuly');
        else 
        return back()->with('error','error in updating comment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        event(new DeleteComment($comment->id));
        if($comment->delete())
        {
            return back()->with('success','delete comment successfuly');
        }
        else 
        return back()->with('error','error in deleting comment');
    }
}
