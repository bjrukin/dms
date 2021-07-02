<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('service_warranty_policies'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('service_warranty_policies'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridService_warranty_policyToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridService_warranty_policyInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridService_warranty_policyFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridService_warranty_policy"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowService_warranty_policy">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-service_warranty_policies', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "service_warranty_policies_id"/>
		<table class="form-table">
			<tr>
				<td><label for='service_policy_no'><?php echo lang('service_policy_no')?></label></td>
				<td><div id='service_policy_no' class='number_general' name='service_policy_no'></div></td>
			</tr>
			<tr>
				<td><label for='service_count'><?php echo lang('service_count')?></label></td>
				<td><div id='service_count' class='number_general' name='service_count'></div></td>
			</tr>
			<tr>
				<td><label for='km_min'><?php echo lang('km_min')?></label></td>
				<td><div id='km_min' class='number_general' name='km_min'></div></td>
			</tr>
			<tr>
				<td><label for='km_max'><?php echo lang('km_max')?></label></td>
				<td><div id='km_max' class='number_general' name='km_max'></div></td>
			</tr>
			<tr>
				<td><label for='period'><?php echo lang('period')?></label></td>
				<td><div id='period' class='number_general' name='period'></div></td>
			</tr>
			<tr>
				<td><label for='oil_change'><?php echo lang('oil_change')?></label></td>
				<td><input id='oil_change' class='text_input' name='oil_change'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxService_warranty_policySubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxService_warranty_policyCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var service_warranty_policiesDataSource =
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
			{ name: 'service_policy_no', type: 'number' },
			{ name: 'service_count', type: 'number' },
			{ name: 'km_min', type: 'number' },
			{ name: 'km_max', type: 'number' },
			{ name: 'period', type: 'number' },
			{ name: 'oil_change', type: 'string' },
			{ name: 'policy_name', type: 'string' },
			{ name: 'service_type_name', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/service_warranty_policies/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	service_warranty_policiesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridService_warranty_policy").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridService_warranty_policy").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridService_warranty_policy").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: service_warranty_policiesDataSource,
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
			container.append($('#jqxGridService_warranty_policyToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editService_warranty_policyRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("policy_name"); ?>',datafield: 'policy_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("service_type_name"); ?>',datafield: 'service_type_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("service_count"); ?>',datafield: 'service_count',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("km_min"); ?>',datafield: 'km_min',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("km_max"); ?>',datafield: 'km_max',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("period"); ?>',datafield: 'period',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridService_warranty_policy").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridService_warranty_policyFilterClear', function () { 
		$('#jqxGridService_warranty_policy').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridService_warranty_policyInsert', function () { 
		openPopupWindow('jqxPopupWindowService_warranty_policy', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowService_warranty_policy").jqxWindow({ 
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

	$("#jqxPopupWindowService_warranty_policy").on('close', function () {
		reset_form_service_warranty_policies();
	});

	$("#jqxService_warranty_policyCancelButton").on('click', function () {
		reset_form_service_warranty_policies();
		$('#jqxPopupWindowService_warranty_policy').jqxWindow('close');
	});

    /*$('#form-service_warranty_policies').jqxValidator({
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

			{ input: '#service_policy_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#service_policy_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#service_count', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#service_count').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#km_min', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#km_min').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#km_max', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#km_max').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#period', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#period').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#oil_change', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#oil_change').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxService_warranty_policySubmitButton").on('click', function () {
    	saveService_warranty_policyRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveService_warranty_policyRecord();
                }
            };
        $('#form-service_warranty_policies').jqxValidator('validate', validationResult);
        */
    });
});

function editService_warranty_policyRecord(index){
	var row =  $("#jqxGridService_warranty_policy").jqxGrid('getrowdata', index);
	if (row) {
		$('#service_warranty_policies_id').val(row.id);
		$('#service_policy_no').jqxNumberInput('val', row.service_policy_no);
		$('#service_count').jqxNumberInput('val', row.service_count);
		$('#km_min').jqxNumberInput('val', row.km_min);
		$('#km_max').jqxNumberInput('val', row.km_max);
		$('#period').jqxNumberInput('val', row.period);
		$('#oil_change').val(row.oil_change);
		
		openPopupWindow('jqxPopupWindowService_warranty_policy', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveService_warranty_policyRecord(){
	var data = $("#form-service_warranty_policies").serialize();
	
	$('#jqxPopupWindowService_warranty_policy').block({ 
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
		url: '<?php echo site_url("admin/service_warranty_policies/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_service_warranty_policies();
				$('#jqxGridService_warranty_policy').jqxGrid('updatebounddata');
				$('#jqxPopupWindowService_warranty_policy').jqxWindow('close');
			}
			$('#jqxPopupWindowService_warranty_policy').unblock();
		}
	});
}

function reset_form_service_warranty_policies(){
	$('#service_warranty_policies_id').val('');
	$('#form-service_warranty_policies')[0].reset();
}
</script>