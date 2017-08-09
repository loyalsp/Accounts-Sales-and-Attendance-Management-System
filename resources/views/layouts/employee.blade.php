@extends('layouts.master')
@section('style')
    <link href="{{URL::to('css/employee.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/common.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('css/styles.css')}}">
@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="{{URL::to('js/script.js')}}"></script>
@endsection
@section('content')
    @include('includes.employee-navbar')
    <div class="row">
        <!-- uncomment code for absolute positioning tweek see top comment in css -->
        <!-- <div class="absolute-wrapper"> </div> -->
        <!-- Menu -->
    @include('includes.employee-sidebar')
    <!-- Main Content -->
        <div class="container">
            <div class="side-body">
                @include('includes.live-watch')
   @yield('side-body')
                <!-- side body end-->
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
