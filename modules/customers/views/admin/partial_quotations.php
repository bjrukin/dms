<div id='jqxGridQuotationToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridQuotationInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridQuotationFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridQuotation"></div>
<script language="javascript" type="text/javascript">

var quotations = function() {

	var quotationsDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'quotation_date_en', type: 'date' },
			{ name: 'quotation_date_np', type: 'string' },
			{ name: 'quote_mrp', type: 'number' },
			{ name: 'quote_discount', type: 'number' },
			{ name: 'quote_price', type: 'number' },
			{ name: 'quote_unit', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/customers/quotation_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data: {
			customer_id: '<?php echo $customer_info->id;; ?>'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	quotationsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridQuotation").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridQuotation").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridQuotation").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: quotationsDataSource,
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
			container.append($('#jqxGridQuotationToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					var p = '<a href="' + base_url + 'admin/customers/quotation/' + columnproperties.id + '" target="_blank"><i class="fa fa-fw fa-print"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + p + '</div>';
				}
			},
			{ text: '<?php echo lang("quotation_date_en"); ?>',datafield: 'quotation_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("quotation_date_np"); ?>',datafield: 'quotation_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quote_mrp"); ?>',datafield: 'quote_mrp',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quote_discount"); ?>',datafield: 'quote_discount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quote_price"); ?>',datafield: 'quote_price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quote_unit"); ?>',datafield: 'quote_unit',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridQuotation").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridQuotationFilterClear', function () { 
		$('#jqxGridQuotation').jqxGrid('clearfilters');
	});
};

</script>