@extends('layouts.app')
@section('title',"$group->name")
@section('content')
    <ol>
            @foreach ($group->users as $user)
                <li class="mb-5"><img src="{{asset('storage/profile-pictures/'.$user->profile)}}" class="rounded-circle" style="width: 30px;height:30px"> {{$user->name}}</li>
            @endforeach
    </ol>
@endsection