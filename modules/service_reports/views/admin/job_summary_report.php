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
			<li class="active"><?php echo lang('job_summary_report'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('job_summary_report'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('job_summary_report'); ?></h3>
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
			if(selection){
				var strArray = selection.split(" ");
				var startdate = strArray[0];
				var enddate = strArray[2];
				var excel_link = '<?php echo site_url('service_reports/job_summary_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/job_summary_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
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
				var excel_link = '<?php echo site_url('service_reports/job_summary_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/job_summary_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>

			// if (selection != null) {
				var dent_paint_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'dealer_name', type: 'string' },					
					{ name: 'vehicle_no', type: 'string' },					
					{ name: 'engine_no', type: 'string' },					
					{ name: 'chassis_no', type: 'string' },					
					{ name: 'kms', type: 'string' },					
					{ name: 'reciever_name', type: 'string' },					
					{ name: 'mechanic_name', type: 'string' },					
					{ name: 'service_advisor_name', type: 'string' },					
					{ name: 'floor_supervisor_name', type: 'string' },					
					{ name: 'partprice', type: 'string' },					
					{ name: 'accessprice', type: 'string' },					
					{ name: 'oilprice', type: 'string' },					
					{ name: 'other', type: 'string' },					
					{ name: 'labourprice', type: 'string' },
					{ name: 'customer_name', type: 'string' },						
					{ name: 'jobcard_group', type: 'string' },						
					{ name: 'service_type_name', type: 'string' },						
					{ name: 'part_name', type: 'string' },						
					{ name: 'job_desc', type: 'string' },						
					// { name: 'total', type: 'string' },					
					// { name: 'service_type_name', type: 'string' },					
					// { name: 'AMC', type: 'int' },
					// { name: 'FREE', type: 'int' },
					// { name: 'PAID(AW)', type: 'int' },
					// { name: 'PAID(UW)', type: 'int' },
					// { name: 'RUNNING REPAIR', type: 'int' },
					// { name: 'ACCIDENTAL', type: 'int' },
					// { name: 'Other', type: 'int' },		
					// { name: 'PDI', type: 'int' },		
					// { name: 'PDI', type: 'int' },		
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/job_summary_report/json'); ?>'
				};
				var dent_paint_dataAdapter = new $.jqx.dataAdapter(dent_paint_source);
				$("#jqxGrid_dent_paint").jqxGrid(
				{
					width: '100%',
					height: '300px',
					showstatusbar: true,
					showaggregates: true,
					source: dent_paint_dataAdapter,   
					columnsresize: true,
					columns: [
					
					{ text: 'Dealer Name', datafield: 'dealer_name', width:'9%' },                      
					{ text: 'Job card No', datafield: 'jobcard_group', width:'9%' },                      
					{ text: 'Service Type Name', datafield: 'service_type_name', width:'9%' },                      
					{ text: 'Vehicle No', datafield: 'vehicle_no', width:'9%' },                      
					{ text: 'Engine No', datafield: 'engine_no', width:'9%' },                      
					{ text: 'Chassis No', datafield: 'chassis_no', width:'9%' },                      
					{ text: 'Km', datafield: 'kms', width:'9%' },                      
					{ text: 'Customer Name', datafield: 'customer_name', width:'9%' },                      
					{ text: 'Mechanic Name', datafield: 'mechanic_name', width:'9%' },                      
					{ text: 'Service Advisor', datafield: 'service_advisor_name', width:'9%' },                      
					{ text: 'Floor Supervisor Name', datafield: 'floor_supervisor_name', width:'9%' },                      
					{ text: 'Parts Name', datafield: 'part_name', width:'12%' },                      
					{ text: 'Parts', datafield: 'partprice', width:'9%',cellsformat: 'd2', aggregates: ['sum'] },                      
					{ text: 'Labour', datafield: 'labourprice', width:'9%',cellsformat: 'd2', aggregates: ['sum'] },                      
					{ text: 'Lube', datafield: 'oilprice', width:'9%',cellsformat: 'd2', aggregates: ['sum'] },                      
					{ text: 'Accessories', datafield: 'accessprice', width:'9%',cellsformat: 'd2', aggregates: ['sum'] },                      
					{ text: 'Other', datafield: 'other', width:'9%',cellsformat: 'd2', aggregates: ['sum'] }, 
					{ text: 'Job Description', datafield: 'job_desc', width:'18%' }, 
					{
					text: 'Net Total', datafield: 'total', width:'9%',cellsformat: 'd2', sortable:false,filterable:false, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center',
					cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					
						var rows = $("#jqxGrid_dent_paint").jqxGrid('getrowdata', index);
						// console.log(rows);
						var total = 0;
						$.each(rows,function(key,value){
							// if(key == 'partprice' || key == 'labourprice' || key == 'oilprice' || key == 'accessprice' || key == 'other')
							// {
							// 	// console.log(value);
							// 	total +=  (Number.isInteger(parseInt(value)))?parseInt(value):0;
							// 	// console.log(Number.isInteger(parseInt(value)));
							// }

							if(key != 'dealer_name' && key != 'vehicle_no' && key != 'engine_no' && key != 'chassis_no' && key != 'kms' && key != 'reciever_name' && key != 'mechanic_name' && key != 'service_advisor_name' && key != 'floor_supervisor_name' && key != 'uid')
							{
								// console.log(value);
								total +=  (Number.isInteger(parseInt(value)))?parseInt(value):0;
								// console.log(Number.isInteger(parseInt(value)));
							}
						
						
						})
						return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">'+total+'</div>';
						// console.log(total);

						


						
					},aggregates: [{ 'Sum':
                function (aggregatedValue, currentValue, column, record) {
                	var partprice = parseFloat((record.hasOwnProperty("partprice"))?record.partprice:0);
                	var labourprice = parseFloat((record.hasOwnProperty("labourprice"))?record.labourprice:0);
                	var oilprice = parseFloat((record.hasOwnProperty("oilprice"))?record.oilprice:0);
                	var accessprice = parseFloat((record.hasOwnProperty("accessprice"))?record.accessprice:0);
                	var other = parseFloat((record.hasOwnProperty("other"))?record.other:0);
                  	var row_total = (isNaN(partprice)?0:partprice) + (isNaN(labourprice)?0:labourprice) + (isNaN(oilprice)?0:oilprice) + (isNaN(accessprice)?0:accessprice) + (isNaN(other)?0:other);
                  	var total = parseFloat(row_total);
                  	var g_total = aggregatedValue + total;
                  	// console.log(g_total);
                  	return g_total;

						// return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">'+g_total+'</div>';
                }

            	}] 
					
				},                     
				
					]
				});

				
			// }
		});

				<?php
			if((is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()))
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
			searchMode:'endswith',
			checkboxes:true,
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
