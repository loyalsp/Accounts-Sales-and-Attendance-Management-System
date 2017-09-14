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
    <h2>Sale of any store</h2>
    <div class="col-sm-2 col-md-2">
        <form method="post" action="{{route('show-store-sale')}}">
            <div class="form-group">
                <label for="date-from">Start Date</label>
                <input type="date" name="date_from" class="form-control" id="date-from">
            </div>

            <div class="form-group">
                <label for="date-to">To Date</label>
                <input type="date" name="date_to" id="date-to" class="form-control">
            </div>


            <input type="hidden" value="{{Session::token()}}" name="_token">
            <br>
            <div class="form-group">
                <label for="idAndName">Please Select a store</label>
                <select name="idAndName" class="form-control" id="idAndName" required>
                    <option></option>
                    @if(isset($stores))
                        @foreach($stores as $store)
                            <option value="{{$store->id}},{{$store->store_name}}">{{$store->store_name}}</option>
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
                <h2>Sale of {{$store_name}} from {{$_REQUEST['date_from']}} to {{$_REQUEST['date_to']}}</h2>
            <div id="admin-table" class="center-text">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center-text">#</th>
                            <th class="center-text">Sale</th>
                            <th class="center-text">Store Name</th>
                            <th class="center-text">Employee Name</th>
                            <th class="center-text">Created at</th>
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
                                <td>{{$sale->user->full_name}}</td>
                                <td>{{$sale->created_at}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                Total Sale of these Records: {{$total_sale}} $
                <br>
            </div>
            <br>
            <br>
        </div>
    @endif

@endsection
