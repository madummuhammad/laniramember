<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta property="og:site_name" content="vCamp">
	<meta property="og:type" content="website">
	<meta name='og:image' content='images/assets/ogg.png'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#202020">
	<meta name="msapplication-navbutton-color" content="#202020">
	<meta name="apple-mobile-web-app-status-bar-style" content="#202020">
	<title>Lanira</title>
	<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/responsive.css" media="all">
	<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/custom.css" media="all">
</head>
<?php
use App\Models\FooterContent;
$seg_1=request()->segment(1);
$seg_2=request()->segment(2);
$footer=FooterContent::first();
?>
<body>
	<div class="main-page-wrapper">
		<section>
			<div id="preloader">
				<div id="ctn-preloader" class="ctn-preloader">
					<div class="animation-preloader">
						<div class="icon">
							<!-- <img src="{{url('assets')}}/images/logo/vCamp.svg" alt="" class="m-auto d-block">  -->
							<span></span>
						</div>
						<div class="txt-loading mt-4">
							<span data-text-preloader="L" class="letters-loading">
								L
							</span>
							<span data-text-preloader="A" class="letters-loading">
								A
							</span>
							<span data-text-preloader="N" class="letters-loading">
								N
							</span>
							<span data-text-preloader="I" class="letters-loading">
								I
							</span>
							<span data-text-preloader="R" class="letters-loading">
								R
							</span>
							<span data-text-preloader="A" class="letters-loading">
								A
							</span>
						</div>
					</div>	
				</div>
			</div>
		</section>
		<header class="theme-main-menu sticky-menu theme-menu-one">
			<div class="inner-content">
				<div class="d-flex align-items-center justify-content-end">
					<!-- <div class="logo logo-xl"><a href="index.html">
						<img src="{{url('assets')}}/images/logo/vCamp_09.svg" alt="">
					</a>
				</div> -->
				<nav class="navbar navbar-expand-lg">
					<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
							<li class="d-block d-lg-none">
								<div class="logo">
									<a href="{{url('/')}}">
										DND
									</a>
								</div>
							</li>
							<li class="nav-item @if($seg_1=='') active @endif dropdown mega-dropdown pe-5">
								<a class="nav-link" href="{{url('/')}}" role="button" aria-expanded="false">Home</a>
							</li>
							@if(Auth::check())
							<li class="nav-item dropdown mega-dropdown d-md-none d-block">
								<a class="nav-link" href="{{url('cart/po')}}">PO</a>
							</li>
							<li class="nav-item dropdown mega-dropdown d-md-none d-block">
								<a class="nav-link" href="{{url('cart/ready_stock')}}">Ready Stok</a>
							</li>
							<li class="nav-item dropdown mega-dropdown d-md-none d-block">
								<a class="nav-link" href="{{url('order')}}">Pesanan</a>
							</li>
							@endif
							<li class="nav-item dropdown mega-dropdown d-md-none d-block">
								@if(Auth::check())
								<form action="{{url('logout')}}" method="POST">
									@csrf
									<button type="submit" class="d-flex align-items-center login-btn">
										<span class="me-2">Logout</span>
										<img src="{{url('assets')}}/images/icon/icon_01.svg" alt="">
									</button>
								</form>
								@else
								<a href="{{url('login')}}" class="d-flex align-items-center login-btn">
									<img src="{{url('assets')}}/images/icon/icon_01.svg" alt="">
									<span class="header @if($seg_1=='login') active @endif">login</span>
								</a>
								@endif
							</li>
						</ul>
					</div>
				</nav>
				<div class="right-widget d-flex align-items-center">
					@if(Auth::check())
					<div class="d-none d-sm-block">
						<a href="{{url('cart/po')}}" class="d-flex align-items-center login-btn">
							<img src="{{url('assets')}}/images/icon/icon_71.svg" alt="" class="m-auto">
							<span class="header @if($seg_1=='cart' AND $seg_2=='po') active @endif">PO</span>
						</a>
					</div>
					<div class="d-none d-sm-block">
						<a href="{{url('cart/ready_stock')}}" class="d-flex align-items-center login-btn">
							<img src="{{url('assets')}}/images/icon/icon_71.svg" alt="" class="m-auto">
							<span class="header  @if($seg_1=='cart' AND $seg_2=='ready_stock') active @endif">Ready Stok</span>
						</a>
					</div>
					<div class="d-none d-sm-block">
						<a href="{{url('order')}}" class="d-flex align-items-center login-btn">
							<span class="header @if($seg_1=='order') active @endif">Pesanan</span>
						</a>
					</div>
					@endif
					<div class="d-none d-sm-block">
						@if(Auth::check())
						<form action="{{url('logout')}}" method="POST">
							@csrf
							<button type="submit" class="d-flex align-items-center login-btn">
								<img src="{{url('assets')}}/images/icon/icon_01.svg" alt="">
								<span>Logout</span>
							</button>
						</form>
						@else
						<a href="{{url('login')}}" class="d-flex align-items-center login-btn">
							<img src="{{url('assets')}}/images/icon/icon_01.svg" alt="">
							<span class="header @if($seg_1=='login') active @endif">login</span>
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</header>
	@yield('content')
	<footer class="vcamp-footer-two pt-130 lg-pt-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<h5 class="title">ABOUT DND</h5>
					<div class="divider mb-20"></div>
					<p>{{$footer->about}}</p>

				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<h5 class="title">INFORMATION</h5>
					<div class="divider mb-20"></div>
					<p class="mb-0">Admin lanira 1 fildzah <span class="fw-bold">0857-3144-0209</span></p>
					<p class="mb-0">Admin lanira 2 zahro <span class="fw-bold">0856-4651-8427</span></p>
					<p class="mb-0">Admin lanira 3 lidya <span class="fw-bold">0856-4651-8467</span></p>
					<p class="mb-0">Admin D&D  <span class="fw-bold">0857-9195-9993</span></p>
					<p class="mb-0">Admin Divana <span class="fw-bold">0857-7343-6376</span></p>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<h5 class="title">Contact Us</h5>
					<div class="divider mb-20"></div>
					<p class="mb-0"><i class="fas fa-map-marker-alt me-3"></i>{{$footer->contact}}</p>
					<p class="mb-0"><i class="fas fa-envelope me-3"></i>Email: {{$footer->email}}</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="bottom-footer">
				<div class="row">
					<div class="col-lg-12 order-lg-12 mb-15">
						<p class="copyright text-center">Copyright @<?php echo date('Y') ?> DND.</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<button class="scroll-top">
		<i class="bi bi-arrow-up-short"></i>
	</button>
	<script src="{{url('assets')}}/vendor/jquery.min.js"></script>
	<script src="{{url('assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="{{url('assets')}}/vendor/aos-next/dist/aos.js"></script>
	<script src="{{url('assets')}}/vendor/slick/slick.min.js"></script>
	<script src="{{url('assets')}}/vendor/jquery.counterup.min.js"></script>
	<script src="{{url('assets')}}/vendor/jquery.waypoints.min.js"></script>
	<script src="{{url('assets')}}/vendor/fancybox/dist/jquery.fancybox.min.js"></script>
	<script src="{{url('assets')}}/vendor/validator.js"></script>
	<script src="{{url('assets')}}/vendor/selectize.js/selectize.min.js"></script>

	<!-- Theme js -->
	<script src="{{url('assets')}}/js/custom.js"></script>
	<script src="{{url('assets')}}/js/theme.js"></script>
</div>
</body>
</html>