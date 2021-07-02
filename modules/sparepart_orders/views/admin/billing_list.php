<div class="row">
	<div class="col-xs-12 connectedSortable">
		<div id='jqxGridBillingToolbar' class='grid-toolbar'>
			<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridBillingFilterClear"><?php echo lang('general_clear'); ?></button>
			<button type="button" class="btn btn-default btn-flat btn-xs" id="excel"><?php echo lang('excel'); ?></button>
		</div>
		<?php echo displayStatus(); ?>
		<div id="jqxGridBilling"></div>
	</div><!-- /.col -->
</div>
<div id="jqxPopupWindowBilling_detail">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Bill Detail</span>
	</div>
	<div id="jqxGridBilling_detail"></div>
</div>
<!-- for multiple excel export -->
<div id="start_end" class="modal fade" role="dialog">
  	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Excel Filter</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label>Start Date</label>
	                	<div id='start_date' class="date_box"></div>
					</div>
					<div class="col-md-6">
					<label>Start Invoice No</label>
		                <div>
		                <input type="text" id='start_invoice' class="form-control">
		            	</div>
		            </div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>End Date</label>
	                	<div id='end_date' class="date_box"></div>
					</div>
					<div class="col-md-6">
						 <label>End Invoice No</label>
		                <div>
		                <input type="text" id='end_invoice' class="form-control">
		            	</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn bg-green waves-effect" id="start"><?php echo lang('general_save'); ?></button>	 -->
				<a type="button" class="btn bg-green waves-effect" id="start">Submit</a>		
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>

  	</div>
</div>

<script language="javascript" type="text/javascript">
$(function(){
		$("#start_date").jqxDateTimeInput({ showFooter: true });
		$("#end_date").jqxDateTimeInput({ showFooter: true });
	});
		$("#start").on('click', function (event) {
				var start_date = $("#start_date").jqxDateTimeInput('getText');
				var end_date = $("#end_date").jqxDateTimeInput('getText');
				var start_invoice = $('#start_invoice').val();
				var end_invoice = $('#end_invoice').val();

				if(start_date == "")
				{
					alert('Please select start date');
				}
				else
				{
					if(end_date && start_invoice && end_invoice)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+end_date+'/'+start_invoice+'/'+end_invoice);
					}
					else if(end_date && start_invoice)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+end_date+'/'+start_invoice+'/'+0);
					}
					else if(end_date && end_invoice)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+end_date+'/'+0+'/'+end_invoice);
					}
					else if(start_invoice && end_invoice)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+0+'/'+start_invoice+'/'+end_invoice);
					}
					else if(end_date)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+end_date+'/'+0+'/'+0);	
					}
					else if(start_invoice)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+0+'/'+start_invoice+'/'+0);
					}
					else if(end_invoice)
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+0+'/'+0+'/'+end_invoice);
					}
					else
					{
						var excel_link = '<?php echo site_url('sparepart_orders/excel_dump')?>';  
						$("#start").attr("href", excel_link+'/'+start_date+'/'+0+'/'+0+'/'+0);
					}
					$('#start_end').modal('hide');
				}
				

	});

	$(document).on('click','#excel', function () {
		$('#start_date').val('');
		$('#end_date').val('');
		$('#start_invoice').val('');
		$('#end_invoice').val('');
		$('#start_end').modal('show');
	});
</script>

<script language="javascript" type="text/javascript">

	$(function(){

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'bill_no', type: 'number' },
			{ name: 'bill_concat', type: 'string' },
			{ name: 'dispatched_date', type: 'date' },
			{ name: 'dispatched_date_nepali', type: 'string' },
			// { name: 'order_concat', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/billing_list"); ?>',
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
	    	$("#jqxGridBilling").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridBilling").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridBilling").jqxGrid({
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
		selectionmode: 'multiplecellsadvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,		
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridBillingToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
				var rows = $("#jqxGridBilling").jqxGrid('getrowdata', index);
				var e = '';
				e += '<a href="javascript:void(0)" onclick="Detailed_billing(' + index + '); return false;" title="Detailed Billing"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp';
				e += '<a href ="<?php echo site_url('sparepart_orders/generate_gatepass')?>/'+rows.bill_no+'" target="_blank" title="Gatepass"><i class="fa fa-ticket" aria-hidden="true"></i>&nbsp';
				e += '<a href="javascript:void(0)" onclick="bill_cancel(' + index + '); return false;" title="Cancel Bill"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},					
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_concat',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		// { text: '<?php echo lang("order_no"); ?>',datafield: 'order_concat',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Dealer Name/Customer Name',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$(document).on('click','#jqxGridBillingFilterClear', function () { 
		$('#jqxGridBilling').jqxGrid('clearfilters');
	});

	$("#jqxPopupWindowBilling_detail").jqxWindow({ 
		theme: theme,
		width: '90%',
		maxWidth: '90%',
		height: '90%',  
		maxHeight: '90%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowBilling_detail").on('close', function () {
	});

	$("#jqxBilling_detailCancelButton").on('click', function () {
		$('#jqxPopupWindowBilling_detail').jqxWindow('close');
	});
});

function Detailed_billing(index){
	var row =  $("#jqxGridBilling").jqxGrid('getrowdata', index);
	if (row) 
	{	
		var Detailbilling_DataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'dispatched_quantity', type: 'number' },
			{ name: 'pi_number', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'total_amount', type: 'number' },
			{ name: 'dealer_price', type: 'number' },
			{ name: 'vor_percentage', type: 'number' },

			],
			url: '<?php echo site_url("admin/sparepart_orders/get_detailed_bill"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			data : {bill_no: row.bill_no,date: row.dispatched_date_nepali},
			cache: true,
		};
		var Detailbilling_dataAdapter = new $.jqx.dataAdapter(Detailbilling_DataSource);

                // update data source.
                //$("#jqxGridBilling_detail").jqxGrid({ source: Detailbilling_dataAdapter });

                $("#jqxGridBilling_detail").jqxGrid(
                {
                	theme: theme,
                	width: '100%',
                	height: gridHeight,
                	source: Detailbilling_dataAdapter,
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
                	enableanimations: false,
                	pagesizeoptions: pagesizeoptions,
                	showtoolbar: true,
                	showstatusbar: true,
                	statusbarheight: 30,
                	showaggregates: true,	
                	columns: [
                	{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
                	{ text: 'Part Code', datafield: 'part_code', width: 150 },
                	{ text: 'Part Name', datafield: 'name', width: 180 },
                	{ text: 'Quantity', datafield: 'dispatched_quantity', width: 120 },
                	{ text: 'Price', datafield: 'dealer_price', width: 120 ,cellsformat: 'F2' },
                	{ text: 'Total Amount', datafield: 'total_amount', width: 120 ,aggregates: ['sum'] ,cellsformat: 'F2' },
                	{ text: 'Total Amount(With VRO)', datafield: 'vro_amt', width: 200 ,aggregates: ['sum'] ,
                		cellsrenderer: function (index) {
							var vor = parseFloat($('#jqxGridBilling_detail').val() || 0);
							var rows = $("#jqxGridBilling_detail").jqxGrid('getrowdata', index);
							var e = Number((rows.dealer_price * rows.dispatched_quantity*(1+rows.vor_percentage/100))).toFixed(2);
							// return '<div style="text-align: right; margin-top: 8px;">' + e + '</div>';
							return '<div class="jqx-grid-cell-right-align" style="margin-top: 4px;">' + e + '</div>';
						},
						aggregates: [{ 'Total':
			                function (aggregatedValue, currentValue, column, record) {
			                	var dealer_price = parseFloat((record.hasOwnProperty("dealer_price"))?record.dealer_price:0);
			                  	var dispatched_quantity = parseFloat((record.hasOwnProperty("dispatched_quantity"))?record.dispatched_quantity:0);
			                  	console.log(dealer_price);
			                  	console.log(dispatched_quantity);

			                  	var row_total = (isNaN(dealer_price)?0:dealer_price) * (isNaN(dispatched_quantity)?0:dispatched_quantity) * (1+record.vor_percentage/100);
			                  	var total = parseFloat(row_total);
			                  	var g_total = aggregatedValue + total;
			                  	$('#counterIssue-total_for_parts').val(g_total);
			                  	return g_total;
			                }

		            	}],cellsformat: 'F2' ,
                	},

                	{ text: 'PI Number', datafield: 'pi_number', width: 200 },
                	]
                });

                openPopupWindow('jqxPopupWindowBilling_detail');
            }
        }

        function bill_cancel(index)
        {
        	var row =  $("#jqxGridBilling").jqxGrid('getrowdata', index);
        	if(confirm('Are You Sure You Want To Cancel Bill No:. '+row.bill_concat))
        	{
        		$('#jqxGridBilling').block({ 
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
        			url: '<?php echo site_url("admin/sparepart_orders/cancel_billing"); ?>',
        			data: {bill_no : row.bill_no},
        			success: function (result) {
        				var result = eval('('+result+')');
        				if (result.success) {
        					$('#jqxGridBilling').jqxGrid('updatebounddata');
        					$('#jqxGridBilling').jqxWindow('close');
        				}
        				$('#jqxGridBilling').unblock();
        			}
        		});
        	}
        }
    </script>