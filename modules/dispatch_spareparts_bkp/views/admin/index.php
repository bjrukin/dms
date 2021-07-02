<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('fms_calculation'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('dispatch_spareparts'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>				
				<div id="jqxGridDispatch_sparepart"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->	
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){

		var dispatch_sparepartsDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			// { name: 'model', type: 'string' },					
			// { name: 'alternate_part_code', type: 'string' },					
			{ name: 'fms', type: 'string' },					
			{ name: 'abc', type: 'string' },					
			{ name: 'fmsabc', type: 'string' },					
			{ name: 'percentage_fms', type: 'number' },					
			{ name: 'percentage_abc', type: 'number' },					
			{ name: 'quantity', type: 'number' },					
			{ name: 'total_dispatched', type: 'number' },					
			{ name: 'total_cost', type: 'number' },					
			{ name: 'price', type: 'number' },					
			{ name: 'latest_part_code', type: 'string' },					
			],
			url: '<?php echo site_url("admin/dispatch_spareparts/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dispatch_sparepartsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDispatch_sparepart").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDispatch_sparepart").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	$("#jqxGridDispatch_sparepart").jqxGrid({
		width: '100%',
		height: gridHeight,
		source: dispatch_sparepartsDataSource,
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
		virtualmode :true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridDispatch_sparepartToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},

		{ text: '<?php echo lang("part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("stock_quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dispatched_quantity"); ?>', datafield: 'total_dispatched', width: 150, align: 'center', cellsformat: 'n4', aggregates: ['sum'],
		aggregatesrenderer: function (aggregates) 
		{
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Qty';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}
	}, 
	{ text: '<?php echo lang("total_cost"); ?>',datafield: 'total_cost',width: 150,filterable: true,renderer: gridColumnsRenderer },

	{ text: '<?php echo lang("percentage_fms"); ?>',datafield: 'percentage_fms',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("percentage_abc"); ?>',datafield: 'percentage_abc',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("fms"); ?>',datafield: 'fms',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("abc"); ?>',datafield: 'abc',width: 150,filterable: true,renderer: gridColumnsRenderer },
	{ text: '<?php echo lang("fmsabc"); ?>',datafield: 'fmsabc',width: 150,filterable: true,renderer: gridColumnsRenderer },
	],
	rendergridrows: function (result) {
		return result.data;
	}
});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDispatch_sparepart").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDispatch_sparepartFilterClear', function () { 
		$('#jqxGridDispatch_sparepart').jqxGrid('clearfilters');
	});

});
</script>