<div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_thirtydays'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('ccd_thirtydays'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCcd_thirtydayToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCcd_thirtydayInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCcd_thirtydayFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCcd_thirtyday"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->

	<div id="jqxPopupWindowCcd_thirtyday">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title"></span>
		</div>
		<div class="form_fields_area">
			<u><h3><div id="customer_name"></div></h3></u>
			<?php echo form_open('', array('id' =>'form-ccd_thirtydays', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "id" id = "ccd_thirtydays_id"/>
			<table class="form-table">
				<tr>
					<td><label for='call_status'><?php echo lang('call_status')?></label></td>
					<td><div id='call_status' name='call_status'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='product_feedback'><?php echo lang('product_feedback')?></label></td>
					<td><div id='product_feedback' class='array_ccd_remarks' name='product_feedback'></div></td>
					<td><label for='bluebook_copy'><?php echo lang('bluebook_copy')?></label></td>
					<td><div id='bluebook_copy' class='array_decisions' name='bluebook_copy'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='green_sticker'><?php echo lang('green_sticker')?></label></td>
					<td><div id='green_sticker' class='array_decisions' name='green_sticker'></div></td>
					<td><label for='payment_receipts'><?php echo lang('payment_receipts')?></label></td>
					<td><div id='payment_receipts' class='array_decisions' name='payment_receipts'></div></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='recommend_name1'><?php echo lang('recommend_name1')?></label></td>
					<td><input id='recommend_name1' class='text_input' name='recommend_name1'></td>
					<td><label for='recommend_contact1'><?php echo lang('recommend_contact1')?></label></td>
					<td><input id='recommend_contact1' class='text_input' name='recommend_contact1'></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='recommend_name2'><?php echo lang('recommend_name2')?></label></td>
					<td><input id='recommend_name2' class='text_input' name='recommend_name2'></td>
					<td><label for='recommend_contact2'><?php echo lang('recommend_contact2')?></label></td>
					<td><input id='recommend_contact2' class='text_input' name='recommend_contact2'></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='recommend_name3'><?php echo lang('recommend_name3')?></label></td>
					<td><input id='recommend_name3' class='text_input' name='recommend_name3'></td>
					<td><label for='recommend_contact3'><?php echo lang('recommend_contact3')?></label></td>
					<td><input id='recommend_contact3' class='text_input' name='recommend_contact3'></td>
				</tr>
				<tr class="inq_detail" style="display: none">
					<td><label for='remarks'><?php echo lang('remarks')?></label></td>
					<td><div id='remarks' class='array_ccd_remarks' name='remarks'></div></td>
					<td><label for='voc'><?php echo lang('voc')?></label></td>
					<td><input id='voc' class='text_area' name='voc'></td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_thirtydaySubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_thirtydayCancelButton"><?php echo lang('general_cancel'); ?></button>
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

		var ccd_thirtydaysDataSource =
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
			{ name: 'product_feedback', type: 'string' },
			{ name: 'bluebook_copy', type: 'string' },
			{ name: 'green_sticker', type: 'string' },
			{ name: 'payment_receipts', type: 'string' },
			{ name: 'recommend_name1', type: 'string' },
			{ name: 'recommend_contact1', type: 'string' },
			{ name: 'recommend_name2', type: 'string' },
			{ name: 'recommend_contact2', type: 'string' },
			{ name: 'recommend_name3', type: 'string' },
			{ name: 'recommend_contact3', type: 'string' },
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
			url: '<?php echo site_url("admin/ccd_thirtydays/json/{$days}/dashboard"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ccd_thirtydaysDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCcd_thirtyday").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCcd_thirtyday").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCcd_thirtyday").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ccd_thirtydaysDataSource,
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
			container.append($('#jqxGridCcd_thirtydayToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxGridCcd_thirtyday").jqxGrid('getrowdata', index);
				if(row.call_status != 'Connected')
				{
					var e = '<a href="javascript:void(0)" onclick="editCcd_thirtydayRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
		{ text: '<?php echo lang("call_status"); ?>',datafield: 'call_status',width: 110,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("call_count"); ?>',datafield: 'call_count',width: 80,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("date_of_call"); ?>',datafield: 'date_of_call',width: 110,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("product_feedback"); ?>',datafield: 'product_feedback',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bluebook_copy"); ?>',datafield: 'bluebook_copy',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("green_sticker"); ?>',datafield: 'green_sticker',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("payment_receipts"); ?>',datafield: 'payment_receipts',width: 120,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("voc"); ?>',datafield: 'voc',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("recommend_name1"); ?>',datafield: 'recommend_name1',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("recommend_contact1"); ?>',datafield: 'recommend_contact1',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("recommend_name2"); ?>',datafield: 'recommend_name2',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("recommend_contact2"); ?>',datafield: 'recommend_contact2',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("recommend_name3"); ?>',datafield: 'recommend_name3',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("recommend_contact3"); ?>',datafield: 'recommend_contact3',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridCcd_thirtyday").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridCcd_thirtydayFilterClear', function () { 
	$('#jqxGridCcd_thirtyday').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridCcd_thirtydayInsert', function () { 
	openPopupWindow('jqxPopupWindowCcd_thirtyday', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowCcd_thirtyday").jqxWindow({ 
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

	$("#jqxPopupWindowCcd_thirtyday").on('close', function () {
		reset_form_ccd_thirtydays();
	});

	$("#jqxCcd_thirtydayCancelButton").on('click', function () {
		reset_form_ccd_thirtydays();
		$('#jqxPopupWindowCcd_thirtyday').jqxWindow('close');
	});

    /*$('#form-ccd_thirtydays').jqxValidator({
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

			{ input: '#product_feedback', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#product_feedback').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bluebook_copy', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bluebook_copy').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#green_sticker', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#green_sticker').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#payment_receipts', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#payment_receipts').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#recommend_name1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#recommend_name1').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#recommend_contact1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#recommend_contact1').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#recommend_name2', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#recommend_name2').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#recommend_contact2', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#recommend_contact2').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#recommend_name3', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#recommend_name3').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#recommend_contact3', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#recommend_contact3').val();
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

    $("#jqxCcd_thirtydaySubmitButton").on('click', function () {
    	saveCcd_thirtydayRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_thirtydayRecord();
                }
            };
        $('#form-ccd_thirtydays').jqxValidator('validate', validationResult);
        */
    });
});

function editCcd_thirtydayRecord(index){
	var row =  $("#jqxGridCcd_thirtyday").jqxGrid('getrowdata', index);
	if (row) {
		$('#ccd_thirtydays_id').val(row.id);
		$('#customer_name').html(row.full_name);
		$('#call_status').jqxComboBox('val',row.call_status);
		$('#product_feedback').jqxComboBox('val',row.product_feedback);
		$('#bluebook_copy').jqxComboBox('val',row.bluebook_copy);
		$('#green_sticker').jqxComboBox('val',row.green_sticker);
		$('#payment_receipts').jqxComboBox('val',row.payment_receipts);
		$('#recommend_name1').val(row.recommend_name1);
		$('#recommend_contact1').val(row.recommend_contact1);
		$('#recommend_name2').val(row.recommend_name2);
		$('#recommend_contact2').val(row.recommend_contact2);
		$('#recommend_name3').val(row.recommend_name3);
		$('#recommend_contact3').val(row.recommend_contact3);
		$('#remarks').jqxComboBox('val',row.remarks);
		$('#voc').val(row.voc);

		openPopupWindow('jqxPopupWindowCcd_thirtyday', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveCcd_thirtydayRecord(){
	var data = $("#form-ccd_thirtydays").serialize();

	$('#jqxPopupWindowCcd_thirtyday').block({ 
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
		url: '<?php echo site_url("admin/ccd_thirtydays/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_ccd_thirtydays();
				$('#jqxGridCcd_thirtyday').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCcd_thirtyday').jqxWindow('close');
			}
			$('#jqxPopupWindowCcd_thirtyday').unblock();
		}
	});
}

function reset_form_ccd_thirtydays(){
	$('#ccd_thirtydays_id').val('');
	$('#form-ccd_thirtydays')[0].reset();
}
</script>