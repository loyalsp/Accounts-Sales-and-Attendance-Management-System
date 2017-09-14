@extends('layouts.admin')
@section('title')
    Sale Record
    @endsection
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/admin.css')}}" rel="stylesheet">
@endsection
@section('script')

    {!! Charts::assets()!!}
@endsection

@section('side-body')
    <h2>Employee`s Sale Record</h2>
    <div class="col-sm-2 col-md-2">
        <form method="post" action="{{route('show-sale-by-dates')}}">
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
                <label for="idAndName">Select a user or none to get all sale between dates</label>
            <select name="idAndName" class="form-control" id="idAndName">
                <option value="">All Sales</option>
                @if(isset($users))
                    @foreach($users as $user)
                        <option value="{{$user->id}},{{$user->full_name}}">{{$user->full_name}}</option>
                    @endforeach
                @endif
            </select>
                </div>
            <input type="submit" value="Get Sale">
        </form>
    </div>
    <div class="col-sm-4 col-md-4">
        @include('includes.error-box')
    </div>

    @if(isset($sales))
    <div class="col-sm-9 col-md-9 pull-right">
        @if(isset($user_info->id) && !is_null($user_info->id))
            <h2>Sale of {{$user_info->name}} from {{$_REQUEST['date_from']}} to {{$_REQUEST['date_to']}}</h2>
        @else
            <h2>Sale of All Employees from {{$_REQUEST['date_from']}} to {{$_REQUEST['date_to']}}</h2>
        @endif
        <div id="admin-table" class="center-text">
            @if(isset($sales))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center-text">#</th>
                        <th class="center-text">Sale</th>
                        <th class="center-text">Store Name</th>
                        <th class="center-text">Store Location</th>
                        <th class="center-text">Employee Name</th>
                        <th class="center-text">Date</th>
                    </tr>
                    </thead>
                    <?php
                    $total_sale = 0;
                    ?>
                    @foreach($sales as $sale)
                        <?php
                        $total_sale = $total_sale + $sale->sale_today
                        ?>
                        <tbody>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sale->sale_today}} $</td>
                            <td>{{$sale->getStore->store_name}}</td>
                            <td>{{$sale->getStore->location}}</td>
                            <td>{{$sale->user->full_name}}</td>
                            <td>{{$sale->created_at}}</td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            @endif
            Total Sale of these Records: {{$total_sale}} $
            <br>
                Total Sale of all Stores: {{$grand_total}}
        </div>
            <br>
            <br>
    </div>
    @endif

@endsection
