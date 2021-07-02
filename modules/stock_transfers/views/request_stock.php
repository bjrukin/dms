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
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_transferInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_transferFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridRequest_Stock_transfer"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="jqxPopupWindowStock_transfer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<h2>Request</h2>
		<hr>
		<?php echo form_open('', array('id' =>'form-stock_transfers', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "stock_transfers_id"/>
		<div class="row form-group">
			<div class="col-md-4"><?php echo lang('sparepart_id','sparepart_id')?></div>
			<div class="col-md-8"><div id='sparepart_id' class='form-control' name='sparepart_id'></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><?php echo lang('request_quantity','request_quantity')?></div>
			<div class="col-md-4"><input id='request_quantity' class='form-control' name='request_quantity'></div>
		</div>
		<div class="row form-group">
			<div class="pull-right">
				<button type="button" class="btn btn-success  btn-flat" id="jqxStock_transferSubmitButton"><?php echo lang('general_save'); ?></button>
				<button type="button" class="btn btn-default  btn-flat" id="jqxStock_transferCancelButton"><?php echo lang('general_cancel'); ?></button>

			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var request_stockDataSource =
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
			url: '<?php echo site_url("admin/stock_transfers/request_stock_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	request_stockDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridRequest_Stock_transfer").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridRequest_Stock_transfer").jqxGrid('updatebounddata', 'sort');
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
	
	$("#jqxGridRequest_Stock_transfer").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: request_stockDataSource,
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
			cellsrenderer: function (index,a,b,c,d,row) {
				var e = '<a href="javascript:void(0)" onclick="editStock_transferRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				if( row.total_stock_transfered > 0) {
					e = '';	
				}
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassrenderer  },
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
		setTimeout(function() {$("#jqxGridRequest_Stock_transfer").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStock_transferFilterClear', function () { 
		$('#jqxGridRequest_Stock_transfer').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStock_transferInsert', function () { 
		openPopupWindow('jqxPopupWindowStock_transfer', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowStock_transfer").jqxWindow({ 
		theme: theme,
		width: '30%',
		maxWidth: '75%',
		height: '50%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowStock_transfer").on('close', function () {
		reset_form_stock_transfers();
	});

	$("#jqxStock_transferCancelButton").on('click', function () {
		reset_form_stock_transfers();
		$('#jqxPopupWindowStock_transfer').jqxWindow('close');
	});

    $('#form-stock_transfers').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [

			{ input: '#sparepart_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sparepart_id').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#request_quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#request_quantity').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxStock_transferSubmitButton").on('click', function () {
    	// saveStock_transferRecord();
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStock_transferRecord();
                }
            };
        $('#form-stock_transfers').jqxValidator('validate', validationResult);
        
    });

    var partDataSource = {
    	url : '<?php echo site_url("admin/stock_transfers/get_spareparts_combo_json"); ?>',
    	datatype: 'json',
    	datafields: [
    	{ name: 'id', type: 'number' },
    	{ name: 'name', type: 'string' },
    	],
    }

    partAdapter = new $.jqx.dataAdapter(partDataSource,
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
    	width: 195,
    	height: 25,
    	source: partAdapter,
    	remoteAutoComplete: true,
    	selectedIndex: 0,
    	displayMember: "name",
    	valueMember: "id",
    	minLength: 4,
    	renderer: function (index, label, value) {
    		var item = partAdapter.records[index];
    		if (item != null) {
    			var label = item.name + "(" + item.name + ", " + item.name + ")";
    			return label;
    		}
    		return "";
    	},
    	renderSelectedItem: function(index, item)
    	{
    		var item = partAdapter.records[index];
    		if (item != null) {
    			var label = item.name;
    			return label;
    		}
    		return "";   
    	},
    	search: function (searchString) {
    		partAdapter.dataBind();
    	}
    });


});

function editStock_transferRecord(index){
	var row =  $("#jqxGridRequest_Stock_transfer").jqxGrid('getrowdata', index);
	if (row) {
		$('#stock_transfers_id').val(row.id);
		// $('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#sparepart_id').val(row.sparepart_id);
		$('#request_quantity').val(row.request_quantity);
		// $('#request_date').jqxDateTimeInput('setDate', row.request_date);
		// $('#request_date_nepali').jqxDateTimeInput('setDate', row.request_date_nepali);
		// $('#is_accepted').jqxNumberInput('val', row.is_accepted);
		
		openPopupWindow('jqxPopupWindowStock_transfer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveStock_transferRecord(){
	var data = $("#form-stock_transfers").serialize();
	
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
		url: '<?php echo site_url("admin/stock_transfers/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_stock_transfers();
				$('#jqxGridRequest_Stock_transfer').jqxGrid('updatebounddata');
				$('#jqxPopupWindowStock_transfer').jqxWindow('close');
			}
			$('#jqxPopupWindowStock_transfer').unblock();
		}
	});
}

function reset_form_stock_transfers(){
	$('#stock_transfers_id').val('');
	$('#form-stock_transfers')[0].reset();
}
</script>