<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Vehicle Detail</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSparepartToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSparepartFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSparepart"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){

		var sparepartsDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'chass_no', type: 'string' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'full_name', type: 'string' },
			{ name: 'firm_name', type: 'string' },
			{ name: 'retail_year', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			
			
			],
			url: '<?php echo site_url("admin/spareparts/vehicle_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepartsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSparepart").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepart").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepart").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sparepartsDataSource,
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
		selectionmode: 'multiplecelladvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSparepartToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		/*{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editSparepartRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},	*/		
		{ text: 'Chassis No.',datafield: 'chass_no',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Engine No.',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Vehicle',datafield: 'vehicle_name',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Variant',datafield: 'variant_name',width: 100,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Color',datafield: 'color_name',width: 200,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Customer Name',datafield: 'full_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Dealer',datafield: 'dealer_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Firm Name',datafield: 'firm_name',width: 250,filterable: true, cellsformat : 'F2',renderer: gridColumnsRenderer },
		{ text: 'Retail',datafield: 'dispatched_date_np',width: 100,filterable: true, cellsformat : 'F2',renderer: gridColumnsRenderer },
		{ text: 'Retail Year',datafield: 'retail_year',width: 100,filterable: true, cellsformat : 'F2',renderer: gridColumnsRenderer },
		
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepart").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepartFilterClear', function () { 
		$('#jqxGridSparepart').jqxGrid('clearfilters');
	});

	

	$('#form-spareparts').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [
		{ input: '#spareparts_name', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#spareparts_name').val();
			return (val == '' || val == null || val == 0) ? false: true;
		}
	},

	{ input: '#part_code', message: 'Required', action: 'blur', 
	rule: function(input) {
		val = $('#part_code').val();
		return (val == '' || val == null || val == 0) ? false: true;
	}
},

]
});

	
});



function reset_form_spareparts(){
	$('#spareparts_id').val('');
	$('#form-spareparts')[0].reset();
}
</script>