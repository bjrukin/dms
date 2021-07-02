	<section class="content">
		<div class="">
			<div class="col-md-12">
				<fieldset>
					<legend>Bill Details</legend>
					<div id="order-form">
						<div class="row">
							<div class="col-md-2">
								<label>Dealer:</label>
							</div>
							<div class="col-md-10">
								<div id="dealer_list_no_order" name="dealer_id"></div>
							</div>
							<div class="col-md-2">
								<label>Bill No:</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="bill_no" id="no_order_bill_number" class="form-control">
							</div>								
						</div>
						<br/>
						<div class="row form-group">
							<div class="col-md-2"> Customer Name  <br><a href="<?php echo site_url('user_ledgers'); ?>" target="_blank">Create New</a></div>
							<div class="col-md-10">  <div id='counter_sale-credit_account' name="credit_account"></div> </div>
						</div>
						<br/>
						<div class="row">
								<div class="col-md-2">
									<label>Date: </label>
								</div>
								<div class="col-md-10">
									<div id="billed_date_no_order" name="billed_date"></div>
								</div>
							</div>						
						<br/>
						<div class="row">
							<div class="col-md-2"><label>Barcode Scan</label></div>
							<div class="col-md-6"><input type = "text" class = "form-control" name = "barcode_partcode" id="scan_barcode_no_order"></div>
						</div>
					</div>
				</fieldset>
			</div>
			<section>				
				<div class="col-md-12">
					<div id="jqxGridPiList_no_Order"></div>
				</div>
				<div class="clearfix"></div>
				<div class="box-footer clearfix">
					<fieldset>
						<div id="order-bill">
							<input type="hidden" name="dealer_id" id='no_order_dealer_id'> 
							<div class="row">
								<div class="col-md-2">
									<label for="discount">Enter Discount(%)</label>		
								</div>
								<div class="col-md-10">
									<input type="text" class="text_input" name="discount_percentage" id="discount_percentage_no_order"><br/>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label>Remarks</label>
								</div>
								<div class="col-md-10">
									<textarea name="remarks" class="text_area" cols="5" id="remarks_no_order"></textarea>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-2">
									<label for="image_save">Bill Image</label>	
								</div>
								<div class="col-md-10">
									<input type="checkbox"  name="image_save">
								</div>
							</div> -->
							<button type="submit" id="save_bill_no_order" class="btn btn-md btn-flat btn-success">Save Bill</button>
							<div id="generate_bill_order"></div>
						</div>
					</fieldset>
				</div>
			</section>
		</div>
	</section>

	<script language="javascript" type="text/javascript">
		$(function(){
			$("#billed_date_no_order").jqxDateTimeInput({ width: '300px', height: '25px', formatString: 'yyyy-MM-dd' });

			var sparepart_dealerDataSource = {
				url : '<?php echo site_url("admin/sparepart_orders/get_spareparts_dealers_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				async: false,
				cache: true
			}

			spareparts_dealerDataAdapter = new $.jqx.dataAdapter(sparepart_dealerDataSource);

			$("#dealer_list_no_order").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: spareparts_dealerDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});


			$("#jqxGridPiList_no_Order").jqxGrid({		
				theme: theme,
		        width: '100%',
		        height: gridHeight,
		        altrows: true,
		        // pageable: true,
		        sortable: true,
		        rowsheight: 30,
		        columnsheight: 30,
		        showfilterrow: true,
		        filterable: true,
		        columnsresize: true,
		        autoshowfiltericon: true,
		        columnsreorder: true,
		        selectionmode: 'singlecell',
		        // virtualmode: true,
		        enableanimations: false,
		        // pagesizeoptions: ['100','500'],
		        showtoolbar: true,
				editable: true,
				showaggregates: true,
				showstatusbar: true,
				
				// width: '100%',
				// height: gridHeight,
				// altrows: true,
				// pageable: true,
				// sortable: true,
				// rowsheight: 30,
				// columnsheight:30,
				// showfilterrow: true,
				// filterable: true,
				// columnsresize: true,
				// autoshowfiltericon: true,
				// columnsreorder: true,
				// showstatusbar: true,
				// theme:theme,
				// statusbarheight: 30,
				// pagesizeoptions: pagesizeoptions,
				// showtoolbar: true,
				// virtualmode: true,
				// showaggregates: true,
				// selectionmode: 'singlecell',
				ready: function () {
					var rowsCount = $("#jqxGridPiList_no_Order").jqxGrid("getrows").length;
					for (var i = 0; i < rowsCount; i++) {
						var currentQuantity = $("#jqxGridPiList_no_Order").jqxGrid('getcellvalue', i, "dispatched_quantity");
						var currentPrice = $("#jqxGridPiList_no_Order").jqxGrid('getcellvalue', i, "price");
						var currentTotal = currentQuantity * currentPrice;
						$("#jqxGridPiList_no_Order").jqxGrid('setcellvalue', i, "total", currentTotal.toFixed(2));
					}
				},
				columns: [
				{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false,editable:false},
				{
					text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, editable:false,align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
					cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
						var rows = $("#jqxGridPiList_no_Order").jqxGrid('getrowdata', index);
						var e = '';
						e += '<a href="javascript:void(0)" onclick="delete_order(' + index + '); return false;" title="Delete Item"><i class="fa fa-trash" aria-hidden="true"></i>';				
						return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
					}
				},
				{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width:150,  align: 'center' , cellsalign: 'left',filterable: false,editable:false,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("dealer_price"); ?>',datafield: 'dealer_price',width:150, filterable: false,editable:false, align: 'center' , cellsalign: 'right' , cellsformat:'F2', renderer: gridColumnsRenderer},										
				{ text: '<?php echo lang("dispatch_quantity"); ?>',datafield: 'dispatch_quantity',width:200, filterable: false,cellsalign: 'right',renderer: gridColumnsRenderer,aggregates: ['sum'] },
				{
					text: 'Total Amount', datafield: 'total', sortable:false , width:200, filterable:false, align: 'center' , editable:false, cellsalign: 'right', 
					cellsrenderer: function (index) {
						var row = $("#jqxGridPiList_no_Order").jqxGrid('getrowdata', index);
						var e = row.dealer_price * row.dispatch_quantity;
						return '<div style="text-align: right; margin-top: 8px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>';
					},
					aggregates: [{ 'Sum':
		                function (aggregatedValue, currentValue, column, record) {
		                	var price = parseFloat((record.hasOwnProperty("dealer_price"))?record.dealer_price:0);
		                  	var quantity = parseFloat((record.hasOwnProperty("dispatch_quantity"))?record.dispatch_quantity:0);

		                  	var row_total = (isNaN(price)?0:price) * (isNaN(quantity)?0:quantity);
		                  	var total = parseFloat(row_total);
		                  	var g_total = aggregatedValue + total;
		                  	return g_total;
		                }
	            	}]
				},	

				],
				rendergridrows: function (result) {
					return result.data;
				}
			});

			$("[data-toggle='offcanvas']").click(function(e) {
				e.preventDefault();
				setTimeout(function() {$("#jqxGridPiList_no_Order").jqxGrid('refresh');}, 500);
			});

			$(document).on('click','#jqxGridPiList_no_OrderFilterClear', function () { 
				$('#jqxGridPiList_no_Order').jqxGrid('clearfilters');
			});

			var partyDataSource = {
				url : '<?php echo site_url("admin/sparepart_orders/get_user_list_json"); ?>',
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
				theme: theme, 
				width: '20%',
				height: 25,
				source: partyDataAdapter,
				minLength: 3,
				remoteAutoComplete: true,
				selectedIndex: 0,
				displayMember: "party_name",
				valueMember: "id",
				search: function (searchString) {
					partyDataAdapter.dataBind();
				}
			});

		});

	$('#scan_barcode_no_order').keypress(function(e){
		if(e.which == 13) 
		{
			var code = $('#scan_barcode_no_order').val();
			var dealer_id = $('#dealer_list_no_order').val();
			var ledger_id = $('#counter_sale-credit_account').val();
			$('#no_order_dealer_id').val(dealer_id);
			$.post('<?php echo site_url('sparepart_orders/set_barcode_values'); ?>',{code:code,dealer_id:dealer_id,ledger_id:ledger_id},function(result){
				if (result.success == true) 
				{
					$("#jqxGridPiList_no_Order").jqxGrid('clear');
					var order_dispatch_ListDataSource =
					{
						datatype: "json",
						datafields: [
						{ name: 'id', type: 'number' },
						{ name: 'name', type: 'string' },
						{ name: 'part_code', type: 'string' },
						{ name: 'dispatch_quantity', type: 'number' },
						{ name: 'dealer_price', type: 'number' },
						{ name: 'picklist_no', type: 'number' },
						{ name: 'picklist_id', type: 'number' },
						{ name: 'dealer_id', type: 'number' },
						{ name: 'sparepart_id', type: 'number' },
						{ name: 'order_id', type: 'number' },
						{ name: 'order_no', type: 'number' },
						{ name: 'ledger_id', type: 'number' },
						],
						url: '<?php echo site_url("admin/sparepart_orders/dispatch_spareparts_json"); ?>',
						// pagesize: defaultPageSize,
						data : {dealer_id : dealer_id, ledger_id : ledger_id},
						root: 'rows',
						id : 'id',
						cache: true					
					};

					var order_picklistData_Adapter = new $.jqx.dataAdapter(order_dispatch_ListDataSource);

					$('#jqxGridPiList_no_Order').jqxGrid({source: order_picklistData_Adapter});
					$('#scan_barcode_no_order').val('');
				}
				else
				{
					alert(result.msg);
				}
			},'JSON');

		}
	});

	$('#jqxGridPiList_no_Order').on('cellvaluechanged', function (event) {
		var rowBoundIndex = event.args.rowindex;
		var rowdata = $('#jqxGridPiList_no_Order').jqxGrid('getrowdata', rowBoundIndex);
		$.post('<?php echo site_url('admin/sparepart_orders/update_dispatch_quantity/0') ?>',{id : rowdata.id, dispatch_quantity:rowdata.dispatch_quantity},function(result)
		{

		});

	});

	$('#save_bill_no_order').on('click',function(){
		$('#save_bill_no_order').prop('disabled', true);
		var data = $('#jqxGridPiList_no_Order').jqxGrid('getrows');
		var dealer_id = $('#dealer_list_no_order').val();
		var remarks = $('#remarks_no_order').val();
		var billed_date = $('#billed_date_no_order').val();
		var discount_percentage = $('#discount_percentage_no_order').val();
		var ledgers_id = $('#counter_sale-credit_account').val();
		var bill_no = $('#no_order_bill_number').val();

		$('#jqxGridPiList_no_Order').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/save_no_order_bill"); ?>',
			data: {data : data,bill_no : bill_no, ledgers_id: ledgers_id, dealer_id: dealer_id, remarks:remarks, billed_date:billed_date, discount_percentage:discount_percentage},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					$('#jqxGridPiList_no_Order').jqxGrid('updatebounddata');
					$('#save_bill_no_order').hide();
					$('#generate_bill_order').html('<a href="<?php echo site_url('admin/sparepart_orders/generate_bill');?>/'+result.bill_no+'" class="btn btn-md btn-flat btn-primary">Generate Bill</a>');
				}else{
					$('#save_bill_no_order').prop('disabled', false);
					alert(result.msg);
				}
				$('#jqxGridPiList_no_Order').unblock();
			}
		});

	});

	function delete_order(index){
		if(confirm('Are you sure'))
		{
			var rows = $("#jqxGridPiList_no_Order").jqxGrid('getrowdata', index);

			$('#jqxGridPiList_no_Order').block({ 
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
				url: '<?php echo site_url("admin/sparepart_orders/delete_item_picklist"); ?>',
				data: {id : rows.id},
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						$('#jqxGridPiList_no_Order').unblock();
						$('#jqxGridPiList_no_Order').jqxGrid('updatebounddata');
					}
				}
			});
		}
	}


</script>

<script type="text/javascript">
	$('#no_order_bill_number').blur(function(){
		var bill_no = $(this).val();
		if(bill_no){
			$.post('<?php echo site_url("sparepart_orders/check_bill_no")?>',{bill_no:bill_no},function(result){
				if(result.success){
					alert(result.msg);
					$('#no_order_bill_number').val('');
					$('#no_order_bill_number').focus();
				}
			},'json');
		}
	});
</script>