	<section class="content">
		<section class="content-header "><!-- connectedSortable -->
			<?php echo displayStatus(); ?>
		</section>		
		<div class="">
			<div class="">				
				<div class="col-md-12">
					<fieldset>
						<legend>Bill Details</legend>
						<div id="order-form">
							<div class="row">
								<div class="col-md-2">
									<label>Picklist No.:</label>
								</div>
								<div class="col-md-10">
									<div id="picklist_no" name="picklist_no"></div>												
								</div>							
							</div>
							<br/>
							<div class="row">
								<div class="col-md-2">
									<label>Date: </label>
								</div>
								<div class="col-md-10">
									<div id="billed_date" name="billed_date"></div>
								</div>
							</div>
							<br/>
							<div class="row" id="vor_div" style="display: none;">
								<div class="col-md-2">
									<label>VOR(Add Percentage)</label>
								</div>
								<div class="col-md-10">
									<input type="text" name="vor_percentage" id="vor_percentage_bill" class="text_input">
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="col-md-2"><label>Barcode Scan</label></div>
								<div class="col-md-6"><input type = "text" class = "form-control" name = "barcode_partcode" id="scan_barcode"></div>
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
						<div id="order-bill"">
							<div class="row">
								<div class="col-md-2">
									<label for="discount">Enter Discount(%)</label>		
								</div>
								<div class="col-md-10">
									<input type="text" class="text_input"  id="discount_percentage_bill" name="discount_percentage"><br/>
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
			$("#billed_date").jqxDateTimeInput({ width: '300px', height: '25px', formatString: 'yyyy-MM-dd' });

			var picklistDataSource = {
				url : '<?php echo site_url("admin/sparepart_orders/get_picklist_list"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'picklist_no', type: 'number' },
				{ name: 'picklist_format', type: 'string' },
				{ name: 'order_type', type: 'string' },
				],
				async: false,
				cache: true
			}

			picklistsDataAdapter = new $.jqx.dataAdapter(picklistDataSource);

			$("#picklist_no").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: picklistsDataAdapter,
				displayMember: "picklist_format",
				valueMember: "picklist_no",
			});

			$("#picklist_no").bind('select', function (event) {

				if (!event.args)
					return;

				var picklist_no = $("#picklist_no").jqxComboBox('val');

				var item = $("#picklist_no").jqxComboBox('getItemByValue', picklist_no);
				if(item.originalItem.order_type == 'VOR')
				{
					$('#vor_div').show();
				}
				else
				{
					$('#vor_div').hide();
				}

			});



			$("#jqxGridPiList").jqxGrid({		
				width: '100%',
				height: gridHeight,
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
				editable: true,
				statusbarheight: 30,
				pagesizeoptions: pagesizeoptions,
				showtoolbar: true,
				virtualmode: true,
				showaggregates: true,
				selectionmode: 'singlecell',
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
				{ text: '<?php echo lang("price"); ?>',datafield: 'dealer_price',width:150, filterable: false,editable:false, align: 'center' , cellsalign: 'right' , cellsformat:'F2', renderer: gridColumnsRenderer},										
				{ text: '<?php echo lang("dispatch_quantity"); ?>',datafield: 'dispatch_quantity',width:200, filterable: false,cellsalign: 'right',renderer: gridColumnsRenderer,aggregates: ['sum'] },
				{
					text: 'Total Amount', datafield: 'total', sortable:false , width:200, filterable:false, align: 'center' , editable:false, cellsalign: 'right', 
					cellsrenderer: function (index) {
						var row = $("#jqxGridPiList").jqxGrid('getrowdata', index);
						var e = row.dealer_price * row.dispatch_quantity;
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

	$('#scan_barcode').keypress(function(e){
		if(e.which == 13) 
		{
			var code = $('#scan_barcode').val();
			var picklist_no = $('#picklist_no').val();
			$('#picklist_no_bill').val(picklist_no);
			$.post('<?php echo site_url('admin/sparepart_orders/get_barcode_values'); ?>',{code:code,picklist_no:picklist_no},function(result){
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
						{ name: 'dispatch_quantity', type: 'number' },
						{ name: 'dealer_price', type: 'number' },
						{ name: 'picklist_no', type: 'number' },
						{ name: 'order_id', type: 'number' },
						{ name: 'picklist_id', type: 'number' },
						{ name: 'dealer_id', type: 'number' },
						{ name: 'sparepart_id', type: 'number' },
						{ name: 'order_no', type: 'number' },
						],
						url: '<?php echo site_url("admin/sparepart_orders/dispatch_spareparts_list_json"); ?>',
						pagesize: defaultPageSize,
						data : {picklist_no:picklist_no},
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
		}
	});

	$('#jqxGridPiList').on('cellvaluechanged', function (event) {
		var rowBoundIndex = event.args.rowindex;
		var rowdata = $('#jqxGridPiList').jqxGrid('getrowdata', rowBoundIndex);

		$.post('<?php echo site_url('admin/sparepart_orders/update_dispatch_quantity') ?>',{id : rowdata.id, dispatch_quantity:rowdata.dispatch_quantity,order_id : rowdata.order_id,picklist_no:rowdata.picklist_no},function(result)
		{
			if(result.success)
			{
				alert('Successfully Updated');
			}

		});

	});

	$('#save_bill').on('click',function(){
		var data = $('#jqxGridPiList').jqxGrid('getrows');
		var vor_percentage = $('#vor_percentage_bill').val();
		var discount_percentage = $('#discount_percentage_bill').val();
		var billed_date = $('#billed_date').val();

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
			url: '<?php echo site_url("admin/sparepart_orders/save_bill"); ?>',
			data: {data : data, vor_percentage:vor_percentage,discount_percentage:discount_percentage},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					$('#jqxGridPiList').jqxGrid('updatebounddata');
					$('#save_bill').hide();
					$('#generate_bill').html('<a href="<?php echo site_url('admin/sparepart_orders/generate_bill');?>/'+result.bill_no+'" class="btn btn-md btn-flat btn-primary">Generate Bill</a>');
				}
				$('#jqxGridPiList').unblock();
			}
		});
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
				url: '<?php echo site_url("admin/sparepart_orders/delete_item_picklist"); ?>',
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