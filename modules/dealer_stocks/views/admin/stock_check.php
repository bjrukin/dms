<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_stocks'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('dealer_stocks'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				Part Code: <input type="text" name="part_code" id="part_code">
				<?php echo displayStatus(); ?>
				<div id="jqxGridDealerCheck"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){	
		
		var dealer_stocksDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'dealer_name', type: 'string' },
			{ name: 'phone_1', type: 'string' },
			],
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_stocksDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDealerCheck").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDealerCheck").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDealerCheck").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dealer_stocksDataSource,
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
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 300,filterable: false,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("phone_1"); ?>',datafield: 'phone_1',width: 300,filterable: false,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});
});

	$('#part_code').change(function(){
		var part_code = $('#part_code').val();
		$.post('<?php echo site_url('dealer_stocks/check_other_dealer_stock') ?>',{part_code:part_code},function(result){
			if(result.success == false)
			{
				alert(result.msg);
				$('#jqxGridDealerCheck').jqxGrid('clear');
			}
			else
			{
				$('#jqxGridDealerCheck').jqxGrid('clear');
				$.each(result.success,function(i,v)
				{
					var add_data = {
						'dealer_name' : v.dealer_name,
						'phone_1' : v.phone_1
					}
					$("#jqxGridDealerCheck").jqxGrid('addrow', null, add_data);
				});
			}
		},'JSON');
	});
</script>
