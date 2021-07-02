<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_threedays'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('ccd_threedays'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCcd_threedayToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCcd_threedayInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCcd_threedayFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCcd_threeday"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->

	<div id="jqxPopupWindowCcd_threeday">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title"></span>
		</div>
		<div class="form_fields_area">
			<u><h3><div id="customer_name"></div></h3></u>
			<?php echo form_open('', array('id' =>'form-ccd_threedays', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "id" id = "ccd_threedays_id"/>
			<table class="form-table">
				<tr>
					<td><label for='call_status'><?php echo lang('call_status')?></label></td>
					<td><div id='call_status' name='call_status'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='delivered_on_time'><?php echo lang('delivered_on_time')?></label></td>
					<td><div id='delivered_on_time' class='array_decisions' name='delivered_on_time'></div></td>
					<td><label for='cleanliness_of_car'><?php echo lang('cleanliness_of_car')?></label></td>
					<td><div id='cleanliness_of_car' class='array_satisfaction' name='cleanliness_of_car'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='basic_features'><?php echo lang('basic_features')?></label></td>
					<td><div id='basic_features' class='array_decisions' name='basic_features'></div></td>
					<td><label for='owner_manual'><?php echo lang('owner_manual')?></label></td>
					<td><div id='owner_manual' class='array_decisions' name='owner_manual'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='service_coupon'><?php echo lang('service_coupon')?></label></td>
					<td><div id='service_coupon' class='array_decisions' name='service_coupon'></div></td>
					<td><label for='warrenty_card'><?php echo lang('warrenty_card')?></label></td>
					<td><div id='warrenty_card' class='array_decisions' name='warrenty_card'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='delivery_sheet'><?php echo lang('delivery_sheet')?></label></td>
					<td><div id='delivery_sheet' class='array_decisions' name='delivery_sheet'></div></td>
					<td><label for='ccd_details'><?php echo lang('ccd_details')?></label></td>
					<td><div id='ccd_details' class='array_decisions' name='ccd_details'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='remarks'><?php echo lang('remarks')?></label></td>
					<td><div id='remarks' class='array_ccd_remarks' name='remarks'></div></td>
					<td><label for='voc'><?php echo lang('voc')?></label></td>
					<td><input id='voc' class='text_area' name='voc'></td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_threedaySubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_threedayCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>

			</table>
			<?php echo form_close(); ?>
		</div>
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

		$(".array_satisfaction").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			placeHolder: 'Select an option',
			source: array_satisfaction,
			displayMember: "name",
			valueMember: "id",
		}); 

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

		var ccd_threedaysDataSource =
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
			{ name: 'delivered_on_time', type: 'string' },
			{ name: 'cleanliness_of_car', type: 'string' },
			{ name: 'basic_features', type: 'string' },
			{ name: 'owner_manual', type: 'string' },
			{ name: 'service_coupon', type: 'string' },
			{ name: 'warrenty_card', type: 'string' },
			{ name: 'delivery_sheet', type: 'string' },
			{ name: 'ccd_details', type: 'string' },
			{ name: 'remarks', type: 'string' },
			{ name: 'voc', type: 'string' },
			{ name: 'full_name', type: 'string' },
			{ name: 'mobile_1', type: 'string' },
			{ name: 'retail_date', type: 'date' },
			{ name: 'payment_mode_name', type: 'string' },
			{ name: 'customer_type_name', type: 'string' },
			{ name: 'source_name', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'executive_name', type: 'string' },
			{ name: 'model', type: 'string' },
			{ name: 'call_count', type: 'number' },
			{ name: 'exchange_car_make', type: 'string' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'chass_no', type: 'string' },
			{ name: 'color_name', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/ccd_threedays/json/{$days}/dashboard");?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ccd_threedaysDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCcd_threeday").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCcd_threeday").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCcd_threeday").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ccd_threedaysDataSource,
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
			container.append($('#jqxGridCcd_threedayToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxGridCcd_threeday").jqxGrid('getrowdata', index);
				if(row.call_status != 'Connected')
				{
					var e = '<a href="javascript:void(0)" onclick="editCcd_threedayRecord(' + index + '); return false;" title="Update"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			}
		},
		{ text: '<?php echo lang("retail_date"); ?>',datafield: 'retail_date',width: 100,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("full_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("mobile_1"); ?>',datafield: 'mobile_1',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("model"); ?>',datafield: 'model',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 110,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width: 170,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("executive_name"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("customer_type_name"); ?>',datafield: 'customer_type_name',width: 130,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("exchange_car_make"); ?>',datafield: 'exchange_car_make',width: 130,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("payment_mode_name"); ?>',datafield: 'payment_mode_name',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("call_status"); ?>',datafield: 'call_status',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("call_count"); ?>',datafield: 'call_count',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("date_of_call"); ?>',datafield: 'date_of_call',width: 100,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("delivered_on_time"); ?>',datafield: 'delivered_on_time',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("cleanliness_of_car"); ?>',datafield: 'cleanliness_of_car',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("basic_features"); ?>',datafield: 'basic_features',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("owner_manual"); ?>',datafield: 'owner_manual',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("service_coupon"); ?>',datafield: 'service_coupon',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("warrenty_card"); ?>',datafield: 'warrenty_card',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("delivery_sheet"); ?>',datafield: 'delivery_sheet',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("ccd_details"); ?>',datafield: 'ccd_details',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("voc"); ?>',datafield: 'voc',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridCcd_threeday").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridCcd_threedayFilterClear', function () { 
	$('#jqxGridCcd_threeday').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridCcd_threedayInsert', function () { 
	openPopupWindow('jqxPopupWindowCcd_threeday', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowCcd_threeday").jqxWindow({ 
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

	$("#jqxPopupWindowCcd_threeday").on('close', function () {
		reset_form_ccd_threedays();
	});

	$("#jqxCcd_threedayCancelButton").on('click', function () {
		reset_form_ccd_threedays();
		$('#jqxPopupWindowCcd_threeday').jqxWindow('close');
	});

    /*$('#form-ccd_threedays').jqxValidator({
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

			{ input: '#delivered_on_time', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#delivered_on_time').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#cleanliness_of_car', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#cleanliness_of_car').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#basic_features', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#basic_features').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#owner_manual', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#owner_manual').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#service_coupon', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#service_coupon').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#warrenty_card', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#warrenty_card').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#delivery_sheet', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#delivery_sheet').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#ccd_details', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#ccd_details').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remarks', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remarks').val();
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

    $("#jqxCcd_threedaySubmitButton").on('click', function () {
    	saveCcd_threedayRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_threedayRecord();
                }
            };
        $('#form-ccd_threedays').jqxValidator('validate', validationResult);
        */
    });
});

function editCcd_threedayRecord(index){
	var row =  $("#jqxGridCcd_threeday").jqxGrid('getrowdata', index);
	if (row) {
		$('#ccd_threedays_id').val(row.id);
		$('#customer_name').html(row.full_name);
		$('#call_status').jqxComboBox('val',row.call_status);
		$('#delivered_on_time').jqxComboBox('val',row.delivered_on_time);
		$('#cleanliness_of_car').jqxComboBox('val',row.cleanliness_of_car);
		$('#basic_features').jqxComboBox('val',row.basic_features);
		$('#owner_manual').jqxComboBox('val',row.owner_manual);
		$('#service_coupon').jqxComboBox('val',row.service_coupon);
		$('#warrenty_card').jqxComboBox('val',row.warrenty_card);
		$('#delivery_sheet').jqxComboBox('val',row.delivery_sheet);
		$('#ccd_details').jqxComboBox('val',row.ccd_details);
		$('#remarks').jqxComboBox('val',row.remarks);
		$('#voc').val(row.voc);
		
		openPopupWindow('jqxPopupWindowCcd_threeday', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveCcd_threedayRecord(){
	var data = $("#form-ccd_threedays").serialize();
	
	$('#jqxPopupWindowCcd_threeday').block({ 
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
		url: '<?php echo site_url("admin/ccd_threedays/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_ccd_threedays();
				$('#jqxGridCcd_threeday').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCcd_threeday').jqxWindow('close');
			}
			$('#jqxPopupWindowCcd_threeday').unblock();
		}
	});
}

function reset_form_ccd_threedays(){
	$('#ccd_threedays_id').val('');
	$('#form-ccd_threedays')[0].reset();
}
</script>