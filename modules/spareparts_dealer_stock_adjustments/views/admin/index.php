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
				<div id='jqxGridSpareparts_dealer_stock_adjustmentToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_dealer_stock_adjustmentInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_dealer_stock_adjustmentFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_dealer_stock_adjustment"></div>
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
		<?php echo form_open('', array('id' =>'form-spareparts_dealer_stock_adjustments', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "spareparts_dealer_stock_adjustments_id"/>
		<input type = "hidden" name = "old_stock" id="old_stock">
		<table class="form-table">
			<tr>
				<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
				<td><div id='sparepart_id' name='sparepart_id'></div></td>
			</tr>
			<tr>
				<td><label for='new_stock'><?php echo lang('new_stock')?></label></td>
				<td><div id='new_stock' class='number_general' name='new_stock'></div></td>
			</tr>
			<tr>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><input id='remarks' class='text_area' name='remarks'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_dealer_stock_adjustmentSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_dealer_stock_adjustmentCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

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
				console.log(item);
				if (item != null) {
					$('#old_stock').val(item.quantity);
					var label = item.part_name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				partCounterAdapter.dataBind();
			}
		});

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
	    	$("#jqxGridSpareparts_dealer_stock_adjustment").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_dealer_stock_adjustment").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_dealer_stock_adjustment").jqxGrid({
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
			container.append($('#jqxGridSpareparts_dealer_stock_adjustmentToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editSpareparts_dealer_stock_adjustmentRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
		setTimeout(function() {$("#jqxGridSpareparts_dealer_stock_adjustment").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_dealer_stock_adjustmentFilterClear', function () { 
		$('#jqxGridSpareparts_dealer_stock_adjustment').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_dealer_stock_adjustmentInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_dealer_stock_adjustment', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSpareparts_dealer_stock_adjustment").jqxWindow({ 
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

	$("#jqxPopupWindowSpareparts_dealer_stock_adjustment").on('close', function () {
		reset_form_spareparts_dealer_stock_adjustments();
	});

	$("#jqxSpareparts_dealer_stock_adjustmentCancelButton").on('click', function () {
		reset_form_spareparts_dealer_stock_adjustments();
		$('#jqxPopupWindowSpareparts_dealer_stock_adjustment').jqxWindow('close');
	});

    $('#form-spareparts_dealer_stock_adjustments').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#new_stock', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_stock').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
        ]
    });

    $("#jqxSpareparts_dealer_stock_adjustmentSubmitButton").on('click', function () {
    	//saveSpareparts_dealer_stock_adjustmentRecord();
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSpareparts_dealer_stock_adjustmentRecord();
                }
            };
        $('#form-spareparts_dealer_stock_adjustments').jqxValidator('validate', validationResult);
        
    });
});

function editSpareparts_dealer_stock_adjustmentRecord(index){
	var row =  $("#jqxGridSpareparts_dealer_stock_adjustment").jqxGrid('getrowdata', index);
	if (row) {
		$('#spareparts_dealer_stock_adjustments_id').val(row.id);
		$('#sparepart_id').jqxNumberInput('val', row.sparepart_id);
		$('#new_stock').jqxNumberInput('val', row.new_stock);
		$('#remarks').val(row.remarks);
		
		openPopupWindow('jqxPopupWindowSpareparts_dealer_stock_adjustment', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSpareparts_dealer_stock_adjustmentRecord(){
	var data = $("#form-spareparts_dealer_stock_adjustments").serialize();
	
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
		url: '<?php echo site_url("admin/spareparts_dealer_stock_adjustments/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_dealer_stock_adjustments();
				$('#jqxGridSpareparts_dealer_stock_adjustment').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_dealer_stock_adjustment').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_dealer_stock_adjustment').unblock();
		}
	});
}

function reset_form_spareparts_dealer_stock_adjustments(){
	$('#spareparts_dealer_stock_adjustments_id').val('');
	$('#form-spareparts_dealer_stock_adjustments')[0].reset();
}
</script>