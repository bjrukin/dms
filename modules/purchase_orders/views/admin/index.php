<!-- <link href="<?php echo base_url()?>assets/css/uploader_style.css" rel="stylesheet" type="text/css"> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ajaxuploader.js"></script>
<style>
	.styled-select.slate {
		/*background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;*/
		height: 33px;
		width: 480px;
	}

	.inputfile + label {
		font-size: 12px;
		font-weight: 100;
		color: white;
		background-color: grey;
		padding: 0.625rem 1.25rem;
		/*display: inline-block;*/
	}

	.inputfile:focus + label,
	.inputfile + label:hover {
		background-color: cadetblue;
	}
	.material-icons {
		vertical-align: bottom;
		font-size: 17px;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('purchase_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('purchase_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPurchase_orderToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPurchase_orderInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPurchase_orderFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridPurchase_order"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPurchase_order">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Purchase Order</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-purchase_orders', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "purchase_orders_id"/>
		<div class="row">
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-6" >
						<?php echo lang('order_date','order_date')?>
						<div id='order_date' class='date_box form-control' name='order_date'></div>

					</div>
					<div class="col-md-6">
						<?php echo lang('order_no','order_no')?>
						<div id='order_no' class='number_general form-control' name='order_no'></div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php echo lang('ledger','ledger')?>
						<div id="ledger"  class="number_general"  name="ledger"></div>
					</div>
					<div class="col-md-6" >
						<?php echo lang('parts_group','parts_group')?>
						<select id="parts_group" name="parts_group" class="form-control" style="margin:5px;"><!-- styled-select slate -->
							<option value="parts">Parts Group</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" >
						<?php echo lang('order_type','order_type')?>
						<select id="order_type" name="order_type" class="form-control" style="margin:5px;">
							<option>Select</option>
							<option value="STOCK">STOCK</option>
							<option value="VOR">VOR</option>
						</select>
					</div>
					<div class="col-md-6">
						<label for='job_no'>Job No</label>
						<div id='job_no' class='number_general' name='job_no'></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" >
						<?php echo lang('dispatch_mode','dispatch_mode')?>
						<select id="dispatch_mode" name="dispatch_mode" class="form-control" style="margin:5px;">
							<option value="Dispatch">Dispatch Mode</option>
						</select>
					</div>
				</div>



				<!-- end -->
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="6" >
						<!-- <input id='tax_method' class='text_input' name='tax_method'> -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" > <a href="#" role="tab"   data-toggle="tab" onclick="man('rol','sugg_qty')">Manual</a></li>
							<li role="presentation" class="active"><a href="#" role="tab" value="0" data-toggle="tab" onclick="con('rol')">Consumption Based</a></li>
							<li role="presentation"><a href="#" role="tab"  value="0" data-toggle="tab"   onclick="rol('sugg_qty')">Re-order Level Based</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for='multiples_of_moq'><input type="checkbox" id="multiples_of_moq" name="multiples_of_moq" value="1"><?php echo lang('multiples_of_moq')?></label>
					</div> 
					<div class="col-md-12">
						<label for='exclude_nonzero_rol'><input type="checkbox" id="exclude_nonzero_rol" name="exclude_nonzero_rol" value="1"><?php echo lang('exclude_nonzero_rol')?></label>
					</div>
					<div class="col-md-12">
						<label for='include_nonzero_rol' hidden><input type="checkbox" id="include_nonzero_rol" name="include_nonzero_rol" value="1"><?php echo lang('include_nonzero_rol')?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" >
						<label for='sale_dateto'><?php echo lang('sale_dateto')?></label>
						<div id='sale_dateto' class='date_box' name='sale_dateto'></div>
					</div>

					<div class="col-md-6" >
						<label for='sale_dateform'><?php echo lang('sale_dateform')?></label>
						<div id='sale_dateform' class='date_box' name='sale_dateform'></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for='stock_required_day'><?php echo lang('stock_required_day')?></label>
						<div id='stock_required_day' class='number_general' name='stock_required_day'></div>
					</div>
					<div class="col-md-6">
						<button class="btn-sm default">Refresh</button>
					</div>
				</div>

				<!-- end -->
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">

				<div id='jqxGridPurchase_basedToolbar' class='grid-toolbar'>
					<!-- <p>Items Details </p> -->
					<div>
						<button id="purchase_based" type="button" class="btn btn-flat btn-sm">Add New</button>
					</div>
				</div>
				<div id="jqxGridPurchase_based"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<label for='total_items'>Total Item</label>
				<input id='total_items' class='text_input' name='total_items'>
			</div>
			<div class="col-md-4">
				<label for='suggestive_amount'>Suggestive  Amount</label>
				<input id='suggestive_amount' class='text_input' name='suggestive_amount'>
			</div>
			<div class="col-md-4">
				<label for='order_amount'>Order Amount</label>
				<input id='order_amount' class='text_input' name='order_amount'>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label>Remarks</label>
				<textarea id='remark' name='remark' class="form-control" placeholder="Remarks"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div>
					<label for="print"><input type="checkbox" name="print" id="print">Print After Save</label>
					<div class="btn-group btn-group-sm" role="group" aria-label="...">
						<button class="btn btn-default" onclick="window.print()">Print</button>
						<a href="<?php echo site_url('purchase_baseds/export') ?>" class="btn btn-default" >Export</a> 
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="pull-right">
					<div class="btn-group btn-group-sm" role="group" aria-label="actions">

						<button class="btn btn-default">New</button>&nbsp
						<button type="button" class="btn btn-success" id="jqxPurchase_orderSubmitButton"><?php echo lang('general_save'); ?></button>&nbsp
						<button type="button" class="btn btn-default " id="jqxPurchase_orderCancelButton"><?php echo lang('general_cancel'); ?></button>&nbsp
						<button class="btn btn-default ">Delete</button>
						<button class="btn btn-default ">Exit</button>
					</div>
				</div>

			</div>
		</div>

		<?php echo form_close(); ?>
	</div>

<!-- 	<form method="post" enctype="multipart/form-data">
		<input name="image" id="image" class='text_input' style="display:none"/>
		<input type="file" id="image_upload" name="userfile" style="display:block"/>
		  <button type="submit" class="btn btn-default" id="import" value="submit" >Import</button> &nbsp 
		</form> -->
	</div>

</div>
<div id="jqxPopupWindowPurchase_based">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-purchase_baseds', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "purchase_baseds_id"/>
		<table class="form-table">




			<tr>
				<td><label for='part_no'>Part No</label></td>
				<td><div id='part_no' class='number_general' name='part_no'></div></td>
			</tr>
			<tr>
				<td><label for='description'>Description</label></td>
				<td><input id='description' class='text_input' name='description' readonly></td>
			</tr>
			<tr id="add_rol" hidden>
				<td><label for='rol'>ROL</label></td>
				<td><div id='rol' class='number_general' name='rol'></div></td>
			</tr>
			<tr>
				<td><label for='po_qty'>P.O Qty</label></td>
				<td><div id='po_qty' class='number_general' name='po_qty'></div></td>
			</tr>
			<tr>
				<td><label for='ord_qty'>Order Qty</label></td>
				<td><div id='ord_qty' class='number_general' name='ord_qty'></div></td>
			</tr>
			<tr>
				<td><label for='sold_qty'>Sold Qty</label></td>
				<td><div id='sold_qty' class='number_general' name='sold_qty'></div></td>
			</tr>
			<tr>
				<td><label for='stck_qty'>Stock Qty</label></td>
				<td><div id='stck_qty' class='number_general' name='stck_qty'></div></td>
			</tr>
			<tr>
				<td><label for='tran_stk'>Tran Stock</label></td>
				<td><div id='tran_stk' class='number_general' name='tran_stk'></div></td>
			</tr>
			<tr id="add_sugg_qty" >
				<td><label for='sugg_qty'>Sugg Qty</label></td>
				<td><div id='sugg_qty' class='number_general' name='sugg_qty'></div></td>
			</tr>
			<tr>
				<td><label for='price'>Price</label></td>
				<td><div id='price' class='number_general' name='price'></div></td>
			</tr>
			<!-- <tr>
				<td><label for='amount'>Amount</label></td>
				<td><div id='amount' class='number_general' name='amount'></div></td>
			</tr> -->
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPurchase_basedSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPurchase_basedCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		// uploadReady();
	});
	var ledgerAdapter;
	$(function(){

		var purchase_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'order_date', type: 'date' },
			{ name: 'order_no', type: 'number' },
			{ name: 'ledger', type: 'string' },
			{ name:'job_no',type:'string'},
			{ name: 'parts_group', type: 'string' },
			{ name: 'order_type', type: 'string' },
			{ name: 'dispatch_mode', type: 'string' },
			{ name: 'multiples_of_moq', type: 'string' },
			{ name: 'exclude_nonzero_rol', type: 'string' },
			{ name: 'include_nonzero_rol', type: 'string' },
			{ name: 'sale_dateto', type: 'date' },
			{ name: 'sale_dateform', type: 'date' },
			{ name: 'stock_required_day', type: 'number' },
			{ name: 'total_items', type: 'number' },
			{ name: 'suggestive_amount', type: 'number' },
			{ name: 'order_amount', type: 'number' },
			{ name: 'remark', type: 'string' },

			],
			url: '<?php echo site_url("admin/purchase_orders/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			//callback called when a page or page size is changed.
		},
		beforeprocessing: function (data) {
			purchase_ordersDataSource.totalrecords = data.total;
		},
		// update the grid and send a request to the server.
		filter: function () {
			$("#jqxGridPurchase_order").jqxGrid('updatebounddata', 'filter');
		},
		// update the grid and send a request to the server.
		sort: function () {
			$("#jqxGridPurchase_order").jqxGrid('updatebounddata', 'sort');
		},
		processdata: function(data) {
		}
	};
	
	$("#jqxGridPurchase_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: purchase_ordersDataSource,
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
			container.append($('#jqxGridPurchase_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editPurchase_orderRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_date"); ?>',datafield: 'order_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("ledger"); ?>',datafield: 'ledger',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("job_no"); ?>',datafield: 'job_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("parts_group"); ?>',datafield: 'parts_group',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_type"); ?>',datafield: 'order_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatch_mode"); ?>',datafield: 'dispatch_mode',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("multiples_of_moq"); ?>',datafield: 'multiples_of_moq',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("exclude_nonzero_rol"); ?>',datafield: 'exclude_nonzero_rol',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("include_nonzero_rol"); ?>',datafield: 'include_nonzero_rol',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("sale_dateto"); ?>',datafield: 'sale_dateto',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("sale_dateform"); ?>',datafield: 'sale_dateform',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("stock_required_day"); ?>',datafield: 'stock_required_day',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_items"); ?>',datafield: 'total_items',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("suggestive_amount"); ?>',datafield: 'suggestive_amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_amount"); ?>',datafield: 'order_amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remark"); ?>',datafield: 'remark',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridPurchase_order").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridPurchase_orderFilterClear', function () { 
	$('#jqxGridPurchase_order').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridPurchase_orderInsert', function () { 
	openPopupWindow('jqxPopupWindowPurchase_order', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowPurchase_order").jqxWindow({ 
		theme: theme,
		width: '85%',
		maxWidth: '85%',
		height: '75%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowPurchase_order").on('close', function () {
		reset_form_purchase_orders();
	});

	$("#jqxPurchase_orderCancelButton").on('click', function () {
		reset_form_purchase_orders();
		$('#jqxPopupWindowPurchase_order').jqxWindow('close');
	});



	$("#jqxPurchase_orderSubmitButton").on('click', function () {
		savePurchase_orderRecord();
		/*
		var validationResult = function (isValid) {
				if (isValid) {
				   savePurchase_orderRecord();
				}
			};
		$('#form-purchase_orders').jqxValidator('validate', validationResult);
		*/
	});
});

var ledgercount =
{
	datatype: "json",
	datafields: [
	{ name: 'id',type: 'string'},
	{ name: 'full_name',type: 'string'},

	],
	url: '<?php echo site_url('purchase_invoices/get_ledger')?>'
};

ledgerAdapter = new $.jqx.dataAdapter(ledgercount);

$("#ledger").jqxComboBox({
	theme: theme,
	width: 195,
	height: 25,
	selectionMode: 'dropDownList',
	autoComplete: true,
	searchMode: 'containsignorecase',
	source: ledgerAdapter,
	displayMember: "full_name",
	valueMember: "id",
});
function editPurchase_orderRecord(index){
	var row =  $("#jqxGridPurchase_order").jqxGrid('getrowdata', index);

	var id= row.id;

	if (row) {
		$('#purchase_orders_id').val(row.id);
  //       $('#created_by').jqxNumberInput('val', row.created_by);
		// $('#updated_by').jqxNumberInput('val', row.updated_by);
		// $('#deleted_by').jqxNumberInput('val', row.deleted_by);
		// $('#created_at').val(row.created_at);
		// $('#updated_at').val(row.updated_at);
		// $('#deleted_at').val(row.deleted_at);
		$('#order_date').jqxDateTimeInput('setDate', row.order_date);
		$('#order_no').jqxNumberInput('val', row.order_no);
		$('#ledger').jqxNumberInput('val', row.order_no);
		$('#parts_group').val(row.parts_group);
		$('#order_type').val(row.order_type);
		$('#dispatch_mode').val(row.dispatch_mode);
		$('#multiples_of_moq').val(row.multiples_of_moq);
		$('#exclude_nonzero_rol').val(row.exclude_nonzero_rol);
		$('#include_nonzero_rol').val(row.include_nonzero_rol);
		$('#sale_dateto').jqxDateTimeInput('setDate', row.sale_dateto);
		$('#sale_dateform').jqxDateTimeInput('setDate', row.sale_dateform);
		$('#stock_required_day').jqxNumberInput('val', row.stock_required_day);
		$('#total_items').jqxNumberInput('val', row.total_items);
		$('#suggestive_amount').jqxNumberInput('val', row.suggestive_amount);
		$('#order_amount').jqxNumberInput('val', row.order_amount);
		$('#job_no').jqxNumberInput('val',row.job_no);
		$('#remark').val(row.remark);
		
		$.post("<?php echo site_url('admin/purchase_baseds/get_based')?>",{id:id},function(data){
			
			
			
			$.each(data,function(key,val){
				// console.log(val);
				var id 				=val.id;
				var part_no 				=	val.part_no;
				var description 			=	val.description;
				var rol  					= 	val.rol;
				var po_qty 					=	val.po_qty;
				var ord_qty 				=	val.ord_qty;
				var sold_qty 				= 	val.sold_qty;
				var stck_qty 				=	val.stck_qty;
				var tran_stk 				=	val.tran_stk;
				var sugg_qty 				=	val.sugg_qty;
				var price 					=	val.price;
				var amount 					=	val.amount;

				var datarow = {

					'id'						:id,
					'part_no'					:part_no,
					'description'				:description,
					'rol'						:rol,
					'po_qty'   					:po_qty,
					'ord_qty'     				:ord_qty,
					'sold_qty'         			:sold_qty,
					'stck_qty'      			:stck_qty,
					'tran_stk'         			:tran_stk,
					'sugg_qty' 					:sugg_qty,
					'price'							:price,
					'amount'						:amount,
				};



				
				$('#jqxGridPurchase_based').jqxGrid('addrow', null, datarow);
				cal_cash_calculate();


			});


		},'json');
		
		openPopupWindow('jqxPopupWindowPurchase_order', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function savePurchase_orderRecord(){
   // var data = $("#form-purchase_orders").serialize();
   var purchase_based =JSON.stringify($("#jqxGridPurchase_based").jqxGrid('getrows'));
   console.log(purchase_based);
   var data = $("#form-purchase_orders").serialize() + '&purchase_based=' + purchase_based;
   $('#jqxPopupWindowPurchase_order').block({ 
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
   	url: '<?php echo site_url("admin/purchase_orders/save"); ?>',
   	data: data,
   	success: function (result) {
   		var result = eval('('+result+')');
   		if (result.success) {
   			reset_form_purchase_orders();
   			$('#jqxGridPurchase_order').jqxGrid('updatebounddata');
   			$('#jqxPopupWindowPurchase_order').jqxWindow('close');
   		}
   		$('#jqxPopupWindowPurchase_order').unblock();
   	}
   });
}

function reset_form_purchase_orders(){
	$('#purchase_orders_id').val('');
	$('#form-purchase_orders')[0].reset();
}

function uploadReady()
{
		// alert();
		uploader=$('#image_upload');

		new AjaxUpload(uploader, {
			action: '<?php  echo site_url('admin/purchase_baseds/upload_image')?>',
			name: 'userfile',
			responseType: "json",

			onSubmit: function(file, ext){

	  // $.post("<?php echo site_url('admin/purchase_baseds/upload_image')?>",function(data){



		 // },'json');

		},
		onComplete: function(file,data){
			if(data.error==null){
				$.each(data,function(key,val){
					console.log(val);
					var part_no 				=	val.part_no;
					var description 			=	val.description;
					var rol  					= 	val.rol;
					var po_qty 					=	val.po_qty;
					var ord_qty 				=	val.ord_qty;
					var sold_qty 				= 	val.sold_qty;
					var stck_qty 				=	val.stck_qty;
					var tran_stk 				=	val.tran_stk;
					var sugg_qty 				=	val.sugg_qty;
					var price 					=	val.price;
					var amount 					=	val.amount;

					var datarow = {


						'part_no'					:part_no,
						'description'				:description,
						'rol'						:rol,
						'po_qty'   					:po_qty,
						'ord_qty'     				:ord_qty,
						'sold_qty'         			:sold_qty,
						'stck_qty'      			:stck_qty,
						'tran_stk'         			:tran_stk,
						'sugg_qty' 					:sugg_qty,
						'price'							:price,
						'amount'						:amount,
					};




					$('#jqxGridPurchase_based').jqxGrid('addrow', null, datarow);
					cal_cash_calculate();


				});

			}
			else
			{
				$.messager.show({title: '<?php  echo lang('error')?>',msg: response.error});                
			}
		}       
	});     
	}
</script>


<script language="javascript" type="text/javascript">
	var partsAdapter;
	var count;
	$(function(){


		var purchase_basedsDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			
			{ name: 'part_no', type: 'number' },
			{ name: 'description', type: 'string' },
			{ name: 'rol', type: 'number' },
			{ name: 'po_qty', type: 'number' },
			{ name: 'ord_qty', type: 'number' },
			{ name: 'sold_qty', type: 'number' },
			{ name: 'stck_qty', type: 'number' },
			{ name: 'tran_stk', type: 'number' },
			{ name: 'sugg_qty', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'amount', type: 'number' },
			
			],
		//url: '<?php echo site_url("admin/purchase_baseds/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
			//callback called when a page or page size is changed.
		},
		beforeprocessing: function (data) {
			purchase_basedsDataSource.totalrecords = data.total;
		},
		// update the grid and send a request to the server.
		filter: function () {
			$("#jqxGridPurchase_based").jqxGrid('updatebounddata', 'filter');
		},
		// update the grid and send a request to the server.
		sort: function () {
			$("#jqxGridPurchase_based").jqxGrid('updatebounddata', 'sort');
		},
		processdata: function(data) {
		},
		updaterow: function (rowid, rowdata) {
		  // synchronize with the server - send update command   
		}
	};
	var partsource =
	{
		datatype: "json",
		datafields: [
		{ name: 'id',type: 'string'},
		{ name: 'part_code',type: 'string'},
		{ name: 'name', type: 'string'},
		{ name: 'price', type: 'string'},
		],
		url: '<?php echo site_url('purchase_orders/get_spareparts_combo_json')?>'
	};

	partsAdapter = new $.jqx.dataAdapter(partsource);

	var countsource={
		datatype:"json",
		datafields:[
		{name:'count',type:'string'},
		],
		url: '<?php echo site_url('purchase_orders/get_order_combo_json')?>'
	};
	countAdapter = new $.jqx.dataAdapter(countsource);

	$("#jqxGridPurchase_based").jqxGrid({
		theme: theme,
		width: '100%',
		height: '250px',
		source: purchase_basedsDataSource,
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
		editable: false,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridPurchase_basedToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="deletePurchase_basedRecord(' + index + '); return false;" title="Edit"><i class="fa fa-trash"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		// { text: 'ID',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },

		{ text: 'Part No.',datafield: 'part_no', columntype: 'dropdownlist', width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Description',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },

		{ text: 'ROL',datafield: 'rol',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'P.O Qty',datafield: 'po_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },

		{ 
			text: 'Ord Qty',
			datafield: 'ord_qty',
			width: 150,
			filterable: true,

			columntype: 'numberinput', 
			cellbeginedit: false,

			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {

				if (newvalue != oldvalue) {

					var price = $("#jqxGridPurchase_based").jqxGrid('getcellvalue', row, "price");

					var total;
					total =(price * newvalue);




					$("#jqxGridPurchase_based").jqxGrid('setcellvalue', row, "amount", (total).toFixed(2));

					cal_cash_calculate(newvalue,price);


				};

			}


		},
		{ text: 'Sold Qty',datafield: 'sold_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Stock Qty',datafield: 'stck_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Tran Stock',datafield: 'tran_stk',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Sugg Qty',datafield: 'sugg_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ 
			text: 'Price',
			datafield: 'price',
			width: 150,
			filterable: true,

			columntype: 'numberinput', 
			cellbeginedit: false,

			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {

				if (newvalue != oldvalue) {

					var quantity = $("#jqxGridPurchase_based").jqxGrid('getcellvalue', row, "ord_qty");

					var total;
					total =(newvalue * quantity);




					$("#jqxGridPurchase_based").jqxGrid('setcellvalue', row, "amount", (total).toFixed(2));

					cal_cash_calculate(newvalue,quantity);


				};

			}

		},
		{
			text: 'Amount',
			datafield: 'amount',
			width: 150,
			filterable: true,
			renderer: gridColumnsRenderer,
			editable:false,

			columntype: 'numberinput', 
			cellbeginedit: true, 
			aggregates: 
			[{ 
				'<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;

					$('#amount input[name=amount]').val(total);

					cal_cash_calculate();
					return total;
				}


			}]
		},

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});
	$("#part_no").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: partsAdapter,
		displayMember: "part_code",
		valueMember: "id",
	});


	$("#po_qty").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
			//selectionMode: 'text_input',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: countAdapter,
			displayMember: "count",
			valueMember: "count",
		});



	$("#part_no").bind('select', function(event)
	{
		if (event.args)
		{
			indexToSelect = event.args.index;


			$("#price").val(partsAdapter.records[indexToSelect].price);

		}
	});




});

$(document).on('click','#purchase_based', function () { 
		// Job_form_table.jqxGrid('clear');
		openPopupWindow('jqxPopupWindowPurchase_based', '<?php echo lang("general_add")  . "&nbsp;" .  lang("item"); ?>');
	});
$("#jqxPopupWindowPurchase_based").jqxWindow({ 
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



$('#jqxPurchase_basedSubmitButton').click(function(){
	var part_no =$('#part_no').val();
	var description = $('#description').val();
	var rol = $('#rol').val();
	var po_qty = $('#po_qty').val();
	var ord_qty = $('#ord_qty').val()
	var sold_qty = $('#sold_qty').val();
	var stck_qty = $('#stck_qty').val();
	var tran_stk = $('#tran_stk').val();
	var sugg_qty = $('#sugg_qty').val();
	var price = $('#price').val();
	var amount = $('#amount').val();
	var datarow = {
		'part_no'			:part_no,
		'description'		:description,
		'rol'				:rol,
		'po_qty'   			:po_qty,
		'ord_qty'     		:ord_qty,
		'sold_qty'         	:sold_qty,
		'stck_qty'      	:stck_qty,
		'tran_stk'         	:tran_stk,
		'sugg_qty' 			:price,
		'price'				:price,
		'amount'			:amount,

	};
	console.log(datarow);  
	$('#jqxGridPurchase_based').jqxGrid('addrow', null, datarow);

	$('#jqxPopupWindowPurchase_based').jqxWindow('close');
	cal_cash_calculate();

});


$("#ord_qty").change(function(){
	var quantity = ($.isNumeric($("#ord_qty").val()))?$("#ord_qty").val():0;
	var price = ($.isNumeric($("#price").val()))?$("#price").val():0;


	var amount = (price * quantity) ;

	$('#amount').val(amount);
});


function cal_cash_calculate(price,quantity) {

	var total = (price*quantity);
	
	$('#total_items').val(total);

	
	$('#order_amount').val(total);
}

function deletePurchase_basedRecord(index){
	var row =  $("#jqxGridPurchase_based").jqxGrid('getrowdata', index);

	var id= row.id;
	$.post("<?php  echo site_url('admin/purchase_baseds/delete')?>", {id:id}, function(){
		$('#jqxGridPurchase_based').jqxGrid('deleterow', index);
			//$('#jqxPopupWindowPurchase_orders').jqxWindow('close');
		});
}

function man(column_name){
	console.log("sdf");
	$("#jqxGridPurchase_based").jqxGrid('hidecolumn', column_name);

	$('label[for=multiples_of_moq]').show();
	$('label[for=exclude_nonzero_rol]').hide();
	$('label[for=include_nonzero_rol]').hide();

	$('#exclude_nonzero_rol').prop('checked', false)
	$('#include_nonzero_rol').prop('checked', false)
	
	$('label[for=suggestive_amount]').hide();
	$("#suggestive_amount").hide();

	$("#add_sugg_qty").hide();
	$("#add_rol").hide();

}
function con(column_name){
	$("#jqxGridPurchase_based").jqxGrid('hidecolumn', column_name);

	$('label[for=exclude_nonzero_rol]').show();
	$('label[for=multiples_of_moq]').show();
	$('label[for=include_nonzero_rol]').hide();

	$('#include_nonzero_rol').prop('checked', false)

	
	$('label[for=suggestive_amount]').show();
	$("#suggestive_amount").show();

	$("#add_sugg_qty").show();
	$("#add_rol").hide();


}
function rol(column_name){
	$("#jqxGridPurchase_based").jqxGrid('hidecolumn', column_name);

	$('label[for=multiples_of_moq]').show();
	$('label[for=exclude_nonzero_rol]').hide();
	$('label[for=include_nonzero_rol]').show();

	$('#exclude_nonzero_rol').prop('checked', false)

	$('label[for=suggestive_amount]').hide();
	$("#suggestive_amount").hide();

	$("#add_sugg_qty").hide();
	$("#add_rol").show();
}


	// function showcolumn(column_name){
	// 	$("#jqxGridPurchase_based").jqxGrid('showcolumn', column_name);
	// }

	$(document).ready(function()
	{
		$("#order_type").change(function() {
			if($(this).val() == "VOR") {
				$("#job_no").show();
				$("#dispatch_mode").show();


			}
			else {
				$("#job_no").hide();
				$("#dispatch_mode").hide();

			}
		});


	});


</script>