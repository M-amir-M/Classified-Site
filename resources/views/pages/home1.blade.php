@extends('layouts.layout')

@section('content')
    <div class=" head-filter">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 left">
                    <select class="form-control costum-input" id="province-filter">
                        <option value="" selected>استان</option>
                        @foreach(provinces() as $key => $province)
                            <option value="{{ $province }}"> {{ $province }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-4 middle">
                    <select class="form-control costum-input" id="category-filter">
                        <option value="" selected>دسته</option>
                        @foreach(parentCat() as  $category)
                            <option value="{{ $category->id }}"> {{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-4 right">
                    <input class="form-control costum-input" id="search-input" type="search" placeholder="جستجو..."
                           name="search">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="container">
            <div class="row" id="banner-container">
                <div class="visible-xs hidden-md">
                    <br>
                    @if($banners != null)
                        @foreach($banners as $banner)
                            <div class="card">
                                <div class="col-xs-8">
                                    <h3 class="">
                                        <span class="fa fa-tag"></span>&nbsp; {{$banner->title}}
                                    </h3>
                                    <h6>
                                        <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->created_at->diffForHumans() }}
                                    </h6>
                                    <h6><span class="fa fa-map-marker"></span> &nbsp;{{ $banner->city }}
                                    </h6>
                                    <h6>
                                        <span class="fa fa-money"></span>&nbsp;{{ \App\Banner::getPrice($banner) }}
                                    </h6>
                                </div>
                                <div class="col-xs-4" style="padding-right: 0;padding-bottom: 0;">
                                    <div class="card-image" style="margin: 0;padding: 0;">
                                        <a href="{{ route('banners.showbanner',[$banner->city,$banner->id,str_replace(' ','-',$banner->title)]) }}">
                                        <img class="img img-responsive"
                                             @if(count($banner->photos)>0)
                                             src="/{{ $banner->photos->first()->thumbnail_path }}"
                                             @else
                                             src="{{url('/images/nophoto.jpg')}}"
                                             @endif
                                             style="margin-bottom: 0;padding-bottom: 0;">
                                            </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="visible-lg visible-sm visible-md hidden-xs">
                @if($banners != null)
                    @foreach($banners->chunk(4) as $ban)
                        <div class="row">
                            @foreach($ban as $banner)
                                <div class="col-sm-3 col-xs-6 gallery-image card-banner">
                                    <a href="{{ route('banners.showbanner',[$banner->city,$banner->id,str_replace(' ','-',$banner->title)]) }}">
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
                                                            class="fa fa-tag"></span>&nbsp; {{$banner->title}}</h1>
                                                <hr>
                                                <h6>
                                                    <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->created_at->diffForHumans() }}
                                                </h6>
                                                <h6><span class="fa fa-map-marker"></span> &nbsp;{{ $banner->city }}
                                                </h6>
                                                <h6>
                                                    <span class="fa fa-money"></span>&nbsp;{{ \App\Banner::getPrice($banner) }}
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
        </section>
    </div>
@stop