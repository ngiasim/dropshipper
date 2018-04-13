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
						<th>Order Number</th>
						<th>Email</th>
						<th>Total Price</th>
						<th>Order ID</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>
									<?php if($row['tracking_number'] == ""): ?>
										<?php echo e($row['order_number']); ?>

									<?php else: ?>
										<a target="_blank" href="<?php echo e(url('track/'.$row['tracking_number'])); ?>"><?php echo e($row['order_number']); ?></a>
									<?php endif; ?>
									
								</td>
								<td><?php echo e($row['email']); ?></td>
								<td><?php echo e($row['total_price']); ?></td>
								<td><?php echo e($row['order_id']); ?></td>
								<td>
									<?php if($row['shipment_status'] == 'delivered'): ?>
										<h4><span class="label label-success">Delivered</span></h4>
									<?php else: ?>
										<span class="table-action-icons">
											<form action="<?php echo e(url('orders/accept')); ?>" method="post">
												<?php echo csrf_field(); ?>

												<div class="form-group">
												    <input type="hidden" name="order_id" value="<?php echo e($row['id']); ?>" />
												</div>
												<select name="status">
													<option value="">Select Status</option>
													<option value="confirmed"
														<?php if($row['shipment_status'] == 'confirmed'): ?>
															selected
														<?php endif; ?>
													>Shipment Created</option>
													<option value="in_transit"
														<?php if($row['shipment_status'] == 'in_transit'): ?>
															selected
														<?php endif; ?>
													>In Transit</option>
													<option value="out_for_delivery"
														<?php if($row['shipment_status'] == 'out_for_delivery'): ?>
															selected
														<?php endif; ?>
													>Out for delivery</option>
													<option value="delivered">Delivered</option>
												</select>
												<button>Update</button>
											</form>
										</span>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>