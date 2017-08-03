@extends('layouts.master')
@section('title')
    Home
@endsection
@section('content')
    @include('includes.frontend-navbar')
    <div class="container">
        @include('includes.time-message-box')
        <div class="center" id="login-background">
            <h3 class="center-text">Accounts Sales and Attendance Management System</h3>
            @include('includes.info-box')
            @include('includes.error-box')
            <form action="{{route('employee-login')}}" method="post">
                <div class="form-group">
                    <label for="email">Employee Email</label>
                    <input type="email" class="form-control" id="email" placeholder="example@example.com" name="email">

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <br>
            <a href="{{route('login-with-facebook')}}"><img id="fb-img" class="img-responsive" src="{{URL::to('images/fb-login.png')}}"> </a>
            <a class="" href="password/reset" style=" padding-left:200px;">
                Forgot You Password?
            </a>
        </div>
    </div>
    @include('includes.footer')
@endsection