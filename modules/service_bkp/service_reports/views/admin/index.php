<style type="text/css">
	.master-menu-box{
		width: 160px;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('service_reports'); ?>
			<!-- <small>Control panel</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('service_reports'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="box box-solid">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="fa fa-wrench"></i>

				<h3 class="box-title"><?php echo lang('service_reports'); ?></h3>
				<div class="pull-right box-tools">
					<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body" style="line-height:200%">
			<ol>
					<li><a href='<?php echo site_url('service_reports/job_summary');?>' target="_blank"><?php echo lang("job_summary") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/foc_reports');?>' target="_blank"><?php echo lang("foc_reports") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/pdi_reports');?>' target="_blank"><?php echo lang("pdi_reports") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/mechanic_earning');?>' target="_blank"><?php echo lang("mechanic_earning") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/counter_sales');?>' target="_blank"><?php echo lang("counter_sales") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/sales_summary');?>' target="_blank"><?php echo lang("sales_summary") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/dent_paint');?>' target="_blank"><?php echo lang("dent_paint") ?></a></li>
					<li><a href='<?php echo site_url('service_reports/mechanic_consume');?>' target="_blank"><?php echo lang("mechanic_consume") ?></a></li>
				</ol>
			</div>
			<div class="box-footer clearfix">
				<!-- <button type="button" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i> </button> -->
			</div>
		</div>


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
