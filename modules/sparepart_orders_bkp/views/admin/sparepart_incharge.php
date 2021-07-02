
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('sparepart_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('sparepart_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div id="error_pi" class="alert alert-danger" style="display: none;">
					<span>Dealer Has Not Confirmed PI Yet</span>
				</div>
			</div>
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div class="col-md-12">
					<button class="btn btn-warning btn-sm btn-flat" style="float: right;" onclick="OpenReceipt()">Add Receipt</button>
				</div>				
				<div id='jqxTabs'>
					<ul style='margin-left: 20px;'>
						<li>Spare-Parts Orders</li>
						<li>Perfoma Invoice </li>
						<li>Picking List </li>
						<li>Dispatch List </li>
						<li>Back Order List </li>
					</ul>
					<div>
						<div class="row">
							<div class="col-md-12">
								<div id="jqxGridSparepart_order"></div>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-md-12">
								<div id="jqxGridPI_indexed"></div>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-md-12">
								<?php echo $this->load->view( $this->config->item('template_admin') . "picking_list");?>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-md-12">
								<div id="jqxGridDispatchList"></div>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-md-12">
								<div id="jqxGridBacklogs"></div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->	
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSparepart_order">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-sparepart_orders', 'onsubmit' => 'return false')); ?>
		<input type = "text" name="barcode" id="barcode">
		<input type = "text" name="dispatch_quantity" id="dispatch_quantity" placeholder="Enter Quantity">
		<input type = "hidden" name="stocklist_id[]" id="stocklist_id">
		<table class = "form-table table table-striped" id="dispatchitemlist">
			<thead>
				<tr><th>Name</th><th>Part Code</th><th>Quantity</th><th>Price</th></tr>
			</thead>
			<tbody>			
			</tbody>
			<tfoot>	
				<tr>
					<td><div id="error_dispatchitemlist"></div></td>
				</tr>			
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSparepart_orderSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSparepart_orderCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</tfoot>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="jqxPopupWindowdispatch_list">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Upload Picklist</span>
	</div>
	<div class="form_fields_area">
		<span><h4>Upload Picklist File</h4></span>
		<form action="<?php echo site_url('admin/sparepart_orders/upload_picklist') ?>" id="order_form" method="post" enctype="multipart/form-data">		
			<input type="hidden" name="dealer_id_excel" id="dealer_id_excel">
			<input type="hidden" name="order_no_excel" id="order_no_excel">
			<input type="hidden" name="order_type_excel" id="order_type_excel">
			<input type="file" name="userfile" style="float: left;">
			<button type="submit">Import</button>
		</form>				
	</div>
</div>	
<div id="jqxPopupWindowreceipt">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Receipt</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-receipt', 'onsubmit' => 'return false')); ?>
		<table class="form-table">
			<tr>
				<td><label for="dealer"><?php echo lang('dealer_name') ?></label></td>
				<td><div id="jqxdealer_list_receipt" name="dealer_id" style="float: left;margin-right: 20px; margin-top: -5px"></div></td>
			</tr>
			<tr>
				<td><label for="receipt_date"><?php echo lang('receipt_date') ?></label></td>
				<td><div id="receipt_date" name="receipt_date" style="float: left;margin-right: 20px; margin-top: -5px"></div></td>
			</tr>
			<tr>
				<td><label for="receipt_no">Receipt No:</label></td>
				<td><input class="text_input" type="text" name="receipt_no" id="receipt_no"></td>
			</tr>
			<tr>
				<td><label for="amount">Amount :</label></td>
				<td><input class="text_input" type="text" name="debit_amount" id="amount"></td>
			</tr>						
			<tr>
				<th>
					<button type="submit" class="btn btn-success btn-flat  btn-md" id="jqxreceiptSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default  btn-flat btn-md" id="jqxreceiptCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>	
<div id="jqxPopupWindowPi_Confirm">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo lang('confirm_pi');?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-confirm_pi', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "pi_order_no" id = "pi_order_no"/>
		<input type = "hidden" name = "pi_dealer_id" id = "pi_dealer_id"/>
		<table class="form-table">
			<tr>
				<th colspan="4" style="text-align: center !important;">
					<button type="button" class="btn btn-success btn-lg" id="jqxPi_ConfirmSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-lg" id="jqxPi_ConfirmCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowOrder_cancel">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo lang('cancel_order');?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-cancel_order', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "order_no" id = "order_no"/>
		<input type = "hidden" name = "dealer_id" id = "cancel_dealer_id"/>
		<table class="form-table">
			<tr>
				<th colspan="4" style="text-align: center !important;">
					<button type="button" class="btn btn-danger btn-lg" id="jqxOrder_CancelSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-lg" id="jqxOrder_CancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="jqxPopupWindowUnavailable_list">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo "Unavailable Spareparts List"//lang('cancel_order');?></span>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="unavailable">				
			</div>
			<div id="error_msg" style="display: none;">All Spareparts are available</div>
		</div>
	</div>
</div>

<div id="jqxPopupWindowPicking_list">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo "Picklist"; ?></span>
	</div>
	<div class="form_fields_area">
		<form action="<?php echo site_url('admin/sparepart_orders/generate_picking_list') ?>" method="POST">
			<input type="hidden" name="picking_proforma_invoice_id" id="picking_proforma_invoice_id">
			<input type="hidden" name="picking_dealer_id" id="picking_dealer_id">
			<input type="hidden" name="picking_order_type" id="picking_order_type">
			<input type="hidden" name="picking_order_no" id="picking_order_no">
			<label for ='picker'>Picker</label>
			<div id="picker_id" name="picker_id"></div>
			<div class="row">
				<div class="col-md-12">
					<button type="submit" class="btn btn-success btn-sm" ><?php echo "Generate"//lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-sm" id="jqxPicking_listCancelButton"><?php echo lang('general_cancel'); ?></button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>



	<script type="text/javascript">
		$(document).ready(function () {
			$('#jqxTabs').jqxTabs({ width: 'auto', height: 'auto' });
			$("#receipt_date").jqxDateTimeInput({ width: '200px', height: '34px', formatString: "yyyy-MM-dd" });
		});
	</script>
	<script language="javascript" type="text/javascript">

		$(function(){

			var dealer_listSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'id' },
				{ name: 'name' }
				],
				url: '<?php echo site_url('admin/sparepart_orders/get_dealer_list') ?>',
				async: false
			};
			var dealer_listdataAdapter = new $.jqx.dataAdapter(dealer_listSource);
			$("#jqxdealer_list_receipt").jqxComboBox({ 
				selectedIndex: 0, 
				source: dealer_listdataAdapter, 
				displayMember: "name", 
				valueMember: "id", 
				width: 200, 
				height: 25,

			});

			var pickerSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'id' },
				{ name: 'first_name' }
				],
				url: '<?php echo site_url('admin/sparepart_orders/get_picker_list') ?>',
				async: false
			};

			var pickerdataAdapter = new $.jqx.dataAdapter(pickerSource);
			$("#picker_id").jqxComboBox({ 
				selectedIndex: 0, 
				source: pickerdataAdapter, 
				displayMember: "first_name", 
				valueMember: "id", 
				width: 200, 
				height: 25,

			});

			$("#jqxPopupWindowPi_Confirm").jqxWindow({ 
				theme: theme,
				width: '20%',
				maxWidth: '20%',
				height: '15%',  
				maxHeight: '15%',  
				isModal: true, 
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false 
			});

			$("#jqxPopupWindowPi_Confirm").on('close', function () {
			});

			$("#jqxPi_ConfirmCancelButton").on('click', function () {
				$('#jqxPopupWindowPi_Confirm').jqxWindow('close');
			});

			$("#jqxPi_ConfirmSubmitButton").on('click', function () {
				save_Confirm_Pi();
			});


			$("#jqxPopupWindowUnavailable_list").jqxWindow({ 
				theme: theme,
				width: '40%',
				maxWidth: '40%',
				height: '40%',  
				maxHeight: '40%',  
				isModal: true, 
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false 
			});

			$("#jqxPopupWindowUnavailable_list").on('close', function () {
			});

			$("#jqxPopupWindowOrder_cancel").jqxWindow({ 
				theme: theme,
				width: '20%',
				maxWidth: '20%',
				height: '15%',  
				maxHeight: '15%',  
				isModal: true, 
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false 
			});

			$("#jqxPopupWindowOrder_cancel").on('close', function () {
			});

			$("#jqxOrder_CancelButton").on('click', function () {
				$('#jqxPopupWindowOrder_cancel').jqxWindow('close');
			});
			$("#jqxOrder_CancelSubmitButton").on('click', function () {
				save_Order_Cancel();
			});


			var sparepart_orders_group_DataSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'id', type: 'number' },			
				{ name: 'sparepart_id', type: 'number' },
				{ name: 'order_quantity', type: 'number' },
				{ name: 'name', type: 'string' },
				{ name: 'part_code', type: 'string' },
				{ name: 'dealer_name', type: 'string' },
				{ name: 'order_no', type: 'number' },
				{ name: 'dealer_id', type: 'number' },
				{ name: 'order_concat', type: 'string' },
				{ name: 'pi_confirmed', type: 'number' },
				{ name: 'order_date', type: 'date' },
				{ name: 'order_date_np', type: 'string' },
				{ name: 'dispatch_mode', type: 'string' },
				{ name: 'order_type', type: 'string' },
				{ name: 'pi_status', type: 'string' },
				{ name: 'order_qty', type: 'number' },
				{ name: 'total_line_qty', type: 'number' },
				{ name: 'total_amount', type: 'number' },
				{ name: 'total_dispatched_quantity', type: 'number' },
				{ name: 'total_dispatched_amount', type: 'number' },

				],
				url: '<?php echo site_url("admin/sparepart_orders/incharge_json"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				cache: true,
				pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_orders_group_DataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSparepart_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepart_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepart_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepart_orders_group_DataSource,
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
		selectionmode: 'multiplecellsadvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSparepart_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row = $("#jqxGridSparepart_order").jqxGrid('getrowdata', index);
				var e = '<a href="<?php echo site_url('admin/sparepart_orders/order_list')?>/'+row.order_no+'/'+row.dealer_id+'/1" return false;" title="Order List" target="_blank"><i class="fa fa-list"></i></a> &nbsp';
				<?php //if(is_sparepart_incharge()):?>
				if(row.pi_confirmed == 0)
				{
					e += '<a href="javascript:void(0)" onclick="pi_confirm('+ row.order_no+','+row.dealer_id+')" title="PI Approve"><i class="fa fa-check"></i></a>&nbsp';
					e += '<a href="javascript:void(0)" onclick="cancel_order('+ row.order_no+','+row.dealer_id+')" title="PI Decline"><i class="fa fa-remove"></i></a>&nbsp';
				}
				<?php //endif; ?>
				e += '<a href="javascript:void(0)" onclick="unavailable_list('+ row.order_no+','+row.dealer_id+')" title="Incorrect Parts"><i class="fa fa-list-alt"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},		
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_concat',width: 80,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_date"); ?>',datafield: 'order_date',width: 90,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("order_date_np"); ?>',datafield: 'order_date_np',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatch_mode"); ?>',datafield: 'dispatch_mode',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_type"); ?>',datafield: 'order_type',width: 90,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pi_status"); ?>',datafield: 'pi_status',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_line_qty"); ?>',datafield: 'total_line_qty',width: 80,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_qty"); ?>',datafield: 'order_qty',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 120,filterable: true,cellsformat : 'F2', renderer: gridColumnsRenderer },
		/*{ text: '<?php echo lang("total_dispatched_quantity"); ?>',datafield: 'total_dispatched_quantity',width: 120,filterable: true, renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_dispatched_amount"); ?>',datafield: 'total_dispatched_amount',width: 120,filterable: true,cellsformat : 'F2', renderer: gridColumnsRenderer },*/
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});
	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepart_order").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepart_orderFilterClear', function () { 
		$('#jqxGridSparepart_order').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSparepart_orderInsert', function () { 
		openPopupWindow('jqxPopupWindowSparepart_order', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSparepart_order").jqxWindow({ 
		theme: theme,
		width: '75%',
		maxWidth: '75%',
		height: '75%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSparepart_order").on('close', function () {
		reset_form_sparepart_orders();
	});

	$("#jqxSparepart_orderCancelButton").on('click', function () {
		reset_form_sparepart_orders();
		$('#jqxPopupWindowSparepart_order').jqxWindow('close');
	});


	//debit receipt modal	
	$("#jqxPopupWindowreceipt").jqxWindow({
		theme: theme,
		width: '50%',
		maxWidth: '50%',
		height: '90%',
		maxHeight: '90%',
		isModal: true,
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false
	});

	$("#jqxPopupWindowreceipt").on('close', function () {
	});

	$("#jqxreceiptCancelButton").on('click', function () {
		$('#jqxPopupWindowreceipt').jqxWindow('close');
	});		

	$("#jqxreceiptSubmitButton").on('click', function () {
		save_Receipt();
	});


	$("#jqxSparepart_orderSubmitButton").on('click', function () {
		saveSparepart_orderRecord();      
	});


});

function editSparepart_orderRecord(index){
	var row =  $("#jqxGridPI_indexed").jqxGrid('getrowdata', index);
	console.log(row);
	if (row) {
		$('#sparepart_orders_id').val(row.id);	
		$('#dealer_id').val(row.created_by);		
		openPopupWindow('jqxPopupWindowSparepart_order', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSparepart_orderRecord(){
	var data = $("#form-sparepart_orders").serialize();
	
	/*$('#jqxPopupWindowSparepart_order').block({ 
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
	});*/

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/sparepart_orders/save_dispatch_order"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_sparepart_orders();
				$('#jqxGridSparepart_order').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSparepart_order').jqxWindow('close');
			}
			$('#jqxPopupWindowSparepart_order').unblock();
		}
	});
}

function reset_form_sparepart_orders(){
	$('#sparepart_orders_id').val('');
	$('#form-sparepart_orders')[0].reset();
}
</script>
<script type="text/javascript">
	$(function(){
		var PI_indexed_DataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'dealer_id', type: 'number' },			
			{ name: 'dealer_name', type: 'string' },
			{ name: 'proforma_invoice_id', type: 'number' },
			{ name: 'order_no', type: 'number' },
			{ name: 'order_concat', type: 'string' },
			{ name: 'order_type', type: 'string' },
			{ name: 'pi_number', type: 'string' },
			{ name: 'order_qty', type: 'number' },
			{ name: 'total_line_qty', type: 'number' },
			{ name: 'total_amount', type: 'number' },
			{ name: 'pi_generated_date_time', type: 'date' },
			{ name: 'remarks', type: 'string' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/pi_indexed_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	PI_indexed_DataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPI_indexed").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPI_indexed").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPI_indexed").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: PI_indexed_DataSource,
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
		editable: true,
		selectionmode: 'multiplecellsadvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridPI_indexedToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', editable:false, renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ 
			text: 'Action', datafield: 'action', width:75, sortable:false , editable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center',	cellsrenderer: function (index,b,c,d,e,data) {
				//var e = '<a href="javascript:void(0)" onclick="dispatched_list_upload(' + index + '); return false;" title="Import Barcode File"><i class="fa fa-edit"></i></a>';
				
				var e = '<a target="_blank" href="<?php echo site_url('admin/sparepart_orders/dispatch_left_log'); ?>/'+ data.order_no +'/'+ data.dealer_id +'" title="BackLogs"> <i class="fa fa-list-alt"></i> </a> &nbsp';
				var f = '<a href="javascript:void(0)" onclick="generate_picking_list(' + index + '); return false;" title="Generate Pickinglist"><i class="fa fa-th-list"></i></a> &nbsp';
				//var g = '<a href="<?php echo site_url('admin/sparepart_orders/picking_list') ?>" title="Picking List" target="_blank" ><i class="fa fa-outdent"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + f  + '</div>';
				
			}
		},
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 250 , editable:false,filterable: true,renderer: gridColumnsRenderer },		
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_concat',width: 80 , editable:false,filterable: true,renderer: gridColumnsRenderer },		
		{ text: '<?php echo lang("order_type"); ?>',datafield: 'order_type',width: 100 , editable:false,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("proforma_invoice_id"); ?>',datafield: 'pi_number',width: 100 , editable:false,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pi_generated_date_time"); ?>',datafield: 'pi_generated_date_time',width: 130 , editable:false,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("total_line_qty"); ?>',datafield: 'total_line_qty',width: 80 , editable:false,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_qty"); ?>',datafield: 'order_qty',width: 90 , editable:false,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 100 , editable:false,filterable: true,cellsformat : 'f', renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 300 , editable:true,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		} 
	});

	$("#jqxPopupWindowdispatch_list").jqxWindow({ 
		theme: theme,
		width: '30%',
		maxWidth: '30%',
		height: '20%',  
		maxHeight: '20%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowdispatch_list").on('close', function () {
	});

	$("#jqxPopupWindowPicking_list").jqxWindow({ 
		theme: theme,
		width: '40%',
		maxWidth: '40%',
		height: '40%',  
		maxHeight: '40%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowPicking_list").on('close', function () {
	});

	$("#jqxPicking_listCancelButton").on('click', function () {
		$('#jqxPopupWindowPicking_list').jqxWindow('close');
	});

	$("#jqxPicking_listSubmitButton").on('click', function () {
		save_Picklist();      
	});

	// Back Order Grid
	var sparepart_ordersDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'sparepart_id', type: 'number' },
		{ name: 'order_quantity', type: 'number' },
		{ name: 'name', type: 'string' },
		{ name: 'part_code', type: 'string' },
		{ name: 'total_backorder', type: 'number' },
		{ name: 'dealer_name', type: 'string' },
		],
		url: '<?php echo site_url("admin/sparepart_orders/back_log"); ?>',
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
	    	$("#jqxGridBacklogs").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridBacklogs").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridBacklogs").jqxGrid({
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
		selectionmode: 'multiplecellsadvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,		
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridDealer_backlogToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},					
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_backorder"); ?>',datafield: 'total_backorder',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum'] },	 
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridBacklogs").jqxGrid('refresh');}, 500);
	});

	// Recent Dispatch List
	var sparepart_ordersDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'order_no', type: 'number' },			
		{ name: 'bill_no', type: 'number' },
		{ name: 'proforma_invoice_id', type: 'number' },
		{ name: 'dealer_id', type: 'number' },
		{ name: 'dispatched_date', type: 'date' },
		{ name: 'grn_received_date', type: 'date' },
		{ name: 'pi_number', type: 'string' },
		{ name: 'dealer_name', type: 'string' },
		{ name: 'total_dispatched_amount', type: 'number' },
		{ name: 'total_dispatched_quantity', type: 'number' },
		{ name: 'order_concat', type: 'string' },
		{ name: 'bill_concat', type: 'string' },
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
	    	$("#jqxGridDispatchList").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDispatchList").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	

	$("#jqxGridDispatchList").jqxGrid({
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
			container.append($('#jqxGridDispatchListToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxGridDispatchList").jqxGrid('getrowdata', index);
				var e = '';
				var e = '<a href="javascript:void(0)" onclick="display_items(' + index + '); return false;" title="Display Dispatched Items"><i class="fa fa-th-list"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},

		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_concat',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_concat',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pi_number"); ?>',datafield: 'pi_number',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',width: 120,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("grn_received_date"); ?>',datafield: 'grn_received_date',width: 140,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("total_dispatched_quantity"); ?>',datafield: 'total_dispatched_quantity',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_dispatched_amount"); ?>',datafield: 'total_dispatched_amount',width: 150,filterable: true,cellsformat:'F2', renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDispatchList").jqxGrid('refresh');}, 500);
	});
});

function dispatched_list_upload(index)
{
	var row =  $("#jqxGridPI_indexed").jqxGrid('getrowdata', index);
	$('#dealer_id_excel').val(row.dealer_id);
	$('#order_no_excel').val(row.order_no);
	$('#order_type_excel').val(row.order_type);

	openPopupWindow('jqxPopupWindowdispatch_list', '<?php echo lang("confirm_pi")  . "&nbsp;" .  $header; ?>');	
}

function generate_picking_list(index)
{
	var row =  $("#jqxGridPI_indexed").jqxGrid('getrowdata', index);
	$('#picking_proforma_invoice_id').val(row.proforma_invoice_id);
	$('#picking_dealer_id').val(row.dealer_id);
	$('#picking_order_type').val(row.order_type);
	$('#picking_order_no').val(row.order_no);

	openPopupWindow('jqxPopupWindowPicking_list', '<?php echo lang("confirm_pi")  . "&nbsp;" .  $header; ?>');	
}
</script>

<script type="text/javascript">
	function OpenReceipt() 
	{
		openPopupWindow('jqxPopupWindowreceipt', '<?php echo "Delivery Sheet" . "&nbsp;" .  $header; ?>');
	}

	function save_Receipt()
	{
		var data = $("#form-receipt").serialize();

		$('#jqxPopupWindowreceipt').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/save_receipt"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					reset_form_receipt();
					$('#jqxPopupWindowreceipt').jqxWindow('close');						
				}
				$('#jqxPopupWindowreceipt').unblock();
				location.reload();

			}
		});
		function reset_form_receipt()
		{
			$('#vehicle_process_id').val('');
			$('#form-receipt')[0].reset();
		}
	}

	function cancel_order(order_no,dealer_id)
	{
		$('#order_no').val(order_no);
		$('#cancel_dealer_id').val(dealer_id);
		openPopupWindow('jqxPopupWindowOrder_cancel', '<?php echo lang("cancel_order")  . "&nbsp;" .  $header; ?>');
	}

	function save_Order_Cancel()
	{
		var data = $("#form-cancel_order").serialize();

		$('#jqxPopupWindowOrder_cancel').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/cancel_order"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {				
					$('#jqxGridSparepart_order').jqxGrid('updatebounddata');
					$('#jqxPopupWindowOrder_cancel').jqxWindow('close');
				}
				$('#jqxPopupWindowOrder_cancel').unblock();
			}
		});
	}

	function pi_confirm(order_no,dealer_id)
	{	
		$('#pi_order_no').val(order_no);
		$('#pi_dealer_id').val(dealer_id);
		openPopupWindow('jqxPopupWindowPi_Confirm', '<?php echo lang("confirm_pi")  . "&nbsp;" .  $header; ?>');
	}

	function save_Confirm_Pi(){
		var data = $("#form-confirm_pi").serialize();

		$('#jqxPopupWindowPi_Confirm').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/save_pi"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {				
					$('#jqxPopupWindowPi_Confirm').jqxWindow('close');
					$('#jqxGridSparepart_order').jqxGrid('updatebounddata');
				}
				else
				{
					$('#error_pi').delay(500).fadeIn('normal', function() {
						$(this).delay(1000).fadeOut();
					});
					$('#jqxPopupWindowPi_Confirm').jqxWindow('close');
				}
				$('#jqxPopupWindowPi_Confirm').unblock();
			}
		});
	}

	function unavailable_list(order_no,dealer_id)
	{
		openPopupWindow('jqxPopupWindowUnavailable_list', '<?php echo lang("confirm_pi")  . "&nbsp;" .  $header; ?>');
		$('#unavailable').html('');
		$('#error_msg').hide();
		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/sparepart_orders/generate_unavailable_list"); ?>',
			data: {order_no : order_no, dealer_id:dealer_id},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {				
					$.each(result.unavailable_parts,function(i,v)
					{
						$('#unavailable').append('<div class="list">'+v+'</div>')
					});
				}
				else
				{
					$('#error_msg').show();
				}
			}
		});
	}

	function save_Picklist()
	{
		var data = $("#form-picking_list").serialize();

		$('#jqxPopupWindowPicking_list').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/generate_picking_list"); ?>',
			data: data,
			datatype : 'html',
			success: function (result) {
				$('#jqxGridPI_indexed').jqxGrid('updatebounddata');
				$('#jqxPopupWindowPicking_list').jqxWindow('close');
				$('#jqxPopupWindowPicking_list').unblock();
			}
		});
	}

	$('#jqxGridPI_indexed').on('cellvaluechanged', function (event) {
	var rowBoundIndex = event.args.rowindex;
	var rowdata = $('#jqxGridPI_indexed').jqxGrid('getrowdata', rowBoundIndex);
	$.post('<?php echo site_url('admin/sparepart_orders/update_pi_remarks') ?>',{proforma_invoice_id : rowdata.proforma_invoice_id, remarks:rowdata.remarks},function(result)
	{
		if(result.success)
		{
			alert('Successfully Updated');
		}

	});

});

</script>