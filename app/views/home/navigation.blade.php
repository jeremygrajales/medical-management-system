<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="./" class="navbar-brand">Medical Management System</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ URL::route('patient.create') }}">Getting started</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Appointments <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('appointment.create') }}">Create</a>
                        </li>
                        <li><a href="{{ URL::route('appointment.show.all') }}">See my appointments</a>
                        </li>
                    </ul>
                </li>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Billing <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('appointment.create') }}">Make Payment</a>
                        </li>
                        <li><a href="{{ URL::route('appointment.show.all') }}">See Balance</a>
                        </li>
                    </ul>
                </li>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Messages <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('appointment.create') }}">New Message</a>
                        </li>
                        <li><a href="{{ URL::route('appointment.show.all') }}">See Messages</a>
                        </li>
                    </ul>
                </li>
				                
				<li>
                    <a href="{{ URL::route('users.logout') }}">Logout</a>
                </li>
                
            </ul>
        </nav>
    </div>
</header>