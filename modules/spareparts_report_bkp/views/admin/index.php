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
							<li><a href='<?php echo site_url('spareparts_report/generate/partwise_sales');?>' target='_blank'>Partwise Sales</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate/dealer_partwise_sales');?>' target='_blank'>Dealer Partwise Sales</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate/dealer_valuewise_sales');?>' target='_blank'>Dealer Value Sales</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate/dealer_back_order');?>' target='_blank'>Dealer Backorder</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_dealer_service_level/service_level');?>' target='_blank'>Dealer Service Level</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_dealer_service_level_monitor/dealer_service_level_summary');?>' target='_blank'>Dealer Service Level Monitor Summary</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_dealer_service_level/service_level_summary');?>' target='_blank'>Service Level Summary</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_aging/spareparts_aging');?>' target='_blank'>Aging Of Spareparts</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_msil_shipment/msil_shipment_monitor');?>' target='_blank'>Msil Shipment Monitor</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_msil_service_level/msil_service_level');?>' target='_blank'>Msil Service Level</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_dealer_service_level/msil_consigment');?>' target='_blank'>MSIL Consignment</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_msil_service_level_summary/msil_service_level_summary');?>' target='_blank'>Msil Shipment Monitor Summary</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_current_stock/stock_report');?>' target='_blank'>Product In/Out Register</a></li>
							<li><a href='<?php echo site_url('spareparts_report/generate_categorywise_sales/categorywise_sales');?>' target='_blank'>Categorywise Sales</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
