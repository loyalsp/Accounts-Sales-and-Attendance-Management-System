<div class="">
    @if(Session::has('fail'))
        <section class="alert alert-warning alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{Session::get('fail')}}
        </section>
    @endif

    @if(Session::has('success'))
        <section class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{Session::get('success')}}
        </section>
    @endif
</div>