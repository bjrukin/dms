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
			<?php echo displayStatus(); ?>
			<div id='jqxGridMsil_orderToolbar' class='grid-toolbar'>
				<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridMsil_orderInsert"><?php echo lang('general_create'); ?></button>
				<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridMsil_orderFilterClear"><?php echo lang('general_clear'); ?></button>
			</div>			
			<div id="jqxGridMsil_order"></div>
		</div><!-- /.col -->
	</div>
	<!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="jqxPopupWindowMsil_order">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-msil_orders', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "msil_orders_id"/>
		<input type = "hidden" name = "firm_id" value="<?php echo $firm_id?>" />
		<table class="form-table">			
			<tr>
				<td><label for='unplanned_order'><?php echo lang('unplanned_order')?></label></td>
				<td><div id='unplanned_order'></div><input type="hidden" name='unplanned_order' id="unplanned_value"></td>
			</tr>
			<tr>
				<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
				<td><div id='vehicle_id' name='vehicle_id'></div></td>
			</tr>
			<tr>
				<td><label for='variant_id'><?php echo lang('variant_id')?></label></td>
				<td><div id='variant_id' name='variant_id'></div></td>
			</tr>
			<tr>
				<td><label for='color_id'><?php echo lang('color_id')?></label></td>
				<td><div id='color_id' name='color_id'></div></td>
			</tr>
			<tr>
				<td><label for='month'><?php echo lang('month')?></label></td>
				<td><div id='month' class='number_general' name='month'></div></td>
			</tr>
			<tr>
				<td><label for='year'><?php echo lang('year')?></label></td>
				<td><div id='year' class='number_general' name='year'></div></td>
			</tr>		
			<tr>
				<td><label for='order_id'><?php echo lang('order_id')?></label></td>
				<td><div id='order_id' class='number_general' name='order_id' value="<?php echo $order_id;?>"></div></td>
			</tr>		
			<tr class="order_quantity">
				<td><label for='quantity'><?php echo lang('quantity')?></label></td>
				<td><div id='quantity' class='number_general' name='quantity'></div></td>
			</tr>
			
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxMsil_orderSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxMsil_orderCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="jqxPopupWindowMsil_order_cancel">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Order Cancel</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-msil_order_cancel', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "msil_order_cancel_id"/>
		<table class="form-table">					
			<tr>
				<td><label for='cancel_quantity'><?php echo lang('cancel_quantity')?></label></td>
				<td><div id='cancel_quantity' class='number_general' name='cancel_quantity'></div></td>
			</tr>
			<tr>
				<td><label for='reason'><?php echo lang('reason')?></label></td>
				<td><textarea name="reason" style="height: 100px; width: 200px; border-radius: 5px" placeholder="Reason"></textarea></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxMsil_order_cancelSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxMsil_order_cancelCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<style type="text/css">
	.cls-red { background-color: #F56969; }
</style>

<script language="javascript" type="text/javascript">

	$(function(){
		$("#unplanned_order").jqxCheckBox({
			width: '300px',
			height: 25,
			theme: 'energyblue'
		});

		$('#unplanned_order').on('checked', function (event) {
			$('#unplanned_value').val(1);
			// $('.order_quantity').hide();
		});
		$('#unplanned_order').on('unchecked', function (event) {
			$('#unplanned_value').val(0);
			// $('.order_quantity').show();
		});

		$("#vehicle_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: array_vehicles,
			displayMember: "name",
			valueMember: "id",
		});
		$("#vehicle_id").bind('select', function (event) {

			if (!event.args)
				return;

			vehicle_id = $("#vehicle_id").jqxComboBox('val');

			var variantDataSource  = {
				url : '<?php echo site_url("admin/msil_orders/get_variants_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'variant_id', type: 'number' },
				{ name: 'variant_name', type: 'string' },
				],
				data: {
					vehicle_id: vehicle_id
				},
				async: false,
				cache: true
			}

			variantDataAdapter = new $.jqx.dataAdapter(variantDataSource, {autoBind: false});

			$("#variant_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: variantDataAdapter,
				displayMember: "variant_name",
				valueMember: "variant_id",
			});
		});

		$("#variant_id").bind('select', function (event) {

			if (!event.args)
				return;

			vehicle_id = $("#vehicle_id").jqxComboBox('val');
			variant_id = $("#variant_id").jqxComboBox('val');

			var colorDataSource  = {
				url : '<?php echo site_url("admin/msil_orders/get_colors_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'color_id', type: 'number' },
				{ name: 'color_name', type: 'string' },
				],
				data: {
					vehicle_id: vehicle_id,
					variant_id: variant_id
				},
				async: false,
				cache: true
			}

			colorDataAdapter = new $.jqx.dataAdapter(colorDataSource, {autoBind: false});
			$("#color_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: colorDataAdapter,
				displayMember: "color_name",
				valueMember: "color_id",
			});
		});


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
			{ name: 'cancel_quantity', type: 'number' },
			{ name: 'reason', type: 'string' },
			{ name: 'unplanned_order', type: 'number' },
			{ name: 'order_type', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/msil_orders/list_json"); ?>',
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
			container.append($('#jqxGridMsil_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},	
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editMsil_orderRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp';
				e += '<a href="javascript:void(0)" onclick="order_Cancel(' + index + '); return false;" title="Cancel Order"><i class="fa fa-ban"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},	
		{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname},
		{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("color_id"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("month"); ?>',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("order_id"); ?>',datafield: 'order_id',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("order_type"); ?>',datafield: 'order_type',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("cancel_quantity"); ?>',datafield: 'cancel_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
		{ text: '<?php echo lang("reason"); ?>',datafield: 'reason',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridMsil_order").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridMsil_orderFilterClear', function () { 
		$('#jqxGridMsil_order').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridMsil_orderInsert', function () { 
		openPopupWindow('jqxPopupWindowMsil_order', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowMsil_order").jqxWindow({ 
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

	$("#jqxPopupWindowMsil_order").on('close', function () {
		reset_form_msil_orders();
	});

	$("#jqxMsil_orderCancelButton").on('click', function () {
		reset_form_msil_orders();
		$('#jqxPopupWindowMsil_order').jqxWindow('close');
	});
	$("#jqxMsil_orderSubmitButton").on('click', function () {
		saveMsil_orderRecord();
	});

	$("#jqxPopupWindowMsil_order_cancel").jqxWindow({ 
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

	$("#jqxPopupWindowMsil_order_cancel").on('close', function () {
		reset_form_msil_order_cancel();
	});

	$("#jqxMsil_order_cancelCancelButton").on('click', function () {
		reset_form_msil_order_cancel();
		$('#jqxPopupWindowMsil_order_cancel').jqxWindow('close');
	});
	$("#jqxMsil_order_cancelSubmitButton").on('click', function () {
		saveMsil_order_cancel();
	});
});

function editMsil_orderRecord(index){
	var row =  $("#jqxGridMsil_order").jqxGrid('getrowdata', index);
	if (row) {
		console.log(row);
		$('#msil_orders_id').val(row.id);		
		$('#vehicle_id').jqxComboBox('val', row.vehicle_id);
		$('#variant_id').jqxComboBox('val', row.variant_id);
		$('#color_id').jqxComboBox('val', row.color_id);
		$('#month').jqxNumberInput('val', row.month);
		$('#year').jqxNumberInput('val', row.year);
		//$('#order_id').val('<?php echo $order_id;?>');
		$('#quantity').jqxNumberInput('val', row.quantity);
		
		openPopupWindow('jqxPopupWindowMsil_order', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveMsil_orderRecord(){
	var data = $("#form-msil_orders").serialize();
	
	$('#jqxPopupWindowMsil_order').block({ 
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
		url: '<?php echo site_url("admin/msil_orders/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_msil_orders();
				$('#jqxGridMsil_order').jqxGrid('updatebounddata');
				$('#jqxPopupWindowMsil_order').jqxWindow('close');
			}
			$('#jqxPopupWindowMsil_order').unblock();
		}
	});
}

function reset_form_msil_orders(){
	$('#msil_orders_id').val('');
	$('#form-msil_orders')[0].reset();
	$('#vehicle_id').jqxComboBox('clearSelection');
	$('#variant_id').jqxComboBox('clearSelection');
	$('#color_id').jqxComboBox('clearSelection');
}

function order_Cancel(index)
{
	var row =  $("#jqxGridMsil_order").jqxGrid('getrowdata', index);
	if (row) {
		console.log(row);
		$('#msil_order_cancel_id').val(row.id);				
		openPopupWindow('jqxPopupWindowMsil_order_cancel', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveMsil_order_cancel(){
	var data = $("#form-msil_order_cancel").serialize();
	
	$('#jqxPopupWindowMsil_order_cancel').block({ 
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
		url: '<?php echo site_url("admin/msil_orders/save_cancel_order"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_msil_order_cancel();
				$('#jqxGridMsil_order').jqxGrid('updatebounddata');
				$('#jqxPopupWindowMsil_order_cancel').jqxWindow('close');
			}
			$('#jqxPopupWindowMsil_order_cancel').unblock();
		}
	});
}

function reset_form_msil_order_cancel(){
	$('#msil_order_cancel_id').val('');
	$('#form-msil_order_cancel')[0].reset();
}

</script>