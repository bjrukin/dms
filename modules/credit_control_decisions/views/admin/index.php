<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('credit_control_decisions'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('credit_control_decisions'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCredit_control_decisionToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCredit_control_decisionInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCredit_control_decisionFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCredit_control_decision"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCredit_control_decision">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-credit_control_decisions', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "credit_control_decisions_id"/>
            <table class="form-table">
				<tr>
					<td><label for='order_id'><?php echo lang('order_id')?></label></td>
					<td><div id='order_id' class='number_general' name='order_id'></div></td>
				</tr>
				<tr>
					<td><label for='status'><?php echo lang('status')?></label></td>
					<td><div id='status' class='number_general' name='status'></div></td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='remarks'><?php echo lang('remarks')?></label></td>
					<td><input id='remarks' class='text_input' name='remarks'></td>
				</tr>
				<tr>
					<td><label for='date'><?php echo lang('date')?></label></td>
					<td><div id='date' class='date_box' name='date'></div></td>
				</tr>
				<tr>
					<td><label for='date_np'><?php echo lang('date_np')?></label></td>
					<td><input id='date_np' class='text_input' name='date_np'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCredit_control_decisionSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCredit_control_decisionCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var credit_control_decisionsDataSource =
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
			{ name: 'order_id', type: 'number' },
			{ name: 'status', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'remarks', type: 'string' },
			{ name: 'date', type: 'date' },
			{ name: 'date_np', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'firm_name', type: 'string' },
			{ name: 'color_code', type: 'string' },
			{ name: 'payment_value', type: 'string' },
			{ name: 'credit_status', type: 'string' },
			{ name: 'payment_status', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/credit_control_decisions/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	credit_control_decisionsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCredit_control_decision").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCredit_control_decision").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCredit_control_decision").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: credit_control_decisionsDataSource,
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
			container.append($('#jqxGridCredit_control_decisionToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					// var e = '<a href="javascript:void(0)" onclick="editCredit_control_decisionRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					// return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("order_id"); ?>',datafield: 'order_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("status"); ?>',datafield: 'credit_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("date_np"); ?>',datafield: 'date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCredit_control_decision").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCredit_control_decisionFilterClear', function () { 
		$('#jqxGridCredit_control_decision').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCredit_control_decisionInsert', function () { 
		openPopupWindow('jqxPopupWindowCredit_control_decision', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowCredit_control_decision").jqxWindow({ 
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

    $("#jqxPopupWindowCredit_control_decision").on('close', function () {
        reset_form_credit_control_decisions();
    });

    $("#jqxCredit_control_decisionCancelButton").on('click', function () {
        reset_form_credit_control_decisions();
        $('#jqxPopupWindowCredit_control_decision').jqxWindow('close');
    });

    /*$('#form-credit_control_decisions').jqxValidator({
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

			{ input: '#order_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#order_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#status').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remarks', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remarks').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxCredit_control_decisionSubmitButton").on('click', function () {
        saveCredit_control_decisionRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCredit_control_decisionRecord();
                }
            };
        $('#form-credit_control_decisions').jqxValidator('validate', validationResult);
        */
    });
});

function editCredit_control_decisionRecord(index){
    var row =  $("#jqxGridCredit_control_decision").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#credit_control_decisions_id').val(row.id);
		$('#order_id').jqxNumberInput('val', row.order_id);
		$('#status').jqxNumberInput('val', row.status);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#remarks').val(row.remarks);
		$('#date').jqxDateTimeInput('setDate', row.date);
		$('#date_np').val(row.date_np);
		
        openPopupWindow('jqxPopupWindowCredit_control_decision', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveCredit_control_decisionRecord(){
    var data = $("#form-credit_control_decisions").serialize();
	
	$('#jqxPopupWindowCredit_control_decision').block({ 
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
        url: '<?php echo site_url("admin/credit_control_decisions/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_credit_control_decisions();
                $('#jqxGridCredit_control_decision').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCredit_control_decision').jqxWindow('close');
            }
            $('#jqxPopupWindowCredit_control_decision').unblock();
        }
    });
}

function reset_form_credit_control_decisions(){
	$('#credit_control_decisions_id').val('');
    $('#form-credit_control_decisions')[0].reset();
}
</script>