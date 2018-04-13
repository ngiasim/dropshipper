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
						<a href="<?php echo e(url('packages/create')); ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add New</a>
			        </small>
				</h3>      
			</div>
		</div>
		<div class='row'>
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
						<?php if(count($packages) == 0): ?>
							<tr>
								<td colspan="4">No packages found.</td>
							</tr>
						<?php endif; ?>
						<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($loop->iteration); ?></td>
								<td><?php echo e($row['package_name']); ?></td>
								<td><?php echo e($row['package_code']); ?></td>
								<td><?php echo e($row['min_delivery_days']); ?></td>
								<td><?php echo e($row['max_delivery_days']); ?></td>
								<td>
									<span class="table-action-icons">
										<a title="Edit" href="<?php echo e(route('packages.edit',$row['id'])); ?>">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
										&nbsp;
										<?php echo Form::open(['method' => 'DELETE','route' => ['packages.destroy', $row['id']],'style'=>'display:inline']); ?>

							            	<button type="submit">
											    <i class="glyphicon glyphicon-trash"></i> 
											</button>
							            <?php echo Form::close(); ?>

									</span>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>