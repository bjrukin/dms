<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div id="jqxGridMsil_order"></div>
		</div><!-- /.col -->
	</div>
	<!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<style type="text/css">
	.cls-red { background-color: #F56969; }
</style>
<script language="javascript" type="text/javascript">

	$(function(){
		var msil_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'color_id', type: 'number' },
			{ name: 'month', type: 'number' },
			{ name: 'year', type: 'number' },
			{ name: 'order_id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'quantity', type: 'number' },
			{ name: 'received_quantity', type: 'number' },
			{ name: 'total_remaining', type: 'number' },
			{ name: 'received_percentage', type: 'number' },
			{ name: 'cancel_quantity', type: 'number' },
			{ name: 'reason', type: 'string' },
			{ name: 'order_type', type: 'string' },
			],
			url: '<?php echo site_url("admin/msil_orders/dispatch_list_json"); ?>',
			data : {order_id :<?php echo $order_id;?>,firm_id:<?php echo $firm_id;?>},
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
	    	$("#jqxGridMsil_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMsil_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	var cellclassname =  function (row, column, value, data) {
		if (data.order_type == 'Unplanned') {
			return 'cls-red';
		}
	};
	
	$("#jqxGridMsil_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: msil_ordersDataSource,
		altrows: true,
		pageable: true,
		sortable: false,
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
			container.append($('#jqxGridMsil_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},		
		// { text: '<?php echo lang("order_id"); ?>',datafield: 'order_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("color_id"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("month"); ?>',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("received_quantity"); ?>',datafield: 'received_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("total_remaining"); ?>',datafield: 'total_remaining',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("order_type"); ?>',datafield: 'order_type',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("cancel_quantity"); ?>',datafield: 'cancel_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("reason"); ?>',datafield: 'reason',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("received_percentage"); ?>', datafield: 'received_percentage', width: 150, align: 'center', cellsformat: 'p', cellclassname: cellclassname, aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			var rows = $('#jqxGridMsil_order').jqxGrid('getdatainformation');
			var rowscounts = rows.rowscount;

			$.each(aggregates, function (key, value) {
				var name = 'Total Percentage';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + parseInt(value) / parseInt(rowscounts) +'%</div>';
			});
			return renderstring;
		}
	}, 
	],
	rendergridrows: function (result) {
		return result.data;
	}
});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridMsil_order").jqxGrid('refresh');}, 500);
	});	
});
</script>