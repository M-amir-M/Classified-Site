@extends('layouts.layout')

@section('content')
    <div ng-controller="HomeController">
        <div class=" head-filter">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 left">
                        <select class="form-control selectpicker costum-select" ng-model="search.city">
                            <option value="" selected>استان</option>
                            @foreach(provinces() as $key => $province)
                                <option value="{{ $province }}"> {{ $province }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4 middle">
                        <select class="form-control selectpicker costum-select" ng-model="search.cat_format">
                            <option value="" selected>دسته</option>
                            @foreach(categories() as  $key =>$category)
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4 right">
                        <div class="form-group label-floating has-success">
                            <label class="control-label"></label>
                            <input
                                    ng-model="search.$"
                                    class="form-control costum-input has-success"
                                    id="search-input"
                                    type="search"
                                    placeholder="جستجو..."
                                    name="search">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div ng-show="loading" style="z-index: 9999; text-align: center;margin-top: 200px;margin-bottom: 400px"><img src="{{ url('images/loading.gif') }}" width="100" height="100" alt="در حال لود شدن"></div>

            <section class="container">
                <div class="row" id="banner-container">
                    {{--for small screen--}}
                    <div class="visible-xs hidden-md">
                        <br>
                        <div class="card" ng-repeat="banner in banners |filter:search">
                            <a href="/@{{ banner.city }}/@{{ banner.id }}/@{{ banner.title_format }}">

                                <div class="col-xs-8">
                                    <h3 class="card-title">
                                        <div class="cheshmak cheshmak-shadow"></div>
                                        <span class="fa fa-tag"></span>&nbsp; @{{(banner.title).length>25?(banner.title).substring(0, 25)+'...':banner.title}}&nbsp;
                                    </h3>
                                    <h6>
                                        <span class="fa fa-clock-o"></span>&nbsp; @{{  banner.diff_date }}
                                    </h6>
                                    <h6>
                                        <span class="fa fa-map-marker"></span> &nbsp;@{{ banner.city }},@{{ banner.location }}
                                    </h6>
                                    <h6>
                                        <span class="fa fa-money"></span>&nbsp;@{{ banner.price_format }}
                                    </h6>
                                </div>
                                <div class="col-xs-4" style="padding-right: 0;padding-bottom: 0;">
                                    <div class="card-image" style="margin: 0;padding: 0;">
                                        <img class="img" ng-if="banner.photos.length>0"
                                             src="/@{{ banner.photos[0].thumbnail_path }}"
                                        >
                                        <img class="img" ng-if="banner.photos.length==0"
                                             src="/images/nophoto.jpg"
                                        >
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>

                    {{--for big screen--}}
                    <div class="visible-lg visible-sm visible-md hidden-xs">
                        <div class="col-sm-3 gallery-image card-banner" ng-repeat="banner in banners |filter:search">
                            <a href="/@{{ banner.city }}/@{{ banner.id }}/@{{ banner.title_format }}">
                                <div class="card card-profile">
                                    <div class="card-image">
                                        <img class="img" ng-if="banner.photos.length>0"
                                             src="/@{{ banner.photos[0].thumbnail_path }}"
                                        >
                                        <img class="img" ng-if="banner.photos.length==0"
                                             src="/images/nophoto.jpg"
                                        >

                                    </div>

                                    <div class="content">
                                        <h1 class="card-title">
                                            <div class="cheshmak cheshmak-shadow"></div>
                                            <span class="fa fa-tag"></span>&nbsp; @{{(banner.title).length>25?(banner.title).substring(0, 25)+'...':banner.title}}
                                        </h1>
                                        <hr>
                                        <h6 >
                                            <span class="fa fa-clock-o"></span>&nbsp; @{{  banner.diff_date }}
                                        </h6>
                                        <h6><span class="fa fa-map-marker"></span> &nbsp;@{{ banner.city }},@{{ banner.location }}
                                        </h6>
                                        <h6>
                                            <span class="fa fa-money"></span>&nbsp;@{{ banner.price_format }}
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop