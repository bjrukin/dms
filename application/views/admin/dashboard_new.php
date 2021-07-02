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
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inqiury by Status</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Inquiries</span>
									<span class="info-box-number"><?php echo number_format(status_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Pending</span>
									<span class="info-box-number"><?php echo number_format(status_count('Pending')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Confirmed</span>
									<span class="info-box-number"><?php echo number_format(status_count('Confirmed')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Booked</span>
									<span class="info-box-number"><?php echo number_format(status_count('Booked')); ?></span>
								</div>
								
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Retail</span>
									<span class="info-box-number"><?php echo number_format(status_count('Retail')); ?></span>
								</div>
								
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-maroon"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Closed</span>
									<span class="info-box-number"><?php echo number_format(status_count('Closed')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_status?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inquiry by Kind</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Warm</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count('Warm')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Hot</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count('Hot')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Cold</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count('Cold')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inquiry by Source</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Walk-In</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Walk-In')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Generated</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Generated')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Referral</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Referral')); ?></span>
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
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inquiry by Type</h3>
					</div>
					<div class="box-body">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">First Tyme Buyer</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('First Tyme Buyer')); ?></span>
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
									<span class="info-box-text">Additional Buyer</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('Additional Buyer')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Suzuki to Suzuki Exchange</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('Suzuki to Suzuki Exchange')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Other Brand to Suzuki Exchange</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('Other Brand to Suzuki Exchange')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<!-- <div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Closed Inquiries</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Lost</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count('Lost')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Booking Cancel</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count('Booking Cancel')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Cancel</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count('Cancel')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<!-- <div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inqiury Conversion Ratio</h3>
					</div>
					<div class="box-body">
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Not Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Not Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
					</div>
					<!-- ./box-body -->
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_conversion?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Test Drive Conversion Ratio</h3>
					</div>
					<div class="box-body">
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo test_drive_conversion_ratio('Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Not Converted</span>
									<span class="info-box-number"><?php echo test_drive_conversion_ratio('Not Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
					</div>
					<!-- ./box-body -->
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_test_drive_conversion?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		
		<?php if(is_admin() || is_sales_head() || is_manager()  || is_dealer_incharge() || is_sales_executive() || is_showroom_incharge()): ?>
			<div class="row">
				<div class='col-md-12'>
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-solid">
						<div class="box-header">
							<h3 class="box-title">Followup</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<?php echo $this->load->view($this->config->item('template_admin') .'partial_customer_followups_html');?>
						</div>

					</div>
					<!-- /.box -->
				</div> 
			</div>
		<?php endif; ?>
		<!-- ./followup n recent inquiry -->
		<div class="row">
			<div class='col-md-12'>
				<!-- TABLE: LATEST ORDERS -->
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Discount</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo $this->load->view($this->config->item('template_admin') .'discount_schemes');?>
					</div>

				</div>
				<!-- /.box -->
			</div> 
		</div>

	</section>
	<!-- Main content -->

	<!-- /.content -->
</div>
<script type="text/javascript">
	$(function(){
    	customer_followups();

	})
</script>
<?php echo $this->load->view($this->config->item('template_admin') .'partial_customer_followups_js');?>
