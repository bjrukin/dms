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
							<li><a href='<?php echo site_url('monthly_plannings/get_report');?>' target="_blank">MSIL</li>
							<li><a href='<?php echo site_url('monthly_plannings/msil_pending_get_report');?>' target="_blank">MSIL Pendings</li>
							<li><a href='<?php echo site_url('stock_records/billing_stock/cg_stock');?>' target="_blank">Stock</li>	
							<li><a href='<?php echo site_url('stock_records/billing_stock/cg_stock_position');?>' target="_blank">Stock Position</li>								
							<li><a href='<?php echo site_url('stock_records/generate/dealer_stock');?>' target="_blank">Dealer Stock</li>
							<li><a href='<?php echo site_url('stock_records/generate/dispatch');?>' target="_blank">Dispatch</li>
							<!-- <li><a href='<?php echo site_url('stock_records/billing_stock/bill_stock');?>' target="_blank">Billing and Stock</li> -->
							<li><a href='<?php echo site_url('stock_records/billing_stock/dealer_wise_monthly');?>' target="_blank">Dealer Monthly Billing</li> 
							<li><a href='<?php echo site_url('stock_records/billing_stock/dealer_retail');?>' target="_blank">Dealer Retail</li>
							<li><a href='<?php echo site_url('stock_records/billing_stock/monthly_dispatch');?>' target="_blank">Monthly Dispatch</li>							
							<li><a href='<?php echo site_url('stock_records/billing_stock/damage_stock');?>' target="_blank">Damage Stock</li>							
							<li><a href='<?php echo site_url('stock_records/billing_stock/repaired_stock');?>' target="_blank">Repaired Stock</li>			
							<li><a href='<?php echo site_url('stock_records/dealer_order_summary/order_summary');?>' target="_blank">Dealer Order Summary  </li>							
							<li><a href='<?php echo site_url('stock_records/credit_control_delay/credit_control_delay');?>' target="_blank">Credit Control Delay</li>							
							<li><a href='<?php echo site_url('stock_records/logistic_delay/logistic_delay');?>' target="_blank">Logistic Delay</li>
							<li><a href='<?php echo site_url('stock_records/dispatch_deadline/dispatch_deadline_report');?>' target="_blank">Required Stock Transfer</li>					
							<li><a href='<?php echo site_url('stock_records/stock_records/pdi_report');?>' target="_blank">PDI Report</li>						
							<li><a href='<?php echo site_url('dispatch_records/fuel_report');?>' target="_blank">Fuel Report</li>				
							<li><a href='<?php echo site_url('stock_records/generate_test_drive');?>' target="_blank">Test Drive Report</li>				
							<!-- <li><a href='<?php echo site_url('stock_records/plan_actual');?>' target="_blank">Plan Actual</li>							 -->
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
