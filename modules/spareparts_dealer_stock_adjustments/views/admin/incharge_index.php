<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_dealer_stock_adjustments'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('spareparts_dealer_stock_adjustments'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridApprove_stock_adjustmentToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridApprove_stock_adjustmentInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridApprove_stock_adjustmentFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridApprove_stock_adjustment"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_dealer_stock_adjustment">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-approve_stock_adjustment', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "spareparts_dealer_stock_adjustments_id"/>
		<input type = "hidden" name = "sparepart_id" id = "sparepart_id_approve"/>
		<input type = "hidden" name = "dealer_id" id = "dealer_id"/>
		<table class="form-table">
			<tr>
				<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
				<td><input id='sparepart_id' class="text_input" readonly="readonly"></td>
			</tr>
			<tr>
				<td><label for='old_stock'><?php echo lang('old_stock')?></label></td>
				<td><div id='old_stock' class='number_general' readonly="readonly"></div></td>
			</tr>
			<tr>
				<td><label for='new_stock'><?php echo lang('new_stock')?></label></td>
				<td><div id='new_stock' name="new_stock" class='number_general' readonly="readonly"></div></td>
			</tr>
			<tr>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><input id='remarks' class='text_area' readonly="readonly"></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-md btn-flat" id="jqxSpareparts_dealer_stock_adjustmentApproveButton" value="accept"><?php echo "Approve"//lang('general_save'); ?>&nbsp<i class="fa fa-check"></i></button>
					<button type="button" class="btn btn-default btn-md btn-flat" id="jqxSpareparts_dealer_stock_adjustmentRejectButton" value="reject"><?php echo "Reject"//lang('general_cancel'); ?>&nbsp<i class="fa fa-times"></i></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var spareparts_dealer_stock_adjustmentsDataSource =
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
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'old_stock', type: 'number' },
			{ name: 'new_stock', type: 'number' },
			{ name: 'remarks', type: 'string' },
			{ name: 'requested_by', type: 'number' },
			{ name: 'requested_date', type: 'date' },
			{ name: 'requested_date_np', type: 'number' },
			{ name: 'approved_by', type: 'number' },
			{ name: 'approved_date', type: 'date' },
			{ name: 'approved_date_np', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/spareparts_dealer_stock_adjustments/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_dealer_stock_adjustmentsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridApprove_stock_adjustment").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridApprove_stock_adjustment").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridApprove_stock_adjustment").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_dealer_stock_adjustmentsDataSource,
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
			container.append($('#jqxGridApprove_stock_adjustmentToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="approve_Stockadjustment(' + index + '); return false;" title="Approve"><i class="fa fa-check"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		<?php if(is_sparepart_incharge()):?>
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		<?php endif;?>
		{ text: '<?php echo lang("latest_part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("old_stock"); ?>',datafield: 'old_stock',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("new_stock"); ?>',datafield: 'new_stock',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("requested_by"); ?>',datafield: 'requested_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("requested_date"); ?>',datafield: 'requested_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("approved_by"); ?>',datafield: 'approved_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("approved_date"); ?>',datafield: 'approved_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridApprove_stock_adjustment").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridApprove_stock_adjustmentFilterClear', function () { 
		$('#jqxGridApprove_stock_adjustment').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridApprove_stock_adjustmentInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_dealer_stock_adjustment', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSpareparts_dealer_stock_adjustment").jqxWindow({ 
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

	$("#jqxPopupWindowSpareparts_dealer_stock_adjustment").on('close', function () {
		reset_form_spareparts_dealer_stock_adjustments();
	});

	$("#jqxSpareparts_dealer_stock_adjustmentRejectButton").on('click', function () {
		var status = $(this).val();
		saveApprove_adjustment(status);
	});

	
	$("#jqxSpareparts_dealer_stock_adjustmentApproveButton").on('click', function () {
		var status = $(this).val();
		saveApprove_adjustment(status);
	});
});

function approve_Stockadjustment(index){
	var row =  $("#jqxGridApprove_stock_adjustment").jqxGrid('getrowdata', index);
	if (row) {
		$('#spareparts_dealer_stock_adjustments_id').val(row.id);
		$('#sparepart_id_approve').val(row.sparepart_id);
		$('#dealer_id').val(row.dealer_id);
		$('#sparepart_id').val(row.part_code);
		$('#new_stock').jqxNumberInput('val', row.new_stock);
		$('#old_stock').jqxNumberInput('val', row.old_stock);
		$('#remarks').val(row.remarks);
		
		openPopupWindow('jqxPopupWindowSpareparts_dealer_stock_adjustment', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveApprove_adjustment(status){
	var data = $("#form-approve_stock_adjustment").serialize();
	
	$('#jqxPopupWindowSpareparts_dealer_stock_adjustment').block({ 
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
		url: '<?php echo site_url("admin/spareparts_dealer_stock_adjustments/approve_stockadjustment");?>/'+status,
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_dealer_stock_adjustments();
				$('#jqxGridApprove_stock_adjustment').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_dealer_stock_adjustment').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_dealer_stock_adjustment').unblock();
		}
	});
}

function reset_form_spareparts_dealer_stock_adjustments(){
	$('#spareparts_dealer_stock_adjustments_id').val('');
	$('#form-approve_stock_adjustment')[0].reset();
}
</script>