<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('service_reports'); ?>
			<!-- <small>Control panel</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li><?php echo lang('service_reports'); ?></li>
			<li class="active">Spareparts Register</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title">Spareparts Register</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<div class="row">
						<?php
						if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_finance()))
						{
						?>
							<div class="col-md-6">
								<label for='dealer_id'><?php echo lang("dealer_name"); ?></label>
								<div>
								<div id='dealer_list' class='form-control input-sm' name='dealer_list'></div>
								</div>   
							</div>
						<?php
						}
						?>
						<div class="col-md-6">
							<label><?php echo lang("date_range"); ?></label>
							<div id='date_range' name='date_range'></div>
						</div>
					</div>
					<br />
						<button type="button" id="date_range_submit">Submit</button>
						

				</div>
				<div class="box-footer clearfix">
					<!-- <button type="button" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i> </button> -->
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title">Spareparts Register</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_counter_sales"></div>
				</div>
				<!-- <div class="box-footer clearfix"></div> -->
			</div>
		</div>


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(function(){
		$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true, formatString: "yyyy-MM-dd" });
		$('#date_range').jqxDateTimeInput('setRange', null, null);

		$("#date_range_submit").on('click', function (event) {
			var selection = $("#date_range").jqxDateTimeInput('getText');
			// console.log(selection);
			<?php
			if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_finance()))
			{
			?>
			var name = $("#dealer_list").val();
			<?php
			}
			?>
			// if (selection != null) {
				var counter_sales_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'jobcard_group', type: 'string' },
					{ name: 'dealer_name', type: 'string' },
					// { name: 'issue_date', type: 'date' },
					{ name: 'invoice_no', type: 'string' },
					{ name: 'mechanic_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'part_name', type: 'string' },
					{ name: 'taxable', type: 'string' },
					{ name: 'taxes', type: 'string' },
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'chassis_no', type: 'string' },
					// { name: 'quantity', type: 'string' },
					{ name: 'net_amount', type: 'string' },
					// { name: 'discount_percentage', type: 'string' },
					{ name: 'price', type: 'string' },
					],
					data: {selection:selection,name:name},
					type: 'get',
					url: '<?php echo site_url('service_reports/spareparts_register/json'); ?>',
					pagesize: defaultPageSize,
						root: 'rows',
						id : 'id',
						cache: true,
						pager: function (pagenum, pagesize, oldpagenum) {
			        	//callback called when a page or page size is changed.
			        },
			        beforeprocessing: function (data) {
			        	counter_sales_source.totalrecords = data.total;
			        },
				    // update the grid and send a request to the server.
				    filter: function () {
				    	$("#jqxGrid_counter_sales").jqxGrid('updatebounddata', 'filter');
				    },
				    // update the grid and send a request to the server.
				    sort: function () {
				    	$("#jqxGrid_counter_sales").jqxGrid('updatebounddata', 'sort');
				    },
				    processdata: function(data) {
	    }
				};
				var counter_sales_dataAdapter = new $.jqx.dataAdapter(counter_sales_source);
				$("#jqxGrid_counter_sales").jqxGrid(
				{

					theme: theme,
					width: '100%',
					height: '400px',

					showstatusbar: true,
					showaggregates: true,
					source: counter_sales_dataAdapter,
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
						container.append($('#jqxGridCcd_inquiryToolbar').html());
						toolbar.append(container);
					},
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: 'Dealer Name', datafield: 'dealer_name', width:'12%',filterable: true,renderer: gridColumnsRenderer},
					{ text: 'Mechanic Name', datafield: 'mechanic_name', width:'12%',filterable: true,renderer: gridColumnsRenderer},
					{ text: 'Job Card No', datafield: 'jobcard_group', width:'9%',filterable: true,renderer: gridColumnsRenderer},

					
					{ text: 'Chasis No.', datafield: 'chassis_no', width:'9%',filterable: true,renderer: gridColumnsRenderer},
					{ text: 'Vehicle Name', datafield: 'vehicle_name', width:'9%',filterable: true,renderer: gridColumnsRenderer},
					// { text: 'Issue date', datafield: 'issue_date', width:'9%',filterable: true,renderer: gridColumnsRenderer, filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
					{ text: 'Part Code', datafield: 'part_code',width:'18%',filterable: true,renderer: gridColumnsRenderer},
					{ text: 'Part Name', datafield: 'part_name',width:'18%',filterable: true,renderer: gridColumnsRenderer},
					{ text: 'Taxable', datafield: 'taxable',width:'9%',cellsformat: 'd2', aggregates: ['sum']},
					{ text: 'Taxes', datafield: 'taxes',width:'9%',filterable: true,renderer: gridColumnsRenderer,cellsformat: 'd2', aggregates: ['sum']},
					// { text: 'Discount Percentage', datafield: 'discount_percentage',width:'12%',filterable: true,renderer: gridColumnsRenderer},
					{ text: 'Final Amount', datafield: 'net_amount',width:'18%',cellsformat: 'd2', aggregates: ['sum'] },
					
					],
					rendergridrows: function (result) {
						return result.data;
					}
				});

				$("[data-toggle='offcanvas']").click(function(e) {
					e.preventDefault();
					setTimeout(function() {$("#jqxGrid_counter_sales").jqxGrid('refresh');}, 500);
				});

				$(document).on('click','#jqxGrid_counter_salesFilterClear', function () { 
					$('#jqxGrid_counter_sales').jqxGrid('clearfilters');
				});

				
			// }
		});


		<?php
			if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_finance()))
			{
			?>


			var dealerDataSource = {
			url : '<?php echo site_url("admin/service_reports/get_service_dealer_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },		
			
			],
			// data : {group: 'mechanic_leader'}, //possible values: { mechanic_leader, dealer }
			cache: true,
			method: 'post',
		}

		dealerAdapter = new $.jqx.dataAdapter(dealerDataSource);

		$("#dealer_list").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			displayMember: "name",
			valueMember: "id",
		});

		var dealer_list_DataSource = {
					url : '<?php echo site_url("admin/service_reports/get_service_dealer_list"); ?>',
					datatype: 'json',
					datafields: [
					{ name: 'id', type: 'number' },
					{ name: 'name', type: 'string' },
					
					
					],
					// data : {group: 'dealers'/*item.originalItem.designation_id*/, dealer: item.value}, 
					// possible values: { dealer_leader, dealers }
					async: false,
					cache: true,
					method: 'post',
				}

				dealer_listAdapter = new $.jqx.dataAdapter(dealer_list_DataSource);

				$("#dealer_list").jqxComboBox({source: dealer_listAdapter });
			

			<?php
			}
			?>


	});

</script>
