@extends('layouts.dashboard-layout')

@section('dcontent')
    @if(count($banners)>0)
        @foreach($banners->chunk(4) as $bann)
            <div class="row">
                @foreach($bann as $banner)
                    <div class="col-sm-3 col-xs-6 gallery-image card-banner">
                        <a href="{{ route('admin.banners.showbanner', ['city' => $banner->city,'id' => $banner->id,'title' => $banner->title_format]) }}">
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
                                        <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->diff_date }}
                                    </h6>
                                    <h6><span class="fa fa-map-marker"></span> &nbsp;{{ $banner->city }}
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
    @endif
@stop