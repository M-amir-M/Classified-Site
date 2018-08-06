@extends('layouts.layout')

@section('content')
    <section class="container" style="margin-top: 100px;">

        <div class="card card-nav-tabs">
            <div class="header header-primary">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="active">
                                <a href="#profile" data-toggle="tab" aria-expanded="true">
                                    <i class="material-icons">face</i>آگهی های من
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="">
                                <a href="#messages" data-toggle="tab" aria-expanded="false">
                                    <i class="material-icons">chat</i>پیام ها
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false">
                                    <i class="material-icons">build</i>تنظیمات
                                    <div class="ripple-container"></div>
                                </a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="profile">
                        @if(count($banners)>0)
                            @foreach($banners->chunk(4) as $ban)
                                <div class="row">
                                    @foreach($ban as $banner)
                                        <div class="col-md-3 gallery-image card-banner">
                                            <a href="{{ route('banners.userbanner',[$banner->city,$banner->id,str_replace(' ','-',$banner->title)]) }}">
                                                <div class="card card-profile">
                                                    <div class="card-image">
                                                        <img class="img"
                                                             @if(count($banner->photos)>0)
                                                             src="/{{ $banner->photos->first()->thumbnail_path }}"
                                                             @else
                                                             src="{{url('/images/nophoto.jpg')}}"
                                                                @endif
                                                        >
                                                    </div>

                                                    <div class="content">
                                                        <h1 class="card-title"><span
                                                                    class="fa fa-tag"></span>&nbsp; {{$banner->title}}
                                                        </h1>
                                                        <hr>
                                                        <h6>
                                                            <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->created_at->diffForHumans() }}
                                                        </h6>
                                                        <h6><span class="fa fa-map-marker"></span>
                                                            &nbsp;{{ $banner->city }}
                                                        </h6>
                                                        <h6>
                                                            <span class="fa fa-money"></span>&nbsp;{{ $banner->price_format }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <a class="btn btn-success hvr-pulse" href="{{ route('banners.create') }}">اولین آگهی خود را منتشر کنید.</a>
                        @endif
                    </div>
                    <div class="tab-pane" id="messages">
                        <p> پیامی ندارید.</p>
                    </div>
                    <div class="tab-pane" id="settings">
                        <p> فعلا تنظیماتی وجود ندارد.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop