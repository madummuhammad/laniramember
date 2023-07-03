@extends('customer.main')
@section('content')
@include('customer.slider')
<div class="product-section-one mt-50 lg-mt-100">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-md-6 col-sm-8">
				<div class="title-style-six text-center text-sm-start xs-pb-20">
					<h2 class="title">LIST BRAND</h2>
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

	<div class="box-layout mt-50 lg-mt-40">
		<div class="product_slider_one product_slider_space" id="product_slider_one">
			@foreach($brand as $brand)
			<div class="item">
				<div class="product-block-one">
					<a href="{{url('brand/')}}/{{$type_product}}/{{$brand->id}}" class="d-flex align-items-center justify-content-center h-100"><img src="{{url('image/brand')}}/{{$brand->img}}" alt="" class="product-img tran4s">
					</a>
					<a href="{{url('brand/')}}/{{$type_product}}/{{$brand->id}}" class="category-tag">{{$brand->name}}</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection