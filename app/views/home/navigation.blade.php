<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ URL::route('home.index') }}" class="navbar-brand">Medical Management System</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li @if(starts_with(Route::currentRouteName(), 'patient')) class="active"@endif>
                    <a href="{{ URL::route('patient.create') }}">Getting started</a>
                </li>
                @if($user->isStaff())
				<li>
                    <a href="{{ URL::route('patient.show.all') }}">Patients</a>
                </li>
                @else
				<li class="dropdown @if(starts_with(Route::currentRouteName(), 'appointment')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Appointments <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('appointment.create') }}">Create</a></li>
                        <li><a href="{{ URL::route('appointment.show.all') }}">See my appointments</a></li>
                    </ul>
                </li>
				@endif
				<li class="dropdown @if(starts_with(Route::currentRouteName(), 'billing')) active @endif"">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Billing <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @if($user->isStaff())
						<li><a href="{{ URL::route('billing.show-outstanding-charges') }}">Show Accounts Outstanding</a></li>
                        <li><a href="{{ URL::route('billing.show-payments') }}">Show Payments</a></li>
						@else
						<li><a href="{{ URL::route('billing.make-payment') }}">Make Payment</a></li>
                        <li><a href="{{ URL::route('billing.show-patient-balance') }}">Show Patient Balance</a></li>
						@endif
                    </ul>
                </li>
				<li class="dropdown @if(starts_with(Route::currentRouteName(), 'conversations')) active @endif"">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Conversations <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('conversation.create') }}">Start New Conversation</a></li>
                        <li><a href="{{ URL::route('conversation.show.all') }}">See Conversations</a></li>
                    </ul>
                </li>
				                
				<li>
                    <a href="{{ URL::route('users.logout') }}">Logout</a>
                </li>
                
            </ul>
        </nav>
    </div>
</header>