@extends('layouts.app')
<link rel="stylesheet" href="{{asset('comment.css')}}">
@section('title','comments')
@section('content')
  <div class="blog-comment">
    <h3 class="text-success">Comments</h3>
    <form action="{{route('comments.store')}}" method="POST">
      @csrf
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <button class="btn btn-outline-success me-1" type="sunmit">Comment</button>
        </div>
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="text" class="form-control" placeholder="Comment" aria-label="" aria-describedby="basic-addon1" name="comment" required>
      </div>
    </form>
    <hr/>
    <div id="ul2">
  @foreach ($comments as $comment)
    <div class="row">
		<div class="col-md-12">
				<ul class="comments" id="ul1">
				<li class="clearfix" id="comment<?php echo $comment->id ?>">
				  <img src="{{asset('storage/profile-pictures/'.$comment->user->profile)}}" class="avatar" alt="">
				  <div class="post-comments">
            @if ($comment->user_id == Auth::user()->id)
				      <div class="meta">{{$comment->created_at->toDateString()}} <a href="{{route('profile',$post->user)}}" class="text-success text-decoration-none fw-bolder"> You </a>
                <div class="projcard-subtitle d-inline-block">
                  @can('update-comment', $comment)
                      <a href="{{ route('posts.edit', $post) }}"><i
                              class="fa-solid fa-pen-to-square"></i></a>
                      <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline-block">
                          @csrf
                          @method('DELETE')
                          <button type="submit" style="border:none;background:none;" class="text-danger"><i class="fa-solid fa-trash"></i></button>
                      </form>
                  @endcan</div>
                </div>
            @else
				      <p class="meta ">{{$comment->created_at->toDateString()}} <a href="{{route('profile',$comment->user)}}" class="text-primary text-decoration-none fw-bold d-inline-block"> {{$comment->user->name}} </a></p>
            @endif
				      <p>
				          {{$comment->comment}}
				      </p>
				  </div>
				</li>
				</ul>
			</div>
		</div>
@endforeach
</div>
@vite('public/js/custom1.js')
@endsection