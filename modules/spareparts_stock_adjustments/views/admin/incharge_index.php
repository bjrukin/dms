<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_stock_adjustments'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('spareparts_stock_adjustments'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridStock_adjustmentToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_adjustmentInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_adjustmentFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridStock_adjustment"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_stock_adjustment">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-spareparts_stock_adjustments', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "spareparts_stock_adjustments_id"/>
		<input type = "hidden" name = "sparepart_id" id="sparepart_id_approve">
		<table class="form-table">
			<tr>
				<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
				<td><input id ='part_code' class = "text_input" ></td>
			</tr>
			<tr>
				<td><label for='old_stock'><?php echo lang('old_stock')?></label></td>
				<td><div id='old_stock' class='number_general' name='old_stock'></div></td>
			</tr>
			<tr>
				<td><label for='new_stock'><?php echo lang('new_stock')?></label></td>
				<td><div id='new_stock' class='number_general' name='new_stock'></div></td>
			</tr>
			<tr>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><input id='remarks' class='text_input' name='remarks'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-md btn-flat" id="jqxSpareparts_stock_adjustmentApprove" value = "accept"><?php echo 'Approve'; ?><i class="fa fa-check"></i></button>
					<button type="button" class="btn btn-default btn-md btn-flat" id="jqxSpareparts_stock_adjustmentReject" value = "reject"><?php echo 'Reject'; ?><i class="fa fa-times"></i></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowSpareparts_stock_adjustment_detail">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Detail</span>
	</div>
	<div class="form_fields_area">
		<table class="form-table">
			<tr>
				<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
				<td><span id='part_code_detail'></span></td>
			</tr>
			<tr>
				<td><label for='old_stock'><?php echo lang('old_stock')?></label></td>
				<td><span id='old_stock_detail'></span></td>
			</tr>
			<tr>
				<td><label for='new_stock'><?php echo lang('new_stock')?></label></td>
				<td><span id='new_stock_detail'></span></td>
			</tr>
			<tr>
				<td><label for='remarks'>Status</label></td>
				<td><span id='status_detail'></td>
			</tr>
			<tr>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><span id='remarks_detail'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-default btn-md btn-flat" id="jqxSpareparts_close" value = "close"><?php echo 'Close'; ?><i class="fa fa-times"></i></button>
				</th>
			</tr>
		</table>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var spareparts_stock_adjustmentsDataSource =
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
			{ name: 'old_stock', type: 'number' },
			{ name: 'new_stock', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'remarks', type: 'string' },
			{ name: 'approved_by', type: 'number' },
			{ name: 'approved_date', type: 'date' },
			{ name: 'approved_date_np', type: 'number' },
			{ name: 'requested_by', type: 'number' },
			{ name: 'requested_date', type: 'date' },
			{ name: 'status', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/spareparts_stock_adjustments/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_stock_adjustmentsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStock_adjustment").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStock_adjustment").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStock_adjustment").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_stock_adjustmentsDataSource,
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
			container.append($('#jqxGridStock_adjustmentToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index,a,b,c,d,row_data) {
				console.log(row_data);
				if(row_data.status == 'PENDING'){
					var e = '<a href="javascript:void(0)" onclick="approve_Stock_adjustment(' + index + '); return false;" title="Approve"><i class="fa fa-check"></i></a>';
				}else{
					var e = '<a href="javascript:void(0)" onclick="view_Stock_adjustment(' + index + '); return false;" title="Approve"><i class="fa fa-eye"></i></a>';
				}
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("latest_part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("old_stock"); ?>',datafield: 'old_stock',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("new_stock"); ?>',datafield: 'new_stock',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("approved_by"); ?>',datafield: 'approved_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("approved_date"); ?>',datafield: 'approved_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("requested_by"); ?>',datafield: 'requested_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("requested_date"); ?>',datafield: 'requested_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridStock_adjustment").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStock_adjustmentFilterClear', function () { 
		$('#jqxGridStock_adjustment').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStock_adjustmentInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_stock_adjustment', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSpareparts_stock_adjustment").jqxWindow({ 
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

	$("#jqxPopupWindowSpareparts_stock_adjustment").on('close', function () {
		reset_form_spareparts_stock_adjustments();
	});

	// $(document).on('click','#jqxGridStock_adjustmentInsert', function () { 
	// 	openPopupWindow('jqxPopupWindowSpareparts_stock_adjustment_detail', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	// });

	// initialize the popup window
	$("#jqxPopupWindowSpareparts_stock_adjustment_detail").jqxWindow({ 
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

	$("#jqxPopupWindowSpareparts_stock_adjustment_detail").on('close', function () {
		// reset_form_spareparts_stock_adjustments();
	});

	$("#jqxSpareparts_stock_adjustmentReject").on('click', function () {
		var status = $(this).val();
		save_approve_adjustment(status);
	});

	$("#jqxSpareparts_stock_adjustmentApprove").on('click', function () {
		var status = $(this).val();
		save_approve_adjustment(status);
    });

    $("#jqxSpareparts_close").on('click', function () {
    	$('#jqxPopupWindowSpareparts_stock_adjustment_detail').jqxWindow('close');
	});
});

function approve_Stock_adjustment(index){
	var row =  $("#jqxGridStock_adjustment").jqxGrid('getrowdata', index);
	if (row) {
		$('#spareparts_stock_adjustments_id').val(row.id);
		$('#sparepart_id_approve').val(row.sparepart_id);
		$('#part_code').val(row.part_code);
		$('#old_stock').jqxNumberInput('val', row.old_stock);
		$('#new_stock').jqxNumberInput('val', row.new_stock);
		$('#remarks').val(row.remarks);
		
		openPopupWindow('jqxPopupWindowSpareparts_stock_adjustment', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function view_Stock_adjustment(index){
	var row =  $("#jqxGridStock_adjustment").jqxGrid('getrowdata', index);
	if (row) {
		$('#part_code_detail').html(row.part_code);
		$('#old_stock_detail').html(row.old_stock);
		$('#new_stock_detail').html(row.new_stock);
		$('#remarks_detail').html(row.remarks);
		$('#status_detail').html(row.status);
		
		openPopupWindow('jqxPopupWindowSpareparts_stock_adjustment_detail', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function save_approve_adjustment(status){
	var data = $("#form-spareparts_stock_adjustments").serialize();
	
	$('#jqxPopupWindowSpareparts_stock_adjustment').block({ 
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
		url: '<?php echo site_url("admin/spareparts_stock_adjustments/save_stock_adjustment"); ?>/'+status,
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_stock_adjustments();
				$('#jqxGridStock_adjustment').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_stock_adjustment').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_stock_adjustment').unblock();
		}
	});
}

function reset_form_spareparts_stock_adjustments(){
	$('#spareparts_stock_adjustments_id').val('');
	$('#form-spareparts_stock_adjustments')[0].reset();
}
</script>