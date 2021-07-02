<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('foc_accessoreis_partcodes'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('foc_accessoreis_partcodes'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridFoc_accessoreis_partcodeToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridFoc_accessoreis_partcodeInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridFoc_accessoreis_partcodeFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridFoc_accessoreis_partcode"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowFoc_accessoreis_partcode">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-foc_accessoreis_partcodes', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "foc_accessoreis_partcodes_id"/>
		<table class="form-table">
			<tr>
				<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
				<td><div id='vehicle_id' name='vehicle_id'></div></td>
			</tr>
			<tr>
				<td><label for='foc_accessoreis_partcodes_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
				<td><input id='foc_accessoreis_partcodes_name' class='text_input' name='name'></td>
			</tr>
			<tr>
				<td><label for='part_code'><?php echo lang('part_code')?></label></td>
				<td><input id='part_code' class='text_input' name='part_code'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxFoc_accessoreis_partcodeSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxFoc_accessoreis_partcodeCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

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

		var foc_accessoreis_partcodesDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'modified_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'modified_at', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'vehicle_id', type: 'number' },
			
			],
			url: '<?php echo site_url("admin/foc_accessoreis_partcodes/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	foc_accessoreis_partcodesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridFoc_accessoreis_partcode").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridFoc_accessoreis_partcode").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridFoc_accessoreis_partcode").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: foc_accessoreis_partcodesDataSource,
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
			container.append($('#jqxGridFoc_accessoreis_partcodeToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editFoc_accessoreis_partcodeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridFoc_accessoreis_partcode").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridFoc_accessoreis_partcodeFilterClear', function () { 
		$('#jqxGridFoc_accessoreis_partcode').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridFoc_accessoreis_partcodeInsert', function () { 
		openPopupWindow('jqxPopupWindowFoc_accessoreis_partcode', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowFoc_accessoreis_partcode").jqxWindow({ 
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

	$("#jqxPopupWindowFoc_accessoreis_partcode").on('close', function () {
		reset_form_foc_accessoreis_partcodes();
	});

	$("#jqxFoc_accessoreis_partcodeCancelButton").on('click', function () {
		reset_form_foc_accessoreis_partcodes();
		$('#jqxPopupWindowFoc_accessoreis_partcode').jqxWindow('close');
	});

	$("#jqxFoc_accessoreis_partcodeSubmitButton").on('click', function () {
		saveFoc_accessoreis_partcodeRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveFoc_accessoreis_partcodeRecord();
                }
            };
        $('#form-foc_accessoreis_partcodes').jqxValidator('validate', validationResult);
        */
    });
});

function editFoc_accessoreis_partcodeRecord(index){
	var row =  $("#jqxGridFoc_accessoreis_partcode").jqxGrid('getrowdata', index);
	if (row) {
		$('#foc_accessoreis_partcodes_id').val(row.id);     
		$('#foc_accessoreis_partcodes_name').val(row.name);
		$('#part_code').val(row.part_code);
		$('#vehicle_id').jqxComboBox('val', row.vehicle_id);
		
		openPopupWindow('jqxPopupWindowFoc_accessoreis_partcode', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveFoc_accessoreis_partcodeRecord(){
	var data = $("#form-foc_accessoreis_partcodes").serialize();
	
	$('#jqxPopupWindowFoc_accessoreis_partcode').block({ 
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
		url: '<?php echo site_url("admin/foc_accessoreis_partcodes/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_foc_accessoreis_partcodes();
				$('#jqxGridFoc_accessoreis_partcode').jqxGrid('updatebounddata');
				$('#jqxPopupWindowFoc_accessoreis_partcode').jqxWindow('close');
			}
			$('#jqxPopupWindowFoc_accessoreis_partcode').unblock();
		}
	});
}

function reset_form_foc_accessoreis_partcodes(){
	$('#foc_accessoreis_partcodes_id').val('');
	$('#form-foc_accessoreis_partcodes')[0].reset();
}
</script>