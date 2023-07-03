@extends('customer.main')
@section('content')
<div class="checkout-section pt-130 pb-100 lg-pt-150 sm-pb-50">
	<div class="container">
		<form action="{{url('cart/order')}}" class="checkout-form" method="POST">
			@csrf
			<div class="row">
				<div class="col-xl-5 col-lg-6">
					<h2 class="main-title">Billing address</h2>
					<div class="user-profile-data">
						<div class="row">
							<div class="col-lg-12">
								<input type="email" placeholder="Email" class="single-input-wrapper" name="email" readonly value="{{$member->email}}" required>
							</div>
							<div class="col-lg-12">
								<input type="text" placeholder="Nama Penerima" name="name" class="single-input-wrapper" required>
							</div>
							@if($type_product=='Ready Stok')
							<div class="col-12">
								<input type="text" placeholder="Alamat" name="address" class="single-input-wrapper" required>
							</div>
							@endif
							<div class="col-12">
								<div class="other-note-area">
									<p>Order Note (Optional)</p>
									<textarea name="note"></textarea>
								</div>
							</div>
							<div class="col-12">
								<input type="text" name="telepon" placeholder="Telepon" class="single-input-wrapper" required>
							</div>
							<div class="col-12">
								<ul class="checkbox-list style-none pb-0">
									<li>
										<input type="checkbox" id="is_dropship">
										<label for="is_dropship">Kirim sebagai dropshipper?</label>
									</li>
								</ul>
							</div>
							<!-- <div class="col-12"> -->
								<div class="coba"></div>
								<!-- </div> -->
								@if($type_product=='Ready Stok')
								<div class="col-4">
									<select id="province" name="province" required>
										<option value="">Provinsi</option>
									</select>
								</div>
								<div class="col-4">
									<select id="city" name="city" required>
										<option value="">Kota</option>
									</select>
								</div>
								<div class="col-4">
									<select id="district" name="district" required>
										<option value="">Kecamatan</option>
									</select>
								</div>
								<div class="col-12">
									<select id="expedisi" name="expedisi" required>
										<option value="">Expedisi</option>
										@foreach($expedisi as $val)
										<option value="{{$val->rate_name}}">{{$val->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-12">
									<select id="paket" name="paket" required>
										<option value="">Paket</option>
									</select>
								</div>
								@endif
							</div> <!-- /.row -->
						</div> <!-- /.user-profile-data -->
					</div> <!-- /.col- -->

					<div class="col-xxl-5 col-lg-6 ms-auto">
						<div class="order-confirm-sheet md-mt-60">
							<h2 class="main-title">Shopping cart</h2>
							<div class="order-review pb-0">
								@php $berat=0; @endphp
								@php $sub_total=0; @endphp
								@foreach($cart as $product)
								<div class="row">
									<input type="text" name="cart_id[]" value="{{$product->id}}" hidden>
									<div class="col-12 fs-6">
										<span class="fs-6 fw-bold">{{$product->product_size->product->name}}, Size : {{$product->product_size->size}}</span>
									</div>
									<div class="col-12">
										<table class="w-100">
											<tr>
												<td>Price</td>
												<td>: Rp.{{number_format($product->final_price)}}</td>
											</tr>
											<tr>
												<td>Qty</td>
												<td>: {{$product->qty}}</td>
											</tr>
											<tr>
												<td>Subtotal</td>
												<td>: Rp.{{number_format($product->final_price*$product->qty)}}</td>
											</tr>
										</table>
										<hr>
									</div>
								</div>
								@php $berat=$berat+$product->product_size->product->berat @endphp
								@php $sub_total=$sub_total+$product->final_price*$product->qty @endphp
								@endforeach
								<input type="text" name="berat" value="{{$berat}}" hidden>
								<input type="text" name="type_product" value="{{$type_product}}" hidden>
							</div>
						</div>
						<div class="order-confirm-sheet">
							<div class="order-review pt-0">
								<table class="product-review">
									<tbody>
										<tr>
											<th>
												<span>Sub Total</span>
											</th>
											<td>
												Rp<span>{{number_format($sub_total)}}</span>
												<div id="subtotal" style="visibility: hidden;">{{$sub_total}}</div>
											</td>
										</tr>
										@if($type_product=='Ready Stok')
										<tr>
											<th>
												<span>Shipping Cost</span>
											</th>

											<td>Rp<span id="shipping_cost">0</span></td>
										</tr>
										@endif
									</tbody>

									<tfoot>
										@if($type_product=='Ready Stok')
										<tr>
											<th><span>Total</span></th>
											<td>Rp<span id="total">0</span></td>
										</tr>
										@else
										<tr>
											<th><span>Total</span></th>
											<td>Rp<span>{{number_format($sub_total)}}</span></td>
										</tr>
										@endif
									</tfoot>
								</table>
								<button class="theme-btn-seven w-100 mt-30" type="submit">Checkout</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	@endsection