@extends('layouts.files')

@section('fcontent')
        <!-- Static navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img width="100" height="50"
                                                                    src="{{ asset('images/logo.jpg') }}"
                                                                    alt="unisaleman"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (auth()->guest())
                    <li><a class="btn btn-success hvr-pulse" href="/login"> انتشار آگهی</a></li>
                    <li><a href="{{ url('/login') }}">ورود</a></li>
                    <li><a href="{{ url('/register') }}">ثبت نام</a></li>
                @else
                    <li><a class="btn btn-success hvr-pulse" href="{{ route('banners.create') }}"> انتشار آگهی</a></li>
                    <li><a class="btn btn-primary" href="{{ route('banners.mybanners') }}"> آگهی های من</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $user->phone }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>خروج</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@yield('content')
<br><br>
<footer class="footer navbar navbar-primary navbar-fixed-bottom" style="height: 50px;">
    <div class="container">
        <div class="social-networks pull-left" >
            <a href="https://telegram.me/unisaleman">
                <img src="http://unisaleman.com/images/social-logo/telegram.png"
                     width='30' height='30' alt='unisaleman telegram'>
            </a>
            <a href="https://instagram.com/unisaleman" alt="unisaleman instagram">
                <img src="http://unisaleman.com/images/social-logo/instagram.png"
                     width='30' height='30' alt='iunisaleman instagram'
                     style='margin-right:10px;'>
            </a>
        </div>
        <div style="font-size: 14px;margin-top: 5px;"> طراحی توسط <a class="text-info" href="http://asasite.com">آسا سایت</a></div>
    </div>
</footer>
@if(Request::is('/'))
@endif
@stop