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
		<!-- /.row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<h4>SALES REPORT</h4>
				<div class="box box-solid">
					<div class="box-body" style="line-height:200%">
						<ul style="list">
							<li><a href="<?php echo site_url('logistic_reports/generate_report/dealer_wise_retail') ?>" target = "_blank">Dealerwise Retail</a></li>							 
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
