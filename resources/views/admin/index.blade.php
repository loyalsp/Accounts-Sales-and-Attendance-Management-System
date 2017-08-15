@extends('layouts.admin')
@section('style')
    <link href="{{URL::to('css/admin-sidebar.css')}}" rel="stylesheet">

@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    {!! Charts::assets()!!}
@endsection

@section('side-body')
    <div class="col-sm-4">
        @if(!is_string($sale_chart))
            {!! $sale_chart->render() !!}
        @else

            <section class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{$sale_chart}}
            </section>
        @endif
    </div>

    <div class="col-sm-5">
        @if(!is_string($sale_chart))
            {!! $attendance_chart->render() !!}
        @endif
    </div>
    </div>
@endsection
