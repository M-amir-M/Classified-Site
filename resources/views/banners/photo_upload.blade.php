@extends('layouts.layout')

@section('content')
    <section class="container" style="margin-top: 100px;">
        @if($signedIn && $user->owns($banner))
            <div class="row">
                <div id="image-gollery">
                </div>
            </div>
            <div class="row">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong></strong> در هنگام آپلود شدن عکس لطفا صبور باشید
                </div>
            </div>
            <form id="addPhotoForm"
                  action="{{ route('photos.store',[$banner->id]) }}"
                  class="dropzone"
                  method="POST">
                {{ csrf_field() }}
            </form>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="{{ route('banners.mybanners') }}" class="btn btn-primary">انتشار آگهی</a>
                </div>
            </div>
        </div>
    </section>
@stop