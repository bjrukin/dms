<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_stocks'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('dealer_stocks'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDealer_stockToolbar' class='grid-toolbar'>
					<?php if(is_admin()) : ?>
						<form action="<?php echo base_url('dealer_stocks/stock_import') ?>" method="post" enctype="multipart/form-data">
						<!-- <form action="<?php echo base_url('dealer_stocks/stock_location_import') ?>" method="post" enctype="multipart/form-data"> -->
							<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
							<div class="col-md-2"><button>Read</button></div>
						</form>
					<?php endif ; ?>
					<?php if(is_admin() || $dealer_id == 81 || $dealer_id == 120 || $dealer_id == 121  || $dealer_id == 122) : ?>
					
						<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_stockInsert"><?php echo lang('general_create'); ?></button>
						<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDealer_stockFilterClear"><?php echo lang('general_clear'); ?></button>
					<?php endif ; ?>
				</div>
				<div id="jqxGridDealer_stock"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDealer_stock">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-dealer_stocks', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "dealer_stocks_id"/>
		<table class="form-table">				
			<tr>
				<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
				<td> <div id="sparepart" class="form-control" name="sparepart_id"></div></td>
			</tr>
			<tr>
				<td><label for='quantity'><?php echo lang('quantity')?></label></td>
				<td><div id='quantity' class='number_general' name='quantity'></div></td>
			</tr>
			<tr>
				<td><label for='location'><?php echo lang('location')?></label></td>
				<td><input id='location' class='text_input' name='location'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealer_stockSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDealer_stockCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){	
		// part name combobox
		var partDataSource = {
			url : '<?php echo site_url("admin/dealer_stocks/get_spareparts_combo_json"); ?>',
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

		partAdapter = new $.jqx.dataAdapter(partDataSource,
		{
			formatData: function (data) {
				if ($("#sparepart").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#sparepart").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#sparepart").jqxComboBox({
			width: 350,
			height: 25,
			source: partAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "name",
			valueMember: "id",
			renderer: function (index, label, value) {
				var item = partAdapter.records[index];
				if (item != null) {

					var label = item.name+'|'+item.part_code;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = partAdapter.records[index];
				if (item != null) {
					var label = item.name+'|'+item.part_code;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				partAdapter.dataBind();
			}
		});

		var dealer_stocksDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'location', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'order_no', type: 'number' },
			{ name: 'mrp_price', type: 'number' },
			{ name: 'display_quantity', type: 'number' },
			
			],
			url: '<?php echo site_url("admin/dealer_stocks/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_stocksDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDealer_stock").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDealer_stock").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDealer_stock").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dealer_stocksDataSource,
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
		showaggregates: true,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		editable : true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridDealer_stockToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false, editable : false},
		/*{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editDealer_stockRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},*/
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'name',width: 180,filterable: true,renderer: gridColumnsRenderer, editable : false },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable : false },
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 180,filterable: true,renderer: gridColumnsRenderer , editable : false},
		// { text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'display_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable : false },
		
		{ text: '<?php echo lang("price"); ?>',datafield: 'mrp_price',width: 150,filterable: true,cellsFormat:'F2', renderer: gridColumnsRenderer , editable : false},
		{ 
			text: '<?php echo "Value"; ?>',datafield: 'total_value',width: 150,filterable: true,  align: 'center' ,cellsFormat:'F2', 
			cellsrenderer: function (index) {
				var row =  $("#jqxGridDealer_stock").jqxGrid('getrowdata', index);

				var e = row.display_quantity * row.mrp_price;
				return '<div style="margin-top: 8px; margin-left:5px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>'; 
			}, editable : false
		},
		
		// { text: '<?php echo lang("location"); ?>',datafield: 'location',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("location"); ?>',datafield: 'location',width: 150,filterable: true,renderer: gridColumnsRenderer,

			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				// console.log('old value = '+oldvalue);
				var data =  $("#jqxGridDealer_stock").jqxGrid('getrowdata', row);
				console.log(data);

				if(oldvalue != newvalue){
					updateLocation(newvalue, data.id);
				}
			},
		},
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDealer_stock").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDealer_stockFilterClear', function () { 
		$('#jqxGridDealer_stock').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDealer_stockInsert', function () { 
		openPopupWindow('jqxPopupWindowDealer_stock', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowDealer_stock").jqxWindow({ 
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

	$("#jqxPopupWindowDealer_stock").on('close', function () {
		reset_form_dealer_stocks();
	});

	$("#jqxDealer_stockCancelButton").on('click', function () {
		reset_form_dealer_stocks();
		$('#jqxPopupWindowDealer_stock').jqxWindow('close');
	});

    /*$('#form-dealer_stocks').jqxValidator({
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

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#price').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#location', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#location').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#order_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#order_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDealer_stockSubmitButton").on('click', function () {
    	saveDealer_stockRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDealer_stockRecord();
                }
            };
        $('#form-dealer_stocks').jqxValidator('validate', validationResult);
        */
    });
});

function saveDealer_stockRecord(){
	var data = $("#form-dealer_stocks").serialize();
	
	$('#jqxPopupWindowDealer_stock').block({ 
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
		url: '<?php echo site_url("admin/dealer_stocks/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_dealer_stocks();
				$('#jqxGridDealer_stock').jqxGrid('updatebounddata');
				$('#jqxPopupWindowDealer_stock').jqxWindow('close');
			}
			$('#jqxPopupWindowDealer_stock').unblock();
		}
	});
}

function reset_form_dealer_stocks(){
	$('#dealer_stocks_id').val('');
	$('#form-dealer_stocks')[0].reset();
}

function updateLocation(location,id)
{
	$.post('<?php echo site_url('dealer_stocks/update_location') ?>',{location:location,id:id},function(result){
		if(result){
			
		}
	},'json');
}
</script>