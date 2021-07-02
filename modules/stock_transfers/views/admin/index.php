<style type="text/css">
	.cls-complete_transfer {
		background-color: darkseagreen;
	}
	.cls-half_transfer {
		background-color: lightcyan;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('stock_transfers'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('stock_transfers'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridStock_transferToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_transferFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridStock_transfer"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStock_transfer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('', array('id' =>'form-stock_transfers', 'onsubmit' => 'return false')); ?>
				<input type="hidden" name="stock_transfers_id" id="stock_transfers_id">
				<input type="hidden" name="total_stock_transfered" id="total_stock_transfered">
				<input type="hidden" name="dealer_stock_id" id="dealer_stock_id">

				<div class="row">
					<div class="col-md-12">

						<h2><?php echo lang('stock_transfers'); ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4"> <?php echo lang("dealer_name"); ?>: </div>
					<div class="col-md-8"> <div id="dealer_name" class="form-control"></div></div>
					<input type="hidden" name="dealer_id" id="dealer_id">
				</div>
				<div class="row">
					<div class="col-md-4"> <?php echo lang("part_name") ?>: </div>
					<div class="col-md-8"> <div id="part_name" class="form-control"></div></div>
					<input type="hidden" name="sparepart_id" id="sparepart_id">
				</div>
				<div class="row">
					<div class="col-md-4"> <?php echo lang("quantity") ?> (<span id="span_request_quantity"></span>) : </div>
					<div class="col-md-4"> <div id="part_code" class="form-control"></div> </div>
					<div class="col-md-4"> 
						<input type="number" name="" id="remaining_stock" class="form-control" readonly>
						<input type="hidden" name="request_quantity" id="request_quantity" >
					</div>
				</div>
				<hr>
				<h2>From</h2>
				<div class="row">
					<div class="col-md-4"><?php echo lang("stock_from") ?></div>
					<div class="col-md-6"><div id="dealer_list" name="dealer_list"></div></div>
					<div class="col-md-2"><input id="current_stock" name="current_stock" class="form-control" readonly></div>
				</div>
				<div class="row">
					<div class="col-md-4"><?php echo lang("provide_quantity") ?></div>
					<div class="col-md-4"><input id="provide_quantity" name="provide_quantity" class="form-control"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							<button type="button" class="btn btn-flat btn-success" id="submit_transfer_stock"><?php echo lang('general_save'); ?></button>
							<button type="button" class="btn btn-flat btn-default" id="cancel_transfer_stock"><?php echo lang('general_cancel'); ?></button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var stock_transfersDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'dealer_location', type: 'string' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_price', type: 'string' },
			{ name: 'request_quantity', type: 'number' },
			{ name: 'total_stock_transfered', type: 'number' },
			{ name: 'remaining_stock', type: 'number' },
			{ name: 'request_date', type: 'date' },
			{ name: 'request_date_nepali', type: 'string' },
			{ name: 'is_accepted', type: 'number' },
			
			],
			url: '<?php echo site_url("admin/stock_transfers/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stock_transfersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStock_transfer").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStock_transfer").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};

	var cellclassrenderer = function(row, column,value,data) {
		if(data.remaining_stock == 0){
			return 'cls-complete_transfer';
		}
		else if(data.remaining_stock) {
			return 'cls-half_transfer'
		}
		else {
			return '';
		}
	}
	
	$("#jqxGridStock_transfer").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stock_transfersDataSource,
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
			container.append($('#jqxGridStock_transferToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editStock_transferRecord(' + index + '); return false;" title="Transfer"><i class="fa fa-exchange"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("request_quantity"); ?>',datafield: 'request_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("total_stock_transfered"); ?>',datafield: 'total_stock_transfered',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("remaining_stock"); ?>',datafield: 'remaining_stock',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer },
		{ text: '<?php echo lang("request_date"); ?>',datafield: 'request_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd, cellclassname: cellclassrenderer},
		{ text: '<?php echo lang("request_date_nepali"); ?>',datafield: 'request_date_nepali',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer},
		// { text: '<?php echo lang("is_accepted"); ?>',datafield: 'is_accepted',width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridStock_transfer").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStock_transferFilterClear', function () { 
		$('#jqxGridStock_transfer').jqxGrid('clearfilters');
	});

	// initialize the popup window
	$("#jqxPopupWindowStock_transfer").jqxWindow({ 
		theme: theme,
		width: '40%',
		maxWidth: '75%',
		height: '65%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});
	
	$('#form-stock_transfers').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: 
		[{
			input: '#provide_quantity', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#provide_quantity').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} 
		},
		{ 
			input: '#provide_quantity', message: 'Error: Quantity higher than required.', action: 'blur', 
			rule: function(input) {
				val = parseInt($('#provide_quantity').val());
				req = parseInt($('#request_quantity').val());
				cur = parseInt($('#current_stock').val());
				totalstock = parseInt($('#total_stock_transfered').val());

				return (val > req || val > cur) ? false: true;
			}
		},]
	});

	$("#submit_transfer_stock").on('click', function () {
    	// saveStock_transferRecord();

    	var validationResult = function (isValid) {
    		if (isValid) {
    			saveStock_transferRecord();
    		}
    	};
    	$('#form-stock_transfers').jqxValidator('validate', validationResult);

    });

	$('#cancel_transfer_stock').on('click',function() {
		$('#jqxPopupWindowStock_transfer').jqxWindow('close');
	});



});

$(function(){
	$('#dealer_list').change(function(event){
		var args = event.args.item;
		if(args) {
			/*$('#jqxPopupWindowStock_transfer').block();
			var sparepart_id = $('#sparepart_id').val();
			$.post('<?php echo site_url('admin/stock_transfers/get_stock_by_dealer') ?>',{dealer_id: args.value, sparepart_id: sparepart_id}, function(result){
				$('#current_stock').val(result.row.quantity);
				$('#jqxPopupWindowStock_transfer').unblock();
			},'json');*/
			var dealer_list =  $("#dealer_list").jqxComboBox('getItems');
			quantity = dealer_list[0]['originalItem']['quantity'];
			$('#current_stock').val(quantity);

		}
	});

});

function editStock_transferRecord(index){
	var row =  $("#jqxGridStock_transfer").jqxGrid('getrowdata', index);
	console.log(row);
	if (row) {
		$('#stock_transfers_id').val(row.id);
		$('#dealer_id').val(row.dealer_id);
		$('#dealer_name').text(row.dealer_name);
		$('#sparepart_id').val(row.sparepart_id);
		$('#part_code').text(row.latest_part_code);
		$('#part_name').text(row.part_name);
		$('#request_quantity').val(row.request_quantity);
		$('#span_request_quantity').text(row.request_quantity);
		$('#total_stock_transfered').val(row.total_stock_transfered);
		$('#remaining_stock').val(row.remaining_stock);
		// $('#provide_quantity').val(row.request_quantity);
		// $('#request_date').jqxDateTimeInput('setDate', row.request_date);
		// $('#request_date_nepali').jqxDateTimeInput('setDate', row.request_date_nepali);
		// $('#is_accepted').jqxNumberInput('val', row.is_accepted);
		

		var dealerListDataSource = {
			url : '<?php echo site_url("admin/stock_transfers/get_spareparts_dealers_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'dealer_quantity', type: 'string' },
			{ name: 'quantity', type: 'number' },
			{ name: 'dealer_stock_id', type: 'number' },
			],
			type: 'post',
			data: {part_id: row.sparepart_id},
			async: false,
			cache: true
		}

		dealerListAdapter = new $.jqx.dataAdapter(dealerListDataSource);

		$("#dealer_list").jqxComboBox({
			theme: theme,
			width: '100%',
			// height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: dealerListAdapter,
			displayMember: "dealer_quantity",
			valueMember: "id",
			placeHolder: "Select Service Type"
		});

		var dealer_stock_id =  $("#dealer_list").jqxComboBox('getItems');
		console.log(dealer_stock_id);
		if(dealer_stock_id.length !== 0 ) {
			dealer_stock_id = dealer_stock_id[0]['originalItem']['dealer_stock_id'];
			$('#dealer_stock_id').val(dealer_stock_id);
		}

		openPopupWindow('jqxPopupWindowStock_transfer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');

	}
}


function saveStock_transferRecord(){
	var data = $("#form-stock_transfers").serialize();

	var provide_quantity = $('#provide_quantity').val();

	if(! provide_quantity ) {
		$('#provide_quantity').focus();
		return;
	}
	
	$('#jqxPopupWindowStock_transfer').block({ 
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
		url: '<?php echo site_url("admin/stock_transfers/save_transfer_stock"); ?>',
		data: data ,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				// reset_form_stock_transfers();
				$('#jqxGridStock_transfer').jqxGrid('updatebounddata');
				$('#jqxPopupWindowStock_transfer').jqxWindow('close');
			}
			$('#jqxPopupWindowStock_transfer').unblock();
		}
	});
}

</script>