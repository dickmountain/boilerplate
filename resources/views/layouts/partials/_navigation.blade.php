<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'Laravel') }}
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
	<ul class="nav navbar-nav">
				&nbsp;
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				@not_subscribed
					<li><a href="{{ route('plans.index') }}">Plans</a></li>
				@endnot_subscribed
				<!-- Authentication Links -->
				@guest
					<li><a href="{{ route('login') }}">Login</a></li>
					<li><a href="{{ route('register') }}">Register</a></li>
				@else
					@impersonating
						<li>
							<a href="#"
								onclick="
									event.preventDefault();
									document.getElementById('impersonate_destroy').submit();
                                "
							>Stop impersonating</a>
						</li>

						<form id="impersonate_destroy" action="{{ route('admin.impersonate.destroy') }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
						</form>
					@endimpersonating
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu">
							<li><a href="{{ route('account.index') }}">Account</a></li>
							<li>
								<a href="{{ route('logout') }}"
								   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>