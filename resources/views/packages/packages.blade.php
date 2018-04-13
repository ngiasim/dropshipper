<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container">
		<div class="row">
			<div class="page-header admin-header">
				<h3 id="page-title">Shipment Packages
					<small class="pull-right">
						<a href="{{ url('packages/create') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add New</a>
			        </small>
				</h3>      
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
							<th>#</th>
							<th>Package Name</th>
							<th>Code</th>
							<th>Min Delivery Days</th>
							<th>Max Delivery Days</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if(count($packages) == 0)
							<tr>
								<td colspan="4">No packages found.</td>
							</tr>
						@endif
						@foreach($packages as $row)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$row['package_name']}}</td>
								<td>{{$row['package_code']}}</td>
								<td>{{$row['min_delivery_days']}}</td>
								<td>{{$row['max_delivery_days']}}</td>
								<td>
									<span class="table-action-icons">
										<a title="Edit" href="{{ route('packages.edit',$row['id']) }}">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
										&nbsp;
										{!! Form::open(['method' => 'DELETE','route' => ['packages.destroy', $row['id']],'style'=>'display:inline']) !!}
							            	<button type="submit">
											    <i class="glyphicon glyphicon-trash"></i> 
											</button>
							            {!! Form::close() !!}
									</span>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>