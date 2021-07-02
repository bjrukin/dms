<div class="content-wrapper" style="margin-left: 20px !important">
	<!-- Content Header (Page header) -->
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
								
					<div class="box-body">
					
						<div id="jqxmonthlysales"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">



	var partial_monthly = function(){
	
    	 var monthlysource =
		{
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'number' },
				
				{ name: 'name', type: 'string' },
				{ name: 'dispatched_quantity', type: 'number' },
				{ name: 'total_amount', type: 'number' },
				
	        ],
			url: '<?php echo site_url('stock_records/get_monthly_spareparts_sales')?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
		
		
			pager: function (pagenum, pagesize, oldpagenum) {
	        	//callback called when a page or page size is changed.
	        },
	        beforeprocessing: function (data) {
	        	monthlysource.totalrecords = data.total;
	        },
		   // update the grid and send a request to the server.
		    filter: function () {
		    	$("#jqxmonthlysales").jqxGrid('updatebounddata', 'filter');
		    },
		    // update the grid and send a request to the server.
		    sort: function () {
		    	$("#jqxmonthlysales").jqxGrid('updatebounddata', 'sort');
		    },
		    processdata: function(data) {
		    }
		};


		$("#jqxmonthlysales").jqxGrid({
			theme: theme,
			width: '100%',
			height: (gridHeight - 65),
			source: monthlysource,
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
				// var container = $("<div style='margin: 5px; height:50px'></div>");
				// container.append($('#jqxGridFirmToolbar').html());
				// toolbar.append(container);
			},
			columns: [
				{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
				
				{ text: 'Part Name',datafield: 'name',width: 250,filterable: true,renderer: gridColumnsRenderer },
				{ text: 'Total Quantity',datafield: 'dispatched_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: 'Total Value',datafield: 'total_amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
				
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});



	}
</script>

