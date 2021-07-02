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
			<li class="active"><?php echo lang('mechanic_earning_detail'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('mechanic_earning_detail'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<label for='mechanics_id'><?php echo lang("mechanic_name"); ?></label>
					<div>
					<div id='mechanic_list' class='form-control input-sm' name='mechanic_list'></div>
					</div>
					<label><?php echo lang("date_range"); ?></label>
					<div id='date_range' name='date_range'></div>
					<br>
					<button type="button" class="btn" id="date_range_submit">Submit</button>&nbsp;&nbsp;
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
					<h3 class="box-title"><?php echo lang('mechanic_earning_detail'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>

				</div>
				<div class="box-body">
					<div id="jqxGrid_mechanic_earning"></div>
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
			var name = $("#mechanic_list").val();
			if(name == "")
			{
				alert('Please select mechanic name');
			}
			else
			{		
				if(selection){
					var strArray = selection.split(" ");
					var startdate = strArray[0];
					var enddate = strArray[2];
					var excel_link = '<?php echo site_url('service_reports/dentpaintmechanic_earning_detail_excel_dump')?>';  
					$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
		        	$("#excel_link").show();
				}else{
					var startdate = 0;
					var enddate = 0;
					var excel_link = '<?php echo site_url('service_reports/dentpaintmechanic_earning_detail_excel_dump')?>';  
					$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
		        	$("#excel_link").show();
				}	
				if (selection != null) {
					var mechanic_earning_source =
					{
						datatype: "json",
						datafields: [
						{ name: 'mechanic_name', type: 'string' },
						{ name: 'dealer_name', type: 'string' },
						{ name: 'job_code', type: 'int' },
						{ name: 'jobcard_serial', type: 'int' },
						{ name: 'job_description', type: 'string' },
						{ name: 'vehicle_nos', type: 'string' },
						{ name: 'gross_amount', type: 'float' },
						{ name: 'osw_paid', type: 'float' },
						{ name: 'ow_margin', type: 'float' },
						{ name: 'taxes', type: 'float' },
						{ name: 'net_amount', type: 'float' },					
						{ name: 'chassis_no', type: 'string' },					
						],
						data: {selection:selection,name:name},
						type: 'post',
						url: '<?php echo site_url('service_reports/dentpaintmechanic_earning_detail/json'); ?>'
					};
					var mechanic_earning_dataAdapter = new $.jqx.dataAdapter(mechanic_earning_source);
					$("#jqxGrid_mechanic_earning").jqxGrid(
					{
						width: '100%',
						height: '300px',
						source: mechanic_earning_dataAdapter,
						columnsresize: true,
						showstatusbar: true,
	           			 statusbarheight: 30,
						showaggregates: true,
						columns: [
						{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
						{ text: 'Dealer Name', datafield: 'dealer_name', width:'20%' },
						{ text: '<?php echo lang("job_code"); ?>', datafield: 'job_code', width:'20%' },
						{ text: 'Jobcard No', datafield: 'jobcard_serial', width:'20%' },
						{ text: '<?php echo lang("job_description"); ?>', datafield: 'job_description', width:'10%' },
						{ text: '<?php echo lang("chassis_no"); ?>', datafield: 'chassis_no', width:'10%' },
						{ text: '<?php echo lang("vehicle_nos"); ?>', datafield: 'vehicle_nos', width:'10%' },
						{ text: '<?php echo 'Labour Amount'; ?>', datafield: 'gross_amount', width:'10%',cellsalign: 'right',  aggregates: ['sum'] },
						{ text: '<?php echo lang("osw_paid"); ?>', datafield: 'osw_paid', width:'10%',cellsalign: 'right',  aggregates: ['sum'] },
						{ text: '<?php echo lang("osw_margin"); ?>', datafield: 'ow_margin', width:'10%' ,cellsalign: 'right',  aggregates: ['sum']},
						{ text: '<?php echo lang("taxes"); ?>', datafield: 'taxes', width:'10%',  aggregates: ['sum']},
						{ text: '<?php echo lang("net_amount"); ?>', datafield: 'net_amount', width:'10%' ,cellsalign: 'right',  aggregates: ['sum']},
						
						]
					});

					
				}
			}
		});


		var mechanicsDataSource = {
			url : '<?php echo site_url("admin/service_reports/get_mechanic_lists"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'designation_id', type: 'string' },
			{ name: 'full_name', type: 'string' },
			
			],
			data : {group: 'mechanic_leader'}, //possible values: { mechanic_leader, mechanics }
			cache: true,
			method: 'post',
		}

		mechanicsAdapter = new $.jqx.dataAdapter(mechanicsDataSource);

		$("#mechanic_list").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			displayMember: "full_name",
			valueMember: "id",
		});

				var mechanic_list_DataSource = {
					url : '<?php echo site_url("admin/service_reports/get_mechanic_lists"); ?>',
					datatype: 'json',
					datafields: [
					{ name: 'id', type: 'number' },
					{ name: 'designation_id', type: 'string' },
					{ name: 'full_name', type: 'string' },
					
					],
					// data : {group: 'mechanics'/*item.originalItem.designation_id*/, mechanic: item.value}, 
					// possible values: { mechanic_leader, mechanics }
					async: false,
					cache: true,
					method: 'post',
				}

				mechanic_listAdapter = new $.jqx.dataAdapter(mechanic_list_DataSource);

				$("#mechanic_list").jqxComboBox({source: mechanic_listAdapter });
			


	});

</script>
