@extends('layouts.app')
@section('title','Notifications')
@section('content')
    <ul>
        @foreach ($user->notifications as $notification)
        @if ($notification->type == 'App\Notifications\NewPost')
        @if ($notification->read_at)
        <div class="w-100 text-center ">
        <div class="alert alert-secondary" role="alert">
            <li class="text-black">{{ $notification->data['user'] }} post into
                {{ $notification->data['group'] }} Group
            </div>
            @else
            <div class="alert alert-info" role="alert">
            <li class="mb-3 ms-2 text-black">{{ $notification->data['user'] }} post into
                {{ $notification->data['group'] }}Group
                <span class="btn btn-info ms-3">
                    <a href="{{ route('read11', $notification) }}" class="text-decoration-none"> mark as read </a></span>
                </div>
        @endif
        </li>
    </div>           
        @endif
        @if ($notification->type == 'App\Notifications\NewMessage')
        @if ($notification->read_at)
        <div class="w-100 text-center ">
        <div class="alert alert-secondary" role="alert">
            <li class="text-black">{{ $notification->data['name'] }} send a new message to 
                {{ $notification->data['group'] }} Group
            </div>
            @else
            <div class="alert alert-info text-center" role="alert">
            <li class="mb-3 ms-2 text-black">{{ $notification->data['name'] }} send a new message into
                {{ $notification->data['group'] }} Group
                <span class="btn btn-info ms-3">
                    <a href="{{ route('read11', $notification) }}" class="text-decoration-none"> mark as read </a></span>
                </div>
        @endif
        </li>
        @endif
        @if ($notification->type == 'App\Notifications\NewComment')
        @if ($notification->read_at)
        <div class="w-100 text-center ">
        <div class="alert alert-secondary" role="alert">
            <li class="text-black">{{ $notification->data['username'] }} comment on your post  
                {{ $notification->data['comment'] }}
            </div>
            @else
            <div class="alert alert-info text-center" role="alert">
            <li class="mb-3 ms-2 text-black">{{ $notification->data['username'] }} comment on your post 
                {{ $notification->data['comment'] }}
                <span class="btn btn-info ms-3">
                    <a href="{{ route('read11', $notification) }}" class="text-decoration-none"> mark as read </a></span>
                </div>
        @endif
        </li>
        @endif
        @if ($notification->type == 'App\Notifications\LikePost')
        @if ($notification->read_at)
        <div class="w-100 text-center ">
        <div class="alert alert-secondary" role="alert">
            <li class="text-black">{{ $notification->data['username'] }} like your  
                {{ $notification->data['post'] }} post
            </div>
            @else
            <div class="alert alert-info text-center" role="alert">
            <li class="mb-3 ms-2 text-black">{{ $notification->data['username'] }} like your
                {{ $notification->data['post'] }} post
                <span class="btn btn-info ms-3">
                    <a href="{{ route('read11', $notification) }}" class="text-decoration-none"> mark as read </a></span>
                </div>
        @endif
        </li>
        @endif
    </ul>
    @endforeach
@endsection
