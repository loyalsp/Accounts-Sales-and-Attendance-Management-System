@extends('layouts.master')
@section('title')
    Home
@endsection
@include('includes.frontend-header')
@section('content')
    <div class="container">
        @include('includes.time-message-box')
        <div class="center">
            <h3 class="center-text">Accounts Sales and Attendance Management System</h3>
            @include('includes.info-box')
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Employee Id</label>
                    <input type="username" class="form-control" id="username" placeholder="Employee id" name="username">

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <br>
            <p class="center-text">Copyright &copy; 2017 WEBZ XPERT Solutions</p>
        </div>
    </div>
    @include('includes.footer')
@endsection