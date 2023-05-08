@extends('layouts.app')
    <link rel="stylesheet" href="{{asset('style.css')}}">
<link rel="stylesheet" href="{{asset('card-post.css')}}">
    @section('title',"profile")
    @section('content')
    <div class="container" >
    	<div class="row">
    		<div class="col-md-6" style="margin: auto">
    		    <div class="card profile-card-3">
    		        <div class="background-block">
    		            <img src="{{asset('bg2.jpg')}}"/>
    		        </div>
    		        <div class="profile-thumb-block">
    		            <img src="{{asset('storage/profile-pictures/'.$user->profile)}}"  class="profile"/>
    		        </div>
    		        <div class="card-content">
                    <h2>{{$user->name}}<small>Auther</small></h3>
                    <div class="icon-block">
						<a href="{{route('delete-account')}}" class="btn btn-outline-danger"><i class="fa-solid fa-user-minus"></i></a>    
						<a href="logout" class="btn btn-outline-secondary"><i class="fa-solid fa-right-from-bracket"></i></a>
					</div>
				</div>
                </div>
    		</div>	
    </div>
	</div>
	<hr>
	<div id="posts-profile">
		<h1>{{$user->name}}'s Posts ( {{$posts->count()}} )</h1>
	</div>
	@foreach ($posts as $post)
	<div class="projcard-container"  id="card<?php echo $post->id?>">
		<div class="projcard projcard-customcolor" style="--projcard-color: #F5AF41;">
		  <div class="projcard-innerbox">
			@if ($post->media == null)
			<img class="projcard-img" src="https://picsum.photos/800/600?image=943" />
			@else
			<img class="projcard-img" src="{{asset('storage/posts-media/'.$post->media)}}" />
			@endif
			<div class="projcard-textbox">
			  <div class="projcard-title">{{$post->title}}</div>
			  @if ($post->likes->where('user_id',Auth::user()->id)->where('check','true')->count()!= 0)
			  <div class="projcard-subtitle"><a href="{{route('like',$post)}}" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
			  @else
			  <div class="projcard-subtitle"><a href="{{route('like',$post)}}" class="btn btn-outline-success"><i class="fa-solid fa-heart"></i></a>
			  @endif
				<a href="{{ route('posts.show', $post) }}" class="btn btn-outline-secondary"><i
						class="fa-solid fa-comment"></i></a>
				@can('update-post', $post)
					<a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary"><i
							class="fa-solid fa-pen-to-square"></i></a>
					<form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline-block">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
					</form>
				@endcan</div>
			  <div class="projcard-bar"></div>
			  <div class="projcard-description">{{ Str::limit($post->content,30)}}
				@if (Str::length($post->content) >30)
				<span><a href="{{route('read-more',$post)}}" class="text-decoration-none text-info">Read more ...</a></span></div>
				@else
					
				@endif 
			  <div class="projcard-tagbox">
				<div class="projcard-tag" ><a href="{{route('profile',Auth::user())}}" class="text-black">{{$post->user->name}}</a></div>
				<div id="comment-count">
					Comments : {{ $post->comments->count() }} <br>
					Like : {{$post->likes->where('check','true')->count()}}
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	@endforeach
	<div class="d-flex">
		{!! $posts->links() !!}
	</div>
  @endsection