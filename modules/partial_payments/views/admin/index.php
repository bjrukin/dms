<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('partial_payments'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('partial_payments'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPartial_paymentToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPartial_paymentInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPartial_paymentFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridPartial_payment"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPartial_payment">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-partial_payments', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "partial_payments_id"/>
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
					<td><label for='vehicle_process_id'><?php echo lang('vehicle_process_id')?></label></td>
					<td><div id='vehicle_process_id' class='number_general' name='vehicle_process_id'></div></td>
				</tr>
				<tr>
					<td><label for='receipt_no'><?php echo lang('receipt_no')?></label></td>
					<td><input id='receipt_no' class='text_input' name='receipt_no'></td>
				</tr>
				<tr>
					<td><label for='amount'><?php echo lang('amount')?></label></td>
					<td><div id='amount' class='number_general' name='amount'></div></td>
				</tr>
				<tr>
					<td><label for='receipt_image'><?php echo lang('receipt_image')?></label></td>
					<td><input id='receipt_image' class='text_input' name='receipt_image'></td>
				</tr>
				<tr>
					<td><label for='payment_date'><?php echo lang('payment_date')?></label></td>
					<td><div id='payment_date' class='date_box' name='payment_date'></div></td>
				</tr>
				<tr>
					<td><label for='payment_date_nep'><?php echo lang('payment_date_nep')?></label></td>
					<td><input id='payment_date_nep' class='text_input' name='payment_date_nep'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPartial_paymentSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPartial_paymentCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var partial_paymentsDataSource =
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
			{ name: 'vehicle_process_id', type: 'number' },
			{ name: 'receipt_no', type: 'string' },
			{ name: 'amount', type: 'number' },
			{ name: 'receipt_image', type: 'string' },
			{ name: 'payment_date', type: 'date' },
			{ name: 'payment_date_nep', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/partial_payments/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	partial_paymentsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPartial_payment").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPartial_payment").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPartial_payment").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: partial_paymentsDataSource,
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
			container.append($('#jqxGridPartial_paymentToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editPartial_paymentRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("vehicle_process_id"); ?>',datafield: 'vehicle_process_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("receipt_no"); ?>',datafield: 'receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("receipt_image"); ?>',datafield: 'receipt_image',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("payment_date"); ?>',datafield: 'payment_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("payment_date_nep"); ?>',datafield: 'payment_date_nep',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridPartial_payment").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPartial_paymentFilterClear', function () { 
		$('#jqxGridPartial_payment').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPartial_paymentInsert', function () { 
		openPopupWindow('jqxPopupWindowPartial_payment', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowPartial_payment").jqxWindow({ 
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

    $("#jqxPopupWindowPartial_payment").on('close', function () {
        reset_form_partial_payments();
    });

    $("#jqxPartial_paymentCancelButton").on('click', function () {
        reset_form_partial_payments();
        $('#jqxPopupWindowPartial_payment').jqxWindow('close');
    });

    /*$('#form-partial_payments').jqxValidator({
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

			{ input: '#vehicle_process_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_process_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#receipt_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#receipt_no').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#amount', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#amount').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#receipt_image', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#receipt_image').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#payment_date_nep', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#payment_date_nep').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxPartial_paymentSubmitButton").on('click', function () {
        savePartial_paymentRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   savePartial_paymentRecord();
                }
            };
        $('#form-partial_payments').jqxValidator('validate', validationResult);
        */
    });
});

function editPartial_paymentRecord(index){
    var row =  $("#jqxGridPartial_payment").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#partial_payments_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#vehicle_process_id').jqxNumberInput('val', row.vehicle_process_id);
		$('#receipt_no').val(row.receipt_no);
		$('#amount').jqxNumberInput('val', row.amount);
		$('#receipt_image').val(row.receipt_image);
		$('#payment_date').jqxDateTimeInput('setDate', row.payment_date);
		$('#payment_date_nep').val(row.payment_date_nep);
		
        openPopupWindow('jqxPopupWindowPartial_payment', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function savePartial_paymentRecord(){
    var data = $("#form-partial_payments").serialize();
	
	$('#jqxPopupWindowPartial_payment').block({ 
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
        url: '<?php echo site_url("admin/partial_payments/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_partial_payments();
                $('#jqxGridPartial_payment').jqxGrid('updatebounddata');
                $('#jqxPopupWindowPartial_payment').jqxWindow('close');
            }
            $('#jqxPopupWindowPartial_payment').unblock();
        }
    });
}

function reset_form_partial_payments(){
	$('#partial_payments_id').val('');
    $('#form-partial_payments')[0].reset();
}
</script>