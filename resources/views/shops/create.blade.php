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
		Shop</h3>
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
							{!! Form::open(['method'=>'patch','url' => "shops/$id",'id'=>'form_section','files' => true]) !!}

							{{ Form::hidden('id', $id) }}
						@else
							{!! Form::open(['url' => 'shops','id'=>'form_section','files' => true]) !!}
						@endif
							<div class="form-group row">
								{{ Form::label('Shop Name:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('shop_name', (isset($edit_section->shop_name)?$edit_section->shop_name:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('shop_name')) <p class="help-block error">{{ $errors->first('shop_name') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Platform:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::select('platform', ['shopify'=>'Shopify','wordpress'=>'Wordpress','magento'=>'Magento'],0, ['class' => 'form-control']) }}
								</div>
								@if ($errors->has('platform')) <p class="help-block error">{{ $errors->first('platform') }}</p> @endif
							</div>
							<div class="form-group row">
								{{ Form::label('Api Key:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('api_key', (isset($edit_section->api_key)?$edit_section->api_key:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('api_key')) <p class="help-block error">{{ $errors->first('api_key') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Secret Key:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('secret_key', (isset($edit_section->secret_key)?$edit_section->secret_key:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('secret_key')) <p class="help-block error">{{ $errors->first('secret_key') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label('Shared Key:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('shared_key', (isset($edit_section->shared_key)?$edit_section->shared_key:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('shared_key')) <p class="help-block error">{{ $errors->first('shared_key') }}</p> @endif
								</div>
							</div>

							
							<div class="form-group row">
								{{ Form::label('Site Address:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg']) }}
								<div class="col-xs-12 col-md-8">
									{{ Form::text('site_address', (isset($edit_section->site_address)?$edit_section->site_address:null), array('class' => 'form-control form-control-lg' )) }}
									@if ($errors->has('site_address')) <p class="help-block error">{{ $errors->first('site_address') }}</p> @endif
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-offset-2 col-md-10 text-center">
									<button type="submit" class="btn btn-primary margin-right-10" name="sc">Submit</button>
									<a class="btn btn-link" href="{{ url('/shops') }}">Back to Listing</a>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>