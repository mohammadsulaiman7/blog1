@extends('layouts.app')
<link rel="stylesheet" href="{{asset('read-more.css')}}">
@section('title','Read more')
@section('content')
  <div class="container-readmore">
        <img src="{{asset('storage/posts-media/'.$post->media)}}" alt="" id="read-more-image">
        <h1 id="title">{{$post->title}}</h1>
        <p id="content">{{$post->content}}</p>
    </div>
@endsection