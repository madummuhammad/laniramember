			@extends('customer.main')
			@section('content')
			<div class="product-details-one mt-180">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 order-lg-2">
							<div class="tab-content product-img-tab-content h-100">
								<div class="tab-pane fade show active h-100" id="img1" role="tabpanel" >
									<a class="fancybox w-100 d-flex" data-fancybox="" href="{{url('image/product')}}/{{$product->photo}}" tabindex="-1">
										<img src="{{url('image/product')}}/{{$product->photo}}" alt="" class="m-auto">
									</a>
								</div>
							</div>
						</div>
						<div class="col-lg-1 order-lg-1">
							<ul class="nav nav-tabs flex-lg-column product-img-tab" id="myTab" role="tablist">
								<li class="nav-item">
									<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#img1" type="button" role="tab"  aria-selected="true"><img src="{{url('image/product')}}/{{$product->photo}}" alt="" class="m-auto"></button>
								</li>
							</ul>
						</div>
						<div class="col-lg-6 order-lg-3">
							<form action="{{url('cart')}}" method="POST">
								@csrf
								<input type="text" value="{{$product->id}}" name="product_id" hidden>
								<div class="product-info ps-xxl-5 md-mt-50">
									<div class="stock-tag">{{$product->type_product}}</div>
									<h3 class="product-name">{{$product->name}}</h3>
									<p class="description-text">
										<?php echo $product->deskripsi ?>
									</p>
									<div class="customize-order">
										<div class="row">
											<div class="col-xxl-11">											
												<div class="row">
													<div class="col-lg-3 col-md-3 col-sm-4">
														<div class="quantity mt-25">
															<h6>Quantity</h6>
															<div class="button-group">
																<ul class="style-none d-flex align-items-center">
																	<li>
																		<button type="button" class="value-decrease value-press">-</button>
																	</li>
																	<li>
																		<input type="number" name="qty" required min="1" readonly value="1" class="product-value val qty">
																	</li>
																	<li>
																		<button type="button" class="value-increase value-press">+ </button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="col-xl-3 col-md-6 col-sm-4">
														<div class="size-selection mt-25">
															<h6>Size</h6>
															<ul class="style-none d-flex align-items-center size-custome-input">
																@foreach($product->product_size as $value)
																<li>
																	<input type="radio" required name="size" data-price="{{$value->price}}" value="{{$value->id}}" class="size-check-btn size_product">
																	<label>{{$value->size}}</label>
																</li>
																@endforeach
															</ul>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12 col-md-21 col-sm-4">
														<div class="quantity mt-25">
															<h6>Price (Rp)</h6>
															<div class="button-group w-50">
																<ul class="style-none d-flex align-items-center">
																	<li class="w-100">
																		<p id="price" class="text-center w-100">0</p>
																		<input hidden type="number" style="width: 100%;" name="price" required min="1" value="" readonly class="product-value val price w-100 bg-danger ">
																	</li>
																</ul>
															</div>
														</div>
														<p class="text-danger mt-5 w-100">Diskon Produk {{$product->diskon_produk}}%</p>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- /.customize-order -->
<!-- 									<div class="alert alert-danger mt-5" role="alert">
										A simple danger alert—check it out!
									</div> -->
									<div class="button-group d-sm-flex align-items-center">
										<button type="submit" id="add-to-cart" class="theme-btn-seven mt-0 me-sm-4 d-block">Add To Cart</button>
									</div>
								</div> <!-- /.product-info -->
							</form>
						</div>
					</div>
				</div>
			</div>
			@if(session('success'))
			<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
				<div id="success" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header bg-success">
						<strong class="me-auto text-white">Success</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">
						{{session('success')}}
					</div>
				</div>
			</div>
			@endif
			@if(session('error'))
			<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
				<div id="error" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header bg-danger">
						<strong class="me-auto text-white">Error</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">
						{{session('error')}}
					</div>
				</div>
			</div>
			@endif
			@if(session('success'))
			<script>
				document.addEventListener('DOMContentLoaded', function () {
					var toastElement = document.getElementById('success');
					var toast = new bootstrap.Toast(toastElement);
					toast.show();
				});
			</script>
			@endif
			@if(session('error'))
			<script>
				document.addEventListener('DOMContentLoaded', function () {
					var toastElement = document.getElementById('error');
					var toast = new bootstrap.Toast(toastElement);
					toast.show();
				});
			</script>
			@endif
			@endsection