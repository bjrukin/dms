<style type="text/css">
table.form-table td:nth-child(1){
	width:13%;
}
table.form-table td:nth-child(odd){
	width:13%;
}
table.form-table td:nth-child(even){
	width:20%;
}
</style>

<div id="jqxPopupWindowCustomerStatus">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="customer_statuses_window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-customer_statuses', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "customer_id" id = "customer_status_customer_id" value="<?php echo $customer_info->id;?>"/>
		<input type = "hidden" name='funding_bank' id='funding_bank' >
		<table class="form-table">
			<tr>
				<td><label for='status_id'><?php echo lang('status_id')?><span class='mandatory'>*</span></label></td>
				<td><div id='status_id' name='status_id'></div></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><label for='sub_status_id'><?php echo lang('sub_status_id')?><span class='mandatory'>*</span></label></td>
				<td><div id='sub_status_id' name='sub_status_id'></div></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class='quotation-row' style="display:none">
				<td><label for='quote_mrp'><?php echo lang('quote_mrp')?><span class='mandatory'>*</span></label></td>
				<td><div id='quote_mrp' class="number_general" name='quote_mrp' value="<?php echo $customer_info->price;?>"></div></td>
				<!-- <td><label for='quote_discount'><?php echo lang('quote_discount')?><span></span></label></td>
					<td><div id='quote_discount' class="number_general" name='quote_discount'></div></td> -->
				</tr>
				<tr class='quotation-row' style="display:none">
					<td><label for='quote_price'><?php echo lang('quote_price')?><span></span></label></td>
					<td><div id='quote_price' class="number_general" name='quote_price' value="<?php echo $customer_info->price;?>"></div></td>
					<td><label for='quote_unit'><?php echo lang('quote_unit')?><span class='mandatory'>*</span></label></td>
					<td><div id='quote_unit' class="number_general" name='quote_unit'></div></td>
				</tr>
				<tr class='bank-row' style="display:none">
					<td><label for='bank_id'><?php echo lang('bank_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='bank_id' name='bank_id'></div></td>
					<td><label for='bank_branch'><?php echo lang('bank_branch')?><span class='mandatory'>*</span></label></td>
					<td><input id='bank_branch' class='text_input' name='bank_branch'></td>
				</tr>
				<tr class='bank-row' style="display:none">
					<td><label for='bank_staff'><?php echo lang('bank_staff')?><span class='mandatory'>*</span></label></td>
					<td><input id='bank_staff' class='text_input' name='bank_staff'></td>
					<td><label for='bank_contact'><?php echo lang('bank_contact')?><span class='mandatory'>*</span></label></td>
					<td><input id='bank_contact' class='text_input' name='bank_contact'></td>
				</tr>
				<tr class="cancel_amount" style="display: none">
					<td><label for="booking_cancel_reason"><?php echo "Cancel Reason"//lang('booking_cancel_reason') ?></label></td>
					<td><div name="booking_cancel_reason" id="booking_cancel_reason"></div></td>
				</tr>
				<tr class="cancel_amount" style="display: none">
					<td><label for="cancel_amount"><?php echo lang('cancel_amount') ?></label></td>
					<td><input type="text" class="text_input" name="cancel_amount" id="amount_cancel"></td>
				</tr>				
				<tr class="cancel_amount" style="display: none">
					<td><label for='status_notes'><?php echo lang('status_notes')?></label></td>
					<td><input id='reason' class='text_area' name='reason'></td>
				</tr>
				<tr class='reason-row' style="display:none">
					<td><label for='reason_id'><?php echo lang('reason_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='reason_id' name='reason_id'></div></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr class="notes">
					<td><label for='status_notes'><?php echo lang('status_notes')?><span class='mandatory'>*</span></label></td>
					<td><input id='status_notes' class='text_area' name='notes'></td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomer_statusesSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomer_statusesCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>

			</table>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div id='jqxGridCustomer_statusToolbar' class='grid-toolbar'>
		<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCustomer_statusUpdate"><?php echo lang('general_update'); ?></button>
		<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomer_statusFilterClear"><?php echo lang('general_clear'); ?></button>
	</div>
	<div id="jqxGridCustomer_status"></div>

	<script language="javascript" type="text/javascript">

		var customer_statuses = function() {

			$("#quote_price").jqxNumberInput({
				readOnly : true,
			});

			$("#quote_mrp").jqxNumberInput({
				readOnly : true,
			});

			var data = new Array();
			var cancellation_reason = ["Lost to Competitors","Lost to Co-dealers","Banking Problem","Unavability of Stock","Personal Reason","Purchase Second Hand"];
			var k = 0;
			for (var i = 0; i < cancellation_reason.length; i++) {
				var row = {};
				row["cancellation_reasons"] = cancellation_reason[k];
				data[i] = row;
				k++;
			}
			var source =
			{
				localdata: data,
				datatype: "array"
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			$('#booking_cancel_reason').jqxComboBox({ selectedIndex: -1,  source: dataAdapter, displayMember: "cancellation_reasons", height: 25, width: 195,placeHolder:'Choose a option' });

			var InquiryDataSource  = {
				url : '<?php echo site_url("admin/customers/get_customer_inquiry_statuses"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				async: false,
				cache: true
			}	

			InquiryDataAdapter = new $.jqx.dataAdapter(InquiryDataSource);

			$("#status_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: InquiryDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});

			$("#status_id").select('bind', function (event) {
				if (!event.args)
					return;
				status_id =  $("#status_id").jqxComboBox('val');
				show_reason = null;
				$('.notes').show();
				$('.bank-row').hide();
				$('.quotation-row').hide();

				if (status_id == <?php echo STATUS_PENDING; ?>) {
					var SubStatusDataSource  = {
						url : '<?php echo site_url("admin/customers/get_customer_inquiry_sub_statuses"); ?>',
						datatype: 'json',
						datafields: [
						{ name: 'id', type: 'number' },
						{ name: 'name', type: 'string' },
						],
						data:{ id : 1 },
						async: false,
						cache: true
					}	

				}
				else if (status_id == <?php echo STATUS_CONFIRMED; ?>) {
					var SubStatusDataSource  = {
						url : '<?php echo site_url("admin/customers/get_customer_inquiry_sub_statuses"); ?>',
						datatype: 'json',
						datafields: [
						{ name: 'id', type: 'number' },
						{ name: 'name', type: 'string' },
						],
						data:{ id : 1 },
						async: false,
						cache: true
					}	

				}
				else if (status_id == <?php echo STATUS_BOOKED; ?>) {
					var SubStatusDataSource  = {
						url : '<?php echo site_url("admin/customers/get_customer_inquiry_sub_statuses"); ?>',
						datatype: 'json',
						datafields: [
						{ name: 'id', type: 'number' },
						{ name: 'name', type: 'string' },
						],
						data:{ id : 1 },
						async: false,
						cache: true
					}
				}
				else if (status_id == <?php echo STATUS_RETAIL; ?>) {
					var SubStatusDataSource  = {
						url : '<?php echo site_url("admin/customers/get_customer_inquiry_sub_statuses"); ?>',
						datatype: 'json',
						datafields: [
						{ name: 'id', type: 'number' },
						{ name: 'name', type: 'string' },
						],
						data:{ id : 2 },
						async: false,
						cache: true
					}
				}
				else if (status_id == <?php echo STATUS_CLOSED; ?>) {
					var SubStatusDataSource  = {
						url : '<?php echo site_url("admin/customers/get_customer_inquiry_sub_statuses"); ?>',
						datatype: 'json',
						datafields: [
						{ name: 'id', type: 'number' },
						{ name: 'name', type: 'string' },
						],
						data:{ id : 3 },
						async: false,
						cache: true
					}
				}

				SubStatusDataAdapter = new $.jqx.dataAdapter(SubStatusDataSource);

				$("#sub_status_id").jqxComboBox({
					theme: theme,
					width: 195,
					height: 25,
					selectionMode: 'dropDownList',
					autoComplete: true,
					searchMode: 'containsignorecase',
					source: SubStatusDataAdapter,
					displayMember: "name",
					valueMember: "id",
				});
			});

    //reason
    $("#sub_status_id").select('bind', function (event) {
    	if (!event.args)
    		return;
    	sub_status_id =  $("#sub_status_id").jqxComboBox('val');
    	show_reason = null;

    	if (sub_status_id == <?php echo STATUS_QUOTATION_ISSUED; ?>) {		// STATUS_QUOTATION_ISSUED
    		//check if payment_mode is FINANCE
    		$('.notes').hide();
    		$('.quotation-row').show();
    		<?php if ($customer_info->payment_mode_id == PAYMENT_MODE_FINANCE) : ?>
    		$('#funding_bank').val('1');
    		$('.bank-row').show();

    			//mst_banks
    			masterDataSource.data = { table_name: 'mst_banks' };

    			bankDataAdapter = new $.jqx.dataAdapter(masterDataSource);

    			$("#bank_id").jqxComboBox({
					// theme: theme,
					width: 195,
					selectionMode: 'dropDownList',
					autoComplete: true,
					searchMode: 'containsignorecase',
					source: bankDataAdapter,
					displayMember: "name",
					valueMember: "id",
				});

    			<?php //else: ?>

    			<?php endif; ?>

    			return;
    	} else if (sub_status_id == <?php echo STATUS_LOST; ?>) {    	// STATUS_RETAIL
    		show_reason = 'mst_reasons_lost';
    		$('.cancel_amount').hide();
    		$('.bank-row').hide();
    		$('.quotation-row').hide();
    		$('.notes').show();
    	} else if (sub_status_id == <?php echo STATUS_CANCEL; ?>) {    	// STATUS_CANCEL
    		show_reason = 'mst_reasons_cancel';
    		$('.cancel_amount').hide();
    		$('.bank-row').hide();
    		$('.quotation-row').hide();
    		$('.notes').show();
    	}  else if (sub_status_id == <?php echo STATUS_BOOKING_CANCEL; ?>) {    	// STATUS_CLOSED
    		$('.cancel_amount').show();
    		$('.bank-row').hide();
    		$('.quotation-row').hide();
    		$('.notes').hide();

    	}
    	else if (sub_status_id == <?php echo STATUS_DOCUMENT_COMPLETE; ?>) {    	// STATUS_DOCUMENT_COMPLETE
    		$('.cancel_amount').hide();
    		$('.bank-row').hide();
    		$('.quotation-row').hide();
    		$('.notes').show();
    	}
    	else if (sub_status_id == <?php echo STATUS_DO_APPROVAL; ?>) {    	// STATUS_CLOSED
    		$('.cancel_amount').hide();
    		$('.bank-row').hide();
    		$('.quotation-row').hide();
    		$('.notes').show();
    	}



    	if (show_reason != null) {
    		$('.reason-row').show();
			//mst_reasons
			masterDataSource.data = { table_name: show_reason };

			reasonDataAdapter = new $.jqx.dataAdapter(masterDataSource);

			$("#reason_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: reasonDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});

			if (sub_status_id == <?php echo STATUS_REJECT_BEFORE; ?> ||
				sub_status_id == <?php echo STATUS_REJECT_AFTER; ?>  ||
				sub_status_id == <?php echo STATUS_VEHICLE_DELIVER_WITHOUT_DO; ?>) {
				$("#bank_id").jqxComboBox('clearSelection');
				$("#bank_id").jqxComboBox('selectIndex', -1);
				$('#funding_bank, #bank_branch, #bank_staff, #bank_contact').val('');
				$('.bank-row').hide();
				$('.quotation-row').hide();
				$('.notes').show();
			}

		} else {
			$("#reason_id").jqxComboBox('clearSelection');
			$("#reason_id").jqxComboBox('selectIndex', -1);
			$('.reason-row').hide();

			$("#bank_id").jqxComboBox('clearSelection');
			$("#bank_id").jqxComboBox('selectIndex', -1);
			$('#funding_bank, #bank_branch, #bank_staff, #bank_contact').val('');
			$('.bank-row').hide();
			$('.quotation-row').hide();

		}
	});

    $("#bank_id").select('bind', function (event) {
    	bank_id = $("#bank_id").jqxComboBox('val');

    	if (bank_id == <?php echo OTHER_BANK_ID;?> ) {
    		$('.reason-row').show();
			//mst_reasons
			masterDataSource.data = { table_name: 'mst_reasons_other_bank' };

			reasonDataAdapter = new $.jqx.dataAdapter(masterDataSource);

			$("#reason_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: reasonDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});
		} else {
			$('#bank_branch, #bank_staff, #bank_contact').val('');

			$("#reason_id").jqxComboBox('clearSelection');
			$("#reason_id").jqxComboBox('selectIndex', -1);
			$('.reason-row').hide();
		}
	});

    var customer_statusesDataSource =
    {
    	datatype: "json",
    	datafields: [
    	{ name: 'id', type: 'number' },
    	{ name: 'created_by', type: 'number' },
    	{ name: 'updated_by', type: 'number' },
    	{ name: 'deleted_by', type: 'number' },
    	{ name: 'created_at', type: 'date' },
    	{ name: 'updated_at', type: 'string' },
    	{ name: 'deleted_at', type: 'string' },
    	{ name: 'customer_id', type: 'number' },
    	{ name: 'status_id',   type: 'number' },
    	{ name: 'duration',   type: 'number' },
    	{ name: 'notes',	type: 'string' },
    	{ name: 'reason_id', type: 'string' },
    	{ name: 'reason_name', type: 'string' },
    	{ name: 'status_name', type: 'string' },
    	{ name: 'sub_status_name', type: 'string' },

    	],
    	url: '<?php echo site_url("admin/customers/customer_statuses_json"); ?>',
    	pagesize: defaultPageSize,
    	root: 'rows',
    	id : 'id',
    	data: {
    		customer_id: '<?php echo $customer_info->id;; ?>'
    	},
    	cache: true,
    	pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	customer_statusesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCustomer_status").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCustomer_status").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCustomer_status").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: customer_statusesDataSource,
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
			container.append($('#jqxGridCustomer_statusToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: '<?php echo lang("status_date"); ?>',datafield: 'created_at',width: 150,width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd_HH_mm},
		{ text: '<?php echo lang("status_id"); ?>',datafield: 'status_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("sub_status_name"); ?>',datafield: 'sub_status_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("duration_status"); ?>',datafield: 'duration',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("status_notes"); ?>',datafield: 'notes',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("reason_id"); ?>',datafield: 'reason_name',filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridCustomer_status").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCustomer_statusFilterClear', function () { 
		$('#jqxGridCustomer_status').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCustomer_statusUpdate', function () { 
		$('#customer_statuses_window_poptup_title').html('<?php echo lang("general_update")  . "&nbsp;" .  lang("customer_statuses"); ?>');

		openPopupWindow('jqxPopupWindowCustomerStatus', 'N/A');
	});

    // initialize the popup window
    $("#jqxPopupWindowCustomerStatus").jqxWindow({ 
    	theme: theme,
    	width: 650,
    	maxWidth: 650,
    	height: 400,  
    	maxHeight: 400,  
    	isModal: true, 
    	autoOpen: false,
    	modalOpacity: 0.7,
    	showCollapseButton: false 
    });

    $("#jqxPopupWindowCustomerStatus").on('close', function () {
    	reset_form_customer_statuses();
    });

    $("#jqxCustomer_statusesCancelButton").on('click', function () {
    	reset_form_customer_statuses();
    	$('#jqxPopupWindowCustomerStatus').jqxWindow('close');
    });

    $("#jqxCustomer_statusesSubmitButton").on('click', function () {
    	var validationResult = function (isValid) {
    		console.log(isValid);
    		if (isValid) {
    			saveCustomer_statusRecord();
    		}
    	};
    	$('#form-customer_statuses').jqxValidator('validate', validationResult);
    });

    $('#form-customer_statuses').jqxValidator({
    	hintType: 'label',
    	animationDuration: 500,
    	rules: [

    	{ input: '#status_id', message: 'Required', action: 'blur', 
    	rule: function(input) {
    		val = $('#status_id').jqxComboBox('val');
    		return (val == '' || val == null || val == 0) ? false: true;
    	}
    },
    { input: '#reason', message: 'Required', action: 'blur', 
    rule: function(input) {
    	var sub_status_id = $('#sub_status_id').val();
    	if(sub_status_id == <?php echo STATUS_BOOKING_CANCEL; ?> )
    	{    			
    		val = $('#reason').val();
    		return (val == '' || val == null || val == 0) ? false: true;
    	}
    	else
    	{
    		return true;
    	}
    }
},
{ input: '#booking_cancel_reason', message: 'Required', action: 'blur', 
    rule: function(input) {
    	var sub_status_id = $('#sub_status_id').val();
    	if(sub_status_id == '<?php echo STATUS_BOOKING_CANCEL;?>')
    	{    			
    		val = $('#booking_cancel_reason').jqxComboBox('val');
    		return (val == '' || val == null || val == 0) ? false: true;
    	}
    	else
    	{
    		return true;
    	}
    }
},
{ input: '#amount_cancel', message: 'Required', action: 'blur', 
    rule: function(input) {
    	var sub_status_id = $('#sub_status_id').val();
    	if(sub_status_id == '<?php echo STATUS_BOOKING_CANCEL;?>')
    	{    			
    		val = $('#amount_cancel').val();
    		return (val == '' || val == null || val == 0) ? false: true;
    	}
    	else
    	{
    		return true;
    	}
    }
},
{ input: '#status_notes', message: 'Required', action: 'blur', 
    rule:function(input) {
    	var sub_status_id = $('#sub_status_id').val();
    	if(sub_status_id == '<?php echo STATUS_CANCEL; ?>')
    	{    			
    		val = $('#status_notes').val();
    		return (val == '' || val == null || val == 0) ? false: true;
    	}
    	else
    	{
    		return true;
    	}
    }
},

/*    { input: '#reason_id', message: 'Required', action: 'blur', 
    rule: function(input) {
    	status_id = $('#status_id').jqxComboBox('val');
    	if (
    		status_id == '<?php echo STATUS_LOST;?>'
    		|| status_id == '<?php echo STATUS_LOST;?>'
    		|| status_id == '<?php echo STATUS_CANCEL;?>'
    		|| status_id == '<?php echo STATUS_CLOSED;?>'
    		) {
    		val = $('#reason_id').jqxComboBox('val');
    	return (val == '' || val == null || val == 0) ? false: true;
    } else {
    	return true;
    }
}
},*/

{ input: '#reason_id', message: 'Required', action: 'blur', 
rule: function(input) {
	status_id = $('#status_id').jqxComboBox('val');
	bank_id = $('#bank_id').jqxComboBox('val');
	if ( status_id == '<?php echo STATUS_QUOTATION_ISSUED;?>' && bank_id == '<?php echo OTHER_BANK_ID;?>') {
		val = $('#reason_id').jqxComboBox('val');
		return (val == '' || val == null || val == 0) ? false: true;
	} else {
		return true;
	}
}
},

{ input: '#quote_mrp', message: 'Required', action: 'blur', 
rule: function(input) {
	status_id = $('#status_id').jqxComboBox('val');
	if (
		status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
		) {
		val = $('#quote_mrp').jqxNumberInput('val');
	console.log(val);
	return (val == '' || val == null || val == 0) ? false: true;
} else {
	return true;
}
}
},

			// { input: '#quote_discount', message: 'Required', action: 'blur', 
			// 	rule: function(input) {
			// 		status_id = $('#status_id').jqxComboBox('val');
			// 		if (
			// 			status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
			// 		) {
			// 			val = $('#quote_discount').jqxNumberInput('val');
			// 			return (val == '' || val == null || val == 0) ? false: true;
			// 		} else {
			// 			return true;
			// 		}
			// 	}
			// },

			{ input: '#quote_price', message: 'Required', action: 'blur', 
			rule: function(input) {
				status_id = $('#status_id').jqxComboBox('val');
				if (
					status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
					) {
					val = $('#quote_price').jqxNumberInput('val');
				console.log(val);
				return (val == '' || val == null || val <= 0) ? false: true;
			} else {
				return true;
			}
		}
	},

	{ input: '#quote_unit', message: 'Required', action: 'blur', 
	rule: function(input) {
		status_id = $('#status_id').jqxComboBox('val');
		if (
			status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
			) {
			val = $('#quote_unit').jqxNumberInput('val');
		return (val == '' || val == null || val == 0) ? false: true;
	} else {
		return true;
	}
}
},

<?php if ($customer_info->payment_mode_id == PAYMENT_MODE_FINANCE) : ?>
{ input: '#bank_id', message: 'Required', action: 'blur', 
rule: function(input) {
	status_id = $('#status_id').jqxComboBox('val');
	if (
		status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
		) {
		val = $('#bank_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
} else {
	return true;
}
}
},

{ input: '#bank_branch', message: 'Required', action: 'blur', 
rule: function(input) {
	status_id = $('#status_id').jqxComboBox('val');
	if (
		status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
		) {
		val = $('#bank_branch').val();
	return (val == '' || val == null || val == 0) ? false: true;
} else {
	return true;
}
}
},

{ input: '#bank_staff', message: 'Required', action: 'blur', 
rule: function(input) {
	status_id = $('#status_id').jqxComboBox('val');
	if (
		status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
		) {
		val = $('#bank_staff').val();
	return (val == '' || val == null || val == 0) ? false: true;
} else {
	return true;
}
}
},

{ input: '#bank_contact', message: 'Required', action: 'blur', 
rule: function(input) {
	status_id = $('#status_id').jqxComboBox('val');
	if (
		status_id == '<?php echo STATUS_QUOTATION_ISSUED; ?>' 
		) {
		val = $('#bank_contact').val();
	return (val == '' || val == null || val == 0) ? false: true;
} else {
	return true;
}
}
},
<?php endif;?>

]
});

/*$("#quote_mrp, #quote_discount").on('keyup', function(){
	quote_mrp = $("#quote_mrp").jqxNumberInput('val');
	quote_discount = $("#quote_discount").jqxNumberInput('val');

	quote_price = parseInt(quote_mrp) - parseInt(quote_discount);

	$("#quote_price").jqxNumberInput('val', quote_price);
});*/
};

function saveCustomer_statusRecord() {
	
	var data = $("#form-customer_statuses").serialize();
	
	$('#jqxPopupWindowCustomerStatus').block({ 
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
		url: '<?php echo site_url("admin/customers/save_customer_status"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_customer_test_drives();
				$('#jqxGridCustomer_status').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCustomerStatus').jqxWindow('close');
			}
			$('#jqxPopupWindowCustomerStatus').unblock();
		}
	});
}

function reset_form_customer_statuses() {

	$('#funding_bank').val('');

	$('#form-customer_statuses')[0].reset();

	$('#status_id').jqxComboBox('clearSelection');
	$('#reason_id').jqxComboBox('clearSelection');
	$('#bank_id').jqxComboBox('clearSelection');

	$('#status_id').jqxComboBox('selectIndex', '-1');
	$('#sub_status_id').jqxComboBox('selectIndex', '-1');
	$('#reason_id').jqxComboBox('selectIndex', '-1');
	$('#bank_id').jqxComboBox('selectIndex', '-1');

	$('.reason-row').hide();
	$('.bank-row').hide();
	$('.quotation-row').hide();
	$('.cancel_amount').hide();
}

</script>