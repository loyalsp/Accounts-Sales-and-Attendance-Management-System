@extends('layouts.master')
@section('title')
    Home
@endsection
@section('content')
    @include('includes.frontend-navbar')
    <div class="container">
        @include('includes.time-message-box')
        <div class="center">
            <h3 class="center-text">Accounts Sales and Attendance Management System</h3>
            @include('includes.info-box')
            @include('includes.error-box')
            <form action="{{route('employee-login')}}" method="post">
                <div class="form-group">
                    <label for="email">Employee Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Employee Email" name="email">

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <br>
            <h3 class="center-text" id="employee_background">Employee Login</h3>
        </div>
    </div>
    @include('includes.footer')
@endsection