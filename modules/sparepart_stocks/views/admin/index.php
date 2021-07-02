<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('sparepart_stocks'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('sparepart_stocks'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSparepart_stockToolbar' class='grid-toolbar'>
					<form action="<?php echo base_url('sparepart_stocks/import_new_parts') ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
						<div class="col-md-2"><button>Add New</button></div>
					</form>
					<form action="<?php echo base_url('sparepart_stocks/import_update_location') ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
						<div class="col-md-2"><button>Update</button></div>
					</form>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSparepart_stockInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSparepart_stockFilterClear"><?php echo lang('general_clear'); ?></button>
					<!-- <button type="button" class="btn btn-warning btn-flat btn-xs" id="jqxGridSparepart_stockExport"><?php echo "Export" ?></button> -->
					<button class="btn btn-success btn-flat btn-xs"><a href="<?php echo site_url('sparepart_stocks/excel_export_all');?>"><?php echo "Export All" ?></a></button>
					<button class="btn btn-success btn-flat btn-xs"><a href="<?php echo site_url('sparepart_stocks/transfer');?>" target="blank"><?php echo "Transfer Stock" ?></a></button>
				</div>
				<div id="jqxGridSparepart_stock"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSparepart_stock">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-sparepart_stocks', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "sparepart_stocks_id"/>
		<table class="form-table">
			<tr>
				<td><label for='sparepart_code'><?php echo lang('part_code') ?></label></td>
				<td><div id="sparepart_code" name="sparepart_code"></div></td>
			</tr>
			<tr>
				<td><label for='location'><?php echo lang('location')?></label></td>
				<td><input id='location' class='text_input' name='location'></td>
			</tr>							
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSparepart_stockSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSparepart_stockCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
			
		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		var StockDataSource = {
			url : '<?php echo site_url("admin/spareparts_stock_adjustments/sparepart_list_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'stock_quantity', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },
			],
		}

		StockAdapter = new $.jqx.dataAdapter(StockDataSource,
		{
			formatData: function (data) {
				if ($("#sparepart_code").jqxComboBox('searchString') != undefined) {
					data.part_code_startsWith = $("#sparepart_code").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#sparepart_code").jqxComboBox({
			width: 325,
			height: 25,
			source: StockAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "part_code",
			valueMember: "id",
			renderer: function (index, label, value) {
				var item = StockAdapter.records[index];
				if (item != null) {
					var label = item.part_code;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = StockAdapter.records[index];
				if (item != null) {
					var label = item.part_code;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				StockAdapter.dataBind();
			}
		});

		var sparepart_stocksDataSource =
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
			{ name: 'part_code', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'alternate_part_code', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'model', type: 'string' },
			{ name: 'category_id', type: 'string' },
			{ name: 'stock_quantity', type: 'number' },
			{ name: 'uom', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'location', type: 'string' },	
			{ name: 'stockyard_name', type: 'string' },	
			{ name: 'total', type: 'number' },
			{ name: 'category_name', type: 'string' },	
			{ name: 'stock_value', type: 'number' },
			
			],
			url: '<?php echo site_url("admin/sparepart_stocks/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_stocksDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSparepart_stock").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepart_stock").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepart_stock").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepart_stocksDataSource,
		// altrows: true,
		// pageable: true,
		// sortable: true,
		// rowsheight: 30,
		// columnsheight:30,
		// showfilterrow: true,
		// filterable: true,editable:true,
		// columnsresize: true,
		// autoshowfiltericon: true,
		// columnsreorder: true,
		// enableanimations: true,
		// pagesizeoptions: pagesizeoptions,
		// showtoolbar: true,
		// showstatusbar: true,
		// showaggregates: true,

		width: '100%',
		height: gridHeight,
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
		showstatusbar: true,
		theme:theme,
		statusbarheight: 30,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,
		selectionmode: 'multiplecellsadvanced',
		virtualmode :true,
		<?php if(is_sparepart_incharge()):?>
			editable: true,
		<?php endif; ?>
		
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSparepart_stockToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false, editable:false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		<?php if(is_sparepart_incharge()):?>
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false,editable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				// var e = '<a href="javascript:void(0)" onclick="editSparepart_stockRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				var e = '';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		<?php endif; ?>
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("alternate_part_code"); ?>',datafield: 'alternate_part_code',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("latest_part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("category_id"); ?>',datafield: 'category_name',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("stock_quantity"); ?>',datafield: 'stock_quantity',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer,aggregates: ["sum"] , 
			cellsrenderer: function(index, row, columnfield, value, defaulthtml, columnproperties){
				var row = $("#jqxGridSparepart_stock").jqxGrid('getrowdata', index);
				console.log(toString(row.stock_quantity));
				if((row.stock_quantity) < 0){
					return '0';
				}else{
					return '<div style=" margin: 4px;">' + row.stock_quantity + '</div>';
				}
			} 
		},
		{ text: '<?php echo lang("location"); ?>',datafield: 'location',width: 150,filterable: true,editable:true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("stockyard"); ?>',datafield: 'stockyard_name',width: 150,filterable: true,editable:true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer, cellsformat:'F2' },
		{ text: '<?php echo lang("stock_value"); ?>',datafield: 'stock_value',width: 150,filterable: true,editable:false,renderer: gridColumnsRenderer, cellsformat:'F2',aggregates: ["sum"]},
		
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepart_stock").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepart_stockFilterClear', function () { 
		$('#jqxGridSparepart_stock').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSparepart_stockInsert', function () { 
		openPopupWindow('jqxPopupWindowSparepart_stock', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSparepart_stock").jqxWindow({ 
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

	$("#jqxPopupWindowSparepart_stock").on('close', function () {
		reset_form_sparepart_stocks();
	});

	$("#jqxSparepart_stockCancelButton").on('click', function () {
		reset_form_sparepart_stocks();
		$('#jqxPopupWindowSparepart_stock').jqxWindow('close');
	});

    /*$('#form-sparepart_stocks').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#sparepart_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sparepart_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#location', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#location').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#barcode', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#barcode').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#price').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatched_dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatched_dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxSparepart_stockSubmitButton").on('click', function () {
    	saveSparepart_stockRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSparepart_stockRecord();
                }
            };
        $('#form-sparepart_stocks').jqxValidator('validate', validationResult);
        */
    });

    /*$(document).on('click','#jqxGridSparepart_stockExport', function () { 
    	export_gird();
    });*/
});

/*function export_gird()
{
	$("#jqxGridSparepart_stock").jqxGrid('exportdata', 'xls', 'Spareparts Stock', true, null,null,'https://www.jqwidgets.com/export_server/save-file.php');
}*/

$('#jqxGridSparepart_stock').on('cellvaluechanged', function (event) {
	var r = confirm('Do you want to change this location?');
	if(r){
		var rowBoundIndex = event.args.rowindex;
		var column = event.args.datafield;
		var newvalue = event.args.newvalue;
		var rowdata = $('#jqxGridSparepart_stock').jqxGrid('getrowdata', rowBoundIndex);

		$.post('<?php echo site_url('admin/sparepart_stocks/update_data') ?>',{id : rowdata.id,column : column, newvalue:newvalue},function(result)
		{
			if(result.success)
			{
				alert('Location has been modified.')
				// $('#jqxGridSparepart_stock').jqxGrid('updatebounddata');
			}

		},'json');
	}else{
		$('#jqxGridSparepart_stock').jqxGrid('updatebounddata');
	}

});

function editSparepart_stockRecord(index){
	var row =  $("#jqxGridSparepart_stock").jqxGrid('getrowdata', index);
	console.log(id);
	if (row) {
		// $("#sparepart_code").jqxComboBox('addItem', { label: row.part_code, value: row.sparepart_id, checked: true} ); 
		$('#sparepart_stocks_id').val(row.id);
		$('#sparepart_code').jqxComboBox('val', row.part_code);
		$('#location').val(row.location);
		openPopupWindow('jqxPopupWindowSparepart_stock', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSparepart_stockRecord(){
	var data = $("#form-sparepart_stocks").serialize();
	
	$('#jqxPopupWindowSparepart_stock').block({ 
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
		url: '<?php echo site_url("admin/sparepart_stocks/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_sparepart_stocks();
				$('#jqxGridSparepart_stock').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSparepart_stock').jqxWindow('close');
			}else{
				alert(result.msg);
			}
			$('#jqxPopupWindowSparepart_stock').unblock();
		}
	});
}

function reset_form_sparepart_stocks(){
	$('#sparepart_stocks_id').val('');
	$('#form-sparepart_stocks')[0].reset();
}
</script>