<div class="card center-text">
    @if($time<1200 && $time>2359)
        <h2>Good Morning</h2>
    @elseif($time>1200 && $time<1759)
        <h2>Good Afternoon</h2>
    @elseif($time>1759 && $time<2000)
        <h2>Good Evening</h2>
    @endif

</div>