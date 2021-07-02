<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/pivottable/dist/pivot.css')?>"> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Spareparts</h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li>Report</li>
	        <li class="active"><?php echo 'View Spareparts'; ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12"> 
		        <div class="box">
		            <div class="box-header">
		                <!-- <h3>Absent without notice</h3> -->
		            </div>
		            <div class="box-body">
	                    <label>Part Code Here</label>
	                    <div class="row">
	                    	<div class="col-md-6">	                    			                    		
	                    		<input   class="form-control" id='partcode' name="partcode">	
	                    	</div>
			                <div class="col-md-6">
			                    <button class="btn btn-primary btn-sm" id="search_btn"><i class="fa fa-search"></i></button>
			                </div>
	                	</div>		     
		            </div>
		        </div>
    		</div>
		</div>

		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				
				<div id="jqxGridDataAbsentGrid"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(document).ready(function () {
		var searchButton = $('#search_btn');
		searchButton.on('click',function(){
			var partcode = $('#partcode').val();
			if(partcode == '' || partcode == null)
			{
				alert('Search Unavailable with empty search');
				return false;
			}
			var daily_attendence_log =
			{
				datatype: "json",
				datafields: [
					
					{ name: 'dealer_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'part_name', type: 'string' },
					{ name: 'quantity', type: 'string' },
					
					
		        ],
				url: '<?php echo site_url("admin/logistic_reports/view_stock_spareparts_json"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				data:{partcode:partcode},
				cache: true,
				pager: function (pagenum, pagesize, oldpagenum) {
		        	//callback called when a page or page size is changed.
		        },
		        beforeprocessing: function (data) {
		        	daily_attendence_log.totalrecords = data.total;
		        },
			    // update the grid and send a request to the server.
			    filter: function () {
			    	$("#jqxGridDataAbsentGrid").jqxGrid('updatebounddata', 'filter');
			    },
			    // update the grid and send a request to the server.
			    sort: function () {
			    	$("#jqxGridDataAbsentGrid").jqxGrid('updatebounddata', 'sort');
			    },
			    processdata: function(data) {
			    }
			};
			var dataAdapter = new $.jqx.dataAdapter(daily_attendence_log);
			$("#jqxGridDataAbsentGrid").jqxGrid({
				theme: theme,
				width: '100%',
				height: gridHeight,
				source: dataAdapter,
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
					container.append($('#jqxGridDataAbsentGridToolbar').html());
					toolbar.append(container);
				},
				columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: 'DEALER Name', datafield: 'dealer_name',		width: 150,filterable: true,renderer: gridColumnsRenderer},
					{ text: 'PART Name', datafield: 'part_name',		width: 150,filterable: true,renderer: gridColumnsRenderer},
					{ text: 'PART CODE', datafield: 'part_code',		width: 150,filterable: true,renderer: gridColumnsRenderer},
					{ text: 'QUANTITY', datafield: 'quantity',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				],
				rendergridrows: function (result) {
					return result.data;
				}
			});

			$("[data-toggle='offcanvas']").click(function(e) {
			    e.preventDefault();
			    setTimeout(function() {$("#jqxGridDataAbsentGrid").jqxGrid('refresh');}, 500);
			});

			$(document).on('click','#jqxGridDataAbsentGridFilterClear', function () { 
				$('#jqxGridDataAbsentGrid').jqxGrid('clearfilters');
			});
		});
	});

	
</script>