			@extends('customer.main')
			@section('content')
			<style>
				.product-thumbnails img{
					object-fit: cover;
					object-position: center;
					width: 100%;
				}

				.header tr td{
					vertical-align: top;
				}
			</style>
			<?php 
			if($order->order_type=='PO'){
				$minimum_depo=$order->total*30/100;
			}
			?>
			<div class="cart-section pt-150 pb-100">
				<div class="container">
					<div class="row">
						<form action="{{url('order/confirm/')}}/{{$id}}" enctype="multipart/form-data" method="POST">
							@csrf							
							<div class="col-8 mb-2">
								<label for="">Nama pengirim</label>
								<input type="text" name="name" class="form-control">
								<input type="text" name="order_id" class="form-control" value="{{$id}}" hidden>
							</div>
							<div class="col-8 mb-2">
								<label for="">Bank</label>
								<input type="text" name="bank" class="form-control">
							</div>
							<div class="col-8 mb-2">
								<label for="">Deposit <span class="fw-bold text-danger">*Item pre order</span></label>
								@if($order->order_type=='PO')
								@if($sisa_pembayaran==$order->total)
								<input type="text" name="deposit" value="{{$minimum_depo}}" class="form-control">
								@else
								<input type="text" name="deposit" value="{{$sisa_pembayaran}}" class="form-control" readonly>
								@endif
								<p class="text-danger fw-bold fs-12px">Minimum Deposit Rp{{number_format($minimum_depo)}}</p>
								@else
								<input type="text" name="deposit" value="{{$order->total+$order->ongkir}}" class="form-control" readonly>
								@endif
							</div>
							<div class="col-8 mb-2">
								<label for="">Jumlah</label>
								<input type="text" name="jumlah"  value="{{$order->total+$order->ongkir}}" class="form-control" readonly>
							</div>
							<div class="col-8 mb-2">
								<label for="">Sisa Pembayaran</label>
								<input type="text" name="sisa"  value="{{$sisa_pembayaran}}" class="form-control" readonly>
							</div>
							<div class="col-8 mb-2">
								<label for="">Foto Bukti</label>
								<input type="file" name="bukti" class="form-control">
								<p class="text-danger fs-14px">Foto bukti maksimal 2mb</p>
							</div>
							<div class="col-8 mb-2">
								<button class="btn btn-primary">Kirim</button>
							</div>
						</form>
					</div>
				</div> <!-- /.container -->
			</div>
			@include('customer.toast');
			@endsection