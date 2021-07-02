<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('local_purchases'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('local_purchases');  ?></li>
		</ol>
	</section>
	<?php echo displayStatus(); ?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-9">
				<div class="box">
					<div class="box-body">
						<!-- row -->
						<div class="row">
							<div class="col-xs-12 connectedSortable">
								<div id='jqxGridLocal_purchaseToolbar' class='grid-toolbar'>
									<?php if(is_admin()) : ?>
										<form action="<?php echo base_url('dealer_stocks/local_purchase_insert') ?>" method="post" enctype="multipart/form-data">
											<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
											<div class="col-md-2"><button>Read</button></div>
										</form>
									<?php endif ; ?>
									<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridLocal_purchaseInsert"><?php echo lang('general_create'); ?></button>
									<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridLocal_purchaseFilterClear"><?php echo lang('general_clear'); ?></button>
								</div>
								<h4>List of purchases</h4>
								<div id="jqxGridLocal_purchase"></div>
							</div><!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
				</div>
			</div>
			<!-- </div> -->
			<!-- <div class="row"> -->
				<div class="col-md-3">
					<div class="box">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Parts Added List</h4>
									<div class=""  style="height:464px; overflow-y: scroll;overflow-x: hidden;  ">
										<table class="table table-responsive table-striped">
											<thead>
												<tr>
													<th>Part Code</th>
													<th>Part Name</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($added_parts as $value): ?>
													<tr>
														<td><?php echo $value->part_code ?></td>
														<td><?php echo $value->name ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<div id="jqxPopupWindowLocal_purchase">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title"></span>
		</div>
		<div class="form_fields_area">
			<?php echo form_open('', array('id' =>'form-local_purchases', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "id" id = "local_purchases_id"/>
			<table class="form-table">
				<tr>
					<td><label for='invoice_no'><?php echo lang('invoice_no')?></label></td>
					<td><input id='invoice_no' class='text_input' name='invoice_no'></td>
					<td><label for='challan'><?php echo 'Challan No.' ?></label></td>
					<td><input id='challan_no' class='text_input' name='challan_no'></td>
					<td><label for='party_name'><?php echo lang('party_name')?></label></td>
					<td><input id='party_name' class='text_input' name='party_name'></td>
				</tr>
				<tr>
					<td><label for='purchased_date'><?php echo lang('purchased_date')?></label></td>
					<td><div id='purchased_date' class='date_box' name='purchased_date'></div></td>
					<td><label for='total_amount'><?php echo lang('total_amount')?></label></td>
					<td><div id='total_amount' class='number_currency' name='total_amount'></div></td>
				</tr>
				<tr>
					<td colspan="6">
						<div id="jqxGrid_product_list"></div>
					</td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxLocal_purchaseSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxLocal_purchaseCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>

			</table>
			<?php echo form_close(); ?>
		</div>
	</div>

	<div id="jqxPopupWindowLocal_purchase_list">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Purchase List</span>
		</div>
		<div id="purchase_list"></div>
	</div>

	<div id="jqxPopupWindowLocal_purchase_invoice_edit">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Invoice Edit</span>
			<?php echo form_open('', array('id' =>'form-local_purchases_invoice_edit', 'onsubmit' => 'return false')); ?>
			<div>
				<input type = "hidden" name = "id" id = "local_purchases_id_invoice_edit"/>
				<table class="form-table">
					<tr>
						<td><label for='invoice_no_edit'><?php echo lang('invoice_no')?></label></td>
						<td><input id='invoice_no_edit' class='text_input' name='invoice_no'></td>
					</tr>

					<tr>
						<th colspan="2">
							<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPopupWindowLocal_purchase_listSubmitButton"><?php echo lang('general_save'); ?></button>
							<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPopupWindowLocal_purchase_listCancelButton"><?php echo lang('general_cancel'); ?></button>
						</th>
					</tr>
				</table>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	<script language="javascript" type="text/javascript">

		$(function(){

			var local_purchasesDataSource =
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
				{ name: 'invoice_no', type: 'string' },
				{ name: 'challan_no', type: 'string' },
				{ name: 'dealer_id', type: 'number' },
				{ name: 'party_name', type: 'string' },
				{ name: 'purchased_date', type: 'date' },
				{ name: 'purchased_date_np', type: 'string' },
				{ name: 'total_amount', type: 'string' },

				],
				url: '<?php echo site_url("admin/local_purchases/json"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				cache: true,
				pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	local_purchasesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridLocal_purchase").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridLocal_purchase").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridLocal_purchase").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: local_purchasesDataSource,
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
			container.append($('#jqxGridLocal_purchaseToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="Purchase_list(' + index + '); return false;" title="View Detail List"><i class="fa fa-eye"></i></a>';
				e += ' | <a href="javascript:void(0)" onclick="print_preview(' + index + '); return false;" title="Print Detail List"><i class="fa fa-print"></i></a>';
				e += ' | <a href="javascript:void(0)" onclick="editInvoiceNumber(' + index + '); return false;" title="Edit Invoice Number"><i class="fa fa-pencil"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("invoice_no"); ?>',datafield: 'invoice_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo 'Challan No'; ?>',datafield: 'challan_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("party_name"); ?>',datafield: 'party_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("purchased_date"); ?>',datafield: 'purchased_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("purchased_date_np"); ?>',datafield: 'purchased_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridLocal_purchase").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridLocal_purchaseFilterClear', function () { 
		$('#jqxGridLocal_purchase').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridLocal_purchaseInsert', function () { 
		openPopupWindow('jqxPopupWindowLocal_purchase', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowLocal_purchase").jqxWindow({ 
		theme: theme,
		width: '90%',
		maxWidth: '90%',
		height: '90%',  
		maxHeight: '90%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowLocal_purchase").on('close', function () {
		reset_form_local_purchases();
	});

	$("#jqxLocal_purchaseCancelButton").on('click', function () {
		reset_form_local_purchases();
		$('#jqxPopupWindowLocal_purchase').jqxWindow('close');
	});

	$("#jqxPopupWindowLocal_purchase_list").jqxWindow({ 
		theme: theme,
		width: '90%',
		maxWidth: '90%',
		height: '90%',  
		maxHeight: '90%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowLocal_purchase_list").on('close', function () {
	});
	$("#jqxPopupWindowLocal_purchase_invoice_edit").jqxWindow({ 
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

	$("#jqxPopupWindowLocal_purchase_invoice_edit").on('close', function () {
	});
	$("#jqxPopupWindowLocal_purchase_listCancelButton").on('click', function () {
		// reset_form_local_purchases();
		$('#jqxPopupWindowLocal_purchase_invoice_edit').jqxWindow('close');
	});

	$('#form-local_purchases').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [
		// { 
		// 	input: '#invoice_no', message: 'Required', action: 'blur', 
		// 	rule: function(input) {
		// 		val = $('#invoice_no').val();
		// 		return (val == '' || val == null || val == 0) ? false: true;
		// 	}
		// },

		{ 
			input: '#party_name', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#party_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		{ 
			input: '#total_amount', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#total_amount').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},
		{ 
			input: '#jqxGrid_product_list', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#jqxGrid_product_list').jqxGrid('getrows');
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		]
	});

	$("#jqxLocal_purchaseSubmitButton").on('click', function () {
		var validationResult = function (isValid) {
			if (isValid) {
				saveLocal_purchaseRecord();
			}
		};
		$('#form-local_purchases').jqxValidator('validate', validationResult);

	});

	$('#jqxPopupWindowLocal_purchase_listSubmitButton').click(function(){
		var id = $('#local_purchases_id_invoice_edit').val();
		var invoice = $('#invoice_no_edit').val();
		$.post('<?php echo site_url('admin/local_purchases/editInvoice') ?>',{id:id,invoice:invoice},function(result){
			if(result.success){
				$('#jqxPopupWindowLocal_purchase_invoice_edit').jqxWindow('close');
				$('#jqxGridLocal_purchase').jqxGrid('updatebounddata');
			}

		},'json');


	});

	var validateLocalPurchases = function(datafield, value) {
		if( value.length < 5 ) {
			return false;
		}

		if( value.match(/\s/g) !== null ) {
			return false;
		}
 
		switch(datafield){ 
			case "partcode":
			var switchervar = true;
			var added_parts = '<?php echo json_encode($added_parts); ?>';
			added_parts = $.parseJSON(added_parts);
			
			$.each(added_parts, function(i,v){
				if ( value === v.part_code ) {
					switchervar = false;
					return false;
				}
			});

			var gridData = $('#jqxGrid_product_list').jqxGrid('getrows');

			$.each(gridData, function(i,v){
				if( value === v.partcode ){
					switchervar = false;
					return false;
				}
			});

			return switchervar;
			break;

			default:
			return true;
			break;
		}

	}


	var source =
	{
		datafields:
		[
		{ name: 'partname', type: 'string' },
		{ name: 'partcode', type: 'string' },
		{ name: 'quantity', type: 'number' },
		{ name: 'price', type: 'number' },
		{ name: 'selling_price', type: 'number' }
		],
		datatype: "array"
	};
	var dataAdapter = new $.jqx.dataAdapter(source);
	$("#jqxGrid_product_list").jqxGrid(
	{
		width: '100%',
		filterable: true,
		source: dataAdapter,
		showeverpresentrow: true,
		everpresentrowposition: "top",
		everpresentrowactions: "add reset",
		editable: true,
		selectionmode: 'multiplecellsadvanced',
		showaggregates: true,
		showstatusbar: true,
		columns: [
		// { text: 'Partcode', datafield: 'partcode',  cellsalign: 'right', width: 220, validateEverPresentRowWidgetValue: validateLocalPurchases,  },
		// { text: 'Partcode', datafield: 'partcode',  cellsalign: 'right', width: 220  },\
		{ text: 'Action', datafield: 'action', width:100, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index,a,b,c,d,data) {
				var e = '';
				// e += '<a href="javascript:void(0)" onclick="edit_outside_work(' + index + '); return false;" title="<?php echo lang('edit_outsidework')?>"><i class="fa fa-edit"></i></a>&nbsp';
				e += '<a href="javascript:void(0)" onclick="delete_local_purchase('+index+')" title="<?php echo lang('delete_outsidework')?>"><i class="fa fa-trash"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>'; }
		},
		{ 
			text: 'Partcode', datafield: 'partcode', editable: true,  width: 300, 
			cellvaluechanging: function (row, datafield, columntype,oldValue, value) {
				
				find_db_Value(value, row);
			}, 
		},
		{ text: 'Partname', datafield: 'partname',  cellsalign: 'right', width: 220 },
		{ text: 'Qty.', datafield: 'quantity', filtertype: 'number',  cellsalign: 'right', width: 150 ,
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var price = parseFloat($('#jqxGrid_product_list').jqxGrid('getcellvalue', row, "price"));
					
					var total;

					total = price * newvalue;

					$("#jqxGrid_product_list").jqxGrid('setcellvalue', row, "final_amount", (total).toFixed(2));
				};
			}
		},
		{ text: 'Unit Price', datafield: 'price', cellsalign: 'right', width: 150,
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var qty = parseFloat($('#jqxGrid_product_list').jqxGrid('getcellvalue', row, "quantity"));
					
					var total;

					total = qty * newvalue;

					$("#jqxGrid_product_list").jqxGrid('setcellvalue', row, "final_amount", (total).toFixed(2));
				};
			},
			aggregates: [{ 
				'<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;
					// $('#total_amount').val(total);
					return total
				}
			}]  
		},
		{ text: 'Unit Selling Price', datafield: 'selling_price', cellsalign: 'right', width: 150},
		
		{ text: 'Final Price', datafield: 'final_amount', filtertype: 'number',  cellsalign: 'right', width: 150 ,
			aggregates: [{ 
				'<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;
					$('#total_amount').val(total);
					return total
				}
			}]
		},

		// { 
		// 	text: '<?php echo 'Unit Price'; ?>', datafield: 'price', width: '10%', filterable: true, renderer: gridColumnsRenderer,  editable: true, cellsalign: 'right',
		// 	aggregates: [{ 
		// 		'<b>Total</b>':
		// 		function (aggregatedValue, currentValue, column, record) {
		// 			var total = currentValue;
		// 			total = aggregatedValue + total;

		// 			console.log('here'+total);

		// 			return total;
		// 		}
		// 	}]                  
		// },
		]
	});
});

function find_db_Value(value , row){
	$.post('<?php echo site_url('admin/local_purchases/find_db_Value'); ?>',{part_code: value},function(result){
		console.log(result);
		if(result.success){
			if(row+1) {
				$('#jqxGrid_product_list').jqxGrid('setcellvalue', row, "partcode", result.dealer_stock.part_code);
				$('#jqxGrid_product_list').jqxGrid('setcellvalue', row, "price", result.dealer_stock.dealer_price);
				$('#jqxGrid_product_list').jqxGrid('setcellvalue', row, "partname",""+result.dealer_stock.name+"");
			}
			
			return false;
			$("#jqxGrid_product_list").jqxGrid('updatebounddata');
		}

	},'json');
}

function delete_local_purchase(index)
{
	if(confirm('Are you sure want to delete ?')){
		var id = $('#jqxGrid_product_list').jqxGrid('getrowid',index);
		$('#jqxGrid_product_list').jqxGrid('deleterow', id);
		
	}else{
		return false;
	}
}

function editInvoiceNumber(index)
{
	var row =  $("#jqxGridLocal_purchase").jqxGrid('getrowdata', index);
	if (row) {
		// console.log(row);
		$('#local_purchases_id_invoice_edit').val(row.id);
		$('#invoice_no_edit').val(row.invoice_no);
	}
		openPopupWindow('jqxPopupWindowLocal_purchase_invoice_edit');

}

function Purchase_list(index){
	var row =  $("#jqxGridLocal_purchase").jqxGrid('getrowdata', index);
	if (row) {
		var Detailpurchase_DataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'quantity', type: 'number' },
			{ name: 'price', type: 'number' },
			],
			url: '<?php echo site_url("admin/local_purchases/get_detailed_list"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			data : {purchase_id: row.id},
			cache: true,
		};
		var Detailpruchase_dataAdapter = new $.jqx.dataAdapter(Detailpurchase_DataSource);

		$("#purchase_list").jqxGrid(
		{
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: Detailpruchase_dataAdapter,
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
			enableanimations: false,
			pagesizeoptions: pagesizeoptions,
			showtoolbar: true,
			showaggregates: true,	
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'Part Code', datafield: 'part_code', width: 150 },
			{ text: 'Part Name', datafield: 'name', width: 150 },
			{ text: 'Quantity', datafield: 'quantity', width: 200 },
			{ text: 'Unit Price', datafield: 'price', width: 200 },
			]
		});

		openPopupWindow('jqxPopupWindowLocal_purchase_list');
	}
}

function saveLocal_purchaseRecord(){
	var data = getFormData("form-local_purchases");
	var rows = $('#jqxGrid_product_list').jqxGrid('getrows');

	$('#jqxPopupWindowLocal_purchase').block({ 
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
		url: '<?php echo site_url("admin/local_purchases/save"); ?>',
		data: {data:data, grid:rows },
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_local_purchases();
				$('#jqxGridLocal_purchase').jqxGrid('updatebounddata');
				$('#jqxPopupWindowLocal_purchase').jqxWindow('close');
			}
			$('#jqxPopupWindowLocal_purchase').unblock();
		}
	});
}

function reset_form_local_purchases(){
	$('#local_purchases_id').val('');
	$('#form-local_purchases')[0].reset();
}

function getFormData(formId) {
	return $('#' + formId).serializeArray().reduce(function (obj, item) {
		var name = item.name,
		value = item.value;

		if (obj.hasOwnProperty(name)) {
			if (typeof obj[name] == "string") {
				obj[name] = [obj[name]];
				obj[name].push(value);
			} else {
				obj[name].push(value);
			}
		} else {
			obj[name] = value;
		}
		return obj;
	}, {});
}
</script>

<script type="text/javascript">
	function print_preview(index) {
		console.log(index);
		var row = $("#jqxGridLocal_purchase").jqxGrid('getrowdata', index);
		var url = '<?php echo site_url('local_purchases/print_preview?id=') ?>' + row.id;


		myWindow = window.open(url, "height=900,width=1300");

		myWindow.document.close(); 

		myWindow.focus();
		myWindow.print();
	}
</script>