@extends('layouts.layout')

@section('content')
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
        }

        .container-error {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>

    <div class="container-error">
        <div class="content">
            <div class="title"><span class="fa fa-thumbs-down "></span></div>
            <div class="alert alert-warning">
            	<strong>در این صفحه چیزی یافت نشد!!</strong>
            </div>
        </div>
    </div>
@endsection