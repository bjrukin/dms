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
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-solid">
					<ul style="list">
						<li><a href="<?php echo site_url('spareparts_report/generate_dealer_stock/dealer_stock') ?>" target="_blank"> Dealer Stock </a></li>
						<li><a href="<?php echo site_url('spareparts_report/generate_dealer_sales/dealer_sales') ?>" target="_blank"> Dealer Sales </a></li>
						<li><a href="<?php echo site_url('spareparts_report/generate_dealer_sales_category/dealer_sales') ?>" target="_blank"> Dealer Category Sales </a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</div><!-- /.content-wrapper -->