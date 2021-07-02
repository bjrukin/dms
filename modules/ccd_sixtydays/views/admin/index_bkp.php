<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_sixtydays'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('ccd_sixtydays'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCcd_sixtydayToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCcd_sixtydayInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCcd_sixtydayFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCcd_sixtyday"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCcd_sixtyday">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<u><h3><div id="customer_name"></div></h3></u>
		<?php echo form_open('', array('id' =>'form-ccd_sixtydays', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "ccd_sixtydays_id"/>
		<table class="form-table">
			<tr>
				<td><label for='call_status'><?php echo lang('call_status')?></label></td>
				<td><div id='call_status' name='call_status'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='ownership_transfer'><?php echo lang('ownership_transfer')?></label></td>
				<td><div id='ownership_transfer' class='array_decisions' name='ownership_transfer'></div></td>
				<td><label for='performance'><?php echo lang('performance')?></label></td>
				<td><div id='performance' class='array_satisfaction' name='performance'></div></td>
			</tr>
			<tr class="inq_detail" style="display: none">
				<td><label for='smr_effectiveness'><?php echo lang('smr_effectiveness')?></label></td>
				<td><div id='smr_effectiveness' class='array_decisions' name='smr_effectiveness'></div></td>
				<td><label for='voc'><?php echo lang('voc')?></label></td>
				<td><input id='voc' class='text_area' name='voc'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_sixtydaySubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_sixtydayCancelButton"><?php echo lang('general_cancel'); ?></button>
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


		var ccd_sixtydaysDataSource =
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
			{ name: 'ownership_transfer', type: 'string' },
			{ name: 'performance', type: 'string' },
			{ name: 'smr_effectiveness', type: 'string' },
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
			url: '<?php echo site_url("admin/ccd_sixtydays/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ccd_sixtydaysDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCcd_sixtyday").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCcd_sixtyday").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCcd_sixtyday").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ccd_sixtydaysDataSource,
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
			container.append($('#jqxGridCcd_sixtydayToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editCcd_sixtydayRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
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
		{ text: '<?php echo lang("ownership_transfer"); ?>',datafield: 'ownership_transfer',width: 140,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("performance"); ?>',datafield: 'performance',width: 110,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("smr_effectiveness"); ?>',datafield: 'smr_effectiveness',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("voc"); ?>',datafield: 'voc',width: 170,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridCcd_sixtyday").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridCcd_sixtydayFilterClear', function () { 
	$('#jqxGridCcd_sixtyday').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridCcd_sixtydayInsert', function () { 
	openPopupWindow('jqxPopupWindowCcd_sixtyday', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowCcd_sixtyday").jqxWindow({ 
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

	$("#jqxPopupWindowCcd_sixtyday").on('close', function () {
		reset_form_ccd_sixtydays();
	});

	$("#jqxCcd_sixtydayCancelButton").on('click', function () {
		reset_form_ccd_sixtydays();
		$('#jqxPopupWindowCcd_sixtyday').jqxWindow('close');
	});

    /*$('#form-ccd_sixtydays').jqxValidator({
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

			{ input: '#ownership_transfer', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#ownership_transfer').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#performance', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#performance').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#smr_effectiveness', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#smr_effectiveness').val();
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

    $("#jqxCcd_sixtydaySubmitButton").on('click', function () {
    	saveCcd_sixtydayRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_sixtydayRecord();
                }
            };
        $('#form-ccd_sixtydays').jqxValidator('validate', validationResult);
        */
    });
});

function editCcd_sixtydayRecord(index){
	var row =  $("#jqxGridCcd_sixtyday").jqxGrid('getrowdata', index);
	if (row) {
		$('#ccd_sixtydays_id').val(row.id);
		$('#customer_name').html(row.full_name);
		$('#call_status').jqxComboBox('val',row.call_status);
		$('#ownership_transfer').jqxComboBox('val',row.ownership_transfer);
		$('#performance').jqxComboBox('val',row.performance);
		$('#smr_effectiveness').jqxComboBox('val',row.smr_effectiveness);
		$('#voc').val(row.voc);
		
		openPopupWindow('jqxPopupWindowCcd_sixtyday', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveCcd_sixtydayRecord(){
	var data = $("#form-ccd_sixtydays").serialize();
	
	$('#jqxPopupWindowCcd_sixtyday').block({ 
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
		url: '<?php echo site_url("admin/ccd_sixtydays/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_ccd_sixtydays();
				$('#jqxGridCcd_sixtyday').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCcd_sixtyday').jqxWindow('close');
			}
			$('#jqxPopupWindowCcd_sixtyday').unblock();
		}
	});
}

function reset_form_ccd_sixtydays(){
	$('#ccd_sixtydays_id').val('');
	$('#form-ccd_sixtydays')[0].reset();
}
</script>