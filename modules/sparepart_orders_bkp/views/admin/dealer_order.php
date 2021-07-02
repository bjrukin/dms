<div class="row">
	<div class="col-md-12">
		<div class="section" style="height: 70px; margin-top: 20px;">
			<form action="<?php echo base_url('sparepart_orders/dealer_order_import') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="order_type" id="order_type">
				<input type="hidden" name="dispatch_mode" id="order_dispatch_mode">
				<div class="row">
					<div class="col-md-2 col-sm-3"><b>Order Type: </b><span class='mandatory'>*</span></div>	
					<div class="col-md-1 col-sm-3">
						<div id="stock_order">Stock Order</div>
					</div>
					<div class="col-md-1 col-sm-3">
						<div id="vor_order">VOR Order</div>
					</div>
					<div class="col-md-1 col-sm-3">
						<div id="accidental">Accidental</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<label for="dispatch_mode">Dispatch Mode:<span class='mandatory'>*</span></label>
					</div>
					<div class="col-md-1 col-sm-3">
						<div id="radio_dispatch_land">Land</div>
					</div>
					<div class="col-md-1 col-sm-3">
						<div id="radio_dispatch_air">Air</div>
					</div>
				</div>
				<div class="row">							
					<div class="col-md-2 col-xs-12"> <label for="dispatch_mode">Select File:</label> </div> 
					<div class="col-md-4 col-xs-6"> <input type="file" name="userfile" style="float: left;"></div>
					<div class="col-md-6 col-xs-6"> <button class="btn btn-primary btn-flat btn-bg" id="submit_form" disabled="true">Read</button></div><br>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 connectedSortable">
		<?php echo displayStatus(); ?>
		<div id='jqxGridSparepart_orderToolbar' class='grid-toolbar'>
			<div style="float: right; margin-right: 20px"><h4>Limit Available: Rs.<?php echo round($credit_limit->credit_policy - $credit_limit->actual_credit + $opening_credit->opening_credit,2); ?></h4></div>
		</div>
		<div id="jqxGridSparepart_order"></div>
	</div><!-- /.col -->
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		$("#radio_dispatch_land").jqxRadioButton({ width: 250, height: 25, groupName :"dispatch_mode"});
		$("#radio_dispatch_air").jqxRadioButton({ width: 250, height: 25, groupName :"dispatch_mode"});
		$('#radio_dispatch_land').on('change', function (event) {
			check_readable();
 			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_dispatch_mode').val('LAND');			
			}
		});
		$('#radio_dispatch_air').on('change', function (event) {
			check_readable();
 			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_dispatch_mode').val('AIR');			
			}
		});

		$("#stock_order").jqxRadioButton({ width: 250, height: 25, groupName :"order_type"});
		$("#vor_order").jqxRadioButton({ width: 250, height: 25, groupName :"order_type"});
		$("#accidental").jqxRadioButton({ width: 250, height: 25, groupName :"order_type"});
		$('#stock_order').on('change', function (event) { 
			check_readable();
			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_type').val('STOCK');
			}
		});
		$('#vor_order').on('change', function (event) { 
			check_readable();
			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_type').val('VOR');
			}
		});
		$('#accidental').on('change', function (event) { 
			check_readable();
			var checked = event.args.checked;
			if(checked == true)
			{
				$('#order_type').val('ACCIDENTAL');
			}
		});

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'order_quantity', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'created_at', type: 'string' },
			{ name: 'total_price', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'dealer_price', type: 'number' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/json"); ?>',
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
	    	$("#jqxGridSparepart_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepart_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepart_order").jqxGrid({
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
		showstatusbar: true,
		theme:theme,
		statusbarheight: 30,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,
		selectionmode: 'multiplecellsadvanced',
		virtualmode :true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:60px'></div>");
			container.append($('#jqxGridSparepart_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},					
		{ text: '<?php echo lang("order_date"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'order_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum'], cellsformat: 'F2' },	 
		{ text: '<?php echo lang("price"); ?>',datafield: 'dealer_price',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum'] , cellsformat: 'F2'},	 
		{ text: '<?php echo lang("total_price"); ?>',datafield: 'total_price',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum'], cellsformat: 'F2' },	 


		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepart_order").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepart_orderFilterClear', function () { 
		$('#jqxGridSparepart_order').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSparepart_orderInsert', function () { 
		openPopupWindow('jqxPopupWindowSparepart_order', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

});

function check_readable()
{
	var order_type1 = $("#stock_order").val();
	var order_type2 = $("#vor_order").val();
	var order_type3 = $("#accidental").val(); 

	var dispatch_mode1 = $("#radio_dispatch_land").val();
	var dispatch_mode2 = $("#radio_dispatch_air").val();

	if((order_type1 || order_type2 || order_type3) && (dispatch_mode1 || dispatch_mode2))
	{
		$('#submit_form').attr('disabled',false);
	}
}
</script>