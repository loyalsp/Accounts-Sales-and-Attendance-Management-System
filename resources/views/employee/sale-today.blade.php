@extends('layouts.employee')
@section('title')
    Dashboard
@endsection
@section('side-body')
    @include('includes.info-box')
    @include('includes.error-box')

        <div class="center-text">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Enter Sale</div>
                        <div class="panel-body">
                                <form method="post" action="{{route('post-employee.sale-today')}}" class="form-inline">

                                    <div class="form-group">
                                        <label for="sale_today">Sale Today :</label>
                                        <input type="" class="form-control" id="sale_today" placeholder="123456789.00"
                                               name="sale_today">
                                        </div>

<br>                       
                                    <input type="hidden" value="{{Session::token()}}" name="_token">
                                    <input type="hidden" value="{{$user->store_id}}" name="store_id">
                                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                    <br>
                                    <input class="btn btn-primary" type="submit" value="Submit and Check out">
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
