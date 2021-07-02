<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_credits'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('dealer_credits'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>			
				<div id="jqxGridDealer_credit"></div>
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'actual_credit', type: 'number' },
			{ name: 'opening_credit', type: 'number' },
			{ name: 'credit_policy', type: 'number' },
			{ name: 'remaining_credit', type: 'number' },
			],
			url: '<?php echo site_url("admin/dealer_credits/json"); ?>',
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
	    	$("#jqxGridDealer_credit").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDealer_credit").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDealer_credit").jqxGrid({
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
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index,b,c,d,e,rowvalue) {

				var e = '<a href="<?php echo site_url('admin/dealer_credits/show_detail')?>/'+rowvalue.dealer_id+'" target="_blank" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},

		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("credit_amount"); ?>',datafield: 'actual_credit',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right' },
		{ text: '<?php echo "Opening Credit"//lang("opening_credit"); ?>',datafield: 'opening_credit',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right' },
		{ text: '<?php echo lang("credit_policy"); ?>',datafield: 'credit_policy',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right' },
		{ text: '<?php echo lang("remaining_credit"); ?>',datafield: 'remaining_credit',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right' },
	],
	rendergridrows: function (result) {
		return result.data;
	}
});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDealer_credit").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDealer_creditFilterClear', function () { 
		$('#jqxGridDealer_credit').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDealer_creditInsert', function () { 
		openPopupWindow('jqxPopupWindowDealer_credit', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});
});

</script>