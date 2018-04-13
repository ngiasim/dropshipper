<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container">
		<div class="row">
			<div class="page-header admin-header">
				<h3 id="page-title">Shipment Tracking : #<?php echo e($tracking_number); ?></h3>      
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
						<th>Status</th>
						<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php if(count($shipment_logs) == 0): ?>
							<tr>
								<td colspan="3">Invalid tracking number.</td>
							</tr>
						<?php endif; ?>
						<?php $__currentLoopData = $shipment_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($loop->iteration); ?></td>
								<td><?php echo e($row['shipment_status_to']); ?></td>
								<td><?php echo e(date("Y-m-d H:i:s",strtotime($row['created_at']))); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>