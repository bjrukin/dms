	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id="jqxPicking_list"></div>
			</div><!-- /.col -->
		</div>
	</section>

	<div id="jqxPopupWindow_Picking_list">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Picklist Items</span>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id='jqxGrid_Picklist_itemsToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPicklist_Insert"><?php echo lang('general_create'); ?></button>
				</div>
				<div id="jqxGrid_Picklist_items"></div>
			</div>
		</div>
	</div>
	<div id="jqxPopupWindowAdd_picklistitem">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Add Item in picklist</span>
		</div>
		<div class="form_fields_area">
			<?php echo form_open('', array('id' => 'form-add_item_picklist', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "proforma_invoice_id" id="proforma_invoice_id_picklist">
			<input type = "hidden" name = "picklist_no" id="picklist_no_picklist" >
			<table class="form-table">
				<tr>
					<td><label for='sparepart_id'>Sparepart Name</label></td>
					<td><div id='sparepart_id_picklist' name='sparepart_id'></div></td>
				</tr>
				<tr>
					<td><label>Quantity</label></td>
					<td><input type="number" name="quantity" class="text_input"></td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPicklistSubmitButton">Add</button>
					</th>
				</tr>

			</table>
			<?php echo form_close(); ?>
		</div>
	</div>


	<script language="javascript" type="text/javascript">


		$(function(){
			var partCounterDataSource = {
				url : '<?php echo site_url("admin/sparepart_orders/get_all_sparepart_combo_json"); ?>',
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
				],
			}

			partCounterAdapter = new $.jqx.dataAdapter(partCounterDataSource,
			{
				formatData: function (data) {
					if ($("#sparepart_id_picklist").jqxComboBox('searchString') != undefined) {
						data.name_startsWith = $("#sparepart_id_picklist").jqxComboBox('searchString');
						return data;
					}
				}
			}
			);

			$("#sparepart_id_picklist").jqxComboBox({
				width: '100%',
				height: 25,
				source: partCounterAdapter,
				remoteAutoComplete: true,
				selectedIndex: 0,
				displayMember: "name",
				valueMember: "id",
				renderer: function (index, label, value) {
					var item = partCounterAdapter.records[index];
					if (item != null) {
						var label = item.name +'|'+item.part_code;
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

			var picklist_Datasource =
			{
				datatype: "json",
				datafields: [
				{ name: 'order_no', type: 'number' },			
				{ name: 'order', type: 'string' },
				{ name: 'dealer_name', type: 'string' },
				{ name: 'pick_count', type: 'number' },
				{ name: 'dealer_id', type: 'number' },
				{ name: 'picklist_no', type: 'number' },
				{ name: 'picklist_format', type: 'string' },
				{ name: 'billed_status', type: 'string' },
				{ name: 'proforma_invoice_id', type: 'number' },

				],
				url: '<?php echo site_url("admin/sparepart_orders/picking_list_json"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				cache: true,
				pager: function (pagenum, pagesize, oldpagenum) {
				},
				beforeprocessing: function (data) {
					picklist_Datasource.totalrecords = data.total;
				},
				filter: function () {
					$("#jqxPicking_list").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#jqxPicking_list").jqxGrid('updatebounddata', 'sort');
				},
				processdata: function(data) {
				}
			};
			
			$("#jqxPicking_list").jqxGrid({
				theme: theme,
				width: '100%',
				height: gridHeight,
				source: picklist_Datasource,
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
				selectionmode: 'multiplecellsadvanced',
				virtualmode: true,
				enableanimations: false,
				pagesizeoptions: pagesizeoptions,
				showtoolbar: true,
				rendertoolbar: function (toolbar) {
					var container = $("<div style='margin: 5px; height:50px'></div>");
					container.append($('#jqxPicking_listToolbar').html());
					toolbar.append(container);
				},
				columns: [
				{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
				{
					text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
					cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
						var rows = $("#jqxPicking_list").jqxGrid('getrowdata', index);
						var e = '';
						e += '<a href="javascript:void(0)" onclick="list_items(' + index + ')" return false;" title="Picklist Items"><i class="fa fa-outdent" aria-hidden="true"></i> &nbsp';				
						e += '<a href="<?php echo site_url('admin/sparepart_orders/print_pickin_list') ?>/'+rows.dealer_id+'/'+rows.order_no+'/'+rows.pick_count+'" title="Print Picklist" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>';				
						return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
					}
				},	
				{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("order"); ?>',datafield: 'order',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("pick_count"); ?>',datafield: 'pick_count',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("picklist_format"); ?>',datafield: 'picklist_format',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("billed_status"); ?>',datafield: 'billed_status',width: 150,renderer: gridColumnsRenderer },
				],
				rendergridrows: function (result) {
					return result.data;
				}
			});
			$("[data-toggle='offcanvas']").click(function(e) {
				e.preventDefault();
				setTimeout(function() {$("#jqxPicking_list").jqxGrid('refresh');}, 500);
			});

			$(document).on('click', '#jqxGridPicklist_Insert', function () {
				openPopupWindow('jqxPopupWindowAdd_picklistitem', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
			});

			// Dealer Order
			$("#jqxPopupWindowAdd_picklistitem").jqxWindow({
				theme: theme,
				width: '75%',
				maxWidth: '75%',
				height: '75%',
				maxHeight: '75%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			$("#jqxPicklistSubmitButton").on('click', function () {
				save_picklist_item();                            
			});
			
			// Dealer Order
			$("#jqxPopupWindow_Picking_list").jqxWindow({
				theme: theme,
				width: '99%',
				maxWidth: '99%',
				height: '90%',
				maxHeight: '90%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});
		});

	function list_items(index)
	{
		var rows = $("#jqxPicking_list").jqxGrid('getrowdata', index);
		$('#proforma_invoice_id_picklist').val(rows.proforma_invoice_id);
		$('#picklist_no_picklist').val(rows.picklist_no);

		var sparepart_Pickinglist =
		{
			datatype: "json",
			datafields: [
			{ name: 'order_no', type: 'number' },			
			{ name: 'order', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'pick_count', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'dispatch_quantity', type: 'number' },
			{ name: 'picklist_no', type: 'number' },
			{ name: 'picklist_id', type: 'number' },
			{ name: 'order_id', type: 'number' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/picking_list_detail_json")?>',
			data: {picklist_no:rows.picklist_no},
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				sparepart_Pickinglist.totalrecords = data.total;
			},
			filter: function () {

			},
			sort: function () {
				$("#jqxGrid_Picklist_items").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGrid_Picklist_items").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: sparepart_Pickinglist,
			altrows: true,
			pageable: true,
			sortable: true,
			rowsheight: 30,
			columnsheight:30,
			showfilterrow: false,
			filterable: false,
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
				container.append($('#jqxGrid_Picklist_itemsToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					var rows = $("#jqxGrid_Picklist_items").jqxGrid('getrowdata', index);
					var e = '';
					e += '<a href="javascript:void(0)" onclick="delete_picklist_item(' + index + ')" return false;" title="Delete Picklist Items"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 200,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 300,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatch_quantity"); ?>',datafield: 'dispatch_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});
		openPopupWindow('jqxPopupWindow_Picking_list', 'Picking List Items');
	}

	function delete_picklist_item(index){
		if(confirm('Are you sure'))
		{
			var rows = $("#jqxGrid_Picklist_items").jqxGrid('getrowdata', index);
			$('#jqxGrid_Picklist_items').block({ 
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
				url: '<?php echo site_url("admin/sparepart_orders/delete_picklist_item"); ?>',
				data: {id : rows.picklist_id},
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						$('#jqxGrid_Picklist_items').jqxGrid('updatebounddata');
						$('#jqxGrid_Picklist_items').unblock();
					}
				}
			});
		}
	}

	function save_picklist_item(){
		var data = $("#form-add_item_picklist").serialize();
		$('#jqxPopupWindowAdd_picklistitem').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/save_picklist_item"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					$('#jqxGrid_Picklist_items').jqxGrid('updatebounddata');
					$('#jqxPopupWindowAdd_picklistitem').unblock();
				}
			}
		});
	}

</script>