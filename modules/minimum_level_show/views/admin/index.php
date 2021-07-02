<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Kathmandu Stock Report</h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Kathmandu Stock Report</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				
				<!-- </div> -->
				<div id="jqxGridminimum_stock"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script language="javascript" type="text/javascript">

	$(function(){

		var minimum_stockDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_code', type: 'string' },
			{ name: 'stock_count', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'required_stock_positive', type: 'number' },
			],
			url: '<?php echo site_url("admin/minimum_level_show/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	minimum_stockDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridminimum_stock").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridminimum_stock").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridminimum_stock").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: minimum_stockDataSource,
		altrows: true,
		pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight: 30,
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		autoshowfiltericon: true,
		columnsreorder: true,
		selectionmode: 'multiplecellsadvanced',
		showstatusbar: true,
		showaggregates: true,
		statusbarheight: 25,
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSpareparts_dealersales_listToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: 'Vehicle',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Variant',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Color Code',datafield: 'color_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Color Name',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Stock Available',datafield: 'stock_count',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ["sum"] },
		{ text: 'Minimum Quantity',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ["sum"] },
		{ text: 'Required Quantity',datafield: 'required_stock_positive',width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ["sum"] },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});


	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridminimum_stock").jqxGrid('refresh');}, 500);
	});




    /*$('#form-minimum_stock').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#sparepart_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sparepart_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#price').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/


});

</script>