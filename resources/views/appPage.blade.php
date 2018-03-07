<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@yield("header")
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Social Hammer GuestBook</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">GuestBook</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('signup')}}">Signup</a>
            </li>
            <li class="nav-item">
                @if(\Illuminate\Support\Facades\Auth::user())
                    <a href="#"   class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                @else
                    <a href="{{ url('login') }}"  class="nav-link">Login</a>
                @endif
            </li>
        </ul>
    </div>
</nav>

<div class="container body-content">
@if(Session::has('info_msg'))
    <div class="alert alert-info" >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {!! Session::get('info_msg') !!}
    </div>
@endif
@if(Session::has('error_msg'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {!! Session::get('error_msg') !!}
    </div>
@endif

<div class="container">
    @yield("content")
</div>

<hr />
<footer>
    <p>&copy; 2018 - Social Hammer GuestBook</p>
</footer>
</div>
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js//bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/script.js') }}"></script>

@yield("script")

</body>
</html>
