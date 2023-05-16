<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('all.min.js')}}">
    <link rel="stylesheet" href="{{asset('app.css')}}">
    <!-- Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"> </script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body id="app1">
  <div id="app">
        <nav id="nav">
            <div id="logo"><a href="/">Iustitia</a></div>
            <ul id="ul" id="header">
                <li><a href="/">Home</a></li>
                <li><a href="{{route('posts.index')}}">Posts</a></li>
                <li><a href="{{route('posts.create')}}">Create Post</a></li>
                <li><a href="{{route('messages.index')}}">Messages</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="{{route('groups.index')}}">Groups</a></li>
            </ul>
           
            @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
                <div id="profile">
                  <a href="{{route('profile',Auth::user())}}"><img src="{{asset('storage/profile-pictures/'.Auth::user()->profile)}}" class="rounded-circle" style="width: 30px; height:30px"></a>
                  <p><a href="{{route('profile',Auth::user())}}">{{Auth::user()->name}}</a></p>
              </div>
            </li>
        @endguest
        </nav>
        @if (session()->has('success'))
          <div class="alert alert-success w-25 ms-auto me-auto mt-3" role="alert">
            {{session()->get('success')}}
          </div>
          @endif
          @if (session()->has('warning'))
          <div class="alert alert-warning w-25 ms-auto me-auto mt-3" role="alert">
            {{session()->get('warning')}}
          </div>
          @endif
          @if (session()->has('error'))
          <div class="alert alert-danger w-25 ms-auto me-auto mt-3" role="alert">
            {{session()->get('error')}}
          </div>
          @endif
          @if (session()->has('welcome'))
          <div class="alert alert-success" role="alert">
            Welcome : {{Auth::user->name()}}
          </div>
          @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('all.min.js')}}"></script>
    @vite('public/js/app.js')
    @vite('public/js/updateCommentCount.js')
    @vite('public/js/deleteComment.js')
    @vite('public/js/newMessage.js')
</body>
</html>
