@extends('layouts.master')
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">

@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    {!! Charts::assets()!!}
@endsection

@section('content')
    @include('includes.frontend-navbar')
    <div class="container-fluid">
        <div class="row">
            @include('includes.admin-sidebar')
@yield('side-body')
        </div>
    </div>

    {{--@include('includes.footer')--}}
@endsection
