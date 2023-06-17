@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('message.css') }}">
@section('title', 'Messages')
@section('content')
        <div class="container p-0 opacity-100">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3 border-right">
                        <div class="px-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control my-3" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                        @foreach ($group->users as $user)
                        <a href="#" class="list-group-item list-group-item-action border-0 mb-3 ms-2">
                            <div class="d-flex align-items-start">
                                <img src="{{asset('storage/profile-pictures/'.$user->profile)}}" class="rounded-circle mr-1" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    @if (Cache::has('user-is-online-'.$user->id))
                                    <div class="small"><span class="fas fa-circle chat-online"></span></div>
                                    @else
                                    <div class="small"><span class="fas fa-circle chat-offline"></span></div>                                        
                                    @endif
                                    <span class="fw-bold ms-2">{{$user->name}}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="{{asset('storage/groups-cover/'.$group->cover)}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3 ms-2">
                                    <strong>{{$group->name}} <span class="text-success fw-bolder"> " Chat " </span></strong>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative">
                            <div class="chat-messages p-4">
                                @foreach ($messages as $message)
                                @if ($message->user_id == Auth::user()->id)
                                <div class="chat-message-right pb-4">
                                    <div>
                                        <img src="{{asset('storage/profile-pictures/'.Auth::user()->profile)}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <div class="fw-bolder mb-1 text-success ">You</div>
                                        <span class="fw-bolder">{{$message->message}}</span>
                                    </div>
                                </div>
                                @else
                                <div class="chat-message-left pb-4" >
                                    <div>
                                        <img src="{{asset('storage/profile-pictures/'.$message->user->profile)}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                        <div class="font-weight-bold mb-1 text-primary">{{$message->user->name}}</div>
                                        <span class="fw-bolder">{{$message->message}}</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div id="at-time-message"></div>
                                <div id="scrollView"></div>
                            </div>
                        </div>
                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group ms-auto me-auto text-center">
                            <form action="{{ route('messages.store') }}" method="POST" class="w-75 d-inline-block" >
                                @csrf
                                <input type="text" class="form-control" placeholder="Type your message" name="message">
                                <input type="hidden" value="{{ $group->id }}" name="group_id">
                                <button class="btn btn-primary d-inline-block w-100 mt-2">Send</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
        var scrollview = document.getElementById('scrollView');
        scrollview.scrollIntoView();
    </script>
@endsection
