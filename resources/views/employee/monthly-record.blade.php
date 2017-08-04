@extends('layouts.master')
@section('title')
    Monthly Record
@endsection
@section('style')
<link href="{{URL::to('css/employee.css')}}" rel="stylesheet">
@endsection
@section('content')
    @include('includes.employee-navbar')
    <div class="container">
        @include('includes.live-watch')
            @include('includes.info-box')
        <div id="employee-table" class="center-text">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="center-text">#</th>
                    <th class="center-text">Check in</th>
                    <th class="center-text">Check out</th>
                    <th class="center-text">Leave</th>
                    <th class="center-text">Date</th>
                </tr>
                </thead>
                @foreach($records as $record)
                <tbody>
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$record->check_in}}</td>
                    <td>{{$record->check_out}}</td>
                    <td>{{$record->leave_type}}</td>
                    <td>{{$record->created_at}}</td>
                </tr>
                </tbody>
                    @endforeach
            </table>
</div>
    </div>
    </div>
    @include('includes.footer')
@endsection
