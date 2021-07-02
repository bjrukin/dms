<div class="row">
	<div class="col-xs-12 connectedSortable">
		<div id='jqxGridBillingToolbar' class='grid-toolbar'>
			<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridBillingFilterClear"><?php echo lang('general_clear'); ?></button>
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

<script language="javascript" type="text/javascript">

	$(function(){

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'bill_no', type: 'number' },
			{ name: 'bill_concat', type: 'string' },
			{ name: 'dispatched_date', type: 'date' },
			{ name: 'order_concat', type: 'string' },
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
				e += '<a href ="<?php echo site_url('sparepart_orders/generate_gatepass')?>/'+rows.bill_no+'" target="_blank" title="Gatepass"><i class="fa fa-ticket" aria-hidden="true"></i>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},					
		{ text: '<?php echo lang("bill_no"); ?>',datafield: 'bill_concat',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_concat',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
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
				],
				url: '<?php echo site_url("admin/sparepart_orders/get_detailed_bill"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				data : {bill_no: row.bill_no},
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
                	showaggregates: true,	
                	columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
                	{ text: 'Part Code', datafield: 'part_code', width: 150 },
                	{ text: 'Part Name', datafield: 'name', width: 150 },
                	{ text: 'Quantity', datafield: 'dispatched_quantity', width: 200 },
                	]
                });

                openPopupWindow('jqxPopupWindowBilling_detail');
            }
        }

    </script>