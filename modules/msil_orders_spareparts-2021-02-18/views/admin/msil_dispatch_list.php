<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_dispatch'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_dispatch'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div class="row">
					<div class="col-md-12">
						<h3>Invoice No.: <?php echo $invoice_no; ?></h3>
					</div>
				</div>
				<?php echo displayStatus(); ?>
				<div id='jqxGridDispatch_listToolbar' class='grid-toolbar'>
<!-- 
					<?php if($binning_status->binning_status != 1): ?>
						<a class="btn btn-xs btn-flat btn-success" href="<?php echo site_url('msil_orders_spareparts/generate_binning_list').'?invoice_no='.$invoice_no;?>" target="_blank">Generate Binning List</a>
					<?php endif; ?>

					<?php if($binning_status->binning_status == 1): ?>
						<a class="btn btn-xs  btn-primary" href="<?php echo site_url('msil_orders_spareparts/print_secondary_binning_list').'?invoice_no='.$invoice_no;?>" target="_blank">Print Binning List</a>
					<?php endif; ?>  -->
					<?php //if($binning_status->binning_status != 1): ?>
						<a class="btn btn-xs btn-flat btn-success" href="<?php echo site_url('msil_orders_spareparts/show_binning_list').'?invoice_no='.$invoice_no;?>" target="_blank">Generate Binning List</a>
					<?php //endif; ?>

					<!-- <?php //if($binning_status->binning_status == 1): ?>
						<a class="btn btn-xs  btn-primary" href="<?php //echo site_url('msil_orders_spareparts/print_secondary_binning_list').'?invoice_no='.$invoice_no;?>" target="_blank">Print Binning List</a>
					<?php //endif; ?> -->
				</div>				
				<div id="jqxGridDispatch_list"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){

		var msil_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'remaining_quantity', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_no', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'reached_date_nepali', type: 'string' },
			{ name: 'reached_date', type: 'string' },
			{ name: 'location', type: 'string' },
			{ name: 'binning_location', type: 'array' },
			],
			url: '<?php echo site_url("msil_orders_spareparts/msil_dispatch_json")?>?invoice_no=<?php echo $invoice_no ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	msil_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDispatch_list").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDispatch_list").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDispatch_list").jqxGrid({
		width: '100%',
		height: gridHeight,
		source: msil_ordersDataSource,
		altrows: true,
		pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight:30,
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		autoshowfiltericon: true,
		columnsreorder: true,
		showstatusbar: true,
		selectionmode: 'singlecell',
		theme:theme,
		statusbarheight: 30,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridDispatch_listToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},		
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150, align:'center', cellsalign:'center', filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 225, align:'center', cellsalign:'center', filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>', datafield: 'quantity', width: 150, cellsalign: 'right', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Qty';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	}, 
		{ text: '<?php echo lang("location"); ?>',datafield: 'location',width: 150, align:'center', cellsalign:'center', filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("binning_location"); ?>',datafield: 'binning_location',width: 150, align:'center', cellsalign:'center', filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("reached_date"); ?>',datafield: 'reached_date',width: 150,filterable: true, align:'center', cellsalign:'center', renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDispatch_list").jqxGrid('refresh');}, 500);
	});
});
</script>