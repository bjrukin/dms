<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="pull-right">
			<?php if($mismatch > 0): ?>
				<a href="<?php echo site_url('admin/msil_order_mismatches'); ?>" target = "_blank"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></a>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridMsil_orderToolbar' class='grid-toolbar'>
					<form action="<?php echo base_url('msil_orders/upload_order') ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-2"><label>Uplode MSIL Order</label></div>
						<div class="col-md-2"><input type="file" name="userfile"></div>
						<div class="col-md-1"><button class="btn btn-primary btn-flat btn-xs">Upload</button></div>
					</form>
				</div>
				<div id="jqxGridMsil_order"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){

		var msil_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'order_id', type: 'number' },
			{ name: 'firm_name', type: 'string' },
			{ name: 'firm_id', type: 'number' },
			{ name: 'order_no', type: 'string' },
			],
			url: '<?php echo site_url("admin/msil_orders/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	msil_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridMsil_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMsil_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridMsil_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: msil_ordersDataSource,
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
			container.append($('#jqxGridMsil_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index,b,c,d,e,value) {
				var e = '';
				e += '<a href="<?php echo site_url('msil_orders/list_msil_order') ?>/'+value.order_id+'/'+value.firm_id+'" title="List Order"  target="_blank"><i class="fa fa-list"></i></a>&nbsp';
				e += '<a href="<?php echo site_url('msil_orders/list_msil_dispatch') ?>/'+value.order_id+'/'+value.firm_id+'" title="Dispatch List"  target="_blank"><i class="fa fa-circle"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("order_id"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("firm_name"); ?>',datafield: 'firm_name',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridMsil_order").jqxGrid('refresh');}, 500);
	});
});


</script>