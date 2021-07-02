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
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('service_reports'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('foc_reports'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_foc_reports"></div>
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
				var foc_reports_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'string' },
					{ name: 'issue_date', type: 'string' },
					{ name: 'jobcard_group', type: 'int' },
					{ name: 'vehicle_no', type: 'string' },
					{ name: 'customer_name', type: 'string' },
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'variant_name', type: 'string' },
					{ name: 'service_type', type: 'int' },
					{ name: 'service_count', type: 'int' },
					{ name: 'service_type_name', type: 'string' },
					{ name: 'service_no', type: 'string' },
					],
					data: {selection:selection},
					type: 'post',
					url: '<?php echo site_url('service_reports/foc_reports/json'); ?>'
				};
				var foc_reports_dataAdapter = new $.jqx.dataAdapter(foc_reports_source);
				$("#jqxGrid_foc_reports").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: foc_reports_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo lang("issue_date"); ?>', datafield: 'issue_date', width:'9%' },
					{ text: '<?php echo lang("jobcard_group"); ?>', datafield: 'jobcard_group', width:'9%' },
					{ text: '<?php echo lang("vehicle_no"); ?>', datafield: 'vehicle_no', width:'9%' },
					{ text: '<?php echo lang("customer_name"); ?>', datafield: 'customer_name',width:'18%' },
					{ text: '<?php echo lang("vehicle_name"); ?>', datafield: 'vehicle_name', width:'15%', cellsrenderer   : function(row,columnfield,value){
						var data = $('#jqxGrid_foc_reports').jqxGrid('getrowdatabyid', row);
						return data.vehicle_name+" "+data.variant_name;
					} },
					{ text: '<?php echo lang("service_type_name"); ?>', datafield: 'service_type_name', width:'9%' },
					{ text: '<?php echo lang("service_no"); ?>', datafield: 'service_no', width:'9%' },
					]
				});

				
			}
		});

	});

</script>
