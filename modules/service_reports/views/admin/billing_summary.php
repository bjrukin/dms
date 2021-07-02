<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo 'Billing Summary'; ?>
			<!-- <small>Control panel</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li><?php echo lang('service_reports'); ?></li>
			<li class="active"><?php echo 'Billing Summary'; ?></li>
		</ol>
	</section>

		<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title"><?php echo 'Billing Summary'; ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<div class="box-body" style="line-height:200%">
					<?php echo form_open('', array('id' =>'form-crm_reports_generate')); ?>
                        	<input type="hidden" id="export" name="export" />
        					<table class="table">
        						<tr>
                                    <td><label for='date_range'>Date Range</label></td>
                                    <!-- <td><div id='date_range' class="date_box" name='date_range'></div></td> -->
                                    <td><div id='date_range' name='date_range'></div></td>
                                    <?php
										if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_dealer_incharge() || is_service_finance()))
										{
									?>
                                    <td><label for='dealer_list'><?php echo lang("dealer_name"); ?></label></td>
                                    <!-- <td><div id='date_range' class="date_box" name='date_range'></div></td> -->
                                    <td><div id='dealer_list' name='dealer_list'></div></div></td>
                                    <?php
										}
									?>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                                        <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonCopyToClipboard"><?php echo lang('general_copy_clipboard'); ?></button>
                                    </td>
        					   </tr>
        				    </table>
                		<?php echo form_close(); ?>

				</div>
				<div class="box-footer clearfix">
					<div class="row">
						<div class="col-xs-12 connectedSortable">
							<?php echo displayStatus(); ?>
							
							<div id="jqxGridDataAbsentGrid"></div>
						</div><!-- /.col -->
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div>

<script type="text/javascript">

	$(function(){
		$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true, formatString: "yyyy-MM-dd" });
		$('#date_range').jqxDateTimeInput('setRange', null, null);

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
	})
	
	var searchButton = $('#jqxSubmitButton');

	searchButton.on('click',function(){
		var name = '';
		<?php
			if((is_service_head() || is_national_service_manager() || is_admin() ||is_ccd_incharge() || is_service_dealer_incharge() || is_service_finance()))
			{
		?>
		var dname =$( "input[name=dealer_list]" ).val();
		var dealername = dname.replace(",", "-");
		var name =  dealername.replace(/,/g, '-');
		<?php
			}
		?>
		var daily_absent_Data =
		{
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'number' },					
				{ name: 'invoice_no', type: 'string' },					
				{ name: 'jobcard_group', type: 'string' },					
				{ name: 'vehicle_no', type: 'string' },					
				{ name: 'vehicle_name', type: 'string' },					
				{ name: 'variant_name', type: 'string' },					
				{ name: 'total_jobs', type: 'string' },					
				{ name: 'total_parts', type: 'string' },					
				{ name: 'payment_type', type: 'string' },					
				{ name: 'cash_account', type: 'string' },					
				{ name: 'bill_type', type: 'string' },					
				{ name: 'vat_job', type: 'string' },					
				{ name: 'vat_parts', type: 'string' },					
				{ name: 'cash_discount_amt', type: 'string' },					
				{ name: 'net_total', type: 'string' },					
				{ name: 'dealer_name', type: 'string' },					
				
	        ],
			url: '<?php echo site_url("admin/service_reports/get_billing_summary_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			data:{date:$('#date_range').val(),name:name},
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
	        	//callback called when a page or page size is changed.
	        },
	        beforeprocessing: function (data) {
	        	daily_absent_Data.totalrecords = data.total;
	        },
		    // update the grid and send a request to the server.
		    filter: function () {
		    	$("#jqxGridDataAbsentGrid").jqxGrid('updatebounddata', 'filter');
		    },
		    // update the grid and send a request to the server.
		    sort: function () {
		    	$("#jqxGridDataAbsentGrid").jqxGrid('updatebounddata', 'sort');
		    },
		    processdata: function(data) {
		    }
		};
		var dataAdapter = new $.jqx.dataAdapter(daily_absent_Data);
		$("#jqxGridDataAbsentGrid").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: dataAdapter,
			altrows: true,
			pageable: true,
			sortable: true,
			rowsheight: 30,
			columnsheight:30,
			showfilterrow: true,
			filterable: true,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			selectionmode: 'none',
			virtualmode: true,
			enableanimations: false,
			pagesizeoptions: pagesizeoptions,
			groupable: true,
			showtoolbar: true,
			 showstatusbar: true,
        
                showaggregates: true,   
                statusbarheight: 30,
			rendertoolbar: function (toolbar) {
				var container = $("<div style='margin: 5px; height:50px'></div>");
				container.append($('#jqxGridDataAbsentGridToolbar').html());
				toolbar.append(container);
			},
			columns: [
				{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
				{ text: 'Dealer', datafield: 'dealer_name',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Invoice No', datafield: 'invoice_no',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'JobCard Group', datafield: 'jobcard_group',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Vehicle Number', datafield: 'vehicle_no',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Model', datafield: 'vehicle_name',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Variant', datafield: 'variant_name',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Bill Type', datafield: 'bill_type',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Payment Type', datafield: 'payment_type',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Cash Account', datafield: 'cash_account',		width: 150,filterable: true,renderer: gridColumnsRenderer},
				{ text: 'Total Job', datafield: 'total_jobs',		width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum']},
				{ text: 'Total Parts', datafield: 'total_parts',		width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum']},
				{ text: 'Vat Jobs', datafield: 'vat_job',		width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum']},
				{ text: 'Vat Parts', datafield: 'vat_parts',		width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum']},
				{ text: 'Discount Amount', datafield: 'cash_discount_amt',		width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum']},
				{ text: 'Net Total', datafield: 'net_total',		width: 150,filterable: true,renderer: gridColumnsRenderer,aggregates: ['sum']},
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
		    e.preventDefault();
		    setTimeout(function() {$("#jqxGridDataAbsentGrid").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridDataAbsentGridFilterClear', function () { 
			$('#jqxGridDataAbsentGrid').jqxGrid('clearfilters');
		});


		
	});
</script>