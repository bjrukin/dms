<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('target_records'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('target_records'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content"> <!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
					<form action="<?php echo base_url('admin/target_records/import_target_missing') ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
						<div class="col-md-2"><button>Read</button></div>
					</form>
				<div id='jqxGridTarget_recordToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridTarget_recordInsert"><?php echo "Import Target"; ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridTarget_recordFilterClear"><?php echo lang('general_clear'); ?></button>
					<!-- <input type="button" class="btn btn-primary btn-flat" value="Editable Off" id="jqxButton-toggle_edit"> -->


				</div>
				<div id="jqxGridTarget_record"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowTarget_record">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Edit Target</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-target_records', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "target_records_id"/>
		<div id='vehicle_classification' class='number_general' name='vehicle_classification' hidden></div>
		<div id='dealer_id' class='number_general' name='dealer_id' hidden></div>
		<input id='target_year' class='text_input' name='target_year' hidden>
		<!-- <td><div id='revision' class='number_general' name='revision' hidden></div></td> -->
		<table class="form-table">
			<tr>
				<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
				<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
			</tr>
			<tr>
				<td><label for='month'><?php echo lang('month')?></label></td>
				<td><div id='month' class='number_general' name='month' ></div></td>
			</tr>
			<tr>
				<td><label for='quantity'><?php echo lang('quantity')?></label></td>
				<td><div id='quantity' class='number_general' name='quantity'></div></td>
			</tr>
			<tr>
				<td><label for='retail_quantity'><?php echo lang('retail_quantity')?></label></td>
				<td><div id='retail_quantity' class='number_general' name='retail_quantity'></div></td>
			</tr>
			<tr>
				<td><label for='inquiry_target'><?php echo lang('inquiry_target')?></label></td>
				<td><div id='inquiry_target' class='number_general' name='inquiry_target'></div></td>
			</tr>
			
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxTarget_recordSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxTarget_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowImport_Target">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Import Target</span>
	</div>
	<div class="form_fields_area">
		<form action="<?php echo site_url('admin/target_records/import_target')?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-3">
					<label for="dealer"><?php echo lang('dealer_id')?></label>
				</div>
				<div class="col-md-9">
					<div id="dealers_import_id" class="form-control" name="dealers_import_id"></div>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-3">
					<label for="dealer"><?php echo "Filename"; ?></label>
				</div>
				<div class="col-md-9">
					<input type="file" name="userfile">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-flat btn-md btn-success" type="submit">Read</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		//dealers
		$("#vehicle_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: array_vehicles,
			displayMember: "name",
			valueMember: "id",
		});

		var dealerDataSource = {
			url : '<?php echo site_url("admin/target_records/get_dealers_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

		$("#dealers_import_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: dealerDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		var nepali_monthDataSource = {
			url : '<?php echo site_url("admin/target_records/get_nepali_month_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		nepali_monthDataAdapter = new $.jqx.dataAdapter(nepali_monthDataSource);

		$("#month").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: nepali_monthDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		$("#jqxPopupWindowImport_Target").jqxWindow({ 
			theme: theme,
			width: "60%",
			maxWidth: "60%",
			height: "50%",  
			maxHeight: "50%",  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		var target_recordsDataSource =
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
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'vehicle_classification', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'target_year', type: 'string' },
			{ name: 'month', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'retail_quantity', type: 'number' },
			{ name: 'inquiry_target', type: 'number' },
			{ name: 'revision', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'target_month', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/target_records/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	target_recordsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridTarget_record").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridTarget_record").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridTarget_record").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: target_recordsDataSource,
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
			container.append($('#jqxGridTarget_recordToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editTarget_recordRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("month"); ?>',datafield: 'target_month',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("retail_quantity"); ?>',datafield: 'retail_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("inquiry_target"); ?>',datafield: 'inquiry_target',width: 150,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridTarget_record").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridTarget_recordFilterClear', function () { 
		$('#jqxGridTarget_record').jqxGrid('clearfilters');
		$('#jqxGridTarget_record').jqxGrid('updatebounddata');
	});

	$(document).on('click','#jqxGridTarget_recordInsert', function () { 
		openPopupWindow('jqxPopupWindowImport_Target', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowTarget_record").jqxWindow({ 
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

	$("#jqxPopupWindowTarget_record").on('close', function () {
		reset_form_target_records();
	});

	$("#jqxTarget_recordCancelButton").on('click', function () {
		reset_form_target_records();
		$('#jqxPopupWindowTarget_record').jqxWindow('close');
	});

	$("#jqxTarget_recordSubmitButton").on('click', function () {
		saveTarget_recordRecord();
	});


});

function editTarget_recordRecord(index){
	var row =  $("#jqxGridTarget_record").jqxGrid('getrowdata', index);
	if (row) {
		$('#target_records_id').val(row.id);
		$('#vehicle_id').jqxComboBox('val', row.vehicle_id);
		$('#vehicle_id').jqxComboBox({disabled: true,});
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#target_year').val(row.target_year);
		$('#month').jqxComboBox('val', row.month);
		$('#month').jqxComboBox({disabled: true,});
		$('#quantity').jqxNumberInput('val', row.quantity);
		$('#retail_quantity').jqxNumberInput('val', row.retail_quantity);
		$('#inquiry_target').jqxNumberInput('val', row.inquiry_target);
		openPopupWindow('jqxPopupWindowTarget_record', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveTarget_recordRecord(){
	var data = $("#form-target_records").serialize();
	
	$('#jqxPopupWindowTarget_record').block({ 
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
		url: '<?php echo site_url("admin/target_records/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_target_records();
				$('#jqxGridTarget_record').jqxGrid('updatebounddata');
				$('#jqxPopupWindowTarget_record').jqxWindow('close');
			}
			$('#jqxPopupWindowTarget_record').unblock();
		}
	});
}

function reset_form_target_records(){
	$('#target_records_id').val('');
	$('#form-target_records')[0].reset();
}
</script>