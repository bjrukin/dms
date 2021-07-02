
<div class="content-wrapper">
	<section class="content">
		<section class="content-header ">
			<?php echo displayStatus(); ?>
		</section>
		<div class="box">

			<div class="box-header">
			<h3><?php echo "Backlog"//lang(); ?></h3>
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<h4><?php echo $dealer_info->dealer_name;?> (Order No.:<?php echo $order_no;?>)</h4>
				</div>
			</div>
				<div class="row">
					<div class="col-md-12">
						<div id="jqxGridLeftLogList"></div>
						
					</div>
				</div>
			</div>

		</div>

	</section>
</div>

<script type="text/javascript">
	

	var leftLogs_DataSource =
	{
		datatype: "json",
		datafields: [
			// { name: 'id', type: 'number' },			
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'order_quantity', type: 'number' },
			{ name: 'dispatch_quantity', type: 'number' },
			{ name: 'required_quantity', type: 'number' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/dispatch_left_log_json/".$order_no."/".$dealer_id); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'order_id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	leftLogs_DataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridLeftLogList").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridLeftLogList").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridLeftLogList").jqxGrid({		
		width: '100%',
		height: gridHeight,
		source: leftLogs_DataSource,
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
		// editable: true,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		showaggregates: true,
		selectionmode: 'singlecell',
		ready: function () {
			var rowsCount = $("#jqxGridLeftLogList").jqxGrid("getrows").length;
			for (var i = 0; i < rowsCount; i++) {
				var currentQuantity = $("#jqxGridLeftLogList").jqxGrid('getcellvalue', i, "order_quantity");
				var currentPrice = $("#jqxGridLeftLogList").jqxGrid('getcellvalue', i, "price");
				var currentTotal = currentQuantity * currentPrice;
				$("#jqxGridLeftLogList").jqxGrid('setcellvalue', i, "total", currentTotal.toFixed(2));
			}
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width:200, filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("price"); ?>', datafield: 'price', align:'center', cellsalign: 'right', width : 150, cellsformat: 'F2'},
		{ text: '<?php echo lang("quantity"); ?>', datafield: 'order_quantity', width: 150, align:'center',cellsalign: 'right', cellsformat: 'n4', aggregates: ['sum'], aggregatesrenderer: function (aggregates) {
			var renderstring = "";
			$.each(aggregates, function (key, value) {
				var name = 'Total Qty';
				renderstring += '<div style="position: relative; margin: 4px; overflow: hidden;">' + name + ': ' + value + '</div>';
			});
			return renderstring;
		}}, 
		{ text: '<?php echo lang("dispatched_quantity"); ?>',datafield: 'dispatch_quantity',width: 150, align:'center',cellsalign: 'right', filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remaining_quantity"); ?>', datafield: 'required_quantity', align:'center', cellsalign: 'right', width : 150},
		{ text: '<?php echo lang("total_amount") ?>', editable: false, width: 150, datafield: 'total', align:'center', cellsalign: 'right', aggregates: ['sum'] },
		]
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridLeftLogList").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridLeftLogListFilterClear', function () { 
		$('#jqxGridLeftLogList').jqxGrid('clearfilters');
	});

</script>
