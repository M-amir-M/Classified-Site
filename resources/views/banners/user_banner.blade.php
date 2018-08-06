@extends('layouts.layout')

@section('content')
    <section class="container" style="margin-top: 100px;">
        @if($banner->status == 2)
            <div class="row">
                <div class="alert alert-danger">
                    <button type="button" class="close pull-left" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                    <strong>آگهی {{ $banner->title }}</strong> به علت
                    "{{ reasonOfRejectBanner()[$banner->reason_reject] }}" در یونی سیل من قرار نگرفت.
                </div>
            </div>
        @elseif($banner->status == 0)
            <div class="alert alert-info">
                <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>آگهی {{ $banner->title }}</strong> هنوز تایید نشده است.
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('banners.edit',[$banner->id]) }}" class="btn btn-success">ویرایش آگهی</a>
                <form style="float: right;margin-left: 3px"
                      action="{{ route('banners.destroy',[$banner->id]) }}"
                      method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-block">حذف آگهی</button>
                </form>
                <h1>{{ $banner->price }}</h1>
                <div class="description">{!! $banner->description !!}</div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div id="image-gollery">
                        @foreach($banner->photos as $photo)
                            <div class="col-md-3 gallery-image">
                                <form action="/photo/{{ $photo->id }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm btn-danger label">
                                        &times;
                                    </button>
                                </form>
                                <a href="/{{ $photo->path }}" data-lity>
                                    <img src="/{{ $photo->thumbnail_path }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if($signedIn && $user->owns($banner))
                    <div class="alert alert-info">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    	<strong></strong> در هنگام آپلود شدن عکس لطفا صبور باشید
                    </div>
                    <form id="addPhotoForm"
                          action="{{ route('photos.store',[$banner->id]) }}"
                          class="dropzone"
                          method="POST">
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>
        </div>
    </section>
@stop