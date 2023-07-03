			@extends('customer.main')
			@section('content')
			<style>
				.product-thumbnails img{
					object-fit: cover;
					object-position: center;
					width: 100%;
				}
			</style>
			<div class="cart-section pt-150 pb-100">
				<div class="container">
					<h2 class="text-center">Keranjang {{$type_product}}</h2>
					<div action="#" class="cart-list-form mt-50">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th colspan="2">Product Name</th>
										<th>Price</th>
										<th>QTY</th>
										<th>Product Type</th>
										<th>Total</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@php $total=0; @endphp
									@foreach($cart as $cart)
									<tr>
										<td class="product-thumbnails"><a href="#" class="product-img"><img src="{{url('image/product')}}/{{$cart->product_size->product->photo}}" alt=""></a></td>
										<td class="product-info">
											<a href="#" class="product-name">{{$cart->product_size->product->name}}</a>
											<div class="serial">#859632007881</div>
											<ul class="style-none">
												<li class="size">Size: {{$cart->product_size->size}}”</li>s
											</ul>
										</td>
										<td class="price"><span>Rp{{number_format($cart->final_price)}}</span></td>
										<td class="quantity">
											<ul class="order-box style-none">
												<!-- <li><div class="btn value-decrease">-</div></li> -->
												<li><input type="number" min="1" max="22" value="{{$cart->qty}}" disabled class="product-value val"></li>
												<!-- <li><div class="btn value-increase">+ </div></li> -->
											</ul>
										</td>
										<td class="price total-price"><span>{{$cart->type_product}}</span></td>
										<td class="price total-price"><span>{{number_format($cart->final_price*$cart->qty)}}</span></td>
										<td>
											<form action="{{url('cart')}}" method="POST">
												@method('delete')
												@csrf
												<input type="text" name="id" value="{{$cart->id}}" hidden>
												<button type="submit" class="remove-product">x</button>
											</form>
										</td>
									</tr>
									@php $total=$total+($cart->final_price*$cart->qty); @endphp
									@endforeach
								</tbody>
							</table>
						</div> <!-- /.table-responsive -->

						<div class="d-sm-flex justify-content-end cart-footer">
							<div class="cart-total-section d-flex flex-column sm-pt-40">
								<table class="cart-total-table">
									<tbody>
										<tr>
											<th>Grand Total</th>
											<td>Rp{{number_format($total)}}</td>
										</tr>
									</tbody>
								</table> <!-- /.cart-total-table -->
								<form action="{{url('cart/checkout')}}" method="POST">
									@csrf
									<input type="text" name="type_product" value="{{$type_product}}" hidden>
									<button class="theme-btn-seven checkout-process mt-30">Checkout</button>
								</form>
							</div>
						</div> <!-- /.cart-footer -->
					</div>
				</div> <!-- /.container -->
			</div>
			@include('customer.toast')
			@endsection