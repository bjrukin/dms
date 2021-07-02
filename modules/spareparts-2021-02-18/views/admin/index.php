<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('spareparts'); ?></li>
		</ol>

		<form action="<?php echo base_url('spareparts/excel_import') ?>" method="post" enctype="multipart/form-data">
			<div class="col-md-1"><label>Update Parts: </label></div>
			<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
			<div class="col-md-2"><button>Excel Import</button></div>
		</form>
	</section>

	<?php //if(is_admin()): ?>
		<!-- <form action="<?php echo base_url('spareparts/check_sparepart_exist') ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
						<div class="col-md-2"><button>Read</button></div>
					</form> -->

<?php //endif; ?>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSparepartToolbar' class='grid-toolbar'>
					<form action="<?php echo base_url('spareparts/import_new_parts') ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-1"><label>New Parts: </label></div>
						<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
						<div class="col-md-2"><button>Read</button></div>
					</form>


					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSparepartInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSparepartFilterClear"><?php echo lang('general_clear'); ?></button>
					<button type="button" class="btn btn-success btn-flat btn-xs" data-toggle="modal" data-target="#ExportModal">Export All</button>
				</div>
				<div id="jqxGridSparepart"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSparepart">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-spareparts', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "spareparts_id"/>
		<table class="form-table">
			<tr>
				<td><label for='spareparts_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
				<td><input id='spareparts_name' class='text_input' name='name'></td>
			</tr>
			<tr>
				<td><label for='category'>Category<span class='mandatory'>*</span></label></td>
				<td><div id='category' name='category'></div></td>
			</tr>
			<tr>
				<td><label for='part_code'><?php echo lang('part_code')?><span class='mandatory'>*</span></label></td>
				<td><input id='part_code' class='text_input' name='part_code'></td>
			</tr>
			<tr>
				<td><label for='alternate_part_code'><?php echo lang('alternate_part_code')?></label></td>
				<td><div id='alternate_part_code' name='alternate_part_code'></div></td>
				<!-- <td><input id='alternate_part_code' class='text_input' name='alternate_part_code'></td> -->
			</tr>
			<tr>
				<td><label for='latest_part_code'><?php echo lang('latest_part_code')?></label></td>
				<td><div id='latest_part_code' name='latest_part_code'></div></td>
				<!-- <td><input id='latest_part_code' class='text_input' name='latest_part_code'></td> -->
			</tr>
			<tr>
				<td><label for='moq'><?php echo lang('moq')?></label></td>
				<td><input id='moq' class='text_input' name='moq'></td>
			</tr>
			<tr>
				<td><label for='uom'><?php echo lang('uom')?></label></td>
				<td><input id='uom' class='text_input' name='uom'></td>
			</tr>
			<tr>
				<td><label for='price'><?php echo lang('price')?></label></td>
				<td><input id='price' class='text_input' name='price'></td>
			</tr>
			<tr>
				<td><label for='dealer_price'><?php echo lang('dealer_price')?></label></td>
				<td><input id='dealer_price' class='text_input' name='dealer_price'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSparepartSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSparepartCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
			
		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="ExportModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Export Modal</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/1/15000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 1-15000</a>
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/15001/30000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 15001-30000</a>
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/30001/45000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 30001-45000</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/45001/60000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 45001-60000</a>
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/60001/75000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 60001-75000</a>
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/75001/90000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 75001-90000</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/90001/105000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 90001-105000</a>
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/105001/120000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 105001-120000</a>
						<a href="<?php echo site_url('admin/spareparts/excel_export_all/120001/135000') ?>" type="button" class="btn btn-success btn-flat btn-md">Export 120001-135000</a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

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
				if ($("#alternate_part_code").jqxComboBox('searchString') != undefined) {
					data.part_code_startsWith = $("#alternate_part_code").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#alternate_part_code").jqxComboBox({
			source: StockAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "part_code",
			valueMember: "part_code",
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

		var masterDataSource = {
			url : '<?php echo site_url("admin/spareparts/cat_list_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		CatAdapter = new $.jqx.dataAdapter(masterDataSource);

		$("#category").jqxComboBox({
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: CatAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		LatestStockAdapter = new $.jqx.dataAdapter(StockDataSource,
		{
			formatData: function (data) {
				if ($("#latest_part_code").jqxComboBox('searchString') != undefined) {
					data.part_code_startsWith = $("#latest_part_code").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#latest_part_code").jqxComboBox({
			source: LatestStockAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "part_code",
			valueMember: "part_code",
			renderer: function (index, label, value) {
				var item = LatestStockAdapter.records[index];
				if (item != null) {
					var label = item.part_code;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = LatestStockAdapter.records[index];
				if (item != null) {
					var label = item.part_code;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				LatestStockAdapter.dataBind();
			}
		});

		var sparepartsDataSource =
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
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'string' },
			{ name: 'dealer_price', type: 'string' },
			{ name: 'uom', type: 'string' },
			{ name: 'moq', type: 'number' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'alternate_part_code', type: 'string' },
			{ name: 'category_id', type: 'number' },
			
			],
			url: '<?php echo site_url("admin/spareparts/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepartsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSparepart").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepart").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepart").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepartsDataSource,
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
		selectionmode: 'multiplecelladvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSparepartToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editSparepartRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},			
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("alternate_part_code"); ?>',datafield: 'alternate_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("latest_part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("moq"); ?>',datafield: 'moq',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("uom"); ?>',datafield: 'uom',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo "Dealer Price"; ?>',datafield: 'dealer_price',width: 120,filterable: true, cellsformat : 'F2',renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 120,filterable: true, cellsformat : 'F2',renderer: gridColumnsRenderer },
		
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepart").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepartFilterClear', function () { 
		$('#jqxGridSparepart').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSparepartInsert', function () { 
		openPopupWindow('jqxPopupWindowSparepart', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSparepart").jqxWindow({ 
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

	$("#jqxPopupWindowSparepart").on('close', function () {
		reset_form_spareparts();
	});

	$("#jqxSparepartCancelButton").on('click', function () {
		reset_form_spareparts();
		$('#jqxPopupWindowSparepart').jqxWindow('close');
	});

	$('#form-spareparts').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
			rules: [
			{ input: '#spareparts_name', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#spareparts_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		{ input: '#part_code', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#part_code').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},
		{ input: '#part_code', message: 'Part Code must have length of 11 or 15', action: 'blur', 
			rule: function(input) {
				val = $('#part_code').val();
				len = val.length;
				return (len != 11 && len != 15 ) ? false: true;
			}
		},
		{ input: '#part_code', message: 'Part-code already exists', action: 'blur', 
			rule: function(input, commit) {
				val = $("#part_code").val();
				$.ajax({
					url: "<?php echo site_url('admin/spareparts/check_duplicate'); ?>",
					type: 'POST',
					data: {model: 'spareparts/sparepart_model', field: 'part_code', value: val, id:$('input#spareparts_id').val()},
					success: function (result) {
						var result = eval('('+result+')');
						return commit(result.success);
					},
					error: function(result) {
						return commit(false);
					}
				});
			}
		}

]
});

	$("#jqxSparepartSubmitButton").on('click', function () {
        // saveSparepartRecord();
        
        var validationResult = function (isValid) {
        	if (isValid) {
        		saveSparepartRecord();
        	}
        };
        $('#form-spareparts').jqxValidator('validate', validationResult);
        
    });
});

function editSparepartRecord(index){
	var row =  $("#jqxGridSparepart").jqxGrid('getrowdata', index);
	if (row) {
		$('#spareparts_id').val(row.id);
		$('#spareparts_name').val(row.name);
		$('#part_code').val(row.part_code);
		$('#price').val(row.price);
		$('#dealer_price').val(row.dealer_price);
		$('#moq').val(row.moq);
		$('#uom').val(row.uom);
		$('#latest_part_code').val(row.latest_part_code);
		$('#alternate_part_code').val(row.alternate_part_code);
		$('#category').val(row.category_id);
		
		openPopupWindow('jqxPopupWindowSparepart', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSparepartRecord(){
	var alternate_part_code = $('#alternate_part_code').val();
	var latest_part_code = $('#latest_part_code').val();
	var data = $("#form-spareparts").serialize();
	data += '&alternate_part_code=' + alternate_part_code + '&latest_part_code=' + latest_part_code;
	
	$('#jqxPopupWindowSparepart').block({ 
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
		url: '<?php echo site_url("admin/spareparts/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts();
				$('#jqxGridSparepart').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSparepart').jqxWindow('close');
			}
			$('#jqxPopupWindowSparepart').unblock();
		}
	});
}

function reset_form_spareparts(){
	$('#spareparts_id').val('');
	var index = $('#category').jqxComboBox('getSelectedIndex');
	$("#category").jqxComboBox('unselectIndex', index ); 
	var index = $('#latest_part_code').jqxComboBox('getSelectedIndex');
	$("#latest_part_code").jqxComboBox('unselectIndex', index ); 
	var index = $('#alternate_part_code').jqxComboBox('getSelectedIndex');
	$("#alternate_part_code").jqxComboBox('unselectIndex', index ); 
	$('input[name=category][name=alternate_part_code][name=latest_part_code]').val(null);
	$('#form-spareparts')[0].reset();
}
</script>