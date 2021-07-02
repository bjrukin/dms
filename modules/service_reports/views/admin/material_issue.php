<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo 'Material Issue Report'; ?>
			<!-- <small>Control panel</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li><?php echo lang('service_reports'); ?></li>
			<li class="active"><?php echo 'Material Issue Report'; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo 'Material Issue Report'; ?></h3>
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
					<h3 class="box-title"><?php echo 'Material Issue Report'; ?></h3>
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
				var excel_link = '<?php echo site_url('service_reports/material_issue_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/material_issue_dump')?>';  
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
				var excel_link = '<?php echo site_url('service_reports/material_issue_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/material_issue_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>
			if (selection != null) {
				var material_scan_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'string' },
					{ name: 'dealer_name', type: 'string' },
					{ name: 'job_card_issue_date', type: 'string' },
					{ name: 'chassis_no', type: 'string' },
					{ name: 'engine_no', type: 'string' },
					{ name: 'vehicle_id', type: 'int' },
					{ name: 'variant_id', type: 'int' },
					{ name: 'jobcard_serial', type: 'int' },
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'variant_name', type: 'string' },
					{ name: 'kms', type: 'int' },
					{ name: 'pdi_kms', type: 'int' },
					{ name: 'customer_name', type: 'string' },
					{ name: 'year', type: 'int' },
					{ name: 'vehicle_no', type: 'string' },
					{ name: 'service_type_name', type: 'string' },					
					{ name: 'service_advisor_name', type: 'string' },					
					{ name: 'mechanic_name', type: 'string' },	
					{ name: 'part_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'price', type: 'number' },
					{ name: 'quantity', type: 'number' },
					// { name: 'quantity', type: 'number' },
					{ name: 'final_amount', type: 'number' },
					// { name: 'job_desc', type: 'string' },				

					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/material_issue_report/json'); ?>'
				};
				var material_scan_reports_dataAdapter = new $.jqx.dataAdapter(material_scan_source);
				$("#jqxGrid_pdi_reports").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: material_scan_reports_dataAdapter,
					columnsresize: true,
					showstatusbar: true,
           			statusbarheight: 30,
					showaggregates: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo lang("issue_date"); ?>', datafield: 'job_card_issue_date', width:'9%' },
					{ text: '<?php echo lang("service_advisor_name"); ?>', datafield: 'service_advisor_name', width:'9%' },
					{ text: 'Dealer Name', datafield: 'dealer_name', width:'9%' },
					{ text: '<?php echo lang("customer_name"); ?>', datafield: 'customer_name', width:'9%' },
					{ text: '<?php echo lang("vehicle_no"); ?>', datafield: 'vehicle_no', width:'9%' },
					{ text: '<?php echo lang("chassis_no"); ?>', datafield: 'chassis_no', width:'9%' },
					{ text: '<?php echo lang("engine_no"); ?>', datafield: 'engine_no', width:'9%' },
					{ text: '<?php echo lang("vehicle_name"); ?>', datafield: 'vehicle_name', width:'15%', cellsrenderer   : function(row,columnfield,value){
						var data = $('#jqxGrid_pdi_reports').jqxGrid('getrowdatabyid', row);
						return data.vehicle_name+" "+data.variant_name;
					} },
					{ text: 'Jobcard No', datafield: 'jobcard_serial', width:'18%' },
					{ text: 'Parts Code', datafield: 'part_code', width:'18%' },
					{ text: 'Parts Name', datafield: 'part_name', width:'18%' },
					{ text: 'Price', datafield: 'price', width:'6%'  ,  aggregates: ['sum'] },
					{ text: 'Quantity', datafield: 'quantity', width:'6%' ,  aggregates: ['sum']  },
					{ text: 'Final Amount', datafield: 'final_amount', width:'6%' ,  aggregates: ['sum']  },
					// { text: 'Final Amount', datafield: 'final_amount', width:'6%' , cellsalign: 'center', cellclassname: 'grid-column-center', 
					// 		cellsrenderer: function (index) {
					// 			var price = parseFloat($('#jqxGrid_pdi_reports').jqxGrid('getcellvalue', index, "price"));
					// 			var quantity = $("#jqxGrid_pdi_reports").jqxGrid('getcellvalue', index, "quantity");


					// 			return (price || 0) * (quantity || 0) ;
					// 		}
					// },

					// { text: 'Final Amount', datafield: 'final_amount', width:'15%', cellsrenderer   : function(row,columnfield,value){
					// 		var data = $('#jqxGrid_pdi_reports').jqxGrid('getrowdatabyid', row);
					// 		return ((data.price || 0) * (data.quantity || 0));
					// 		// return data.vehicle_name+" "+data.variant_name;
					// 	} 
					// },


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
