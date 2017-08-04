@extends('layouts.master')
@section('title')
    Home
@endsection
@section('style')

@endsection
@section('content')
    @include('includes.employee-navbar')
    <div class="container">
        @include('includes.live-watch')
        <div class="center-text">
            @include('includes.info-box')
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Check In/Out</div>
                        <div class="panel-body">
                            @if(is_null($attendance))
                                <a href="{{route('check-in')}}">
                                    <button class="btn btn-primary">Check in</button>
                                </a>
                            @elseif(is_null($attendance->check_out))
                                <a href="{{route('check-out')}}">
                                    <button class="btn btn-primary">Check out</button>
                                </a>
                                <br>
                                Checked in :&nbsp; {{$attendance->check_in}}
                            @else Checked out at: {{$attendance->check_out}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">Activity Record</div>

                        <a href="{{route('employee.monthly-record')}}"><button type="submit" class="btn btn-primary">Get This Month Record</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('includes.footer')
@endsection
