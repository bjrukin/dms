<style type="text/css">
	.cls-outsidework {
		background-color: lightcyan;
	}
	.cls-job {
		/*background-color: lightgreen;*/
	}
</style>
<div class="row">
	<div class="col-md-12">

		<form id="invoice_details">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-2">Sales Type</div>
						<div class="col-md-6">
							<span id='' class="jqxRadioButton-bill_type" name="bill_type" value="counter" style="float: left;">Counter</span>
							<span id='jqxRadioButton-jobcard' class="jqxRadioButton-bill_type" name="bill_type" value="jobcard">JobCard</span>
							<input type="hidden" name="bill_type_val" id="jqxRadioButton-bill_type">
						</div>
						<div class="col-md-4">
							<fieldset>
								<!-- <div class="row"> -->
								<div id='' class="jqxRadioButton-payment_type" name="payment_type" value="cash" >Cash</div>
								<div id='' class="jqxRadioButton-payment_type" name="payment_type" value="credit" >Credit</div>
								<div id='' class="jqxRadioButton-payment_type" name="payment_type" value="card" >Card</div>
								<!-- </div> -->
								<input type="hidden" name="payment_type_val" id="jqxRadioButton-payment_type">
							</fieldset>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"> Date </div>
						<div class="col-md-10"> <div id='' class="jqxdatetimeinput" name=issue_date></div></div>
					</div>

					<div class="row payment_type" id="cash_select" hidden>
						<div class="col-md-2"> Cash A/C. </div>
						<div class="col-md-10"> <div id='jqxdropdownlist-cash_account' name="cash_account"> </div> </div>
					</div>
					<div class="row payment_type" id="credit_select" hidden>
						<div class="col-md-2"> Ledger </div>
						<div class="col-md-10"> <div id='jqxdropdownlist-credit_account' name="credit_account"> </div> </div>
					</div>
					<div class="row payment_type" id="card_select" hidden>
						<div class="col-md-2"> Card </div>
						<div class="col-md-10"> <div id='jqxdropdownlist-card_account' name="card_account"> </div> </div>
					</div>
					<div class="row">
						<div class="col-md-2"> Invoice No. </div>
						<div class="col-md-10 form-inline">
							<input type="text" name="invoice_no-prefix" class="form-control input-sm" value="<?php echo @$has_billed->invoice_prefix; ?>">
							<input type="text" name="invoice_no" class="form-control input-sm" value="<?php echo isset($has_billed->invoice_no)?$has_billed->invoice_no:$bill_id; ?>" >
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">Job No.</div>
						<div class="col-md-4"><input type="text" name="job_no" class="form-control input-sm" value="<?php echo $job_detail['jobcard_group']?>" readonly></div>
						<!-- </div> -->
						<!-- <div class="row"> -->
						<div class="col-md-2">Service</div>
						<div class="col-md-4"><input class="form-control input-sm" value="<?php 
								echo $under_warranty_type . " - " . ucfirst($ordinal_array);
							// if(! isset($has_billed->invoice_no) )
							// else
							// 	echo ($under_warranty)?"FREE- {$ordinal_array[$service_count]}": "PAID - {$ordinal_array[$service_count]}";  
							?>" readonly>
						</div>
					</div>

				</div>
				<div class="col-md-6">
					<fieldset>
						<legend>Party Details</legend>
						<div class="row">
							<div class="col-md-2">Vehicle No.</div>
							<div class="col-md-4"><input type="text" name="" class="form-control input-sm" value="<?php echo $vehicle_detail->vehicle_no; ?>" readonly></div>
							<div class="col-md-2">Model</div>
							<div class="col-md-4"><input type="text" name="" class="form-control input-sm" value="<?php echo $vehicle_detail->vehicle_name; ?>" readonly></div>
						</div>
						<div class="row">
							<div class="col-md-2">Party</div>
							<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php echo $vehicle_detail->full_name; ?>" readonly></div>
						</div>
						<div class="row">
							<div class="col-md-2">Address</div>
							<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php echo $vehicle_detail->address1; ?>" readonly></div>
							<div class="col-md-offset-2 col-md-10"><input type="text" name="" class="form-control input-sm"  value="<?php echo $vehicle_detail->address2; ?>" readonly></div>
						</div>
					</fieldset>
				</div>
			</div> <!-- row -->
		</form>
		<div class="row">
			<div class="col-md-12">
				<div id="jqxGridJobBill"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="jqxGridPartBill"> </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<fieldset>
					<legend>Summary</legend>
					<div class="row">
						<form id="invoice_summary">

							<div class="col-md-offset-7 col-md-5">
								<div class="row">
									<div class="col-md-6">Total</div>
									<div class="col-md-3"><input type="text" name="total_for_parts" class="form-control input-sm" readonly></div>
									<div class="col-md-3"><input type="text" name="total_for_jobs" class="form-control input-sm" readonly></div>
								</div>
								<div class="row">
									<div class="col-md-3">Cash Dis.</div> <!-- total_discount_bill_cash -->
									<div class="col-md-3">
										<div class="input-group">
											<input type="number" name="cash_discount_percent" id="" step="1" onchange="cal_cash_discount_bill_percent()" value="0" class="form-control input-sm">
											<div class="input-group-addon">%</div>
										</div>
									</div>
									<div class="col-md-offset-3 col-md-3">
										<input type="number" name="cash_discount_amt" id="" onchange="cal_cash_discount_bill_amount()" value="0" class="form-control input-sm">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">VAT.</div>
									<div class="col-md-3">
										<div class="input-group">
											<input type="number" name="vat_percent" value="13" class="form-control input-sm" onchange="cal_cash_discount_bill_percent()" readonly>
											<div class="input-group-addon">%</div>
										</div>
									</div>
									<div class="col-md-3"><input type="text" name="vat_parts" class="form-control input-sm" readonly></div>
									<div class="col-md-3"><input type="text" name="vat_job" class="form-control input-sm" readonly></div>
								</div>
								<!-- <div class="row">
									<div class="col-md-6">Surcharge</div>
									<div class="col-md-offset-3 col-md-3"><input type="text" name="" class="form-control input-sm" readonly></div>
								</div> -->
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
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">

					<?php if( empty($has_billed) ) : ?>
						<button class="btn btn-primary btn-flat btn-xs" id="save_bill">Create BILL</button>
					<?php endif; ?>
					<button class="btn btn-default btn-flat btn-sm" id="" onclick="printPreview('Invoice')">Print</button>
					<button class="btn btn-danger btn-flat btn-xs" id="close_bill">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// var numberthingy = 1231321321.4654;
	// console.log(numberthingy.toLocaleString('en-IN', { style: 'currency', currency: 'NPR', currencyDisplay: 'symbol' }));
	$(".jqxRadioButton-bill_type").jqxRadioButton({ width: 120, height: 25, groupName :"bill_type" });
	$(".jqxRadioButton-payment_type").jqxRadioButton({ width: 120, height: 25, groupName :"payment_type" });
	// $('.jqxRadioButton[name=payment_type]:first').jqxRadioButton({c, { style: 'currency', currency: 'EUR' }hecked: true});

	<?php if(isset($job_detail['jobcard_group'])){ ?>
		$("#jqxRadioButton-jobcard").jqxRadioButton({ checked:true });
		$('.jqxRadioButton-bill_type[name=bill_type]').jqxRadioButton('disable');


		<?php 
	} ?>

	var checked = $('.jqxRadioButton-bill_type').jqxRadioButton('checked'); 
	if(checked[0] == true ){
		var val = $(".jqxRadioButton-bill_type:nth-child(1)").attr('value');
	}else {
		var val = $(".jqxRadioButton-bill_type:nth-child(2)").attr('value');
	}
	$('#jqxRadioButton-bill_type').val(val);



	$(".jqxdatetimeinput").jqxDateTimeInput({ width: '250px', height: '34px', formatString: "yyyy-MM-dd HH:mm:ss" });

	var cash_accountSource = [
	"Cash Account (Cash a/c) ",
	"PETTY CASH",
	];
	$("#jqxdropdownlist-cash_account").jqxDropDownList({ source: cash_accountSource, selectedIndex: 0, width: '100%', height: '34px',autoDropDownHeight: true,  });



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
	$("#jqxdropdownlist-credit_account").jqxDropDownList({
		source: UserLedgerdataAdapter, displayMember: "full_name", valueMember: "id", width: '100%', height: '34px',autoDropDownHeight: true
	});

	// subscribe to the select event.
	$("#jqxWidget").on('select', function (event) {
		if (event.args) {
			var item = event.args.item;
			if (item) {
			}
		}
	});

	var card_accountSource = [
	"Nabil Bank",
	];
	$("#jqxdropdownlist-card_account").jqxDropDownList({ source: card_accountSource, selectedIndex: 0, width: '100%', height: '34px',autoDropDownHeight: true,  });
	$(".jqxRadioButton-payment_type[value=cash]").jqxRadioButton({ checked:true });

	$('#jqxRadioButton-payment_type').val(function(){ return $(".jqxRadioButton-payment_type[value=cash]").attr('value'); });

	$('.jqxRadioButton-payment_type').on('checked', function (event) { 
		var val = $(this).attr('value');
		var checked = event.args.checked;
		$('#jqxRadioButton-payment_type').val(val);

		$('.payment_type').hide();
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
		}

	});


</script>

<script type="text/javascript">

	var source_job_status = {};

	source_job_status['0'] = {};
	source_job_status['0']['status'] = "PENDING";
	source_job_status['1'] = {};
	source_job_status['1']['status'] = "COMPLETE";

	var getEditorDataAdapterJob  = function (datafield){
		var source =
		{
			localdata: source_job_status,
			datatype: "array",
			datafields:
			[
			{ name: 'status', type: 'string' },
			]
		};
		var statusDataAdapter = new $.jqx.dataAdapter(source, { uniqueDataFields: [datafield] });
		return statusDataAdapter;
	}

	var job_cardsDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'job_id', type: 'number' },
			// { name: '', type: 'number'},
			{ name: 'id', type: 'number' },
			{ name: 'job', type: 'string'},
			{ name: 'job_description', type: 'string'},
			{ name: 'min_price', type: 'number'},
			{ name: 'cost', type: 'number'},
			{ name: 'discount_amount', type: 'number'},
			{ name: 'discount_percentage', type: 'number'},
			{ name: 'final_amount', type: 'number'},
			{ name: 'status', type: 'string'},
			{ name: 'ow', type: 'string'},
			{ name: 'customer_price', type: 'string'},
			
			],
			url: '<?php echo site_url("admin/job_cards/estimate_form_data_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			data: {
				jobcard_group	: <?php echo $job_detail['jobcard_group']?>,
				vehicle_id		: <?php echo $job_detail['vehicle_id']?>,
				status 			: 'PENDING',
			},
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	job_cardsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridJobBill").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridJobBill").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }

	};
	/* for calculating discount */
	var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
		if (value < 20) {
			return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
		}
		else {
			return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
		}
	}

	var cellclassrenderer = function(row, column,value,data) {
		if(data.ow == true){
			return 'cls-outsidework';
		}
		return 'cls-job';
	}

	
	$("#jqxGridJobBill").jqxGrid({
		theme: theme,
		width: '100%',
		height: '200px',
		source: job_cardsDataSource,
		altrows: true,
		// pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight:30,
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		autoshowfiltericon: true,
		columnsreorder: true,
		selectionmode: 'none',
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showaggregates: true,
		showstatusbar: true,
		// columnsautoresize: false
		columns: [
		{ text: 'SN', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false,},

		{ text: '<?php echo lang("job"); ?>',datafield: 'job',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("description"); ?>',datafield: 'job_description',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true, cellclassname: cellclassrenderer },
		{ 
			text: '<?php echo lang("status"); ?>',datafield: 'status',filterable: true,renderer: gridColumnsRenderer, columntype: 'template', cellclassname: cellclassrenderer,
			createeditor: function (row, cellvalue, editor, cellText, width, height) {
				// construct the editor. 
				editor.jqxDropDownList({
					checkboxes: true, source: getEditorDataAdapterJob('status'), displayMember: 'status', valueMember: 'status', width: width, height: height, 
					selectionRenderer: function () {
						return "<span style='top:4px; position: relative;'>Please Choose:</span>";
					}
				});
			},
			initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
				// set the editor's current value. The callback is called each time the editor is displayed.
				var items = editor.jqxDropDownList('getItems');
				editor.jqxDropDownList('uncheckAll');
				var values = cellvalue.split(/,\s*/);
				for (var j = 0; j < values.length; j++) {
					for (var i = 0; i < items.length; i++) {
						if (items[i].label === values[j]) {
							editor.jqxDropDownList('checkIndex', i);
						}
					}
				}
			},
			geteditorvalue: function (row, cellvalue, editor) {
				// return the editor's value.
				return editor.val();
			}
		},
		{ 
			text: '<?php echo lang("cost"); ?>',datafield: 'customer_price',filterable: true,editable:false, cellsrenderer: function(row,column,value){
			}, cellclassname: cellclassrenderer
		},
		{ 
			text: '<?php echo lang("customer_price"); ?>',datafield: 'cost',filterable: true,  cellclassname: cellclassrenderer
		},
		{ 
			text: '<?php echo lang("discount_percentage"); ?>', 
			datafield: 'discount_percentage',
			width: '10%',filterable: true,
			renderer: gridColumnsRenderer, 
			columntype: 'numberinput', 
			cellbeginedit: false, cellclassname: cellclassrenderer,
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var cost = $("#jqxGridJobBill").jqxGrid('getcellvalue', row, "cost");
					var amount = newvalue/100 * cost;
					$("#jqxGridJobBill").jqxGrid('setcellvalue', row, "final_amount", cost - amount);
				};
			}
		},
		{ 
			text: '<?php echo lang("final_amount"); ?>',
			datafield: 'final_amount',
			width: '10%',
			filterable: true,
			renderer: gridColumnsRenderer, 
			columntype: 'numberinput', cellclassname: cellclassrenderer,
			// cellbeginedit: true,
			aggregates: [{ '<b>Total</b>':
			function (aggregatedValue, currentValue, column, record) {
				var total = currentValue;
				total = aggregatedValue + total;

				$('#invoice_summary input[name=total_for_jobs]').val(total);
				cal_cash_discount_bill_percent();

				return total;
			}
		}]                  
	},

	],
	editable : true,
	rendergridrows: function (result) {
		return result.data;
	},
	ready: function () {
		var under_warranty = '<?php echo $under_warranty ?>';
		if(under_warranty){
			var rowscounts = $('#jqxGridJobBill').jqxGrid('getdatainformation');
			rowscounts = rowscounts.rowscount;

			for (var i = 0; i < rowscounts; i++) {
				// $('#jqxGridJobBill').jqxGrid('setcellvalue', i, "cost", '0');
				$('#jqxGridJobBill').jqxGrid('setcellvalue', i, "final_amount", '0');
			}
		}
		// $('#jqxGridJobBill').jqxGrid('render');

	},
});

// saving INVOCIE
$('#save_bill').click(function(){
	var bill_part_datas = JSON.stringify($('#jqxGridPartBill').jqxGrid('getrows'));
	var bill_job_datas = JSON.stringify($('#jqxGridJobBill').jqxGrid('getrows'));
	// var bill_details = $('#bill_form').serialize() + '&jobs=' + bill_job_datas + '&parts=' + bill_part_datas + '&' + $('#bill_summary').serialize();
	var bill_details = getFormData('invoice_details');
	var bill_summary = getFormData('invoice_summary');

	var newnew = $('.jqxRadioButton-bill_type').val()

	$.ajax({
		type:       "POST",
		url:        "<?php echo site_url('job_cards/billing/save')?>",
		data:       {
			bill_part_datas:bill_part_datas,
			bill_job_datas:bill_job_datas,
			bill_details:bill_details,
			bill_summary:bill_summary,
		},
		success:    function(){
			$('#jqxPopupWindowBill').jqxWindow('close');
			// $('#jqxPopupWindowBill').unblock();

		},
	});

});

</script>

<script type="text/javascript">
	var total_part;
	var total_labour;
	var total;
	var source_part_status = {};

	source_part_status['0'] = {};
	source_part_status['0']['status'] = "PENDING";
	source_part_status['1'] = {};
	source_part_status['1']['status'] = "PAID";

	var getEditorDataAdapter  = function (datafield){
		var source =
		{
			localdata: source_part_status,
			datatype: "array",
			datafields:
			[
			{ name: 'status', type: 'string' },
			]
		};
		var statusDataAdapter = new $.jqx.dataAdapter(source, { uniqueDataFields: [datafield] });
		return statusDataAdapter;
	}

	var job_cardsDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'part_name', type: 'string'},
		{ name: 'part_id', type: 'number'},
		{ name: 'part_code', type: 'string'},
		{ name: 'price', type: 'number'},
		{ name: 'quantity', type: 'number'},
		{ name: 'discount_percentage', type: 'number'},
		{ name: 'final_price', type: 'number'},
		{ name: 'labour', type: 'number'},
		{ name: 'final_labour', type: 'number'},
		{ name: 'discount_amount', type: 'number'},
		{ name: 'cash_discount_bill', type: 'number'},
		{ name: 'status', type: 'string'},
		{ name: 'warranty', type: 'string'},

		],
		url: '<?php echo site_url("admin/job_cards/estimate_for_parts_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		data: {
			jobcard_group	: <?php echo $job_detail['jobcard_group']?>,
			vehicle_id		: <?php echo $job_detail['vehicle_id']?>,
			// status 			: 'PENDING',
		},
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	job_cardsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridEstimate").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridEstimate").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }

	};
	var job_cardsDataSource2 = new $.jqx.dataAdapter(job_cardsDataSource,{
		async: false,
		autoBind:true,
	});

	// cash_discount_bill = job_cardsDataSource2.records[0].cash_discount_bill;
	if(job_cardsDataSource2.records[0] != undefined){
		$('#total_discount_bill').val(job_cardsDataSource2.records[0].cash_discount_bill);
	}



	/* for calculating discount */
	var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
		if (value < 20) {
			return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
		}
		else {
			return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
		}
	}
	
	$("#jqxGridPartBill").jqxGrid({
		theme: theme,
		width: '100%',
		height: '300px',
		source: job_cardsDataSource,
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
		showaggregates: true,
		showstatusbar: true,
		columns: [
		{ text: '<?php echo lang("id")?>', datafield: 'id', hidden: true},
		{ text: '<?php echo lang("part_id")?>', datafield: 'part_id', hidden: true},
		{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},

		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',/*width: '15%',*/filterable: true,renderer: gridColumnsRenderer, editable:false, },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',/*width: '10%',*/filterable: true,renderer: gridColumnsRenderer,editable:false,},
		{ 
			text: '<?php echo lang("price"); ?>',datafield: 'price',/*width: '10%',*/filterable: true,renderer: gridColumnsRenderer,columntype: 'numberinput',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var quantity = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "quantity");
					var discount = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "discount_percentage");
					if(isNaN(discount))
					{
						discount = 0;
					}
					var total;

					total = newvalue * quantity;
					total = total - ( (discount/100) * total );

					$("#jqxGridPartBill").jqxGrid('setcellvalue', row, "final_price", (total).toFixed(2));

				};
			}
		},
		{ 
			text: '<?php echo lang("quantity"); ?>',
			datafield: 'quantity',
			// width: '10%',
			filterable: true,
			renderer: gridColumnsRenderer, 
			columntype: 'numberinput', 
			editable: false, 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var price = parseFloat($('#jqxGridPartBill').jqxGrid('getcellvalue', row, "price"));
					var discount = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "discount_percentage");
					if(isNaN(discount))
					{
						discount = 0;
					}
					var total;

					total = price * newvalue;
					total = total - ( (discount/100) * total );

					$("#jqxGridPartBill").jqxGrid('setcellvalue', row, "final_price", (total).toFixed(2));
				};
			}
		},
		{
			text: '<?php echo ("warranty"); ?>',
			datafield: 'warranty',
			width: '5%',
			filterable: true,
			renderer: gridColumnsRenderer,
			columntype: 'string',
			editable: false,
		},
		{ 
			text: '<?php echo lang("discount_percentage"); ?>',
			datafield: 'discount_percentage',
			// width: '10%',
			filterable: true,
			renderer: gridColumnsRenderer, 
			columntype: 'numberinput', 
			cellbeginedit: false, 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var price = parseFloat($('#jqxGridPartBill').jqxGrid('getcellvalue', row, "price"));
					var quantity = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "quantity");
					var total;

					total = price * quantity;
					total = total - ( (newvalue/100) * total );

					$("#jqxGridPartBill").jqxGrid('setcellvalue', row, "final_price", total);
				};
			}
		},
		{ 
			text: '<?php echo "Total Amount"; ?>',
			datafield: 'final_price',
			// width: '10%',
			filterable: true,
			renderer: gridColumnsRenderer, 
			columntype: 'numberinput', 
			cellbeginedit: true, 
			aggregates: [{ '<b>Total</b>':
			function (aggregatedValue, currentValue, column, record) {
				var total = currentValue;
				total = aggregatedValue + total;

				$('#invoice_summary input[name=total_for_parts]').val(total);

				cal_cash_discount_bill_percent();
				return total;
			}
		}] },
		{ 
			text: '<?php echo lang("bill_part_status")?>', datafield: 'status', width: '10%', filterable: true, columntype: 'template',

			createeditor: function (row, cellvalue, editor, cellText, width, height) {
				// construct the editor. 
				editor.jqxDropDownList({
					checkboxes: true, source: getEditorDataAdapter('status'), displayMember: 'status', valueMember: 'status', width: width, height: height, 
					selectionRenderer: function () {
						return "<span style='top:4px; position: relative;'>Please Choose:</span>";
					}
				});
			},
			initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
				// set the editor's current value. The callback is called each time the editor is displayed.
				var items = editor.jqxDropDownList('getItems');
				// editor.jqxDropDownList('uncheckAll');
				var values = cellvalue.split(/,\s*/);
				for (var j = 0; j < values.length; j++) {
					for (var i = 0; i < items.length; i++) {
						if (items[i].label === values[j]) {
							editor.jqxDropDownList('checkIndex', i);
						}
					}
				}
			},
			geteditorvalue: function (row, cellvalue, editor) {
				// return the editor's value.
				return editor.val();
			}
		},

		],
		editable : true,
		rendergridrows: function (result) {
			return result.data;
		},
		ready: function () {
			var parts_rows = $('#jqxGridPartBill').jqxGrid('getrows');
			$.each(parts_rows, function(i,v) {
				if(v.warranty == "FREE"){
					$('#jqxGridPartBill').jqxGrid('setcellvalue', i, "final_price", '0');
				}
				
			});
			$('#jqxGridPartBill').jqxGrid('render');

		},
		autorowheight: true,
	});

	//summary calculation
	function cal_cash_discount_bill_percent() {

		var parts_amount = parseFloat($('#invoice_summary input[name=total_for_parts]').val());
		isNaN(parts_amount)? parts_amount = 0:'';

		var job_amount = parseFloat($('#invoice_summary input[name=total_for_jobs]').val());
		isNaN(job_amount)? job_amount = 0:'';

		var percent = parseFloat($('#invoice_summary input[name=cash_discount_percent]').val());
		isNaN(percent)? percent = 0:'';

		var vat = parseFloat($('#invoice_summary input[name=vat_percent]').val());
		isNaN(vat)? vat = 0:'';

		var net_total = parts_amount + job_amount;

		var total = parseFloat(parts_amount) + parseFloat(job_amount);
		total = total * (percent /100);

		$('#invoice_summary input[name=cash_discount_amt]').val(total);

		parts_amount = parts_amount - ((parts_amount * percent) / 100);		 /*discount cash percent*/
		var vat_parts = (parts_amount * vat ) /100; 							/*add vat*/
		job_amount = job_amount - ((job_amount * percent) / 100);			 /*discount cash percent*/
		var vat_job = (job_amount * vat ) /100; 								/*add vat*/
		$('#invoice_summary input[name=vat_parts]').val(vat_parts);
		$('#invoice_summary input[name=vat_job]').val(vat_job);

		net_total = net_total + vat_parts + vat_job - total;
		$('#invoice_summary input[name=net_total]').val(net_total);

	}

	function cal_cash_discount_bill_amount() {
		var percent;
		var parts_amount = parseFloat($('#invoice_summary input[name=total_for_parts]').val());
		isNaN(parts_amount)? parts_amount = 0:'';

		var job_amount = parseFloat($('#invoice_summary input[name=total_for_jobs]').val());
		isNaN(job_amount)? job_amount = 0:'';

		var d_amount = parseFloat($('#invoice_summary input[name=cash_discount_amt]').val()); /*cash discount amount*/
		isNaN(d_amount)? d_amount = 0:'';

		var vat = parseFloat($('#invoice_summary input[name=vat_percent]').val());
		isNaN(vat)? vat = 0:'';

		var net_total = parts_amount + job_amount;

		var total = parseFloat(parts_amount) + parseFloat(job_amount);
		percent = ( d_amount /  total) * 100;

		$('#invoice_summary input[name=cash_discount_percent]').val(percent);

		parts_amount = parts_amount - ((parts_amount * percent) / 100);		 /*discount cash percent*/
		var vat_parts = (parts_amount * vat ) /100; 							/*add vat*/
		job_amount = job_amount - ((job_amount * percent) / 100);			 /*discount cash percent*/
		var vat_job = (job_amount * vat ) /100; 								/*add vat*/
		$('#invoice_summary input[name=vat_parts]').val(vat_parts);
		$('#invoice_summary input[name=vat_job]').val(vat_job);

		net_total = net_total + vat_parts + vat_job - d_amount;
		$('#invoice_summary input[name=net_total]').val(net_total);
	}


	function cal_part_cost(price, quantity, discount) {
		var part_cost = (price - (price * discount) / 100) * quantity;
		return part_cost;
	}

	function cal_labor_cost(labour, discount) {
		var labour_cost = labour - (labour * discount) / 100;
		return labour_cost;
	}

	function cal_discount_amount(cost,quantity,labour,discount) {
		var discount_amount = (cost * quantity +labour) * discount / 100;
		return discount_amount;
	}

	function cal_vat_amt(){
		var final_amount = 1000;
		var discount_percentage = $('#no_vat_total_bill_bill')
	}


</script>