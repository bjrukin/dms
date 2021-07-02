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
			<li class="active"><?php echo lang('mechanic_earning'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('mechanic_earning'); ?></h3>
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
					<h3 class="box-title"><?php echo lang('mechanic_earning'); ?></h3>
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
				var excel_link = '<?php echo site_url('service_reports/mechanic_earning_reports_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/mechanic_earning_reports_dump')?>';  
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
				var excel_link = '<?php echo site_url('service_reports/mechanic_earning_reports_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/mechanic_earning_reports_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>
			if (selection != null) {
				var mechanic_earning_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'deleted_at', type: 'string' },
					{ name: 'first_name', type: 'string' },
					{ name: 'middle_name', type: 'string' },
					{ name: 'last_name', type: 'string' },
					{ name: 'mechanic_name', type: 'string' },
					{ name: 'labout_amount', type: 'number' },
					{ name: 'taxes', type: 'number' },
					{ name: 'ow_payment', type: 'number' },
					{ name: 'ow_margin', type: 'number' },
					{ name: 'final_amount', type: 'number' },
					{ name: 'dealer_name', type: 'string' },
					{ name: 'part_price', type: 'number' },
					{ name: 'accessories', type: 'number' },
					{ name: 'lube', type: 'number' },
					{ name: 'other', type: 'number' },
					{ name: 'total_part', type: 'number' },
					{ name: 'vat_parts', type: 'number' },
					{ name: 'net_total', type: 'number' },
					{ name: 'local', type: 'number' },
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/mechanic_earning/json'); ?>'
				};
				var mechanic_earning_dataAdapter = new $.jqx.dataAdapter(mechanic_earning_source);
				$("#jqxGrid_mechanic_earning").jqxGrid(
				{
					width: '100%',
					height: '300px',
					showstatusbar: true,
					showaggregates: true,
					source: mechanic_earning_dataAdapter,
					columnsresize: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					{ text: '<?php echo "Dealer Name"; ?>', datafield: 'dealer_name', w0idth:'20%' },
					{ text: '<?php echo lang("mechanic_name"); ?>', datafield: 'mechanic_name', w0idth:'20%' },
					// { text: '<?php echo lang("designation_name"); ?>', datafield: 'designation_name', width:'9%' },
					{ text: '<?php echo lang("labour_amt"); ?>', datafield: 'labout_amount', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo lang("ow_final_amount"); ?>', datafield: 'ow_payment', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo lang("ow_margin"); ?>', datafield: 'ow_margin', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
					// { text: '<?php echo lang("vat_job"); ?>', datafield: 'taxes', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
					// { text: '<?php echo 'Total Labour'; ?>', datafield: 'final_amount',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'Part'; ?>', datafield: 'part_price',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'Lube'; ?>', datafield: 'lube',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'Accessories'; ?>', datafield: 'accessories',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'Local'; ?>', datafield: 'local',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'Other'; ?>', datafield: 'other',cellsformat: 'd2', aggregates: ['sum'] },
					// { text: '<?php echo 'VAT(Parts Amt)'; ?>', datafield: 'vat_parts',cellsformat: 'd2', aggregates: ['sum'] },
					// { text: '<?php echo 'Total Parts'; ?>', datafield: 'total_part',cellsformat: 'd2', aggregates: ['sum'] },
					{ text: '<?php echo 'VAT'; ?>', datafield: 'vat_parts', width:'10%' ,cellsalign: 'right',  
							cellsrenderer: function (index) {
								var row =  $("#jqxGrid_mechanic_earning").jqxGrid('getrowdata', index);

								var e = row.vat_parts + row.taxes;
								return '<div style="margin-top: 8px; margin-left:5px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>'; 
							},
							aggregates: [{ 
								'Sum':
								function (aggregatedValue, currentValue, column, record) {
									console.log(record);

									// var row =  $("#jqxGrid_mechanic_earning").jqxGrid('getrowdata', column);

									var total = currentValue + record.taxes;
									total = aggregatedValue + total;
									return total;
								}
							}]      
						},
					{ text: '<?php echo lang("net_amount"); ?>', datafield: 'net_total', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
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
