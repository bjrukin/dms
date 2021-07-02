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
						<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCounter_saleInsert"><?php echo lang('general_create'); ?></button>
					<?php endif;?>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCounter_saleFilterClear"><?php echo lang('general_clear'); ?></button>
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
		<input type="hidden" name="id" id="id"/>
		<input type="hidden" name="counter_sales_id" id="counter_sales_id"/>

		<div class="row">
			<div class="col-md-6">
				<div class="row form-group"> 
					<div class="col-md-2"> Date/Time</div>
					<div class="col-md-10"> <div id='' class="jqxdatetimeinput" name=issue_date></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"> Customer Name  <br><a href="<?php echo site_url('user_ledgers'); ?>" target="_blank">Create New</a></div>
					<div class="col-md-10">  <div id='counter_sale-credit_account' name="credit_account"></div> </div>
				</div>
				<?php //if(is_group(CG_SPAREPART_OUTLET)){?>
				<div class="row form-group">
					<div class="col-md-2"> Select Price Option  <br></div>
					<div class="col-md-10" id='price_option'>  
						<input type="radio" name="price_option" id="normal_price_option" class="adviced_price_option" value='price' checked> MRP 
						<input type="radio" name="price_option" id="dealer_price_option" class="adviced_price_option" value='dealer_price'> Dealer Price 
					</div>
				</div>
				<div class="row form-group" hidden id="vro_div">
					<div class="col-md-2"> VRO</div>
					<div class="col-md-10"><div id='vro' class='number_general' name='vro'></div></div>
				</div>
			<?php //}?>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">CounterSales No. :  </div><div class="col-md-12">
						<div id="issueCountersales-countersales_no_display" class="form-control" readonly></div>
						<input type="hidden" id="issueCountersales-countersales_no" name="countersale_no" class="form-control" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">Invoice No. : </div><div class="col-md-12">
						<div id="issueCountersales-invoice_no_display" class="form-control" readonly></div>
						<input type="hidden" id="issueCountersales-invoice_no" name="issueCountersaeIssueNo" class="form-control" readonly>
					</div>
				</div>
			</div>

		</div>
		<!-- ############################## for material grid ############################## -->
		<div>Material</div>
		<div id="materialCounterJqxgrid"></div>
		<!-- ############################## end of material grid ############################## -->

		<div class="row">
			<div class="col-md-offset-6 col-md-6">

				
				<fieldset>
					<legend>Summary</legend>

					<div class="row">
						<div class="col-md-8">Total</div>
						<div class="col-md-4" id="mrp_total"><input id="counterIssue-total_for_parts" name="total_for_parts" class="form-control input-sm" readonly></div>
						<div class="col-md-4" id="dealer_total" hidden><input id="counterIssue-dealer_total_for_parts" name="dealer_total_for_parts" class="form-control input-sm" readonly></div>
					</div>
					<div class="row">
						<div class="col-md-5">Cash Dis.</div> <!-- total_discount_bill_cash -->
						<div class="col-md-3">
							<input type="number" id="counterIssue-cash_discount_percent" name="cash_discount_percent" class="form-control input-sm" step="1" onchange="calculate_counter_summary('counterIssue', 'percent')">
						</div>
						<div class="col-md-4">
							<input type="number" id="counterIssue-cash_discount_amt" name="cash_discount_amt" onchange="calculate_counter_summary('counterIssue')" class="form-control input-sm">
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
			</div>
		</div>

		<?php echo form_close(); ?>

		<div class="btn-group btn-group-sm pull-right">
			<button type="button" class="btn btn-success btn-flat" id="jqxCounter_saleSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-primary btn-flat" id="viewissueCounter-print_bill">Print Bill</button>
			<button type="button" class="btn btn-link btn-flat" id="jqxCounter_saleCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>
	</div>
</div> <!-- end jqxPopupWindowCounter_sale -->

<div id="jqxPopupWindowPartCounter">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Add Part</span>
	</div>
	<div class="form_fields_area">
		<form id="form-add_part">
			<div class="col-md-12">
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('part_name')?></label></div>
					<div class="col-md-8"><div id="add_part_name" class="" name="part_code" ></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('quantity')?></label></div>
					<div class="col-md-3"><input type="number" class="form-control" id="add_part_quantity" name ="quantity" min=0></div>
				</div>
				<div class="row form-group">
					<div class="col-md-12" hidden id="stock-error" style="color:red;">
						
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group btn-group-sm pull-right">
							<button type="button" class="btn btn-primary btn-flat" id="add_part_submit">Add</button>
							<button type="button" class="btn btn-link btn-flat" id="add_part_close"><?php echo lang('general_cancel')?></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="jqxPopupWindowIssueCounter_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Material Scan</span>
	</div>
	<div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2">
					<label>Material Issue: </label>
					<div id="material_issue_no" class="form-control" readonly> </div>
				</div>
				<div class="col-md-4">
					<label>Barcode: </label><input type="text" id="scan_code" class="form-control">
					<span id="error_scan"></span>
				</div>
				<input type="hidden" name="" id="countersales_id">
			</div>
			<br>
			<div class="row">
				<div class="col-md-8">
					<div id="jqxGrid_issueparts_list"></div>
				</div>
				<div class="col-md-4">
					<div id="jqxGrid_requested_parts"></div>
				</div>
			</div>
		</div>
		<!-- <input type="hidden" name="id" id="requestCounter_id"> -->
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<br>
				<button type="button" class="btn btn-primary btn-flat btn-sm" id="issueCounter-closeCounterSales">Close CounterSales</button>
				<button type="button" class="btn btn-default btn-flat btn-sm" id="issueCounter-close">Close</button>
			</div>
		</div>
	</div>
</div>


<div id="jqxPopupWindowViewIssueCounter_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_counter">Counter Sales</span>
	</div>
	<div>
		<div class="col-md-12">
			<form id="form-counterIssue">
				<input type="hidden" name="counter_sales_id" id="counterIssue-id" value="">
				<div class="row">
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>CounterSales</label>
						<div id="jqxGrid_view_issuet_parts_list"></div>
					</div>
				</div>
				<!-- <input type="hidden" name="id" id="requestCounter_id"> -->
				
			</form>
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

<div id="window_gatepass">
	<div>Gatepass</div>
	<div>
		<div class="btn-group">
			<button id="create_gatepass" class="btn btn-primary btn-sm">Create Gatepass</button>
			<button id="cancel_gatepass" class="btn btn-default btn-sm">Cancel</button>
		</div>
	</div>
</div>

<style type="text/css">
.bgcolor-new_request {
	background-color: lightcyan;
}
</style>
<script language="javascript" type="text/javascript">
	var advice_material_url = '<?php echo site_url("admin/counter_sales/get_advice_material_aro/price"); ?>';
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
			{ name: 'price_option', type: 'string' },
			{ name: 'vro', type: 'number' },

			],
			url: '<?php echo site_url("admin/counter_sales/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				counter_salesDataSource.totalrecords = data.total;
			},
			filter: function () {
				$("#jqxGridCounter_sale").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#jqxGridCounter_sale").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		var cellclassrenderer = function(row, column,value,data) {
			if(data.is_request_complete == null){
				return 'bgcolor-new_request';
			}
			return '';
		}

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
				text: 'Action', datafield: 'action', width: "10%", sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index,b,c,d,e,rows) {
					var view = cr = mi = bill = gate = returnvalue = '' ;

					edit = ' | <a href="javascript:void(0)" onclick="editCounter_saleRecord(' + index + '); return false;" title="Edit CounterSales"><i class="fa fa-edit"></i></a>';
					
					// view = ' | <a href="javascript:void(0)" onclick="viewCounter_saleRecord(' + index + '); return false;" title="View CounterSales"><i class="fa fa-eye"></i></a>';
					// cr = ' | <a href="javascript:void(0)" onclick="confirm_request(' + index + '); return false;" title="Confirm Response"><i class="fa fa-hand-o-up"></i></a>';
					mi = ' | <a href="javascript:void(0)" onclick="issueCounter_sale(' + index + '); return false;" title="Material Issue"><i class="fa fa-list"></i></a>';
					// bill = ' | <a href="javascript:void(0)" onclick="create_invoice(' + index + '); return false;" title="Invoice"><i class="fa fa-book"></i></a>';
					gate = ' | <a href="javascript:void(0)" onclick="create_gatepass(' + index + '); return false;" title="Gatepass"><i class="fa fa-ticket"></i></a>';

					<?php //if( is_accountant() ): ?>
					returnvalue += view;
					<?php //endif; ?>


					<?php // if(is_material_issuer()): ?>
					if(rows.is_request_complete != 1 ) {
						returnvalue += cr + mi;
					}

					/*if(rows.is_countersale_closed == 1 && rows.is_countersale_billed != 1) {
						returnvalue += mi;
					}*/
					<?php //endif; ?>

					<?php //if( is_accountant() ): ?>
					// if(rows.is_countersale_closed == 1) {
						// returnvalue += bill;
					// }
					if(rows.is_countersale_billed == 1) {
						returnvalue += gate;
					}
					<?php //endif; ?>

					return '<div style="text-align: center; margin-top: 8px;">'+edit + returnvalue + '</div>';
				}
			},
			{ text: '<?php echo lang("date_time"); ?>',datafield: 'date_time',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer, },
			{ text: '<?php echo lang("counter_sales_id"); ?>',datafield: 'counter_sales_id',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer, cellsrenderer: function(a,b,value,d,e,row) {
				return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">CS-'+(value).pad(5)+'</div>';
			} },
			{ text: '<?php echo lang("party_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer, },
			{ text: '<?php echo lang("is_request_complete"); ?>',datafield: 'is_request_complete',width: 80,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox', editable: false, cellclassname: cellclassrenderer, },

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$(document).on('click','#jqxGridCounter_saleInsert', function () { 
			// Part_form_table_counter.jqxGrid('clear');
			reset_form_counter_sales();
			$('#viewissueCounter-print_bill').hide();
			$('#jqxCounter_saleSubmitButton').show();

			openPopupWindow('jqxPopupWindowCounter_sale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		$(document).on('click','#jqxGridCounter_saleFilterClear', function () { 
			$('#jqxGridCounter_sale').jqxGrid('clearfilters');
		});

		$("#jqxCounter_saleCancelButton").on('click', function () {
			reset_form_counter_sales();
			$('#jqxPopupWindowCounter_sale').jqxWindow('close');
		});

		$("#jqxPopupWindowCounter_sale").jqxWindow({ 
			theme: theme,
			width: '99%',
			maxWidth: '99%',
			height: '99%',  
			maxHeight: '99%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 1,
			showCollapseButton: false ,
			// cancelButton: $('#jqxCounter_saleCancelButton')
		});

		$("#jqxPopupWindowIssueCounter_sale").jqxWindow({ 
			theme: theme, 
			width: '100%',
			maxWidth: '100%',
			height: '99%', 
			maxHeight: '99%', 
			resizable: false, 
			isModal: true, 
			autoOpen: false, 
			modalOpacity: 0.4 ,
			cancelButton: $('#issueCounter-close')
		});

		$("#jqxPopupWindowViewIssueCounter_sale").jqxWindow({ 
			theme: theme, 
			width: '100%',
			maxWidth: '100%',
			height: '99%', 
			maxHeight: '99%', 
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

		$(".jqxdatetimeinput").jqxDateTimeInput({ width: '250px', height: '34px', formatString: "yyyy-MM-dd HH:mm:ss" });

		var partyDataSource = {
			url : '<?php echo site_url("admin/counter_sales/get_user_list_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'full_name', type: 'string' },
			{ name: 'party_name', type: 'string' },
			],
		}

		partyDataAdapter = new $.jqx.dataAdapter(partyDataSource, {
			formatData: function (data) {
				if ($("#counter_sale-credit_account").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#counter_sale-credit_account").jqxComboBox('searchString');
					return data;
				}
			}
		});

		$("#counter_sale-credit_account").jqxComboBox({
			width: '100%',
			height: 25,
			source: partyDataAdapter,
			minLength: 3,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "party_name",
			valueMember: "id",
			/*renderer: function (index, label, value) {
				var item = partyDataAdapter.records[index];
				if (item != null) {
					var label = item.party_name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = partyDataAdapter.records[index];
				if (item != null) {
					var label = item.party_name;
					return label;
				}
				return "";   
			},*/
			search: function (searchString) {
				partyDataAdapter.dataBind();
			}
		});


		CounterSalesRequest = $("#materialCounterJqxgrid").jqxGrid(
		{
			width: '100%',
			height: '50%',
			// source: materialdataAdapter,
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
			{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', editable : false, },
			{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', editable : false, },
			{ text: '<?php echo lang("price")?>', datafield: 'price', editable : false, },
			{ text: '<?php echo lang("dealer_price")?>', datafield: 'dealer_price', editable : false, hidden:true },
			{ 
				text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%', cellsalign: 'right', columntype: 'numberinput', 
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					if (newvalue != oldvalue) {
						var price = parseFloat(CounterSalesRequest.jqxGrid('getcellvalue', row, "price"));
					};
				}
			},
			{ 
				text: '<?php echo lang("total")?>', datafield: 'total', editable : false,aggregates: ['sum'],
					cellsrenderer: function (index) {
						var vor = parseFloat($('#materialCounterJqxgrid').val() || 0);
						var rows = $("#materialCounterJqxgrid").jqxGrid('getrowdata', index);
						var e = (rows.price * rows.quantity);
						// return '<div style="text-align: right; margin-top: 8px;">' + e + '</div>';
						return '<div class="jqx-grid-cell-right-align" style="margin-top: 4px;">' + e + '</div>';
					},
					aggregates: [{ 'Total':
		                function (aggregatedValue, currentValue, column, record) {
		                	var price = parseFloat((record.hasOwnProperty("price"))?record.price:0);
		                  	var quantity = parseFloat((record.hasOwnProperty("quantity"))?record.quantity:0);

		                  	var row_total = (isNaN(price)?0:price) * (isNaN(quantity)?0:quantity);
		                  	var total = parseFloat(row_total);
		                  	var g_total = aggregatedValue + total;
		                  	$('#counterIssue-total_for_parts').val(g_total);
		                  	calculate_counter_summary('counterIssue', 'percent')
		                  	return g_total;
		                }

	            	}] ,
				},
			{ 
				text: '<?php echo lang("total")?>', datafield: 'dealer_price_total', editable : false,aggregates: ['sum'], hidden:true,
					cellsrenderer: function (index) {
						var vor = parseFloat($('#materialCounterJqxgrid').val() || 0);
						var rows = $("#materialCounterJqxgrid").jqxGrid('getrowdata', index);
						var e = (rows.dealer_price * rows.quantity);
						// return '<div style="text-align: right; margin-top: 8px;">' + e + '</div>';
						return '<div class="jqx-grid-cell-right-align" style="margin-top: 4px;">' + e + '</div>';
					},
					aggregates: [{ 'Total':
		                function (aggregatedValue, currentValue, column, record) {
		                	var dealer_price = parseFloat((record.hasOwnProperty("dealer_price"))?record.dealer_price:0);
		                  	var quantity = parseFloat((record.hasOwnProperty("quantity"))?record.quantity:0);

		                  	var row_total = (isNaN(dealer_price)?0:dealer_price) * (isNaN(quantity)?0:quantity);
		                  	var total = parseFloat(row_total);
		                  	var g_total = aggregatedValue + total;
		                  	$('#counterIssue-dealer_total_for_parts').val(g_total);
		                  	calculate_counter_summary('counterIssue', 'percent')
		                  	return g_total;
		                }

	            	}] ,
				},

			]
		});

		$("#jqxPopupWindowPartCounter").jqxWindow({ 
			theme: theme,
			width: '50%',
			height: '250px',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.3,
			showCollapseButton: false,
			cancelButton: $('#add_part_close'),
		}); 
		var advicePartSource = {
			url : advice_material_url,
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
			{ name: 'price', type: 'number' },
			{ name: 'total', type: 'number' },
			{ name: 'dealer_price', type: 'number' },
			{ name: 'dealer_price_total', type: 'number' },
			],
		}

		advicePartAdapter = new $.jqx.dataAdapter(advicePartSource,
		{
			formatData: function (data) {
				if ($("#add_part_name").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#add_part_name").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#add_part_name").jqxComboBox({
			width: '100%',
			height: 25,
			source: advicePartAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "name",
			valueMember: "part_code",
			renderer: function (index, label, value) {
				var item = advicePartAdapter.records[index];
				if (item != null) {
					var label = item.name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = advicePartAdapter.records[index];
				if (item != null) {
					var label = item.name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				advicePartAdapter.dataBind();
			}
		});

		$('#add_part_submit').click(function(){

			var validationResult = function (isValid) {
				if (isValid) {

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

					var form = getFormData('form-add_part');
					selected_data = $("#add_part_name").jqxComboBox('getSelectedItem'); 
					form.price = selected_data.originalItem.price;
					form.part_name = selected_data.label;
					form.total = form.price * form.quantity;
					form.quantity = parseInt(form.quantity);
					form.dealer_price = selected_data.originalItem.dealer_price;
					form.dealer_price_total = form.dealer_price * form.quantity;

					CounterSalesRequest.jqxGrid('addrow', null, form);

					setTimeout(function(){ $('#jqxPopupWindowPartCounter').unblock(); }, 150);

					$('#add_part_quantity').val('');
					$('#add_part_name').val('');

				}
			};
			$('#jqxPopupWindowPartCounter').jqxValidator('validate', validationResult);
		});

		$('#jqxPopupWindowPartCounter').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [		
			{ 
				input: '#add_part_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#add_part_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ 
				input: '#add_part_quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#add_part_quantity').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ 
				input: '#add_part_quantity', message: 'Can not be negative.', action: 'blur', 
				rule: function(input) {
					val = $('#add_part_quantity').val();
					return (val < 0) ? false: true;
				}
			},
			]
		});


		$("#jqxCounter_saleSubmitButton").on('click', function () {

			var validationResult = function (isValid) {
				if (isValid) {
					saveCounter_saleRecord();
				}
			};
			$('#form-counter_sales').jqxValidator('validate', validationResult);

		});

		$('#form-counter_sales').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ 
				input: '#materialCounterJqxgrid', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#materialCounterJqxgrid').jqxGrid('getrows');
					return (val.length > 0) ? true: false;
				}
			},

			]
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
			rendertoolbar: function (toolbar) {
				var container = $("<div style='margin: 5px; height:50px'></div>");
				container.append('<button class="btn btn-xs btn-flat btn-default" onclick="$(\'#jqxGrid_issueparts_list\').jqxGrid(\'updatebounddata\')">Refresh</button>');
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang('quantity') ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: true },
			{ text: '<?php echo lang('issue_date') ?>',datafield: 'issue_date',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			],
		});

		$("#jqxGrid_requested_parts").jqxGrid({
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
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang('quantity') ?>',datafield: 'quantity',width: 50,filterable: true,renderer: gridColumnsRenderer, editable: false },
			],
		});

		$('#scan_code').on('keyup', function(event) {
			var val = $(this).val();
			if (val.length >= 5 && event.which == 13) {

				var counter_sales_id = $('#countersales_id').val();
				$.post("<?php echo site_url('admin/counter_sales/set_countersales_barcode')?>",{parts:val, counter_sales_id:counter_sales_id},function(data){
					if(data.success){
						// console.log(data);
						// material_issue_no

						/*var datarow = {
							'part_id'		: data.part_id,
							'part_name'		: data.part_name,
							'part_code'		: data.part_code,
							'issue_date'	: data.issue_date,
							'quantity'		: data.quantity,
						};
						$('#jqxGrid_issueparts_list').jqxGrid('addrow', null, datarow);*/
						$("#jqxGrid_issueparts_list").jqxGrid('updatebounddata');
						$('#error_scan').html('');
					} else{
						$('#error_scan').html(data.msg);
					}
				},'json');

				$('#scan_code').val('');
			}
		});

		$('#issueCounter-closeCounterSales').on('click', function(e){
			var counter_sales_id = $('#countersales_id').val();

			var issuedParts = $('#jqxGrid_issueparts_list').jqxGrid('getrows');
			if( issuedParts.length <= 0 ) {
				alert("Nothing issued.");
				return false;
			}

			$.post("<?php echo site_url('admin/counter_sales/save_bill_countersale')?>",{ counter_sales_id:counter_sales_id,issuedParts:issuedParts},function(data){
				$('#jqxGrid_issueparts_list').jqxGrid('clear');
				$('#jqxPopupWindowIssueCounter_sale').jqxWindow('close');
				$('#jqxPopupWindowIssueCounter_sale').jqxWindow('close');
				$('#jqxGridCounter_sale').jqxGrid('refresh');

			},'json');
		});


		$("#jqxGrid_view_issuet_parts_list").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			showaggregates: true,
			showstatusbar: true,
			altrows: true,
			pageable: true,
			sortable: true,
			showfilterrow: true,
			filterable: true,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			selectionmode: 'singlecell',
			editable: true, 
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
			{ text: '<?php echo lang("issued_qty"); ?>',datafield: 'quantity',width: 100,filterable: true,renderer: gridColumnsRenderer,editable: false  },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer,editable: false  },
			{ text: '<?php echo lang("discount"); ?>',datafield: 'discount',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'number' },
			// { text: '<?php echo lang("quantity_to_bill"); ?>',datafield: 'quantity_to_bill',width: 100,filterable: true,renderer: gridColumnsRenderer, },
			{ 
				text: '<?php echo lang("total"); ?>', datafield: 'total', width: 100, filterable: true, renderer: function(row) {

				} , editable: false, 
				aggregates: [{
					'<b>Total</b> ':	function (aggregatedValue, currentValue, column, record) {
						var total = currentValue;
						total = aggregatedValue + total;

						
						calculate_counter_summary('counterIssue');

						return total;
					}
				}], 
			},

			],
		});

		$('#viewissueCounter-print_bill').on('click', function(){
			// var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
			var data = getFormData('form-counter_sales');
			// var data = getFormData('form-counterIssue');
			// console.log(data);
			// var counter_sale_id = data.counter_sales_id;
			var counter_sale_id = data.id;
			var counter_sale_no = data.countersale_no;
		 	// window.open(base_url+"counter_sales/invoice?counter_sale_id="+counter_sale_id+"&counter_sales_no="+counter_sale_no,'_black');

		 	var url = base_url+"counter_sales/invoice/1?counter_sale_id="+counter_sale_id+"&counter_sales_no="+counter_sale_no;


			myWindow = window.open(url, 'counter', "height=900,width=1300");

			myWindow.document.close(); 

			myWindow.focus();
			myWindow.print();

		 // 	myWindow = window.open(base_url+"counter_sales/invoice?counter_sale_id="+counter_sale_id+"&counter_sales_no="+counter_sale_no, 'counter', "height=900,width=1300");

			// myWindow.document.close(); 

			// myWindow.focus();
			// myWindow.print();

		});


		$('#viewissueCounter-create_bill').on('click', function(){
			var data = getFormData('form-counterIssue');
			var parts = $('#jqxGrid_view_issuet_parts_list').jqxGrid('getrows');

			$.ajax({
				type: "POST",
				url: '<?php echo site_url("admin/counter_sales/create_bill_countersales"); ?>',
				data: { data, parts },
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						$('#jqxPopupWindowViewIssueCounter_sale').jqxWindow('close');
						$('#jqxGridCounter_sale').jqxGrid('refresh');

					} else {
						alert(result.msg);	
					}
				}
			});
		});

		$('#create_gatepass').on('click', function(){
			var counter_sales_id = $(this).val();
			var url = '<?php echo site_url('admin/counter_sales/create_gatepass?counter_sales_id=') ?>' + counter_sales_id;
			myWindow = window.open(url, null, "height=900,width=1300");
			myWindow.document.close(); 
			myWindow.focus();
			myWindow.print();

		});

		$('#jqxGrid_issueparts_list').on('cellvaluechanged', function (event) {
			var rowBoundIndex = event.args.rowindex;
			var rowdata = $('#jqxGrid_issueparts_list').jqxGrid('getrowdata', rowBoundIndex);
			console.log(rowdata);

			$.post('<?php echo site_url('admin/counter_sales/update_dispatch_quantity') ?>',{id : rowdata.uid, quantity:rowdata.quantity},function(result)
			{
				if(result.success)
				{
					// alert('Successfully Updated');
				}else{
					alert(result.msg);
					$("#jqxGrid_issueparts_list").jqxGrid('setcellvalue', rowBoundIndex, "quantity", result.previous_quantity);
				}

			},'json');

		});

	});
</script>


<script type="text/javascript">

	function editCounter_saleRecord(index){
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
		console.log(row);
		if (row) {
			$('#id').val(row.id);
			$('#counter_sales_id').val(row.counter_sales_id);
			$('#counter_sale-credit_account').jqxComboBox('addItem',{ label: row.full_name, value: row.party_id});
			$('#counter_sale-credit_account').jqxComboBox('val', row.party_id);
			<?php if(is_group(CG_SPAREPART_OUTLET)){?>
				$('#vro').jqxComboBox('val', row.vro);
			<?php }?>
			$('#issueCountersales-countersales_no').val(row.counter_sales_id);
			$('#issueCountersales-countersales_no_display').text("CI-"+ (row.counter_sales_id).pad(5) );
			<?php if(is_group(CG_SPAREPART_OUTLET)){?>
				$('#vro').val(row.vro);
			<?php }?>

			if(row.is_countersale_billed == null) {
				$('#viewissueCounter-create_bill').show();
				$('#viewissueCounter-print_bill').hide();
			} else {
				$('#issueCountersales-invoice_no').val(row.invoice_no);
				$('#issueCountersales-invoice_no_display').text("TI-"+ (row.invoice_no).pad(5) );
			}

			var materialSource =
			{
				datatype: "json",
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
				{ name: 'countersale_request_id', type: 'string' },
				{ name: 'dealer_price', type: 'number' },
				{ name: 'dealer_price_total', type: 'number' },
				{ name: 'price_option', type: 'string' },
				],
				url: '<?php echo site_url('admin/counter_sales/get_countersales_billed'); ?>',
				data: {counter_sales_id: row.counter_sales_id},
			};
			var materialdataAdapter = new $.jqx.dataAdapter(materialSource);
			CounterSalesRequest.jqxGrid({source: materialdataAdapter});

			if(row.is_countersale_billed){
				$('#viewissueCounter-print_bill').show();
				$('#jqxCounter_saleSubmitButton').hide();
			}else{
				$('#viewissueCounter-print_bill').hide();
				$('#jqxCounter_saleSubmitButton').show();
			}

			openPopupWindow('jqxPopupWindowCounter_sale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
			if(row.price_option == 'dealer_price'){
				$("#dealer_price_option").prop("checked", true);
				$('#mrp_total').hide();
				$('#dealer_total').show();
				<?php if(is_group(CG_SPAREPART_OUTLET)){?>
					$('#vro_div').show();
				<?php }?>
				CounterSalesRequest.jqxGrid('hidecolumn', 'price');
				CounterSalesRequest.jqxGrid('showcolumn', 'dealer_price');
				CounterSalesRequest.jqxGrid('hidecolumn', 'total');
				CounterSalesRequest.jqxGrid('showcolumn', 'dealer_price_total');
			}else{
				$("#normal_price_option").prop("checked", true);
				CounterSalesRequest.jqxGrid('showcolumn', 'price');
				CounterSalesRequest.jqxGrid('hidecolumn', 'dealer_price');
				CounterSalesRequest.jqxGrid('showcolumn', 'total');
				CounterSalesRequest.jqxGrid('hidecolumn', 'dealer_price_total');
				$('#mrp_total').show();
				$('#dealer_total').hide();
				<?php if(is_group(CG_SPAREPART_OUTLET)){?>
					$('#vro_div').hide();
				<?php }?>
			}
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

		var countersales_request = getFormData('form-counter_sales');
		var countersales_parts = CounterSalesRequest.jqxGrid('getrows');

		$.ajax({
			type:       "POST",
			url: 		'<?php echo site_url("admin/counter_sales/aro_save"); ?>',
			data:       {
				countersales_request,
				countersales_parts,
			},
			success:    function( result ){
				var result = eval('('+result+')');
				if (result.success) {
					$('#jqxPopupWindowCounter_sale').unblock();
					$('#jqxPopupWindowCounter_sale').jqxWindow('close');
					$("#jqxGridCounter_sale").jqxGrid('refresh');
					$("#jqxGridCounter_sale").jqxGrid('updatebounddata');
				} else {
					alert(result.msg);
				}

			},
		});
		return;
	}

	function issueCounter_sale(index) {
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
		$('#jqxGrid_issueparts_list').jqxGrid('clear');
		$('#countersales_id').val(row.counter_sales_id);
		if (row) {
			// $('#issueCounter-id').val(row.id);
			$.post('<?php echo site_url("admin/counter_sales/get_countersales"); ?>',{counter_sales_id: row.counter_sales_id},function(result) {
				if(result.success) {

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
							{ name: 'material_issue_no', type: 'string' },					
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

					$("#jqxGrid_issueparts_list").on("bindingcomplete", function (event) {
						rowdata = event.args.owner.source.records[0];
						if(rowdata.material_issue_no) {
							$('#material_issue_no').text('MI-'+(rowdata.material_issue_no).pad(5));
						}
					});  

					var csMaterialRequest_datasource =
					{
						datatype: "json",
						datafields:
						[
						{ name: 'part_name', type: 'string' },
						{ name: 'quantity', type: 'number' },
						{ name: 'created_date', type: 'date' },					
						],
						url: '<?php echo site_url("admin/counter_sales/json_material_request"); ?>',
						data: { counter_sales_id: row.counter_sales_id },
						pagesize: defaultPageSize,
						root: 'rows',
						id : 'countersale_request_id',
						addrow: function (rowid, rowdata, position, commit) {
							commit(true);
						},
					};
					var csMaterialRequest_dataAdapter = new $.jqx.dataAdapter(csMaterialRequest_datasource);
					$("#jqxGrid_requested_parts").jqxGrid({ source: csMaterialRequest_dataAdapter, });

				}
				$('#scan_code').val('');
				$('#scan_code').focus();

			},'json');
		}

		openPopupWindow('jqxPopupWindowIssueCounter_sale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}

	function create_invoice( index ) {
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);

		$('#counterIssue-id').val(row.id);
		$('#issueCountersales-countersales_no').val(row.counter_sales_id);
		$('#issueCountersales-countersales_no_display').text("CI-"+ (row.counter_sales_id).pad(5) );

		if(row.is_countersale_billed == null) {
			var get_url  = '<?php echo site_url('admin/counter_sales/get_countersales_toBill/'); ?>';
			$('#viewissueCounter-create_bill').show();
			$('#viewissueCounter-print_bill').hide();
		} else {
			var get_url  = '<?php echo site_url('admin/counter_sales/get_countersales_billed/') ?>';
			$('#issueCountersales-invoice_no').val(row.invoice_no);
			$('#issueCountersales-invoice_no_display').text("TI-"+ (row.invoice_no).pad(5) );

			$('#viewissueCounter-create_bill').hide();
			$('#viewissueCounter-print_bill').show();
		}

		var scannedParts_datasource =
		{
			datatype: "json",
			url: get_url,
			data: { counter_sales_id: row.counter_sales_id },
			datafields:
			[
			{ name: 'id', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'part_id', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'total', type: 'number' },
			{ name: 'warranty', type: 'string' },
			],
			addrow: function (rowid, rowdata, position, commit) {
				commit(false);
			},
		};
		var scannedParts_adapter = new $.jqx.dataAdapter(scannedParts_datasource);
		$('#jqxGrid_view_issuet_parts_list').jqxGrid({source: scannedParts_adapter});

		openPopupWindow('jqxPopupWindowViewIssueCounter_sale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	}

	function calculate_counter_summary(summary_id, type = '' ) {
		<?php if(is_group(CG_SPAREPART_OUTLET)){?>
			var price_option = $("input[name='price_option']:checked").val();
		<?php }else{?>
			var price_option = 'price'
		<?php }?>

		if(price_option == 'price'){
			var parts_amount = parseFloat($('#'+summary_id+'-total_for_parts').val());
			isNaN(parts_amount)? parts_amount = 0:'';
			var vro = 0;
		}else{
			var parts_amount = parseFloat($('#'+summary_id+'-dealer_total_for_parts').val());
			isNaN(parts_amount)? parts_amount = 0:'';
			<?php if(is_group(CG_SPAREPART_OUTLET)){?>
				var vro = $('#vro').val();
			<?php }else{?>
				var vro = 0;
			<?php }?>
		}

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

		}

		process_summary(parts_amount, job_amount, vat, percent, cash_amount, summary_id,vro);
	}

	function process_summary(parts_amount, job_amount, vat, percent, cash_amount, summary_id, vro) {
		parts_amount = parts_amount * (1 + vro/100);				/*adding vro percentage to total part amount*/

		var vat_job = (job_amount * vat ) /100;                 /*add vat*/
		var vat_parts = (parts_amount * vat ) /100;               /*add vat*/

		parts_amount += vat_parts;
		job_amount += vat_job;

		parts_amount = parts_amount - ((parts_amount * percent) / 100);    /*discount cash percent*/
		job_amount = job_amount - ((job_amount * percent) / 100);      /*discount cash percent*/

		$('#'+summary_id+'-vat_parts').val(vat_parts);

		$('#'+summary_id+'-net_total').val(parts_amount + job_amount);

	}

	function create_gatepass( index ) {
		var row =  $("#jqxGridCounter_sale").jqxGrid('getrowdata', index);
		$('#create_gatepass').val(row.counter_sales_id);
		openPopupWindow('window_gatepass', 'Gatepass');
	}

	function reset_form_counter_sales(){
		$('#id').val('');
		$('#counter_sales_id').val('');
		$('#form-counter_sales')[0].reset();
		$('#issueCountersales-countersales_no').val('');
		$('#issueCountersales-countersales_no_display').html('');
		$('#issueCountersales-invoice_no').val('');
		$('#issueCountersales-invoice_no_display').html('');
		$('#materialCounterJqxgrid').jqxGrid('clear');

		$('#counter_sale-credit_account').jqxComboBox('clear');
	}


</script>

<script type="text/javascript">
	$('#add_part_quantity, #add_part_name').on('change',function(){
		data = $('#form-add_part').serialize();
		$.post('<?php echo base_url("counter_sales/check_stock")?>',data,function(result) {
			if(!result.success){
				$('#add_part_quantity').val(0);
				$('#stock-error').html(result.msg);
				$('#stock-error').show();
				$('#add_part_submit').attr('disabled',true);
			}else{
				$('#stock-error').hide();
				$('#add_part_submit').attr('disabled',false);

			}
		},'json')
	})
</script>

<script type="text/javascript">
	$('.adviced_price_option').click(function(){
		var price_option = $("input[name='price_option']:checked").val();
		if(price_option == 'dealer_price'){
			CounterSalesRequest.jqxGrid('hidecolumn', 'price');
			CounterSalesRequest.jqxGrid('showcolumn', 'dealer_price');
			CounterSalesRequest.jqxGrid('hidecolumn', 'total');
			CounterSalesRequest.jqxGrid('showcolumn', 'dealer_price_total');
			$('#mrp_total').hide();
			$('#dealer_total').show();
			$('#vro_div').show();
		}else{
			CounterSalesRequest.jqxGrid('showcolumn', 'price');
			CounterSalesRequest.jqxGrid('hidecolumn', 'dealer_price');
			CounterSalesRequest.jqxGrid('showcolumn', 'total');
			CounterSalesRequest.jqxGrid('hidecolumn', 'dealer_price_total');
			$('#mrp_total').show();
			$('#dealer_total').hide();
			$('#vro_div').hide();
		}
	})
</script>

<script type="text/javascript">
	$('#vro').on('change',function(){
		calculate_counter_summary('counterIssue');
	})
</script>