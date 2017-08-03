<div class="card center-text">
    @if($time<1200 && $time>0500)
        <h2>Good Morning</h2>
    @elseif($time>1200 && $time<=1759)
        <h2>Good Afternoon</h2>
    @elseif($time>1759 && $time<=1959)
        <h2>Good Evening</h2>
    @endif

</div>