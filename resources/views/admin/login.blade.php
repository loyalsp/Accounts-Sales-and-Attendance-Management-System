@extends('layouts.admin')
@section('title')
    Admin Login
@endsection
@section('content')
    @include('includes.frontend-navbar')
    <div class="container-fluid">
        <div class="side-body">
            <div class="center" id="login-background">
                <h3 class="center-text">Accounts Sales and Attendance Management System</h3>
                <h4 class="center-text">Admin Login</h4>
                @include('includes.info-box')
                @include('includes.error-box')
                <form action="{{route('post-admin-login')}}" method="post">
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
                <a class="" href="password/reset" style=" padding-left:200px;">
                    Forgot You Password?
                </a>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection