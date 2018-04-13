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
		<?php if(isset($edit_section)): ?>
		Update
		<?php else: ?>
		Add
		<?php endif; ?>
		Package</h3>
		</div>
		</div>
		<div class="row">
			<div class="col-md-6 admin-table-view">
				<div class="panel panel-default">
					<div class="panel-body">
						<?php if(session()->has('success')): ?>
							<div class="alert alert-success">
								<strong>Success - </strong> <?php echo e(session()->get('success')); ?>

							</div>
						<?php endif; ?>
						<?php if(session()->has('error')): ?>
							<div class="alert alert-danger">
								<strong>Alert - </strong> <?php echo e(session()->get('error')); ?>

							</div>
						<?php endif; ?>
						<?php if(isset($id)): ?>
							<?php echo Form::open(['method'=>'patch','url' => "packages/$id",'id'=>'form_section','files' => true]); ?>

						<?php else: ?>
							<?php echo Form::open(['url' => 'packages','id'=>'form_section','files' => true]); ?>

						<?php endif; ?>
							<div class="form-group row">
								<?php echo e(Form::label('Package Name:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg'])); ?>

								<div class="col-xs-12 col-md-8">
									<?php echo e(Form::text('package_name', (isset($edit_section->package_name)?$edit_section->package_name:null), array('class' => 'form-control form-control-lg' ))); ?>

									<?php if($errors->has('package_name')): ?> <p class="help-block error"><?php echo e($errors->first('package_name')); ?></p> <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label('Package Code:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg'])); ?>

								<div class="col-xs-12 col-md-8">
									<?php echo e(Form::text('package_code', (isset($edit_section->package_code)?$edit_section->package_code:null), array('class' => 'form-control form-control-lg' ))); ?>

									<?php if($errors->has('package_code')): ?> <p class="help-block error"><?php echo e($errors->first('package_code')); ?></p> <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label('Description:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg'])); ?>

								<div class="col-xs-12 col-md-8">
									<?php echo e(Form::text('description', (isset($edit_section->description)?$edit_section->description:null), array('class' => 'form-control form-control-lg' ))); ?>

									<?php if($errors->has('description')): ?> <p class="help-block error"><?php echo e($errors->first('description')); ?></p> <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label('Minimum delivery days:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg'])); ?>

								<div class="col-xs-12 col-md-8">
									<?php echo e(Form::number('min_delivery_days', (isset($edit_section->min_delivery_days)?$edit_section->min_delivery_days:0), array('step' => 'any', 'class' => 'form-control form-control-lg' ))); ?>

									<?php if($errors->has('min_delivery_days')): ?><p class="help-block error"><?php echo e($errors->first('min_delivery_days')); ?></p> <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label('Maximum delivery days:', null, ['class' => 'col-xs-12 col-md-4 col-form-label col-form-label-lg'])); ?>

								<div class="col-xs-12 col-md-8">
									<?php echo e(Form::number('max_delivery_days', (isset($edit_section->max_delivery_days)?$edit_section->max_delivery_days:0), array('step' => 'any', 'class' => 'form-control form-control-lg' ))); ?>

									<?php if($errors->has('max_delivery_days')): ?><p class="help-block error"><?php echo e($errors->first('max_delivery_days')); ?></p> <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-offset-2 col-md-10 text-center">
									<button type="submit" class="btn btn-primary margin-right-10" name="sc">Submit</button>
									<a class="btn btn-link" href="<?php echo e(url('/packages')); ?>">Back to Listing</a>
								</div>
							</div>
						<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>