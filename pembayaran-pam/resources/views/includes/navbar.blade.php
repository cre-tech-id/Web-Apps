<!-- Navbar -->
<header class="bg-white {{Route::is(['about_us', 'transaction-history']) ? 'border-bottom' : ''}}">
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<a class="navbar-brand" href="{{route('home')}}">
			<!-- <img src="{{asset('assets/img/megamendung-logo.png')}}" width="120" height="63" class="d-inline-block align-top" alt="Mega Mendung Logo"> -->
			<h1>PAMSIMAS</h1>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item {{Route::is('home') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item {{Route::is('about_us') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('about_us')}}">Tentang Kami</a>
				</li>
				<li class="nav-item {{Route::is('about_us') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('profile')}}">Profile</a>
				</li>

				<!--<li class="nav-item {{Route::is('pemasangan_') ? 'active' : ''}}">
						<a class="nav-link" href="{{route('pemasangan_')}}">Pemasangan</a>
					</li>
					<li class="nav-item {{Route::is('pemutusan_') ? 'active' : ''}}">
						<a class="nav-link" href="{{route('pemutusan_')}}">Pemutusan</a>
					</li>
					<li class="nav-item {{Route::is('pelaporan_') ? 'active' : ''}}">
						<a class="nav-link" href="{{route('pelaporan_')}}">Pelaporan</a>
					</li>
					<li class="nav-item {{Route::is(['transaction-history', 'transaction-history.*']) ? 'active' : ''}}">
						<a class="nav-link" href="{{route('transaction-history')}}">Riwayat Transaksi</a>
					</li>-->
				@guest
				<li class="nav-item">
					<a href="{{route('register')}}" class="nav-link btn btn-primary-custom">Register</a>
				</li>
				<li class="nav-item">
					<a href="{{route('login')}}" class="nav-link">Login</a>
				</li>
				@endguest

				@auth
				@if(auth()->user()->isAdmin() || auth()->user()->isBank())
				<li class="nav-item">
					<a href="{{route('admin.dashboard')}}" class="nav-link">
						Dashboard
					</a>
				</li>
				@else
				<li class="nav-item">
					<a href="{{route('pembayaran')}}" class="nav-link">Pembayaran</a>
				</li>
				@endif
				
				<li class="nav-item my-2 my-md-0">
					<form action="{{route('logout')}}" method="post">
						@csrf
						<button class="nav-link btn btn-primary-custom">
							Logout
						</button>
					</form>
				</li>
				@endauth
			</ul>
		</div>
	</nav>
</header>
<!-- End of Navbar -->