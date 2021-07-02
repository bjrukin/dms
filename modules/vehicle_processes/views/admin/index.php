<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('vehicle_processes'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('vehicle_processes'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridVehicle_processToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridVehicle_processInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridVehicle_processFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridVehicle_process"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowVehicle_process">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-vehicle_processes', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "vehicle_processes_id"/>
            <table class="form-table">
				<tr>
					<td><label for='created_by'><?php echo lang('created_by')?></label></td>
					<td><div id='created_by' class='number_general' name='created_by'></div></td>
				</tr>
				<tr>
					<td><label for='updated_by'><?php echo lang('updated_by')?></label></td>
					<td><div id='updated_by' class='number_general' name='updated_by'></div></td>
				</tr>
				<tr>
					<td><label for='deleted_by'><?php echo lang('deleted_by')?></label></td>
					<td><div id='deleted_by' class='number_general' name='deleted_by'></div></td>
				</tr>
				<tr>
					<td><label for='created_at'><?php echo lang('created_at')?></label></td>
					<td><input id='created_at' class='text_input' name='created_at'></td>
				</tr>
				<tr>
					<td><label for='updated_at'><?php echo lang('updated_at')?></label></td>
					<td><input id='updated_at' class='text_input' name='updated_at'></td>
				</tr>
				<tr>
					<td><label for='deleted_at'><?php echo lang('deleted_at')?></label></td>
					<td><input id='deleted_at' class='text_input' name='deleted_at'></td>
				</tr>
				<tr>
					<td><label for='customer_id'><?php echo lang('customer_id')?></label></td>
					<td><div id='customer_id' class='number_general' name='customer_id'></div></td>
				</tr>
				<tr>
					<td><label for='booked_date'><?php echo lang('booked_date')?></label></td>
					<td><div id='booked_date' class='date_box' name='booked_date'></div></td>
				</tr>
				<tr>
					<td><label for='payment_mode'><?php echo lang('payment_mode')?></label></td>
					<td><input id='payment_mode' class='text_input' name='payment_mode'></td>
				</tr>
				<tr>
					<td><label for='receipt_type'><?php echo lang('receipt_type')?></label></td>
					<td><input id='receipt_type' class='text_input' name='receipt_type'></td>
				</tr>
				<tr>
					<td><label for='receipt_no'><?php echo lang('receipt_no')?></label></td>
					<td><div id='receipt_no' class='number_general' name='receipt_no'></div></td>
				</tr>
				<tr>
					<td><label for='amount'><?php echo lang('amount')?></label></td>
					<td><input id='amount' class='text_input' name='amount'></td>
				</tr>
				<tr>
					<td><label for='receipt_date'><?php echo lang('receipt_date')?></label></td>
					<td><div id='receipt_date' class='date_box' name='receipt_date'></div></td>
				</tr>
				<tr>
					<td><label for='quotation_issue_flag'><?php echo lang('quotation_issue_flag')?></label></td>
					<td><div id='quotation_issue_flag' class='number_general' name='quotation_issue_flag'></div></td>
				</tr>
				<tr>
					<td><label for='quotation_issue_date'><?php echo lang('quotation_issue_date')?></label></td>
					<td><div id='quotation_issue_date' class='date_box' name='quotation_issue_date'></div></td>
				</tr>
				<tr>
					<td><label for='do_flag'><?php echo lang('do_flag')?></label></td>
					<td><div id='do_flag' class='number_general' name='do_flag'></div></td>
				</tr>
				<tr>
					<td><label for='do_received_date'><?php echo lang('do_received_date')?></label></td>
					<td><div id='do_received_date' class='date_box' name='do_received_date'></div></td>
				</tr>
				<tr>
					<td><label for='downpayment_flag'><?php echo lang('downpayment_flag')?></label></td>
					<td><div id='downpayment_flag' class='number_general' name='downpayment_flag'></div></td>
				</tr>
				<tr>
					<td><label for='downpayment_date'><?php echo lang('downpayment_date')?></label></td>
					<td><div id='downpayment_date' class='date_box' name='downpayment_date'></div></td>
				</tr>
				<tr>
					<td><label for='vehicle_delivered_flag'><?php echo lang('vehicle_delivered_flag')?></label></td>
					<td><div id='vehicle_delivered_flag' class='number_general' name='vehicle_delivered_flag'></div></td>
				</tr>
				<tr>
					<td><label for='vehicle_delivery_date'><?php echo lang('vehicle_delivery_date')?></label></td>
					<td><div id='vehicle_delivery_date' class='date_box' name='vehicle_delivery_date'></div></td>
				</tr>
				<tr>
					<td><label for='bluebook_received_flag'><?php echo lang('bluebook_received_flag')?></label></td>
					<td><div id='bluebook_received_flag' class='number_general' name='bluebook_received_flag'></div></td>
				</tr>
				<tr>
					<td><label for='bluebook_received_date'><?php echo lang('bluebook_received_date')?></label></td>
					<td><div id='bluebook_received_date' class='date_box' name='bluebook_received_date'></div></td>
				</tr>
				<tr>
					<td><label for='insurance_no'><?php echo lang('insurance_no')?></label></td>
					<td><div id='insurance_no' class='number_general' name='insurance_no'></div></td>
				</tr>
				<tr>
					<td><label for='insurance_date'><?php echo lang('insurance_date')?></label></td>
					<td><div id='insurance_date' class='date_box' name='insurance_date'></div></td>
				</tr>
				<tr>
					<td><label for='vat_bill_no'><?php echo lang('vat_bill_no')?></label></td>
					<td><div id='vat_bill_no' class='number_general' name='vat_bill_no'></div></td>
				</tr>
				<tr>
					<td><label for='vat_bill_created_date'><?php echo lang('vat_bill_created_date')?></label></td>
					<td><div id='vat_bill_created_date' class='date_box' name='vat_bill_created_date'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxVehicle_processSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxVehicle_processCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var vehicle_processesDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'booked_date', type: 'date' },
			{ name: 'payment_mode', type: 'string' },
			{ name: 'receipt_type', type: 'string' },
			{ name: 'receipt_no', type: 'number' },
			{ name: 'amount', type: 'string' },
			{ name: 'receipt_date', type: 'date' },
			{ name: 'quotation_issue_flag', type: 'number' },
			{ name: 'quotation_issue_date', type: 'date' },
			{ name: 'do_flag', type: 'number' },
			{ name: 'do_received_date', type: 'date' },
			{ name: 'downpayment_flag', type: 'number' },
			{ name: 'downpayment_date', type: 'date' },
			{ name: 'vehicle_delivered_flag', type: 'number' },
			{ name: 'vehicle_delivery_date', type: 'date' },
			{ name: 'bluebook_received_flag', type: 'number' },
			{ name: 'bluebook_received_date', type: 'date' },
			{ name: 'insurance_no', type: 'number' },
			{ name: 'insurance_date', type: 'date' },
			{ name: 'vat_bill_no', type: 'number' },
			{ name: 'vat_bill_created_date', type: 'date' },
			
        ],
		url: '<?php echo site_url("admin/vehicle_processes/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	vehicle_processesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridVehicle_process").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridVehicle_process").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridVehicle_process").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: vehicle_processesDataSource,
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
			container.append($('#jqxGridVehicle_processToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editVehicle_processRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("booked_date"); ?>',datafield: 'booked_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("payment_mode"); ?>',datafield: 'payment_mode',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("receipt_type"); ?>',datafield: 'receipt_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("receipt_no"); ?>',datafield: 'receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("receipt_date"); ?>',datafield: 'receipt_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("quotation_issue_flag"); ?>',datafield: 'quotation_issue_flag',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quotation_issue_date"); ?>',datafield: 'quotation_issue_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("do_flag"); ?>',datafield: 'do_flag',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("do_received_date"); ?>',datafield: 'do_received_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("downpayment_flag"); ?>',datafield: 'downpayment_flag',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("downpayment_date"); ?>',datafield: 'downpayment_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("vehicle_delivered_flag"); ?>',datafield: 'vehicle_delivered_flag',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_delivery_date"); ?>',datafield: 'vehicle_delivery_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("bluebook_received_flag"); ?>',datafield: 'bluebook_received_flag',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("bluebook_received_date"); ?>',datafield: 'bluebook_received_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("insurance_no"); ?>',datafield: 'insurance_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("insurance_date"); ?>',datafield: 'insurance_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("vat_bill_no"); ?>',datafield: 'vat_bill_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vat_bill_created_date"); ?>',datafield: 'vat_bill_created_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridVehicle_process").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridVehicle_processFilterClear', function () { 
		$('#jqxGridVehicle_process').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridVehicle_processInsert', function () { 
		openPopupWindow('jqxPopupWindowVehicle_process', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowVehicle_process").jqxWindow({ 
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

    $("#jqxPopupWindowVehicle_process").on('close', function () {
        reset_form_vehicle_processes();
    });

    $("#jqxVehicle_processCancelButton").on('click', function () {
        reset_form_vehicle_processes();
        $('#jqxPopupWindowVehicle_process').jqxWindow('close');
    });

    /*$('#form-vehicle_processes').jqxValidator({
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

			{ input: '#customer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#payment_mode', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#payment_mode').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#receipt_type', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#receipt_type').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#receipt_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#receipt_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#amount', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#amount').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quotation_issue_flag', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quotation_issue_flag').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#do_flag', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#do_flag').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#downpayment_flag', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#downpayment_flag').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_delivered_flag', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_delivered_flag').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bluebook_received_flag', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bluebook_received_flag').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#insurance_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#insurance_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vat_bill_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vat_bill_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxVehicle_processSubmitButton").on('click', function () {
        saveVehicle_processRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveVehicle_processRecord();
                }
            };
        $('#form-vehicle_processes').jqxValidator('validate', validationResult);
        */
    });
});

function editVehicle_processRecord(index){
    var row =  $("#jqxGridVehicle_process").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#vehicle_processes_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#customer_id').jqxNumberInput('val', row.customer_id);
		$('#booked_date').jqxDateTimeInput('setDate', row.booked_date);
		$('#payment_mode').val(row.payment_mode);
		$('#receipt_type').val(row.receipt_type);
		$('#receipt_no').jqxNumberInput('val', row.receipt_no);
		$('#amount').val(row.amount);
		$('#receipt_date').jqxDateTimeInput('setDate', row.receipt_date);
		$('#quotation_issue_flag').jqxNumberInput('val', row.quotation_issue_flag);
		$('#quotation_issue_date').jqxDateTimeInput('setDate', row.quotation_issue_date);
		$('#do_flag').jqxNumberInput('val', row.do_flag);
		$('#do_received_date').jqxDateTimeInput('setDate', row.do_received_date);
		$('#downpayment_flag').jqxNumberInput('val', row.downpayment_flag);
		$('#downpayment_date').jqxDateTimeInput('setDate', row.downpayment_date);
		$('#vehicle_delivered_flag').jqxNumberInput('val', row.vehicle_delivered_flag);
		$('#vehicle_delivery_date').jqxDateTimeInput('setDate', row.vehicle_delivery_date);
		$('#bluebook_received_flag').jqxNumberInput('val', row.bluebook_received_flag);
		$('#bluebook_received_date').jqxDateTimeInput('setDate', row.bluebook_received_date);
		$('#insurance_no').jqxNumberInput('val', row.insurance_no);
		$('#insurance_date').jqxDateTimeInput('setDate', row.insurance_date);
		$('#vat_bill_no').jqxNumberInput('val', row.vat_bill_no);
		$('#vat_bill_created_date').jqxDateTimeInput('setDate', row.vat_bill_created_date);
		
        openPopupWindow('jqxPopupWindowVehicle_process', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveVehicle_processRecord(){
    var data = $("#form-vehicle_processes").serialize();
	
	$('#jqxPopupWindowVehicle_process').block({ 
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
        url: '<?php echo site_url("admin/vehicle_processes/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_vehicle_processes();
                $('#jqxGridVehicle_process').jqxGrid('updatebounddata');
                $('#jqxPopupWindowVehicle_process').jqxWindow('close');
            }
            $('#jqxPopupWindowVehicle_process').unblock();
        }
    });
}

function reset_form_vehicle_processes(){
	$('#vehicle_processes_id').val('');
    $('#form-vehicle_processes')[0].reset();
}
</script>