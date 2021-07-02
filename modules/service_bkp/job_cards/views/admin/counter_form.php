	<?php echo form_open('', array('id' =>'form-counter_sale', 'onsubmit' => 'return false')); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-2">Payment</div>
				<div class="col-md-10" >
					<div id='' class="counter_sale-payment_type" name="payment_type" value="cash" style="float: left;" >Cash</div>
					<div id='' class="counter_sale-payment_type" name="payment_type" value="credit" style="float: left;">Credit</div>
					<div id='' class="counter_sale-payment_type" name="payment_type" value="card" style="float: left;">Card</div>
					<input type="hidden" name="payment_type_val" id="counter_sale-payment_type">
				</div>
			</div>
			<div class="row"> 
				<div class="col-md-2"> Date/Time</div>
				<div class="col-md-10"> <div id='' class="jqxdatetimeinput" name=issue_date></div></div>
			</div>
			<div class="row">
				<div class="col-md-2">Invoice No.</div>
				<div class="col-md-10 form-inline">
					<input type="text" name="invoice_no-prefix" class="form-control">

					<input type="text" name="invoice_no" class="form-control" value="<?php echo $bill_id?>">
					<button type="button" class="btn btn-flat btn-sm" onclick="findCounterInvoice()"><i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-2"> Cash A/C. </div>
				<div class="col-md-10"> <div id='jqxdropdownlist' name="cash_account"> </div> </div>
			</div> -->
			<div class="row">
				<div class="col-md-2"> Party Name </div>
				<div class="col-md-10">  <div id='counter_sale-credit_account' name="credit_account"> </div> </div>
			</div>
		</div>
		<div class="col-md-6">
			<fieldset>
				<legend>Party Details</legend>
				<div class="row">
					<div class="col-md-2">Vehicle No.</div>
					<div class="col-md-4"><input type="text" name="vehicle_no" class="form-control input-sm" value="<?php //echo //$vehicle_detail->vehicle_no; ?>" ></div>
					<div class="col-md-2">Model</div>
					<div class="col-md-4"><input type="text" name="model_no" class="form-control input-sm" value="<?php //echo //$vehicle_detail->vehicle_name; ?>" ></div>
				</div>
				<!-- <div class="row">
					<div class="col-md-2">Party</div>
					<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php //echo $vehicle_detail->full_name; ?>" readonly></div>
				</div> -->
				<div class="row">
					<div class="col-md-2">Address</div>
					<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php //echo //$vehicle_detail->address1; ?>" readonly></div>
					<div class="col-md-offset-2 col-md-10"><input type="text" name="" class="form-control input-sm"  value="<?php //echo //$vehicle_detail->address2; ?>" readonly></div>
				</div>
			</fieldset>
		</div>
	</div>
	<?php echo form_close(); ?>

	<!-- ############################## for material grid ############################## -->
	<div>Material Required</div>
	<div id="materialCounterJqxgrid"></div>
	<!-- ############################## end of material grid ############################## -->

	<fieldset>
		<legend>Summary</legend>
		<div class="row">
			<form id="counter_summary">

				<div class="col-md-offset-7 col-md-5">
					<div class="row">
						<div class="col-md-6">Total</div>
						<div class="col-md-3"><input type="text" id="counter_summary-total_for_parts" name="total_for_parts" class="form-control input-sm" readonly></div>
						<div class="col-md-3"><input type="text" name="total_for_jobs" class="form-control input-sm" readonly></div>
					</div>
					<div class="row">
						<div class="col-md-3">Cash Dis.</div> <!-- total_discount_bill_cash -->
						<div class="col-md-3">
							<div class="input-group">
								<input type="number" name="cash_discount_percent" id="" step="1" onchange="calculate_counter_summary_percent()" value="0" class="form-control input-sm">
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="col-md-offset-3 col-md-3">
							<input type="number" name="cash_discount_amt" id="" onchange="calculate_counter_summary_amount()" value="0" class="form-control input-sm">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">VAT.</div>
						<div class="col-md-3">
							<div class="input-group">
								<input type="number" name="vat_percent" value="13" class="form-control input-sm" onchange="calculate_counter_summary_percent()" readonly>
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="col-md-3"><input type="text" name="vat_parts" class="form-control input-sm" readonly></div>
						<div class="col-md-3"><input type="text" name="vat_job" class="form-control input-sm" readonly></div>
					</div>
					<div class="row">
						<div class="col-md-6">Round Off</div>
						<div class="col-md-offset-3 col-md-3"><input type="text" name="" class="form-control input-sm" readonly></div>
					</div>
					<div class="row">
						<div class="col-md-6">Net Amount</div>
						<div class="col-md-offset-3 col-md-3"><input type="text" name="net_total" id="" class="form-control input-sm" readonly></div>
					</div>

				</div>
			</form>
		</div>
	</fieldset>
	<button class="btn btn-primary btn-flat btn-xs" id="save_counter_sales">Save</button>
	<button class="btn btn-danger btn-flat btn-xs" id="close_counter">Cancel</button>

	<!-- for parts form -->
	<div id="jqxPopupWindowPartCounter">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title_counter">Add Part</span>
		</div>
		<div class="form_fields_area">
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('part_name')?></label></div>
				<div class="col-md-6"><div id="new_part_id_counter" onchange="get_part_detail_counter()"></div></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('part_code')?></label></div>
				<div class="col-md-8"><span id="new_part_code_counter"></span></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('price')?></label></div>
				<div class="col-md-6"><input type="number" class="number_general" id="new_part_price_counter" ></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('quantity')?></label></div>
				<div class="col-md-6"><input type="number" class="number_general" id="new_part_quantity_counter"></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('total')?></label></div>
				<div class="col-md-6"><input type="number" class="number_general" id="new_part_total_counter" readonly></div>
			</div>

			<div class="row form-group">
				<div class="col-md-12">
					<button class="btn btn-primary btn-xs btn-flat" id="part_to_table_counter">Add</button>
					<button class="btn btn-danger btn-xs btn-flat" id="close_add_part_counter"><?php echo lang('general_cancel')?></button>
				</div>
			</div>
			<input type="hidden" name="new_part_name" id="new_part_name_counter">
			<input type="hidden" name="new_min_price" id="new_min_price_counter">
		</div>
	</div>

	<div id="partCounter-popupWindow">
		<div> <?php echo lang("delete_a_row") ?> </div>
		<div>
			<p><?php echo lang('delete_a_row_confirm') ?></p>
			<button id="partCounter-save">Yes</button>
			<button id="partCounter-cancel">No</button>
		</div>
	</div>
	<script type="text/javascript">
	//sdf
	$(".counter_sale-payment_type").jqxRadioButton({ width: 120, height: 25, groupName :"payment_type" });

	$(".jqxdatetimeinput").jqxDateTimeInput({ width: '250px', height: '34px', formatString: "yyyy-MM-dd HH:mm:ss" });

	// initialize part popup
	$("#jqxPopupWindowPartCounter").jqxWindow({ 
		theme: 'dark',
		width: '50%',
		maxWidth: '50%',
		height: '50%',  
		maxHeight: '50%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	}); 

	$('.counter_sale-payment_type').on('checked', function (event) { 
		var val = $(this).attr('value');
		var checked = event.args.checked;
		$('#counter_sale-payment_type').val(val);

		/*$('.payment_type').hide();
		if(val == 'cash')
		{
			$('#cash_select').show();
		}
		if(val == 'credit')
		{
			$('#credit_select').show();
		}
		if(val == 'card')
		{
			$('#card_select').show();
		}*/

	});

	var UserLedgersource =
	{
		datatype: "json",
		datafields: [
		{ name: 'id' },
		{ name: 'full_name' }
		],
		url: '<?php echo site_url('job_cards/billing/user_list_json'); ?>',
		async: true
	};
	var UserLedgerdataAdapter = new $.jqx.dataAdapter(UserLedgersource);
	// Create a jqxDropDownList
	$("#counter_sale-credit_account").jqxComboBox({
		source: UserLedgerdataAdapter, 
		displayMember: "full_name", 
		valueMember: "id", 
		width: '100%', 
		height: '34px',
		autoDropDownHeight: true
	});


	// vehicles_register_no
	/*var dealerDataSource = {
		url : '<?php echo site_url("admin/job_cards/get_job_card_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'name', type: 'string' },
		],
		async: false,
		cache: true
	}

	vehicleAdapter = new $.jqx.dataAdapter(dealerDataSource);

	$("#vehicle_register_no_counter").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: vehicleAdapter,
		displayMember: "name",
		valueMember: "id",
	});*/

	function get_vehicle_detail_counter(field){
		var value = $('#'+field).val();

		if(value ){

			if(field == 'vehicle_register_no_counter'){
				field = 'id';
			}

			$('#party_name_counter').val('');
			$('#party_id_counter').val('');

			$.post("<?php echo site_url('job_cards/vehicle_detail')?>", {field:field, value:value}, function(row){
				$('#chassis_no_counter').val(row[0]['chass_no']);
				$('#engine_no_counter').val(row[0]['engine_no']);
				$('#vehicle_name_counter').val(row[0]['vehicle_name']);
				$('#variant_name_counter').val(row[0]['variant_name']);
				$('#color_name_counter').val(row[0]['color_name']);
				$('#sell_dealer_counter').val(row['dealer'][0]['dealer_name']);
				$('#party_name_counter').val(row['customer']['full_name']);
				$('#party_id_counter').val(row['customer']['customer_id']);
				$('#service_no_counter').val(row['number_of_service'] + 1);

			},'json');
		}
	}

	var warranty_array = {};

	warranty_array['0'] = {};
	warranty_array['0']['warranty'] = "FOC";
	warranty_array['1'] = {};
	warranty_array['1']['warranty'] = "PAID";
	warranty_array['2'] = {};
	warranty_array['2']['warranty'] = "UW";
	var getwarrantyDataAdapter  = function (datafield){
		var source =
		{
			localdata: warranty_array,
			datatype: "array",
			datafields:
			[
			{ name: 'warranty', type: 'string' },
			]
		};
		var warrantyDataAdapter = new $.jqx.dataAdapter(source, { uniqueDataFields: [datafield] });
		return warrantyDataAdapter;
	}

	// initialize jqxGrid
	var data = {};

	var materialSource =
	{
		localdata: data,
		datatype: "local",
		datafields:
		[
		{ name: 'id', type: 'number' },
		{ name: 'part_name', type: 'string' },
		{ name: 'part_code', type: 'string' },
		{ name: 'price', type: 'number' },
		{ name: 'quantity', type: 'number' },
		{ name: 'discount', type: 'number' },
		{ name: 'total', type: 'number' },
		{ name: 'discount_total', type: 'number' },
		{ name: 'labour', type: 'number' },
		{ name: 'discount_labour', type: 'number' },
		{ name: 'part_id', type: 'number' },
		{ name: 'warranty', type: 'string' },
		],
		addrow: function (rowid, rowdata, position, commit) {
			//     // synchronize with the server - send insert command
			//     // call commit with parameter true if the synchronization with the server is successful 
			//     //and with parameter false if the synchronization failed.
			//     // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
			commit(true);
		},
	};
	var materialdataAdapter = new $.jqx.dataAdapter(materialSource);

	Part_form_table_counter = $("#materialCounterJqxgrid").jqxGrid(
	{
		width: '100%',
		height: '100%',
		source: materialdataAdapter,
		showtoolbar: true,
		showaggregates: true,
		showstatusbar: true,
		editable : true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px;'></div>");
			toolbar.append(container);
			container.append('<input id="counterpartsaddrowbutton" type="button" value="Add Parts" />');
			$("#counterpartsaddrowbutton").jqxButton();

			// create new row.
			$("#counterpartsaddrowbutton").on('click', function () {
				$('#new_part_code_counter').html('');
				$('#new_part_price_counter').val(0);
				$('#new_part_name_counter').val('');
				$('#new_min_price_counter').val(0);
				$('#new_part_total_counter').val(0);
				$('#new_part_quantity_counter').val(0);

				openPopupWindow('jqxPopupWindowPartCounter', '<?php echo lang("general_add")  . "&nbsp;" .  lang("part"); ?>');
			});
		},
		columns: [
		{ text: '<?php echo lang("part_id")?>', datafield: 'id', hidden:true },
		{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', editable : false, },
		{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '10%', editable : false, },
		{ 
			text: '<?php echo lang("price")?>', datafield: 'price', width: '10%', cellsalign: 'right', columntype: 'numberinput', 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var quantity = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "quantity");
					var discount = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "discount");
					if(isNaN(discount))
					{
						discount = 0;
					}
					var total;

					total = newvalue * quantity;
					total = total - ( (discount/100) * total );

					$("#materialCounterJqxgrid").jqxGrid('setcellvalue', row, "total", (total).toFixed(2));

				};
			}
		},
		{ 
			text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%', cellsalign: 'right', columntype: 'numberinput', 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var price = parseFloat($('#materialCounterJqxgrid').jqxGrid('getcellvalue', row, "price"));
					var discount = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "discount");
					if(isNaN(discount))
					{
						discount = 0;
					}
					var total;

					total = price * newvalue;
					total = total - ( (discount/100) * total );

					$("#materialCounterJqxgrid").jqxGrid('setcellvalue', row, "total", (total).toFixed(2));
				};
			}
		},
		{ 
			text: '<?php echo lang("discount")?>', datafield: 'discount', width: '10%', cellsalign: 'right', columntype: 'numberinput',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var price = parseFloat($('#materialCounterJqxgrid').jqxGrid('getcellvalue', row, "price"));
					var quantity = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "quantity");
					var total;

					total = price * quantity;
					total = total - ( (newvalue/100) * total );

					$("#materialCounterJqxgrid").jqxGrid('setcellvalue', row, "total", total);
				};
			}
		},

		{ 
			text: 'Warranty', datafield: 'warranty', width: '10%', filterable: true, columntype: 'dropdownlist',

			createeditor: function (row, cellvalue, editor, cellText, width, height) {
				editor.jqxDropDownList({
					source: getwarrantyDataAdapter('warranty'), displayMember: 'warranty', valueMember: 'warranty', width: width, height: height, 
					selectionRenderer: function () {
						return "<span style='top:4px; position: relative;'>Please Choose:</span>";
					}
				});
			},
			initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
				var items = editor.jqxDropDownList('getItems');
				editor.jqxDropDownList('uncheckAll');
				var values = cellvalue.split(/,\s*/);
				for (var j = 0; j < values.length; j++) {
					for (var i = 0; i < items.length; i++) {
						if (items[i].label === values[j]) {
						}
					}
				}
			},
			geteditorvalue: function (row, cellvalue, editor) {
				return editor.val();
			}
		},

		{ 
			text: '<?php echo lang("total")?>', datafield: 'total', width: '10%',editable : false, aggregates: [
			{
				'<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;

					$('#counter_summary input[name=total_for_parts]').val(total);
					calculate_counter_summary_percent();

					return total;
				}
			}]  
		},
		/*{ text: '<?php echo ("discount_total")?>', datafield: 'discount_total', width: '10%' },*/
		// { text: '<?php echo lang("labour")?>', datafield: 'labour', width: '10%' },
		// { text: '<?php echo lang("discount_labour")?>', datafield: 'discount_labour', width: '10%' },
		{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
			return "Delete row";
		}, buttonclick: function (row) {
			// open the popup window when the user clicks a button.
			var id = $("#materialCounterJqxgrid").jqxGrid('getrowid', row);
			var offset = $("#materialCounterJqxgrid").offset();

			$('#partCounter-save').val(id);
			$("#partCounter-popupWindow").jqxWindow({ 
				/*position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60}*/ 
			});

			 // show the popup window.
			 $("#partCounter-popupWindow").jqxWindow('show');
			}
		},
		]
	});  

	$('#close_add_part_counter').click(function(){
		$('#jqxPopupWindowPartCounter').jqxWindow('close');
		// $('#jqxPopupWindowPartCounter').unblock();
	});
	$("#partCounter-popupWindow").jqxWindow({ width: 250, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $(""), modalOpacity: 0.05 });
	$("#partCounter-save").click(function () {
		$('#materialCounterJqxgrid').jqxGrid('deleterow', $(this).val());
		$("#partCounter-popupWindow").jqxWindow('hide');
	});



	// part combobox
	var partCounterDataSource = {
		url : '<?php echo site_url("admin/spareparts/get_spareparts_combo_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'name', type: 'string' },
		],
	}

	partCounterAdapter = new $.jqx.dataAdapter(partCounterDataSource,
	{
		formatData: function (data) {
			if ($("#new_part_id_counter").jqxComboBox('searchString') != undefined) {
				data.name_startsWith = $("#new_part_id_counter").jqxComboBox('searchString');
				return data;
			}
		}
	}
	);

	$("#new_part_id_counter").jqxComboBox({
		width: 195,
		height: 25,
		source: partCounterAdapter,
		remoteAutoComplete: true,
		selectedIndex: 0,
		displayMember: "name",
		valueMember: "id",
		renderer: function (index, label, value) {
			var item = partCounterAdapter.records[index];
			if (item != null) {
				var label = item.name + "(" + item.name + ", " + item.name + ")";
				return label;
			}
			return "";
		},
		renderSelectedItem: function(index, item)
		{
			var item = partCounterAdapter.records[index];
			if (item != null) {
				var label = item.name;
				return label;
			}
			return "";   
		},
		search: function (searchString) {
			partCounterAdapter.dataBind();
		}
	});

	function get_part_detail_counter(){
		var id = $('#new_part_id_counter').val();

		$('#new_part_code_counter').html('');
		$('#new_part_price_counter').val(0);
		$('#new_part_name_counter').val('');
		$('#new_min_price_counter').val(0);
		$('#new_part_total_counter').val(0);
		$('#new_part_quantity_counter').val(0);

		$.post("<?php echo site_url('spareparts/getDetail')?>", {id:id}, function(data){
			if(data.success){
				$('#new_part_code_counter').html(data.part_code);
				$('#new_part_price_counter').val(data.price);
				$('#new_part_name_counter').val(data.name);
				$('#new_min_price_counter').val(data.price);
			}
		},'json');
	}

	// calculate total
	$('#new_part_quantity_counter, #new_part_price_counter').on('change',function(){
		price       = parseInt($('#new_part_price_counter').val());
		quantity    = parseInt($('#new_part_quantity_counter').val());
		min_price   = parseInt($('#new_min_price_counter').val());

		if((price) >= (min_price) && min_price != ''){
			total_price = price * quantity
			$('#new_part_total_counter').val(total_price);
		}else{
			alert('Minimum price is ' + min_price);
			$('#new_part_price_counter').val(min_price);
		}

	});

	// part to table
	$('#part_to_table_counter').click(function(){
		var part_id = $('#new_part_id_counter').val();
		var part_name = $('#new_part_name_counter').val();
		var part_price = $('#new_part_price_counter').val();
		var part_quantity = $('#new_part_quantity_counter').val();
		var part_total = $('#new_part_total_counter').val();
		var part_code = $('#new_part_code_counter').html();
		if(new_part_id != null && new_part_name != null){
			if(part_quantity == 0 || part_total == 0){
				alert('Quantity is required');
			}else{
				var datarow = {
					'id'            :part_id,
					'part_name'     :part_name,
					'part_code'     :part_code,
					'price'         :part_price,
					'quantity'      :part_quantity,
					'total'         :part_total,
				};

				Part_form_table_counter.jqxGrid('addrow', null, datarow);
				// $('#jqxPopupWindowPartCounter').jqxGrid('addrow', null, datarow);

			}
		}else{
			alert('Please enter all fields');
		}
	});


	$('#save_counter_sales').click(function(){
		var bill_part_datas = JSON.stringify($('#materialCounterJqxgrid').jqxGrid('getrows'));
		// var bill_job_datas = JSON.stringify($('#jqxGridJobBill').jqxGrid('getrows'));

		var bill_details = getFormData('form-counter_sale');
		var bill_summary = getFormData('counter_summary');

		// var newnew = $('.jqxRadioButton-bill_type').val()
		// console.log(newnew);

		$.ajax({
			type:       "POST",
			url:        "<?php echo site_url('job_cards/counter/save')?>",
			data:       {
				bill_details:bill_details,
				bill_summary:bill_summary,
				bill_part_datas:bill_part_datas,
			},
			success:    function(){
				// $('#jqxPopupWindowBill').jqxWindow('close');
				// $('#jqxPopupWindowBill').unblock();

			},
		});

	});


	function calculate_counter_summary_percent() {

		var parts_amount = parseFloat($('#counter_summary input[name=total_for_parts]').val());
		isNaN(parts_amount)? parts_amount = 0:'';

		var job_amount = parseFloat($('#counter_summary input[name=total_for_jobs]').val());
		isNaN(job_amount)? job_amount = 0:'';

		var percent = parseFloat($('#counter_summary input[name=cash_discount_percent]').val());
		isNaN(percent)? percent = 0:'';

		var vat = parseFloat($('#counter_summary input[name=vat_percent]').val());
		isNaN(vat)? vat = 0:'';

		var net_total = parts_amount + job_amount;

		var total = parseFloat(parts_amount) + parseFloat(job_amount);
		total = total * (percent /100);

		$('#counter_summary input[name=cash_discount_amt]').val(total);

		parts_amount = parts_amount - ((parts_amount * percent) / 100);		 /*discount cash percent*/
		var vat_parts = (parts_amount * vat ) /100; 							/*add vat*/
		job_amount = job_amount - ((job_amount * percent) / 100);			 /*discount cash percent*/
		var vat_job = (job_amount * vat ) /100; 								/*add vat*/
		$('#counter_summary input[name=vat_parts]').val(vat_parts);
		$('#counter_summary input[name=vat_job]').val(vat_job);

		net_total = net_total + vat_parts + vat_job - total;
		$('#counter_summary input[name=net_total]').val(net_total);

	}
	function calculate_counter_summary_amount() {
		var percent;
		var parts_amount = parseFloat($('#counter_summary input[name=total_for_parts]').val());
		isNaN(parts_amount)? parts_amount = 0:'';

		var job_amount = parseFloat($('#counter_summary input[name=total_for_jobs]').val());
		isNaN(job_amount)? job_amount = 0:'';

		var d_amount = parseFloat($('#counter_summary input[name=cash_discount_amt]').val()); /*cash discount amount*/
		isNaN(d_amount)? d_amount = 0:'';

		var vat = parseFloat($('#counter_summary input[name=vat_percent]').val());
		isNaN(vat)? vat = 0:'';

		var net_total = parts_amount + job_amount;

		var total = parseFloat(parts_amount) + parseFloat(job_amount);
		percent = ( d_amount /  total) * 100;

		$('#counter_summary input[name=cash_discount_percent]').val(percent);

		parts_amount = parts_amount - ((parts_amount * percent) / 100);		 /*discount cash percent*/
		var vat_parts = (parts_amount * vat ) /100; 							/*add vat*/
		job_amount = job_amount - ((job_amount * percent) / 100);			 /*discount cash percent*/
		var vat_job = (job_amount * vat ) /100; 								/*add vat*/
		$('#counter_summary input[name=vat_parts]').val(vat_parts);
		$('#counter_summary input[name=vat_job]').val(vat_job);

		net_total = net_total + vat_parts + vat_job - d_amount;
		$('#counter_summary input[name=net_total]').val(net_total);
	}

	function findCounterInvoice() {
		var prefix = $('#form-counter_sale input[name=invoice_no-prefix]').val();
		var invoice_no = $('#form-counter_sale input[name=invoice_no]').val();

		$.post('<?php echo site_url('job_cards/counter/findCounterInvoice'); ?>',{
			prefix: prefix,
			invoice_no: invoice_no
		},function(result) {
			if(result.success == false)
			{
				alert("No invoice!");
				$('#save_counter_sales').show();
				return;
			}
			var invoice = result.row.invoice;
			$('#form-counter_sale input[name=issue_date]').val(invoice.issue_date);
			$('#counter_sale-credit_account').jqxComboBox('selectItem',invoice.credit_account);
			$('#form-counter_sale input[name=vehicle_no]').val(invoice.vehicle_no);

			// $('#form-counter_summary input[name=total_for_parts]').val(invoice.total_parts);
			$('#counter_summary-total_for_parts').val(invoice.total_parts);
			$('#form-counter_summary input[name=cash_discount_percent]').val(invoice.cash_discount_percent);
			$('#form-counter_summary input[name=vat_percent]').val(invoice.vat_percent);
			calculate_counter_summary_percent();

			$.each(result.row.parts, function(i,v){
				var datarow = {
					'id'  			: v.id,
					'part_id'		: v.part_id,
					'part_name'		: v.part_name,
					'part_code'     : v.part_code,
					'price'		    : v.price,
					'quantity'	    : v.quantity,
					'discount'	    : v.discount_percentage,
					'total'		    : v.final_price
				};

				Part_form_table_counter.jqxGrid('addrow', null, datarow);
				$('#save_counter_sales').hide();
			});

		},'JSON');
	}
</script>