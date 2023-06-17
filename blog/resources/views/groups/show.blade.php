@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('show-group.css') }}">
<link rel="stylesheet" href="{{asset('card-post.css')}}">
@section('title', "$group->name")
@section('content')
<a href="{{route('ss',$group->id)}}" class="btn btn-outline-success ms-auto me-auto d-block w-25">Create Post</a>
    <div class="show-group-container">
        <div class="group-users">
            <h1 class="text-center"><span>{{$group->name}}</span> users </h1>
            <hr>
            <div class="users-group">
            <ul class="users" id="ul-group-info">
                @foreach ($group->users as $user)
                    <li class="person" data-chat="person1">
                        <div class="user">
                            <img src="{{asset('storage/profile-pictures/'.$user->profile)}}" >
                            @if (Cache::has('user-is-online-' . $user->id))
                            <span class="status online"></span>
                        @else
                            <span class="status offline"></span>
                            @endif
                        </div>
                        <p class="name-time">
                            @if ($user->id == Auth::user()->id)
                            <span class="name text-success">You</span>
                            @else
                            <span class="name">{{$user->name}}</span>
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
        <div class="group-posts ">
            @foreach ($group->posts as $post)
                    
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
                      <div class="projcard-subtitle"><a href="{{route('like',$post)}}" class="btn btn-success" ><i class="fa-solid fa-heart"></i></a>
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
                      <div class="projcard-description">{{ Str::limit($post->content,60)}}
                        @if (Str::length($post->content) >60)
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
        </div>
        </div>
    </div>
        @endsection
