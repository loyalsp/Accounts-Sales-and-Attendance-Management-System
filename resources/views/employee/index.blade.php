@extends('layouts.employee')
@section('title')
    Dashboard
    @endsection
@section('side-body')
    <h2>Hello! {{$user->full_name}}</h2>
    <div class="col-md-5">
        <div class="panel panel-default center-text">
            <div class="panel-heading">Check In/Check out</div>
            <div class="panel-body">
                @if(is_null($attendance))
                    <form method="post" action="{{route('post-check-in')}}" class="form-horizontal">
                        <label for="store_id">Please select a store: </label>
                        <select name="store_id">
<option></option>
                                @foreach($stores as $store)
                                    <option value="{{$store->id}}">
                                        {{$store->store_name}}
                                    </option>
                                @endforeach
                        </select>

                        <input type="hidden" value="{{Session::token()}}" name="_token">
                        <input class="btn btn-primary" type="submit" value="Check in">
                    </form>
                @elseif(is_null($attendance->check_out))
                    <a href="{{route('employee.sale-today')}}">
                        <button class="btn btn-primary">Enter Sale to Check out</button>
                    </a>

                    <br>
                    Checked in :&nbsp; {{$attendance->check_in}}
                @else Checked out : {{$attendance->check_out}}
                @endif

            </div>
        </div>
    </div>
    @endsection