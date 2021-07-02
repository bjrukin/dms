<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('payment_details'); ?></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				 <div style="float: left;" id="jqxPayment_listbox"></div>
				<div id="jqxGridPartial_payment"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPartial_payment">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div id="partial_payment">
	</div>

</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var dealer_salesDataSource =
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
			{ name: 'inquiry_no', type: 'string' },
			{ name: 'inquiry_date_np', type: 'string' },
			{ name: 'inquiry_date_en', type: 'string' },
			{ name: 'booked_date', type: 'string' },
			{ name: 'downpayment_date', type: 'string' },
			{ name: 'fullpayment_date', type: 'string' },
			{ name: 'fullpayment_receipt_no', type: 'string' },
			{ name: 'downpayment_receipt_no', type: 'string' },
			{ name: 'booking_receipt_no', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'executive_name', type: 'string' },
			{ name: 'booking_amount', type: 'number' },
			{ name: 'fullpayment_amount', type: 'number' },
			{ name: 'downpayment_amount', type: 'number' },
			{ name: 'total_partial_payment', type: 'number' },
			{ name: 'svp_id',type:'number'},
			{ name: 'vehicle_price', type: 'string' },
			{ name: 'outstanding_amount', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			],
			url: '<?php echo site_url("admin/crm_reports/get_payment_details_report"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_salesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPartial_payment").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPartial_payment").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPartial_payment").jqxGrid({
		width: '100%',
		height: gridHeight,
		source: dealer_salesDataSource,
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
		// virtualmode :true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridDealer_saleToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="displayPartial_payment(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("inquiry_no"); ?>',datafield: 'inquiry_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("inquiry_date_en"); ?>',datafield: 'inquiry_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("inquiry_date_np"); ?>',datafield: 'inquiry_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("executive_name"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_price"); ?>', datafield: 'vehicle_price', width: 200, align: 'center', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Amt';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	}, 
		{ text: '<?php echo lang("booked_date"); ?>',datafield: 'booked_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("booking_receipt_no"); ?>',datafield: 'booking_receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("booking_amount"); ?>', datafield: 'booking_amount', width: 200, align: 'center', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Amt';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	},
		{ text: '<?php echo lang("fullpayment_date"); ?>',datafield: 'fullpayment_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("fullpayment_receipt_no"); ?>',datafield: 'fullpayment_receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("fullpayment_amount"); ?>', datafield: 'fullpayment_amount', width: 200, align: 'center', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Amt';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	},
		{ text: '<?php echo lang("total_partial_payment"); ?>', datafield: 'total_partial_payment', width: 200, align: 'center', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Amt';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	},
		{ text: '<?php echo lang("outstanding_amount"); ?>', datafield: 'outstanding_amount', width: 200, align: 'center', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Amt';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	},
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});
var listSource = [{ value: 'inquiry_no',label: '<?php echo lang("inquiry_no"); ?>', checked: true }, { value: 'inquiry_date_np',label: '<?php echo lang("inquiry_date_en"); ?>', checked: true }, { value: 'inquiry_date_en',label: '<?php echo lang("inquiry_date_np"); ?>', checked: true }, { value: 'dealer_name',label: '<?php echo lang("dealer_name"); ?>', checked: true }, { value: 'executive_name',label: '<?php echo lang("executive_name"); ?>', checked: true }, { value: 'vehicle_name',label: '<?php echo lang("vehicle_name"); ?>', checked: true }, { value: 'variant_name',label: '<?php echo lang("variant_name"); ?>', checked: true }, { value: 'color_name',label: '<?php echo lang("color_name"); ?>', checked: true }, { value: 'vehicle_price',label: '<?php echo lang("vehicle_price"); ?>', checked: true }, { value: 'booked_date',label: '<?php echo lang("booked_date"); ?>', checked: true }, { value: 'booking_receipt_no',label: '<?php echo lang("booking_receipt_no"); ?>', checked: true }, { value: 'booking_amount',label: '<?php echo lang("booking_amount"); ?>', checked: true }, { value: 'fullpayment_date',label: '<?php echo lang("fullpayment_date"); ?>', checked: true }, { value: 'fullpayment_receipt_no',label: '<?php echo lang("fullpayment_receipt_no"); ?>', checked: true }, { value: 'fullpayment_amount',label: '<?php echo lang("fullpayment_amount"); ?>', checked: true }, { value: 'total_partial_payment',label: '<?php echo lang("total_partial_payment"); ?>', checked: true }, { value: 'outstanding_amount',label: '<?php echo lang("outstanding_amount"); ?>', checked: true },];
            $("#jqxPayment_listbox").jqxListBox({ source: listSource, width: 200, height: 200,  checkboxes: true });
            $("#jqxPayment_listbox").on('checkChange', function (event) {
                $("#jqxGridPartial_payment").jqxGrid('beginupdate');
                if (event.args.checked) {
                    $("#jqxGridPartial_payment").jqxGrid('showcolumn', event.args.value);
                }
                else {
                    $("#jqxGridPartial_payment").jqxGrid('hidecolumn', event.args.value);
                }
                $("#jqxGridPartial_payment").jqxGrid('endupdate');
            });

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridPartial_payment").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDealer_saleFilterClear', function () { 
		$('#jqxGridPartial_payment').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDealer_saleInsert', function () { 
		openPopupWindow('jqxPopupWindowPartial_payment', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowPartial_payment").jqxWindow({ 
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

	$("#jqxPopupWindowPartial_payment").on('close', function () {
		// reset_form_dealer_sales();
	});

	$("#jqxDealer_saleCancelButton").on('click', function () {
		// reset_form_dealer_sales();
		$('#jqxPopupWindowPartial_payment').jqxWindow('close');
	});


});

function displayPartial_payment(index){
	var row =  $("#jqxGridPartial_payment").jqxGrid('getrowdata', index);
	if (row) 
	{
		$.post("<?php echo site_url('crm_reports/get_partial_payment')?>",{svp_id:row.svp_id},function(result)
		{
			if(result)
			{
				var table = '';
				var payment_count = 1;
				$.each(result,function(i,v)
				{
					table += '<label><u>Partial Payment No : '+payment_count+'</u></label><div class="row"><div class="col-md-2"> <label for ="receipt_no">Receipt_no</label> </div> <div class="col-md-2">'+v.receipt_no+'</div> </div> <div class="row"> <div class="col-md-2"> <label for ="payment_date">Payment Date</label></div> <div class="col-md-2">'+v.payment_date+'</div> </div> <div class="row"> <div class="col-md-2"> <label for ="partial_payment">Amount</label> </div> <div class="col-md-2">'+v.amount+'</div> </div><br/>';
					payment_count++;
				});
				$('#partial_payment').html(table);
			}

		},'JSON');
		openPopupWindow('jqxPopupWindowPartial_payment', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}


</script>