<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDublicate_number_logToolbar' class='grid-toolbar'>
					
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDublicate_number_logFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDublicate_number_log"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script language="javascript" type="text/javascript">

$(function(){

	var dublicate_number_logsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'customer_name', type: 'string' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'dublication_status', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'color_id', type: 'number' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'mobile', type: 'string' },
			{ name: 'previous_dealer', type: 'string' },
			{ name: 'inquiry_no', type: 'string' },
			{ name: 'inquiry_date_en', type: 'date' },
			{ name: 'inquiry_date_np', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/dublicate_number_logs/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dublicate_number_logsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDublicate_number_log").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDublicate_number_log").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDublicate_number_log").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight ,
		source: dublicate_number_logsDataSource,
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
			container.append($('#jqxGridDublicate_number_logToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			
			
			{ text: 'Inquiry',datafield: 'inquiry_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Inquiry Date',datafield: 'inquiry_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd },
			{ text: '<?php echo lang("customer_name"); ?>',datafield: 'customer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Dealer',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
						
			{ text: 'Vehicle',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Variant',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Color',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Dublicate Mobile Number',datafield: 'mobile',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Previous Dealer',datafield: 'previous_dealer',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDublicate_number_log").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDublicate_number_logFilterClear', function () { 
		$('#jqxGridDublicate_number_log').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDublicate_number_logInsert', function () { 
		openPopupWindow('jqxPopupWindowDublicate_number_log', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

});


</script>