<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo "Generate Order"//lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div id="success_msg" class="alert alert-success" style="display: none;">
					<span>Successfully Saved</span>
				</div>
			</div> 
			<div class="col-md-12">
				<button id="generate_order" class="btn btn-flat btn-warning btn-xs">Generate System Order</button>
				<button id="generate_back_order" class="btn btn-flat btn-success btn-xs">Generate Back Order</button>			
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 connectedSortable">				
				<div id="jqxGridMsil_generate_order"></div>
			</div><!-- /.col -->
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-1">
						<div id="radio_land_order">Land</div>
					</div>
					<div class="col-md-11">
						<div id="radio_air_order">Air</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<button id="export_order" class="btn btn-flat btn-warning btn-xs" style="float: left; margin-right: 10px">Save</button>
				<form action="<?php echo site_url('dispatch_spareparts/generate_excel')?>">
					<input type="hidden" name="order_no" class="msil_order_id">
					<input type="hidden" name="order_type_export" id="order_type_export">
					<button class="btn btn-flat btn-success btn-xs" id="generate_excel_order">Export Order Land</button>
				</form>				
			</div>
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

var order_type_sp = '';

	$(function(){
		$("#radio_land_order").jqxRadioButton({ width: 250, height: 25});
		$("#radio_air_order").jqxRadioButton({ width: 250, height: 25});
		$('#radio_land_order').on('change', function (event) { 
			var checked = event.args.checked;
			if(checked == true)
			{
				order_type_sp = 'land';			
			}
		});
		$('#radio_air_order').on('change', function (event) { 
			var checked = event.args.checked;
			if(checked == true)
			{
				order_type_sp = 'air';			
			}
		});
		var msil_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'required_quantity', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },

			],
			//url: '<?php echo site_url("admin/msil_orders/grouped_order"); ?>',
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
	    	$("#jqxGridMsil_generate_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMsil_generate_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridMsil_generate_order").jqxGrid({
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
		editable : true,
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
			container.append($('#jqxGridMsil_generate_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},		
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("required_quantity"); ?>',datafield: 'required_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
		
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridMsil_generate_order").jqxGrid('refresh');}, 500);
	});

	
});
	$('#generate_order').click(function()
	{
		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/dispatch_spareparts/generate_msil_order"); ?>',
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success == true) 
				{
					$("#jqxGridMsil_generate_order").jqxGrid('clear')
					$.each(result.rows,function(i,v){								
						datarow = {
							'part_name':v.part_name,
							'part_code':v.part_code,
							'required_quantity':v.required_quantity
						};
						$("#jqxGridMsil_generate_order").jqxGrid('addrow', null, datarow);
					});

				}
			}
		});
	});

	$('#generate_back_order').click(function()
	{
		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/dispatch_spareparts/generate_back_order"); ?>',
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success == true) 
				{
					$("#jqxGridMsil_generate_order").jqxGrid('clear');
					$.each(result.rows,function(i,v){								
						datarow = {
							'part_name':v.part_name,
							'part_code':v.part_code,
							'required_quantity':v.required_quantity
						};
						$("#jqxGridMsil_generate_order").jqxGrid('addrow', null, datarow);
					});

				}
			}
		});
	});

	$('#export_order').click(function(){
		var allrows = $('#jqxGridMsil_generate_order').jqxGrid('getrows');		
		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/dispatch_spareparts/save_order"); ?>',
			data : {data:allrows,order_type:order_type_sp},
			cache: false,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success == true) 
				{
					$('.msil_order_id').val(result.final_order);
					$('#order_type_export').val(result.order_type);
					$('#success_msg').delay(500).fadeIn('normal', function() {
						$(this).delay(1000).fadeOut();
					});
				}
			}
		});
	});
</script>