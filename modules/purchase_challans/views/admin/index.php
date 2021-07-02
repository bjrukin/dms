<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('purchase_challans'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('purchase_challans'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPurchase_challanToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPurchase_challanInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPurchase_challanFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridPurchase_challan"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPurchase_challan">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-purchase_challans', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "purchase_challans_id"/>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-3"> <label for='challan_date'><?php echo lang('challan_date')?></label> </div>
					<div class="col-md-3"> <div id='challan_date' class='date_box form-control' name='challan_date'></div> </div>
				</div>
				<div class="row">
					<div class="col-md-3"><label for='challan_no'><?php echo lang('challan_no')?></label></div>
					<div class="col-md-3"><input id='challan_no' class='form-control' name='challan_no' readonly></div>
				</div>
				<div class="row">
					<div class="col-md-3"><label for='supplier_challan_no'><?php echo lang('supplier_challan_no')?></label></div>
					<div class="col-md-6"><input id='supplier_challan_no' class='form-control' name='supplier_challan_no'></div>
				</div>
				<div class="row">
					<div class="col-md-3"><label for='supplier_challan_date'><?php echo lang('supplier_challan_date')?></label></div>
					<div class="col-md-3"><div id='supplier_challan_date' class='date_box form-control' name='supplier_challan_date'></div></div>
				</div>
				<div class="row">
					<div class="col-md-3"><label for='supplier_id'><?php echo lang('supplier_id')?></label></div>
					<div class="col-md-9"><div id='supplier_id' class='form-control' name='supplier_id'></div></div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<fieldset>
						<legend>Status</legend>
						<!-- <label for='challan_status'><?php echo lang('challan_status')?></label> -->
						<div class="col-md-6">
							<label for="challan_status1"><input type="radio" name="challan_status" id="challan_status1" value="Recieved">Recieved</label>
						</div>
						<div class="col-md-6">
							<label for="challan_status2"><input type="radio" name="challan_status" id="challan_status2" value="In Transit">In Transit</label>
						</div>
					</fieldset>
				</div>
				<div class="row">
					<div class="col-md-4"><label for='order_no'><?php echo lang('order_no')?></label></div>
					<div class="col-md-8"><input id='order_no' class='form-control' name='order_no'></div>
				</div>
				<div class="row">
					<div class="col-md-4">BIN No.</div>
					<div class="col-md-7"><div class="form-control"></div></div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="jqxGrid_challan_itemsToolbar" class='grid-toolbar'>
					<button type="button" class="btn btn-flat btn-sm" onclick="add_challan_item(0)">Add Challan</button>
				</div>
				<div id="jqxGrid_challan_items"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<label for='remarks'><?php echo lang('remarks')?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5"><label for='total_item'><?php echo lang('total_item')?></label></div>
					<div class="col-md-7"><input id='total_item' class='form-control' name='total_item'></div>
				</div>

			</div>
			<div class="col-md-9"><textarea id='remarks' class='form-control' name='remarks' ></textarea></div>
		</div>
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="btn-group btn-group-sm pull-right">

					<button type="button" class="btn btn-success btn-flat" id="jqxPurchase_challanSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-flat" id="jqxPurchase_challanCancelButton"><?php echo lang('general_cancel'); ?></button>
				</div>

			</div>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowPurchase_challan_items">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Add Parts</span>
	</div>
	<div>
		<form id="form-challan_items"  class="form-inline">
			<div class="row">
				<div class="col-md-12">
					<?php echo ("part"); ?>
					<div name="part_id" class="form-control" id="part_id"></div>
				</div>
				<div class="col-md-12">
					<?php echo ('quantity'); ?>
					<input type="text" name="quantity" class="form-control">
				</div>
				<div class="col-md-12">Ord. Pre.<input type="text" name="order_pre" class="form-control"></div>
				<div class="col-md-12">Ord. No. <input type="text" name="order_no" class="form-control"></div>
				<div class="col-md-12">Bin No. <input type="text" name="bin_no" class="form-control"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-flat btn-sm" onclick="add_challan_item(1)">Add Item</button>
				</div>
			</div>

		</form>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_getFormData.js"></script>
<script language="javascript" type="text/javascript">

	$(function(){

		// $('.jqxradio_challan_status').jqxRadioButton({groupName :"challan_status", boxSize:"10px" });

		var purchase_challansDataSource =
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
			{ name: 'challan_date', type: 'string' },
			{ name: 'challan_no', type: 'number' },
			{ name: 'supplier_challan_no', type: 'number' },
			{ name: 'supplier_challan_date', type: 'string' },
			{ name: 'supplier_id', type: 'number' },
			{ name: 'challan_status', type: 'string' },
			{ name: 'order_no', type: 'number' },
			{ name: 'remarks', type: 'string' },
			{ name: 'total_item', type: 'string' },

			],
			url: '<?php echo site_url("admin/purchase_challans/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	purchase_challansDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPurchase_challan").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPurchase_challan").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPurchase_challan").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: purchase_challansDataSource,
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
			container.append($('#jqxGridPurchase_challanToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editPurchase_challanRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("challan_date"); ?>',datafield: 'challan_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("challan_no"); ?>',datafield: 'challan_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("supplier_challan_no"); ?>',datafield: 'supplier_challan_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("supplier_challan_date"); ?>',datafield: 'supplier_challan_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("supplier_id"); ?>',datafield: 'supplier_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("challan_status"); ?>',datafield: 'challan_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_item"); ?>',datafield: 'total_item',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridPurchase_challan").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPurchase_challanFilterClear', function () { 
		$('#jqxGridPurchase_challan').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPurchase_challanInsert', function () { 
		$.post('<?php echo site_url('purchase_challans/get_challan_no'); ?>', function(id){
			$('#challan_no').val(id);
			$('#challan_no').focus();
		});
		openPopupWindow('jqxPopupWindowPurchase_challan', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowPurchase_challan").jqxWindow({ 
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

	$("#jqxPopupWindowPurchase_challan").on('close', function () {
		reset_form_purchase_challans();
	});

	$("#jqxPurchase_challanCancelButton").on('click', function () {
		reset_form_purchase_challans();
		$('#jqxPopupWindowPurchase_challan').jqxWindow('close');
	});

    /*$('#form-purchase_challans').jqxValidator({
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

			{ input: '#challan_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#challan_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#supplier_challan_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#supplier_challan_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#supplier_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#supplier_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#challan_status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#challan_status').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#order_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#order_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remarks', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remarks').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#total_item', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#total_item').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxPurchase_challanSubmitButton").on('click', function () {
    	savePurchase_challanRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   savePurchase_challanRecord();
                }
            };
        $('#form-purchase_challans').jqxValidator('validate', validationResult);
        */
    });

    var supplierDataSource =
    {
    	datatype: "json",
    	datafields: [
    	{ name: 'id' },
    	{ name: 'name' }
    	],
    	url: '<?php echo site_url('purchase_challans/get_supplier_json'); ?>',
    	async: true
    };
    var supplierdataAdapter = new $.jqx.dataAdapter(supplierDataSource);
    $("#supplier_id").jqxComboBox({
    	source: supplierdataAdapter, 
    	valueMember: "id", 
    	displayMember: "name", 
    	width: '97%', 
    	height: '34px',
    	autoDropDownHeight: true,
    	theme: theme,
    	selectionMode: 'dropDownList',
    	placeHolder: "Select",
    });

    var partDataSource = {
    	url : '<?php echo site_url("purchase_challans/sparepart_list_json"); ?>',
    	datatype: 'json',
    	datafields: [
    	{ name: 'id', type: 'number' },
    	{ name: 'name', type: 'string' },
    	],
    }

    var partAdapter = new $.jqx.dataAdapter(partDataSource,
    {
    	formatData: function (data) {
    		if ($("#part_id").jqxComboBox('searchString') != undefined) {
    			data.name_startsWith = $("#part_id").jqxComboBox('searchString');
    			return data;
    		}
    	}
    }
    );

    $("#part_id").jqxComboBox({
    	width: '97%',
    	// height: 25,
    	source: partAdapter,
    	remoteAutoComplete: true,
    	selectedIndex: 0,
    	displayMember: "name",
    	valueMember: "id",
    	theme: theme,
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

function editPurchase_challanRecord(index){
	var row =  $("#jqxGridPurchase_challan").jqxGrid('getrowdata', index);
	if (row) {


		$('#purchase_challans_id').val(row.id);
		$('#challan_date').val(row.challan_date);
		$('#challan_no').val( row.challan_no);
		$('#supplier_challan_no').val(row.supplier_challan_no);
		$('#supplier_challan_date').val(row.supplier_challan_date);
		$('#supplier_id').jqxComboBox('val', row.supplier_id);
		if(row.challan_status == 'Recieved') {
			$('#challan_status1').prop('checked', true);
		}
		else {
			$('#challan_status2').prop('checked', true);
		}
		$('#order_no').val(row.order_no);
		$('#remarks').text(row.remarks);
		$('#total_item').val(row.total_item);
		

		$.post("<?php echo site_url('admin/purchase_challans/get_challan_items')?>",{ id: row.id },function(result){
			$('#jqxGrid_challan_items').jqxGrid('clear');
			$.each(result.rows,function(i,v){
				var datarow = {
					'id'		: 	v.id,
					'part_id'	: 	v.part_id,
					'quantity'	: 	v.quantity,
					'order_pre'	: 	v.order_pre,
					'order_no'	: 	v.order_no,
					'bin_no'	: 	v.bin_no,
				};

				$('#jqxGrid_challan_items').jqxGrid('addrow', null, datarow);
			});

		},'json');

		openPopupWindow('jqxPopupWindowPurchase_challan', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function savePurchase_challanRecord(){
	var data = getFormData("form-purchase_challans");
	var challan_items = $('#jqxGrid_challan_items').jqxGrid('getrows');
	
	$('#jqxPopupWindowPurchase_challan').block({ 
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
		url: '<?php echo site_url("admin/purchase_challans/save"); ?>',
		data: {data, challan_items},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_purchase_challans();
				$('#jqxGridPurchase_challan').jqxGrid('updatebounddata');
				$('#jqxPopupWindowPurchase_challan').jqxWindow('close');
			}
			$('#jqxPopupWindowPurchase_challan').unblock();
		}
	});
}

function reset_form_purchase_challans(){
	$('#purchase_challans_id').val('');
	$('#form-purchase_challans')[0].reset();
}
</script>

<script type="text/javascript">
	$(function(){
		var purchase_challan_itemsDataSource =
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
			{ name: 'part_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'order_pre', type: 'string' },
			{ name: 'order_no', type: 'string' },
			{ name: 'bin_no', type: 'string' },
			// { name: 'challan_date', type: 'date' },
			
			],
			url: '<?php echo site_url("admin/purchase_challans/challan_items_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				purchase_challan_itemsDataSource.totalrecords = data.total;
			},
			filter: function () {
				$("#jqxGrid_challan_items").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#jqxGrid_challan_items").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGrid_challan_items").jqxGrid({
			theme: theme,
			width: '100%',
			height: '300px',
			source: purchase_challan_itemsDataSource,
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
				container.append($('#jqxGrid_challan_itemsToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			/*{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e;
					//  e = '<a href="javascript:void(0)" onclick="add_challan_item(2, ' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},*/
			{ text: '<?php echo ("part_id"); ?>',datafield: 'part_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo ("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo ("order_pre"); ?>',datafield: 'order_pre',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo ("order_no"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo ("bin_no"); ?>',datafield: 'bin_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGrid_challan_items").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGrid_challan_itemsFilterClear', function () { 
			$('#jqxGrid_challan_items').jqxGrid('clearfilters');
		});

		$(document).on('click','#jqxGrid_challan_itemsInsert', function () { 
			openPopupWindow('jqxPopupWindowPurchase_challan', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		$("#jqxPopupWindowPurchase_challan_items").jqxWindow({ 
			theme: theme,
			width: '30%',
			height: '30%',  
			maxWidth: '75%',
			maxHeight: '75%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});
	});

function add_challan_item(t, index = null) {
	if(t == 0) {
		openPopupWindow('jqxPopupWindowPurchase_challan_items', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');

	} else if(t == 1) {

		var challanItems = getFormData('form-challan_items');

		var datarow = {
			'id'					: 0,
			'part_id'				: challanItems.part_id,
			'quantity'				: challanItems.quantity,
			'order_pre'				: challanItems.order_pre,
			'order_no'   			: challanItems.order_no,
			'bin_no'     			: challanItems.bin_no,
		};
		$('#jqxGrid_challan_items').jqxGrid('addrow', null, datarow);

		$('#jqxPopupWindowPurchase_challan_items').jqxWindow('close');

	} /*else if(t == 2) {
		var row =  $("#jqxGrid_challan_items").jqxGrid('getrowdata', index);
		
		$("#form-challan_items").find('input').val(function(i,v){
			return row[this.name];
		});

		openPopupWindow('jqxPopupWindowPurchase_challan_items', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	}*/
}

</script>