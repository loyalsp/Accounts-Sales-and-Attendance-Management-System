<div class="">
    @if(Session::has('fail'))
        <section class="alert alert-warning">
            {{Session::get('fail')}}
        </section>
    @endif

    @if(Session::has('success'))
        <section class="alert alert-success">
            {{Session::get('success')}}
        </section>
    @endif
</div>