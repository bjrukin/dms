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
			<li class=""><?php echo lang('service_reports'); ?></li>
			<li class="active"><?php echo lang('sales_register'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('sales_register'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('sales_register'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_sales_register"></div>
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
				var excel_link = '<?php echo site_url('service_reports/sale_register_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/sale_register_excel_dump')?>';  
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
				var excel_link = '<?php echo site_url('service_reports/sale_register_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/sale_register_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>
			
			// if (selection != null) {
				var sales_register_source =
				{
					datatype: "json",
					datafields: [

					{ name : 'issue_date', type: 'string'},
					{ name : 'invoice_no', type: 'string'},
					{ name : 'jobcard_group', type: 'string'},
					{ name : 'jobcard_serial', type: 'string'},
					{ name : 'job_desc', type: 'string'},
					{ name : 'mobile', type: 'string'},
					{ name : 'part_name', type: 'string'},
					{ name : 'vehicle_no', type: 'string'},
					{ name : 'dealer_name', type: 'string'},
					{ name : 'customer_name', type: 'string'},
					{ name : 'vehicle', type: 'string'},
					{ name : 'service_type_name', type: 'string'},
					{ name : 'service_count', type: 'string'},
					{ name : 'mechanic_name', type: 'string'},
					{ name : 'partprice', type: 'float'},
					{ name : 'accessprice', type: 'float'},
					{ name : 'labourprice', type: 'float'},
					{ name : 'other', type: 'float'},
					{ name : 'oilprice', type: 'float'},
					{ name : 'cash_discount_amt', type: 'float'},
					{ name : 'localprice', type: 'float'},
					{ name : 'vat_total', type: 'float'},
					{ name : 'net_total', type: 'float'}
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/sales_register/json'); ?>'
				};
				var sales_register_dataAdapter = new $.jqx.dataAdapter(sales_register_source);
				$("#jqxGrid_sales_register").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: sales_register_dataAdapter,
					columnsresize: true,
					showstatusbar: true,
       			 	statusbarheight: 30,
					showaggregates: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo 'Issue Date'; ?>', datafield: 'issue_date', },
					{ text: '<?php echo 'Invoice'; ?>', datafield: 'invoice_no', },
					{ text: '<?php echo 'Jobcard Number'; ?>', datafield: 'jobcard_serial', },
					{ text: '<?php echo 'Vehicle No'; ?>', datafield: 'vehicle_no'},
					{ text: '<?php echo 'Dealer Name'; ?>', datafield: 'dealer_name'},
					{ text: '<?php echo 'Customer Name'; ?>', datafield: 'customer_name'},
					{ text: '<?php echo 'Mobile'; ?>', datafield: 'mobile'},
					{ text: '<?php echo 'Model'; ?>', datafield: 'vehicle'},
					{ text: '<?php echo 'Service Type'; ?>', datafield: 'service_type_name'},
					{ text: '<?php echo 'Ser. No.'; ?>', datafield: 'service_count'},
					{ text: '<?php echo 'Mechanic'; ?>', datafield: 'mechanic_name'},
					{ text: '<?php echo 'Job Description'; ?>', datafield: 'job_desc'},
					{ text: '<?php echo 'Parts Consume'; ?>', datafield: 'part_name'},
					{ text: '<?php echo 'Part Amt'; ?>', datafield: 'partprice',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Oil Amt'; ?>', datafield: 'oilprice',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Accessories Amt'; ?>', datafield: 'accessprice',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Local Amt'; ?>', datafield: 'localprice',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Labour Amt'; ?>', datafield: 'labourprice',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Other Amt'; ?>', datafield: 'other',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Cash Discount'; ?>', datafield: 'cash_discount_amt',cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Vat'; ?>', datafield: 'vat_total',cellsformat: 'd2', aggregates: ['sum'],width:'8%'},
					{ text: '<?php echo 'Grand Total'; ?>', datafield: 'net_total',cellsformat: 'd2', aggregates: ['sum']},
					]
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
