<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('foc_requests'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('foc_requests'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<!-- <div id='jqxGridFoc_requestToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridFoc_requestInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridFoc_requestFilterClear"><?php echo lang('general_clear'); ?></button>
				</div> -->
				<div id="jqxGridFoc_request"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowFoc_request">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-foc_requests', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "foc_requests_id"/>
		<table class="form-table">
			<tr>
				<td><label for='foc_request_part'><?php echo lang('foc_request_part')?></label></td>
				<td><div id='foc_request_part' name='foc_approved_part'></div></td>
			</tr>												
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxFoc_requestSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxFoc_requestCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var foc_requestsDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'foc_request_part', type: 'string' },
			{ name: 'foc_approved_part', type: 'string' },
			{ name: 'request_date', type: 'date' },
			{ name: 'request_date_nep', type: 'string' },
			{ name: 'approved_date', type: 'date' },
			{ name: 'approved_date_nep', type: 'string' },
			{ name: 'full_name', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/foc_requests/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	foc_requestsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridFoc_request").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridFoc_request").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridFoc_request").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: foc_requestsDataSource,
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
			container.append($('#jqxGridFoc_requestToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editFoc_requestRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("customer_id"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("request_date"); ?>',datafield: 'request_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		// { text: '<?php echo lang("request_date_nep"); ?>',datafield: 'request_date_nep',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("approved_date"); ?>',datafield: 'approved_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		// { text: '<?php echo lang("approved_date_nep"); ?>',datafield: 'approved_date_nep',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridFoc_request").jqxGrid('refresh');}, 500);
	});

	// $(document).on('click','#jqxGridFoc_requestFilterClear', function () { 
	// 	$('#jqxGridFoc_request').jqxGrid('clearfilters');
	// });

	// $(document).on('click','#jqxGridFoc_requestInsert', function () { 
	// 	openPopupWindow('jqxPopupWindowFoc_request', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	// });

	// initialize the popup window
	$("#jqxPopupWindowFoc_request").jqxWindow({ 
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

	$("#jqxPopupWindowFoc_request").on('close', function () {
		reset_form_foc_requests();
	});

	$("#jqxFoc_requestCancelButton").on('click', function () {
		reset_form_foc_requests();
		$('#jqxPopupWindowFoc_request').jqxWindow('close');
	});

	$("#jqxFoc_requestSubmitButton").on('click', function () {
		saveFoc_requestRecord();

	});
});

function editFoc_requestRecord(index){
	var row =  $("#jqxGridFoc_request").jqxGrid('getrowdata', index);
	if (row) {		
		$('#foc_requests_id').val(row.id);
		var AccessoriesDataSource  = {
			url : '<?php echo site_url("admin/foc_requests/get_foc_request"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },			
			],
			data : {id : row.id},			
			async: false,
			cache: true
		}	

		AccessoriesDataAdapter = new $.jqx.dataAdapter(AccessoriesDataSource);
		$("#foc_request_part").jqxComboBox({
			source: AccessoriesDataAdapter,
			theme: 'energyblue',
			width: '225px',
			height: '25px',
			searchMode:'endswith',
			checkboxes:true,
			displayMember: "name",
			placeHolder: 'Select Accessories',
			valueMember: "id"

		});
		openPopupWindow('jqxPopupWindowFoc_request', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveFoc_requestRecord(){
	var data = $("#form-foc_requests").serialize();
	
	$('#jqxPopupWindowFoc_request').block({ 
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
		url: '<?php echo site_url("admin/foc_requests/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_foc_requests();
				$('#jqxGridFoc_request').jqxGrid('updatebounddata');
				$('#jqxPopupWindowFoc_request').jqxWindow('close');
			}
			$('#jqxPopupWindowFoc_request').unblock();
		}
	});
}

function reset_form_foc_requests(){
	$('#foc_requests_id').val('');
	$('#form-foc_requests')[0].reset();
}
</script>