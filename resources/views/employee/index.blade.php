@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('style')

@endsection
@section('content')
    @include('includes.employee-navbar')
    <div class="container">
        <div class="center-text">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Check In/Out</div>
                        <div class="panel-body"><button class="btn btn-primary">Check in or check out</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">Activity Record</div>
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="from-date">From</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="from-date" placeholder="Starting date" name="from-date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="end-date">End Date</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="end-date" placeholder="End date" name="end-date">
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <button type="submit" class="btn btn-primary">Get Report</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
