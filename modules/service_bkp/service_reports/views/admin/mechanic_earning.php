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
			<li><a href="<?php echo site_url('service_reports');?>"><?php echo lang('service_reports');?></a></li>
			<li class="active"><?php echo lang('mechanic_earning'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('mechanic_earning'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<label><?php echo lang("date_range"); ?></label>
					<div id='date_range' name='date_range'></div>

				</div>
				<div class="box-footer clearfix">
					<!-- <button type="button" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i> </button> -->
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title"><?php echo lang('mechanic_earning'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_mechanic_earning"></div>
				</div>
				<!-- <div class="box-footer clearfix"></div> -->
			</div>
		</div>


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(function(){
		$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true, formatString: "yyyy-MM-dd" });
		$('#date_range').jqxDateTimeInput('setRange', null, null);

		$("#date_range").on('change', function (event) {
			var selection = $("#date_range").jqxDateTimeInput('getText');
			if (selection != null) {
				var mechanic_earning_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'string' },
					{ name: 'first_name', type: 'string' },
					{ name: 'middle_name', type: 'string' },
					{ name: 'last_name', type: 'string' },
					{ name: 'mechanic_name', type: 'int' },
					{ name: 'designation_id', type: 'int' },
					{ name: 'designation_name', type: 'string' },
					{ name: 'jobs', type: 'string' },
					{ name: 'vat_job', type: 'int' },
					{ name: 'ow_final_amount', type: 'int' },
					{ name: 'ow_margin', type: 'int' },
					{ name: 'net_amount', type: 'int' },
					],
					data: {selection:selection},
					type: 'post',
					url: '<?php echo site_url('service_reports/mechanic_earning/json'); ?>'
				};
				var mechanic_earning_dataAdapter = new $.jqx.dataAdapter(mechanic_earning_source);
				$("#jqxGrid_mechanic_earning").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: mechanic_earning_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo lang("mechanic_name"); ?>', datafield: 'mechanic_name', width:'20%' },
					// { text: '<?php echo lang("designation_name"); ?>', datafield: 'designation_name', width:'9%' },
					{ text: '<?php echo lang("labour_amt"); ?>', datafield: 'jobs', width:'10%' },
					{ text: '<?php echo lang("ow_final_amount"); ?>', datafield: 'ow_final_amount', width:'10%' },
					{ text: '<?php echo lang("ow_margin"); ?>', datafield: 'ow_margin', width:'10%' },
					{ text: '<?php echo lang("vat_job"); ?>', datafield: 'vat_job', width:'10%' },
					{ text: '<?php echo lang("net_amount"); ?>', datafield: 'net_amount', width:'10%' },
					]
				});

				
			}
		});

	});

</script>
