<div class="row">
	<div class="col-xs-12 connectedSortable">
		<?php echo displayStatus(); ?>
		<div id='jqxGridSparepart_orderToolbar' class='grid-toolbar'>
			<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSparepart_orderInsert"><?php echo lang('general_create'); ?></button>
			<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSparepart_orderFilterClear"><?php echo lang('general_clear'); ?></button>
		</div>
		<div id="jqxGridSparepart_order"></div>
	</div><!-- /.col -->
</div>
<div id="jqxPopupWindowSparepart_order">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-sparepart_orders', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "sparepart_orders_id"/>
		<table class="form-table">
			<tr>
				<td><label for='part_code'><?php echo lang('part_code')?></label></td>
				<td><div id="jqxSparepartCombobox" name="product_id"></div></td>
			</tr>			
			<tr>
				<td><label for='quantity'><?php echo lang('quantity')?></label></td>
				<td><div id='quantity' class='number_general' name='quantity'></div></td>
			</tr>		
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSparepart_orderSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSparepart_orderCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_quantity', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'created_at', type: 'string' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSparepart_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepart_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepart_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepart_ordersDataSource,
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
		showaggregates: true,		
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSparepart_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editSparepart_orderRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},			
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_date"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'order_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum'] },	 


		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepart_order").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepart_orderFilterClear', function () { 
		$('#jqxGridSparepart_order').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSparepart_orderInsert', function () { 
		openPopupWindow('jqxPopupWindowSparepart_order', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSparepart_order").jqxWindow({ 
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

	$("#jqxPopupWindowSparepart_order").on('close', function () {
		reset_form_sparepart_orders();
	});

	$("#jqxSparepart_orderCancelButton").on('click', function () {
		reset_form_sparepart_orders();
		$('#jqxPopupWindowSparepart_order').jqxWindow('close');
	});

    /*$('#form-sparepart_orders').jqxValidator({
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

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatched_quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatched_quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxSparepart_orderSubmitButton").on('click', function () {
    	saveSparepart_orderRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSparepart_orderRecord();
                }
            };
        $('#form-sparepart_orders').jqxValidator('validate', validationResult);
        */
    });

    var SparepartsDatasource =
    {
    	datatype: "json",
    	datafields: [
    	{ name: 'name' },
    	{ name: 'part_code'},
    	{ name: 'id'},

    	],
    	url: '<?php echo site_url('admin/sparepart_orders/get_spareparts_list') ?>',
    	async: false
    };

    var SparepartsdataAdapter = new $.jqx.dataAdapter(SparepartsDatasource);
    $("#jqxSparepartCombobox").jqxComboBox({ 
    	selectedIndex: 0, 
    	source: SparepartsdataAdapter, 
    	displayMember: "name", 
    	valueMember: "id", 
    	width: 200, 
    	height: 25
    });

});

function editSparepart_orderRecord(index){
	var row =  $("#jqxGridSparepart_order").jqxGrid('getrowdata', index);
	if (row) {
		$('#sparepart_orders_id').val(row.id);
		$('#jqxSparepartCombobox').jqxComboBox('val', row.sparepart_id);
		$('#quantity').jqxNumberInput('val', row.quantity);		
		openPopupWindow('jqxPopupWindowSparepart_order', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSparepart_orderRecord(){
	var data = $("#form-sparepart_orders").serialize();

	$('#jqxPopupWindowSparepart_order').block({ 
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
		url: '<?php echo site_url("admin/sparepart_orders/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_sparepart_orders();
				$('#jqxGridSparepart_order').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSparepart_order').jqxWindow('close');
			}
			else
			{
				alert(result.msg);
				$('#jqxPopupWindowSparepart_order').jqxWindow('close');
			}
			$('#jqxPopupWindowSparepart_order').unblock();
		}
	});
}

function reset_form_sparepart_orders(){
	$('#sparepart_orders_id').val('');
	$('#form-sparepart_orders')[0].reset();
}
</script>