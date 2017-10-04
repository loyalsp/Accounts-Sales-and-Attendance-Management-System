@extends('layouts.admin')
@section('title')
    Current Month salaries
@endsection
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/admin.css')}}" rel="stylesheet">
@endsection
@section('side-body')
    <h2>Current Month salary status</h2>
    <div class="col-sm-2 col-md-2">
        
    </div>
    <div class="col-sm-4 col-md-4">

    </div>


    <div class="col-sm-9 col-md-9 pull-right">
        @include('includes.error-box')
        @include('includes.info-box')
        <div id="admin-table" class="center-text">
            @if(isset($salaries))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center-text">#</th>
                        <th class="center-text">Employee Name</th>
                        <th class="center-text">Salary</th>
                        <th class="center-text">Hourly rate</th>
                        <th class="center-text">Status</th>

                    </tr>
                    </thead>

                    @foreach($salaries as $salary)

                        <tbody>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$salary->getUser->full_name}}</td>
                            <td>{{$salary->salary_of_month}} $</td>
                            <td>{{$salary->getUser->personal_information->hourly_rate}} $</td>
                            <td>@if($salary->status == 'due')<a  href="{{route('update-salary-status',['user_id' => $salary->user_id])}}">Paid</a>
                                <div class="overlay">
                                    <p class="hover-text">Click paid to update status</p>
                                </div>
                            @endif
                                &nbsp;&nbsp;{{$salary->status}}</td>

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
