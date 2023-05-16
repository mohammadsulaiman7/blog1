@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('show-group.css') }}">
@section('title', "$group->name")
@section('content')
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
                        {{-- @if (Cache::has('user-is-online-'.$user->id))  
                        @else
                        <div class="time"><span class="text-info"> last seen : </span>{{$user->last_seen}}</div>
                        @endif --}}
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
        <div class="group-posts ">
        </div>
        </div>
    </div>
        @endsection
