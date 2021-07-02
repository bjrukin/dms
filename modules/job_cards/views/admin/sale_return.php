<style type="text/css">
.cls-outsidework {
	background-color: lightcyan;
}
.cls-job {
	/*background-color: lightgreen;*/
}
</style>
	<div id="jqxPopupWindowRemoveQuantity">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="">Remove Quantity</span>
	</div>

	<div>
		<div class="col-md-12">
			<form id="form-return">
				<input type="hidden" name="jobcard_group" id="return_jobcard_group">
				<input type="hidden" name="part_id" id="part_id">
				<input type="hidden" name="final_price" id="final_price">
				<input type="hidden" name="price" id="price">
				<input type="hidden" name="dealer_id" id="dealer_id">
				<input type="hidden" name="quantity" id="quantity">
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('part_name','part_name'); ?>
					</div>
					<div class="col-md-8">
						<input type="text" class="text_input" name="return_part_name" id="return_part_name" readonly="true">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('quantity','quantity'); ?>
					</div>
					<div class="col-md-3">
						<input type="number" id="return_quantity" name="return_quantity" class="text_input">
						
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('remarks','remarks'); ?>
					</div>
					<div class="col-md-3">
						<input type="text" id="return_remarks" name="return_remarks" class="text_area">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-primary" id="return-submit">Save</button>	
							<button type="button" class="btn btn-link" id="return-cancel">Close</button>	
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
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
										<!-- <button class="btn btn-default btn-flat " id="" onclick="printPreview('Invoice')">Print</button> -->
										<!-- <?php if( ! ($has_billed) ) : ?>
											<button class="btn btn-primary btn-flat " id="save_bill">Create BILL</button>
										<?php endif; ?> -->
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

	$('#close_bill').click(function(){
		window.close();
	});

	$('#return-cancel').click(function(){
		window.close();
	});

	$(function(){
$("#jqxPopupWindowRemoveQuantity").jqxWindow({ 
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '50%',  
			maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		$('#form-return').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ input: '#return_remarks', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#return_remarks').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#return_quantity', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#return_quantity').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#return_quantity', message: 'More than Available Quantity', action: 'blur', 
			rule: function(input) {
				val = parseInt($('#return_quantity').val());
				var dispatched = parseInt($('#quantity').val());
				return (val > dispatched) ? false: true;
			} },
			{ input: '#return_quantity', message: 'Can not be negative.', action: 'blur', 
			rule: function(input) {
				val = $('#return_quantity').val();
				return (val <= 0) ? false: true;
			} },

			]
		});

		$("#return-submit").on('click', function () {
				var validationResult = function (isValid) {
				if (isValid) {
					save_returnPart();
				}
			};
			$('#form-return').jqxValidator('validate', validationResult);
		

		});


});


// function reset_return_form()
// {
// 	$('#return-quantity').val('');
// }
</script>
<script type="text/javascript">
	
function save_returnPart()
	{


			var jobcard_group = $('#return_jobcard_group').val();
			var part_id = $('#part_id').val();
			var final_price = $('#final_price').val();
			var price = $('#price').val();
			var dealer_id = $('#dealer_id').val();
			var return_quantity = $('#return_quantity').val();
			var return_remarks = $('#return_remarks').val();
			var return_part_name = $('#return_part_name').val();
			var quantity = $('#quantity').val();
			$.post('<?php echo site_url('job_cards/job_card_detail/confirm_sale_return'); ?>',{ jobcard_group:jobcard_group, final_price: final_price, part_id: part_id, return_quantity: return_quantity, price: price, return_remarks: return_remarks, return_part_name: return_part_name, quantity: quantity,dealer_id: dealer_id} ,function(result){

				if( ! result.success ) {
					alert("Error");
				}
				
				cal_cash_discount_bill_percent();
				$('#jqxPopupWindowRemoveQuantity').jqxWindow('close');
				$("#jqxGridPartBill").jqxGrid('updatebounddata');

			},'json');

}
</script>

<script type="text/javascript">
	var ALLOWED_DISCOUNT = 10;
	$('#close_bill').click(function(){
		window.close();
	});


</script>

<script type="text/javascript">

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
		{ name: 'dealer_id', type: 'number'},
		{ name: 'quantity', type: 'number'},
		{ name: 'discount_percentage', type: 'number'},
		{ name: 'final_amount', type: 'number'},
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
		{
			text: 'Action', width: '5%', pinned: true, exportable: false, editable : false, cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, filterable: false, cellsrenderer: function(index,b,c,d,e,rows) {
				// console.log(rows.quantity);
				var button = '';
				// console.log(quantity);
				if(rows.quantity > 0)
				{
						button += '<a href="javascript:void(0)" class="" onclick="return_part('+ index +')"  title="Return Parts"><i class="fa fa-reply"> </i></a>';
				}
				
				return '<div style="text-align: left; margin-top: 8px; padding: 0px 5px;">' + button +'</div>';
			}, cellclassname:'jqx-widget-header'
		},

		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',/*width: '10%',*/filterable: true,renderer: gridColumnsRenderer,editable:false,},
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',/*width: '15%',*/filterable: true,renderer: gridColumnsRenderer, editable:false, },
		{ text: '<?php echo lang("warranty"); ?>', datafield: 'warranty', width: '5%', filterable: true, renderer: gridColumnsRenderer, columntype: 'string', editable: false, },
		{ 
			text: '<?php echo lang("price"); ?>',datafield: 'price',width: '10%',filterable: true,renderer: gridColumnsRenderer,cellsformat: 'f2', cellsalign: 'right',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var quantity = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "quantity");;
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
			text: '<?php echo lang("quantity"); ?>', datafield: 'quantity', width: '10%', filterable: true, renderer: gridColumnsRenderer, cellclassname: 'cellclassrenderer', editable: false,  cellsalign: 'right',
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
					var quantity = $("#jqxGridPartBill").jqxGrid('getcellvalue', row, "quantity");;
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
			text: '<?php echo lang("final_amount"); ?>', datafield: 'final_amount', width: '10%', filterable: true, renderer: gridColumnsRenderer, cellclassname: cellclassrenderer, editable: false, cellsalign: 'right',cellsformat: 'f2',
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
					$('#jqxGridPartBill').jqxGrid('setcellvalue', i, "final_price", '0');
				}

				// $('#jqxGridPartBill').jqxGrid('setcellvalue', i, "final_price", v.price * v.quantity);

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

	function return_part(index) 
	{
		var row = $("#jqxGridPartBill").jqxGrid('getrowdata',index);
		console.log(row);
		$('#return_jobcard_group').val(row.jobcard_group);
		$('#part_id').val(row.part_id);
		$('#quantity').val(row.quantity);
		$('#dealer_id').val(row.dealer_id);
		$('#final_price').val(row.final_price);
		$('#price').val(row.price);
		$('#return_remarks').val('');
		$('#return_quantity').val('');
		$('#return_part_name').val(row.part_name);
		openPopupWindow('jqxPopupWindowRemoveQuantity');
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
</script>