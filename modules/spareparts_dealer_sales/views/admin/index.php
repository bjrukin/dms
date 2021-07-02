<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_dealer_sales'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('spareparts_dealer_sales'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_dealer_saleToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_dealer_saleInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_dealer_saleFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_dealer_sale"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_dealer_sale">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-spareparts_dealer_sales', 'onsubmit' => 'return false')); ?>
		<div id="section">
			<div class="row">
				<div class="col-md-8">
					<fieldset>
						<legend>Details</legend>
						<div class="row">
							<div class="col-md-1"><label for="party_name">Choose Party</label></div>
							<div class="col-md-8"><div id="party_name" name="party_id"></div></div>
							<div class="col-md-3"><a class ="btn btn-md btn-flat btn-warning" href="<?php  echo site_url('admin/user_ledgers') ?>" target="_blank">Create Party</a></div>			
						</div>
						<br/>
						<br/>
						<div class="row">	
							<div class="col-md-1"><label for="bill_date">Bill Date:</label></div>
							<div class="col-md-5"><div id="bill_date" name="bill_date"></div></div>
							<div class="col-md-1"><label for="vat_bill">Vat Bill No.</label></div>
							<div class="col-md-5"><input type="text" class="text_input" name="vat_bill_no"></div>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-2"><button type="button" class="btn btn-primary btn-flat btn-md" id="jqxGridSpareparts_listInsert"><?php echo lang('add_parts'); ?></button></div>
						</div>
					</fieldset>
				</div>
				<div class="col-xs-12 connectedSortable">
					<?php echo displayStatus(); ?>
					<div class="create_section" id="jqxGridSpareparts_list"></div>
					<div class="create_section">
						<fieldset>
							<legend>Billing Amount</legend>
							<div class="row">
								<div class="col-md-2"><label>Total Taxable Amount</label></div>
								<div class="col-md-1"><input type="text" name="taxable_total" class="text_input" id="taxable_total" readonly="readonly"></div>
							</div>
							<div class="row">
								<div class="col-md-2"><label>Discount(%)</label></div>
								<div class="col-md-1"><input type="number" name="discount" class="text_input" id="discount_add"></div>
							</div>
							<div class="row">
								<div class="col-md-2"><label>Vat(13%)</label></div>
								<div class="col-md-1"><input type="text" name="vat_amount" id="vat_amount" class="text_input" readonly="readonly"></div>
							</div>
							<div class="row">
								<div class="col-md-2"><label>Grand Total</label></div>
								<div class="col-md-1"><input type="text" name="total_amount" id="grand_total" class="text_input" readonly="readonly"></div>
							</div>
						</fieldset>
					</div>
				</div><!-- /.col -->
			</div>
		</div>
		<div class="create_section">
			<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_dealer_saleSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_dealer_saleCancelButton"><?php echo lang('general_cancel'); ?></button>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<div id="jqxPopupWindowSpareparts_list">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Add Spareparts</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-spareparts_lists', 'onsubmit' => 'return false')); ?>
		<table class="form-table">
			<tr>
				<td><label for="sparepart"><?php echo lang('sparepart')?></label></td>
				<td><div id = "spareparts_list" name = "sparepart_id" ></div></td>
			</tr>
			<tr>
				<td><label for="part_name"><?php echo lang('part_name');?></label></td>
				<td><input type="text" name="part_name" id="part_name" class="text_input" readonly="true"></td>
			</tr>
			<tr>
				<td><label for="price"><?php echo lang('price');?></label></td>
				<td class="price_field" style="display: none;">Rs.<input type="text" name="price" readonly="readonly" id="price" class="text_input"></td>
			</tr>
			<tr>
				<td><label for="quantity"><?php echo lang('quantity');?></label></td>
				<td><input type="text" class="text_input" name="quantity"  id="quantity"></td>
			</tr>
			<tr>
				<td><label for="discount_percentage"><?php echo lang('discount_percentage');?></label></td>
				<td><input type="text" class="text_input" name="discount_percentage"  id="discount_percentage" value="0"></td>
			</tr>
		</table>

		<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_listSubmitButton"><?php echo lang('add_btn'); ?></button>
		<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_listCancelButton"><?php echo lang('general_close'); ?></button>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowDealer_sales">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Display Sales</span>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div><span><h3>Parts List</h3></span></div>
			<div id="jqxGrid_dealer_sales_section"></div>
		</div>
	</div>

</div>

<script type="text/javascript" src= "<?php echo base_url('assets/js/custom_getFormData.js');?>"></script>
<script language="javascript" type="text/javascript">

	var total_amount = 0;
	var grand_total = 0;
	var vat_amount = 0;
	$(function(){

		$("#bill_date").jqxDateTimeInput({ width: '250px', height: '34px', formatString: "yyyy-MM-dd" });

		var ledgerDataSource = {
			url : '<?php echo site_url("admin/spareparts_dealer_sales/party_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'full_name', type: 'string' },
			{ name: 'party_name', type: 'string' },
			],
		}

		ledgerDataAdapter = new $.jqx.dataAdapter(ledgerDataSource, {
			formatData: function (data) {
				if ($("#party_name").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#party_name").jqxComboBox('searchString');
					return data;
				}
			}
		});

		$("#party_name").jqxComboBox({
			width: '100%',
			height: 35,
			source: ledgerDataAdapter,
			minLength: 3,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "party_name",
			valueMember: "id",
			renderer: function (index, label, value) {
				var item = ledgerDataAdapter.records[index];
				if (item != null) {
					var label = item.party_name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = ledgerDataAdapter.records[index];
				if (item != null) {
					var label = item.party_name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				ledgerDataAdapter.dataBind();
			}
		});

		var sparepart_listDataSource = {
			url : '<?php echo site_url("admin/spareparts_dealer_sales/dealer_sparepart_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			],
			async: false,
			cache: true
		}

		spareparts_listDataAdapter = new $.jqx.dataAdapter(sparepart_listDataSource);

		$("#spareparts_list").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: spareparts_listDataAdapter,
			displayMember: "part_code",
			valueMember: "sparepart_id"
		});

		$("#spareparts_list").bind('select', function (event) {

			if (!event.args)
				return;
			var user = $('#party_name').val();
			var item = event.args.item.originalItem;
			$.post('<?php echo site_url('spareparts_dealer_sales/get_item_price') ?>',{id:item.sparepart_id,user:user},function(result)
			{	
				$('.price_field').show();
				$('#price').val(result.price);
				$('#part_name').val(result.name);
			},'JSON');
		});

		var spareparts_dealer_salesDataSource =
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
			{ name: 'total_amount', type: 'number' },
			{ name: 'date', type: 'date' },
			{ name: 'nep_date', type: 'string' },
			{ name: 'discount', type: 'string' },
			{ name: 'party_id', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'bill_no', type: 'number' },
			{ name: 'taxable_total', type: 'number' },
			{ name: 'vat_amount', type: 'number' },
			{ name: 'total_quantity', type: 'number' },
			{ name: 'bill', type: 'string' },
			{ name: 'name', type: 'string' },

			],
			url: '<?php echo site_url("admin/spareparts_dealer_sales/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_dealer_salesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_dealer_sale").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_dealer_sale").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_dealer_sale").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_dealer_salesDataSource,
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
			container.append($('#jqxGridSpareparts_dealer_saleToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row =  $("#jqxGridSpareparts_dealer_sale").jqxGrid('getrowdata', index);
				var e = '';
				e += '<a href="javascript:void(0)" onclick="editSpareparts_dealer_saleRecord(' + index + '); return false;" title="View Item List"><i class="fa fa-list"></i></a>&nbsp';
				e += '<a href="<?php echo site_url('spareparts_dealer_sales/generate_bill')?>/'+row.id+'/'+row.dealer_id+'" title="Print Bill" target="_blank"><i class="fa fa-eye"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("nep_date"); ?>',datafield: 'nep_date',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("party"); ?>',datafield: 'name',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'total_quantity',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("taxable_total"); ?>',datafield: 'taxable_total',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("discount"); ?>',datafield: 'discount',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vat_amount"); ?>',datafield: 'vat_amount',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSpareparts_dealer_sale").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_dealer_saleFilterClear', function () { 
		$('#jqxGridSpareparts_dealer_sale').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_dealer_saleInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_dealer_sale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	var spareparts_listDataSource =
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
		{ name: 'taxable_total', type: 'number' },
		{ name: 'sparepart_id', type: 'number' },
		{ name: 'part_name', type: 'string' },
		{ name: 'part_code', type: 'string' },
		{ name: 'quantity', type: 'number' },
		{ name: 'price', type: 'number' },
		{ name: 'discount_percentage', type: 'number' },

		],
		
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_listDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_dealer_sale").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_dealer_sale").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_list").jqxGrid({
		theme: theme,
		width: '100%',
		height: '70%',
		source: spareparts_listDataSource,
		altrows: true,
		pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight:30,
		showfilterrow: true,
		filterable: true,
		editable : true,
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
			container.append($('#jqxGridSpareparts_listToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', editable:false, cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},		
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false,editable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="delete_row(' + index + '); return false;" title="Delete"><i class="fa fa-trash"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 250,filterable: true,editable:false,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 250,filterable: true,editable:false,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',width: 150,filterable: true,editable:false,cellsalign:'center',renderer: gridColumnsRenderer, hidden : true },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,editable:false,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,editable:false,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("discount_percentage"); ?>',datafield: 'discount_percentage',width: 150,filterable: true,editable:true,cellsalign:'center',renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("taxable_total"); ?>',datafield: 'taxable_total',width: 150,filterable: true,editable:false,cellsalign:'center',renderer: gridColumnsRenderer },
		{
				text: 'Total Amount', datafield: 'taxable_total', sortable:false , width:200, filterable:false, align: 'center' , cellsalign: 'right', 
				cellsrenderer: function (index) {
					var row = $("#jqxGridSpareparts_list").jqxGrid('getrowdata', index);
					var e = ((row.price * row.quantity) - (row.price * row.quantity) * row.discount_percentage / 100);
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
		setTimeout(function() {$("#jqxGridSpareparts_list").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_listFilterClear', function () { 
		$('#jqxGridSpareparts_list').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_listInsert', function () { 
		// console.log($('#party_id').val())
		if($('#party_name').val() == '' || $('#party_name').val() == null){
			alert('Please provide party info first');
			return false;
		}
		openPopupWindow('jqxPopupWindowSpareparts_list', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	$("#jqxGrid_dealer_sales_section").jqxGrid({
		theme: theme,
		width: '100%',
		height: '70%',
		source: spareparts_listDataSource,
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
			container.append($('#jqxGridAddSparepart_Toolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 250,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 250,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("discount_percentage"); ?>',datafield: 'discount_percentage',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("taxable_total"); ?>',datafield: 'taxable_total',width: 150,filterable: true,cellsalign:'center',renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});


	// initialize the popup window
	$("#jqxPopupWindowDealer_sales").jqxWindow({ 
		theme: theme,
		width: '90%',
		maxWidth: '90%',
		height: '95%',  
		maxHeight: '95%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSpareparts_dealer_sale").jqxWindow({ 
		theme: theme,
		width: '90%',
		maxWidth: '90%',
		height: '95%',  
		maxHeight: '95%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSpareparts_dealer_sale").on('close', function () {
		reset_form_spareparts_dealer_sales();
	});

	$("#jqxSpareparts_dealer_saleCancelButton").on('click', function () {
		reset_form_spareparts_dealer_sales();
		$('#jqxPopupWindowSpareparts_dealer_sale').jqxWindow('close');
	});

	$("#jqxPopupWindowSpareparts_list").jqxWindow({ 
		theme: theme,
		width: '50%',
		maxWidth: '50%',
		height: '50%',  
		maxHeight: '50%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSpareparts_list").on('close', function () {
		//reset_form_spareparts_lists();
	});

	$("#jqxSpareparts_listCancelButton").on('click', function () {
		// reset_form_spareparts_lists();
		$('#jqxPopupWindowSpareparts_list').jqxWindow('close');
	});

	


	$('#form-spareparts_lists').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [
		{ input: '#quantity', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#quantity').val();
			return (val == '' || val == null || val == 0) ? false: true;
		}},
		{ input: '#discount_percentage', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#discount_percentage').val();
			return (val == '' || val == null) ? false: true;
		}},
		{ input: '#discount_percentage', message: 'Discount Percentage cannot exceed 12%', action: 'blur', 
		rule: function(input) {
			val = $('#discount_percentage').val();
			return (val > 12) ? false: true;
		}},
		{ input: '#quantity', message: 'Quantity Exceeds', action: 'blur', 
		rule: function(input,commit) {
			val = $('#quantity').val();
			var sparepart_id = $('#spareparts_list').val();
			if (val != '') {
				$.ajax({
					url: "<?php echo site_url('admin/spareparts_dealer_sales/check_stock_quantity'); ?>",
					type: 'POST',
					data: {sparepart_id:sparepart_id,quantity:val},
					success: function (result) {
						var result = eval('('+result+')');
						return commit(result.success);
					},
					error: function(result) {
						return commit(false);
					}
				});
			} else {
				return true;
			}
		}},]
	});
	$("#jqxSpareparts_listSubmitButton").on('click', function () {

		var validationResult = function (isValid) {
			if (isValid) {
				sales_grid();
			}
		};
		$('#form-spareparts_lists').jqxValidator('validate', validationResult);

	});

	$("#jqxSpareparts_dealer_saleSubmitButton").on('click', function () {
		saveSpareparts_dealer_saleRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSpareparts_dealer_saleRecord();
                }
            };
        $('#form-spareparts_dealer_sales').jqxValidator('validate', validationResult);
        */
    });

	$("#jqxGridSpareparts_list").on('cellvaluechanged', function (event) 
	{
		calculate_grid_amount();		
	});
});

// discount add
$('#discount_add').change(function()
{
	var discount = $('#discount_add').val();
	var discount_amount = (parseFloat(total_amount * discount)/100);
	var amt_after_discount =  total_amount - discount_amount;
	vat_amount = (parseFloat(amt_after_discount * 13)/100);
	$('#vat_amount').val(vat_amount);
	$('#grand_total').val(amt_after_discount + vat_amount);
});

function editSpareparts_dealer_saleRecord(index){

	$("#jqxGrid_dealer_sales_section").jqxGrid('clear');
	var row =  $("#jqxGridSpareparts_dealer_sale").jqxGrid('getrowdata', index);
	if (row) {
		$.post('<?php echo site_url('spareparts_dealer_sales/get_dealer_sparepart_list') ?>',{id:row.id},function(result)
		{
			$.each(result,function(i,v)
			{
				datarow = {
					'part_code':v.part_code,
					'part_name':v.part_name,
					'sparepart_id':v.sparepart_id,
					'quantity' :v.quantity ,
					'price' : v.price ,
					'taxable_total' : v.quantity * v.price
				};
				$("#jqxGrid_dealer_sales_section").jqxGrid('addrow', null, datarow);
			});
		},'JSON');

		openPopupWindow('jqxPopupWindowDealer_sales', '<?php echo "Customer Spareparts List"; ?>');
	}
}

function saveSpareparts_dealer_saleRecord(){

	var data = getFormData('form-spareparts_dealer_sales');
	var allrows = $('#jqxGridSpareparts_list').jqxGrid('getrows');
	
	$('#jqxPopupWindowSpareparts_dealer_sale').block({ 
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
		url: '<?php echo site_url("admin/spareparts_dealer_sales/save"); ?>',
		data: {formdata:data, griddata:allrows},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_dealer_sales();
				$('#jqxGridSpareparts_dealer_sale').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_dealer_sale').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_dealer_sale').unblock();
		}
	});
}

function reset_form_spareparts_dealer_sales(){
	$('#spareparts_dealer_sales_id').val('');
	$('#form-spareparts_dealer_sales')[0].reset();
	$("#jqxGridSpareparts_list").jqxGrid('clear');
}

function delete_row(index)
{
	var rows = $("#jqxGridSpareparts_list").jqxGrid('getrowdata',index);
	$("#jqxGridSpareparts_list").jqxGrid('deleterow', rows.uid);
	calculate_grid_amount();
}

function sales_grid()
{
	var item = $("#spareparts_list").jqxComboBox('getItemByValue', $('#spareparts_list').val());
	datarow = {
		'sparepart_id':$('#spareparts_list').val(),
		'part_name':item.originalItem.name,
		'part_code':item.originalItem.part_code,
		'quantity' : $('#quantity').val(),
		'price' : $('#price').val(),
		'discount_percentage' : (parseFloat($('#discount_percentage').val())),
		'taxable_total' : (parseFloat($('#price').val()) * parseInt($('#quantity').val()) - (parseFloat($('#price').val()) * parseInt($('#quantity').val())) * parseFloat($('#discount_percentage').val())/100)
	};
	$("#jqxGridSpareparts_list").jqxGrid('addrow', null, datarow);
	calculate_grid_amount();
}

function calculate_grid_amount()
{
	var rows = $('#jqxGridSpareparts_list').jqxGrid('getrows');
	total_amount = 0;
	vat_amount = 0;
	grand_total = 0;
	$.each(rows,function(i,v)
	{		
		amount = parseFloat(v.price) * parseInt(v.quantity);
		discount_amount = (parseFloat(amount) * parseInt(v.discount_percentage) / 100);
		total_amount = total_amount + (parseFloat(amount) - parseFloat(discount_amount));
		vat_amount = ((parseFloat(total_amount) * 13)/100);
		grand_total = parseFloat(total_amount) + parseFloat(vat_amount);

	});

	$('#taxable_total').val(total_amount);
	$('#vat_amount').val(vat_amount);
	$('#grand_total').val(grand_total);

	$("#spareparts_list").jqxComboBox('clearSelection');
	$('#part_name').val('');
	$('#price').val('');
	$('#quantity').val('');
}
</script>