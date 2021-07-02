<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('remaining_order'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div class="row">
					<div class="col-md-12">
						
					</div>
				</div>
				<?php echo displayStatus(); ?>				
				<div id="jqxGridRemainingMsil_order"></div>
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
			{ name: 'sp_partcode', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'remaining_quantity', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_no', type: 'number' },
			{ name: 'reached_date_nepali', type: 'string' },
			{ name: 'reached_date', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'sp_partname', type: 'string' },


			],
			url: '<?php echo site_url("msil_orders_spareparts/remaining_list")."/$msil_order_no";?>',
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
	    	$("#jqxGridRemainingMsil_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridRemainingMsil_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridRemainingMsil_order").jqxGrid({
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
		theme:theme,
		statusbarheight: 30,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridRemainingMsil_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},		
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'sp_partcode',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'sp_partname',width: 190,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remaining_quantity"); ?>',datafield: 'remaining_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, aggregates : ['sum'] },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridRemainingMsil_order").jqxGrid('refresh');}, 500);
	});
});
</script>