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
			<li class="active"><?php echo 'Job Wise Billing'; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo 'Job Wise Billing'; ?></h3>
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
						<div class="col-md-6">
							<label><?php echo 'Jobs' ?></label>
							<div name="job" class="form-control" id="new_job_id" ></div>
						</div>
					</div>
					<br />
						<button type="button" id="date_range_submit">Submit</button>
						<a style="display: none" id="excel_link" class="btn btn-default" href=""><i class="fa fa-file-excel-o"></i>Excel</a>

				</div>
				<div class="box-footer clearfix">
					<!-- <button type="button" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i> </button> -->
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title"><?php echo 'Job Wise Billing'; ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_pdi_reports"></div>
				</div>
				<!-- <div class="box-footer clearfix"></div> -->
			</div>
		</div>


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(function(){

		var jobDataSource = {
			url : '<?php echo site_url("admin/service_jobs/get_jobs"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'job_code', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'apply_tax', type: 'string' },
			{ name: 'mechanic_incentive', type: 'string' },
			{ name: 'job_description', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		jobAdapter = new $.jqx.dataAdapter(jobDataSource);

		$("#new_job_id").jqxComboBox({
			theme: theme,
			width: '95%',
			// height: 30,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: jobAdapter,
			displayMember: "job_description",
			valueMember: "id",
			placeHolder: "Enter Job Code",
		});
		$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true, formatString: "yyyy-MM-dd" });
		$('#date_range').jqxDateTimeInput('setRange', null, null);

		$("#date_range_submit").on('click', function (event) {
			var selection = $("#date_range").jqxDateTimeInput('getText');
			var new_job_id =$("#new_job_id").jqxComboBox('val');
			<?php
			if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_dealer_incharge() || is_service_finance()))
			{
			?>
			var dname =$( "input[name=dealer_list]" ).val();
			var dealername = dname.replace(",", "-");
			var name =  dealername.replace(/,/g, '-');
			if(selection){
				var strArray = selection.split(" ");
				var startdate = strArray[0];
				var enddate = strArray[2];
				var excel_link = '<?php echo site_url('service_reports/get_job_wise_billing_summary_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+new_job_id+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/get_job_wise_billing_summary_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+new_job_id+'/'+name);
	        	$("#excel_link").show();
			}	
			<?php
			}
			else
			{
			?>
			if(selection){
				var strArray = selection.split(" ");
				var startdate = strArray[0];
				var enddate = strArray[2];
				var excel_link = '<?php echo site_url('service_reports/get_job_wise_billing_summary_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+new_job_id);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/get_job_wise_billing_summary_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+new_job_id);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>
			if (selection != null || new_job_id != null) {
				var pdi_reports_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'string' },
					{ name: 'issue_date', type: 'string' },
					{ name: 'job_code', type: 'string' },
					{ name: 'description', type: 'string' },
					{ name: 'status', type: 'string' },
					{ name: 'dealer_name', type: 'string' },
					{ name: 'discount_amount', type: 'number' },
					{ name: 'discount_percentage', type: 'number' },
					{ name: 'final_amount', type: 'number' },
					{ name: 'price', type: 'number' },
					{ name: 'invoice_no', type: 'number' },			

					],
					data: {selection:selection,name:name,job_id:new_job_id},
					type: 'post',
					url: '<?php echo site_url('service_reports/get_job_wise_billing_summary/json'); ?>'
				};
				var pdi_reports_dataAdapter = new $.jqx.dataAdapter(pdi_reports_source);
				$("#jqxGrid_pdi_reports").jqxGrid(
				{
					width: '100%',
					height: '300px',
					showstatusbar: true,
					showaggregates: true,
					source: pdi_reports_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo lang("issue_date"); ?>', datafield: 'issue_date', width:'9%' },
					{ text: '<?php echo 'Dealer Name'; ?>', datafield: 'dealer_name', width:'9%' },
					{ text: '<?php echo 'Invoice No'; ?>', datafield: 'invoice_no', width:'9%' },
					{ text: '<?php echo 'Job Code'; ?>', datafield: 'job_code', width:'9%' },
					{ text: '<?php echo 'Job Description'; ?>', datafield: 'description', width:'9%' },
					{ text: '<?php echo 'Status'; ?>', datafield: 'status', width:'9%' },
					{ text: '<?php echo 'Price'; ?>', datafield: 'price', width:'9%' ,cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'Discount Percentage'; ?>', datafield: 'discount_percentage', width:'9%' },
					{ text: '<?php echo 'Discount Amount'; ?>', datafield: 'discount_amount', width:'9%',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Final Amount'; ?>', datafield: 'final_amount', width:'9%',cellsformat: 'd2', aggregates: ['sum']  },
					
					]
				});

				
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
