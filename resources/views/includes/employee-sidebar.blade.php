<div class="side-menu">

    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="brand-wrapper">
                <!-- Hamburger -->
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>

        <!-- Main Menu -->
        <div class="side-menu-container">
            <ul class="nav navbar-nav">
                <li><a href="{{route('employee.index')}}">&nbsp;&nbsp;<span class="glyphicon glyphicon-home"></span>Home</a></li>
                <li><a href="{{route('employee.monthly-sale-record')}}">&nbsp;&nbsp;&nbsp;<i class="fa fa-usd"></i>&nbsp;&nbsp;&nbsp;Current Month Sale Record</a></li>
                <li><a href="{{route('employee.monthly-attendance-record')}}">&nbsp;&nbsp;<span class="glyphicon glyphicon-stats"></span>Current Month Attendance Record</a></li>
                <li><a href="{{route('employee.sale-today')}}">&nbsp;&nbsp;&nbsp;<i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Enter Sale to Check Out</a></li>

                <!-- Dropdown-->
                <li class="panel panel-default" id="dropdown">
                    <a data-toggle="collapse" href="#dropdown-lvl1">
                        &nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span>Drop down<span class="caret"></span>
                    </a>

                    <!-- Dropdown level 1 -->
                    <div id="dropdown-lvl1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

             {{--   <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>--}}

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>

</div>