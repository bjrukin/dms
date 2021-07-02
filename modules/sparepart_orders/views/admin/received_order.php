
<div class="row">
	<div class="col-xs-12 connectedSortable">
		<?php echo displayStatus(); ?>		
		<div id="jqxReceived_order"></div>
	</div><!-- /.col -->
</div>
<div id="jqxPopupWindowReceived_order">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Received Order</span>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="jqxReceived_orderlist"></div>
		</div>
	</div>
</div>
</div>
<script language="javascript" type="text/javascript">

	$(function(){

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'order_no', type: 'number' },			
			{ name: 'bill_no', type: 'number' },
			{ name: 'proforma_invoice_id', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'dispatched_date', type: 'string' },
			{ name: 'grn_received_date', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/received_order_json");?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxReceived_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxReceived_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	

	$("#jqxReceived_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepart_ordersDataSource,
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
		selectionmode: 'none',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxReceived_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxReceived_order").jqxGrid('getrowdata', index);
				var e = '<a href="javascript:void(0)" onclick="display_list(' + index + '); return false;" title="Display Parts"><i class="fa fa-list"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},

		{ text: 'Dealer',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("grn_received_date"); ?>',datafield: 'grn_received_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxReceived_order").jqxGrid('refresh');}, 500);
	});
	$(document).on('click','#jqxReceived_orderFilterClear', function () { 
		$('#jqxReceived_order').jqxGrid('clearfilters');
	});

	/*var recent_dispatchDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'order_no', type: 'number' },			
		{ name: 'bill_no', type: 'number' },
		{ name: 'sparepart_id', type: 'number' },
		{ name: 'total_dispatched', type: 'number' },
		{ name: 'part_code', type: 'string' },
		{ name: 'latest_part_code', type: 'string' },
		{ name: 'name', type: 'string' },
		{ name: 'dispatched_date', type: 'string' },
		{ name: 'grn_received_date', type: 'string' },
		{ name: 'available', type: 'bool' },
		],
		data: {bill_no : row.bill_no, dispatched_date : row.dispatched_date},
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	recent_dispatchDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxReceived_orderlist").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxReceived_orderlist").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	

	$("#jqxReceived_orderlist").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: recent_dispatchDataSource,
		altrows: true,
		pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight:30,
		showfilterrow: false,
		filterable: false,
		columnsresize: true,
		autoshowfiltericon: true,
		columnsreorder: true,
		selectionmode: 'none',
		editable: true,
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxReceived_orderlistToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_no',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_quantity"); ?>',datafield: 'total_dispatched',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});*/

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxReceived_orderlist").jqxGrid('refresh');}, 500);
	});

	// initialize the popup window
	$("#jqxPopupWindowReceived_order").jqxWindow({ 
		theme: theme,
		width: '95%',
		maxWidth: '95%',
		height: '95%',  
		maxHeight: '95%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowReceived_order").on('close', function () {
		reset_form_sparepart_orders();
	});

	$("#jqxSparepart_orderCancelButton").on('click', function () {
		reset_form_sparepart_orders();
		$('#jqxPopupWindowReceived_order').jqxWindow('close');
	});

});

function display_list(index){
	var row =  $("#jqxReceived_order").jqxGrid('getrowdata', index);
	if (row) {
		var recent_dispatchDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'order_no', type: 'number' },			
			{ name: 'bill_no', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'total_dispatched', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'dispatched_date', type: 'string' },
			{ name: 'grn_received_date', type: 'string' },
			{ name: 'available', type: 'bool' },
			],
			url: '<?php echo site_url("sparepart_orders/get_received_order_list")?>',
			data: {bill_no : row.bill_no, dispatched_date : row.dispatched_date},
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				recent_dispatchDataSource.totalrecords = data.total;
			},
			filter: function () {

			},
			sort: function () {
				$("#jqxGrid_Picklist_items").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};
		

		$("#jqxReceived_orderlist").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: recent_dispatchDataSource,
			altrows: true,
			pageable: true,
			sortable: true,
			rowsheight: 30,
			columnsheight:30,
			showfilterrow: false,
			filterable: false,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			selectionmode: 'none',
			editable: true,
			virtualmode: true,
			enableanimations: false,
			pagesizeoptions: pagesizeoptions,
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				// var container = $("<div style='margin: 5px; height:50px'></div>");
				// container.append($('#jqxReceived_orderlistToolbar').html());
				// toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_no',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatched_quantity"); ?>',datafield: 'total_dispatched',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});
		// openPopupWindow('jqxReceived_orderlist', 'Received Order');
		openPopupWindow('jqxPopupWindowReceived_order', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');


		// ---------------------------------
		// $.post('<?php echo site_url('sparepart_orders/get_received_order_list') ?>',{bill_no : row.bill_no, dispatched_date : row.dispatched_date},function(result)
		// {
		// 	$("#jqxReceived_orderlist").jqxGrid('clear')
		// 	$.each(result.rows,function(i,v){								
		// 		datarow = {
		// 			'name':v.name,
		// 			'part_code':v.part_code,
		// 			'total_dispatched' : v.total_dispatched,
		// 			'dispatched_date' : v.dispatched_date,
		// 			'order_no' : v.order_no,
		// 			'bill_no' : v.bill_no,
		// 			'sparepart_id' : v.sparepart_id,
		// 		};
		// 		$("#jqxReceived_orderlist").jqxGrid('addrow', null, datarow);
		// 	});
		// },'json');
	}
}



</script>

