@extends('layouts.dashboard-layout')

@section('dcontent')
        <div class="row">
            <div class="pull-left"><a href="{{ route('admin.banners.unverifiedbanners') }}" class="btn btn-primary">بازگشت</a></div>
            <div class="pull-right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card product-slider">
                    <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                        <div class='carousel-outer'>
                            <!-- me art lab slider -->
                            <div class='carousel-inner '>
                                @if(count($banner->photos)>0)
                                    @foreach($banner->photos as $key => $photo)
                                        <div class='item @if($key==0) active @endif'>
                                            <img src="/{{$photo->path}}"
                                                 alt="{{ $banner->title }}"
                                                 class="img-responsive"
                                                 id=" @if($key==0) zoom_05 @endif"
                                                 data-zoom-image="/{{$photo->path}}"/>
                                        </div>
                                    @endforeach
                                @else
                                    <div class='item active'>
                                        <img src="{{ url('/images/nophoto.jpg') }}"
                                             alt="{{ $banner->title }}"
                                             class="img-responsive"
                                             id="zoom_05"
                                             data-zoom-image="{{ url('/images/nophoto.jpg') }}"/>
                                    </div>
                                @endif

                                <script>
                                    $("#zoom_05").elevateZoom({zoomType: "inner", cursor: "crosshair"});
                                </script>
                            </div>

                            <!-- sag sol -->
                            <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                                <span class='glyphicon glyphicon-chevron-left'></span>
                            </a>
                            <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                                <span class='glyphicon glyphicon-chevron-right'></span>
                            </a>
                        </div>

                        <!-- thumb -->
                        <ol class='carousel-indicators mCustomScrollbar meartlab'>
                            @if(count($banner->photos)>0)
                                @foreach($banner->photos as $key => $photo)
                                    <li data-target='#carousel-custom'
                                        data-slide-to='{{$key}}'
                                        class='@if($key==0) active @endif'>
                                        <img
                                                src='/{{$photo->path}}'
                                                alt='{{ $banner->title }}'/>
                                    </li>
                                @endforeach
                            @else
                                <li data-target='#carousel-custom'
                                    data-slide-to='0'
                                    class='active'>
                                    <img
                                            src='{{ url('/images/nophoto.jpg') }}'
                                            alt='{{ $banner->title }}'/>
                                </li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card jumbotron">
                    <h1 class="title">{{$banner->title}}</h1>
                    <br><br>
                    <h6><span class="fa fa-clock-o"></span>&nbsp; {{ $banner->created_at->diffForHumans() }} | <span
                                class="fa fa-map-marker"></span>&nbsp; {{ $banner->city }}</h6>
                </div>
                <div class="card jumbotron">
                    <div class="description">{!! $banner->description !!}</div>
                </div>
                <div class="card">
                    <div class="content">
                        <h4 class="card-title">
                            <div class="col-sm-6">
                                <a href="{{ route('admin.banners.verified',[$banner->id]) }}" class="btn btn-primary btn-block">
                                    <span class="fa fa-thumbs-up"></span>  تایید آگهی
                                </a>
                                <div class="btn btn-primary btn-block">{{ $banner->price }}</div>
                            </div>
                            <div class="col-sm-6">
                                <a data-toggle="modal" data-bannerid="{{ $banner->id }}" href="#modal-reject" class="modal-reject-btn btn btn-primary btn-block " >
                                    <span class="fa fa-thumbs-down"></span> &nbsp; رد آگهی
                                </a>
                                <div class="btn btn-primary btn-block"><span class="fa fa-map-marker"></span>{{ $banner->city }}</div>
                            </div>
                        </h4>

                        <div class="footer">
                            <div class="stats">
                                <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                                    <i class="material-icons">favorite</i>
                                </button>
                                <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                                    <i class="material-icons">share</i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>



@stop