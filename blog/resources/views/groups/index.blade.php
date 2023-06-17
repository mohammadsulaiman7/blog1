@extends('layouts.app')
<link rel="stylesheet" href="{{asset('group.css')}}">
@section('title','Groups')
@section('content')
<div class="col1-discover">
  <div class="col1-group">
  <h1>Discover groups</h1>
  <hr>
<a href="{{route('groups.create')}}" class="btn btn-outline-success ms-auto me-auto d-block w-25">Create group</a>
<div id="body-group">
 @foreach ($groups as $group)
<div class="flip-card-container" style="--hue: 220">
    <div class="flip-card">
      <div class="card-front">
        <figure>
          <div class="img-bg"></div>
          <img src="{{asset('storage/groups-cover/'.$group->cover)}}">
          <figcaption><span class="text-warning">{{$group->name}}</span> <span>
            @if ($group->privacy == true)
            <i class="fa-solid fa-key"></i>
            @else
            @endif
          </span></figcaption>
        </figure>
        <ul id="group-ul">
          <li>Created by : <span class="text-warning">{{$group->user->name}}</span></li>
          <li>users count : <span class="text-warning">{{$group->users->count()}}</span></li>
          <li>posts count : <span class="text-warning">{{$group->posts->count()}}</span></li>
          <li>Category : <span class="text-warning">{{$group->category->name}}</span></li>
        </ul>
      </div>
      <div class="card-back">
        <figure>
          <div class="img-bg"></div>
          <img src="{{asset('storage/groups-cover/'.$group->cover)}}">
        </figure>
        @if ($group->user_id == Auth::user()->id)
        <a href="{{route('chat',$group)}}" class="btn btn-outline-secondary"><i class="fa-brands fa-rocketchat"></i></a>
        <a href="{{route('groups.show',$group)}}" class="btn btn-outline-success ms-2 me-2"><i class="fa-solid fa-eye"></i></a>
        @else
        
        @if ($group->privacy == false)

        @if (!($group->users()->where('id',Auth::user()->id)->exists()))
        
        <a href="{{route('join',$group->id)}}" class="btn btn-outline-primary"><i class="fa-solid fa-door-open"></i></a>

        @endif
        
        <a href="{{route('groups.show',$group)}}" class="btn btn-outline-success ms-2 me-2"><i class="fa-solid fa-eye"></i></a>

        @else

        @if (($group->users()->where('id',Auth::user()->id)->exists()))

        <a href="{{route('chat',$group)}}" class="btn btn-outline-secondary"><i class="fa-brands fa-rocketchat"></i></a>
        <a href="{{route('groups.show',$group)}}" class="btn btn-outline-success ms-2 me-2"><i class="fa-solid fa-eye"></i></a>

        @else
        
        <form action="{{route('join-privacy',$group->id)}}" method="GET">
          @csrf
          <div class="Key">
            <label for="title" class="form-label">Group Key</label>
            <input class="form-control" id="title" name="key"></input>
            <button type="submit" class="btn btn-outline-success">Join</button>
        </div>
        </form>
        @endif
        @endif
        @endif
        @can('group-update', $group)
            <a href="{{route('groups.edit',$group)}}" class="btn btn-outline-warning ms-5 me-5"><i
              class="fa-solid fa-pen-to-square"></i></a>
              <form action="{{route('groups.destroy',$group)}}" method="POST">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
            </form>
        @endcan
      </div>
    </div>
  </div>
  @endforeach
  </div>
  </div>
   <div class="col2-group">
    <h1>Your groups</h1>
    <hr>
  </div>
  </div>
@endsection