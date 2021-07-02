<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo "Payment Register"//lang('dealer_credits'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo "Payment Register"//lang('dealer_credits'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>			
				<div id="jqxGridPayment_Register"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->



<script language="javascript" type="text/javascript">
	$(function(){
		var dealer_creditsDataSource =
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
			{ name: 'amount', type: 'number' },
			{ name: 'date', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'receipt_no', type: 'number' },
			],
			url: '<?php echo site_url("admin/dealer_credits/payment_json")?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_creditsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPayment_Register").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPayment_Register").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPayment_Register").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dealer_creditsDataSource,
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
			container.append($('#jqxGridDealer_creditToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},

		// { text: '<?php echo lang("cr_dr"); ?>',datafield: 'cr_dr',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right',align: 'right'},
		{ text: '<?php echo lang("receipt_no"); ?>',datafield: 'receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsalign:'right',align: 'right'},
	],
	rendergridrows: function (result) {
		return result.data;
	}
});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridPayment_Register").jqxGrid('refresh');}, 500);
	});
});

</script>