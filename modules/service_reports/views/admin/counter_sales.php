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
			<li class="active"><?php echo lang('counter_sales'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo lang('counter_sales'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<div class="row">
						<?php
						if((is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()))
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
					<h3 class="box-title"><?php echo lang('counter_sales'); ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body">
					<div id="jqxGrid_counter_sales"></div>
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
	    var is_service_head = '<?php echo is_service_head();?>';
	    var is_national_service_manager = '<?php echo is_national_service_manager();?>';
	    var is_admin = '<?php echo is_admin();?>';


		$("#date_range_submit").on('click', function (event) {
			var selection = $("#date_range").jqxDateTimeInput('getText');
			<?php
			if((is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()))
			{
			?>
			var dname =$( "input[name=dealer_list]" ).val();
			var dealername = dname.replace(",", "-");
			var name =  dealername.replace(/,/g, '-');
			if(selection){
				var strArray = selection.split(" ");
				var startdate = strArray[0];
				var enddate = strArray[2];
				var excel_link = '<?php echo site_url('service_reports/couter_sale_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate+'/'+name);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/couter_sale_excel_dump')?>';  
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
				var excel_link = '<?php echo site_url('service_reports/couter_sale_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}else{
				var startdate = 0;
				var enddate = 0;
				var excel_link = '<?php echo site_url('service_reports/couter_sale_excel_dump')?>';  
				$("#excel_link").attr("href", excel_link+'/'+startdate+'/'+enddate);
	        	$("#excel_link").show();
			}	
			<?php
			}
			?>
			var show_hide_status = '';
		    if(is_service_head == 1 || is_national_service_manager == 1 ||  is_admin == 1)
		    {
		        show_hide_status = false;
		    }
		    else
		    {
		        show_hide_status = true;
		    }
			// if (selection != null) {
				var counter_sales_source =
				{
					datatype: "json",
					datafields: [
					{ name: 'invoice_no', type: 'string' },
					{ name: 'part_name', type: 'string' },
					{ name: 'part_code', type: 'string' },
					{ name: 'quantity', type: 'string' },
					{ name: 'price', type: 'float' },
					{ name: 'discount', type: 'float' },
					{ name: 'vat_amount', type: 'float' },
					{ name: 'cash_discount_amt', type: 'float' },
					{ name: 'final_amount', type: 'float' },
					{ name: 'dealer_name', type: 'string' },
					{ name: 'payment_type', type: 'string' },
					{ name: 'full_name', type: 'string' },
					
					{ name: 'vehicle_no', type: 'string' },
					
					],
					data: {selection:selection,name:name},
					type: 'post',
					url: '<?php echo site_url('service_reports/counter_sales/json'); ?>'
				};
				var counter_sales_dataAdapter = new $.jqx.dataAdapter(counter_sales_source);
				$("#jqxGrid_counter_sales").jqxGrid(
				{
					width: '100%',
					height: '300px',
					source: counter_sales_dataAdapter,
					columnsresize: true,
					showstatusbar: true,
       			 	statusbarheight: 30,
					showaggregates: true,
					columns: [
					{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
					// { text: '<?php echo 'Dealer Name'; ?>', datafield: 'dealer_name', width:'9%',hidden: show_hide_status },
					{ text: 'Dealer Name', datafield: 'dealer_name', width:'18%' },
					{ text: '<?php echo lang("invoice_no"); ?>', datafield: 'invoice_no', width:'9%' },
					{ text: 'Vehicle No.', datafield: 'vehicle_no', width:'9%' },
					{ text: 'Part No.', datafield: 'part_code', width:'9%' },
					{ text: '<?php echo lang("part_name"); ?>', datafield: 'part_name', width:'9%' },
					// { text: '<?php echo lang("quantity"); ?>', datafield: 'quantity',width:'9%' },
					{ text: '<?php echo lang("quantity"); ?>', datafield: 'quantity',width:'12%',cellsformat: 'd2',  aggregates: ['sum'] },
					{ text: '<?php echo lang("discount"); ?>', datafield: 'discount',width:'9%'},
					// { text: 'Taxable', datafield: 'price', width:'9%' },
					// { text: '<?php echo lang("payment_type"); ?>', datafield: 'payment_type', width:'9%' },
					
					{ text: 'Taxable', datafield: 'price',width:'18%' ,cellsformat: 'd2',  aggregates: ['sum']},
					
					{ text: 'Taxes', datafield: 'vat_amount',width:'18%' ,cellsformat: 'd2',  aggregates: ['sum']},
					// { text: 'CashDisc', datafield: 'cash_discount_amt',width:'18%' ,cellsformat: 'd2',  aggregates: ['sum']},
					{ text: '<?php echo lang("net_amount"); ?>', datafield: 'final_amount',width:'18%' ,cellsformat: 'd2', aggregates: ['sum']},
					{ text: '<?php echo 'Customer Name'; ?>', datafield: 'full_name',width:'18%'},
					]
				});

				
			// }
		});
			<?php
			if((is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()))
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
