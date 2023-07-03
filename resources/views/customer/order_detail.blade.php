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
			<div class="cart-section pt-150 pb-100">
				<div class="container">
					<div action="#" class="mt-10">
						<div class="card shadow p-5">
							<div class="row">
								@if($order->order_type=='Ready Stok')
								<div class="col-md-4">
									@else
									<div class="col-md-6">
										@endif
										<strong>Pembelian</strong><br>
										<table class="header">
											<tr>
												<td>No Pembelian</td>
												<td>: #{{$order->id}}</td>
											</tr>
											<tr>
												<td>Tanggal</td>
												<td>: {{$order->order_time}}</td>
											</tr>
										</table>
									</div>

									@if($order->order_type=='Ready Stok')
									<div class="col-md-4">
										@else
										<div class="col-md-6">
											@endif
											<strong>Pelanggan</strong><br>
											<table class="header">
												<tr>
													<td>Nama Penerima</td>
													<td>
														:{{$order->nama_penerima}}
													</td>
												</tr>
												<tr>
													<td>No Telp</td>
													<td>:{{$order->order_tel}}</td>
												</tr>
												<tr>
													<td>Email</td>
													<td>:{{$order->order_email}}</td>
												</tr>
											</table>
										</div>
										@if($order->order_type=='Ready Stok')
										<div class="col-md-4">
											<strong>Pengiriman </strong><br>
											<table class="header">
												<tr>
													<td>Alamat</td>
													<td>:{{$order->address}},{{$order->distrik}}.{{$order->provinsi}}</td>
												</tr>
											</table>
										</div>
										@endif
									</div>
									<div class="row mt-10">
										<table class="table">
											<thead>
												<tr>
													<th>No</th>
													<th>Produk</th>
													<th>Size</th>
													<th>QTY</th>
													<th>Harga</th>
												</tr>
											</thead>
											<tbody>
												@php $no=1; @endphp
												@foreach($order->order_item as $value)
												<tr>
													<td>{{$no++}}</td>
													<td>{{$value->product->name}}</td>
													<td>{{$value->product_size->size}}</td>
													<td>{{$value->qty}}</td>
													<td>Rp{{number_format($value->price*$value->qty)}}</td>
												</tr>
												@endforeach
												@if($order->order_type=='Ready Stok')
												<tr>
													<th colspan="3">Jasa Kirim</th>
													<th>{{$order->ekspedisi}} - {{$order->paket}} ({{$order->estimasi}})</th>
													<td>Rp{{number_format($order->ongkir)}}</td>
												</tr>
												@endif
												<tr>
													<th colspan="4">Total</th>
													<td>Rp{{number_format($order->total+$order->ongkir)}}</td>
												</tr>
											</tbody>
										</table>
										<p>Catatan: {{$order->catatan}}</p>
									</div>
									<div class="row mt-10">
										<h3 class="text-center">Pembayaran</h3>
										<table class="table">
											<thead>
												<tr>
													<th>Bank</th>
													<th>Deposit</th>
													<th>Bukti</th>
												</tr>
											</thead>
											<tbody>
												@php $total=0; @endphp
												@foreach($order->payment_confirm as $payment)
												<tr>
													<td>{{$payment->bank}}</td>
													<td>Rp{{number_format($payment->deposit)}}</td>
													<td class="product-thumbnails">
														<a target="_blank" href="{{url('image/bukti/')}}/{{$payment->bukti}}">
															attachment	
														</a>
													</td>
												</tr>
												<?php $total=$total+$payment->deposit ?>
												@endforeach
												<tr>
													<th colspan="2">Total</th>
													<th>Rp{{number_format($total)}}</th>
												</tr>
												<tr>
													<th colspan="2" class="text-danger fw-bold">Sisa</th>
													<td>Rp{{number_format($order->total+$order->ongkir-$total)}}</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="d-flex justify-content-center">
										<div class="row d-flex justify-content-center">
											<div class="col-12">			
												<div class="bg-info w-100 py-4 px-3 rounded">
													<h4>Silahkan lakukan pembayaran Rp{{number_format($order->total+$order->ongkir-$total)}},- ke</h4>
													<h4>BCA : 1234xxxx A/N : nama pemilik</h4>
													<a href="{{url('order/confirm/')}}/{{$order->id}}" class="btn btn-success">Konfirmasi Pembayaran</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- /.container -->
					</div>
					@include('customer.toast')
					@endsection