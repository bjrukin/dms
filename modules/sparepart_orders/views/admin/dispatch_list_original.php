<div class="content-wrapper">
	<section class="content">
		<section class="content-header "><!-- connectedSortable -->
			<?php echo displayStatus(); ?>
		</section>		
		<div class="box">
			<div class="box billing">
				<div class="bill-type">
					<span>Select Bill Type</span>
					<div id="order"> ORDER </div>
					<div id="foc"> FOC </div>
				</div>
				<div id="order-form" style="display: none;">
					<form id="order_form" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-2">
								<label>Dealer:</label>
							</div>
							<div class="col-md-10">
								<div id="dealer_list" name="dealer_id"></div>
							</div>							
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Order Type:</label>
							</div>
							<div class="col-md-10">
								<div id="order_type" name="order_type"></div>												
							</div>							
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Order No:</label>
							</div>
							<div class="col-md-10">
								<div id="order_list" name="order_no"></div>												
							</div>							
						</div>
						<div class="row" id="vor_div" style="display: none;">
							<div class="col-md-2">
								<label>VOR(Add Percentage)</label>
							</div>
							<div class="col-md-10">
								<input type="text" name="vor_percentage" class="text_input">
							</div>
						</div>
					</form>				
					<button id="list_order_spareparts" class="btn btn-xs btn-flat btn-danger">List Parts</button>
				</div>
				<div id="foc-form" style="display: none;">
					<div class="row">
						<div class="col-md-1">
							<label>Customer:</label>
						</div>
						<div class="col-md-11">
							<div id="customer_list"></div>
						</div>							
					</div>
					<button id="list_foc_spareparts" class="btn btn-xs btn-flat btn-danger">List Parts</button>
				</div>
			</div>
			<section>				
				<div class="col-md-12">
					<div id="jqxGridPiList"></div>
				</div>
				<div class="box-footer clearfix">
					<div id="foc-bill" style="display: none;"> 
						<form action ="<?php echo site_url('sparepart_orders/generate_excel')?>/foc">
							<input type="hidden" name="customer_id" id='customer_id'> 
							<button type="submit" id="foc-billing-btn" class="btn btn-xs btn-flat btn-danger">Generate FOC Bill</button>
						</form>
					</div>
					<div id="order-bill" style="display: none;">
						<form action ="<?php echo site_url('sparepart_orders/generate_excel')?>/order">
							<input type="hidden" name="dealer_id" id='dealer_id_bill'> 
							<input type="hidden" name="order_no" id='order_no_bill'> 
							<input type="hidden" name="dispatch_mode" id="order_dispatch_mode">
							<input type="hidden" name="vor_percentage" id="vor_percentage_bill">
							<div class="row">
								<div class="col-md-2">
									<label for="dispatch_mode">Dispatch Mode</label>
								</div>
								<div class="col-md-10">
									<div class="col-md-1">
										<div id="radio_dispatch_land">Land</div>
									</div>
									<div class="col-md-11">
										<div id="radio_dispatch_air">Air</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label for="discount">Enter Discount</label>		
								</div>
								<div class="col-md-10">
									<input type="text" class="text_input" name="discount_percentage"><br/>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label for="image_save">Bill Image</label>	
								</div>
								<div class="col-md-10">
									<input type="checkbox"  name="image_save">
								</div>
							</div>
							<button type="submit" id="order-billing-btn" class="btn btn-xs btn-flat btn-danger">Generate Order Bill</button>
						</form>
					</div>
				</div>
			</section>
		</div>
	</section>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
		$("#radio_dispatch_land").jqxRadioButton({ width: 250, height: 25});
		$("#radio_dispatch_air").jqxRadioButton({ width: 250, height: 25});
		$('#radio_dispatch_land').on('change', function (event) { 
			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_dispatch_mode').val('land');			
			}
		});
		$('#radio_dispatch_air').on('change', function (event) { 
			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_dispatch_mode').val('air');			
			}
		});

		var foc_customerDataSource = {
			url : '<?php echo site_url("admin/sparepart_orders/get_foc_customer_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'customer_id', type: 'number' },
			{ name: 'full_name', type: 'string' },
			],
			async: false,
			cache: true
		}

		foc_customersDataAdapter = new $.jqx.dataAdapter(foc_customerDataSource);

		$("#customer_list").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: foc_customersDataAdapter,
			displayMember: "full_name",
			valueMember: "customer_id",
		});

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

		$("#dealer_list").jqxComboBox({
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

		$("#dealer_list").bind('select', function (event) {

			if (!event.args)
				return;

			dealer_id = $("#dealer_list").jqxComboBox('val');

			var OrderTypesource = [
			"Select Order Type",
			"STOCK",
			"VOR", 
			];
			$("#order_type").jqxComboBox({ 
				source: OrderTypesource, 
				selectedIndex: 0, 
				width: 195, 
				height: 25 
			});

		});


		$("#order_type").bind('select', function (event) {

			if (!event.args)
				return;

			dealer_id = $("#dealer_list").jqxComboBox('val');
			order_type = $("#order_type").jqxComboBox('val');

			if(order_type == 'VOR')
			{
				$('#vor_div').show();
			}
			else
			{
				$('#vor_div').hide();
			}


			var order_listDataSource  = {
				url : '<?php echo site_url("admin/sparepart_orders/get_dealer_order_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'order_no', type: 'number' },
				],
				data: {
					dealer_id: dealer_id,
					order_type : order_type
				},
				async: false,
				cache: true
			}

			order_listDataAdapter = new $.jqx.dataAdapter(order_listDataSource, {autoBind: false});

			$("#order_list").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: order_listDataAdapter,
				displayMember: "order_no",
				valueMember: "order_no",
			});
		});

		$("#order").jqxRadioButton({ width: 120, height: 25 });
		$("#foc").jqxRadioButton({ width: 120, height: 25 });
		$("#order").bind('change', function (event) {
			var checked = event.args.checked;
			if(checked)
			{
				$('#order-form').show();
				$('#foc-form').hide();
				$('#order-bill').show();
				$('#foc-bill').hide();
			}
		});
		$("#foc").bind('change', function (event) {
			var checked = event.args.checked;
			if(checked)
			{
				$('#foc-form').show();
				$('#order-form').hide();
				$('#foc-bill').show();
				$('#order-bill').hide();
			}
		});

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'customer_id', type: 'number' },
			{ name: 'dispatch_quantity', type: 'number' },
			{ name: 'price', type: 'number' },
			],
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				sparepart_ordersDataSource.totalrecords = data.total;
			},
			filter: function () {
				$("#jqxGridPiList").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#jqxGridPiList").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGridPiList").jqxGrid({		
			width: '100%',
			height: gridHeight,
			source: sparepart_ordersDataSource,
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
			showstatusbar: true,
			theme:theme,
			statusbarheight: 30,
			pagesizeoptions: pagesizeoptions,
			showtoolbar: true,
			virtualmode: true,
			showaggregates: true,
			selectionmode: 'singlecell',
			ready: function () {
				var rowsCount = $("#jqxGridPiList").jqxGrid("getrows").length;
				for (var i = 0; i < rowsCount; i++) {
					var currentQuantity = $("#jqxGridPiList").jqxGrid('getcellvalue', i, "dispatched_quantity");
					var currentPrice = $("#jqxGridPiList").jqxGrid('getcellvalue', i, "price");
					var currentTotal = currentQuantity * currentPrice;
					$("#jqxGridPiList").jqxGrid('setcellvalue', i, "total", currentTotal.toFixed(2));
				}
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width:150,  align: 'center' , cellsalign: 'left',filterable: false,renderer: gridColumnsRenderer },										
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 200,filterable: false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width:150, filterable: false, align: 'center' , cellsalign: 'right' , cellsformat:'F2', renderer: gridColumnsRenderer},										
			{ text: '<?php echo lang("dispatch_quantity"); ?>',datafield: 'dispatch_quantity',width:200, filterable: false,cellsalign: 'right',renderer: gridColumnsRenderer },
			{
				text: 'Total Amount', datafield: 'total', sortable:false , width:200, filterable:false, align: 'center' , cellsalign: 'right', 
				cellsrenderer: function (index) {
					var row = $("#jqxGridPiList").jqxGrid('getrowdata', index);
					var e = row.price * row.dispatch_quantity;
					return '<div style="text-align: right; margin-top: 8px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>';
				}
			},	

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridPiList").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridPiListFilterClear', function () { 
			$('#jqxGridPiList').jqxGrid('clearfilters');
		});


	});

var datarow = new Array();
$('#list_foc_spareparts').click(function(){
	var customer_id = $('#customer_list').val();
	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/sparepart_orders/list_foc_spareparts"); ?>',
		data: {customer_id:customer_id},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success == true) 
			{
				$("#jqxGridPiList").jqxGrid('clear');
				$('#customer_id').val(result.customer_id);
				$.each(result.rows,function(i,v){								
					datarow = {
						'name':v.name,
						'part_code':v.part_code
					};
					$("#jqxGridPiList").jqxGrid('addrow', null, datarow);
				});
			}		
		}
	});
});

$('#list_order_spareparts').click(function(){
	var data = $('#order_form').serialize();
	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/sparepart_orders/list_order_spareparts"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success == true) 
			{
				$('#dealer_id_bill').val(result.dealer_id);
				$('#order_no_bill').val(result.order_no);
				$('#vor_percentage_bill').val(result.vor_percentage);
				$("#jqxGridPiList").jqxGrid('clear')
				$.each(result.rows,function(i,v){								
					datarow = {
						'name':v.name,
						'part_code':v.part_code,
						'dispatch_quantity' : v.dispatch_quantity,
						'price' : v.price
					};
					$("#jqxGridPiList").jqxGrid('addrow', null, datarow);
				});

			}
		}
	});
});

</script>