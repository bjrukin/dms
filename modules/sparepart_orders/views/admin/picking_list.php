	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div id='jqxPicking_listToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-success btn-flat btn-xs" id="jqxGridDatewise" data-toggle="modal" data-target="#DatewiseModal">Generate Datewise</button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPicklistFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<?php echo displayStatus(); ?>
				<div id="jqxPicking_list"></div>
			</div><!-- /.col -->
		</div>
	</section>

	<!-------------------- start date wise ------------------>
	<div id="jqxPopupWindow_Datewise">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Select Date Range</span>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('', array('id' =>'form-datewise', 'onsubmit' => 'return false')); ?>
					<div class="row form-group">
						<div class="col-md-2">
							<td><label for='dealer_id_datewise'>Dealer<span class='mandatory'>*</span></label></td>
						</div>
						<div class="col-md-10">
							<td><div id='dealer_id_datewise' name='dealer_id'></div></td>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><label for="start_date">From</label></div>
						<div class="col-md-4"><div id="start_date" class="date_box" name="start_date"></div></div>
						<div class="col-md-2"><label for="end_date">To</label></div>
						<div class="col-md-4"><div id="end_date" class="date_box" name="end_date"></div></div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDatewiseSubmitButton">Generate</button>
							<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDatewiseCancelButton"><?php echo lang('general_cancel'); ?></button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<!----------------- end date wise ---------------------->

	<!-------------------- start date wise list ------------------>
	<div id="jqxPopupWindow_Datewise_pi_list">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Datewise Picklist</span>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('sparepart_orders/generate_datewise_picklist', array('id' =>'form-datewiselist')); ?>
					<input type="hidden" name="start_date" id="start_date_list">
					<input type="hidden" name="end_date" id="end_date_list">
					<input type="hidden" name="dealer_id" id="dealer_id_list">
					<div class="row">
						<div class="col-md-4">
							<label for ='picker'>Picker</label>
						</div>
						<div class="col-md-6">
							<div id="picker_id_datewise" name="picker_id"></div>
						</div>
						<div class="col-md-12"><input type="checkbox" name="all" value="all"> ALL</div>
					</div>
					<div class="row" id="pi_list_datewise"></div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-success btn-xs btn-flat" id="jqxDatewiselistSubmitButton">Generate</button>
							<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDatewiselistCancelButton"><?php echo lang('general_cancel'); ?></button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<!----------------- end date wise list ---------------------->

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
			<input type = "hidden" name = "dealer_id" id="dealer_id_picklist" >
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

			

			var dealer_listSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'id' },
				{ name: 'name' }
				],
				url: '<?php echo site_url('admin/sparepart_orders/get_dealer_list') ?>',
				async: false
			};
			var dealer_listdataAdapter = new $.jqx.dataAdapter(dealer_listSource);
			$("#dealer_id_datewise").jqxComboBox({ 
				selectedIndex: 0, 
				source: dealer_listdataAdapter, 
				displayMember: "name", 
				valueMember: "id", 
				width: 200, 
				height: 25,

			});

			var picklist_Datasource =
			{
				datatype: "json",
				datafields: [
				{ name: 'order_no', type: 'number' },			
				{ name: 'order_text', type: 'string' },
				{ name: 'dealer_name', type: 'string' },
				{ name: 'pick_count', type: 'number' },
				{ name: 'dealer_id', type: 'number' },
				{ name: 'picklist_no', type: 'number' },
				{ name: 'picklist_format', type: 'string' },
				{ name: 'billed_status', type: 'string' },
				{ name: 'proforma_invoice_id', type: 'number' },
				{ name: 'pi_number', type: 'string' },
				{ name: 'picklist_group', type: 'number' },

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
						if(rows.picklist_group > 0){
							e += '<a href="<?php echo site_url('admin/sparepart_orders/print_picklist_group') ?>/'+rows.picklist_group + '" title="Print Picklist" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>';				
						}else{
							e += '<a href="<?php echo site_url('admin/sparepart_orders/print_pickin_list') ?>/'+rows.dealer_id+'/'+rows.order_no+'/'+rows.pick_count+'" title="Print Picklist" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>';				
						}
						return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
					}
				},	
				{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("order"); ?>',datafield: 'order_text',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("pick_count"); ?>',datafield: 'pick_count',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("picklist_format"); ?>',datafield: 'picklist_format',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("billed_status"); ?>',datafield: 'billed_status',width: 150,renderer: gridColumnsRenderer },
				{ text: '<?php echo 'PI Number' ?>',datafield: 'pi_number',width: 150,renderer: gridColumnsRenderer },
				{ text: 'Group',datafield: 'picklist_group',width: 150,renderer: gridColumnsRenderer },
				],
				rendergridrows: function (result) {
					return result.data;
				}
			});
			$("[data-toggle='offcanvas']").click(function(e) {
				e.preventDefault();
				setTimeout(function() {$("#jqxPicking_list").jqxGrid('refresh');}, 500);
			});
		
			$(document).on('click','#jqxGridPicklistFilterClear', function () { 
				$('#jqxPicking_list').jqxGrid('clearfilters');
			});

			$(document).on('click', '#jqxGridPicklist_Insert', function () {
				openPopupWindow('jqxPopupWindowAdd_picklistitem', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
			});

			$(document).on('click','#jqxGridDatewise',function(){
				openPopupWindow('jqxPopupWindow_Datewise', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
			});

			$("#jqxDatewiseCancelButton").on('click', function () {
				reset_Datewise_form();
				$('#jqxPopupWindow_Datewise').jqxWindow('close');
			});

			$("#jqxDatewiselistCancelButton").on('click', function () {
				reset_Datewise_form();
				$('#jqxPopupWindow_Datewise_pi_list').jqxWindow('close');
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

			$("#jqxDatewiseSubmitButton").on('click', function () {
				datewise_picklist();                            
			});

			// $("#jqxDatewiselistSubmitButton").on('click', function () {
			// 	datewiselist_picklist();                            
			// });
			
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

			// Date wise
			$("#jqxPopupWindow_Datewise").jqxWindow({
				theme: theme,
				width: '700px',
				maxWidth: '90%',
				height: '150px',
				maxHeight: '90%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			// Date wise pi_list
			$("#jqxPopupWindow_Datewise_pi_list").jqxWindow({
				theme: theme,
				width: '700px',
				maxWidth: '90%',
				height: '500px',
				maxHeight: '90%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			var pickerSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'id' },
				{ name: 'first_name' }
				],
				url: '<?php echo site_url('admin/sparepart_orders/get_picker_list') ?>',
				async: false
			};

			var pickerdataAdapter = new $.jqx.dataAdapter(pickerSource);
			$("#picker_id_datewise").jqxComboBox({ 
				selectedIndex: 0, 
				source: pickerdataAdapter, 
				displayMember: "first_name", 
				valueMember: "id", 
				width: 200, 
				height: 25,

			});
		});

	function list_items(index)
	{
		var rows = $("#jqxPicking_list").jqxGrid('getrowdata', index);
		$('#proforma_invoice_id_picklist').val(rows.proforma_invoice_id);
		$('#picklist_no_picklist').val(rows.picklist_no);
		$('#dealer_id_picklist').val(rows.dealer_id);

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
			data: {picklist_no:rows.picklist_no,dealer_id:rows.dealer_id},
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
						alert(result.msg)
					}else{
						alert(result.msg)
					}
					$('#jqxGrid_Picklist_items').unblock();
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

<script type="text/javascript">
	function reset_Datewise_form() {
		$('#dealer_id_datewise').jqxComboBox('selectIndex', '-1');
	}
</script>

<script type="text/javascript">
	function datewise_picklist() {
		var data = $("#form-datewise").serialize();
		$('#pi_list_datewise').html('');
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var dealer_id = $('#dealer_id_datewise').val();

		$.post('<?php echo base_url("sparepart_orders/get_pi_list")?>',data,function(result){
			console.log(result);
			$('#start_date_list').val(start_date);
			$('#end_date_list').val(end_date);
			$('#dealer_id_list').val(dealer_id);
			$.each(result,function(key,value){
				console.log(value);
				html = '<div class="col-md-3"><input type="checkbox" value="'+value.proforma_invoice_id+'" name="pi_no[]">' + value.pi_number + '</div>';
				$('#pi_list_datewise').append(html);
			})
			openPopupWindow('jqxPopupWindow_Datewise_pi_list', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
		},'json');
	}
</script>

<script type="text/javascript">
	// function datewiselist_picklist(){
	// 	data = $("#form-datewiselist").serialize();

	// 	$.post('<?php echo base_url("sparepart_orders/get_pi_list")?>',data,function(result){
	// 		console.log(result);
	// 		$.each(result,function(key,value){
	// 			console.log(value);
	// 			html = '<div class="col-md-3"><input type="checkbox" value="'+value.proforma_invoice_id+'">' + value.pi_number + '</div>';
	// 			$('#pi_list_datewise').append(html);
	// 		})
	// 		openPopupWindow('jqxPopupWindow_Datewise_pi_list', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
	// 	},'json');
	// }
</script>