@extends('layouts.employee')
@section('title')
    Dashboard
@endsection
@section('side-body')
    @include('includes.info-box')
    @include('includes.error-box')
        <h1>Current Month Sale Record</h1>
        <div id="employee-table" class="center-text">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="center-text">#</th>
                    <th class="center-text">Sale</th>
                    <th class="center-text">Store Name</th>
                    <th class="center-text">Store Location</th>
                    <th class="center-text">Date</th>
                </tr>
                </thead>
                @foreach($sales as $sale)
                    <tbody>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sale->sale_today}} $</td>
                        <td>{{$sale->getStore->store_name}}</td>
                        <td>{{$sale->getStore->location}}</td>
                        <td>{{$sale->created_at}}</td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    <div class="center-text" style="position:relative;top:100px;">{{$sales->links()}}</div>
    </div>
    </div>
@endsection
