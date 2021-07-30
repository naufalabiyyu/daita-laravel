	 <!-- desktop version -->
	 <nav class="d-none d-lg-flex navbar navbar-expand-lg navbar-light  fixed-top navbar-fixed-top px-5" data-aos="fade-down">
		<a class="navbar-brand ml-3" href="{{ route('home') }}">
			<img src="{{ asset('images/Logo.svg') }}" alt="" />
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<ul class="navbar-nav navbar-store ml-auto">
					<li class="nav-item ">
						<a class="nav-link " href="{{ route('home') }}">Home</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="{{ route('contact-us') }}">Contact Us</a>
					</li>
					@guest
					<li class="nav-item">
						<a class="nav-link " href="{{ route('login') }}">Sign in</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-success nav-link px-4 shadow-sm" style="background-color: #fceebd;" href="{{ route('register') }}">Sign Up</a> 
					</li>
					@endguest
				</ul>
				
				
				@auth
				<ul class="navbar-nav navbar-store d-none d-lg-flex">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link border-left" id="navbarDropdown" role="button" data-toggle="dropdown">
							<img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=FF7158&color=FFF" height="60" alt="" class="rounded-circle mr-2 ml-2 profile-picture">&nbsp; Hi, {{ Auth::user()->name }}
						</a>
						<div class="dropdown-menu">
							<a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
							<a href="{{ route('dashboard-profile') }}" class="dropdown-item">Setting</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('logout') }}" 
							   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
						<li>
							<a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
							@php
								$carts = \App\Cart::where('users_id', Auth::user()->id_user)->count();
							@endphp
							@if ($carts > 0 )
								<img src="{{ asset('images/icon_cart_filled.svg') }}" alt="">
								<div class="card-badge">{{ $carts }}</div>
							@else
								<img src="{{ asset('images/icon_cart_empty.svg') }}" alt="">
							@endif
								
							</a>
						</li>
					</li>
				</ul>
				<!-- Mobile Version -->
				<ul class="navbar-nav navbar-store d-block d-lg-none">
					<li class="nav-item">
						<a href="{{ route('dashboard') }}" class="nav-link">Hi, {{ Auth::user()->name }}</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('cart') }}" class="nav-link d-inline-block">Cart</a>
					</li>
				</ul>
			@endauth
	  </div>
  
</nav>
<nav class="d-lg-none bg-light navbar navbar-expand-lg navbar-light fixed-top navbar-fixed-top px-5" data-aos="fade-down">
	<a class="navbar-brand ml-3" href="{{ route('home') }}">
		<img src="/images/Logo.svg" alt="" />
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<ul class="navbar-nav navbar-store ml-auto">
				<li class="nav-item ">
					<a class="nav-link " href="{{ route('home') }}">Home</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="#about-section">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="#">Customer Care &nbsp;</a>
				</li>
				@guest
				{{-- knp ini?, error dimari --}}
				{{-- <li class="nav-item">
					<a class="nav-link " href="{{ route('register') }}">Sign Up</a>
				</li> --}}
				   <li class="nav-item">
					<a class="btn btn-success nav-link px-4 shadow-sm mb-2" style="background-color: #fceebd;" href="{{ route('login') }}">Sign In</a> 
				</li>
				@endguest
			</ul>
			
			
			@auth
			<ul class="navbar-nav navbar-store d-none d-lg-flex">
				<li class="nav-item dropdown">
					<a href="#" class="nav-link border-left" id="navbarDropdown" role="button" data-toggle="dropdown">
						<img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=FF7158&color=FFF" height="60" alt="" class="rounded-circle mr-2 ml-2 profile-picture">&nbsp; Hi, {{ Auth::user()->name }}
					</a>
					<div class="dropdown-menu">
						<a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
						<a href="{{ route('dashboard-profile') }}" class="dropdown-item">Setting</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}" 
						   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
					<li>
						<a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
						@php
							$carts = \App\Cart::where('users_id', Auth::user()->id_user)->count();
						@endphp
						@if ($carts > 0 )
							<img src="{{ asset('images/icon_cart_filled.svg') }}" alt="">
							<div class="card-badge">{{ $carts }}</div>
						@else
							<img src="{{ asset('images/icon_cart_empty.svg') }}" alt="">
						@endif
							
						</a>
					</li>
				</li>
			</ul>
			<!-- Mobile Version -->
			<ul class="navbar-nav navbar-store d-block d-lg-none">
				<li class="nav-item">
					<a href="{{ route('dashboard') }}" class="nav-link">Hi, {{ Auth::user()->name }}</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('cart') }}" class="nav-link d-inline-block">Cart</a>
				</li>
			</ul>
		@endauth
  </div>

</nav>