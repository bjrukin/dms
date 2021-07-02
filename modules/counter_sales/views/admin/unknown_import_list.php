<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
		<!-- <ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('job_cards'); ?></li>
		</ol> -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php echo $header; ?></h3>
					</div>
					<div class="box-body">
						<!-- row -->
						<div class="row">
							<div class="col-xs-12 connectedSortable">
								<table border='1px'>
									<thead>
										<tr>
											<td>Sn.</td>
											<td>Part code</td>
											<td>Quantity</td>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;?>
										<?php foreach ($unknown_data as $key => $value) {?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $value['part_code']?></td>
												<td><?php echo $value['quantity']?></td>
												<?php $i++;?>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div><!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
				</div>
			</div>
		</div>

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->