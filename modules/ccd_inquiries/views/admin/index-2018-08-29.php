<style type="text/css">
.cls-red { background-color: #F56969; }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_inquiries'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('ccd_inquiries'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCcd_inquiryToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCcd_inquiryInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCcd_inquiryFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCcd_inquiry"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCcd_inquiry">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<u><h3><div id="customer_name"></div></h3></u>
		<?php echo form_open('', array('id' =>'form-ccd_inquiries', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "ccd_inquiries_id"/>
		<table class="form-table">
			<tr>
				<td><label for='call_status'><?php echo lang('call_status')?></label></td>
				<td><div id='call_status' class='array_ccd_call_status' name='call_status'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='sales_experience'>Someone attend immediately</label></td>
				<td><div id='sales_experience' class='array_decisions' name='sales_experience'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='dse_attitude'>Behavior of salesman</label></td>
				<td><div id='dse_attitude' class='array_decisions' name='dse_attitude'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='dse_knowledge'>Give enough time to explain your queries</label></td>
				<td><div id='dse_knowledge' class='array_decisions' name='dse_knowledge'></div></td>
				<?php /*<td><label for='scheme_information'><?php echo lang('scheme_information')?></label></td>
				<td><div id='scheme_information'  class="array_decisions" name='scheme_information'></div></td>*/?>
			</tr>
			<tr class="inq_detail" style="display: none">
				<?php /*<td><label for='retail_finanace'><?php echo lang('retail_finanace')?></label></td>
				<td><div id='retail_finanace' class='array_decisions' name='retail_finanace'></div></td>*/?>
				<td><label for='offered_test_drive'><?php echo lang('offered_test_drive')?></label></td>
				<td><div id='offered_test_drive' class='array_decisions' name='offered_test_drive'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='warrenty_policy'>Explain post sales warranty and service policy</label></td>
				<td><div id='warrenty_policy' class='array_decisions' name='warrenty_policy'></div></td>
				<?php /*<td><label for='service_policy'><?php echo lang('service_policy')?></label></td>
				<td><div id='service_policy' class='array_decisions' name='service_policy'></div></td>*/?>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><div id='remarks' class='array_ccd_remarks' name='remarks'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='voc'><?php echo lang('voc')?></label></td>
				<td><input id='voc' class='text_area' name='voc'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_inquirySubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_inquiryCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowCcd_inquiry_generated">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<u><h3><div id="customer_name"></div></h3></u>
		<?php echo form_open('', array('id' =>'form-ccd_inquiries_generated', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "ccd_inquiries_generated_id"/>
		<table class="form-table">
			<tr>
				<td><label for='call_status'><?php echo lang('call_status')?></label></td>
				<td><div id='call_status_generated' class='array_ccd_call_status' name='call_status'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='dse_attitude'>Behavior of salesman</label></td>
				<td><div id='dse_attitude_generated' class='array_decisions' name='dse_attitude'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='dse_knowledge'>Give enough time to explain your queries</label></td>
				<td><div id='dse_knowledge_generated' class='array_decisions' name='dse_knowledge'></div></td>
				<?php /*<td><label for='scheme_information'><?php echo lang('scheme_information')?></label></td>
				<td><div id='scheme_information'  class="array_decisions" name='scheme_information'></div></td>*/?>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='warrenty_policy'>Explain post sales warranty and service policy</label></td>
				<td><div id='warrenty_policy_generated' class='array_decisions' name='warrenty_policy'></div></td>
				<?php /*<td><label for='service_policy'><?php echo lang('service_policy')?></label></td>
				<td><div id='service_policy' class='array_decisions' name='service_policy'></div></td>*/?>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><div id='remarks_generated' class='array_ccd_remarks' name='remarks'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='voc'><?php echo lang('voc')?></label></td>
				<td><input id='voc_generated' class='text_area' name='voc'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_inquiry_generated_SubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_inquiry_generated_CancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

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

		// $(".array_satisfaction").jqxComboBox({
		// 	theme: theme,
		// 	width: 195,
		// 	height: 25,
		// 	selectionMode: 'dropDownList',
		// 	autoComplete: true,
		// 	searchMode: 'containsignorecase',
		// 	placeHolder: 'Select an option',
		// 	source: array_satisfaction,
		// 	displayMember: "name",
		// 	valueMember: "id",
		// }); 

		$(".array_ccd_remarks").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			placeHolder: 'Select an option',
			source: array_ccd_remarks,
			displayMember: "name",
			valueMember: "id",
		});

		$(".array_ccd_call_status").jqxComboBox({
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

		$("#call_status").bind('select', function (event) {

			if (!event.args)
				return;

			call_status = $("#call_status").jqxComboBox('val');

			if(call_status == 'Connected')
			{
				$('.inq_detail').show();
			}
			else
			{
				$('.inq_detail').hide();
			}
		});

		$("#call_status_generated").bind('select', function (event) {
			if (!event.args)
				return;

			call_status = $("#call_status_generated").jqxComboBox('val');

			if(call_status == 'Connected')
			{
				$('.inq_detail').show();
			}
			else
			{
				$('.inq_detail').hide();
			}
		});

		var ccd_inquiriesDataSource =
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
			{ name: 'call_status', type: 'string' },
			{ name: 'date_of_call', type: 'date' },
			{ name: 'date_of_call_np', type: 'string' },
			{ name: 'sales_experience', type: 'number' },
			{ name: 'dse_attitude', type: 'number' },
			{ name: 'dse_knowledge', type: 'number' },
			{ name: 'scheme_information', type: 'number' },
			{ name: 'retail_finanace', type: 'number' },
			{ name: 'offered_test_drive', type: 'number' },
			{ name: 'warrenty_policy', type: 'number' },
			{ name: 'service_policy', type: 'number' },
			{ name: 'remarks', type: 'number' },
			{ name: 'full_name', type: 'string' },
			{ name: 'mobile_1', type: 'string' },
			{ name: 'inquiry_date_en', type: 'date' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'payment_mode_name', type: 'string' },
			{ name: 'customer_type_name', type: 'string' },
			{ name: 'source_name', type: 'string' },
			{ name: 'walkin_source_id', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'executive_name', type: 'string' },
			{ name: 'model', type: 'string' },
			{ name: 'voc', type: 'string' },
			{ name: 'inquiry_age', type: 'number' },
			{ name: 'inquiry_date_status', type: 'string' },
			{ name: 'call_count', type: 'number' },
			{ name: 'source_id', type: 'number' },
			],
			url: '<?php echo site_url("admin/ccd_inquiries/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ccd_inquiriesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCcd_inquiry").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCcd_inquiry").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};

	var cellclassname =  function (row, column, value, data) 
	{
		if (data.inquiry_age > 3) {
			return 'cls-red';
		}
	}
	
	$("#jqxGridCcd_inquiry").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ccd_inquiriesDataSource,
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
			container.append($('#jqxGridCcd_inquiryToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:60, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxGridCcd_inquiry").jqxGrid('getrowdata', index);
				if(row.call_status != 'Connected')
				{
					if(row.source_id != 2){
						var e = '<a href="javascript:void(0)" onclick="editCcd_inquiryRecord(' + index + '); return false;" title="Update"><i class="fa fa-edit"></i></a>';
					}else{
						var e = '<a href="javascript:void(0)" onclick="editCcd_inquiry_generated_Record(' + index + '); return false;" title="Update Generated"><i class="fa fa-edit"></i></a>';
					}
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			}
		},
		{ text: '<?php echo lang("inquiry_date_status"); ?>',datafield: 'inquiry_date_status',width: 90,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("inquiry_date_en"); ?>',datafield: 'inquiry_date_en',width: 90,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd,cellclassname:cellclassname},
		{ text: '<?php echo lang("full_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("mobile_1"); ?>',datafield: 'mobile_1',width: 100,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("model"); ?>',datafield: 'model',width: 150,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("executive_name"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("source_name"); ?>',datafield: 'source_name',width: 80,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("payment_mode_name"); ?>',datafield: 'payment_mode_name',width: 90,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("customer_type_name"); ?>',datafield: 'customer_type_name',width: 120,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("call_status"); ?>',datafield: 'call_status',width: 90,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("date_of_call"); ?>',datafield: 'date_of_call',width: 90,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd,cellclassname:cellclassname},
		{ text: '<?php echo lang("call_count"); ?>',datafield: 'call_count',width: 90,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("sales_experience"); ?>',datafield: 'sales_experience',width: 110,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("dse_attitude"); ?>',datafield: 'dse_attitude',width: 80,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("dse_knowledge"); ?>',datafield: 'dse_knowledge',width: 100,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("scheme_information"); ?>',datafield: 'scheme_information',width: 130,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("retail_finanace"); ?>',datafield: 'retail_finanace',width: 100,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("offered_test_drive"); ?>',datafield: 'offered_test_drive',width: 110,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("warrenty_policy"); ?>',datafield: 'warrenty_policy',width: 100,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("service_policy"); ?>',datafield: 'service_policy',width: 100,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 80,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},
		{ text: '<?php echo lang("voc"); ?>',datafield: 'voc',width: 160,filterable: true,renderer: gridColumnsRenderer ,cellclassname:cellclassname},

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridCcd_inquiry").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridCcd_inquiryFilterClear', function () { 
	$('#jqxGridCcd_inquiry').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridCcd_inquiryInsert', function () { 
	openPopupWindow('jqxPopupWindowCcd_inquiry', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowCcd_inquiry").jqxWindow({ 
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

	$("#jqxPopupWindowCcd_inquiry").on('close', function () {
		reset_form_ccd_inquiries();
	});

	$("#jqxCcd_inquiryCancelButton").on('click', function () {
		reset_form_ccd_inquiries();
		$('#jqxPopupWindowCcd_inquiry').jqxWindow('close');
	});

	// for generated_form
	$(document).on('click','#jqxGridCcd_inquiryInsert', function () { 
	openPopupWindow('jqxPopupWindowCcd_inquiry_generated', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowCcd_inquiry_generated").jqxWindow({ 
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

	$("#jqxPopupWindowCcd_inquiry_generated").on('close', function () {
		reset_form_ccd_inquiries();
	});

	$("#jqxCcd_inquiry_generated_CancelButton").on('click', function () {
		reset_form_ccd_inquiries();
		$('#jqxPopupWindowCcd_inquiry_generated').jqxWindow('close');
	});

    /*$('#form-ccd_inquiries').jqxValidator({
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

			{ input: '#date_of_call_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date_of_call_np').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#sales_experience', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sales_experience').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dse_attitude', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dse_attitude').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dse_knowledge', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dse_knowledge').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#scheme_information', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#scheme_information').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#retail_finanace', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#retail_finanace').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#offered_test_drive', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#offered_test_drive').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#warrenty_policy', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#warrenty_policy').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#service_policy', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#service_policy').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remarks', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remarks').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#voc', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#voc').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxCcd_inquirySubmitButton").on('click', function () {
    	saveCcd_inquiryRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_inquiryRecord();
                }
            };
        $('#form-ccd_inquiries').jqxValidator('validate', validationResult);
        */
    });

    $("#jqxCcd_inquiry_generated_SubmitButton").on('click', function () {
    	saveCcd_inquiry_GeneratedRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_inquiryRecord();
                }
            };
        $('#form-ccd_inquiries').jqxValidator('validate', validationResult);
        */
    });

});

function editCcd_inquiryRecord(index){
	var row =  $("#jqxGridCcd_inquiry").jqxGrid('getrowdata', index);
	if (row) {
		$('.inq_detail').hide();
		$("#call_status").jqxComboBox('clearSelection'); 
		$("#sales_experience").jqxComboBox('clearSelection'); 
		$("#dse_attitude").jqxComboBox('clearSelection'); 
		$("#dse_knowledge").jqxComboBox('clearSelection'); 
		$("#offered_test_drive").jqxComboBox('clearSelection'); 
		$("#warrenty_policy").jqxComboBox('clearSelection'); 
		$("#remarks").jqxComboBox('clearSelection'); 
		$('#ccd_inquiries_id').val(row.id);
		$('#customer_name').html(row.full_name);
		$('#call_status').jqxComboBox('val', row.call_status);
		$('#sales_experience').jqxComboBox('val', row.sales_experience);
		$('#dse_attitude').jqxComboBox('val', row.dse_attitude);
		$('#dse_knowledge').jqxComboBox('val', row.dse_knowledge);
		// $('#scheme_information').jqxComboBox('val', row.scheme_information);
		// $('#retail_finanace').jqxComboBox('val', row.retail_finanace);
		$('#offered_test_drive').jqxComboBox('val', row.offered_test_drive);
		$('#warrenty_policy').jqxComboBox('val', row.warrenty_policy);
		// $('#service_policy').jqxComboBox('val', row.service_policy);
		$('#remarks').jqxComboBox('val', row.remarks);
		$('#voc').val(row.voc);
		
		openPopupWindow('jqxPopupWindowCcd_inquiry', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function editCcd_inquiry_generated_Record(index){
	var row =  $("#jqxGridCcd_inquiry").jqxGrid('getrowdata', index);
	if (row) {
		$('.inq_detail').hide();
		$("#call_status_generated").jqxComboBox('clearSelection'); 
		$("#dse_attitude_generated").jqxComboBox('clearSelection'); 
		$("#dse_knowledge_generated").jqxComboBox('clearSelection'); 
		$("#warrenty_policy_generated").jqxComboBox('clearSelection'); 
		$("#remarks_generated").jqxComboBox('clearSelection'); 
		$('#ccd_inquiries_generated_id').val(row.id);
		$('#customer_name').html(row.full_name);
		$('#call_status_generated').jqxComboBox('val', row.call_status);
		$('#sales_experience').jqxComboBox('val', row.sales_experience);
		$('#dse_attitude_generated').jqxComboBox('val', row.dse_attitude);
		$('#dse_knowledge_generated').jqxComboBox('val', row.dse_knowledge);
		// $('#scheme_information').jqxComboBox('val', row.scheme_information);
		// $('#retail_finanace').jqxComboBox('val', row.retail_finanace);
		$('#offered_test_drive').jqxComboBox('val', row.offered_test_drive);
		$('#warrenty_policy_generated').jqxComboBox('val', row.warrenty_policy);
		// $('#service_policy').jqxComboBox('val', row.service_policy);
		$('#remarks_generated').jqxComboBox('val', row.remarks);
		$('#voc_generated').val(row.voc);
		
		openPopupWindow('jqxPopupWindowCcd_inquiry_generated', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveCcd_inquiryRecord(){
	var data = $("#form-ccd_inquiries").serialize();
	
	$('#jqxPopupWindowCcd_inquiry').block({ 
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
		url: '<?php echo site_url("admin/ccd_inquiries/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_ccd_inquiries();
				$('#jqxGridCcd_inquiry').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCcd_inquiry').jqxWindow('close');
			}
			$('#jqxPopupWindowCcd_inquiry').unblock();
		}
	});
}

function saveCcd_inquiry_GeneratedRecord(){
	var data = $("#form-ccd_inquiries_generated").serialize();
	
	$('#jqxPopupWindowCcd_inquiry_generated').block({ 
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
		url: '<?php echo site_url("admin/ccd_inquiries/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_ccd_inquiries();
				$('#jqxGridCcd_inquiry').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCcd_inquiry_generated').jqxWindow('close');
			}
			$('#jqxPopupWindowCcd_inquiry_generated').unblock();
		}
	});
}

function reset_form_ccd_inquiries(){
	$('#ccd_inquiries_id').val('');
	$("#call_status").jqxComboBox('clearSelection'); 
	$('#ccd_inquiries_id').val('');
	$('#customer_name').html('');
	$('#call_status').jqxComboBox('clearSelection');
	$('#sales_experience').jqxComboBox('clearSelection');
	$('#dse_attitude').jqxComboBox('clearSelection');
	$('#dse_knowledge').jqxComboBox('clearSelection');
	// $('#scheme_information').jqxComboBox('clearSelection');
	// $('#retail_finanace').jqxComboBox('clearSelection');
	$('#offered_test_drive').jqxComboBox('clearSelection');
	$('#warrenty_policy').jqxComboBox('clearSelection');
	// $('#service_policy').jqxComboBox('clearSelection');
	$('#remarks').jqxComboBox('clearSelection');
	$('#voc').val('');
	$('#form-ccd_inquiries')[0].reset();
}
</script>