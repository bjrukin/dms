<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_retail'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('stock_records'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
                    <?php /*<div class="col-xs-12">
                        <select name="stock_yard_id" id='stock_yard_id'>
                            <option>--select stock-yard--</option>
                            <?php foreach($stock_yards as $key => $value){?>
                            <option value="<?php echo $value->id?>"><?php echo $value->name?></option>
                            <?php }?>
                        </select>
                        </div>*/?>
                        <div class="col-xs-12 connectedSortable">
                        	<?php echo displayStatus(); ?>
<!--				<div id='jqxGridStock_recordToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_recordInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_recordFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>-->
				<div id="jqxGridStock_record"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- <div id="jqxPopupWindowStock_record">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-stock_records', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "stock_id" id = "stock_records_id"/>
		<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id"/>
		<table class="form-table">
			<tr>
				<td><label for='chass_no'><?php echo lang('chass_no')?></label></td>
				<td><input id='chass_no' class='text_input' name='chass_no' readonly="readonly"></td>
			</tr>
			<tr>
				<td><label for='retail_date'><?php echo lang('retail_date')?></label></td>
				<td><div id='retail_date' class='date_box' name='retail_date'></div></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_recordSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div> -->
<div id="jqxPopupWindowStock_record">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-stock_records', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "stock_id" id = "stock_records_id"/>
		<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id"/>
		<table class="form-table">
			<tr>
				<td><label for='chass_no'><?php echo lang('chass_no')?></label></td>
				<td><input id='chass_no' class='text_input' name='chass_no' readonly="readonly"></td>
			</tr>
			<tr>
				<td><label for='nepali_month'><?php echo lang('nepali_month')?></label></td>
				<td><div id='nepali_month' class='date_box' name='nepali_month'></div></td>
			</tr>
			<tr>
				<td><label for='change_retail_date'><?php echo lang('retail_date')?></label></td>
				<td><div id='change_retail_date' class='date_box' name='change_retail_date'></div></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_recordSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>



		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var nepali_monthDataSource  = {
			url : '<?php echo site_url("admin/dealer_orders/get_nepali_month_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		nepali_monthDataAdapter = new $.jqx.dataAdapter(nepali_monthDataSource);

		$("#nepali_month").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			placeHolder: "Select Month",
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: nepali_monthDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		// $("#retail_date").jqxDateTimeInput({ width: '250px', height: '25px' });

		var stock_recordsDataSource =
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
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'color_code', type: 'string' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'chass_no', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'district_name', type: 'string' },
			{ name: 'mun_vdc_name', type: 'string' },
			{ name: 'full_name', type: 'string' },
			{ name: 'retail_date', type: 'date' },
			{ name: 'executive_name', type: 'string' },
			{ name: 'booking_receipt_no', type: 'string' },
			{ name: 'inquiry_no', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'customer_type_name', type: 'string' },
			{ name: 'firm_name', type: 'string' },
			{ name: 'year', type: 'number' },
			{ name: 'sales_vehicle_id', type: 'number' },
			{ name: 'booked_date', type: 'date' },
			{ name: 'source_name', type: 'string' },
			{ name: 'nepali_month', type: 'string' },
			{ name: 'edit_month', type: 'string' },
			{ name: 'mobile_1', type: 'string' },
			{ name: 'log_retail_month', type: 'string' },
			{ name: 'log_retail_date', type: 'date' },
			],
			url: '<?php echo site_url("admin/stock_records/dealer_retail_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stock_recordsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStock_record").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStock_record").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStock_record").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stock_recordsDataSource,
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
		selectionmode: 'multiplecellsadvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridStock_recordToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				<?php if(is_admin() || is_logistic_user() || is_logistic_executive() || is_logistic_group_user()): ?>
				var e = '<a href="javascript:void(0)" onclick="change_Retaildate(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				<?php if(control('Retail Date Change',False)): ?>
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				<?php endif; ?>
			<?php endif; ?>
		}
	},
	{ text: '<?php echo lang("retail_date"); ?>',datafield: 'retail_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
	{ text: '<?php echo lang("booked_date"); ?>',datafield: 'booked_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
	{ text: '<?php echo lang("inquiry_no"); ?>',datafield: 'inquiry_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("booking_receipt_no"); ?>',datafield: 'booking_receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("color_code"); ?>',datafield: 'color_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("mfg_year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("firm_name"); ?>',datafield: 'firm_name',width: 150,filterable: true,renderer: gridColumnsRenderer },

	{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("executive_name"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("full_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("mobile_1"); ?>',datafield: 'mobile_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("district_name"); ?>',datafield: 'district_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("mun_vdc_name"); ?>',datafield: 'mun_vdc_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("customer_type_name"); ?>',datafield: 'customer_type_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("source_name"); ?>',datafield: 'source_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
	<?php 	if(is_logistic_user() || is_logistic_executive() || is_admin() || is_sales_head()): ?>
		{ text: '<?php echo "Edit Month" ?>',datafield: 'edit_month',width: 150,filterable: true,renderer: gridColumnsRenderer },
	<?php endif; ?>
	<?php 	if(is_logistic_user() || is_logistic_executive() || is_admin() || is_sales_head()): ?>
		{ text: '<?php echo "Previous Retail Date" ?>',datafield: 'log_retail_date',width: 150,filterable: true,renderer: gridColumnsRenderer ,columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
	<?php endif; ?>
	<?php 	if(is_logistic_user() || is_logistic_executive() || is_admin() || is_sales_head()): ?>
		{ text: '<?php echo "Previous Retail Month" ?>',datafield: 'log_retail_month',width: 150,filterable: true,renderer: gridColumnsRenderer },
	<?php endif; ?>
	],
	rendergridrows: function (result) {
		return result.data;
	}
});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridStock_record").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridStock_recordFilterClear', function () { 
	$('#jqxGridStock_record').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridStock_recordInsert', function () { 
	openPopupWindow('jqxPopupWindowStock_record', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowStock_record").jqxWindow({ 
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

	$("#jqxPopupWindowStock_record").on('close', function () {
		reset_form_stock_records();
	});

	$("#jqxStock_recordCancelButton").on('click', function () {
		reset_form_stock_records();
		$('#jqxPopupWindowStock_record').jqxWindow('close');
	});

    /*$('#form-stock_records').jqxValidator({
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

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#stock_yard_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stock_yard_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#reached_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#reached_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatched_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatched_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxStock_recordSubmitButton").on('click', function () {
    	save_Changeretail_date();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   change_Retaildate();
                }
            };
        $('#form-stock_records').jqxValidator('validate', validationResult);
        */
    });
});

function change_Retaildate(index){
	var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
	if (row) {
		$('#stock_records_id').val(row.id);
		$('#chass_no').val(row.chass_no);
		$('#vehicle_process_id').val(row.sales_vehicle_id);
		//$('#stock_records_id').jqxDateTimeInput(row.retail_date);
		openPopupWindow('jqxPopupWindowStock_record', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function save_Changeretail_date(){
	var data = $("#form-stock_records").serialize();
	
	$('#jqxPopupWindowStock_record').block({ 
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
		url: '<?php echo site_url("admin/stock_records/save_retail_month_change"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_stock_records();
				$('#jqxGridStock_record').jqxGrid('updatebounddata');
				$('#jqxPopupWindowStock_record').jqxWindow('close');
			}
			$('#jqxPopupWindowStock_record').unblock();
		}
	});
}

function reset_form_stock_records(){
	$('#stock_records_id').val('');
	$('#form-stock_records')[0].reset();
}
</script>