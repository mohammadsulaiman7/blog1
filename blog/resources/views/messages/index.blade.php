@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('message.css') }}">
@section('title', 'Messages')
@section('content')
    <div class="container p-0">
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
                            <img src="{{asset('storage/profile-pictures/'.$user->profile)}}" class="rounded-circle mr-1"
                                alt="Vanessa Tucker" width="40" height="40">
                                @if (Cache::has('user-is-online-'.$user->id))
                                <div class="flex-grow-1 ml-3">
                                    <div class="small"><span class="fas fa-circle chat-online"></span></div>
                                    <div class="ms-3 mt-1 fw-bold">{{$user->name}}</div>
                                </div>
                                @else
                                <div class="flex-grow-1 ml-3">
                                    <div class="small"><span class="fas fa-circle chat-offline"></span></div>
                                </div>
                                @endif
                        </div>
                    </a>
                    @endforeach
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9 ">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <img src="{{asset('storage/groups-cover/'.$group->cover)}}" class="rounded-circle mr-1"
                                    alt="Sharon Lessman" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 pl-3">
                                <strong></strong>
                                <div class="text-success ms-3 fw-bold">{{$group->name}}</div>
                            </div>
                        </div>
                    </div>
                    <div id="message-container">
                    @foreach ($messages as $message)
                        <div class="position-relative">
                            <div class="chat-messages p-4">
                                    @if ($message->user->id == Auth::user()->id)
									<div class="chat-message-right pb-4 ">
                                        <div>
                                            <img src="{{asset('storage/profile-pictures/'.$message->user->profile)}}"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1 text-success">You</div>
                                            {{ $message->message }}
                                        </div>
                                </div>
					@else
					<div class="chat-message-left pb-4">
                        <div>
                            <img src="{{asset('storage/profile-pictures/'.$message->user->profile)}}"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2">{{$message->created_at->toDateString()}}</div>
                        </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                            <div class="font-weight-bold mb-1">{{$message->user->name}}</div>
                            {{$message->message}}
                        </div>
                    </div>
					@endif
							</div>
                    @endforeach
                    <div id="message-content"></div>
                </div>
                    {{-- <div id="scrollView"></div> --}}
                    <div class="flex-grow-0 py-3 px-4 border-top postion-fixed" >
                        <div class="input-group">
							<form action="{{route('messages.store')}}" method="POST" class="w-100" id="scrollView" >
							@csrf
						<input type="text" class="form-control" placeholder="Type your message" name="message">
							<input type="hidden" value="{{$group->id}}" name="group_id">
                            <button class="btn btn-primary">Send</button>
						</form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
        var scorlview=document.getElementById('scrollView');
scorlview.scrollIntoView();
    </script>
@endsection
