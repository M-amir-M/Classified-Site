@extends('layouts.layout')

@section('content')
    <section class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="container">
                <div class="pull-left"><a href="{{ route('home') }}" class="btn btn-primary btn-sm"> بازگشت <span class="fa fa-arrow-circle-left"></span></a></div>
                <div class="pull-right">
                    @foreach(array_reverse(explode("-",$banner->cat_format)) as $key =>$subCat)
                        @if($key != 0)
                            <span class="fa fa-chevron-left"></span>
                        @endif
                        {{ $subCat }}
                    @endforeach
                </div>
            </div>
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
                    <h6><span class="fa fa-clock-o"></span>&nbsp; {{ $banner->diff_date }} | <span
                                class="fa fa-map-marker"></span>&nbsp; {{ $banner->city }}</h6>
                </div>
                <div class="card">
                    <div class="content">
                        <h4 class="card-title">
                            <div class="col-sm-6">
                                <a href="tel:{{ $user->phone }}" class="btn btn-primary btn-block">
                                    <span class="fa fa-phone"></span> تماس با &nbsp;<abbr
                                            title="Phone">{{ $user->phone }}</abbr>
                                </a>
                                <div class="btn btn-primary btn-block"><span
                                            class="fa fa-money"></span>&nbsp; {{ $banner->price_format }}</div>
                            </div>
                            <div class="col-sm-6">
                                <button
                                        class="btn btn-primary btn-block send-email"
                                        data-toggle="modal"
                                        data-target="#send-email"
                                        data-title="{{ $banner->title }}"
                                        data-action="{{ route('banners.email',['banner_id'=>$banner->id]) }}"
                                >
                                    <span class="fa fa-envelope-o"></span> &nbsp; فرستادن ایمیل
                                </button>
                                <div class="btn btn-primary btn-block"><span class="fa fa-map-marker"></span>
                                    &nbsp;{{ $banner->city }}</div>
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
                <div class="card jumbotron">
                    <div class="description">{!! $banner->description !!}</div>
                </div>

                <div class="jumbotron">
                    <div class="container">
                        <h4>لطفا خرید خود را فقط به صورت حضوری انجام دهید و پیش از آن هیچ مبلغی را واریز نکنید.</h4>
                        <p>
                            <a class="btn btn-primary" href="#">گزارش آگهی</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="jumbotron">
                <h3>آگهی های مشابه</h3>
                <div class="container">
                    {{--for big screen--}}
                    <div class="visible-lg visible-sm visible-md hidden-xs">
                        <div class="carousel slide" id="sameAgahiCarouselBig">
                            <div class="carousel-inner">
                                {{--for small screen--}}
                                @if($same_banners != null)
                                    @foreach($same_banners->chunk(4) as $key=>$ban)
                                        <div class="item @if($key == 0) active @endif">
                                            <ul class="thumbnails">
                                                @foreach($ban as $banner)

                                                    <li class="col-md-3 col-xs-6 gallery-image card-banner">
                                                        <a href="{{ route('banners.showbanner',[$banner->city,$banner->id,$banner->title_format])}}">
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
                                                                        <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->diff_date }}
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
                                                    </li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif

                            </div>


                            <nav>
                                <ul class="control-box pager">
                                    <li><a data-slide="prev" href="#sameAgahiCarouselBig" class=""><i
                                                    class="glyphicon glyphicon-chevron-right"></i></a></li>
                                    <li><a data-slide="next" href="#sameAgahiCarouselBig" class=""><i
                                                    class="glyphicon glyphicon-chevron-left"></i></li>
                                </ul>
                            </nav>
                            <!-- /.control-box -->

                        </div><!-- /#sameAgahiCarouselBig -->
                    </div>
                    {{--for small screen--}}
                    <div class="visible-xs hidden-md">
                        <div class="carousel slide" id="sameAgahiCarouselSmall">
                            <div class="carousel-inner">

                                @if($same_banners != null)
                                    @foreach($same_banners->chunk(2) as $key=>$ban)
                                        <div class="item @if($key == 0) active @endif">
                                            <ul class="thumbnails">
                                                @foreach($ban as $banner)

                                                    <li class="col-md-3 col-xs-6 gallery-image card-banner">
                                                        <a href="{{ route('banners.showbanner',[$banner->city,$banner->id,$banner->title_format])}}">
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
                                                                        <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->diff_date }}
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
                                                    </li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif

                            </div>


                            <nav>
                                <ul class="control-box pager">
                                    <li><a data-slide="prev" href="#sameAgahiCarouselSmall" class=""><i
                                                    class="glyphicon glyphicon-chevron-right"></i></a></li>
                                    <li><a data-slide="next" href="#sameAgahiCarouselSmall" class=""><i
                                                    class="glyphicon glyphicon-chevron-left"></i></li>
                                </ul>
                            </nav>
                            <!-- /.control-box -->

                        </div><!-- /#sameAgahiCarouselSmall -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Core -->
    <div class="modal fade" id="send-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-left" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <div class="modal-title" id="myModalLabel"> ارسال ایمیل به فروشنده آگهی <span
                                id="send-email-title"></span></div>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="send-email-form">
                        {{ csrf_field() }}
                        <div class="form-group label-floating">
                            <label for="email" class="control-label">ایمیل شما</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group label-floating">
                            <label for="phone" class="control-label">شماره تلفن شما</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group  label-floating">
                            <label for="description" class="control-label">پیام شما</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="5">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop