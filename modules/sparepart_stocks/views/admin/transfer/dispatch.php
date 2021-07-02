<section class="content">
	<?php /*<section class="content-header "><!-- connectedSortable -->
		<?php echo displayStatus(); ?>
	</section>	*/?>	
	<div class="">
		<div class="">				
			<div class="col-md-12">
				<fieldset>
					<legend>Bill Details</legend>
					<div id="order-form">
						<input type="hidden" name="stock_from" id="stock_from" value="1">
						<div class="row">
							<div class="col-sm-2">
								<label>Stockyard :</label>
							</div>
							<div class="col-sm-4">
								<div id="stockyard_id" name="stock_to"></div>												
							</div>							
						
							<div class="col-sm-2">
								<label>Date: </label>
							</div>
							<div class="col-sm-4">
								<div id="dispatched_date_en" name="dispatched_date_en"></div>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-sm-2"><label>Barcode Scan</label></div>
							<div class="col-sm-4"><input type="text" class="form-control" name = "barcode_partcode" id="scan_barcode"></div>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<section>				
			<div class="col-md-12">
				<div id="jqxGridPiList"></div>
			</div>
			<div class="clearfix"></div>
			<div class="box-footer clearfix">
				<fieldset>
					<div id="order-bill">
						<!-- <div class="row">
							<div class="col-md-2">
								<label for="discount">Enter Discount(%)</label>		
							</div>
							<div class="col-md-10">
								<input type="text" class="text_input"  id="discount_percentage_bill" name="discount_percentage"><br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Remarks</label>
							</div>
							<div class="col-md-10">
								<textarea name="remarks" class="text_area" cols="5" id="remarks"></textarea>
							</div>
						</div> -->
						<button type="submit" class="btn btn-md btn-flat btn-success" id="save_bill">Save Bill</button>
						<div id="generate_bill"></div>
					</div>
				</fieldset>
			</div>
		</section>
	</div>
</section>

<script language="javascript" type="text/javascript">
	$(function(){
		$("#dispatched_date_en").jqxDateTimeInput({ width: '300px', height: '25px', formatString: 'yyyy-MM-dd' });

		var stockyardDataSource = {
			url : '<?php echo site_url("/sparepart_stocks/transfer/get_stockyard"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		stockyardDataAdapter = new $.jqx.dataAdapter(stockyardDataSource);

		$("#stockyard_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: stockyardDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		$("#jqxGridPiList").jqxGrid({
			theme: theme,
	        width: '100%',
	        height: '1000px',
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
	        pagesizeoptions: ['10','20','50','100','500'],
	        pagesize: 20,
	        // showtoolbar: true,
	        editable: true,
				
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
			// editable: true,
			// statusbarheight: 30,
			// pagesizeoptions: pagesizeoptions,
			// showtoolbar: true,
			// virtualmode: true,
			showAggregates: true,
        	showstatusbar: true,
			// selectionmode: 'singlecell',
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false,editable:false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, editable:false,align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					var rows = $("#jqxGridPiList").jqxGrid('getrowdata', index);
					var e = '';
					e += '<a href="javascript:void(0)" onclick="order_delete(' + index + '); return false;" title="Delete Item"><i class="fa fa-trash" aria-hidden="true"></i>';				
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'dealer_price',width:150, filterable: false,editable:false, align: 'center' , cellsalign: 'right' , cellsformat:'F2', renderer: gridColumnsRenderer,cellsrenderer: function(index, row, columnfield, value, defaulthtml, columnproperties){
					var rows = $("#jqxGridPiList").jqxGrid('getrowdata', index);
					var vor = parseFloat($('#vor_percentage_bill').val() || 0);
					var price = rows.dealer_price + (rows.dealer_price * vor/100);
					return '<div style="text-align: center; margin-top: 8px;">'+price+'</div>';
				} 
			},
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width:200, filterable: false,cellsalign: 'right',renderer: gridColumnsRenderer,aggregates: ['sum']},
			{
				text: 'Total Amount', datafield: 'total', sortable:false , width:200, filterable:false, align: 'center' , editable:false, cellsalign: 'right', 
				cellsrenderer: function (index) {
					var vor = parseFloat($('#vor_percentage_bill').val() || 0);
					var rows = $("#jqxGridPiList").jqxGrid('getrowdata', index);
					var e = (rows.dealer_price * rows.quantity);
					return '<div style="text-align: right; margin-top: 8px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>';
				}
			,aggregates: [{ 'Sum':
            function (aggregatedValue, currentValue, column, record) {
            	var price = parseFloat((record.hasOwnProperty("dealer_price"))?record.dealer_price:0);
              	var quantity = parseFloat((record.hasOwnProperty("quantity"))?record.quantity:0);

              	var row_total = (isNaN(price)?0:price) * (isNaN(quantity)?0:quantity);
              	var total = parseFloat(row_total);
              	var g_total = aggregatedValue + total;
              	return g_total;
            }

        	}] ,
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

		$('#stockyard_id').on('change', function (event) {
			var stock_to = $('#stockyard_id').val();
			var stock_from = $('#stock_from').val();

			$("#jqxGridPiList").jqxGrid('clear');

			var dispatch_ListDataSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				{ name: 'part_code', type: 'string' },
				{ name: 'quantity', type: 'number' },
				{ name: 'dealer_price', type: 'number' },
				{ name: 'picklist_no', type: 'number' },
				{ name: 'order_id', type: 'number' },
				{ name: 'picklist_id', type: 'number' },
				{ name: 'dealer_id', type: 'number' },
				{ name: 'sparepart_id', type: 'number' },
				{ name: 'stockyard_id', type: 'number' },
				{ name: 'transfer_id', type: 'number' },
				],
				url: '<?php echo site_url("sparepart_stocks/transfer/not_send_list"); ?>',
				// pagesize: defaultPageSize,
				data : {stock_to:stock_to, stock_from:stock_from},
				root: 'rows',
				id : 'id',
				cache: true					
			};

			var picklistData_Adapter = new $.jqx.dataAdapter(dispatch_ListDataSource);

			$('#jqxGridPiList').jqxGrid({source: picklistData_Adapter});
			$('#scan_barcode').val('');
		});

		
	});

	$('#scan_barcode').keypress(function(e){
		if(e.which == 13) 
		{
			var code = $('#scan_barcode').val();
			var rows = $("#jqxGridPiList").jqxGrid('getrows');
			var duplicate = 0;
			$.each(rows,function(key,value){
				if(value.part_code == code){
					duplicate = 1;
				}
			});

			if(duplicate == 0){
				var stock_from = $('#stock_from').val();
				var stock_to = $('#stockyard_id').val();
				var dispatched_date_en = $('#dispatched_date_en').val();
				if(!(stock_to && dispatched_date_en)){
					alert('please insert stockyard and date');
					return false;
				}
				$.post('<?php echo site_url('sparepart_stocks/transfer/get_barcode_values'); ?>',{code:code,stock_from:stock_from,stock_to:stock_to, dispatched_date_en:dispatched_date_en},function(result){
					if (result.success == true) 
					{
						$("#jqxGridPiList").jqxGrid('clear');

						var dispatch_ListDataSource =
						{
							datatype: "json",
							datafields: [
							{ name: 'id', type: 'number' },
							{ name: 'name', type: 'string' },
							{ name: 'part_code', type: 'string' },
							{ name: 'quantity', type: 'number' },
							{ name: 'dealer_price', type: 'number' },
							{ name: 'picklist_no', type: 'number' },
							{ name: 'order_id', type: 'number' },
							{ name: 'picklist_id', type: 'number' },
							{ name: 'dealer_id', type: 'number' },
							{ name: 'sparepart_id', type: 'number' },
							{ name: 'stockyard_id', type: 'number' },
							{ name: 'transfer_id', type: 'number' },
							],
							url: '<?php echo site_url("sparepart_stocks/transfer/not_send_list"); ?>',
							// pagesize: defaultPageSize,
							data : {stock_to:stock_to, stock_from:stock_from},
							root: 'rows',
							id : 'id',
							cache: true					
						};

						var picklistData_Adapter = new $.jqx.dataAdapter(dispatch_ListDataSource);

						$('#jqxGridPiList').jqxGrid({source: picklistData_Adapter});
						$('#scan_barcode').val('');
					}
					else
					{
						alert(result.msg);
					}
				},'JSON');
			}else{
				alert('Duplicate entry.');
			}
		}
	});

	$('#jqxGridPiList').on('cellvaluechanged', function (event) {
		var rowBoundIndex = event.args.rowindex;
		var rowdata = $('#jqxGridPiList').jqxGrid('getrowdata', rowBoundIndex);

		$.post('<?php echo site_url('sparepart_stocks/transfer/update_quantity') ?>',{id : rowdata.id, quantity:rowdata.quantity,sparepart_id:rowdata.sparepart_id, stockyard_id:rowdata.stockyard_id},function(result)
		{
			if(result.success)
			{
				// alert('Successfully Updated');
			}else{
				alert(result.msg);
				$("#jqxGridPiList").jqxGrid('setcellvalue', rowBoundIndex, "quantity", "1");
			}

		},'json');

	});

	$('#save_bill').on('click',function(){
		$('#save_bill').prop('disabled', true);
		var data = $('#jqxGridPiList').jqxGrid('getrows');
		var vor_percentage = $('#vor_percentage_bill').val();
		var discount_percentage = $('#discount_percentage_bill').val();
		var dispatched_date_en = $('#dispatched_date_en').val();
		var remarks = $('#remarks').val();
		var bill_no = $('#bill_no').val();
		$('#jqxGridPiList').block({ 
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
			url: '<?php echo site_url("sparepart_stocks/transfer/save_bill"); ?>',
			data: {data : data, vor_percentage:vor_percentage,discount_percentage:discount_percentage,dispatched_date_en:dispatched_date_en,remarks:remarks,bill_no:bill_no},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					$('#jqxGridPiList').jqxGrid('updatebounddata');
					// $('#save_bill').hide();
					// $('#generate_bill').html('<a href="<?php echo site_url('admin/sparepart_orders/generate_bill');?>/'+result.bill_no+'/'+result.dispatched_date_nepali+'" target="_blank" class="btn btn-md btn-flat btn-primary">Generate Bill</a>');
				}else{
					$('#save_bill_no_order').prop('disabled', false);
					alert(result.msg);
				}
				$('#jqxGridPiList').unblock();
				$('#save_bill').prop('disabled', false);
			}
		});
	});

	$('#generate_bill').click(function(){
		location.reload();
	});

	function order_delete(index){
		if(confirm('Are you sure'))
		{
			var rows = $("#jqxGridPiList").jqxGrid('getrowdata', index);

			$('#jqxGridPiList').block({ 
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
				url: '<?php echo site_url("sparepart_stocks/transfer/delete_item"); ?>',
				data: {id : rows.id},
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						$('#jqxGridPiList').unblock();
						$('#jqxGridPiList').jqxGrid('updatebounddata');
					}
				}
			});
		}
	}

</script>

<script type="text/javascript">
	$('#bill_no').blur(function(){
		var bill_no = $(this).val();
		if(bill_no){
			$.post('<?php echo site_url("sparepart_orders/check_bill_no")?>',{bill_no:bill_no},function(result){
				if(result.success){
					alert(result.msg);
					$('#bill_no').val('');
					$('#bill_no').focus();
				}
			},'json');
		}
	});
</script>