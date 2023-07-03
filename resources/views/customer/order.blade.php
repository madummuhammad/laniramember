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
					<h2 class="text-center">Pesanan</h2>
					<div action="#" class="cart-list-form mt-50">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Order ID</th>
										<th>Tanggal</th>
										<th>Alamat</th>
										<th>Konfirmasi</th>
										<th>No Resi</th>
										<th>Total</th>
										<th>Detail</th>
									</tr>
								</thead>
								<tbody>
									@php $no=1 @endphp
									@foreach($order as $value)
									<tr>
										<td>{{$no++}}</td>
										<td>
											#{{$value->id}}
										</td>
										<td>{{$value->order_time}}</td>
										<td>
											@if($value->order_type=='Ready Stok')
											{{$value->address}}, {{$value->distrik}}, {{$value->provinsi}}
											@else
											<div class="fw-bold">
												
												Pre Order
											</div>
											@endif
										</td>
										<td>{{$value->confirm_payment}}</td>
										<td>{{$value->resi}}</td>
										<td>Rp{{number_format($value->total)}}</td>
										<td>
											<div class="d-flex justify-content-end">
												<a href="{{url('order')}}/{{$value->id}}" class="btn btn-primary btn-sm me-2" >Nota</a>
												<a href="{{url('order/confirm')}}/{{$value->id}}" class="btn btn-success btn-sm">Konfirmasi</a>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div> <!-- /.table-responsive -->
					</div>
				</div> <!-- /.container -->
			</div>
			@include('customer.toast')

			@endsection