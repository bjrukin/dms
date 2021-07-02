<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_goods_returns_request'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('spareparts_goods_returns_request'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_goods_returnToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_goods_returnInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_goods_returnFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_goods_return"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_goods_return">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-spareparts_goods_returns', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "spareparts_goods_returns_id"/>
		<input type = "hidden" name = "dealer_stock" id = "dealer_stock"/>
		<div class="row form-group">
			<div class="col-md-2"><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></div>
			<div class="col-md-10"><div id='sparepart_id' name='sparepart_id'></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"><label for='quantity'><?php echo lang('quantity')?></label></div>
			<div class="col-md-10"><input type="text" class="text_input" id='quantity' name='quantity'"></div>
		</div>	
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-10">
				<div id="error_div" class="jqx-validator-error-label" style="display: none" ><label>Not Enough Quantity</label></div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"><label for='damage'><?php echo lang('damage')?></label></div>
			<div class="col-md-10"><div id='damage' name='damage'></div></div>
		</div>

		<div class="row form-group">
			<div class="col-md-2"><label for='reason'><?php echo lang('reason')?></label></div>
			<div class="col-md-10"><input id='reason' class='text_area' name='reason'></div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_goods_returnSubmitButton"><?php echo lang('general_save'); ?></button>
				<button type="button" class="btn btn-danger btn-xs btn-flat" id="jqxSpareparts_goods_returnCancelButton"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>
	</tr>
	<?php echo form_close(); ?>
</div>
</div>

<div id="jqxPopupWindowSpareparts_goods_return_approve">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Approve Request</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-goods_returns_approve', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "goods_returns_id_approve"/>
		<div class="row form-group">
			<div class="col-md-2"><label for='part_code'><?php echo lang('latest_part_code')?></label></div>
			<div class="col-md-4"><div id='part_code_approve'></div></div>
			<div class="col-md-2"><label for='part_name'><?php echo lang('part_name')?></label></div>
			<div class="col-md-4"><div id='part_name_approve'></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"><label for='quantity'><?php echo lang('quantity')?></label></div>
			<div class="col-md-4"><div id='quantity_approve'></div></div>
			<div class="col-md-2"><label for="dealer_name"><?php echo lang('dealer_id')?></label></div>	
			<div class="col-md-4"><div id="dealer_name_approve"></div></div>	
		</div>
		<div class="row form-group">
			<div class="col-md-2"><label for="request_user"><?php echo lang('employee_name')?></label></div>	
			<div class="col-md-4"><div id="request_user_approve"></div></div>	
			<div class="col-md-2"><label for='reason'><?php echo lang('reason')?></label></div>
			<div class="col-md-4"><div id='reason_approve'></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_goods_return_approveSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
				<button type="button" class="btn btn-danger btn-xs btn-flat" id="jqxSpareparts_goods_return_approveCancelButton"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>
	</tr>
	<?php echo form_close(); ?>
</div>
</div>

<script language="javascript" type="text/javascript">
	
	$(function(){

		$("#damage").jqxCheckBox({ width: 120, height: 25 });

		var partCounterDataSource = {
			url : '<?php echo site_url("admin/spareparts/get_spareparts_dealer_stock_combo_json"); ?>',
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
			width: 325,
			height: 25,
			source: partCounterAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "part_name",
			valueMember: "sparepart_id",
			renderer: function (index, label, value) {
				var item = partCounterAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = partCounterAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				partCounterAdapter.dataBind();
			}
		});

/*		$('#quantity').change(function(){
			var sparepart_id = $('#sparepart_id').val();
			var quantity = $(this).val();
			$.post('<?php echo site_url('spareparts_goods_returns/check_stock') ?>',{sparepart_id : sparepart_id},function(result){
				$('#dealer_stock').val(result.quantity);
			},'json');
		});
		*/

		var spareparts_goods_returnsDataSource =
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
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'reason', type: 'string' },
			{ name: 'requeted_by', type: 'number' },
			{ name: 'request_date', type: 'date' },
			{ name: 'request_date_np', type: 'string' },
			{ name: 'accepted_by', type: 'number' },
			{ name: 'accepted_date', type: 'date' },
			{ name: 'accepted_date_np', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'dealer_stock', type: 'number' },
			{ name: 'is_damage', type: 'number' },
			{ name: 'damage', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/spareparts_goods_returns/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_goods_returnsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_goods_return").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_goods_return").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_goods_return").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_goods_returnsDataSource,
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
			container.append($('#jqxGridSpareparts_goods_returnToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '';
				<?php if(!is_admin()): ?>
				e += '<a href="javascript:void(0)" onclick="editSpareparts_goods_returnRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp';
				<?php endif; ?>
				<?php if(is_admin()): ?>
				e += '<a href="javascript:void(0)" onclick="approve_request(' + index + '); return false;" title="Approve Request"><i class="fa fa-check"></i></a>';
				<?php endif; ?>
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("latest_part_code"); ?>',datafield: 'latest_part_code',width: 140,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 200,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 90,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("reason"); ?>',datafield: 'reason',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("requeted_by"); ?>',datafield: 'requeted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("request_date"); ?>',datafield: 'request_date',width: 110,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		/*{ text: '<?php echo lang("accepted_by"); ?>',datafield: 'accepted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("accepted_date"); ?>',datafield: 'accepted_date',width: 110,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},*/
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSpareparts_goods_return").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_goods_returnFilterClear', function () { 
		$('#jqxGridSpareparts_goods_return').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_goods_returnInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_goods_return', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSpareparts_goods_return").jqxWindow({ 
		theme: theme,
		width: '60%',
		maxWidth: '60%',
		height: '60%',  
		maxHeight: '60%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSpareparts_goods_return").on('close', function () {
		reset_form_spareparts_goods_returns();
	});

	$("#jqxSpareparts_goods_returnCancelButton").on('click', function () {
		reset_form_spareparts_goods_returns();
		$('#jqxPopupWindowSpareparts_goods_return').jqxWindow('close');
	});

	// initialize the approve pop up window
	$("#jqxPopupWindowSpareparts_goods_return_approve").jqxWindow({ 
		theme: theme,
		width: '65%',
		maxWidth: '65%',
		height: '65%',  
		maxHeight: '65%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSpareparts_goods_return_approve").on('close', function () {
		reset_form_spareparts_goods_returns();
	});

	$("#jqxSpareparts_goods_return_approveCancelButton").on('click', function () {
		reset_form_spareparts_goods_returns();
		$('#jqxPopupWindowSpareparts_goods_return_approve').jqxWindow('close');
	});
	$("#jqxSpareparts_goods_return_approveSubmitButton").on('click', function () {
		saveSpareparts_goods_return_approve();
	});

	$('#form-spareparts_goods_returns').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [
		{ input: '#quantity', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#quantity').val();
			return (val == '' || val == null || val == 0) ? false: true;
		} },
		{ input: '#quantity', message: 'Not enough Stock', action: 'blur', 
		rule: function(input) {
			var sparepart_id = $('#sparepart_id').val();
			var quantity = $('#quantity').val();
			var part_details = $('#sparepart_id').jqxComboBox('getSelectedItem')['originalItem'];
			return (quantity > part_details.quantity) ? false: true;
		} },

		{ input: '#reason', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#reason').val();
			return (val == '' || val == null || val == 0) ? false: true;
		} },
		]
	});

	$("#jqxSpareparts_goods_returnSubmitButton").on('click', function () {
		var validationResult = function (isValid) {
			if (isValid) {
				saveSpareparts_goods_returnRecord();
			}
		};
		$('#form-spareparts_goods_returns').jqxValidator('validate', validationResult);

	});
});

function editSpareparts_goods_returnRecord(index){
	var row =  $("#jqxGridSpareparts_goods_return").jqxGrid('getrowdata', index);
	if (row) {
		$('#spareparts_goods_returns_id').val(row.id);
		$('#sparepart_id').jqxComboBox('val', row.sparepart_id);
		$('#quantity').val(row.quantity);
		$('#reason').val(row.reason);
		openPopupWindow('jqxPopupWindowSpareparts_goods_return', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function approve_request(index){
	var row =  $("#jqxGridSpareparts_goods_return").jqxGrid('getrowdata', index);
	if (row) {
		$('#goods_returns_id_approve').val(row.id);
		$('#part_name_approve').html(row.part_name);
		$('#part_code_approve').html(row.latest_part_code);
		$('#quantity_approve').html(row.quantity);
		$('#dealer_name_approve').html(row.dealer_name);
		$('#request_user_approve').html(row.request_user);
		$('#reason_approve').html(row.reason);
		openPopupWindow('jqxPopupWindowSpareparts_goods_return_approve', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>'); 
	}
}

function saveSpareparts_goods_returnRecord(){
	var data = $("#form-spareparts_goods_returns").serialize();
	
	$('#jqxPopupWindowSpareparts_goods_return').block({ 
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
		url: '<?php echo site_url("admin/spareparts_goods_returns/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_goods_returns();
				$('#jqxGridSpareparts_goods_return').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_goods_return').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_goods_return').unblock();
		}
	});
}

function reset_form_spareparts_goods_returns(){
	$('#spareparts_goods_returns_id').val('');
	$('#form-spareparts_goods_returns')[0].reset();
}

function saveSpareparts_goods_return_approve(){
	var data = $("#form-goods_returns_approve").serialize();
	
	$('#jqxPopupWindowSpareparts_goods_return_approve').block({ 
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
		url: '<?php echo site_url("admin/spareparts_goods_returns/save_return_approve"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_goods_returns();
				$('#jqxGridSpareparts_goods_return').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_goods_return_approve').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_goods_return_approve').unblock();
		}
	});
}
</script>