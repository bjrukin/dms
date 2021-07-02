<script type="text/javascript" src="<?php echo base_url('assets/js/custom_getFormData.js'); ?>"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('counter_sales'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('counter_sales'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCounter_saleToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCounter_saleCreateRequest"> Create Request</button> -->
					<?php if (control('Create Counter sales', FALSE)): ?>
						<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCounter_saleInsert"><?php echo ('Create Counter Request'); ?></button>
					<?php endif;?>
					<button type="button" class="btn btn-default btn-flat btn-xs" id="jqxGridCounter_saleFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCounter_sale"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCounter_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-counter_sales', 'onsubmit' => 'return false')); ?>
		<!-- <input type = "hidden" name = "id" id = "counter_sales_id"/> -->

		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">Payment</div>
					<div class="col-md-10" >
						<div id='' class="counter_sale-payment_type" name="" value="cash" style="float: left;" >Cash</div>
						<div id='' class="counter_sale-payment_type" name="" value="credit" style="float: left;">Credit</div>
						<div id='' class="counter_sale-payment_type" name="" value="card" style="float: left;">Card</div>
						<input type="hidden" name="payment_type_val" id="counter_sale-payment_type">
					</div>
				</div>
				<div class="row form-group"> 
					<div class="col-md-2"> Date/Time</div>
					<div class="col-md-10"> <div id='' class="jqxdatetimeinput" name=issue_date></div></div>
				</div>
				<div class="row form-group"> 

					<div class="col-md-2"> CounterSales No.</div>
					<div class="col-md-2 "> <input type="text" id='counter_sales_id' class="form-control input-sm" name="counter_sales_id"  readonly> </div>
					<div class="col-md-2">Invoice No.</div>
					<div class="col-md-2"> <input type="text" name="invoice_no-prefix" class="form-control input-sm" readonly> </div>
					<div class="col-md-2"> <input type="text" name="invoice_no" class="form-control input-sm" value="" readonly> 
					</div>
					<!-- <i class="fa fa-search" onclick="findCounterInvoice()"></i> -->
				</div>
				<!-- <div class="row">
					<div class="col-md-2"> Cash A/C. </div>
					<div class="col-md-10"> <div id='jqxdropdownlist' name="cash_account"> </div> </div>
				</div> -->
				<div class="row form-group">
					<div class="col-md-2"> Party Name </div>
					<div class="col-md-10">  <div id='counter_sale-credit_account' name="credit_account"> </div> </div>
				</div>
			</div>
			<div class="col-md-6">
				<fieldset>
					<legend>Party Details</legend>
					<div class="row">
						<div class="col-md-2">Vehicle No.</div>
						<div class="col-md-4"><input type="text" name="vehicle_no" class="form-control input-sm" ></div>
						<div class="col-md-2">Engine No.</div>
						<div class="col-md-4"><input type="text" name="engine_no" class="form-control input-sm" ></div>
					</div>
					<div class="row">
						<div class="col-md-2">Chassis</div>
						<div class="col-md-4"><input type="text" name="chassis_no" class="form-control input-sm" ></div>
					</div>
					<div class="row">
						<div class="col-md-2">Model</div>
						<div class="col-md-4"><div type="text" name="vehicle_id" class="form-control input-sm" ></div></div>
						<div class="col-md-2">Variant</div>
						<div class="col-md-4"><div type="text" name="variant_id" class="form-control input-sm" ></div></div>
					</div>
					<!-- <div class="row">
						<div class="col-md-2">Party</div>
						<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php //echo $vehicle_detail->full_name; ?>" readonly></div>
					</div> -->
					<div class="row">
						<div class="col-md-2">Address</div>
						<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php //echo //$vehicle_detail->address1; ?>" readonly></div>
					</div>
				</fieldset>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- ############################## for material grid ############################## -->
		<div>Material Required</div>
		<div id="materialCounterJqxgrid"></div>
		<!-- ############################## end of material grid ############################## -->

		<!-- <fieldset>
			<legend>Summary</legend>
			<div class="row">
				<form id="counter_summary">

					<div class="col-md-offset-7 col-md-5">
						<div class="row">
							<div class="col-md-9">Total</div>
							<div class="col-md-3"><input type="text" id="counter_summary-total_for_parts" name="total_for_parts" class="form-control input-sm" value="" readonly></div>
							<div class="" hidden><input type="text" name="total_for_jobs" class="form-control input-sm"  readonly></div>
						</div>
						<div class="row">
							<div class="col-md-3">Cash Dis.</div> 
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
							<div class="col-md-offset-3 col-md-3"><input type="text" name="vat_parts" class="form-control input-sm" readonly></div>
							<div class="" hidden><input type="text" name="vat_job" class="form-control input-sm" readonly></div>
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
		</fieldset> -->

		<div class="btn-group btn-group-sm pull-right">
			<button type="button" class="btn btn-success btn-flat" id="jqxCounter_saleSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-link btn-flat" id="jqxCounter_saleCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>
	</div>
</div> <!-- end jqxPopupWindowCounter_sale -->



<!-- for parts form -->
<div id="jqxPopupWindowPartCounter">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Add Part</span>
	</div>
	<div class="form_fields_area">
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('part_name')?></label></div>
				<div class="col-md-8"><div id="new_part_id_counter" class="" ></div></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('part_code')?></label></div>
				<div class="col-md-8"><span id="new_part_code_counter"></span></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('price')?></label></div>
				<div class="col-md-6"><input type="number" class="form-control" id="new_part_price_counter" ></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('quantity')?></label></div>
				<div class="col-md-3"><input type="number" class="form-control" id="new_part_quantity_counter"></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('total')?></label></div>
				<div class="col-md-6"><input type="number" class="form-control" id="new_part_total_counter" readonly></div>
			</div>

			<input type="hidden" name="new_part_name" id="new_part_name_counter">
			<input type="hidden" name="new_min_price" id="new_min_price_counter">
			<input type="hidden" id="new_part_stock_quantity">

			<div class="row form-group">
				<div class="col-md-12">
					<div class="btn-group btn-group-sm pull-right">
						<button class="btn btn-primary btn-flat" id="part_to_table_counter">Add</button>
						<button class="btn btn-link btn-flat" id="close_add_part_counter"><?php echo lang('general_cancel')?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="jqxPopupWindowViewCounter_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Counter Sales</span>
	</div>
	<div>
		<div class="col-md-12">
			<div class="row">
				
				<div class="col-md-6 col-sm-6">
					<div class="row">
						<div class="col-md-3">Payment</div>
						<div class="col-md-9"><div id="viewCounter-payment" class="form-control" readonly></div></div>
					</div>
					<div class="row">
						<div class="col-md-3">Date/Time</div>
						<div class="col-md-9"><div id="viewCounter-datetime" class="form-control" readonly></div></div>
					</div>
					<div class="row">
						<div class="col-md-3">Invoice No.</div>
						<div class="col-md-9"><div id="viewCounter-invoiceno" class="form-control" readonly></div></div>
					</div>
					<div class="row">
						<div class="col-md-3">Party Name</div>
						<div class="col-md-9"><div id="viewCounter-partyname" class="form-control" readonly></div></div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<fieldset>
						<legend>Party Details</legend>
						<div class="row">
							<div class="col-md-2">Vehicle No.</div>
							<div class="col-md-4"><div id="viewCounter-vehicle_no" class="form-control" readonly></div></div>
							<div class="col-md-2">Engine No.</div>
							<div class="col-md-4"><div id="viewCounter-engine_no" class="form-control" readonly></div></div>
						</div>
						<div class="row">
							<div class="col-md-2">Chassis</div>
							<div class="col-md-4"><div id="viewCounter-chassis_no" class="form-control" readonly></div></div>
						</div>
						<div class="row">
							<div class="col-md-2">Model</div>
							<div class="col-md-4"><div id="viewCounter-vehicle_name" class="form-control" readonly></div></div>
							<div class="col-md-2">Variant</div>
							<div class="col-md-4"><div id="viewCounter-variant_name" class="form-control" readonly></div></div>
						</div>
						<!-- <div class="row">
							<div class="col-md-2">Party</div>
							<div class="col-md-10"><input type="text" name="" class="form-control input-sm" value="<?php //echo $vehicle_detail->full_name; ?>" readonly></div>
						</div> -->
						<div class="row">
							<div class="col-md-2">Address</div>
							<div class="col-md-10"><div id="viewCounter-address1" class="form-control" readonly></div></div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="viewCounter-parts_table"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-7 col-md-5 col-sm-offset-6 col-sm-6">
					<form id="form-countersale_summary">
						<input type="hidden" name="counter_sales_id" id="viewCounter-id" value="">
						
						<fieldset>
							<legend>Summary</legend>

							<div class="row">
								<div class="col-md-9">Total</div>
								<div class="col-md-3"><input id="viewCounter-total_for_parts" name="total_for_parts" class="form-control input-sm" readonly></div>
								<!-- <div class="" hidden><input id="viewCounter-total_for_jobs" type="text" name="total_for_jobs" class="form-control input-sm"  readonly></div> -->
							</div>
							<div class="row">
								<div class="col-md-3">Cash Dis.</div> <!-- total_discount_bill_cash -->
								<div class="col-md-3">
									<input type="number" id="viewCounter-cash_discount_percent" name="cash_discount_percent" class="form-control input-sm" step="1" onchange="calculate_counter_summary('viewCounter','percent')">
								</div>
								<div class="col-md-offset-3 col-md-3">
									<input id="viewCounter-cash_discount_amt" name="cash_discount_amt" onchange="calculate_counter_summary('viewCounter')" class="form-control input-sm">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">VAT.</div>
								<div class="col-md-3">
									<input id="viewCounter-vat" name="vat" class="form-control" value="13" readonly>
								</div>
								<div class="col-md-offset-3 col-md-3">
									<input id="viewCounter-vat_parts" name="vat_parts" class="form-control" readonly>
								</div>
							</div>
							<div class="row" hidden>
								<div class="col-md-6">Round Off</div>
								<div class="col-md-offset-3 col-md-3"><div id="viewCounter-roundoff" class="form-control input-sm" readonly></div></div>
							</div>
							<div class="row">
								<div class="col-md-6">Net Amount</div>
								<div class="col-md-offset-3 col-md-3"><input id="viewCounter-net_total" name="net_total" class="form-control input-sm" readonly></div>
							</div>

						</fieldset>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="btn-group btn-group-sm pull-right">
						<button type="button" id="viewCounter_submit" class="btn btn-primary">Forward to Material Issue</button>
						<button type="button" id="viewCounter_print" class="btn btn-success" >Print</button>
						<button type="button" id="viewCounter-close" class="btn btn-default">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="jqxPopupWindowRequestCounterParts">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Counter Sales</span>
	</div>
	<div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div id="jqxGrid_requestparts_list"></div>
				</div>
			</div>
		</div>
		<input type="hidden" name="id" id="requestCounter_id">
		<input type="hidden" id="requestCounter_countersalesid">
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-primary" id="requestCounter_submit">Complete Request</button>
				<button type="button" class="btn btn-link" id="requestCounter_cancel">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div id="counter_confirm-popupWindow">
	<div> Delete </div>
	<div>
		<p>Delete a row?</p>
		<button class="btn btn-default btn-flat btn-sm" id="counter_confirm-save">Yes</button>
		<button class="btn btn-default btn-flat btn-sm" id="counter_confirm-cancel">No</button>
	</div>
</div>

<div id="jqxPopupWindowIssueCounter_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Counter Sales</span>
	</div>
	<div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<label>Barcode: </label><input type="text" id="scan_code">
					<span id="error_scan"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="jqxGrid_issueparts_list"></div>
				</div>
			</div>
		</div>
		<!-- <input type="hidden" name="id" id="requestCounter_id"> -->
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-default btn-flat btn-xs" id="issueCounter-close">Close</button>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="" id="counter_bill_id">



<div id="jqxPopupWindowViewIssueCounter_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Counter Sales</span>
	</div>
	<div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">CounterSales No. :  </div><div class="col-md-2">
							<div id="issueCountersales-countersales_no_display" class="form-control" readonly></div>
							<input type="hidden" id="issueCountersales-countersales_no" class="form-control" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">Invoice No. : </div><div class="col-md-2">
							<div id="issueCountersales-invoice_no_display" class="form-control" readonly></div>
							<input type="hidden" id="issueCountersales-invoice_no" class="form-control" readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label>CounterSales</label>
					<div id="jqxGrid_view_issuet_parts_list"></div>
				</div>
			</div>
			<!-- <input type="hidden" name="id" id="requestCounter_id"> -->
			<div class="row">
				<div class="col-md-offset-6 col-md-6">
					<form id="form-counterIssue">
						<input type="hidden" name="counter_sales_id" id="counterIssue-id" value="">
						
						<fieldset>
							<legend>Summary</legend>

							<div class="row">
								<div class="col-md-8">Total</div>
								<div class="col-md-4"><input id="counterIssue-total_for_parts" name="total_for_parts" class="form-control input-sm" readonly></div>
								<!-- <div class="" hidden><input id="counterIssue-total_for_jobs" type="text" name="total_for_jobs" class="form-control input-sm"  readonly></div> -->
							</div>
							<div class="row">
								<div class="col-md-5">Cash Dis.</div> <!-- total_discount_bill_cash -->
								<div class="col-md-3">
									<input type="number" id="counterIssue-cash_discount_percent" name="cash_discount_percent" class="form-control input-sm" step="1" onchange="calculate_counter_summary('viewCounter', 'percent')">
								</div>
								<div class="col-md-4">
									<input id="counterIssue-cash_discount_amt" name="cash_discount_amt" onchange="calculate_counter_summary('viewCounter')" class="form-control input-sm">
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">VAT.</div>
								<div class="col-md-3">
									<input id="counterIssue-vat" name="vat" class="form-control" value="13" readonly>
								</div>
								<div class="col-md-4">
									<input id="counterIssue-vat_parts" name="vat_parts" class="form-control" readonly>
								</div>
							</div>
							<div class="row" hidden>
								<div class="col-md-5">Round Off</div>
								<div class="col-md-offset-3 col-md-4"><div id="counterIssue-roundoff" class="form-control input-sm" readonly ></div></div>
							</div>
							<div class="row">
								<div class="col-md-5">Net Amount</div>
								<div class="col-md-offset-3 col-md-4"><input id="counterIssue-net_total" name="net_total" class="form-control input-sm" readonly></div>
							</div>

						</fieldset>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary btn-flat" id="viewissueCounter-create_bill">Create Bill</button>
						<button type="button" class="btn btn-default btn-flat" id="viewissueCounter-close">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <input type="hidden" name="" id="counter_bill_id"> -->

<div id="window_gatepass">
	<div>Gatepass</div>
	<div>
		<div class="btn-group">
			<button id="create_gatepass" class="btn btn-primary btn-sm">Create Gatepass</button>
			<button id="cancel_gatepass" class="btn btn-default btn-sm">Cancel</button>
		</div>
	</div>
</div>


<script language="javascript" type="text/javascript">

	$(function(){

		var counter_salesDataSource =
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
			{ name: 'counter_sales_id', type: 'number' },
			{ name: 'vehicle_no', type: 'string' },
			{ name: 'chasis_no', type: 'string' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_id', type: 'number' },
			{ name: 'color_name', type: 'string' },
			{ name: 'party_id', type: 'number' },
			{ name: 'full_name', type: 'string' },
			{ name: 'date_time', type: 'string' },
			{ name: 'billing_record_id', type: 'number' },
			{ name: 'is_request_complete', type: 'string' },
			{ name: 'is_countersale_billed', type: 'string' },
			{ name: 'is_countersale_closed', type: 'string' },
			{ name: 'payment_type', type: 'string' },
			{ name: 'address1', type: 'string' },
			{ name: 'invoice_no', type: 'string' },

			],
			url: '<?php echo site_url("admin/counter_sales/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
				// callback called when a page or page size is changed.
			},
			beforeprocessing: function (data) {
				counter_salesDataSource.totalrecords = data.total;
			},
			// update the grid and send a request to the server.
			filter: function () {
				$("#jqxGridCounter_sale").jqxGrid('updatebounddata', 'filter');
			},
			// update the grid and send a request to the server.
			sort: function () {
				$("#jqxGridCounter_sale").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGridCounter_sale").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: counter_salesDataSource,
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
				container.append($('#jqxGridCounter_saleToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index,b,c,d,e,rows) {
					var view = cr = mi = bill = gate = returnvalue = '' ;
					
					view = ' | <a href="javascript:void(0)" onclick="viewCounter_saleRecord(' + index + '); return false;" title="View CounterSales"><i class="fa fa-eye"></i></a>';
					cr = ' | <a href="javascript:void(0)" onclick="confirm_request(' + index + '); return false;" title="Confirm Response"><i class="fa fa-hand-o-up"></i></a>';
					mi = ' | <a href="javascript:void(0)" onclick="issueCounter_sale(' + index + '); return false;" title="Issue List"><i class="fa fa-list"></i></a>';
					bill = ' | <a href="javascript:void(0)" onclick="view_issue_list(' + index + '); return false;" title="View Issue List"><i class="fa fa-book"></i></a>';
					gate = ' | <a href="javascript:void(0)" onclick="create_gatepass(' + index + '); return false;" title="Create Gatepass"><i class="fa fa-ticket"></i></a>';

					<?php if( is_accountant() ): ?>
					returnvalue += view;
					<?php endif; ?>


					<?php if(is_material_issuer()): ?>
					if(rows.is_request_complete != 1 ) {
						returnvalue += cr;
					}

					if(rows.is_countersale_closed == 1 && rows.is_countersale_billed != 1) {
						returnvalue += mi;
					}
					<?php endif; ?>

					<?php if( is_accountant() ): ?>
					if(rows.is_countersale_closed == 1) {
						returnvalue += bill;
					}
					if(rows.is_countersale_billed == 1) {
						returnvalue += gate;
					}
					<?php endif; ?>

					return '<div style="text-align: center; margin-top: 8px;">' + returnvalue + '</div>';
				}
			},
		// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("date_time"); ?>',datafield: 'date_time',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("counter_sales_id"); ?>',datafield: 'counter_sales_id',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsrenderer: function(a,b,value,d,e,row) {
			return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">CS-'+(value).pad(5)+'</div>';
		} },
		{ text: '<?php echo lang("party_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("billing_record_id"); ?>',datafield: 'billing_record_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("is_request_complete"); ?>',datafield: 'is_request_complete',width: 80,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox', editable: false },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridCounter_sale").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridCounter_saleFilterClear', function () { 
			$('#jqxGridCounter_sale').jqxGrid('clearfilters');
		});

		$(document).on('click','#jqxGridCounter_saleInsert', function () { 
			Part_form_table_counter.jqxGrid('clear');

			/*$.post('<?php echo site_url('admin/counter_sales/get_counter_sales_number/json'); ?>', function(r){
				$('#counter_sales_id').val(r);
			}, 'json');*/

			/*$.post('<?php echo site_url('admin/counter_sales/get_billing_number/json'); ?>', function(r){
				$('#form-counter_sales input[name=invoice_no]').val(r);
			}, 'json');*/

			openPopupWindow('jqxPopupWindowCounter_sale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});



	// initialize the popup window
	$("#jqxPopupWindowCounter_sale").jqxWindow({ 
		theme: theme,
		width: '99%',
		maxWidth: '99%',
		height: '99%',  
		maxHeight: '99%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 1,
		showCollapseButton: false 
	});


	$("#jqxPopupWindowViewCounter_sale").jqxWindow({ 
		theme: theme,
		width: '99%',
		maxWidth: '99%',
		height: '99%',  
		maxHeight: '99%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 1,
		showCollapseButton: false,
		cancelButton: $('#viewCounter-close')
	});

	$("#jqxPopupWindowIssueCounter_sale").jqxWindow({ 
		width: '100%',
		height: '99%', 
		resizable: false, 
		theme: theme, 
		isModal: true, 
		autoOpen: false, 
		modalOpacity: 0.4 ,
		cancelButton: $('#issueCounter-close')
	});

	$("#jqxPopupWindowViewIssueCounter_sale").jqxWindow({ 
		theme: theme, 
		width: '100%',
		height: '99%', 
		isModal: true, 
		autoOpen: false, 
		modalOpacity: 0.4 ,
		cancelButton: $('#viewissueCounter-close'),
	});

	$("#window_gatepass").jqxWindow({ 
		theme: theme, 
		width: '20%',
		height: '15%', 
		isModal: true, 
		autoOpen: false, 
		modalOpacity: 0.4 ,
		cancelButton: $('#cancel_gatepass'),
	});

	


	$("#jqxPopupWindowCounter_sale").on('close', function () {
		reset_form_counter_sales();
	});

	$("#jqxCounter_saleCancelButton").on('click', function () {
		reset_form_counter_sales();
		$('#jqxPopupWindowCounter_sale').jqxWindow('close');
	});

	$('#form-counter_sales').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [

		{ input: '#materialCounterJqxgrid', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#materialCounterJqxgrid').jqxGrid('getrows');
			return (val.length > 0) ? true: false;
		}
	},

	]
});

	$("#jqxCounter_saleSubmitButton").on('click', function () {
    	// saveCounter_saleRecord();

    	var validationResult = function (isValid) {
    		if (isValid) {
    			saveCounter_saleRecord();
    		}
    	};
    	$('#form-counter_sales').jqxValidator('validate', validationResult);

    });

    //Vehicle
    var vehicle_dataSource = {
    	url : '<?php echo site_url("admin/job_cards/get_vehicles_json"); ?>',
    	datatype: 'json',
    	datafields: [
    	{ name: 'vehicle_id', type: 'number' },
    	{ name: 'vehicle_name', type: 'string' },
    	],
    	async: false,
    	cache: true
    }

    vehicleAdapter = new $.jqx.dataAdapter(vehicle_dataSource);

    $("#form-counter_sales div[name=vehicle_id]").jqxComboBox({
    	theme: theme,
    	width: '92%',
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: vehicleAdapter,
    	valueMember: "vehicle_id",
    	displayMember: "vehicle_name",
    	placeHolder: "Select Vehicle"
    });

    $("#form-counter_sales div[name=variant_id]").jqxComboBox({
    	theme: theme,
    	width: '92%',
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	valueMember: "variant_id",
    	displayMember: "variant_name",
    	placeHolder: "Select Variant"
    });

    $("#form-counter_sales div[name=vehicle_id]").on('select', function (event) {
    	if (event.args) {
    		var item = event.args.item;
    		if (item) {
    			var variant_dataSource = {
    				url : '<?php echo site_url("admin/job_cards/get_variants_combo_json"); ?>',
    				data: {vehicle_id: item.value},
    				datatype: 'json',
    				datafields: [
    				{ name: 'vehicle_id', type: 'number' },
    				{ name: 'variant_id', type: 'number' },
    				{ name: 'variant_name', type: 'string' },
    				],
    				async: false,
    				cache: true
    			}

    			variantAdapter = new $.jqx.dataAdapter(variant_dataSource);

    			$("#form-counter_sales div[name=variant_id]").jqxComboBox({ source: variantAdapter, });

    		}
    	}
    });

});

$("#jqxGrid_issueparts_list").jqxGrid({
	theme: theme,
	width: '100%',
	height: 500,
	showtoolbar: true,
	showaggregates: true,
	showstatusbar: true,
	editable : true,
	altrows: true,
	pageable: true,
	sortable: true,
	showfilterrow: true,
	filterable: true,
	columnsresize: true,
	autoshowfiltericon: true,
	columnsreorder: true,
	selectionmode: 'singlecell',
	pagesize: 200,
	columns: [
	{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
	{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
	{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
	{ text: '<?php echo lang('quantity') ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
	{ text: '<?php echo lang('issue_date') ?>',datafield: 'issue_date',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
	],
});


function issueCounter_sale(index) {
	var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
	$('#jqxGrid_issueparts_list').jqxGrid('clear');
	$('#counter_bill_id').val(row.counter_sales_id);
	if (row) {
		// $('#issueCounter-id').val(row.id);
		$.post('<?php echo site_url("admin/counter_sales/get_countersales"); ?>',{counter_sales_id: row.counter_sales_id},function(result) {
			if(result.success) {
				var celleditable = function (cellrow, datafield, columntype, value) {
					var cellrow =  $("#viewCounter-parts_table").jqxGrid('getrowdata', cellrow);

					if(cellrow.is_countersale_closed == '1') {return false; }
				}

				var csMaterialIssue_datasource =
				{
					datatype: "json",
					datafields:
					[
					{ name: 'part_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'price', type: 'number' },
					{ name: 'quantity', type: 'number' },
					{ name: 'total', type: 'number' },
					{ name: 'warranty', type: 'string' },
					{ name: 'counter_request', type: 'string' },
					{ name: 'accepted_quantity', type: 'string' },
					{ name: 'quantity_to_bill', type: 'string' },
					{ name: 'part_id', type: 'string' },
					{ name: 'issue_date', type: 'string' },					
					],
					url: '<?php echo site_url("admin/counter_sales/json_material_issue"); ?>',
					data: { counter_sales_id: row.counter_sales_id },
					pagesize: defaultPageSize,
					root: 'rows',
					id : 'id',
					addrow: function (rowid, rowdata, position, commit) {
						commit(true);
					},
				};
				var csMaterialIssue_dataAdapter = new $.jqx.dataAdapter(csMaterialIssue_datasource);

				$("#jqxGrid_issueparts_list").jqxGrid({ source: csMaterialIssue_dataAdapter, });
			}
			$('#scan_code').val('');
			$('#scan_code').focus();

		},'json');
	}

	openPopupWindow('jqxPopupWindowIssueCounter_sale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
}

function viewCounter_saleRecord( index ) {
	var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);

	if (row) {
		if(row.is_countersale_closed == '1') {
			$('#viewCounter_submit').hide();
			$('#viewCounter_print').show();
			$('#viewCounter-cash_discount_amt').prop('readonly', true);
			$('#viewCounter-cash_discount_percent').prop('readonly', true);
		}else{
			$('#viewCounter_submit').show();
			$('#viewCounter_print').hide();
			$('#viewCounter-cash_discount_amt').prop('readonly', false);
			$('#viewCounter-cash_discount_percent').prop('readonly', false);
		}

		$('#viewCounter-id').val(row.counter_sales_id);
		$.post('<?php echo site_url("admin/counter_sales/get_countersales"); ?>',{counter_sales_id: row.counter_sales_id},function(result) {

			// console.log(result);
			if(result.success) {
				var celleditable = function (cellrow, datafield, columntype, value) {
					var cellrow =  $("#viewCounter-parts_table").jqxGrid('getrowdata', cellrow);
					if(cellrow.is_countersale_closed == '1') {return false; }
				}

				var counterSales_datasource =
				{
					localdata: data = {},
					datatype: "local",
					datafields:
					[
					{ name: 'id', type: 'number' },
					{ name: 'ser_parts_id', type: 'number' },
					{ name: 'part_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'price', type: 'number' },
					{ name: 'quantity', type: 'number' },
					{ name: 'total', type: 'number' },
					{ name: 'warranty', type: 'string' },
					{ name: 'counter_request', type: 'string' },
					{ name: 'accepted_quantity', type: 'string' },
					{ name: 'quantity_to_bill', type: 'string' },
					{ name: 'is_countersale_closed', type: 'string' },
					],
					addrow: function (rowid, rowdata, position, commit) {
						commit(true);
					},
				};

				var countersales_adapter = new $.jqx.dataAdapter(counterSales_datasource);

				$("#viewCounter-parts_table").jqxGrid({
					theme: theme,
					width: '100%',
					height: gridHeight,
					source: countersales_adapter,
					showtoolbar: true,
					showaggregates: true,
					showstatusbar: true,
					editable : true,

					altrows: true,
					pageable: true,
					sortable: true,
					showfilterrow: true,
					filterable: true,
					columnsresize: true,
					autoshowfiltericon: true,
					columnsreorder: true,
					selectionmode: 'singlecell',
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					/*{
						text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, editable:false, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
						cellsrenderer: function (index) {

							var v = '';
							// var v = '<a href="javascript:void(0)" onclick="remove_approved_part(' + index + '); return false;" title="trash"><i class="fa fa-trash"></i></a>';
							return '<div style="text-align: center; margin-top: 8px;">' + v + '</div>';
						}
					},*/
					{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable: false },
					{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
					{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
					{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
					{ text: '<?php echo lang("accepted_quantity"); ?>',datafield: 'accepted_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
					{ 
						text: '<?php echo lang("quantity_to_bill"); ?>',datafield: 'quantity_to_bill',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: true, cellbeginedit: celleditable,columntype: 'numberinput', validation: function( cell, value ) {
							var partdata = $("#viewCounter-parts_table").jqxGrid('getrowdata',cell.row);

							if(!( !isNaN(parseFloat(value)) && isFinite(value))){
								return { result: false, message: "Invalid Number" };
							}

							if(value > partdata.accepted_quantity && value >= 0) {
								return { result: false, message: "Cannot accept quantity greater than provided." };
							}
							if(value < 0) {
								return { result: false, message: "Cannot accept negative quantity." };
							}
							return true;
						}, cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
							var partdata = $("#viewCounter-parts_table").jqxGrid('getrowdata',row);

							if(newvalue <= partdata.accepted_quantity && newvalue >= 0) {
								if (newvalue != oldvalue) {
									var price = $("#viewCounter-parts_table").jqxGrid('getcellvalue', row, "price");
									var total = newvalue * price;
									$("#viewCounter-parts_table").jqxGrid('setcellvalue', row, "total", total);
									$.post("<?php echo site_url('admin/counter_sales/countersales_new_quantity')?>", {id:partdata.ser_parts_id, quantity:newvalue, total:total}, function(data){
									},'json');
								}
							}
						} },
						// { text: '<?php echo ("warranty"); ?>',datafield: 'warranty',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
						{ 
							text: '<?php echo lang("total"); ?>', datafield: 'total', width: 150, filterable: true, renderer: gridColumnsRenderer, editable: false, aggregates: [ { '<b>Total</b>':	function (aggregatedValue, currentValue, column, record) {
								var total = currentValue;
								total = aggregatedValue + total;

								$('#viewCounter-total_for_parts').val(total);
								calculate_counter_summary('viewCounter');

								return total;
							}
						}], },

						],
						rendergridrows: function (result) {
							return result.data;
						}
					});

$.each(result.data, function(i,v){
	var datarow = {
		'id'					: v.ser_parts_id,
		'ser_parts_id'			: v.ser_parts_id,
		'part_id'				: v.part_id,
		'part_name'				: v.part_name,
		'part_code'				: v.part_code,
		'price'					: v.price,
		'quantity'				: v.quantity,
		'total'					: v.final_amount,
		'issue_date'			: v.issue_date,
		'warranty'				: v.warranty,
		'accepted_quantity'		: v.accepted_quantity,
		'quantity_to_bill'		: v.quantity_to_bill,
		'is_countersale_billed'	: row.is_countersale_billed,
		'is_request_complete'	: row.is_request_complete,
		'is_countersale_closed'	: row.is_countersale_closed,
	};

	$("#viewCounter-parts_table").jqxGrid('addrow', null, datarow);
});

$("#viewCounter-payment").text(row.payment_type);
$("#viewCounter-datetime").text(row.date_time);
if(result.data[0].invoice_no) {
	$("#viewCounter-invoiceno").text('TI-' + (result.data[0].invoice_no).pad(5));
}
$("#viewCounter-partyname").text(row.full_name);

$("#viewCounter-vehicle_no").text(row.vehicle_no);
$("#viewCounter-engine_no").text(row.engine_no);
$("#viewCounter-chassis_no").text(row.chasis_no);
$("#viewCounter-vehicle_name").html(row.vehicle_name);
$("#viewCounter-variant_name").html(row.variant_name);
$("#viewCounter-address1").text(row.address1);


				// Summary Fields
				$("#viewCounter-cash_discount_amt").text(result.data[0].cash_discount_amt);
				$("#viewCounter-cash_discount_percent").text(result.data[0].cash_discount_percent);
				$("#viewCounter-vat").text(13);
				$("#viewCounter-vat_parts").text(result.data[0].vat_parts);
				$("#viewCounter-total_parts").text(result.data[0].total_parts);
				$("#viewCounter-net_total").text(result.data[0].net_total);

			}
		}, 'json');



openPopupWindow('jqxPopupWindowViewCounter_sale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
}
}

function editCounter_saleRecord(index){
	var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
	if (row) {
		$('#counter_sales_id').val(row.id);
		$('#counter_sales_id').jqxNumberInput('val', row.counter_sales_id);
		$('#vehicle_no').val(row.vehicle_no);
		$('#chasis_no').val(row.chasis_no);
		$('#engine_no').val(row.engine_no);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#variant_id').jqxNumberInput('val', row.variant_id);
		$('#color_id').jqxNumberInput('val', row.color_id);
		$('#party_id').jqxNumberInput('val', row.party_id);
		$('#date_time').jqxDateTimeInput('setDate', row.date_time);
		$('#billing_record_id').jqxNumberInput('val', row.billing_record_id);
		
		openPopupWindow('jqxPopupWindowCounter_sale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveCounter_saleRecord(){
	$('#jqxPopupWindowCounter_sale').block({ 
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

	var bill_part_datas = $('#materialCounterJqxgrid').jqxGrid('getrows');

	var bill_details = getFormData('form-counter_sales');
	var bill_summary = getFormData('counter_summary');


	$.ajax({
		type:       "POST",
		url: 		'<?php echo site_url("admin/counter_sales/save"); ?>',
		data:       {
			bill_details:bill_details,
			// bill_summary:bill_summary,
			bill_part_datas,
		},
		success:    function( result ){
			var result = eval('('+result+')');
			if (result.success) {
				// new_counter_sales();
				$('#jqxPopupWindowCounter_sale').unblock();
				$('#jqxPopupWindowCounter_sale').jqxWindow('close');
				// $('#jqxPopupWindowCounter').jqxWindow('close');
				$("#jqxGridCounter_sale").jqxGrid('refresh');
				$("#jqxGridCounter_sale").jqxGrid('updatebounddata');
			} else {
				alert(result.msg);
			}

		},
	});
	return;
}

function reset_form_counter_sales(){
	$('#counter_sales_id').val('');
	$('#form-counter_sales')[0].reset();
}

function new_counter_sales() {
	$('#counter_sales_id').val('');
	$('#form-counter_sales input[name=issue_date]').val('');
	// $('#counter_sales-credit_account').jqxComboBox('selectItem',invoice.credit_account);
	// invoice_no
	$('#form-counter_sales input[name=vehicle_no]').val('');
	$('#form-counter_sales input[name=engine_no]').val('');
	$('#form-counter_sales input[name=chassis_no]').val('');
	$('#form-counter_sales input[name=vehicle_id]').val('');
	$('#form-counter_sales input[name=variant_id]').val('');
	$('#form-counter_sales input[name=color_id]').val('');

	Part_form_table_counter.jqxGrid('updatebounddata');
	$('#counter_summary-total_for_parts').val('');
	calculate_counter_summary_percent();

	$('#jqxCounter_saleSubmitButton').show();
	$.post('<?php echo site_url('admin/counter_sales/get_billing_number/json'); ?>',function(invoice){
		$('#form-counter_sales input[name=invoice_no]').val(invoice);
	}, 'json' );

}
</script>










<script type="text/javascript">
	$(function(){

		$(".counter_sale-payment_type").jqxRadioButton({ width: 120, height: 25, groupName :"payment_type" });

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

		$(".jqxdatetimeinput").jqxDateTimeInput({ width: '250px', height: '34px', formatString: "yyyy-MM-dd HH:mm:ss" });

		$("#counter_confirm-popupWindow").jqxWindow({ width: 250, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#counter_confirm-cancel"), modalOpacity: 0.05 });

		$("#jqxPopupWindowPartCounter").jqxWindow({ 
			theme: 'dark',
			width: '50%',
			height: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.3,
			showCollapseButton: false 
		}); 

		var UserLedgersource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id' },
			{ name: 'full_name' }
			],
			url: '<?php echo site_url('job_cards/billing/user_list_json'); ?>',
			async: false
		};
		var UserLedgerdataAdapter = new $.jqx.dataAdapter(UserLedgersource);

		// Create a jqxDropDownList
		$("#counter_sale-credit_account").jqxComboBox({
			source: UserLedgerdataAdapter, 
			displayMember: "full_name", 
			valueMember: "id", 
			width: '100%', 
			height: '34px',
			// autoDropDownHeight: true
		});

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
				commit(true);
			},
		};
		var materialdataAdapter = new $.jqx.dataAdapter(materialSource);


		Part_form_table_counter = $("#materialCounterJqxgrid").jqxGrid(
		{
			width: '100%',
			height: '50%',
			source: materialdataAdapter,
			showtoolbar: true,
			showaggregates: true,
			showstatusbar: true,
			editable : true,
			rendertoolbar: function (toolbar) {
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append('<input id="counterpartsaddrowbutton" type="button" value="<?php echo lang('add_parts') ?>" />');
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
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true,editable : false, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="remove_Counter_material(' + index + '); return false;" title="Remove"><i class="fa fa-trash"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("part_id")?>', datafield: 'id', hidden:true },
			{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', editable : false, },
			{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '10%', editable : false, },
			{ 
				text: '<?php echo lang("price")?>', datafield: 'price', width: '10%', cellsalign: 'right', columntype: 'numberinput', editable : false,
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					if (newvalue != oldvalue) {
						var quantity = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "quantity");
						// var discount = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "discount");
						// if(isNaN(discount))
						// {
							// discount = 0;
						// }
						var total;

						total = newvalue * quantity;
						// total = total - ( (discount/100) * total );

						$("#materialCounterJqxgrid").jqxGrid('setcellvalue', row, "total", (total).toFixed(2));

					};
				}
			},
			{ 
				text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%', cellsalign: 'right', columntype: 'numberinput', 
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					if (newvalue != oldvalue) {
						var price = parseFloat($('#materialCounterJqxgrid').jqxGrid('getcellvalue', row, "price"));
						// var discount = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "discount");
						// if(isNaN(discount))
						{
							// discount = 0;
						}
						var total;

						total = price * newvalue;
						// total = total - ( (discount/100) * total );

						$("#materialCounterJqxgrid").jqxGrid('setcellvalue', row, "total", (total).toFixed(2));
					};
				}
			},
			// { 
			// 	text: '<?php echo lang("discount")?>', datafield: 'discount', width: '10%', cellsalign: 'right', columntype: 'numberinput',
			// 	cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
			// 		if (newvalue != oldvalue) {
			// 			var price = parseFloat($('#materialCounterJqxgrid').jqxGrid('getcellvalue', row, "price"));
			// 			var quantity = $("#materialCounterJqxgrid").jqxGrid('getcellvalue', row, "quantity");
			// 			var total;

			// 			total = price * quantity;
			// 			total = total - ( (newvalue/100) * total );

			// 			$("#materialCounterJqxgrid").jqxGrid('setcellvalue', row, "total", total);
			// 		};
			// 	}
			// },

			// { 
			// 	text: '<?php echo lang("warranty") ?>', datafield: 'warranty', width: '10%', filterable: true, columntype: 'dropdownlist',

			// 	createeditor: function (row, cellvalue, editor, cellText, width, height) {
			// 		editor.jqxDropDownList({
			// 			source: getwarrantyDataAdapter('warranty'), displayMember: 'warranty', valueMember: 'warranty', width: width, height: height, 
			// 			selectionRenderer: function () {
			// 				return "<span style='top:4px; position: relative;'>Please Choose:</span>";
			// 			}
			// 		});
			// 	},
			// 	initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
			// 		var items = editor.jqxDropDownList('getItems');
			// 		editor.jqxDropDownList('uncheckAll');
			// 		var values = cellvalue.split(/,\s*/);
			// 		for (var j = 0; j < values.length; j++) {
			// 			for (var i = 0; i < items.length; i++) {
			// 				if (items[i].label === values[j]) {
			// 				}
			// 			}
			// 		}
			// 	},
			// 	geteditorvalue: function (row, cellvalue, editor) {
			// 		return editor.val();
			// 	}
			// },

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
			// { text: '<?php echo ("discount_total")?>', datafield: 'discount_total', width: '10%' },
			// { text: '<?php echo lang("labour")?>', datafield: 'labour', width: '10%' },
			// { text: '<?php echo lang("discount_labour")?>', datafield: 'discount_labour', width: '10%' },
			]
		});

		//partCounterDataSource
		var partCounterDataSource = {
			url : '<?php echo site_url("admin/counter_sales/get_spareparts_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'sparepart_id', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'mrp_price', type: 'string' },
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
			width: '100%',
			height: 25,
			source: partCounterAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "part_name",
			valueMember: "sparepart_id",
			renderer: function (index, label, value) {
				var item = partCounterAdapter.records[index];
				if (item != null) {
					var label = item.part_name + "(" + item.part_name + ", " + item.part_name + ")";
					return label;
				}
				return "";
			},
			/*renderSelectedItem: function(index, item)
			{
				var item = partCounterAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";   
			},*/
			search: function (searchString) {
				partCounterAdapter.dataBind();
			}
		});

		$('#new_part_quantity_counter, #new_part_price_counter').on('change',function(){
			price       = parseInt($('#new_part_price_counter').val());
			quantity    = parseInt($('#new_part_quantity_counter').val());
			min_price   = parseInt($('#new_min_price_counter').val());
			var stock_quantity = $('#new_part_stock_quantity').val();

			// if((price) >= (min_price) && min_price != ''){
				total_price = price * quantity
				$('#new_part_total_counter').val(total_price);
			// }else{
			// 	alert('Minimum price is ' + min_price);
			// 	$('#new_part_price_counter').val(min_price);
			// }

			if(quantity > stock_quantity) {
				$('#new_part_quantity_counter').val(0);
				alert("Quantity out of stock");
			}

		});

		$('#jqxPopupWindowPartCounter').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ 
				input: '#new_part_id_counter', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_part_id_counter').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ 
				input: '#new_part_code_counter', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_part_code_counter').html();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ 
				input: '#new_part_price_counter', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_part_price_counter').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ 
				input: '#new_part_quantity_counter', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_part_quantity_counter').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			]
		});

		$('#part_to_table_counter').click(function(){

			$('#jqxPopupWindowPartCounter').block({ 
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

			var validationResult = function (isValid) {
				if (isValid) {
					var part_id = $('#new_part_id_counter').val();
					var part_name = $('#new_part_name_counter').val();
					var part_code = $('#new_part_code_counter').html();
					var part_price = $('#new_part_price_counter').val();
					var part_quantity = $('#new_part_quantity_counter').val();
					// var part_total = $('#new_part_total_counter').val();

					var datarow = {
						'part_id'       :part_id,
						'part_name'     :part_name,
						'part_code'     :part_code,
						'price'         :part_price,
						'quantity'      :part_quantity,
						'total'         :part_price * part_quantity,
					};

					Part_form_table_counter.jqxGrid('addrow', null, datarow);
					$('#jqxPopupWindowPartCounter').jqxGrid('addrow', null, datarow);
				}
				setTimeout(function(){ $('#jqxPopupWindowPartCounter').unblock(); }, 150);
			};
			$('#jqxPopupWindowPartCounter').jqxValidator('validate', validationResult);
		});

		$('#close_add_part_counter').click(function(){
			$('#jqxPopupWindowPartCounter').jqxWindow('close');
			$('#jqxPopupWindowPartCounter').unblock();
		});

		$('#new_part_id_counter').on('change', function(e){
			if(!e.args){
				return;
			}
			part_detail = e.args.item.originalItem;

			$('#new_part_code_counter').html(part_detail.part_code);
			$('#new_part_price_counter').val(part_detail.mrp_price);
			$('#new_part_quantity_counter').val(1);

			$('#new_part_name_counter').val(part_detail.name);
			$('#new_min_price_counter').val(part_detail.mrp_price);
			$('#new_part_stock_quantity').val(part_detail.quantity);


			$('#new_part_quantity_counter').change();
			return;
		});

	}); /*end function*/

	// get parts

	function remove_Counter_material( index ) {

		$("#counter_confirm-popupWindow").jqxWindow('show');
	}

	function calculate_counter_summary(summary_id, type = '' ) {
		var parts_amount = parseFloat($('#'+summary_id+'-total_for_parts').val());
		isNaN(parts_amount)? parts_amount = 0:'';

		var job_amount = parseFloat($('#'+summary_id+'-total_for_jobs').val());
		isNaN(job_amount)? job_amount = 0:'';

		var vat = parseFloat($('#'+summary_id+'-vat').val());
		isNaN(vat)? vat = 0:'';
		
		var net_total = parseFloat(parts_amount) + parseFloat(job_amount);

		if(type == 'percent') {
			var percent = parseFloat($('#'+summary_id+'-cash_discount_percent').val());
			isNaN(percent)? percent = 0:'';



			var cash_amount = net_total * (percent /100);
			$('#'+summary_id+'-cash_discount_amt').val(cash_amount)

		} else {
			var cash_amount = parseFloat($('#'+summary_id+'-cash_discount_amt').val()); /*cash discount amount*/
			isNaN(cash_amount)? cash_amount = 0:'';

			var percent = ( cash_amount /  net_total) * 100;

			$('#'+summary_id+'-cash_discount_percent').val(percent);
			// console.log(percent);
			// console.log(cash_amount);

		}

		process_summary(parts_amount, job_amount, vat, percent, cash_amount, summary_id);
	}

	function process_summary(parts_amount, job_amount, vat, percent, cash_amount, summary_id) {

		var vat_job = (job_amount * vat ) /100;                 /*add vat*/
		var vat_parts = (parts_amount * vat ) /100;               /*add vat*/

		parts_amount += vat_parts;
		job_amount += vat_job;

		parts_amount = parts_amount - ((parts_amount * percent) / 100);    /*discount cash percent*/
		job_amount = job_amount - ((job_amount * percent) / 100);      /*discount cash percent*/

		$('#'+summary_id+'-vat_parts').val(vat_parts);
		// $('#counter_summary input[name=vat_job]').val(vat_job);

		$('#'+summary_id+'-net_total').val(parts_amount + job_amount);

	}


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

		parts_amount = parts_amount - ((parts_amount * percent) / 100);    /*discount cash percent*/
		var vat_parts = (parts_amount * vat ) /100;               /*add vat*/
		job_amount = job_amount - ((job_amount * percent) / 100);      /*discount cash percent*/
		var vat_job = (job_amount * vat ) /100;                 /*add vat*/
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

		parts_amount = parts_amount - ((parts_amount * percent) / 100);    /*discount cash percent*/
		var vat_parts = (parts_amount * vat ) /100;               /*add vat*/
		job_amount = job_amount - ((job_amount * percent) / 100);      /*discount cash percent*/
		var vat_job = (job_amount * vat ) /100;                 /*add vat*/
		$('#counter_summary input[name=vat_parts]').val(vat_parts);
		$('#counter_summary input[name=vat_job]').val(vat_job);

		net_total = net_total + vat_parts + vat_job - d_amount;
		$('#counter_summary input[name=net_total]').val(net_total);
	}
</script>

<script type="text/javascript">
	$("#jqxPopupWindowRequestCounterParts").jqxWindow({ 
		theme: theme,
		width: '99%',
		maxWidth: '99%',
		height: '99%',  
		maxHeight: '99%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 1,
		showCollapseButton: false,
		cancelButton: $('#requestCounter_cancel')
	});
	
	function confirm_request( index ) {
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);

		$("#jqxGrid_requestparts_list").jqxGrid('clear');

		$.post('<?php echo site_url('admin/counter_sales/get_countersales'); ?>',{counter_sales_id: row.counter_sales_id},function(result){

			$.each(result.data, function(i,v){
				var datarow = {
					'id'					: v.ser_parts_id,
					'ser_parts_id'			: v.ser_parts_id,
					'part_id'				: v.part_id,
					'part_name'				: v.part_name,
					'part_code'				: v.part_code,
					'price'					: v.price,
					'quantity'				: v.quantity,
					'total'					: v.final_amount,
					'issue_date'			: v.issue_date,
					'warranty'				: v.warranty,
					'counter_request'		: v.counter_request,
					'accepted_quantity'		: v.accepted_quantity,
				};

				$("#jqxGrid_requestparts_list").jqxGrid('addrow', null, datarow);
			});

		},'JSON');

		$('#requestCounter_id').val(row.id);
		$('#requestCounter_countersalesid').val(row.counter_sales_id);
		openPopupWindow('jqxPopupWindowRequestCounterParts', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	}

	$(function() {

		/*var requestParts_datasource =
		{
			localdata: data = {},
			datatype: "local",
			datafields:
			[
			{ name: 'id', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'total', type: 'number' },
			{ name: 'warranty', type: 'string' },
			{ name: 'counter_request', type: 'string' },
			{ name: 'accepted_quantity', type: 'string' },
			{ name: 'issue_quantity', type: 'number' },
			{ name: 'quantity_to_bill', type: 'number' },
			],
			addrow: function (rowid, rowdata, position, commit) {
				commit(true);
			},
		};

		var requestParts_adapter = new $.jqx.dataAdapter(requestParts_datasource);*/


		$("#jqxGrid_requestparts_list").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			// source: requestParts_adapter,
			showtoolbar: true,
			showaggregates: true,
			showstatusbar: true,
			editable : true,

			altrows: true,
			pageable: true,
			sortable: true,
			showfilterrow: true,
			filterable: true,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			selectionmode: 'single',
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {

					var v = '';
					// var v = '<a href="javascript:void(0)" onclick="viewCounter_saleRecord(' + index + '); return false;" title="View"><i class="fa fa-eye"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + v + '</div>';
				}
			},
			// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("total"); ?>',datafield: 'total',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			// { text: '<?php echo lang("warranty"); ?>',datafield: 'warranty',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ 
				text: '<?php echo lang("availabeQty"); ?>',datafield: 'accepted_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: true, cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					var partdata = $("#jqxGrid_requestparts_list").jqxGrid('getrowdata',row);

					if (newvalue != oldvalue) {
						$.post("<?php echo site_url('admin/counter_sales/counter_request_json/new_quantity')?>", {partdata:partdata, newvalue:newvalue}, function(data){
							if(!data.success){
								// alert('Error occur. Try again.');
							}
						},'json');
					};
				}, validation: function( cell, value ) {
					var partdata = $("#jqxGrid_requestparts_list").jqxGrid('getrowdata',cell.row);

					if(!( !isNaN(parseFloat(value)) && isFinite(value))){
						return { result: false, message: "Invalid Number" };
					}

					if(value > partdata.quantity ) {
						return { result: false, message: "Cannot accept quantity greater than provided." };
					}
					if(value < 0 ) {
						return { result: false, message: "Cannot accept negative amount." };
					}
					return true;
				} 
			},
			{ 
				text: 'Available', datafield: 'counter_request', threestatecheckbox: false, columntype: 'checkbox', width: 70,
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					var partdata = $("#jqxGrid_requestparts_list").jqxGrid('getrowdata',row);

					if( partdata.accepted_quantity == null ){
						alert("Quantity field required");
						return false;
					}

					if (newvalue != oldvalue) {
						$.post("<?php echo site_url('admin/counter_sales/counter_request_json')?>", {partdata:partdata, newvalue:newvalue}, function(data){
							if(!data.success){
							// alert('Error occur. Try again.');
						}
					},'json');
					};
				}, 
			},

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("#jqxGrid_view_issuet_parts_list").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			// source: requestParts_adapter,
			// showtoolbar: true,
			showaggregates: true,
			showstatusbar: true,
			altrows: true,
			pageable: true,
			// sortable: true,
			// showfilterrow: true,
			// filterable: true,
			columnsresize: true,
			// autoshowfiltericon: true,
			columnsreorder: true,
			selectionmode: 'singlecell',
			editable: false, 
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("issued_qty"); ?>',datafield: 'issue_quantity',width: 100,filterable: true,renderer: gridColumnsRenderer, },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer, },
			{ text: '<?php echo lang("quantity_to_bill"); ?>',datafield: 'quantity_to_bill',width: 100,filterable: true,renderer: gridColumnsRenderer, },
			{ 
				text: '<?php echo lang("total"); ?>', datafield: 'total', width: 100, filterable: true, renderer: function(row) {

				} , editable: false, 
				aggregates: [{
					'<b>Total</b> ':	function (aggregatedValue, currentValue, column, record) {
						var total = currentValue;
						total = aggregatedValue + total;

						$('#counterIssue-total_for_parts').val(total);
						calculate_counter_summary('counterIssue');

						return total;
					}
				}], 
			},

			],
		});


		$('#requestCounter_submit').on('click', function(){
			var id = $('#requestCounter_id').val();
			var countersales_id = $('#requestCounter_countersalesid').val();
			$.post("<?php echo site_url('admin/counter_sales/counter_request_submit')?>", {id:id, countersales_id:countersales_id}, function(data){
				if(! data.success){
					alert("Not all Parts ready in Available to complete request.");
					return;
				}
				$('#jqxGridCounter_sale').jqxGrid('updatebounddata');
				$('#jqxPopupWindowRequestCounterParts').jqxWindow('close');
			},'json');
		});

		$('#viewCounter_submit').on('click', function() {
			var countersale_summary = getFormData('form-countersale_summary');

			$.ajax({
				type:       "POST",
				url: 		'<?php echo site_url("admin/counter_sales/save_bill_countersale"); ?>',
				data:       {
					countersale_summary,
				},
				success:    function( result ){
					var result = eval('('+result+')');
					if (result.success) {
						$('#jqxPopupWindowViewCounter_sale').jqxWindow('close');
						$('#jqxGridCounter_sale').jqxGrid('updatebounddata');
					} else {
						alert(result.msg);
					}

				},
			});
		});

		$('#viewCounter_print').on('click', function() {
			// id = $('#invoice_details input[name="job_no"]').val();
			var countersale_summary = getFormData('form-countersale_summary');
			// console.log(countersale_summary.id);
			// return false;


			var url = '<?php echo site_url('counter_sales/print_bill_countersale?id=') ?>' + countersale_summary.id;


			myWindow = window.open(url, 'Counter Sales', "height=900,width=1300");

			myWindow.document.close(); 

			myWindow.focus();
			myWindow.print();
		});


	});



</script>
<script type="text/javascript">

	$('#scan_code').on('keyup', function(event) {
		var val = $(this).val();
		if (val.length >= 5 && event.which == 13) {

			var counter_sales_id = $('#counter_bill_id').val();
			$.post("<?php echo site_url('admin/counter_sales/set_countersales_barcode')?>",{parts:val, counter_sales_id:counter_sales_id},function(data){
				if(data.success){
					console.log(data);
					//material_issue_no

					var datarow = {
						'part_id'		: data.part_id,
						'part_name'		: data.part_name,
						'part_code'		: data.part_code,
						'issue_date'	: data.issue_date,
						'quantity'		: data.quantity,
					};
					$('#jqxGrid_issueparts_list').jqxGrid('addrow', null, datarow);
					$('#error_scan').html('');
				} else{
					$('#error_scan').html(data.msg);
				}
			},'json');

			$('#scan_code').val('');
		}
	});
</script>
<script type="text/javascript">
	function view_issue_list(index) {
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
		if(row.is_countersale_billed == '1') {
			$('#viewissueCounter-create_bill').hide();
			$('#counterIssue-cash_discount_percent, #counterIssue-cash_discount_amt').prop('readonly', true);
			// $('#counterIssue-cash_discount_amt').prop('readonly', true);
		} else {
			$('#viewissueCounter-create_bill').show();
			$('#counterIssue-cash_discount_percent, #counterIssue-cash_discount_amt').prop('readonly', false);
		}

		$("#jqxGrid_view_issuet_parts_list").jqxGrid('clear');

		$.post('<?php echo site_url('admin/counter_sales/get_countersales'); ?>',{counter_sales_id: row.counter_sales_id},function(result){

			$.each(result.data, function(i,v){
				var datarow = {
					'ser_parts_id'			: v.ser_parts_id,
					'part_id'				: v.part_id,
					'part_name'				: v.part_name,
					'part_code'				: v.part_code,
					'price'					: v.price,
					'quantity'				: v.quantity,
					'total'					: v.final_amount,
					'issue_date'			: v.issue_date,
					'warranty'				: v.warranty,
					'counter_request'		: v.counter_request,
					'accepted_quantity'		: v.accepted_quantity,
					'quantity_to_bill'		: v.quantity_to_bill,
					'issue_quantity'		: v.issue_quantity,
				};

				$("#jqxGrid_view_issuet_parts_list").jqxGrid('addrow', null, datarow);
			});

		},'JSON');

		$('#counterIssue-id').val(row.counter_sales_id);
		$('#issueCountersales-countersales_no').val(row.counter_sales_id);
		$('#issueCountersales-countersales_no_display').text("CI-"+ (row.counter_sales_id).pad(5) );
		$('#issueCountersales-invoice_no').val(row.invoice_no);
		if( row.invoice_no){
			$('#issueCountersales-invoice_no_display').text("TI-"+ (row.invoice_no).pad(5));
		}
		openPopupWindow('jqxPopupWindowViewIssueCounter_sale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	}

	$(function(){

		$('#viewissueCounter-create_bill').on('click', function(){
			var data = getFormData('form-counterIssue');

			$.ajax({
				type: "POST",
				url: '<?php echo site_url("admin/counter_sales/create_bill_countersales"); ?>',
				data: {data},
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						$('#jqxPopupWindowViewIssueCounter_sale').jqxWindow('close');
					} else {
						alert(result.msg);	
					}
				}
			});
		});

	});

	function create_gatepass( index ) {
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
		$('#create_gatepass').val(row.counter_sales_id);
		openPopupWindow('window_gatepass', 'Gatepass');
	}

	$('#create_gatepass').on('click', function(){
		var counter_sales_id = $(this).val();
		var url = '<?php echo site_url('admin/counter_sales/create_gatepass?counter_sales_id=') ?>' + counter_sales_id;
		myWindow = window.open(url, null, "height=900,width=1300");
		myWindow.document.close(); 
		myWindow.focus();
		myWindow.print();

	});

</script>