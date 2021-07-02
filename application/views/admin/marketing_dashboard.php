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
		<!-- inquiry_source -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Current Month</h3>
					</div>
					<div class="box-body">
						<!-- /.col -->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Walk-In</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Walk-In','Marketing')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Generated</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Generated','Marketing')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Referral</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Referral','Marketing')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Converted','Walk-In','Marketing'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Converted','Generated','Marketing'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Converted','Referral','Marketing'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Test Drive Taken</span>
									<span class="info-box-number"><?php echo test_drive_count('Walk-In','Marketing'); ?> </span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Test Drive Taken</span>
									<span class="info-box-number"><?php echo test_drive_count('Generated','Marketing'); ?> </span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Test Drive Taken</span>
									<span class="info-box-number"><?php echo test_drive_count('Referral','Marketing'); ?> </span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_source?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- ./inquiry_source -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Generated Inquiry Trend</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div id="Generated_inquirytrend"></div>
					</div>

				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Referral Inquiry Trend</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div id="Referral_inquirytrend"></div>
					</div>

				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Walk-In Inquiry Trend</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div id="Walk-In_inquirytrend"></div>
					</div>

				</div>
			</div>
		</div>

		<div class="row">
			<div class='col-md-8'>
				<!-- TABLE: LATEST ORDERS -->
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">ModelWise Status(YTD)</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div id="dealerwise_grid"></div>
					</div>

				</div>
				<!-- /.box -->
			</div>
			<div class="col-md-4">
				<div class="col-md-12">
					<div class="box box-solid">
						<div class="box-header">
							<p class="text-center">
								<strong>Inquiry Status</strong>
							</p>
							<?php $color = array('green', 'yellow', 'red', 'blue', 'aqua');?>
							<?php $status_name = array('Pending','Confirmed','Booked','Retail','Closed');?>
							<?php $total_inquiry = status_count();?>
							<?php for( $i = 0; $i < 5; $i++):?>
								<?php $count = status_count($status_name[$i]);?>
								<?php if ($count == null) break; ?>
								<div class="progress-group">
									<span class="progress-text"><?php echo $status_name[$i];?></span>
									<span class="progress-number"><b><?php echo $count; ?> | <?php echo $total_inquiry ?></b></span>
									<div class="progress sm active">
										<div class="progress-bar progress-bar-striped progress-bar-<?php echo $color[$i];?>" style="width: <?php echo intval(($count * 100)/$total_inquiry);?>%"></div>
									</div>
								</div>
							<?php endfor;?>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="box box-solid">
						<div class="box-header">
							<p class="text-center">
								<strong>Enquiry Channel</strong>
							</p>
							<?php $inquiry = get_walkin_source_data();?>
							<?php $total_inquiry = get_walkin_source_data('total');?>
							<?php if ($total_inquiry == null) break; ?>
							<?php foreach ($inquiry as $key => $value): ?>
								<div class="progress-group">
									<span class="progress-text"><?php echo $value['walkin_source_name'];?></span>
									<span class="progress-number"><b><?php echo $value['total']; ?> | <?php echo $total_inquiry[0]['total_inquiry'] ?></b></span>
									<div class="progress sm active">
										<div class="progress-bar progress-bar-striped progress-bar-aqua" style="width: <?php echo intval(($value['total'] * 100)/$total_inquiry[0]['total_inquiry']);?>%"></div>
									</div>
								</div>
							<?php endforeach;?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class='col-md-12'>
				<!-- TABLE: LATEST ORDERS -->
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Dealerwise(YTD)</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div id="modelwise_grid"></div>
					</div>
				</div>
				<!-- /.box -->
			</div>
		</div>
		<!-- ./followup n recent inquiry -->
		<div class="row">
			<div class='col-md-12'>
				<!-- TABLE: LATEST ORDERS -->
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Followups</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php //echo $this->load->view($this->config->item('template_admin') .'partial_customer_followups_html');?>
					</div>

				</div>
				<!-- /.box -->
			</div> 
		</div>
	</section>
	<!-- /.content -->
</div>

<script type="text/javascript">
	
	$(function (){   
		// customer_followups();
	});
</script>
<?php echo $this->load->view($this->config->item('template_admin') .'marketing_dashboard_js');?>
<?php echo $this->load->view($this->config->item('template_admin') .'partial_customer_followups_js');?>


