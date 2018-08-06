@extends('layouts.layout')

@section('content')
    <section class="container" style="margin-top: 100px;">

        <h1>آگهی خود را انتشار کنید!</h1>
        <hr>
        <form
                action="{{ route('banners.store') }}"
                method="POST"
                role="form"
                enctype="multipart/form-data"
        >
            @include('banners.form')
        </form>


        <div class="modal fade" id="modal-cat">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="list-group list-cust">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="modal-city">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="list-group list-cust">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        @include('partials.errors')
    </section>
@stop
@section('script')
@stop