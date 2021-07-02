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
			<li class="active"><?php echo lang('mechanic_consume'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('mechanic_consume'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<label><?php echo lang("date_range"); ?></label>
					<div id='date_range' name='date_range'></div>
					<button type="button" id="date_range_submit">Submit</button>

				</div>
				<div class="box-footer clearfix">
					<!-- <button type="button" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i> </button> -->
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title"><?php echo lang('mechanic_consume'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_mechanic_consume"></div>
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

		$("#date_range_submit").on('click', function (event) {
			var selection = $("#date_range").jqxDateTimeInput('getText');
			// if (selection != null) {
				var mechanic_consume_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'mechanic_name', type: 'string' },
					{ name: 'taxable', type: 'string' },
					{ name: 'taxes', type: 'string' },
					{ name: 'ow_payment', type: 'string' },
					{ name: 'ow_margin', type: 'string' },
					{ name: 'ow_tax', type: 'string' },
					{ name: 'accessories', type: 'string' },
					{ name: 'spareparts', type: 'string' },
					{ name: 'tools', type: 'string' },
					{ name: 'misc', type: 'string' },
					{ name: 'books', type: 'string' },
					],
					data: {selection:selection},
					type: 'post',
					url: '<?php echo site_url('service_reports/mechanic_consume/json'); ?>'
				};
				var mechanic_consume_dataAdapter = new $.jqx.dataAdapter(mechanic_consume_source);
				$("#jqxGrid_mechanic_consume").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: mechanic_consume_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo lang("mechanic_name"); ?>', datafield: 'mechanic_name', },
					{ text: '<?php echo lang("taxable"); ?>', datafield: 'taxable', },
					{ text: '<?php echo lang("taxes"); ?>', datafield: 'taxes', },
					{ text: '<?php echo lang("ow_payment"); ?>', datafield: 'ow_payment', },
					{ text: '<?php echo lang("ow_margin"); ?>', datafield: 'ow_margin', },
					{ text: '<?php echo lang("ow_tax"); ?>', datafield: 'ow_tax', },
					{ text: '<?php echo lang("accessories"); ?>', datafield: 'accessories', },
					{ text: '<?php echo lang("spareparts"); ?>', datafield: 'spareparts', },
					{ text: '<?php echo lang("tools"); ?>', datafield: 'tools', },
					{ text: '<?php echo lang("books"); ?>', datafield: 'books', },
					{ text: '<?php echo lang("misc"); ?>', datafield: 'misc', },
					]
				});

				
			// }
		});

	});

</script>
