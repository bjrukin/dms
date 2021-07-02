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
			<li class="active"><?php echo lang('counter_sales'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('counter_sales'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('counter_sales'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_counter_sales"></div>
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
				var counter_sales_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'string' },
					{ name: 'category_name', type: 'string' },
					{ name: 'quantity', type: 'string' },
					{ name: 'discount_amount', type: 'string' },
					{ name: 'taxable', type: 'string' },
					{ name: 'cash_discount', type: 'string' },
					{ name: 'uw_amount', type: 'string' },
					{ name: 'net_amount', type: 'string' },
					],
					data: {selection:selection},
					type: 'post',
					url: '<?php echo site_url('service_reports/counter_sales/json'); ?>'
				};
				var counter_sales_dataAdapter = new $.jqx.dataAdapter(counter_sales_source);
				$("#jqxGrid_counter_sales").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: counter_sales_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo lang("group_name"); ?>', datafield: 'category_name', width:'9%' },
					{ text: '<?php echo lang("quantity"); ?>', datafield: 'quantity', width:'9%' },
					{ text: '<?php echo lang("discount"); ?>', datafield: 'discount_amount', width:'9%' },
					{ text: '<?php echo lang("taxable"); ?>', datafield: 'taxable',width:'18%' },
					{ text: '<?php echo lang("cash_discount"); ?>', datafield: 'cash_discount',width:'18%' },
					{ text: '<?php echo lang("uw_amount"); ?>', datafield: 'uw_amount',width:'18%' },
					{ text: '<?php echo lang("net_amount"); ?>', datafield: 'net_amount',width:'18%' },
					]
				});

				
			// }
		});

	});

</script>
