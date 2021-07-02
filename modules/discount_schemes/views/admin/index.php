<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('discount_schemes'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('discount_schemes'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDiscount_schemeToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDiscount_schemeInsert"><?php echo lang('general_create'); ?></button> -->
					<!-- <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDiscount_schemeFilterClear"><?php echo lang('general_clear'); ?></button> -->
				</div>
				<div id="jqxGridDiscount_scheme"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="jqxPopupWindowDiscount_scheme">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-discount_schemes', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "discount_schemes_id"/>
		<table class="form-table">
			<tr>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><input id='remarks' class='text_input' name='remarks'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDiscount_schemeSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDiscount_schemeCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="jqxWindowReducedDiscount">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"><?php echo lang("new_discount") ?></span>
	</div>
	<div class="form_fields_area">
		<!--  -->
		<?php echo form_open(base_url("admin/discount_schemes/discount_operation/".DISCOUNT_REDUCED), array('id' => 'form-reduced_discount','class' => 'form-horizontal')); ?>
		<input type="hidden" name="discount_id" id="discount_id">
		<input type="hidden" name="customer_id"  id="reducedDiscount_customer_id">
		<div class="form-line">
			<label><?php echo lang("new_discount") ?></label>
			<input type="number" name="reduced_discount" id="reduced_discount" class="form-control">
		</div>

		<div class="form-buttons">
			<button type="submit" class="btn btn-success btn-flat" id="jqxReducedDiscountSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-default btn-flat" id="jqxReducedDiscountCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>
<script language="javascript" type="text/javascript">

	$(function(){

		var discount_schemesDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'fullname', type: 'string' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'actual_price', type: 'number' },
			{ name: 'discount_request', type: 'number' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'color_id', type: 'number' },
			{ name: 'approval', type: 'number' },
			{ name: 'approved_by', type: 'string' },
			{ name: 'approved_date', type: 'date' },
			{ name: 'customer_id', type: 'number' },
			{ name: 'remarks', type: 'string' },
			{ name: 'reduced_discount', type: 'string' },
			{ name: 'designation', type: 'string' },
			{ name: 'inquiry_no', type: 'string' },

			{ name: 'first_name', type: 'string' },
			{ name: 'middle_name', type: 'string' },
			{ name: 'last_name', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },

			{ name: 'staff_limit', type: 'string' },
			{ name: 'incharge_limit', type: 'string' },
			{ name: 'sales_head_limit', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'customer_full_name', type: 'string' },
			{ name: 'full_name', type: 'string' }
			
			],
			url: '<?php echo site_url("admin/discount_schemes/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	discount_schemesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDiscount_scheme").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDiscount_scheme").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDiscount_scheme").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: discount_schemesDataSource,
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
			container.append($('#jqxGridDiscount_schemeToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:95, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
				var e = '<a href="javascript:void(0)" onclick="editDiscount_schemeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				var p = '';
				var limit;

				<?php if(is_dealer_incharge()){ ?>
					limit = columnproperties.incharge_limit;
					<?php }elseif(is_sales_head()){ ?>
						limit = columnproperties.sales_head_limit;
						<?php }else{ ?>
							limit = columnproperties.actual_price;
							<?php } ?>

							if( columnproperties.discount_request <= limit){
								p += '<a onclick=\'return (confirm("Are you Sure want to Confirm?"))?true:false\' href="' + base_url + 'admin/discount_schemes/discount_operation/<?php echo DISCOUNT_APPROVED; ?>/' + columnproperties.id + '/'+columnproperties.customer_id+'"><i class="fa fa-fw fa-check"></i></a>&nbsp';
							}
							p += '<a onclick=\'return (confirm("Are you Sure want to Reject?"))?true:false\' href="' + base_url + 'admin/discount_schemes/discount_operation/<?php echo DISCOUNT_REJECTED; ?>/' + columnproperties.id + '/'+columnproperties.customer_id+'"><i class="fa fa-fw fa-times"></i></a>&nbsp';
							p += '<a href="#jqxGridDiscount" onclick="discount_reduce_window(' +index+ ', '+ columnproperties.id +')"><i class="fa fa-fw fa-chevron-circle-down"></i></a>&nbsp';
							p += '<a href="' + base_url + 'admin/discount_schemes/discount_operation/<?php echo DISCOUNT_FORWARD; ?>/' + columnproperties.id + '/'+columnproperties.customer_id+'"><i class="fa fa-fw fa-arrow-right"></i></a>&nbsp';
				// p += '<a href="' + base_url + 'admin/customers/discount_operation/5/' + columnproperties.id + '"><i class="fa fa-fw fa-trash"></i></a>&nbsp';

				if(columnproperties.approval == 1)
				{
					return "<i class='fa fa-check'></i>";
				}
				if(columnproperties.approval == 2)
				{
					return "<i class='fa fa-times'></i>";
				}
				if(columnproperties.approval == 3)
				{
					return "<i class='fa fa-angle-double-down'></i><i class='fa fa-check'></i>";
				}
				<?php if(is_sales_executive()){ ?>
					return '<div style="text-align: center; margin-top: 8px;"> '+ e +' </div>';
					<?php } ?>

					return '<div style="text-align: center; margin-top: 8px;">' + p + '</div>';

					// return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_by"); ?>',datafield: 'fullname',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("inquiry_no"); ?>',datafield: 'inquiry_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("customer_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },

			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("actual_price"); ?>',datafield: 'actual_price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("discount_request"); ?>',datafield: 'discount_request',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("reduced_discount"); ?>',datafield: 'reduced_discount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("approval"); ?>',datafield: 'approval',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("approved_by"); ?>',datafield: 'approved_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("designation"); ?>',datafield: 'designation',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("approved_date"); ?>',datafield: 'approved_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridDiscount_scheme").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridDiscount_schemeFilterClear', function () { 
	$('#jqxGridDiscount_scheme').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridDiscount_schemeInsert', function () { 
	openPopupWindow('jqxPopupWindowDiscount_scheme', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowDiscount_scheme").jqxWindow({ 
		theme: theme,
		width: 500,
		maxWidth: '75%',
		height: 300,  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxWindowReducedDiscount").jqxWindow({
		theme: theme,
		width: 500,
		maxWidth: 500,
		height: 200,
		maxHeight: 200,
		isModal: true,
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false
	});

	/*$('#form-reduced_discount').jqxValidator({
    		hintType: 'label',
    		animationDuration: 500,
    		rules: [
    		{ 
    			input: '#reduced_discount', message: 'Required', action: 'blur', 
    			rule: function(input) { 
    				val = $('#reduced_discount').val(); 
    				return (val == '' || val == null || val == 0) ? false: true; 
    			}
    		},
    		]
    	});*/

	/*$("#jqxReducedDiscountSubmitButton").on('click', function () {

		var validationResult = function (isValid) {
			if (isValid) {
				saveReduced_Discount_request();
			}
		};
		$('#form-reduced_discount').jqxValidator('validate', validationResult);

	});*/

	$("#jqxPopupWindowDiscount_scheme").on('close', function () {
		reset_form_discount_schemes();
	});

	$("#jqxDiscount_schemeCancelButton").on('click', function () {
		reset_form_discount_schemes();
		$('#jqxPopupWindowDiscount_scheme').jqxWindow('close');
	});


	$("#jqxDiscount_schemeSubmitButton").on('click', function () {
		saveDiscount_schemeRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDiscount_schemeRecord();
                }
            };
        $('#form-discount_schemes').jqxValidator('validate', validationResult);
        */
    });
});

function editDiscount_schemeRecord(index){
	var row =  $("#jqxGridDiscount_scheme").jqxGrid('getrowdata', index);
	if (row) {
		$('#discount_schemes_id').val(row.id);
		$('#remarks').val(row.remarks);
		
		openPopupWindow('jqxPopupWindowDiscount_scheme', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveDiscount_schemeRecord(){
	var data = $("#form-discount_schemes").serialize();
	
	$('#jqxPopupWindowDiscount_scheme').block({ 
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
		url: '<?php echo site_url("admin/discount_schemes/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_discount_schemes();
				$('#jqxGridDiscount_scheme').jqxGrid('updatebounddata');
				$('#jqxPopupWindowDiscount_scheme').jqxWindow('close');
			}
			$('#jqxPopupWindowDiscount_scheme').unblock();
		}
	});
}
/*
function saveReduced_Discount_request(){
	var data = $("#form-reduced_discount").serialize();
	// console.log(data); return;
    	$('#jqxWindowReducedDiscount').block({ 
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

    	$('#form-reduced_discount').submit();
    	$('#jqxWindowReducedDiscount').unblock();

    	$.ajax({
    		type: "POST",
    		url: '<?php echo site_url("admin/customers/save_discounts_request"); ?>',
    		data: data,
    		success: function (result) {
    			var result = eval('('+result+')');
    			if (result.success) {
    				// reset_form_customer_test_drives();
    				$('#jqxGridDiscount').jqxGrid('updatebounddata');
    				$('#jqxWindowReducedDiscount').jqxWindow('close');
    			}
    			$('#jqxWindowReducedDiscount').unblock();
    		}
    	});
    }    */

    function reset_form_discount_schemes(){
    	$('#discount_schemes_id').val('');
    	$('#form-discount_schemes')[0].reset();
    }

    function discount_reduce_window(index, id)
    {
    	var row =  $("#jqxGridDiscount_scheme").jqxGrid('getrowdata', index);

    	$('#discount_id').val(id);
    	$('#reducedDiscount_customer_id').val(row.customer_id);
    	openPopupWindow('jqxWindowReducedDiscount', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
</script>