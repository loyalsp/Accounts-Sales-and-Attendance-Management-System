@extends('layouts.admin')
@section('title')
    Attendance Record
@endsection
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/admin.css')}}" rel="stylesheet">
@endsection
@section('side-body')
    <h2>Employee`s Attendance Record</h2>
    <div class="col-sm-2 col-md-2">
        <form method="post" action="{{route('show.attendance-record')}}">
            <div class="form-group">
                <label for="date-from">Start Date</label>
                <input type="date" name="date_from" class="form-control" id="date-from"
                >
            </div>

            <div class="form-group">
                <label for="date-to">To Date</label>
                <input type="date" name="date_to" id="date-to" class="form-control">
            </div>


            <input type="hidden" value="{{Session::token()}}" name="_token">
            <br>
            <div class="form-group">
                <label for="idAndName">Select a user</label>
                <select name="idAndName" class="form-control" id="idAndName" required>
                    <option value=""></option>
                    @if(isset($users))
                        @foreach($users as $user)
                            <option value="{{$user->id}},{{$user->full_name}}">{{$user->full_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <input type="submit" value="Get Attendances">
        </form>
    </div>
    <div class="col-sm-4 col-md-4">
        @include('includes.error-box')
    </div>


    <div class="col-sm-9 col-md-9 pull-right">
        @if(!is_null($user_name))
            <h2>Attendances of {{$user_name}} from {{$_REQUEST['date_from']}} to {{$_REQUEST['date_to']}}</h2>
        @else
            <h2>Current day Attendances</h2>
        @endif
        <div id="admin-table" class="center-text">
            @if(isset($attendances))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center-text">#</th>
                        <th class="center-text">Employee Name</th>
                        <th class="center-text">Check in</th>
                        <th class="center-text">Check out</th>
                        <th class="center-text">Hour Worked</th>
                        <th class="center-text">Day</th>
                        <th class="center-text">Date</th>
                    </tr>
                    </thead>

                    @foreach($attendances as $attendance)

                        <tbody>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$attendance->user->full_name}}</td>
                            <td>{{$attendance->check_in}}</td>
                            <td>{{$attendance->check_out}}</td>
                            <td>{{$attendance->working_hours}}</td>
                            <td>{{$attendance->current_date}}</td>
                            <td>{{$attendance->created_at}}</td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            @endif

            <br>

        </div>
        <br>
        <br>
    </div>


@endsection
