@extends('customer.main')
@section('content')
@include('customer.slider')
<style>
	.pencarian input:focus{
		box-shadow: none;
	}

	.pencarian button{
		font-weight: bold;
		padding-left: 20px;
		padding-right: 20px;
	}
</style>
<div class="product-section-four mt-150 lg-mt-90">
	<div class="container">
		<div class="products-wrapper mt-60 lg-mt-40">
			<div class="row d-flex justify-content-end mb-20">
				<div class="col-md-6 col-12">
					<form action="" method="GET">
						<div class="input-group pencarian">
							<input type="text" placeholder="Cari produk" class="form-control" name="keyword" value="{{$keyword}}">
							<button class="btn btn-secondary">Cari</button>
						</form>
						<form action="" method="GET">
							<input type="text" placeholder="Cari produk" class="form-control ml-3" name="keyword" value="" hidden>
							<button class="btn btn-danger">Reset</button>
						</form>
					</div>
				</div>
			</div>
			<div class="row gx-xl-5">
				@foreach($product as $product)
				<div class="col-xl-4 col-md-6" data-aos="fade-up">
					<div class="product-block-two mb-60 xs-mb-40">
						<div class="img-holder">
							<a href="{{url('product')}}/{{$product->id}}" class="d-flex align-items-center justify-content-center">
								<img src="{{url('image/product')}}/{{$product->photo}}" alt="" class="product-img  tran4s">
							</a>
							<div class="tag-one">SALE</div>
						</div>
						<div class="product-meta">
							<div class="d-lg-flex align-items-center justify-content-between">
								<a href="{{url('product')}}/{{$product->id}}" class="product-title">{{$product->name}}</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="page-pagination-one pt-45 lg-pt-30">
				<ul class="d-flex align-items-center justify-content-center style-none">
					@if ($pagination['currentPage'] != 1)
					<li><a href="{{ $pagination['previousPageUrl'] }}&keyword={{$keyword}}"><i class="bi bi-arrow-left"></i></a></li>
					@endif

					@foreach ($pageUrls as $i => $url)
					@if ($i == $pagination['currentPage'])
					<li class="active"><a href="#">{{ $i }}</a></li>
					@else
					<li><a href="{{ $url }}&keyword={{$keyword}}">{{ $i }}</a></li>
					@endif
					@endforeach

					@if ($pagination['currentPage'] != $pagination['lastPage'])
					<li><a href="{{ $pagination['nextPageUrl'] }}&keyword={{$keyword}}"><i class="bi bi-arrow-right"></i></a></li>
					@endif
				</ul>
			</div>


		</div>
	</div>
</div>
@endsection