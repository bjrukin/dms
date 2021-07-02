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
			<li><a href="<?php echo site_url('service_reports');?>"><?php echo lang('service_reports');?></a></li>
			<li class="active"><?php echo lang('service_reports'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('service_reports'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('job_summary_service_type'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_jobSummary1"></div>
				</div>
				<!-- <div class="box-footer clearfix"></div> -->
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title"><?php echo lang('job_summary_model'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_jobSummary2"></div>
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
			var name = $("#dealer_list").val();
			<?php
			}
			?>
			if(selection == "")
			{
				alert('Please select date range');
			}
			else
			{
					if (selection != null) {			 
				var jobSummary1source =
				{
					datatype: "json",
					datafields: [
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'variant_name', type: 'string' },
					{ name: 'AMC', type: 'int' },
					{ name: 'FREE', type: 'int' },
					{ name: 'PAID(AW)', type: 'int' },
					{ name: 'PAID(UW)', type: 'int' },
					{ name: 'RUNNING REPAIR', type: 'int' },
					{ name: 'ACCIDENTAL', type: 'int' },
					{ name: 'Other', type: 'int' },
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/get_jobSummary/1'); ?>'
				};
				var jobSummary1dataAdapter = new $.jqx.dataAdapter(jobSummary1source);
				$("#jqxGrid_jobSummary1").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: jobSummary1dataAdapter,
					columnsresize: true,
					columns: [
					{ text: '<?php echo lang("vehicle_name"); ?>', datafield: 'vehicle_name', cellsrenderer   : function(row,columnfield,value){
						var data = $('#jqxGrid_jobSummary1').jqxGrid('getrowdatabyid', row);
						return data.vehicle_name+" "+data.variant_name;
					}},
					{ text: 'AMC', datafield: 'AMC', width:'9%' },
					{ text: 'FREE', datafield: 'FREE', width:'9%' },
					{ text: 'PAID(AW)', datafield: 'PAID(AW)', width:'9%' },
					{ text: 'PAID(UW)', datafield: 'PAID(UW)', width:'9%' },
					{ text: 'RUNNING REPAIR', datafield: 'RUNNING REPAIR', width:'9%' },
					{ text: 'ACCIDENTAL', datafield: 'ACCIDENTAL', width:'9%' },
					{ text: 'Other', datafield: 'Other', width:'9%' },
					]
				});

				var jobSummary2source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'date' },
					{ name: 'variant_id', type: 'int' },
					{ name: 'variant_name', type: 'string' },
					{ name: 'vehicle_id', type: 'int' },
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'recieved', type: 'int' },
					{ name: 'delivered', type: 'int' },
					{ name: 'ready', type: 'int' },
					{ name: 'pending', type: 'int' },
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/get_jobSummary/2'); ?>'
				};
				var jobSummary2dataAdapter = new $.jqx.dataAdapter(jobSummary2source);
				$("#jqxGrid_jobSummary2").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: jobSummary2dataAdapter,
					columnsresize: true,
					columns: [
					{ text: '<?php echo lang("vehicle_name"); ?>', datafield: 'vehicle_name', cellsrenderer   : function(row,columnfield,value){
						var data = $('#jqxGrid_jobSummary2').jqxGrid('getrowdatabyid', row);
						return data.vehicle_name+" "+data.variant_name;
					}},
					{ text: '<?php echo lang("recieved"); ?>', datafield: 'recieved', width: '15%'},
					{ text: '<?php echo lang("delivered"); ?>', datafield: 'delivered', width: '15%'},
					{ text: '<?php echo lang("ready"); ?>', datafield: 'ready', width: '15%'},
					{ text: '<?php echo lang("pending"); ?>', datafield: 'pending', width: '15%'},
					]
				});
			}
			}
		
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
