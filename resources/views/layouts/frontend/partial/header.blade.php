


	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="{{url('/')}}" class="logo"><img src="{{ asset('assets/frontend') }}/images/logo.png" alt="Logo Image"></a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{url('/')}}">Home</a></li>
				<li><a href="{{ route('post.index') }}">Post</a></li>
				@guest
					<li><a href="{{ route('login') }}">Login</a></li>
				@else
					@if (Auth::user()->role->id == 1)
						<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					@else
						<li><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
					@endif

				@endguest
			</ul><!-- main-menu -->

			<div class="src-area">
				<form action="{{ route('search') }}" method="GET">
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" value="{{ isset($query) ? $query : '' }}" name="query" type="text" placeholder="Type of search">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>

    