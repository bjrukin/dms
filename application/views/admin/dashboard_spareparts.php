<!-- applicarion/views/admin -->

<style>
.info-box-text {font-size: 18px}
.info-box-number {font-size: 28px}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>DASHBOARD</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- stock position -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-clipboard"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Order</span>
									<span class="info-box-number"><?php echo number_format(dealer_total_order()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-clock"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Dealer Pending PI</span>
									<span class="info-box-number"><?php echo number_format(pending_dealer_pi()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-clock"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">CG Pending PI</span>
									<span class="info-box-number"><?php echo number_format(pending_cg_pi()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<!-- <a href="<?php echo site_url('crm-reports/generate/inquiry_status?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a> -->
					</div>
				</div>
			</div>
		</div><!-- ./stock position -->

	</section>
	<!-- /.content -->
</div>

