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
			<li class="active"><?php echo lang('service_reports'); ?></li>
			<li class="active"><?php echo lang('job_register'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('job_register'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<div class="row">
						<?php
						if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_dealer_incharge() || is_service_finance()))
						{
						?>
							<div class="col-md-6">
								<label for='dealer_id'><?php echo lang("dealer_name"); ?></label>
								<div>
								<div id='dealer_list' name='dealer_list'></div>
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
					<h3 class="box-title"><?php echo lang('job_register'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_dent_paint"></div>
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
				<?php
			if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_dealer_incharge() || is_service_finance()))
			{
			?>
			var dname =$( "input[name=dealer_list]" ).val();
			var dealername = dname.replace(",", "-");
			var name =  dealername.replace(/,/g, '-');
			<?php
			}
			?>
			// if (selection != null) {
				var dent_paint_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'chassis_no', type: 'string' },
					{ name: 'kms', type: 'number' },
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'service_type_name', type: 'string' },
					{ name: 'mechanic_name', type: 'string' },
					{ name: 'full_name', type: 'string' },
					{ name: 'mobile', type: 'string' },
					{ name: 'city', type: 'string' },
					{ name: 'job_description', type: 'string' },
					{ name: 'customer_voice', type: 'string' },					
					{ name: 'vehicle_no', type: 'string' },					
					{ name: 'service_count', type: 'string' },					
					{ name: 'jobcard_group', type: 'string' },					
					// { name: 'service_no', type: 'string' },					
					// { name: 'spareparts', type: 'string' },					
					{ name: 'job_desc', type: 'string' },					
					],
					data: {selection:selection,name:name},
					type: 'get',
					url: '<?php echo site_url('service_reports/job_register/json'); ?>',
					pagesize: defaultPageSize,
						root: 'rows',
						id : 'id',
						cache: true,
						pager: function (pagenum, pagesize, oldpagenum) {
			        	//callback called when a page or page size is changed.
			        },
			        beforeprocessing: function (data) {
			        	dent_paint_source.totalrecords = data.total;
			        },
				    // update the grid and send a request to the server.
				    filter: function () {
				    	$("#jqxGrid_dent_paint").jqxGrid('updatebounddata', 'filter');
				    },
				    // update the grid and send a request to the server.
				    sort: function () {
				    	$("#jqxGrid_dent_paint").jqxGrid('updatebounddata', 'sort');
				    },
				    processdata: function(data) {
	    }
				};
				var dent_paint_dataAdapter = new $.jqx.dataAdapter(dent_paint_source);
				$("#jqxGrid_dent_paint").jqxGrid(
				{
					theme: theme,
					width: '100%',
					height: gridHeight,
					source: dent_paint_dataAdapter,
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
					{ text: 'Job card No.', datafield: 'jobcard_group', width:'9%' },
					{ text: '<?php echo lang("chassis_no"); ?>', datafield: 'chassis_no', width:'9%' },
					{ text: '<?php echo lang("registered_no"); ?>', datafield: 'vehicle_no', width:'9%'},
					{ text: '<?php echo lang("kms"); ?>', datafield: 'kms', width:'9%' },
					{ text: '<?php echo lang("customer_name"); ?>', datafield: 'full_name', width:'9%' },
					{ text: '<?php echo lang("model"); ?>', datafield: 'vehicle_name', width:'9%' },
					{ text: '<?php echo lang("service_type_name"); ?>', datafield: 'service_type_name', width:'9%' },
					{ text: '<?php echo lang("service_no"); ?>', datafield: 'service_count', width:'9%' },
					{ text: '<?php echo lang("mechanic_name"); ?>', datafield: 'mechanic_name', width:'9%' },
					{ text: '<?php echo lang("mobile"); ?>', datafield: 'mobile', width:'9%' },
					{ text: '<?php echo lang("city"); ?>', datafield: 'city', width:'9%' },
					// { text: '<?php echo lang("spareparts_used"); ?>', datafield: 'spareparts', width:'10%' },
					{ text: '<?php echo lang("job_description"); ?>', datafield: 'job_desc', width:'12%' },
					{ text: '<?php echo lang("customer_voice"); ?>', datafield: 'customer_voice', width:'12%' },
					],
					rendergridrows: function (result) {
						return result.data;
					}
				});

				$("[data-toggle='offcanvas']").click(function(e) {
					e.preventDefault();
					setTimeout(function() {$("#jqxGrid_dent_paint").jqxGrid('refresh');}, 500);
				});

				$(document).on('click','#jqxGrid_dent_paintFilterClear', function () { 
					$('#jqxGrid_dent_paint').jqxGrid('clearfilters');
				});


				
			// }
		});

		<?php
			if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_dealer_incharge() || is_service_finance()))
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
			theme: 'energyblue',
			width: '225px',
			height: '25px',
			// searchMode:'endswith',
			// checkboxes:true,
			displayMember: "name",
			valueMember: "id",
			multiSelect: true,
			selectionMode: 'dropDownList',
	        autoComplete: true,
	        searchMode: 'containsignorecase',
	        source: dealerAdapter,
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
