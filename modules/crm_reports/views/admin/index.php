<style type="text/css">
.master-menu-box{
	width: 160px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('crm_reports'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('crm_reports'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div class="box box-solid">
					<div class="box-body" style="line-height:200%">
						<ul style="list">
							<!-- <li><a href='<?php echo site_url('crm-reports/generate/inquiry_source');?>' target="_blank">Inquiry Source</li> -->
							<li><a href='<?php echo site_url('crm-reports/inquiry_source');?>' target="_blank">Inquiry Source</li>
								<li><a href='<?php echo site_url('crm-reports/generate/inquiry_type');?>' target="_blank">Inquiry Type</li>
									<?php if(is_showroom_incharge()): ?>
										<li><a href='<?php echo site_url('stock_records/billing_stock/dealer_retail');?>' target="_blank">Dealer Retail</li>
										<?php endif; ?>
							<?php /* ?>
							<li><a href="javascript:void(0)">Inquiry Type</a>
								<ul type="a">
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_type_walkin');?>' target='_blank'>Walkin</a></li>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_type_generated');?>' target='_blank'>Generated</a></li>
								</ul>
							</li>
							<?php */ ?>
							<!-- <li><a href='<?php echo site_url('crm-reports/generate/inquiry_kind');?>' target="_blank">Inquiry Kind</li> -->
								<!-- <li><a href='<?php echo site_url('crm-reports/generate/inquiry_status');?>' target="_blank">Inquiry Status</li> -->
									<!-- <li><a href='<?php //echo site_url('crm-reports/generate/inquiry_conversion');?>' target="_blank">Inquiry Conversion Ratio</li> -->
										<li><a href='<?php echo site_url('crm-reports/generate/inquiry_test_drive_conversion');?>' target="_blank">Test Ride Conversion Report</li>

										<li><a href='<?php echo site_url('crm-reports/generate_test_drive/inquiry_test_drive');?>' target="_blank">Test Ride Report</li>		
											<li><a href="javascript:void(0)">Customer Insights Report</a>
												<ul type="a">
									<?php /* ?>
									<li><a href="javascript:void(0)">Demographic Information</a>
										<ul type="a">
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_age_group');?>' target='_blank'>Age Group</a></li>
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_gender');?>' target='_blank'>Gender</a></li>
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_zone');?>' target='_blank'>Zone</a></li>
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_district');?>' target='_blank'>District</a></li>
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_occupation');?>' target='_blank'>Occupation</a></li>
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_marital_status');?>' target='_blank'>Marital Status</a></li>
											<li><a href='<?php echo site_url('crm-reports/generate/inquiry_family_size');?>' target='_blank'>Family Size</a></li>
										</ul>
									</li>
									<?php */?>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_demographic_information');?>' target='_blank'>Demographic Information</a></li>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_institution');?>' target='_blank'>Institution Sector</a></li>
									<?php /*?><li><a href='<?php echo site_url('crm-reports/generate/inquiry_occupation');?>' target='_blank'>Customer Profession</a></li><?php */?>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_payment_mode');?>' target='_blank'>Mode of Purchase</a></li>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_customer_type');?>' target='_blank'>Type of Purchase</a></li>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_lost_case');?>' target='_blank'>Lost Case Analysis</a></li>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_reason_purchase');?>' target='_blank'>Reason for Purchase</a></li>
									<li><a href='<?php echo site_url('crm-reports/generate/inquiry_reason_non_purchase');?>' target='_blank'>Reason for Non Purchase</a></li>

								</ul>
							</li>
							<li><a href='<?php echo site_url('crm-reports/inquiry_trend');?>' target='_blank'>Inquiry Trend</li>
								<li><a href='<?php echo site_url('crm-reports/generate/inquiry_pending');?>' target='_blank'>Pending Enquiry</a></li>
								<?php /*?><li><a href='<?php echo site_url('crm-reports/generate/inquiry_TYPE');?>' target='_blank'><span style="color:red">Inquiry Target V/s Achievement ??</span></li><?php */?>
									<li><a href='<?php echo site_url('crm-reports/retail_finance');?>' target='_blank'>Retail Finance</a></li>
									<?php if(($this->session->userdata('employee')['dealer_id']) == 75):?>
										<li><a href='<?php echo site_url('crm-reports/generate_taxi_sales/taxi_sales');?>' target='_blank'>Taxi Sales</a></li>
									<?php endif; ?>
									<li><a href='<?php echo site_url('crm-reports/generate_bank_loan_summary/bank_loan_summary');?>' target="_blank">Bank Loan Summary</li>
										<li><a href='<?php echo site_url('crm-reports/generate_payment_details/payment_details');?>' target='_blank'>Payment Details</a></li>
										<li><a href='<?php echo site_url('crm-reports/inquiry_edit/inquiry_name_edit');?>' target='_blank'>Inquiry Name Edit</a></li>
										<li><a href='<?php echo site_url('crm-reports/inquiry_vehicle_edit/inquiry_vehicle_edit');?>' target='_blank'>Inquiry Vehicle Edit</a></li>
										

										<li><a href='<?php echo site_url('crm-reports/booking_report/booking_report');?>' target='_blank'>Booking Report</a></li>
										<?php if(is_manager() || is_logistic_user() || is_logistic_executive() || is_admin() || is_sales_head() || is_credit_control()): ?>
											<li><a href='<?php echo site_url('crm-reports/booking_dashboard');?>' target='_blank'>Booking Dashboard</a></li>
										 <li><a href='<?php echo site_url('crm-reports/followup_report');?>' target='_blank'>Follow up Report</a></li> 
										 <li><a href='<?php echo site_url('crm-reports/follow_up_report/follow_up_report');?>' target='_blank'>Follow up Report Pivot</a></li> 
										<?php endif; ?>

										<?php if(is_admin()): ?>
											<li><a href='<?php echo site_url('crm-reports/billing_target_report');?>' target='_blank'>Billing Target Report</a></li>
											<li><a href='<?php echo site_url('crm-reports/retail_target_report');?>' target='_blank'>Retail Target Report</a></li>
											<li><a href='<?php echo site_url('crm-reports/inquiry_target_report');?>' target='_blank'>Inquiry Target Report</a></li>
										<?php endif; ?>
										<!-- <li><a href='<?php echo site_url('crm-reports/generate/customer_details');?>' target='_blank'>Payment Details</a></li> -->

										<?php /*if(is_manager() || is_logistic_user() || is_logistic_executive() || is_admin() || is_sales_head() ): ?>
											<li><a href='<?php echo site_url('crm-reports/test_drive_fuel_report');?>' target='_blank'>Test Drive Fuel Report</a></li>
										<?php endif; */?>

									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /.row -->
		<!-- <div class="row">
			<div class="col-xs-12 connectedSortable">
				<h4>SALES REPORT</h4>
				<div class="box box-solid">
					<div class="box-body" style="line-height:200%">
						<ul style="list">
							<li><a href="<?php echo site_url('vehicle_processes/generate_report/primary_sales') ?>" target = "_blank">Primary Sales</a></li>
							<li><a href="<?php echo site_url('vehicle_processes/generate_report/secondary_sales') ?>" target = "_blank">Secondary Sales</a></li>
							<li><a href='<?php echo site_url('crm-reports/generate/inquiry_conversion');?>' target="_blank">Inquiry Conversion Ratio</li>
							<li><a href="<?php echo site_url('vehicle_processes/growth_rate_generate_report/growth_rate') ?>" target = "_blank">Growth Over Past Year</a></li>
							
							<li><a href="<?php echo site_url('vehicle_processes/target_achievement') ?>" target = "_blank">Target_Achievement</a></li> 
						</ul>
					</div>
				</div>
			</div>
		</div> -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
