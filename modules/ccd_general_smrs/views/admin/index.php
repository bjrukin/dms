<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_general_smrs'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('ccd_general_smrs'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCcd_general_smrToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCcd_general_smrInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCcd_general_smrFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCcd_general_smr"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCcd_general_smr">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-ccd_general_smrs', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "ccd_general_smrs_id"/>
        	<input type = "hidden" name = "customer_id" id = "customer_id"/>
            <table class="form-table">
				<tr>
					<td><label for='call_status'><?php echo lang('call_status')?></label></td>
					<td><div id='call_status'  name='call_status'></div></td>
				</tr>
				<tr class="call_connect_sub_status" style="display: none">
					<td><label for='call_status'>Call Type</label></td>
					<td><div id='call_connect_retail_type' class='array_call_connect_retail_type' name='call_type'></div></td>
				</tr>
				<tr class="false_retail_tr" style="display: none">
					<td><label for='call_status'>False Type</label></td>
					<td><div id='false_retail' class='array_false_retail' name='false_reason'></div></td>
				</tr>
				
				<tr class="inq_detail" style="display: none">
					<td><label for='appointment_taken'><?php echo lang('appointment_taken')?></label></td>
					<td><div id='appointment_taken' class="array_decisions" name='appointment_taken'></div></td>
				</tr >
				<tr class="inq_detail_appointment_date" style="display: none">
					<td><label for='appointment_date'><?php echo lang('appointment_date')?></label></td>
					<!-- <td><div id='appointment_date' class='date_box' name='appointment_date'></div></td> -->
					<td><div id='appointment_date' name='appointment_date'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='remark'><?php echo lang('remark')?></label></td>
					<td><input id='remark' class='text_area' name='remark'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_general_smrSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_general_smrCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
         	 </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
	$('#appointment_date').jqxDateTimeInput({ formatString: "yyyy-MM-dd HH:mm:ss" , showTimeButton: true});

	$("#call_status").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		placeHolder: 'Select an option',
		source: array_ccd_call_status,
		displayMember: "name",
		valueMember: "id",
	});
	$(".array_false_retail").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		placeHolder: 'Select an option',
		source: array_false_retail,
		displayMember: "name",
		valueMember: "id",
	});
	$(".array_decisions").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		placeHolder: 'Select an option',
		source: array_decisions,
		displayMember: "name",
		valueMember: "id",
	});	
	$(".array_call_connect_retail_type").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		placeHolder: 'Select an option',
		source: array_call_connect_retail_type,
		displayMember: "name",
		valueMember: "id",
	});

	$("#call_status").bind('select', function (event) {

		if (!event.args)
			return;

		call_status = $("#call_status").jqxComboBox('val');

		if(call_status == 'Connected')
		{
			// $('.inq_detail').show();
			$('.call_connect_sub_status').show();
			$('.inq_detail').hide();
			$('.false_retail_tr').hide();
			$('.remarks_tr').hide();
			$('input[name=false_reason]').val('');
			// $('.unsatisfied_tr').hide();
		}
		else if(call_status == 'Invalid Number'){
			$('.inq_detail').hide();
			$('.call_connect_sub_status').hide();
			$('.false_retail_tr').show();
			$('.remarks_tr').hide();
			$('input[name=call_type]').val('');
			$('input[name=false_reason]').val('');
			$('input[name=appointment_date]').val('');
			$('input[name=appointment_taken]').val('');
			// $('.unsatisfied_tr').hide();

		}
		else if(call_status == 'Number doesn’t exist'){
			$('.inq_detail').hide();
			$('.call_connect_sub_status').hide();
			$('.false_retail_tr').show();
			$('.remarks_tr').hide();
			$('input[name=call_type]').val('');
			$('input[name=false_reason]').val('');
			$('input[name=appointment_date]').val('');
			$('input[name=appointment_taken]').val('');
			// $('.unsatisfied_tr').hide();

		}

		else{
			// $('.inq_detail').hide();
			$('.call_connect_sub_status').hide();
			$('.inq_detail').hide();
			$('.false_retail_tr').hide();
			$('.remarks_tr').hide();
			$('.inq_detail_appointment_date').hide();
			$('input[name=call_type]').val('');
			$('input[name=false_reason]').val('');
			$('input[name=appointment_date]').val('');
			$('input[name=appointment_taken]').val('');
			// $('.unsatisfied_tr').hide();
		}
	});
	$("#call_connect_retail_type").bind('select', function (event) {

		if (!event.args)
			return;

		call_sub_status = $("#call_connect_retail_type").jqxComboBox('val');

		if(call_sub_status == 'False Retails')
		{
			$('.inq_detail').hide();
			$('.call_connect_sub_status').show();
			$('.false_retail_tr').show();
			$('.remarks_tr').hide();
			$('.unsatisfied_tr').hide();
		}
		else
		{
			$('.inq_detail').show();
			$('.remarks_tr').show();
			
			$('.call_connect_sub_status').hide();
			$('.false_retail_tr').hide();
			$('.unsatisfied_tr').hide();
		}
	});

	$("#appointment_taken").bind('select', function (event) {

		if (!event.args)
			return;

		appointment_taken = $("#appointment_taken").jqxComboBox('val');

		if(appointment_taken == 'Yes')
		{
			$('.inq_detail_appointment_date').show();
		}
		else
		{
			$('.inq_detail_appointment_date').hide();
			$("#appointment_date").jqxDateTimeInput({value: null});
		}
	});
	var ccd_general_smrsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'customer_id', type: 'number' },
			{ name: 'call_status', type: 'string' },
			{ name: 'date_of_call', type: 'date' },
			{ name: 'schedule_date', type: 'date' },
			{ name: 'date_of_call_np', type: 'string' },
			{ name: 'appointment_taken', type: 'string' },
			{ name: 'appointment_date', type: 'date' },
			{ name: 'remark', type: 'string' },
			{ name: 'created_at', type: 'date' },
			{ name: 'updated_at', type: 'date' },
			{ name: 'deleted_at', type: 'date' },
			{ name: 'call_type', type: 'string' },
			{ name: 'false_reason', type: 'string' },
			{ name: 'call_count', type: 'string' },
			{ name: 'customer', type: 'string' },
			{ name: 'mobile', type: 'string' },
			{ name: 'age', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'mobile', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'closed_date', type: 'date' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'chassis_no', type: 'string' },
			{ name: 'vehicle_no', type: 'string' },
        ],
		url: '<?php echo site_url("admin/ccd_general_smrs/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ccd_general_smrsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCcd_general_smr").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCcd_general_smr").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	var cellclassname =  function (row, column, value, data) 
	{

		if(parseInt(data.age) <= 1){
			// return 'cls-green';
			return 'cls-blue';

		}else if(parseInt(data.age) <= 2){
			// return 'cls-yellow';
			return 'cls-green';

		}else if(parseInt(data.age) <= 3){
			// return 'cls-red';
			return 'cls-yellow';

		}else{
			// return 'cls-blue';
			return 'cls-red';
			
		}
		
	}
	
	$("#jqxGridCcd_general_smr").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ccd_general_smrsDataSource,
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
			container.append($('#jqxGridCcd_general_smrToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editCcd_general_smrRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo 'Closed Date'; ?>',datafield: 'closed_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd , cellclassname:cellclassname},
			{ text: '<?php echo lang("schedule_date"); ?>',datafield: 'schedule_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd, cellclassname:cellclassname},
			{ text: '<?php echo lang("customer_id"); ?>',datafield: 'customer',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo 'Mobile' ?>',datafield: 'mobile',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo 'Dealer' ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("vehicle_no"); ?>',datafield: 'vehicle_no',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo 'Vehicle' ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo 'Variant' ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo 'Color' ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},

			{ text: '<?php echo 'Engine No' ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo 'Chasis No' ?>',datafield: 'chassis_no',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("call_status"); ?>',datafield: 'call_status',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("date_of_call"); ?>',datafield: 'date_of_call',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd, cellclassname:cellclassname},
			{ text: '<?php echo lang("date_of_call_np"); ?>',datafield: 'date_of_call_np',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("appointment_taken"); ?>',datafield: 'appointment_taken',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("appointment_date"); ?>',datafield: 'appointment_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd, cellclassname:cellclassname},
			{ text: '<?php echo lang("remark"); ?>',datafield: 'remark',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("call_type"); ?>',datafield: 'call_type',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("false_reason"); ?>',datafield: 'false_reason',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			{ text: '<?php echo lang("call_count"); ?>',datafield: 'call_count',width: 150,filterable: true,renderer: gridColumnsRenderer , cellclassname:cellclassname},
			
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCcd_general_smr").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCcd_general_smrFilterClear', function () { 
		$('#jqxGridCcd_general_smr').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCcd_general_smrInsert', function () { 
		openPopupWindow('jqxPopupWindowCcd_general_smr', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowCcd_general_smr").jqxWindow({ 
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

    $("#jqxPopupWindowCcd_general_smr").on('close', function () {
        reset_form_ccd_general_smrs();
    });

    $("#jqxCcd_general_smrCancelButton").on('click', function () {
        reset_form_ccd_general_smrs();
        $('#jqxPopupWindowCcd_general_smr').jqxWindow('close');
    });

    /*$('#form-ccd_general_smrs').jqxValidator({
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

			{ input: '#customer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#call_status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#call_status').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#date_of_call_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date_of_call_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#appointment_taken', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#appointment_taken').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remark', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remark').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#call_type', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#call_type').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#false_reason', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#false_reason').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#call_count', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#call_count').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxCcd_general_smrSubmitButton").on('click', function () {
        saveCcd_general_smrRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_general_smrRecord();
                }
            };
        $('#form-ccd_general_smrs').jqxValidator('validate', validationResult);
        */
    });
});

function editCcd_general_smrRecord(index){
	$("#call_status").jqxComboBox('clearSelection'); 
	$("#call_connect_retail_type").jqxComboBox('clearSelection'); 
	$("#appointment_taken").jqxComboBox('clearSelection');
	$("#false_retail").jqxComboBox('clearSelection');
	$("#appointment_date").jqxDateTimeInput({value: null});
	clear_combobox();
    var row =  $("#jqxGridCcd_general_smr").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#ccd_general_smrs_id').val(row.id);
		$('#call_status').val(row.call_status);
  		$('#call_connect_retail_type').val(row.call_type);
  		$("#appointment_taken").val(row.appointment_taken);
  		$("#appointment_date").val(row.appointment_date);
  		$("#false_retail").val(row.false_reason);
  		$("#remark").val(row.remark);
  		$("#customer_id").val(row.customer_id);
        openPopupWindow('jqxPopupWindowCcd_general_smr', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveCcd_general_smrRecord(){
    var data = $("#form-ccd_general_smrs").serialize();
	
	$('#jqxPopupWindowCcd_general_smr').block({ 
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
        url: '<?php echo site_url("admin/ccd_general_smrs/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_ccd_general_smrs();
                $('#jqxGridCcd_general_smr').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCcd_general_smr').jqxWindow('close');
            }
            $('#jqxPopupWindowCcd_general_smr').unblock();
        }
    });
}

function reset_form_ccd_general_smrs(){
	$("#call_status").jqxComboBox('clearSelection'); 
	$("#call_status").val('');
	$("#call_connect_retail_type").jqxComboBox('clearSelection'); 
	$("#call_connect_retail_type").val('');
	$("#appointment_taken").jqxComboBox('clearSelection');
	$("#appointment_taken").val('');
	$("#false_retail").jqxComboBox('clearSelection');
	$("#false_retail").val('');
	$("#appointment_date").jqxDateTimeInput({value: null});
	$('.call_connect_sub_status').hide();
	// $('.false_enquiries_tr').hide();
	$('.false_retail_tr').hide();
	$('.inq_detail').hide();
	$('.inq_detail_appointment_date').hide();
	$('#ccd_general_smrs_id').val('');
    $('#form-ccd_general_smrs')[0].reset();
}

function clear_combobox()
{
	$('input[name=call_status]').val('');
	$('input[name=appointment_taken]').val('');
	$("#appointment_date").jqxDateTimeInput({value: null});
	$('input[name=false_reason]').val('');
	$('input[name=call_type]').val('');
}
</script>