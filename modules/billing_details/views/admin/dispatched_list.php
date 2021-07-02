<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('billing_details'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('billing_details'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridBilling_detailToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridBilling_detailInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridBilling_detailFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridBilling_detail"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowBilling_detail">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-billing_details', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "billing_details_id"/>
			<!-- <input type="hidden" name="dealer_id" id="dealer_id" value="<?php echo $dealer_id?>"> -->
            <table class="form-table">
				<tr>
					<td><label for='bill_no'><?php echo lang('bill_no')?></label></td>
					<td><div id='bill_no'></div></td>
					<td><label for='billed_date'><?php echo lang('billed_date')?></label></td>
					<td><div id='billed_date'></div></td>
					<!-- <td><label for='billed_time'><?php echo lang('billed_time')?></label></td>
					<td><input id='billed_time' class='text_input' name='billed_time'></td> -->
				</tr>
				<!-- <tr>
					<td><label for='billed_date_np'><?php echo lang('billed_date_np')?></label></td>
					<td><input id='billed_date_np' class='text_input' name='billed_date_np'></td>
				</tr> -->
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></td>
					<td><div id="dealer_id"></div></td>
					<!-- <td><label for='billed_to'><?php echo lang('billed_to')?></label></td> -->
					<!-- <td><div id='billed_to' class='number_general' name='billed_to'></div></td> -->
					<!-- <td><div id='billed_to' class='number_general' name='billed_to'></div></td> -->
				</tr>
				<!-- <tr>
					<td><label for='status'><?php echo lang('status')?></label></td>
					<td><input id='status' class='text_input' name='status'></td>
				</tr> -->
				<!-- <tr>
					<td class="col-md-2"><label>Barcode Scan</label></td>
					<td class="col-md-6"><input type = "text" class = "form-control" name = "barcode_partcode" id="scan_barcode_no_order"></td>
				</tr> -->
			</table>
			<div class="col-md-12">
				<div id="jqxGridPiList_no_Order"></div>
			</div>
			<br>
			<table>
				<!-- <tr>
					<td><label for='total_amt'><?php echo lang('total_amt')?></label></td>
					<td><input id='total_amt' class='text_input' name='total_amt'></td>
				</tr> -->
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxBilling_detailApproveButton">Approve</button>
                        <button type="button" class="btn btn-danger btn-xs btn-flat" id="jqxBilling_detailRejectButton">Reject</button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxBilling_detailCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	// var sparepart_dealerDataSource = {
	// 	url : '<?php echo site_url("admin/billing_lists/get_internal_billing_dealers_combo_json"); ?>',
	// 	datatype: 'json',
	// 	datafields: [
	// 	{ name: 'id', type: 'number' },
	// 	{ name: 'name', type: 'string' },
	// 	],
	// 	async: false,
	// 	cache: true
	// }

	// spareparts_dealerDataAdapter = new $.jqx.dataAdapter(sparepart_dealerDataSource);

	// $("#billed_to").jqxComboBox({
	// 	theme: theme,
	// 	width: 195,
	// 	height: 25,
	// 	selectionMode: 'dropDownList',
	// 	autoComplete: true,
	// 	searchMode: 'containsignorecase',
	// 	source: spareparts_dealerDataAdapter,
	// 	displayMember: "name",
	// 	valueMember: "id",
	// });

	var billing_detailsDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'bill_no', type: 'string' },
			{ name: 'billed_date', type: 'date' },
			{ name: 'billed_date_np', type: 'string' },
			{ name: 'billed_to', type: 'number' },
			{ name: 'billed_time', type: 'string' },
			{ name: 'status', type: 'string' },
			{ name: 'approved_date', type: 'date' },
			{ name: 'approved_date_np', type: 'string' },
			{ name: 'approved_time', type: 'string' },
			{ name: 'total_amt', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/billing_details/dispatched_list_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	billing_detailsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridBilling_detail").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridBilling_detail").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridBilling_detail").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: billing_detailsDataSource,
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
			container.append($('#jqxGridBilling_detailToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="viewBilling_detailRecord(' + index + '); return false;" title="View"><i class="fa fa-eye"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("billed_date"); ?>',datafield: 'billed_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("billed_date_np"); ?>',datafield: 'billed_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("billed_to"); ?>',datafield: 'billed_to',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("billed_time"); ?>',datafield: 'billed_time',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("status"); ?>',datafield: 'status',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("approved_date"); ?>',datafield: 'approved_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("approved_date_np"); ?>',datafield: 'approved_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("approved_time"); ?>',datafield: 'approved_time',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("total_amt"); ?>',datafield: 'total_amt',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridBilling_detail").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridBilling_detailFilterClear', function () { 
		$('#jqxGridBilling_detail').jqxGrid('clearfilters');
	});



	$("#jqxGridPiList_no_Order").jqxGrid({		
		theme: theme,
        width: '100%',
        height: gridHeight,
        sortable: true,
        rowsheight: 30,
        columnsheight: 30,
        // showfilterrow: true,
        filterable: true,
        columnsresize: true,
        autoshowfiltericon: true,
        selectionmode: 'singlecell',
        // showtoolbar: true,
		editable: true,
		showaggregates: true,
		showstatusbar: true,
		ready: function () {
			var rowsCount = $("#jqxGridPiList_no_Order").jqxGrid("getrows").length;
			for (var i = 0; i < rowsCount; i++) {
				var currentQuantity = $("#jqxGridPiList_no_Order").jqxGrid('getcellvalue', i, "dispatched_quantity");
				var currentPrice = $("#jqxGridPiList_no_Order").jqxGrid('getcellvalue', i, "price");
				var currentTotal = currentQuantity * currentPrice;
				$("#jqxGridPiList_no_Order").jqxGrid('setcellvalue', i, "total", currentTotal.toFixed(2));
			}
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false,editable:false},
		// {
		// 	text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, editable:false,align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
		// 	cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
		// 		var rows = $("#jqxGridPiList_no_Order").jqxGrid('getrowdata', index);
		// 		var e = '';
		// 		e += '<a href="javascript:void(0)" onclick="delete_order(' + index + '); return false;" title="Delete Item"><i class="fa fa-trash" aria-hidden="true"></i>';				
		// 		return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
		// 	}
		// },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width:150,  align: 'center' , cellsalign: 'left',filterable: false,editable:false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>',datafield: 'price',width:150, filterable: false,editable:false, align: 'center' , cellsalign: 'right' , cellsformat:'F2', renderer: gridColumnsRenderer},										
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width:200, filterable: false,cellsalign: 'right',renderer: gridColumnsRenderer,aggregates: ['sum'] },
		{
			text: 'Total Amount', datafield: 'total', sortable:false , width:200, filterable:false, align: 'center' , editable:false, cellsalign: 'right', 
			cellsrenderer: function (index) {
				var row = $("#jqxGridPiList_no_Order").jqxGrid('getrowdata', index);
				var e = row.price * row.quantity;
				return '<div style="text-align: right; margin-top: 8px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>';
			},
			aggregates: [{ 'Sum':
                function (aggregatedValue, currentValue, column, record) {
                	var price = parseFloat((record.hasOwnProperty("price"))?record.price:0);
                  	var quantity = parseFloat((record.hasOwnProperty("quantity"))?record.quantity:0);

                  	var row_total = (isNaN(price)?0:price) * (isNaN(quantity)?0:quantity);
                  	var total = parseFloat(row_total);
                  	var g_total = aggregatedValue + total;
                  	return g_total;
                }
        	}]
		},	

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});
	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridPiList_no_Order").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPiList_no_OrderFilterClear', function () { 
		$('#jqxGridPiList_no_Order').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridBilling_detailInsert', function () { 
		openPopupWindow('jqxPopupWindowBilling_detail', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowBilling_detail").jqxWindow({ 
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

    $("#jqxPopupWindowBilling_detail").on('close', function () {
        reset_form_billing_details();
    });

    $("#jqxBilling_detailCancelButton").on('click', function () {
        reset_form_billing_details();
        $('#jqxPopupWindowBilling_detail').jqxWindow('close');
    });

    /*$('#form-billing_details').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bill_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bill_no').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#billed_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#billed_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#billed_to', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#billed_to').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#billed_time', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#billed_time').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#status').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#approved_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#approved_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#approved_time', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#approved_time').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#total_amt', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#total_amt').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxBilling_detailApproveButton").on('click', function () {
	    var data = $("#form-billing_details").serialize();
		
		$('#jqxPopupWindowBilling_detail').block({ 
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
	        url: '<?php echo site_url("admin/billing_details/approve"); ?>',
	        data: data,
	        success: function (result) {
	            var result = eval('('+result+')');
	            if (result.success) {
	                reset_form_billing_details();
	                $('#jqxGridBilling_detail').jqxGrid('updatebounddata');
	                $('#jqxPopupWindowBilling_detail').jqxWindow('close');
	            }
	            $('#jqxPopupWindowBilling_detail').unblock();
	        }
	    });
    });

    $("#jqxBilling_detailRejectButton").on('click',function(){
    	var data = $("#form-billing_details").serialize();
		
		$('#jqxPopupWindowBilling_detail').block({ 
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
	        url: '<?php echo site_url("admin/billing_details/reject"); ?>',
	        data: data,
	        success: function (result) {
	            var result = eval('('+result+')');
	            if (result.success) {
	                reset_form_billing_details();
	                $('#jqxGridBilling_detail').jqxGrid('updatebounddata');
	                $('#jqxPopupWindowBilling_detail').jqxWindow('close');
	            }
	            $('#jqxPopupWindowBilling_detail').unblock();
	        }
	    });
    })

 //    $('#scan_barcode_no_order').keypress(function(e){
	// 	if(e.which == 13) 
	// 	{
	// 		var code = $('#scan_barcode_no_order').val();
	// 		var dealer_id = $('#dealer_list_no_order').val();
	// 		var ledger_id = $('#counter_sale-credit_account').val();
	// 		$('#no_order_dealer_id').val(dealer_id);
	// 		$.post('<?php echo site_url('admin/billing_details/set_barcode_values'); ?>',{code:code,dealer_id:dealer_id,ledger_id:ledger_id},function(result){
	// 			if (result.success == true) 
	// 			{
	// 				$("#jqxGridPiList_no_Order").jqxGrid('addrow', null, result.data);
	// 				$('#scan_barcode_no_order').val('');
	// 			}
	// 			else
	// 			{
	// 				alert(result.msg);
	// 			}
	// 		},'JSON');

	// 	}
	// });
});

function viewBilling_detailRecord(index){
    var row =  $("#jqxGridBilling_detail").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#jqxGridPiList_no_Order').jqxGrid('clear');
  		$.post('<?php echo site_url("admin/billing_lists/get_list_json")?>',{id:row.id},function(result){
  			$.each(result.rows,function(key,value){
  				$("#jqxGridPiList_no_Order").jqxGrid('addrow', null, value);
  			});
  		},'json');
  		$('#billing_details_id').val(row.id);
		$('#dealer_id').html( row.dealer_id);
		$('#bill_no').html(row.bill_no);
		var date = new Date(row.billed_date);
		$('#billed_date').html(date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate());
		$('#billed_date_np').val(row.billed_date_np);
		// $('#billed_to').jqxComboBox('val', row.billed_to);
		$('#billed_time').val(row.billed_time);
		$('#status').val(row.status);
		$('#total_amt').val(row.total_amt);

		if(row.status != '<?php echo PENDING;?>'){
			$('#jqxBilling_detailApproveButton').hide();
			$('#jqxBilling_detailRejectButton').hide();
		}else{
			$('#jqxBilling_detailApproveButton').show();
			$('#jqxBilling_detailRejectButton').show();
		}
		
        openPopupWindow('jqxPopupWindowBilling_detail', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveBilling_detailRecord(){
    var data = $("#form-billing_details").serialize();
    var item_data = $('#jqxGridPiList_no_Order').jqxGrid('getrows');
    var item_record = '';
    $.each(item_data,function(key,value){
    	$.each(value,function(k,v){
    		item_record += '&'+k+'[]='+v;
    	})
    });
    console.log(item_record);
    // console.log(data);
    // console.log(item_data);
    // console.log(encodeURI(JSON.stringify(item_data)));
    // return;
	
	$('#jqxPopupWindowBilling_detail').block({ 
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
        url: '<?php echo site_url("admin/billing_details/save"); ?>',
        data: data+item_record,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_billing_details();
                $('#jqxGridBilling_detail').jqxGrid('updatebounddata');
                $('#jqxPopupWindowBilling_detail').jqxWindow('close');
            }
            $('#jqxPopupWindowBilling_detail').unblock();
        }
    });
}

function reset_form_billing_details(){
	$('#billing_details_id').val('');
    $('#form-billing_details')[0].reset();
}
</script>