
<div class="row">
	<div class="col-xs-12 connectedSortable">
		<?php echo displayStatus(); ?>		
		<div id="jqxRecent_dispatch"></div>
	</div><!-- /.col -->
</div>
<div id="jqxPopupWindowAddGrn">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Add Grn</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-add_grn', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "sparepart_orders_no"/>
		<input type = "hidden" name = "dealer_id" id = "dealer_id"/>
		<input type = "hidden" name = "bill_no_hidden" id = "bill_no_hidden"/>
		<div class="row">
			<div class="col-md-2"><label for="order_no"><?php echo lang('order_no');?></label></div>
			<div class="col-md-4"><div id="order_no"></div></div>
			<div class="col-md-2"><label for="bill_no"><?php echo lang('bill_no');?></label></div>
			<div class="col-md-4"><div id="bill_no"></div></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for="dispatched_date"><?php echo lang('dispatched_date');?></label></div>
			<div class="col-md-4"><div id="dispatched_date"></div></div>
			<div class="col-md-2"><label for="received_date"><?php echo lang('received_date');?></label></div>
			<div class="col-md-4"><div id="received_date" name="received_date"></div></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="jqxRecent_dispatchlist"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSparepart_orderSubmitButton"><?php echo lang('general_save'); ?></button>
				<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSparepart_orderCancelButton"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>


<script language="javascript" type="text/javascript">

	$(function(){
		$("#received_date").jqxDateTimeInput({ width: '250px', height: '25px',formatString: "yyyy-MM-dd" });

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
			],
			url: '<?php echo site_url("admin/sparepart_orders/recent_dispatch_json");?>',
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
	    	$("#jqxRecent_dispatch").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxRecent_dispatch").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	

	$("#jqxRecent_dispatch").jqxGrid({
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
			container.append($('#jqxRecent_dispatchToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxRecent_dispatch").jqxGrid('getrowdata', index);
				var e = '';
				var e = '<a href="javascript:void(0)" onclick="add_grn(' + index + '); return false;" title="Add Grn"><i class="fa fa-plus"></i></a>';
				if(!row.grn_received_date)
				{
					var e = '<a href="javascript:void(0)" onclick="add_grn(' + index + '); return false;" title="Add Grn"><i class="fa fa-plus"></i></a>';
				}
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},

		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxRecent_dispatch").jqxGrid('refresh');}, 500);
	});

	// Dispatch List

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
	    	$("#jqxRecent_dispatchlist").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxRecent_dispatchlist").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	

	$("#jqxRecent_dispatchlist").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: recent_dispatchDataSource,
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
		editable: true,
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxRecent_dispatchlistToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'Available', datafield: 'available', columntype: 'checkbox', width: 70 },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_no',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_quantity"); ?>',datafield: 'total_dispatched',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("received_quantity"); ?>',datafield: 'received_quantity',editable: true,width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxRecent_dispatchlist").jqxGrid('refresh');}, 500);
	});



	$(document).on('click','#jqxRecent_dispatchFilterClear', function () { 
		$('#jqxRecent_dispatch').jqxGrid('clearfilters');
	});

	// initialize the popup window
	$("#jqxPopupWindowAddGrn").jqxWindow({ 
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

	$("#jqxPopupWindowAddGrn").on('close', function () {
		reset_form_sparepart_orders();
	});

	$("#jqxSparepart_orderCancelButton").on('click', function () {
		reset_form_sparepart_orders();
		$('#jqxPopupWindowAddGrn').jqxWindow('close');
	});

	$("#jqxSparepart_orderSubmitButton").on('click', function () {
		saveSparepart_orderRecord();        
	});
});

function add_grn(index){
	var row =  $("#jqxRecent_dispatch").jqxGrid('getrowdata', index);
	if (row) {
		$('#sparepart_orders_no').val(row.order_no);
		$('#bill_no_hidden').val(row.bill_no);
		$('#dealer_id').val(row.dealer_id);
		$('#order_no').html(row.order_no);
		$('#bill_no').html(row.bill_no);
		$('#dispatched_date').html(row.dispatched_date);		
		openPopupWindow('jqxPopupWindowAddGrn', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
		$.post('<?php echo site_url('sparepart_orders/get_recent_dispatch_list') ?>',{bill_no : row.bill_no},function(result)
		{
			$("#jqxRecent_dispatchlist").jqxGrid('clear')
			$.each(result.rows,function(i,v){								
				datarow = {
					'name':v.name,
					'part_code':v.part_code,
					'total_dispatched' : v.total_dispatched,
					'dispatched_date' : v.dispatched_date,
					'order_no' : v.order_no,
					'bill_no' : v.bill_no,
					'sparepart_id' : v.sparepart_id,
				};
				$("#jqxRecent_dispatchlist").jqxGrid('addrow', null, datarow);
			});
		},'json');
	}
}

function saveSparepart_orderRecord(){
	var rows = $('#jqxRecent_dispatchlist').jqxGrid('getrows');
	//var data = $("#form-add_grn").serialize();
	var dealer_id = $('#dealer_id').val();
	var bill_no = $('#bill_no_hidden').val();
	var order_no = $('#sparepart_orders_no').val();
	var received_date = $('#received_date').val();

	$('#jqxPopupWindowAddGrn').block({ 
		message: '<span>Processing your request. Please be patient.</span>',
		css: { 
			width                   : '75%',
			border                  : 'none', 
			padding                 : '50px', 
			backgroundColor         : '#000', 
			'-webkit-border-radius' : '10px', 
			'-moz-border-radius'    : '10px', 
			opacity                 : .7, 
			color                   : '#fff',
			cursor                  : 'wait' 
		}, 
	});

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/sparepart_orders/save_recent_dispatch"); ?>',
		data: {id : order_no,dealer_id:dealer_id,bill_no:bill_no,received_date:received_date,grid_data : rows},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_sparepart_orders();
				$('#jqxRecent_dispatch').jqxGrid('updatebounddata');
				$('#jqxPopupWindowAddGrn').jqxWindow('close');
			}
			$('#jqxPopupWindowAddGrn').unblock();
		}
	});
}

function reset_form_sparepart_orders(){
	$('#sparepart_orders_id').val('');
	$('#form-add_grn')[0].reset();
}

</script>

