<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('service_history'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Service History</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header"><h3>Search</h3></div>
					<div class="box-body">
						<form id="form-search_history">
							<div class="row form-group">
								<div class="col-md-3 col-sm-6">
									Chassis No. : <input type="text" name="search[chassis_no]" id="chassis_no" placeholder="Input Chassis No." class="form-control">
								</div>
								<div class="col-md-3 col-sm-6">
									Vehicle No. : <input type="text" name="search[vehicle_no]" id="vehicle_no" placeholder="Input Vehicle No." class="form-control">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-3 col-sm-6">
									Coupon No. : <input type="text" name="search[coupon_no]" id="coupon_no" placeholder="Input Coupon No." class="form-control">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-3 col-sm-6">
									Customer : <input type="text" name="search[customer_name]" id="customer_name" placeholder="Input Customer Name" class="form-control">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<button type="button" class="btn btn-default btn-flat" id="search_history-submit">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<!-- <div class="box-header"> </div> -->
					<div class="box-body">
						<!-- row -->
						<div class="row">
							<div class="col-xs-12 connectedSortable">
								<h3> Jobcard </h3>
								<div id="jobcard_Grid"></div>
								<h3> Service Jobs History </h3>
								<div id="history_Grid"></div>
								<h3> Service Parts History </h3>
								<div id="partHistory_Grid"></div>
							</div><!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
				</div>
				
			</div>
		</div>

		


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript" src="http://192.168.1.242/assets/js/custom_getFormData.js"></script>
<script language="javascript" type="text/javascript">

	$(function(){
		$('#search_history-submit').on('click', function(){
			// var formdata  = $('#form-search_history').serialize();
			var formdata  = getFormData('form-search_history');
			// console.log(formdata);

			var vehicleDataSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'jobcard_group', type: 'number' },
				{ name: 'jobcard_serial', type: 'number' },
				{ name: 'vehicle_name', type: 'string' },
				{ name: 'variant_name', type: 'string' },
				{ name: 'engine_no', type: 'string' },
				{ name: 'chassis_no', type: 'string' },
				{ name: 'job_card_issue_date', type: 'date' },
				{ name: 'customer_name', type: 'string' },
				{ name: 'service_type_name', type: 'string' },
				{ name: 'service_count', type: 'number' },
				{ name: 'vehicle_no', type: 'string' },
				{ name: 'service_adviser_id', type: 'number' },
				{ name: 'service_advisor_name', type: 'string' },
				{ name: 'dealer_name', type: 'string' },
				{ name: 'coupon', type: 'string' },
				],
				url: '<?php echo site_url("admin/service_histories/json"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				data :  formdata ,
				cache: true,
			};

			var vehicledataAdapter = new $.jqx.dataAdapter(vehicleDataSource);
			$("#jobcard_Grid").jqxGrid({ source: vehicledataAdapter });

		});

		/*$('#chassis_no, #coupon_no').on('change', function(){
			var chassis_no = $('#chassis_no').val();
			var coupon_no = $('#coupon_no').val();
			var vehicleDataSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'jobcard_group', type: 'number' },
				{ name: 'jobcard_serial', type: 'number' },
				{ name: 'vehicle_name', type: 'string' },
				{ name: 'variant_name', type: 'string' },
				{ name: 'engine_no', type: 'string' },
				{ name: 'chassis_no', type: 'string' },
				{ name: 'jobcard_issue_date', type: 'string' },
				{ name: 'full_name', type: 'string' },
				{ name: 'service_type_name', type: 'string' },
				{ name: 'service_count', type: 'number' },
				],
				url: '<?php echo site_url("admin/service_histories/json"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				data : {chassis_no:chassis_no, coupon_no: coupon_no },
				cache: true,
			};

			var vehicledataAdapter = new $.jqx.dataAdapter(vehicleDataSource);
			$("#jobcard_Grid").jqxGrid({ source: vehicledataAdapter });
		});*/

		// prepare the data
		$("#jobcard_Grid").on('rowclick', function (event) {
			var	jobcard_group = event.args.row.bounddata.jobcard_group;
			var history_DataSource =
			{
				datatype: "json",
				datafields: [
				{ name: 'jobcard_group', type: 'number' },
				{ name: 'job', type: 'string' },
				{ name: 'job_description', type: 'string' },
				{ name: 'customer_voice', type: 'string' },
				{ name: 'final_amount', type: 'number' },
				// { name: 'advisor_voice', type: 'string' },
				// { name: 'advisor_voice', type: 'string' },
				// { name: 'floor_supervisor_voice', type: 'string' },
				{ name: 'status', type: 'string' },
				],
				url: '<?php echo site_url("admin/service_histories/get_job_history"); ?>',
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				data : {jobcard_group: jobcard_group},
				cache: true,
			};
			var history_dataAdapter = new $.jqx.dataAdapter(history_DataSource);
			$("#history_Grid").jqxGrid({ source: history_dataAdapter });

			var partsHistoryDataSource =
			{
				datatype: "json",
				url: '<?php echo site_url("admin/service_histories/get_part_history"); ?>',
				datafields: [
				{ name: 'jobcard_group', type: 'number' },
				{ name: 'jobcard_serial', type: 'number' },
				{ name: 'category_id', type: 'number' },
				{ name: 'part_id', type: 'number' },
				{ name: 'part_code', type: 'number' },
				{ name: 'part_name', type: 'string' },
				{ name: 'warranty', type: 'string' },
				{ name: 'price', type: 'string' },
				{ name: 'quantity', type: 'string' },
				{ name: 'discount_percentage', type: 'string' },
				{ name: 'final_amount', type: 'string' },
				],
				pagesize: defaultPageSize,
				root: 'rows',
				id : 'id',
				data : {jobcard_group: jobcard_group},
				cache: true,
			};
			var partsHistoryDataAdapter = new $.jqx.dataAdapter(partsHistoryDataSource);
			$("#partHistory_Grid").jqxGrid({ source: partsHistoryDataAdapter });

		});
		$("#jobcard_Grid").jqxGrid('selectrow', 0);



		//Initialize data
		$("#jobcard_Grid").jqxGrid(
		{
			height: 400,
			width: '100%',
			altrows: true,
			pageable: true,
			sortable: true,
			filterable: true,
			showfilterrow: true,
			autoshowfiltericon: true,
			selectionmode: 'singlecell',
			keyboardnavigation: false,
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo lang("jobcard_issue_date"); ?> Date.', datafield: 'job_card_issue_date', width: 160, filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd_HH_mm},
			{ text: '<?php echo lang("dealer_name"); ?>', datafield: 'dealer_name', width: 110,
			<?php if(! (is_national_service_manager() || is_service_head() || is_service_dealer_incharge() )) echo "hidden: true,"; ?>
			 },
			{ text: '<?php echo lang("service_advisor"); ?>', datafield: 'service_advisor_name', width: 110 },
			{ text: 'Jobcard No.', datafield: 'jobcard_serial', width: 90, cellsrenderer: function(a,b,value,d,e,row) {

				return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">JC-'+(value).pad(5)+'</div>';
			} },
			{ text: '<?php echo lang("service_type_name"); ?> ', datafield: 'service_type_name', width: 90 },
			{ text: '<?php echo lang("service_count"); ?>', datafield: 'service_count', width: 110 },
			{ text: '<?php echo lang("vehicle_name"); ?>', datafield: 'vehicle_name', width: 120 },
			{ text: '<?php echo lang("variant_name"); ?>', datafield: 'variant_name', width: 100 },
			{ text: '<?php echo lang("chassis_no"); ?>', datafield: 'chassis_no', width: 160 },
			{ text: '<?php echo lang("engine_no"); ?>', datafield: 'engine_no', width: 120 },
			{ text: '<?php echo lang("full_name"); ?>', datafield: 'customer_name', width: 200 },
			{ text: '<?php echo lang("coupon"); ?>', datafield: 'coupon', width: 160},
			]
		});

		$("#history_Grid").jqxGrid({
			width: '100%',
			height: 250,
			keyboardnavigation: false,
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			// { text: 'Job Card Group', datafield: 'jobcard_group', width: 150 },
			{ text: '<?php echo lang("job"); ?>', datafield: 'job', width: 200 },
			{ text: '<?php echo lang("job_description"); ?> Description', datafield: 'job_description', width: 200 },
			{ text: '<?php echo lang("customer_voice"); ?>', datafield: 'customer_voice', width: 200 },
			{ text: 'Final Amount', datafield: 'final_amount', width: 200 },
			// { text: '<?php echo lang("advisor_voice"); ?>', datafield: 'advisor_voice', width: 200 },
			// { text: '<?php echo lang("floor_supervisor_voice"); ?>', datafield: 'floor_supervisor_voice', width: 200 },
			{ text: '<?php echo lang("status"); ?>', datafield: 'status', width: 200 },
			]
		});

		$("#partHistory_Grid").jqxGrid({
			width: '100%',
			height: 250,
			keyboardnavigation: false,
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			// { text: 'Job Card Group', datafield: 'jobcard_group', width: 150 },
			{ text: '<?php echo lang("part_code") ?>', datafield: 'part_code', width: 200 },
			{ text: '<?php echo lang("part_name") ?>', datafield: 'part_name', width: 200 },
			{ text: '<?php echo lang("warranty") ?>', datafield: 'warranty', width: 200 },
			{ text: '<?php echo lang("price") ?>', datafield: 'price', width: 200 },
			{ text: '<?php echo lang("quantity") ?>', datafield: 'quantity', width: 200 },
			{ text: '<?php echo lang("discount_percentage") ?>', datafield: 'discount_percentage', width: 200 },
			{ text: '<?php echo lang("final_amount") ?>', datafield: 'final_amount', width: 200 },
			]
		});

	});


</script>