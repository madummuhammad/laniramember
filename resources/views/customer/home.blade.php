@extends('customer.main')
@section('content')
@include('customer.slider')
<div class="product-section-one mt-180 lg-mt-100">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-md-6 col-sm-8">
				<div class="title-style-six text-center text-sm-start xs-pb-20">
					<h2 class="title">Ready Stok</h2>
				</div>
			</div>
			<div class="col-lg-5 col-md-6 col-sm-4 d-flex justify-content-center justify-content-sm-end">
				<ul class="slider-arrows product-slider-arrow-one d-flex style-none">
					<li class="prev_p1 slick-arrow ripple-btn" style=""><i class="bi bi-arrow-left"></i></li>
					<li class="next_p1 slick-arrow ripple-btn" style=""><i class="bi bi-arrow-right"></i></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="box-layout mt-90 lg-mt-40">
		<div class="product_slider_one product_slider_space" id="product_slider_one">
			@foreach($ready_stock as $product)
			<div class="item">
				<div class="product-block-one">
					<!-- <a href="{{url('product')}}/{{$product->id}}" class="d-flex align-items-center justify-content-center h-100"><img src="https://admin.laniragroup.com/fotoproduk/{{$product->photo}}" alt="" class="product-img tran4s">
					</a>
				-->
				<a href="{{url('product')}}/{{$product->id}}" class="d-flex align-items-center justify-content-center h-100"><img src="http://localhost:8001/image/product/{{$product->photo}}" alt="" class="product-img tran4s">
				</a>

				<a href="{{url('product')}}/{{$product->id}}" class="category-tag">{{$product->name}}</a>
			</div>
		</div>
		@endforeach
	</div>
</div>
</div>

<div class="product-section-one mt-180 lg-mt-100">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-md-6 col-sm-8">
				<div class="title-style-six text-center text-sm-start xs-pb-20">
					<h2 class="title">Pre Order</h2>
				</div>
			</div>
			<div class="col-lg-5 col-md-6 col-sm-4 d-flex justify-content-center justify-content-sm-end">
				<ul class="slider-arrows product-slider-arrow-one d-flex style-none">
					<li class="prev_pc1 slick-arrow ripple-btn" style=""><i class="bi bi-arrow-left"></i></li>
					<li class="next_pc1 slick-arrow ripple-btn" style=""><i class="bi bi-arrow-right"></i></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="box-layout mt-90 lg-mt-40">
		<div class="product_slider_one product_slider_space" id="product_slider_custom_1">
			@foreach($po as $product)
			<div class="item">
				<div class="product-block-one">
					<a href="{{url('product')}}/{{$product->id}}" class="d-flex align-items-center justify-content-center h-100"><img src="https://admin.laniragroup.com/fotoproduk/{{$product->photo}}" alt="" class="product-img tran4s"></a>
					<a href="{{url('product')}}/{{$product->id}}" class="category-tag">{{$product->name}}</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div class="shop-new-collection-section mt-180 lg-mt-100">
	<div class="box-layout">
		<div class="row gx-xl-5">
			<div class="col-md-6" data-aos="fade-right">
				<div class="banner-text-meta" style="background:#FFFBE6;">
					<!-- <img src="{{url('assets')}}/images/shop/img_07.png" alt="" class="promo-img"> -->
					<!-- <div class="fancy-text">35% Off</div> -->
					<h3>Ready Stok</h3>
					<a href="{{url('brand/ready_stock')}}" class="theme-btn-eight ripple-btn">Lihat Semua</a>
				</div>
			</div>
			<div class="col-md-6" data-aos="fade-left">
				<div class="banner-text-meta sm-mt-20" style="background:#EFFAFF;">
					<!-- <img src="{{url('assets')}}/images/shop/img_08.png" alt="" class="promo-img"> -->
					<!-- <div class="fancy-text">Vacations Offer</div> -->
					<h3>Pre Order</h3>
					<a href="{{url('brand/po')}}" class="theme-btn-eight ripple-btn">Lihat Semua</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection