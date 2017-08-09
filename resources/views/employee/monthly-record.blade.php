@extends('layouts.employee')
@section('title')
    Dashboard
@endsection
@section('side-body')
    @include('includes.info-box')
    @include('includes.error-box')
        <h1>Current Month Attendance Record</h1>
        <div id="employee-table" class="center-text">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="center-text">#</th>
                    <th class="center-text">Check in</th>
                    <th class="center-text">Check out</th>
                    <th class="center-text">Day</th>
                    <th class="center-text">Leave</th>
                    <th class="center-text">Working hours</th>
                </tr>
                </thead>
                @foreach($attendances as $attendance)
                <tbody>
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$attendance->check_in}}</td>
                    <td>{{$attendance->check_out}}</td>
                    <td>{{$attendance->day}}</td>
                    <td>{{$attendance->leave_type}}</td>
                    <td>{{$attendance->working_hours}}</td>

                </tr>
                </tbody>
                    @endforeach
            </table>
</div>
    </div>
    </div>
    @include('includes.footer')
@endsection
