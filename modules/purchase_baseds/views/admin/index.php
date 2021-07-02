<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('purchase_baseds'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('purchase_baseds'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPurchase_basedToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPurchase_basedInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPurchase_basedFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridPurchase_based"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPurchase_based">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-purchase_baseds', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "purchase_baseds_id"/>
            <table class="form-table">
				
				<tr>
					<td><label for='part_no'><?php echo lang('part_no')?></label></td>
					<td><div id='part_no' class='number_general' name='part_no'></div></td>
				</tr>
				<tr>
					<td><label for='description'><?php echo lang('description')?></label></td>
					<td><input id='description' class='text_input' name='description'></td>
				</tr>
				<tr>
					<td><label for='rol'><?php echo lang('rol')?></label></td>
					<td><div id='rol' class='number_general' name='rol'></div></td>
				</tr>
				<tr>
					<td><label for='po_qty'><?php echo lang('po_qty')?></label></td>
					<td><div id='po_qty' class='number_general' name='po_qty'></div></td>
				</tr>
				<tr>
					<td><label for='ord_qty'><?php echo lang('ord_qty')?></label></td>
					<td><div id='ord_qty' class='number_general' name='ord_qty'></div></td>
				</tr>
				<tr>
					<td><label for='sold_qty'><?php echo lang('sold_qty')?></label></td>
					<td><div id='sold_qty' class='number_general' name='sold_qty'></div></td>
				</tr>
				<tr>
					<td><label for='stck_qty'><?php echo lang('stck_qty')?></label></td>
					<td><div id='stck_qty' class='number_general' name='stck_qty'></div></td>
				</tr>
				<tr>
					<td><label for='tran_stk'><?php echo lang('tran_stk')?></label></td>
					<td><div id='tran_stk' class='number_general' name='tran_stk'></div></td>
				</tr>
				<tr>
					<td><label for='sugg_qty'><?php echo lang('sugg_qty')?></label></td>
					<td><div id='sugg_qty' class='number_general' name='sugg_qty'></div></td>
				</tr>
				<tr>
					<td><label for='price'><?php echo lang('price')?></label></td>
					<td><div id='price' class='number_general' name='price'></div></td>
				</tr>
				<tr>
					<td><label for='amount'><?php echo lang('amount')?></label></td>
					<td><div id='amount' class='number_general' name='amount'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPurchase_basedSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPurchase_basedCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var purchase_basedsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			// { name: 'created_by', type: 'number' },
			// { name: 'updated_by', type: 'number' },
			// { name: 'deleted_by', type: 'number' },
			// { name: 'created_at', type: 'string' },
			// { name: 'updated_at', type: 'string' },
			// { name: 'deleted_at', type: 'string' },
			{ name: 'part_no', type: 'number' },
			{ name: 'description', type: 'string' },
			{ name: 'rol', type: 'number' },
			{ name: 'po_qty', type: 'number' },
			{ name: 'ord_qty', type: 'number' },
			{ name: 'sold_qty', type: 'number' },
			{ name: 'stck_qty', type: 'number' },
			{ name: 'tran_stk', type: 'number' },
			{ name: 'sugg_qty', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'amount', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/purchase_baseds/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	purchase_basedsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPurchase_based").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPurchase_based").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPurchase_based").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: purchase_basedsDataSource,
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
			container.append($('#jqxGridPurchase_basedToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editPurchase_basedRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_no"); ?>',datafield: 'part_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rol"); ?>',datafield: 'rol',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("po_qty"); ?>',datafield: 'po_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("ord_qty"); ?>',datafield: 'ord_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sold_qty"); ?>',datafield: 'sold_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("stck_qty"); ?>',datafield: 'stck_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("tran_stk"); ?>',datafield: 'tran_stk',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sugg_qty"); ?>',datafield: 'sugg_qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridPurchase_based").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPurchase_basedFilterClear', function () { 
		$('#jqxGridPurchase_based').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPurchase_basedInsert', function () { 
		openPopupWindow('jqxPopupWindowPurchase_based', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowPurchase_based").jqxWindow({ 
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

    $("#jqxPopupWindowPurchase_based").on('close', function () {
        reset_form_purchase_baseds();
    });

    $("#jqxPurchase_basedCancelButton").on('click', function () {
        reset_form_purchase_baseds();
        $('#jqxPopupWindowPurchase_based').jqxWindow('close');
    });

   

    $("#jqxPurchase_basedSubmitButton").on('click', function () {
        savePurchase_basedRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   savePurchase_basedRecord();
                }
            };
        $('#form-purchase_baseds').jqxValidator('validate', validationResult);
        */
    });
});

function editPurchase_basedRecord(index){
	//console.log(index);

    var row =  $("#jqxGridPurchase_based").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#purchase_baseds_id').val(row.id);
  		// $('#created_by').jqxNumberInput('val', row.created_by);
		// $('#updated_by').jqxNumberInput('val', row.updated_by);
		// $('#deleted_by').jqxNumberInput('val', row.deleted_by);
		// $('#created_at').val(row.created_at);
		// $('#updated_at').val(row.updated_at);
		// $('#deleted_at').val(row.deleted_at);
		$('#part_no').jqxNumberInput('val', row.part_no);
		$('#description').val(row.description);
		$('#rol').jqxNumberInput('val', row.rol);
		$('#po_qty').jqxNumberInput('val', row.po_qty);
		$('#ord_qty').jqxNumberInput('val', row.ord_qty);
		$('#sold_qty').jqxNumberInput('val', row.sold_qty);
		$('#stck_qty').jqxNumberInput('val', row.stck_qty);
		$('#tran_stk').jqxNumberInput('val', row.tran_stk);
		$('#sugg_qty').jqxNumberInput('val', row.sugg_qty);
		$('#price').jqxNumberInput('val', row.price);
		$('#amount').jqxNumberInput('val', row.amount);
		
        openPopupWindow('jqxPopupWindowPurchase_based', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function savePurchase_basedRecord(){
    var data = $("#form-purchase_baseds").serialize();
	
	$('#jqxPopupWindowPurchase_based').block({ 
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
        url: '<?php echo site_url("admin/purchase_baseds/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_purchase_baseds();
                $('#jqxGridPurchase_based').jqxGrid('updatebounddata');
                $('#jqxPopupWindowPurchase_based').jqxWindow('close');
            }
            $('#jqxPopupWindowPurchase_based').unblock();
        }
    });
}

function reset_form_purchase_baseds(){
	$('#purchase_baseds_id').val('');
    $('#form-purchase_baseds')[0].reset();
}
</script>