@extends('layouts.app')

@section('content')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container">
		<div class="row">
			<div class="page-header admin-header">
				<h3 id="page-title">Shops
					<small class="pull-right">
						<a href="{{ url('shops/create') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add New</a>
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
							<th>Shop Name</th>
							<th>Platform</th>
							<th>Api Key</th>
							<th>Secret Key</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if(count($shops) == 0)
							<tr>
								<td colspan="6">No shops found.</td>
							</tr>
						@endif
						@foreach($shops as $row)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$row['shop_name']}}</td>
								<td>{{$row['platform']}}</td>
								<td>{{$row['api_key']}}</td>
								<td>{{$row['secret_key']}}</td>
								<td>
									<span class="table-action-icons">
										<a title="Edit" href="{{ route('shops.edit',$row['shop_id']) }}">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
										&nbsp;
										{!! Form::open(['method' => 'DELETE','route' => ['shops.destroy', $row['shop_id']],'style'=>'display:inline']) !!}
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

@endsection