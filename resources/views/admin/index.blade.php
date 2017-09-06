@extends('layouts.admin')
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">

@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    {!! Charts::assets()!!}
@endsection

@section('side-body')
    <div class="col-sm-3 col-md-3">
        @if(!is_string($sale_chart))
            {!! $sale_chart->render() !!}
        @else

            <section class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{$sale_chart}}
            </section>
        @endif
    </div>
    <div class="col-sm-2 col-md-2">
        <form method="post" action="{{route('admin.sale-record')}}">
            start date<input type="date" name="date_from">
            <br>
            end date<input type="date" name="date_to">
            <input type="hidden" value="{{Session::token()}}" name="_token">
            <br>

            <select name="user_id">
                <option value="">All Sales</option>
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->full_name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Submit">
        </form>
        </div>
    <div class="col-sm-4 col-md-4">
        @if(!is_string($sale_chart))
            {!! $attendance_chart->render() !!}
        @endif
    </div>
@endsection
