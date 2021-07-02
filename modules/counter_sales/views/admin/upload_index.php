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
								<form action="<?php echo site_url('admin/counter_sales/upload_counter_sales')?>" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<input type="file" name="userfile">
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-xs btn-flat">
									</div>
								</form>
							</div><!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
				</div>
			</div>
		</div>

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->