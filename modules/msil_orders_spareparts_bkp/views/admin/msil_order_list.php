<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div class="row">
					<div class="col-md-12">
						
					</div>
				</div>
				<?php echo displayStatus(); ?>	
				<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_orderInsert"><?php echo lang('general_create'); ?></button>
				<button id="export_excel" class="btn btn-warning btn-flat btn-xs">Excel Export</button>
				<div id="jqxGridOrderList"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="jqxPopupWindowItem_add">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-add_item', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "order_no" value = "<?php echo $msil_order_no ?>" >
		<table class="form-table">
			<tr>
				<td><label for='sparepart_id'>Sparepart Name</label></td>
				<td><div id='sparepart_id' name='sparepart_id'></div></td>
			</tr>
			<tr>
				<td><label>Quantity</label></td>
				<td><input type="number" name="quantity" class="text_input"></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealer_orderSubmitButton">Add</button>
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
				if ($("#sparepart_id").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#sparepart_id").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#sparepart_id").jqxComboBox({
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


		var msil_ordersDataSource =
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
			{ name: 'part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'remaining_quantity', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_no', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'box_no', type: 'number' },
			{ name: 'reached_date_nepali', type: 'string' },
			{ name: 'reached_date', type: 'string' },
			],
			url: '<?php echo site_url("admin/msil_orders_spareparts/json")."/$msil_order_no";?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	msil_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridOrderList").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridOrderList").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridOrderList").jqxGrid({
		width: '100%',
		height: gridHeight,
		source: msil_ordersDataSource,
		altrows: true,
		pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight:30,
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		editable:true,
		autoshowfiltericon: true,
		columnsreorder: true,
		showstatusbar: true,
		theme:theme,
		statusbarheight: 30,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridOrderListToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer ,editable:false, filterable: false},		
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150, align:'center', cellsalign:'center',editable:false, filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 225, align:'center', cellsalign:'center',editable:false, filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>', datafield: 'quantity', width: 150, cellsalign: 'right', editable:true,cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Qty';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	}, 
		// { text: '<?php echo lang("box_no"); ?>',datafield: 'box_no',width: 150, align:'center', cellsalign:'center', filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("reached_date"); ?>',datafield: 'reached_date',width: 150,filterable: true, align:'center', cellsalign:'center', renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridOrderList").jqxGrid('refresh');}, 500);
	});

	$(document).on('click', '#jqxGridDealer_orderInsert', function () {
		openPopupWindow('jqxPopupWindowItem_add', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
	});

	$("#jqxPopupWindowItem_add").jqxWindow({
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

	$("#jqxDealer_orderSubmitButton").on('click', function () {
		save_add_item();                            
	});
});

$('#jqxGridOrderList').on('cellvaluechanged', function (event) {
	var rowBoundIndex = event.args.rowindex;
	var rowdata = $('#jqxGridOrderList').jqxGrid('getrowdata', rowBoundIndex);

	$.post('<?php echo site_url('admin/msil_orders_spareparts/update_order_quantity') ?>',{id : rowdata.id, quantity:rowdata.quantity},function(result)
	{
		if(result.success)
		{
			alert('Successfully Updated');
		}

	});

});

function save_add_item(){
	var data = $("#form-add_item").serialize();
	$('#jqxPopupWindowItem_add').block({ 
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
		url: '<?php echo site_url("admin/msil_orders_spareparts/save_order_item"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				$('#jqxGridOrderList').jqxGrid('updatebounddata');
				$('#jqxPopupWindowItem_add').unblock();
			}
		}
	});
}

$('#export_excel').click(function()
{
	$("#jqxGridOrderList").jqxGrid('exportdata', 'xls', 'jqxGrid', true, null, true, 'https://www.jqwidgets.com/export_server/save-file.php');
	console.log(data);
});
</script>