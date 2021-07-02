<div class="content-wrapper">
	<!-- Main content -->
	<section class="content"> 
		<h3><?php echo $rows->name; ?></h3>
		<h3>Order No. : <?php echo $rows->prefix.'-'.$order_no; ?></h3>
		<!-- row -->
		<a href="<?php echo site_url('admin/sparepart_orders/generate_pi')."/$order_no/$dealer_id/1"?>" class="btn btn-xs btn-success btn-flat">Excel PI</a>
		<a href="<?php echo site_url('admin/sparepart_orders/generate_pi')."/$order_no/$dealer_id/2"?>" class="btn btn-xs btn-success btn-flat" target="_blank">PDF PI</a>
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div id='jqxOrder_listToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_orderInsert"><?php echo lang('general_create'); ?></button>
				</div>
				<?php echo displayStatus(); ?>
				<div id="jqxOrder_list"></div>
			</div><!-- /.col -->
		</div>
	</section>
</div>
<div id="jqxPopupWindowDealer_order_add">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-add_item', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "order_id" value = "<?php echo $order_no ?>" >
		<input type = "hidden" name = "dealer_id" value = "<?php echo $dealer_id ?>" >
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
			width: '90%',
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


		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_quantity', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'order_no', type: 'number' },
			{ name: 'pi_status', type: 'string' },			

			],
			url: '<?php echo site_url("admin/sparepart_orders/order_list_json")."/$order_no/$dealer_id";?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxOrder_list").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxOrder_list").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	

	$("#jqxOrder_list").jqxGrid({
		theme: theme,
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
		editable: true,
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
			container.append($('#jqxOrder_listToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', editable:false, renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, editable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
				var rows = $("#jqxOrder_list").jqxGrid('getrowdata', index);
				var e = '';
				<?php if(!$pi_data->pi_generated){?>
					e += '<a href="javascript:void(0)" onclick="delete_order(' + index + '); return false;" title="Delete Item"><i class="fa fa-trash" aria-hidden="true"></i>';				
				<?php }?>
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("id"); ?>',datafield: 'id',hidden:true,width: 250,filterable: true, editable:false, renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 250,filterable: true, editable:false, renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true, editable:false, renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'order_quantity',width: 150,filterable: true, editable:true, renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pi_status"); ?>',datafield: 'pi_status',width: 150,filterable: true, editable:false, renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxOrder_list").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxOrder_listFilterClear', function () { 
		$('#jqxOrder_list').jqxGrid('clearfilters');
	});
	$(document).on('click', '#jqxGridDealer_orderInsert', function () {
		openPopupWindow('jqxPopupWindowDealer_order_add', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
	});

	// Dealer Order
	$("#jqxPopupWindowDealer_order_add").jqxWindow({
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
		save_dealer_order_item();                            
	});
});


function delete_order(index){
	if(confirm('Are you sure'))
	{

		var rows = $("#jqxOrder_list").jqxGrid('getrowdata', index);
		$('#jqxOrder_list').block({ 
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
			url: '<?php echo site_url("admin/sparepart_orders/delete_order"); ?>',
			data: {id : rows.id},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					$('#jqxOrder_list').jqxGrid('updatebounddata');
					$('#jqxOrder_list').unblock();
				}
			}
		});
	}
}

function save_dealer_order_item(){
	var data = $("#form-add_item").serialize();
	$('#jqxPopupWindowDealer_order_add').block({ 
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
		url: '<?php echo site_url("admin/sparepart_orders/save_order_item_dealer_incharge"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				$('#jqxOrder_list').jqxGrid('updatebounddata');
				$('#jqxPopupWindowDealer_order_add').unblock();
			}
		}
	});
}

$('#jqxOrder_list').on('cellvaluechanged', function (event) {
	var rowBoundIndex = event.args.rowindex;
	var rowdata = $('#jqxOrder_list').jqxGrid('getrowdata', rowBoundIndex);
	$.post('<?php echo site_url('admin/sparepart_orders/update_order_quantity') ?>',{id : rowdata.id, order_quantity:rowdata.order_quantity},function(result)
	{
		if(result.success)
		{
			alert('Successfully Updated');
		}

	});

});

</script>