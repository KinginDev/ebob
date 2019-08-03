@extends('layout')

@section('content')
    <style>
        .breadcrumb-area {
            padding: 230px 0 142px 0;
            position: relative;
            z-index: 0;
        }
    </style>

    @php
        $page_title = 404
    @endphp


    <div class="get-in-touch-area cotnact-page">
        <div class="container text-center">
            <div class="row">
                <div class="breadcrumb-inner">
                    <div class="breadcrumb-lists">
                        <h1 class="page-title">{{$page_title}}</h1>
                        <h4>Page Not Found!!</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>




@stop