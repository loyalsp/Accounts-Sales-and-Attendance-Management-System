@extends('layouts.admin')
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">

@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    {!! Charts::assets()!!}
@endsection

@section('side-body')
    <div class="col-sm-4 col-md-4">
        @if(!is_string($sale_chart))
            {!! $sale_chart->render() !!}
        @else

            <section class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{$sale_chart}}
            </section>
        @endif
    </div>
    <div class="col-sm-5 col-md-5">
        @if(!is_string($sale_chart))
            {!! $attendance_chart->render() !!}
        @endif
    </div>
    @if(isset($sales))
        <div class="col-sm-9 col-md-9" style="float: right;">
            <hr>
            <div id="admin-table" class="center-text">
                <h2>All Sales of today</h2>
                @if(!is_null($sales))
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
                Total Sale of the day: {{$total_sale}} $
                <br>
            </div>
        </div>
    @endif

@endsection
