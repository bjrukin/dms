<style type="text/css">
.cls-outsidework {
	background-color: lightcyan;
}
.cls-job {
	/*background-color: lightgreen;*/
}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1><?php echo lang('job_cards'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('job_cards');  echo "-".@$dealer_id; ?></li>
		</ol>
	</section>
	<section class="content">


		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php echo $header; ?></h3>
					</div>
					<div class="box-body">

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
													<div id='' class="jqxRadioButton-payment_type" name="payment_type" value="cash" >Cash</div>
													<div id='' class="jqxRadioButton-payment_type" name="payment_type" value="credit" >Credit</div>
													<div id='' class="jqxRadioButton-payment_type" name="payment_type" value="card" >Card</div>
													<input type="hidden" name="payment_type_val" id="jqxRadioButton-payment_type">
												</fieldset>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-2"> Date </div>
											<div class="col-md-10 col-sm-6"> <div id='invoice_details-issue_date' class="jqxdatetimeinput" name=issue_date></div></div>
										</div>

										<div class="row payment_type" id="cash_select" hidden>
											<div class="col-md-2"> Cash A/C. </div>
											<div class="col-md-10  col-sm-6"> <div id='jqxdropdownlist-cash_account' name="cash_account"> </div> </div>
										</div>
										<div class="row payment_type" id="credit_select" hidden>
											<div class="col-md-2"> Ledger </div>
											<div class="col-md-10"> <div id='jqxdropdownlist-credit_account' name="credit_account"> </div> </div>
										</div>
										<div class="row payment_type" id="card_select" hidden>
											<div class="col-md-2"> Card </div>
											<div class="col-md-10"> <div id='jqxdropdownlist-card_account' name="card_account"> </div> </div>
										</div>
										<div class="row form-group">
											<div class="col-md-2"> Invoice No. </div>
											<div class="col-md-4  col-sm-4">
												<!-- <input type="hidden" name="invoice_no-prefix" class="form-control input-sm" value="<?php echo @$has_billed->invoice_prefix; ?>" readonly> -->
												<input type="hidden" name="invoice_no" class="form-control input-sm" value="<?php echo $invoice_number = isset($has_billed->invoice_no)?$has_billed->invoice_no:$bill_id; ?>" readonly>
												<div class="form-control input-sm" ><?php echo ($invoice_number)?"TI-".sprintf('%05d', $invoice_number):''; ?></div>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-2">Job No.</div>
											<div class="col-md-4  col-sm-4">
												<div class="form-control input-sm" ><?php echo "JC-".sprintf('%05d', $jobcard->jobcard_serial) ?></div>
												<input type="hidden" name="job_no" class="form-control input-sm" value="<?php echo $job_detail['jobcard_group']?>" readonly>
											</div>
											<!-- </div> -->
											<!-- <div class="row"> -->
												<div class="col-md-2">Service</div>
												<div class="col-md-4  col-sm-6"><input class="form-control input-sm" value="<?php 
												echo $jobcard->service_type_name . " - " . $jobcard->service_count;
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
												<div class="col-md-2  col-sm-6">Vehicle No.</div>
												<div class="col-md-3  col-sm-6"><input type="text" name="" class="form-control input-sm" value="<?php echo $jobcard->vehicle_no; ?>" readonly></div>
												<div class="col-md-2 col-sm-6">Model</div>
												<div class="col-md-5  col-sm-6"><input type="text" name="" class="form-control input-sm" value="<?php echo "{$jobcard->vehicle_name} {$jobcard->variant_name} {$jobcard->color_name} "; ?>" readonly></div>
											</div>
											<div class="row">
												<div class="col-md-2">Party</div>
												<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php echo @$jobcard->customer_name; ?>" readonly></div>
											</div>
											<div class="row">
												<div class="col-md-2">Address</div>
												<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php echo @$jobcard->address1; ?>" readonly></div>
												<div class="col-md-offset-2 col-md-10"><input type="text" name="" class="form-control input-sm"  value="<?php echo $jobcard->address2; ?>" readonly></div>
											</div>
										</fieldset>
									</div>
								</div>
								<!-- end row -->
							</form>
							<div class="row">
								<div class="col-md-12"><label>Job Lists </label></div>
								<div class="col-md-12">
									<div id="jqxGridJobBill"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"><label> Parts Lists</label> </div>
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
														<div class="col-md-offset-6 col-md-3">Parts</div>
														<div class="col-md-3">Jobs</div>
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
						</div>
					</div>
					<div class="box-footer clearfix">
						<div class="row">
							<div class="col-md-12">
								<div class="pull-right">

									<div class="btn-group btn-group-sm">
										<!-- <button class="btn btn-default btn-flat " id="" onclick="printPreview('Gatepass')">Generate Gatepass</button> -->
										<button class="btn btn-default btn-flat " id="" onclick="printPreview('Invoice')">Print</button>
										<?php if( ! ($has_billed) ) : ?>
											<button class="btn btn-primary btn-flat " id="save_bill">Create BILL</button>
										<?php endif; ?>
										<button class="btn btn-default btn-flat " id="close_bill">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	var ALLOWED_DISCOUNT = 10;
	// var ALLOWED_DISCOUNT = 22;
	// var numberthingy = 1231321321.4654;
	// console.log(numberthingy.toLocaleString('en-IN', { style: 'currency', currency: 'NPR', currencyDisplay: 'symbol' }));

	function getFormData(formId) {
		return $('#' + formId).serializeArray().reduce(function (obj, item) {
			var name = item.name,
			value = item.value;

			if (obj.hasOwnProperty(name)) {
				if (typeof obj[name] == "string") {
					obj[name] = [obj[name]];
					obj[name].push(value);
				} else {
					obj[name].push(value);
				}
			} else {
				obj[name] = value;
			}
			return obj;
		}, {});
	}

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



	$("#invoice_details-issue_date").jqxDateTimeInput({ width: '250px', height: '34px', formatString: "yyyy-MM-dd HH:mm:ss",readonly: true, allowKeyboardDelete: false, showCalendarButton: false, });

	var cash_accountSource = [
	"Cash Account (Cash a/c) ",
	"PETTY CASH",
	];
	$("#jqxdropdownlist-cash_account").jqxDropDownList({ source: cash_accountSource, selectedIndex: 0, width: '100%', height: '34px',autoDropDownHeight: true,  });



	// var UserLedgersource =
	// {
	// 	datatype: "json",
	// 	datafields: [
	// 	{ name: 'id' },
	// 	{ name: 'full_name' }
	// 	],
	// 	url: '<?php echo site_url('job_cards/billing/user_list_json'); ?>',
	// 	async: true
	// };
	// var UserLedgerdataAdapter = new $.jqx.dataAdapter(UserLedgersource);

	// Create a jqxDropDownList
	// $("#jqxdropdownlist-credit_account").jqxDropDownList({
	// 	source: UserLedgerdataAdapter, displayMember: "full_name", valueMember: "id", width: '100%', height: '34px',autoDropDownHeight: true
	// });

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
	// $("#jqxdropdownlist-card_account").jqxDropDownList({ source: card_accountSource, selectedIndex: 0, width: '100%', height: '34px',autoDropDownHeight: true,  });
	masterDataSource.data = {table_name: 'mst_banks'};
	bankAdapter = new $.jqx.dataAdapter(masterDataSource, {autoBind: false});

	$("#jqxdropdownlist-card_account").jqxDropDownList({
		source: bankAdapter, 
		selectedIndex: 0, 
		width: '100%', 
		height: '34px',
		autoDropDownHeight: true,  
    	displayMember: "name",
    	valueMember: "name",
	});
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
			var UserLedgersource = {
					url : '<?php echo site_url("admin/job_cards/get_user_list_json"); ?>',
					datatype: 'json',
					datafields: [
					{ name: 'id', type: 'number' },
					{ name: 'full_name', type: 'string' },
					{ name: 'party_name', type: 'string' },
					],
				}

				UserledgerDataAdapter = new $.jqx.dataAdapter(UserLedgersource, {
					formatData: function (data) {
						if ($("#jqxdropdownlist-credit_account").jqxComboBox('searchString') != undefined) {
							data.name_startsWith = $("#jqxdropdownlist-credit_account").jqxComboBox('searchString');
							return data;
						}
					}
				});

				$("#jqxdropdownlist-credit_account").jqxComboBox({
					width: '100%',
					height: 25,
					source: UserledgerDataAdapter,
					minLength: 3,
					remoteAutoComplete: true,
					selectedIndex: 0,
					displayMember: "full_name",
					valueMember: "id",			
					search: function (searchString) {
						UserledgerDataAdapter.dataBind();
					}
				});
			$('#credit_select').show();
		}
		if(val == 'card')
		{
			$('#card_select').show();
		}

	});

	$('#close_bill').click(function(){
		window.close();
		// $('#jqxPopupWindowBill').jqxWindow('close');
		// $('#jqxPopupWindowBill').unblock();
	});


</script>

<script type="text/javascript">
	var job_cardsDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'job_id', type: 'number' },
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
		{ name: 'closed_status', type: 'string'},
		{ name: 'has_billed', type: 'string'},
		{ name: 'margin_percentage', type: 'number'},

		],
		//estimate_form_data_json - mis named, it gets job and outsidework lists
		url: '<?php echo $job_url; ?>', 
		pagesize: defaultPageSize,
		root: 'rows',
		// id : 'id',
		// cache: true,
		data: {
			jobcard_group	: <?php echo $job_detail['jobcard_group']?>,
			status 			: 'PENDING',
		},
		

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

	var jobcardDataAdapter = new $.jqx.dataAdapter(job_cardsDataSource);

	$("#jqxGridJobBill").jqxGrid({
		theme: theme,
		width: '100%',
		height: '400px',
		source: jobcardDataAdapter,
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
		selectionmode: 'singlecell',
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showaggregates: true,
		showstatusbar: true,
		editable : true,
		columns: [
		{ text: 'SN', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false,},
		{ text: '<?php echo lang("job"); ?>',datafield: 'job',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: false, cellclassname: cellclassrenderer,editable : false, },
		{ text: '<?php echo lang("description"); ?>',datafield: 'job_description',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: false, cellclassname: cellclassrenderer, editable : false, },
		{ text: '<?php echo lang("status"); ?>', datafield: 'status', filterable: true, renderer: gridColumnsRenderer, cellclassname: cellclassrenderer, editable : false,},
		// { text: '<?php echo lang("customer_price"); ?>',datafield: 'customer_price',filterable: true,editable:false, cellclassname: cellclassrenderer, width: '10%', },
		{ 
			text: '<?php echo lang("cost"); ?>',datafield: 'cost',filterable: true,  cellclassname: cellclassrenderer, width: '10%', cellsformat: 'f2', cellsalign: 'right',
			validation: function(cell, value) {
				if( value < 0 ) {
					return { result: false, message: "Cannot update lesser than zero" };
				}
				return true;
			}, cellbeginedit: function(row) {
				var row = $("#jqxGridJobBill").jqxGrid('getrowdata',row);
				if(row.has_billed == 1) {  // || row.closed_status == 1
					return false;
				}
				return true;
			}, cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var discount = $("#jqxGridJobBill").jqxGrid('getcellvalue', row, "discount_percentage");

				discount = (100 - discount )/100;

				if (newvalue != oldvalue) {
					// var amount = newvalue/100 * cost;
					$("#jqxGridJobBill").jqxGrid('setcellvalue', row, "final_amount", newvalue * discount);
				};

			}
		},
		 { text: 'Margin Percentage',datafield: 'margin_percentage',filterable: true,editable:false, cellclassname: cellclassrenderer, width: '10%', },
		
		{ 
			text: '<?php echo lang("discount_percentage"); ?>', datafield: 'discount_percentage', width: '10%',filterable: true, renderer: gridColumnsRenderer, columntype: 'numberinput', cellsalign: 'right',
			cellclassname: cellclassrenderer, validation: function( cell, value ) {
				if( value > ALLOWED_DISCOUNT || value < 0) {
					return { result: false, message: "Cannot provide such discount." };
				}
				return true;
			}, cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var cost = $("#jqxGridJobBill").jqxGrid('getcellvalue', row, "cost");
				if( newvalue > ALLOWED_DISCOUNT || newvalue < 0) {
					$("#jqxGridJobBill").jqxGrid('setcellvalue', row, "final_amount", cost);
					return false;
				}
				if (newvalue != oldvalue) {
					var amount = newvalue/100 * cost;
					$("#jqxGridJobBill").jqxGrid('setcellvalue', row, "final_amount", cost - amount);
				};
			}, cellbeginedit: function(row) {
				var row = $("#jqxGridJobBill").jqxGrid('getrowdata',row);
				if(row.has_billed == 1) {  // || row.closed_status == 1
					return false;
				}
				return true;
			}
		},
		{ 
			text: '<?php echo lang("final_amount"); ?>', datafield: 'final_amount', width: '10%', filterable: true, renderer: gridColumnsRenderer, cellsformat: 'f2', cellclassname: cellclassrenderer, editable:false, cellsalign: 'right',
			aggregates: [{ 
				'<b>Total</b>':
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
		rendergridrows: function (result) {
			return result.data;
		},
		ready: function () {
			var under_warranty = '<?php echo $under_warranty ?>';
			if(under_warranty){
				var rowscounts = $('#jqxGridJobBill').jqxGrid('getdatainformation');
				var rows = $('#jqxGridJobBill').jqxGrid('getrows');
				rowscounts = rowscounts.rowscount;

				if( rows[0].has_billed == 1){
					return;
				}

					// $('#jqxGridJobBill').jqxGrid('setcellvalue', i, "cost", '0');
				for (var i = 0; i < rowscounts; i++) {
					if( ! rows[i].ow) {
						// $('#jqxGridJobBill').jqxGrid('setcellvalue', i, "final_amount", '0');
					}
				}
			}
		},
	});

	// saving INVOCIE
	$('#save_bill').click(function(){
		$('#save_bill').attr('disable',true);
		$('.content').block({ 
			message: '<span>Processing your request. Please be patient.</span>',
			css: { 
				width                   : '75%',
				border                  : 'none', 
				padding                 : '50px', 
				backgroundColor         : '#000', 
				'-webkit-border-radius' : '10px', 
				'-moz-border-radius'    : '10px', 
				opacity                 : .4, 
				color                   : '#fff',
				cursor                  : 'wait' 
			}, 
		});

		var bill_job_datas = $('#jqxGridJobBill').jqxGrid('getrows');
		var bill_part_datas = $('#jqxGridPartBill').jqxGrid('getrows');
		var bill_details = getFormData('invoice_details');
		var bill_summary = getFormData('invoice_summary');

		var newnew = $('.jqxRadioButton-bill_type').val()
		$.ajax({
			type:       "POST",
			url:        "<?php echo site_url('job_cards/billing/save')?>",
			data:       {
				bill_job_datas:bill_job_datas,
				bill_part_datas:bill_part_datas,
				bill_details:bill_details,
				bill_summary:bill_summary,
			},
			success:    function(){
				location.reload();
				$('.content').unblock();

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

	var materialDataSource =
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
		{ name: 'received_quantity', type: 'string'},
		{ name: 'jobcard_group', type: 'string'},
		{ name: 'closed_status', type: 'string'},
		{ name: 'is_consumable', type: 'string'},
		{ name: 'has_billed', type: 'number'},
		{ name: 'display_quantity', type: 'number'},
		{ name: 'lube_quantity', type: 'number'},

		],
		url: '<?php echo $part_url; ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		data: {
			jobcard_group	: <?php echo $job_detail['jobcard_group']?>,
			// status 			: 'PENDING',
		},

	};
	var materialDataAdapter = new $.jqx.dataAdapter(materialDataSource);

	// cash_discount_bill = job_cardsDataSource2.records[0].cash_discount_bill;
	/*if(job_cardsDataSource2.records[0] != undefined){
		$('#total_discount_bill').val(job_cardsDataSource2.records[0].cash_discount_bill);
	}*/

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
		height: '400px',
		source: materialDataAdapter,
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
		selectionmode: 'singlecell',
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showaggregates: true,
		showstatusbar: true,
		editable : true,
		columns: [
		{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		// { text: '<?php echo lang("part_id")?>', datafield: 'sparepart_id',},
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',/*width: '10%',*/filterable: true,renderer: gridColumnsRenderer,editable:false,},
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',/*width: '15%',*/filterable: true,renderer: gridColumnsRenderer, editable:false, },
		{ text: '<?php echo lang("warranty"); ?>', datafield: 'warranty', width: '5%', filterable: true, renderer: gridColumnsRenderer, columntype: 'string', editable: false, },
		{ 
			text: '<?php echo lang("price"); ?>',datafield: 'price',width: '10%',filterable: true,renderer: gridColumnsRenderer,cellsformat: 'f2', cellsalign: 'right',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var quantity = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "display_quantity");;
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
			}, editable:false,
		},
		{ 
			text: '<?php echo lang("quantity"); ?>', datafield: 'display_quantity', width: '10%', filterable: true, renderer: gridColumnsRenderer, columntype: 'numberinput', editable: false,  cellsalign: 'right',
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
			text: '<?php echo lang("discount_percentage"); ?>', datafield: 'discount_percentage', width: '10%', filterable: true, renderer: gridColumnsRenderer, columntype: 'numberinput', cellsalign: 'right',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if( newvalue > ALLOWED_DISCOUNT || newvalue < 0) {
					return false;
				}
				if (newvalue != oldvalue) {
					var price = parseFloat($('#jqxGridPartBill').jqxGrid('getcellvalue', row, "price"));
					var quantity = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "display_quantity");;
					var total;

					total = price * quantity;
					total = total - ( (newvalue/100) * total );

					$("#jqxGridPartBill").jqxGrid('setcellvalue', row, "final_price", total);
				};
			}, cellbeginedit: function(row) {
				var row = $("#jqxGridPartBill").jqxGrid('getrowdata',row);
				if(row.has_billed == 1) {
					return false;
				}
				return true;
			}
		},
		{ 
			text: '<?php echo lang("final_amount"); ?>', datafield: 'final_price', width: '10%', filterable: true, renderer: gridColumnsRenderer, cellclassname: cellclassrenderer, editable: false, cellsalign: 'right',cellsformat: 'f2',
			aggregates: [{ '<b>Total</b>':
			function (aggregatedValue, currentValue, column, record) {
				var total = currentValue;
				if(isNaN(total)){
					total = 0;
				}
				total = aggregatedValue + total;

				$('#invoice_summary input[name=total_for_parts]').val(total);
				cal_cash_discount_bill_percent();

				return total;
			}
		}] },


		],
		rendergridrows: function (result) {
			return result.data;
		},
		ready: function () {
			var parts_rows = $('#jqxGridPartBill').jqxGrid('getrows');
			// console.log(parts_rows);
			$.each(parts_rows, function(i,v) {
				if(v.warranty == "FREE"){
					//$('#jqxGridPartBill').jqxGrid('setcellvalue', i, "final_price", '0');
				}

				$('#jqxGridPartBill').jqxGrid('setcellvalue', i, "final_price", v.price * v.display_quantity);

				// $('#jqxGridPartBill').jqxGrid('setcellvalue', i, "discount_percentage", '0');

			});
			$('#jqxGridPartBill').jqxGrid('render');

		},
	});

	// summary calculation
	function cal_cash_discount_bill_percent() {

		var parts_amount = parseFloat($('#invoice_summary input[name=total_for_parts]').val());
		isNaN(parts_amount)? parts_amount = 0:'';

		var job_amount = parseFloat($('#invoice_summary input[name=total_for_jobs]').val());
		isNaN(job_amount)? job_amount = 0:'';

		var percent = parseFloat($('#invoice_summary input[name=cash_discount_percent]').val());
		isNaN(percent)? percent = 0:'';

		if(percent > ALLOWED_DISCOUNT ) {
			alert("Error: Cannot set discount.");
			$('#invoice_summary input[name=cash_discount_percent]').val('')
			$('#invoice_summary input[name=cash_discount_amt]').val('')
			return false;
		}

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

		if(percent > ALLOWED_DISCOUNT ) {
			alert("Error: Cannot set discount.");
			$('#invoice_summary input[name=cash_discount_percent]').val('')
			$('#invoice_summary input[name=cash_discount_amt]').val('')
			return false;
		}

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


	function printPreview(type, id = null)
	{
		switch(type){
			case 'Invoice':
			if(id == null) {
				id = $('#invoice_details input[name="job_no"]').val();
			}
			break;
			case 'Gatepass':
			if(id == null) {
				id = $('#invoice_details input[name="job_no"]').val();
			}
			break;


		}
		var url = '<?php echo site_url('job_cards/print_preview?jobcard=') ?>' + id + '&type=' + type;


		myWindow = window.open(url, type, "height=900,width=1300");

		myWindow.document.close(); 

		myWindow.focus();
		myWindow.print();
	}

	$(function(){
		<?php if($has_billed): ?>
		$('#invoice_details-issue_date').jqxDateTimeInput('setDate', "<?php echo $has_billed->issue_date; ?>");
		<?php else: ?>
		$('#invoice_details')[0].reset();
		<?php endif; ?>

	});

</script>