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
			<li class="active"><?php echo lang('mechanic_consume'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('mechanic_consume'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('mechanic_consume'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_mechanic_consume"></div>
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
				var excel_link = '<?php echo site_url('service_reports/mechanic_consume_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/mechanic_consume_report_excel_dump')?>';  
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
				var excel_link = '<?php echo site_url('service_reports/mechanic_consume_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/mechanic_consume_report_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>
			// if (selection != null) {
				var mechanic_consume_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'mechanic_name', type: 'string' },
					{ name: 'final_amount', type: 'number' },
					{ name: 'vat', type: 'number' },
					// { name: 'ow_payment', type: 'string' },
					// { name: 'ow_margin', type: 'string' },
					// { name: 'ow_tax', type: 'string' },
					{ name: 'vehicle_name', type: 'string' },
					{ name: 'vehicle_no', type: 'string' },
					{ name: 'part_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'chassis_no', type: 'string' },
					{ name: 'net_total', type: 'number' },
					{ name: 'jobcard_serial', type: 'number' },
					{ name: 'dealer_name', type: 'string' },
					// { name: 'tools', type: 'string' },
					// { name: 'misc', type: 'string' },
					// { name: 'books', type: 'string' },
					// { name: 'local', type: 'string' },
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/mechanic_consume/json'); ?>'
				};
				var mechanic_consume_dataAdapter = new $.jqx.dataAdapter(mechanic_consume_source);
				$("#jqxGrid_mechanic_consume").jqxGrid(
				{
					width: '100%',
					height: '300px',
					showstatusbar: true,
					showaggregates: true,
					source: mechanic_consume_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					
					{ text: 'Mechanic Name', datafield: 'mechanic_name'},
					{ text: 'Dealer Name', datafield: 'dealer_name', },
					{ text: 'Jobcard No', datafield: 'jobcard_serial', },
					{ text: 'Part code', datafield: 'part_code', },
					{ text: 'Part Name', datafield: 'part_name', },
					{ text: 'Chasis No', datafield: 'chassis_no', },
					{ text: 'Vehcile No', datafield: 'vehicle_no', },
					{ text: 'Vehcile Name', datafield: 'vehicle_name', },
					{ text: '<?php echo lang("taxable"); ?>', datafield: 'final_amount',cellsformat: 'd2', aggregates: ['sum']  },
					{ text: '<?php echo lang("taxes"); ?>', datafield: 'vat',cellsformat: 'd2', aggregates: ['sum']  },
					{ text: 'Net Amount', datafield: 'net_total',cellsformat: 'd2', aggregates: ['sum']  },
					// { text: '<?php echo lang("ow_payment"); ?>', datafield: 'ow_payment', },
					// { text: '<?php echo lang("ow_margin"); ?>', datafield: 'ow_margin', },
					// { text: '<?php echo lang("ow_tax"); ?>', datafield: 'ow_tax', },
					// { text: '<?php echo lang("accessories"); ?>', datafield: 'accessories', },
					// { text: '<?php echo lang("spareparts"); ?>', datafield: 'spareparts', },
					// { text: '<?php echo lang("tools"); ?>', datafield: 'tools', },
					// { text: '<?php echo lang("books"); ?>', datafield: 'books', },
					// { text: '<?php echo lang("misc"); ?>', datafield: 'misc', },
					// { text: '<?php echo lang("local"); ?>', datafield: 'local', },
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
