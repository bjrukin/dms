<div class="content-wrapper" style="margin-left: 20px !important">
	<!-- Content Header (Page header) -->
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
								
					<div class="box-body">
					
						<div id="jqxMediumstock"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">



	var partial_medium = function(){
	
    	 var mediumsource =
		{
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'number' },
				
				{ name: 'part_name', type: 'string' },
				{ name: 'total_dispatched', type: 'number' },
				{ name: 'price', type: 'number' },
				
	        ],
			url: '<?php echo site_url('stock_records/get_medium_spareparts_stock')?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
		
		
			pager: function (pagenum, pagesize, oldpagenum) {
	        	//callback called when a page or page size is changed.
	        },
	        beforeprocessing: function (data) {
	        	mediumsource.totalrecords = data.total;
	        },
		   // update the grid and send a request to the server.
		    filter: function () {
		    	$("#jqxMediumstock").jqxGrid('updatebounddata', 'filter');
		    },
		    // update the grid and send a request to the server.
		    sort: function () {
		    	$("#jqxMediumstock").jqxGrid('updatebounddata', 'sort');
		    },
		    processdata: function(data) {
		    }
		};


		$("#jqxMediumstock").jqxGrid({
			theme: theme,
			width: '100%',
			height: (gridHeight - 65),
			source: mediumsource,
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
				
				{ text: 'Part Name',datafield: 'part_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
				{ text: 'Total Quantity',datafield: 'total_dispatched',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: 'Total Value',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
				
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});



	}
</script>

