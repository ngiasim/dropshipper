<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<div class="container">
		<div class="row">
		<div class="page-header admin-header">
		<h3 id="page-title">
		@if(isset($edit_section))
		Update
		@else
		Add
		@endif
		Package</h3>
		</div>
		</div>
		<div class="row">
			<div class="col-md-6 admin-table-view">
				<div class="panel panel-default">
					<div class="panel-body">
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
						@if(isset($id))
							{!! Form::open(['method'=>'patch','url' => "packages/$id",'id'=>'form_section','files' => true]) !!}
						@else
							{!! Form::open(['url' => 'packages','id'=>'form_section','files' => true]) !!}
						@endif
							<div class="form-group row">
								{{ Form::label('Package Name:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('package_name', (isset($edit_section->package_name)?$edit_section->package_name:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('package_name')) <p class="help-block error">{{ $errors->first('package_name') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Package Code:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('package_code', (isset($edit_section->package_code)?$edit_section->package_code:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('package_code')) <p class="help-block error">{{ $errors->first('package_code') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Description:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('description', (isset($edit_section->description)?$edit_section->description:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('description')) <p class="help-block error">{{ $errors->first('description') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Minimum delivery days:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::number('min_delivery_days', (isset($edit_section->min_delivery_days)?$edit_section->min_delivery_days:0), array('step' => 'any', 'class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('min_delivery_days'))<p class="help-block error">{{ $errors->first('min_delivery_days') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Maximum delivery days:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::number('max_delivery_days', (isset($edit_section->max_delivery_days)?$edit_section->max_delivery_days:0), array('step' => 'any', 'class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('max_delivery_days'))<p class="help-block error">{{ $errors->first('max_delivery_days') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-offset-2 col-md-10 text-center">
									<button type="submit" class="btn btn-primary margin-right-10" name="sc">Submit</button>
									<a class="btn btn-link" href="{{ url('/packages') }}">Back to Listing</a>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>