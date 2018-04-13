<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container">
		<div class="row">
			<div class="page-header admin-header">
				<h3 id="page-title">All Orders</h3>      
			</div>
		</div>
		<div class='row'>
			@if(session()->has('success'))
				<div class="alert alert-success">
					<strong>Success - </strong> {{ session()->get('success') }}
				</div>
			@endif
			@if(session()->has('error'))
				<div class="alert alert-danger">
					<strong>Alert - </strong> {{ session()->get('error') }}
				</div>
			@endif
		</div>
		<div class="row">
			<div class="col-md-12 admin-table-view">
				<table class="table table-bordered" id="table_data">
					<thead>
						<tr>
						<th>Order Number</th>
						<th>Email</th>
						<th>Total Price</th>
						<th>Order ID</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $row)
							<tr>
								<td>
									@if($row['tracking_number'] == "")
										{{$row['order_number']}}
									@else
										<a target="_blank" href="{{ url('track/'.$row['tracking_number']) }}">{{$row['order_number']}}</a>
									@endif
									
								</td>
								<td>{{$row['email']}}</td>
								<td>{{$row['total_price']}}</td>
								<td>{{$row['order_id']}}</td>
								<td>
									@if($row['shipment_status'] == 'delivered')
										<h4><span class="label label-success">Delivered</span></h4>
									@else
										<span class="table-action-icons">
											<form action="{{url('orders/accept')}}" method="post">
												{!! csrf_field() !!}
												<div class="form-group">
												    <input type="hidden" name="order_id" value="{{$row['id']}}" />
												</div>
												<select name="status">
													<option value="">Select Status</option>
													<option value="confirmed"
														@if($row['shipment_status'] == 'confirmed')
															selected
														@endif
													>Shipment Created</option>
													<option value="in_transit"
														@if($row['shipment_status'] == 'in_transit')
															selected
														@endif
													>In Transit</option>
													<option value="out_for_delivery"
														@if($row['shipment_status'] == 'out_for_delivery')
															selected
														@endif
													>Out for delivery</option>
													<option value="delivered">Delivered</option>
												</select>
												<button>Update</button>
											</form>
										</span>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>