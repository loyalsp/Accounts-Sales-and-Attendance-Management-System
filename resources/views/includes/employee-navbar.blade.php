<header>
    <div class="navbar-wrapper">
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('index')}}">AAMS</a>
                </div>
                <ul class="nav navbar-nav">
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> {{$user->first_name}}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('employee-logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</header>
