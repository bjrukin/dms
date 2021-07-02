<div class="row">
	<div class="col-md-12">
		<div id="error_credit_excess" class="alert alert-danger" style="display: none;">
			<span>Credit Exceeds the Credit Limit</span>
		</div>
	</div>
	<div class="col-xs-12 connectedSortable">
		<?php echo displayStatus(); ?>		
		<div id="jqxGridPiList"></div>
	</div><!-- /.col -->
</div>
<div id="jqxPopupWindowPi_Confirm_Dealer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo lang('confirm_pi');?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-confirm_pi_dealer', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "order_no" id = "dealer_pi_order_no"/>
		<input type = "hidden" name = "dealer_id" id = "dealer_pi_dealer_id"/>
		<table class="form-table">
			<tr>
				<th colspan="4" style="text-align: center !important;">
					<button type="button" class="btn btn-success btn-lg" id="jqxPi_Confirm_DealerSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-lg" id="jqxPi_Confirm_DealerCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowUnavailable_list">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo "Unavailable Spareparts List"//lang('cancel_order');?></span>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="unavailable">				
			</div>
			<div id="error_msg" style="display: none;">All Spareparts are available</div>
		</div>
	</div>
</div>


<script language="javascript" type="text/javascript">

	$(function(){

		var sparepart_orders_group_DataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_quantity', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'order_no', type: 'number' },
			{ name: 'order_concat', type: 'string' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'dealer_confirmed', type: 'number' },
			{ name: 'order_date', type: 'date' },
			{ name: 'order_date_np', type: 'string' },
			{ name: 'dispatch_mode', type: 'string' },
			{ name: 'order_type', type: 'string' },
			{ name: 'pi_status', type: 'string' },
			{ name: 'order_qty', type: 'number' },
			{ name: 'total_line_qty', type: 'number' },
			{ name: 'total_amount', type: 'number' },
			{ name: 'total_dispatched_quantity', type: 'number' },
			{ name: 'total_dispatched_amount', type: 'number' },
			{ name: 'pi_number', type: 'string' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/dealer_order_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_orders_group_DataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPiList").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPiList").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPiList").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepart_orders_group_DataSource,
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
			container.append($('#jqxGridPiListToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var row = $("#jqxGridPiList").jqxGrid('getrowdata', index);
				var e = '';
				e +='<a href="<?php echo site_url('sparepart_orders/order_list')?>/'+row.order_no+'/'+row.dealer_id+'/2" return false;" title="List" target="_blank"><i class="fa fa-list"></i></a> &nbsp';
				if(row.dealer_confirmed == 0)
				{
					e +='<a href="javascript:void(0)" onclick="dealer_pi_confirm('+ row.order_no+','+row.dealer_id+')" title="Approve"><i class="fa fa-check"></i></a>&nbsp';
				} 
				e += '<a href="javascript:void(0)" onclick="unavailable_list('+ row.order_no+','+row.dealer_id+')" title="Unavailable List"><i class="fa fa-list-alt"></i></a>';

				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},		
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_concat',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_date"); ?>',datafield: 'order_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("order_date_np"); ?>',datafield: 'order_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatch_mode"); ?>',datafield: 'dispatch_mode',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_type"); ?>',datafield: 'order_type',width: 90,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pi_status"); ?>',datafield: 'pi_status',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pi_number"); ?>',datafield: 'pi_number',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_line_qty"); ?>',datafield: 'total_line_qty',width: 80,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("order_qty"); ?>',datafield: 'order_qty',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 120,filterable: true,cellsformat : 'F2', renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_dispatched_quantity"); ?>',datafield: 'total_dispatched_quantity',width: 120,filterable: true, renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("total_dispatched_amount"); ?>',datafield: 'total_dispatched_amount',width: 120,filterable: true,cellsformat : 'F2', renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridPiList").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPiListFilterClear', function () { 
		$('#jqxGridPiList').jqxGrid('clearfilters');
	});

	

	// initialize the popup window
	$("#jqxPopupWindowPi_Confirm_Dealer").jqxWindow({ 
		theme: theme,
		width: '20%',
		maxWidth: '20%',
		height: '15%',  
		maxHeight: '15%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowPi_Confirm_Dealer").on('close', function () {
	});

	$("#jqxPi_Confirm_DealerCancelButton").on('click', function () {
		$('#jqxPopupWindowPi_Confirm_Dealer').jqxWindow('close');
	});

	$("#jqxPi_Confirm_DealerSubmitButton").on('click', function () {
		save_Confirm_Pi_Dealer();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   save_Confirm_Pi();
                }
            };
        $('#form-sparepart_orders').jqxValidator('validate', validationResult);
        */
    });

	$("#jqxPopupWindowUnavailable_list").jqxWindow({ 
		theme: theme,
		width: '40%',
		maxWidth: '40%',
		height: '40%',  
		maxHeight: '40%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowUnavailable_list").on('close', function () {
	});
});

function dealer_pi_confirm(order_no,dealer_id)
{	
	$('#dealer_pi_order_no').val(order_no);
	$('#dealer_pi_dealer_id').val(dealer_id);
	openPopupWindow('jqxPopupWindowPi_Confirm_Dealer', '<?php echo lang("confirm_pi")  . "&nbsp;" .  $header; ?>');
}

function save_Confirm_Pi_Dealer(){
	var data = $("#form-confirm_pi_dealer").serialize();

	$('#jqxPopupWindowPi_Confirm_Dealer').block({ 
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
		url: '<?php echo site_url("admin/sparepart_orders/dealer_save_pi"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {				
				$('#jqxGridPiList').jqxGrid('updatebounddata');
			}
			else
			{
				$('#error_credit_excess').delay(500).fadeIn('normal', function() {
					$(this).delay(1000).fadeOut();
				});
			}
			$('#jqxPopupWindowPi_Confirm_Dealer').jqxWindow('close');
			$('#jqxPopupWindowPi_Confirm_Dealer').unblock();
		}
	});
}
function unavailable_list(order_no,dealer_id)
{
	openPopupWindow('jqxPopupWindowUnavailable_list', '<?php echo lang("confirm_pi")  . "&nbsp;" .  $header; ?>');
	$('#unavailable').html('');
	$('#error_msg').hide();
	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/sparepart_orders/generate_unavailable_list"); ?>',
		data: {order_no : order_no, dealer_id:dealer_id},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {				
				$.each(result.unavailable_parts,function(i,v)
				{
					$('#unavailable').append('<div class="list">'+v+'</div>')
				});
			}
			else
			{
				$('#error_msg').show();
			}
		}
	});
}
</script>