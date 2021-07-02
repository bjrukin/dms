<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('estimate_details'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('estimate_details'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridEstimate_detailToolbar' class='grid-toolbar'>
					<?php if( ! is_admin() ) : ?>
						<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridEstimate_detailInsert"><?php echo lang('general_create'); ?></button>
					<?php endif; ?>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridEstimate_detailFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridEstimate_detail"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowEstimate_detail">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-estimate_details', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "estimate_details_id"/>
		<div class="col-md-12">
			<div class="row">

				<div class="col-md-6">
					<div class="row">
						<div class="col-md-4">
							Estimate No 
							<div id="estimate_details-estimate_no_dislay" class="form-control" readonly></div>
							<input type="hidden" name="estimate_doc_no" id="estimate_details-estimate_doc_no" class="form-control"> 
						</div>
						<div class="col-md-4">
							Job Card No. 
							<div id="estimate_details-jobcard_group_display" class="form-control" readonly></div>
							<input type="hidden" name="jobcard_group" id="estimate_details-jobcard_group" class="form-control" onchange="get_jobcard_detail()"> 
						</div>
					</div>

				</div>
				<div class="col-md-6">
					<fieldset id="fieldset-vehicle_details">
						<legend><?php echo lang("vehicle_details") ?></legend>
						<div class="row">
							<div class="col-md-2">Issue Date</div>
							<div class="col-md-4"><div id="issued_date" name="issued_date" class="date_box"></div></div>
						</div>

						<div class="row">
							<div class="col-md-2"> <?php echo lang("vehicle_register_no") ?>: </div>
							<div class="col-md-4"> <input id="vehicle_register_no" name="vehicle_register_no" class="form-control input-sm "> </div>
						</div>
						<div class="row">
							<div class="col-md-2"><?php echo lang("chassis_no") ?></div>
							<div class="col-md-4"><input type="text" name="chassis_no" class="form-control input-sm part_vehicle_no" id="chassis_no"></div>
							<div class="col-md-2"><?php echo lang("engine_no") ?></div>
							<div class="col-md-4"><input type="text" name="engine_no" class="form-control input-sm part_vehicle_no" id="engine_no"></div>
						</div>
						<div class="row">
							<div class="col-md-2"><?php echo lang("vehicle_name") ?></div>
							<div class="col-md-4"><div type="text" name="model_no" class="form-control input-sm part_vehicle_no" id="vehicle_id"></div></div>
						</div>
						<div class="row">
							<div class="col-md-2"><?php echo lang("variant_name") ?></div>
							<div class="col-md-4"><div type="text" name="variant" class="form-control input-sm part_vehicle_no" id="variant_id"></div></div>
							<div class="col-md-2"><?php echo lang("color_name") ?></div>
							<div class="col-md-4"><div type="text" name="color" class="form-control input-sm part_vehicle_no" id="color_id"></div></div>
						</div>
						<div class="row">
							<div class="col-md-2"> Party Name </div>
							<div class="col-md-10">  <div id='estimate_details-party_name' name="party_name"></div></div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<button class="btn btn-default btn-xs" id="estimate_add_job">Add Job</button>
				</div>
				<div class="col-md-12">
					<div id="jqxgrid_estimate_jobs"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-default btn-xs" id="estimate_add_part">Add Part</button>
				</div>
				<div class="col-md-12">
					<div id="jqxgrid_estimate_parts"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
				</div>
				<div class="col-md-6">
					<fieldset>
						<legend>Summary</legend>
						<div class="row">
							<div class="col-md-offset-6 col-md-3">Parts</div>
							<div class="col-md-3">Jobs</div>
						</div>
						<div class="row">
							<div class="col-md-6">Total</div>
							<div class="col-md-3"><input type="text" name="total_for_parts" id="total_parts" class="form-control input-sm" readonly></div>
							<div class="col-md-3"><input type="text" name="total_for_jobs" id="total_jobs" class="form-control input-sm" readonly></div>
						</div>
						<div class="row">
							<div class="col-md-3">Cash Dis.</div> <!-- total_discount_bill_cash -->
							<div class="col-md-3">
								<div class="input-group">
									<input type="number" name="cash_discount_percent" id="cash_percent" step="1" onchange="estimate_cal_cash_discount_percent()" onkeyup="" value="0" class="form-control input-sm">
									<div class="input-group-addon">%</div>
								</div>
							</div>
							<div class="col-md-offset-3 col-md-3">
								<input type="number" name="cash_discount_amt" id="cash_discount_amt" onchange="estimate_cal_cash_discount_amt()" value="0" class="form-control input-sm">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">VAT.</div>
							<div class="col-md-3">
								<div class="input-group">
									<input type="number" name="vat_percent" id="vat_percent" value="13" class="form-control input-sm" onchange="estimate_cal_cash_discount_percent()" readonly>
									<div class="input-group-addon">%</div>
								</div>
							</div>
							<div class="col-md-3"><input type="text" id="vat_amount_parts" name="vat_parts" class="form-control input-sm" readonly></div>
							<div class="col-md-3"><input type="text" id="vat_amount_job" name="vat_job" class="form-control input-sm" readonly></div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">Net Amount</div>
							<div class="col-md-offset-3 col-md-3"><input type="text" name="net_total" id="net_total" class="form-control input-sm" readonly></div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxEstimate_detailSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxEstimate_detailPrintButton">Print</button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxEstimate_detailCancelButton"><?php echo lang('general_cancel'); ?></button>
					</div>
				</div>
			</div>

		</div>
		<?php echo form_close(); ?>
	</div>
</div>


<div id="jqxPopupWindowAddPart">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_job">Add Part</span>
	</div>
	<div class="form_fields_area">
		<div class="col-md-12">
			<form id="form-add_parts">
				<input type="hidden" name="part_name" id="add_parts-part_name">
				
				<div class="row form-group">
					<div class="col-md-3"><label><?php echo lang('part_name')?></label></div>
					<div class="col-md-6"><div id="add_parts-part_id" name="part_id"></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-3"><label><?php echo lang('part_code')?></label></div>
					<div class="col-md-8"><input id="add_parts-part_code" class="form-control" readonly></div>
				</div>
				<div class="row form-group">
					<div class="col-md-3"><label><?php echo lang('price')?></label></div>
					<div class="col-md-3"><input type="number" class="form-control" id="add_parts-price" name="price"></div>
					<div class="col-md-3"><label><?php echo lang('quantity')?></label></div>
					<div class="col-md-3"><input type="number" class="form-control" id="add_parts-quantity" name="quantity"></div>
				</div>
				<div class="row form-group">
					<div class="col-md-3"><label><?php echo lang('total')?></label></div>
					<div class="col-md-6"><input type="number" class="form-control" id="add_parts-total" name="total" readonly></div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group btn-xs pull-right">
							<button type="button" class="btn btn-primary btn-flat" id="add_parts-submit">Add</button>
							<button type="button" class="btn btn-default btn-flat" id="add_parts-close"><?php echo lang('general_cancel')?></button>
						</div>
					</div>
				</div>
				<input type="hidden" name="new_part_name" id="new_part_name2">
				<input type="hidden" name="new_min_price" id="new_min_price2">
			</form>
		</div>
	</div>
</div>

<div id="jqxPopupWindowAddJob">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="">Add Job</span>
	</div>
	<div>
		<div class="col-md-12">
			<form id="form-add_jobs">
				<input type="hidden" name="jobcard_group" class="job-status">
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('customer_voice')?></label></div>
					<div class="col-md-8"><textarea class="text_area" name="customer_voice" id="add_jobs-customer_voice"></textarea></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('job')?></label></div>
					<div class="col-md-8"><div name="job_id" class="form-control" id="add_jobs-job_id"></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang("description") ?></label></div>
					<div class="col-md-6"><div id="add_jobs-description"></div><div id="add_jobs-job_code" hidden></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang("price") ?></label></div>
					<div class="col-md-6"><input type="number" name="price" id="add_jobs-price" class="form-control" ></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang("discount") ?></label></div>
					<div class="col-md-6"><input type="number" name="discount" id="add_jobs-discount" class="form-control" ></div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="btn-group btn-xs pull-right">
							<button type="button" id="add_jobs-submit" class="btn btn-primary"><?php echo lang("add_job") ?></button>
							<button type="button" id="add_jobs-close" class="btn btn-default"><?php echo lang("close") ?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript">
	var ALLOWED_DISCOUNT = 5;

	$(function(){

		$('#add_parts-price, #add_parts-quantity').on('keyup change hover', function(){
			var ttl = parseFloat($('#add_parts-price').val()) * parseFloat($('#add_parts-quantity').val());
			$('#add_parts-total').val(ttl);
		});

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

		$("#add_jobs-job_id").jqxComboBox({
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

		$('#add_jobs-job_id').on('select', function (e){
			var args = e.args.item.originalItem;
			$('#add_jobs-description').text(args.description);
			$('#add_jobs-job_code').text(args.job_code);

			var vehicle_id = $('#vehicle_id').val();
			if(vehicle_id == '' || vehicle_id == null){
				alert('Please Select Vehicle First');
			}else{

				// alert(vehicle_id);
				$.post('<?php echo site_url('admin/job_cards/get_job_price_info') ?>',{job_code:args.job_code,vehicle_id:vehicle_id},function(result){
						if(result.success){
							$('#add_jobs-price').val(result.price.price).focus();

						}
				},'json');
			}

		});

		var estimate_detailsDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'estimate_doc_no', type: 'number' },
			{ name: 'jobcard_group', type: 'number' },
			{ name: 'vehicle_no', type: 'string' },
			{ name: 'chassis_no', type: 'string' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'model_no', type: 'number' },
			{ name: 'variant', type: 'number' },
			{ name: 'color', type: 'number' },
			{ name: 'ledger_id', type: 'number' },
			{ name: 'total_jobs', type: 'string' },
			{ name: 'total_parts', type: 'string' },
			{ name: 'cash_percent', type: 'string' },
			{ name: 'vat_percent', type: 'string' },
			{ name: 'net_total', type: 'string' },
			{ name: 'dealer_id', type: 'number' },

			{ name: 'vehicle_id', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_id', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_id', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'full_name', type: 'string' },
			{ name: 'issued_date', type: 'string' },

			],
			url: '<?php echo site_url("admin/estimate_details/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				estimate_detailsDataSource.totalrecords = data.total;
			},
			filter: function () {
				$("#jqxGridEstimate_detail").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#jqxGridEstimate_detail").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGridEstimate_detail").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: estimate_detailsDataSource,
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
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				var container = $("<div style='margin: 5px; height:50px'></div>");
				container.append($('#jqxGridEstimate_detailToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editEstimate_detailRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					<?php if( is_admin() ) : ?>
					var e = '';
					<?php endif; ?>

					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("estimate_doc_no"); ?>',datafield: 'estimate_doc_no',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsrenderer: function(a,b,value,d,e,row) {
				return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">EI-'+(value).pad(5)+'</div>';
			} },
			/*{ text: '<?php echo lang("jobcard_group"); ?>',datafield: 'jobcard_group',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsrenderer: function(a,b,value,d,e,row) {
				return '<div class="jqx-grid-cell-left-align" style="margin-top: 7.5px;">JC-'+(value).pad(5)+'</div>';
			} },*/
			{ text: '<?php echo lang("vehicle_register_no"); ?>',datafield: 'vehicle_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("chassis_no"); ?>',datafield: 'chassis_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("model_no"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("ledger_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("net_total"); ?>',datafield: 'net_total',width: 150,filterable: true,renderer: gridColumnsRenderer },

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridEstimate_detail").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridEstimate_detailFilterClear', function () { 
			$('#jqxGridEstimate_detail').jqxGrid('clearfilters');
		});

		$(document).on('click','#jqxGridEstimate_detailInsert', function () { 

			$('#estimate_details-jobcard_group_display').hide();
			$('#estimate_details-jobcard_group').val('');
			$('#estimate_details-jobcard_group').prop('type', 'text');
			openPopupWindow('jqxPopupWindowEstimate_detail', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		$("#jqxPopupWindowEstimate_detail").jqxWindow({ 
			theme: theme,
			width: '95%',
			maxWidth: '95%',
			height: '95%',  
			maxHeight: '95%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		$("#jqxPopupWindowEstimate_detail").on('close', function () {
			reset_form_estimate_details();
		});

		$("#jqxEstimate_detailCancelButton").on('click', function () {
			reset_form_estimate_details();
			$('#jqxPopupWindowEstimate_detail').jqxWindow('close');
		});

		$('#form-estimate_details').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ input: '#net_total', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#net_total').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},
		]
	});

		$("#jqxEstimate_detailSubmitButton").on('click', function () {
		// saveEstimate_detailRecord();
		
		var validationResult = function (isValid) {
			if (isValid) {
				saveEstimate_detailRecord();
			}
		};
		$('#form-estimate_details').jqxValidator('validate', validationResult);
		
	});

		var partDataSource = {
			url : '<?php echo site_url("admin/estimate_details/get_spareparts_estimateDetails_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },

			{ name: 'price', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'sparepart_id', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'part_name', type: 'string' },
			],
		}

		partAdapter = new $.jqx.dataAdapter(partDataSource,
		{
			formatData: function (data) {
				if ($("#add_parts-part_id").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#add_parts-part_id").jqxComboBox('searchString');
					return data;
				}
			}
		});

		$("#add_parts-part_id").jqxComboBox({
			width: '100%',
			height: 25,
			source: partAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			autoDropDownHeight:true,
			displayMember: "part_name",
			valueMember: "sparepart_id",
			renderer: function (index, label, value) {
				var item = partAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = partAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				partAdapter.dataBind();
			}
		});		

		$('#add_parts-part_id').on('select', function(e){
			var args = e.args.item.originalItem;

			if(!args) {
				return;
			}
			$('#add_parts-part_name').val(args.name);
			$('#add_parts-part_code').val(args.part_code);
			$.post('<?php echo site_url('admin/estimate_details/get_part_price_json') ?>',{part_code:args.part_code},function(result){
				if(result.success){
					$('#add_parts-price').val(result.row.price);
				}
			},'json');
		});

		$('#add_parts-submit').on('click', function () {

			var validationResult = function (isValid) {
				if (isValid) {
					$('#jqxPopupWindowAddPart').block({ 
						message: '<span>Processing your request. Please be patient.</span>',
						css: { 
							width                   : '75%',
							border                  : 'none', 
							padding                 : '50px', 
							backgroundColor         : '#000', 
							'-webkit-border-radius' : '10px', 
							'-moz-border-radius'    : '10px', 
							opacity                 : .7, 
							color                   : '#fff',
							cursor                  : 'wait' 
						}, 
					});

					var datarow = {
						'part_id'		: 	$('#add_parts-part_id').val(),
						'part_name'		: 	$('#add_parts-part_name').val(),
						'part_code'		: 	$('#add_parts-part_code').val(),
						'price'			: 	$('#add_parts-price').val(),
						'quantity'		: 	$('#add_parts-quantity').val(),
						'final_amount'		: 	$('#add_parts-price').val() * $('#add_parts-quantity').val(),
					};

					var part_data_grid = EstimateParts.jqxGrid('getrows');
					console.log(part_data_grid);
					var exist = false;
					$.each(part_data_grid,function(k,v){
						if(datarow.part_code == v.part_code){
							exist = true;
						}
					});

					if(!exist){
						EstimateParts.jqxGrid('addrow', null, datarow);
						
					}else{
						alert('Part Code Already Exist');
					}

					// EstimateParts.jqxGrid('addrow', null, datarow);

					$('#jqxPopupWindowAddPart').unblock();
				}
			};
			$('#form-add_parts').jqxValidator('validate', validationResult);

		});

		$('#form-add_parts').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			// { input: '#add_parts-part_id', message: 'Required', action: 'blur', 
			// rule: function(input) {
			// 	val = $('#add_parts-part_id').val();

			// 	return (val == '' || val == null || val == 0) ? false: true;
			// } },


		
			// {input: '#user_gender', message: 'Required', action: 'select', rule: function(input){
			// 	val = $("#add_parts-part_id").jqxComboBox('val');
			// 	return (val == '' || val == null || val == 0) ? false: true;
			// } },
				


			{ input: '#add_parts-part_name', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#add_parts-part_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#add_parts-part_code', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#add_parts-part_code').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#add_parts-price', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#add_parts-price').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#add_parts-price', message: 'Cannot be below 0', action: 'blur', 
			rule: function(input) {
				val = $('#add_parts-price').val();
				return (val < 0 ) ? false: true;
			} },
			{ input: '#add_parts-quantity', message: 'Cannot be below 0', action: 'blur', 
			rule: function(input) {
				val = $('#add_parts-quantity').val();
				return (val < 0 ) ? false: true;
			} },
			{ input: '#add_parts-quantity', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#add_parts-quantity').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
		/*{ input: '#add_parts-total', message: 'Required', action: 'blur', 
		rule: function(input) {
			val = $('#add_parts-total').val();
			return (val == '' || val == null || val == 0) ? false: true;
		} },*/
		]
	});


		var vehicle_dataSource = {
			url : '<?php echo site_url("admin/job_cards/get_vehicles_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			],
			async: false,
			cache: true
		}

		vehicleAdapter = new $.jqx.dataAdapter(vehicle_dataSource);

		$("#vehicle_id").jqxComboBox({
			theme: theme,
			width: '93%',
			height: 23,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: vehicleAdapter,
			valueMember: "vehicle_id",
			displayMember: "vehicle_name",
			placeHolder: "Select Vehicle"
		});

		$("#vehicle_id").on('select', function (event) {
			if (event.args) {
				var item = event.args.item;
				if (item) {
					var variant_dataSource = {
						url : '<?php echo site_url("admin/job_cards/get_variants_combo_json"); ?>',
						data: {vehicle_id: item.value},
						datatype: 'json',
						datafields: [
						{ name: 'vehicle_id', type: 'number' },
						{ name: 'variant_id', type: 'number' },
						{ name: 'variant_name', type: 'string' },
						],
						async: false,
						cache: true
					}

					variantAdapter = new $.jqx.dataAdapter(variant_dataSource);

					$("#variant_id").jqxComboBox({
						theme: theme,
						width: '93%',
						height: 23,
						selectionMode: 'dropDownList',
						autoComplete: true,
						searchMode: 'containsignorecase',
						source: variantAdapter,
						valueMember: "variant_id",
						displayMember: "variant_name",
						placeHolder: "Select Variant"
					});

				}
			}
		});

		$("#variant_id").on('select', function (event) {
			if (event.args) {
				var item = event.args.item;
				if (item) {
					var colors_dataSource = {
						url : '<?php echo site_url("admin/job_cards/get_colors_combo_json"); ?>',
						data: {variant_id: item.value, vehicle_id: item.originalItem.vehicle_id},
						datatype: 'json',
						datafields: [
						{ name: 'color_id', type: 'number' },
						{ name: 'color_name', type: 'string' },
						],
						async: false,
						cache: true
					}

					colorsAdapter = new $.jqx.dataAdapter(colors_dataSource);

					$("#color_id").jqxComboBox({
						theme: theme,
						width: '93%',
						height: 23,
						selectionMode: 'dropDownList',
						autoComplete: true,
						searchMode: 'containsignorecase',
						source: colorsAdapter,
						valueMember: "color_id",
						displayMember: "color_name",
						placeHolder: "Select Colour"
					});

				}
			}
		});

		var partyDataSource = {
			url : '<?php echo site_url("admin/job_cards/get_ledger_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'full_name', type: 'string' },
			{ name: 'party_name', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		partyDataAdapter = new $.jqx.dataAdapter(partyDataSource);

		$("#estimate_details-party_name").jqxComboBox({
			theme: theme,
			width: '95%',
				// height: '34px',
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: partyDataAdapter,
				displayMember: "party_name",
				valueMember: "id",
				placeHolder: "Enter User" 
			});

	});


function getFormData(formId) {
	return $('#' + formId).serializeArray().reduce(function (obj, item) {
		var name = item.name,
		value = item.value;

		if (obj.hasOwnProperty(name)) {
			if (typeof obj[name] == "string") {
				obj[name] = [obj[name]];
				obj[name].push(value);
			} else {
				obj[name].push(value);
			}
		} else {
			obj[name] = value;
		}
		return obj;
	}, {});
}



function editEstimate_detailRecord(index){
	var row =  $("#jqxGridEstimate_detail").jqxGrid('getrowdata', index);
	// console.log(row);
	if (row) {

		var newEstimateJobsource =
		{
			url : '<?php echo site_url("admin/estimate_details/get_estimate_jobs"); ?>',
			data: { id: row.id, estimate_id: row.estimate_doc_no },
			datatype: "json",
			datafields:
			[
			{ name: 'id', type: 'number' },
			{ name: 'job_id', type: 'number' },
			{ name: 'job_code', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'discount', type: 'string' },
			{ name: 'total_amount', type: 'string' },
			{ name: 'customer_voice', type: 'string' },
			],	
			sortdatafield: 'id',
            sortorder: 'asc',	
		};
		var newEstimateJobAdapter = new $.jqx.dataAdapter(newEstimateJobsource);
		EstimateJobs.jqxGrid({source: newEstimateJobAdapter});

		var newEstimateSource =
		{
			url : '<?php echo site_url("admin/estimate_details/get_estimate_parts"); ?>',
			data: { id: row.id, estimate_id: row.estimate_doc_no },
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'part_id', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'final_amount', type: 'number' },
			],
		};
		var newEstimatePartAdapter = new $.jqx.dataAdapter(newEstimateSource);
		EstimateParts.jqxGrid({ source: newEstimatePartAdapter });

		$('#estimate_details_id').val(row.id);
		$('#estimate_details-estimate_doc_no').val(row.estimate_doc_no);
		$('#estimate_details-jobcard_group').val(row.jobcard_group);

		if(row.estimate_doc_no) {
			$('#estimate_details-estimate_no_dislay').text("EI-"+ (row.estimate_doc_no).pad(5));
		}
		if(row.jobcard_group) {
			$('#estimate_details-jobcard_group_display').text("JC-"+ (row.jobcard_group).pad(5));
		}

		$('#vehicle_register_no').val(row.vehicle_no);
		$('#chassis_no').val(row.chassis_no);
		$('#engine_no').val(row.engine_no);
		$('#vehicle_id').val(row.vehicle_id);
		$('#variant_id').val(row.variant_id);
		$('#color_id').val(row.color_id);
		$('#estimate_details-party_name').val(row.ledger_id);
		$('#issued_date').jqxDateTimeInput('setDate', row.issued_date);
		$('#total_jobs').val(row.total_jobs);
		$('#total_parts').val(row.total_parts);
		$('#cash_percent').val(row.cash_percent);
		$('#vat_percent').val(row.vat_percent);
		$('#net_total').val(Math.round(parseFloat(row.net_total) * 100) / 100);
		
		openPopupWindow('jqxPopupWindowEstimate_detail', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveEstimate_detailRecord(){
	var data = getFormData('form-estimate_details');
	var jobs_data = EstimateJobs.jqxGrid('getrows');
	var parts_data = EstimateParts.jqxGrid('getrows');
	
	/*$('#jqxPopupWindowEstimate_detail').block({ 
		message: '<span>Processing your request. Please be patient.</span>',
		css: { 
			width                   : '75%',
			border                  : 'none', 
			padding                 : '50px', 
			backgroundColor         : '#000', 
			'-webkit-border-radius' : '10px', 
			'-moz-border-radius'    : '10px', 
			opacity                 : .7, 
			color                   : '#fff',
			cursor                  : 'wait' 
		}, 
	});*/

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/estimate_details/save"); ?>',
		data: {data, jobs_data, parts_data},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_estimate_details();
				$('#jqxGridEstimate_detail').jqxGrid('updatebounddata');
				$('#jqxPopupWindowEstimate_detail').jqxWindow('close');
			}
			$('#jqxPopupWindowEstimate_detail').unblock();
		}
	});
}

function reset_form_estimate_details(){
	$('#estimate_details_id').val('');
	$('#form-estimate_details')[0].reset();

	$('#estimate_details-estimate_no_dislay').text('');
	$('#estimate_details-jobcard_group_display').show().text('');
	$('#estimate_details-jobcard_group').prop('type', 'hidden');

	EstimateJobs.jqxGrid('clear');
	EstimateParts.jqxGrid('clear');
	$('#vehicle_id').jqxComboBox('clearSelection');
	$('#variant_id').jqxComboBox('clearSelection');
	$('#color_id').jqxComboBox('clearSelection');
	$('#estimate_details-party_name').jqxComboBox('clearSelection');

}
</script>

<script type="text/javascript">
	$(function(){

		EstimateJobs = $('#jqxgrid_estimate_jobs').jqxGrid({
			altrows: true,
			pageable: true,
			sortable: true,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			editable: true,
			selectionmode: 'singlecell',
			enableanimations: false,
			pagesizeoptions: pagesizeoptions,
			showaggregates: true,
			showstatusbar: true,			
			width: '100%',
			height: '200px',
			showtoolbar: true,
			columns: [
			{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
				return "Delete row";
			}, buttonclick: function (row) {
				var row_data = EstimateJobs.jqxGrid('getrowdata',row);
				if(confirm('Do you want to delete this job?')){
					$.post('<?php echo site_url("estimate_details/delete_jobs")?>',{id:row_data.id},function(data){
						if(data.success){
							var row_id = EstimateJobs.jqxGrid('getrowid',row);
							EstimateJobs.jqxGrid('deleterow',row_id);
						}
					},'json');
				}
			} },
			{ text: '<?php echo lang("customer_voice") ?>', datafield: 'customer_voice' ,editable:false, },
			{ text: '<?php echo lang("job_code"); ?>', datafield: 'job_code', width: '10%',editable:false, },
			{ text: '<?php echo lang("description"); ?>', datafield: 'description',editable:false, },
			{ text: '<?php echo lang("price"); ?>', datafield: 'price', width: '10%', cellsalign: 'right',columntype: 'numberinput',renderer: gridColumnsRenderer, editable:false, },
			{ text: '<?php echo lang("discount"); ?>', datafield: 'discount', width: '10%', columntype: 'numberinput',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var price = parseFloat(EstimateJobs.jqxGrid('getcellvalue', row, "price"));
				price = price - (newvalue/100) * price;
				EstimateJobs.jqxGrid('setcellvalue', row, "total_amount", price);

			} },
			{ 
				text: "<?php echo lang("total_amount"); ?>", datafield: 'total_amount', width: '10%', filterable: true, renderer: gridColumnsRenderer, columntype: 'numberinput', editable:false, aggregates: [{ '<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;

					$('#total_jobs').val(total);
					estimate_cal_cash_discount_percent();
					return total;
				} }]
			},
			]
		});

		EstimateParts = $("#jqxgrid_estimate_parts").jqxGrid(
		{
			width: '100%',
			height: '300px',
			pageable: true,
			columnsresize: true,
			editable: true,
			selectionmode: 'singlecell',
			enableanimations: false,
			showaggregates: true,
			showstatusbar: true,
			showtoolbar: true,
			columns: [
			{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
				return "Delete row";
			}, buttonclick: function (row) {
				var row_data = EstimateParts.jqxGrid('getrowdata',row);
				/*if(row_data.status == "Complete") {
					return;
				}*/
				if (confirm('Do you want to delete this part?')) {
					$.post('<?php echo site_url("estimate_details/delete_parts")?>',{id:row_data.id},function(data){
						if(data.success){
							var row_id = EstimateParts.jqxGrid('getrowid',row);
							EstimateParts.jqxGrid('deleterow',row_id);
							estimate_cal_cash_discount_percent();
						}
					},'json')
				}
			} },
			{ text: '<?php echo 'part_id' ?>', datafield: 'part_id', width: '15%',editable: false, hidden:true},
			{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '15%',editable: false, },
			{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', width: '30%',editable: false, },
			{ text: '<?php echo lang("price")?>', datafield: 'price', width: '10%', cellsalign: 'right', columntype: 'numberinput', editable: false, },
			{ text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%', columntype: 'numberinput', 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var price = parseFloat(EstimateParts.jqxGrid('getcellvalue', row, "price"));
				var discount = parseFloat(EstimateParts.jqxGrid('getcellvalue', row, "discount"));

				if(isNaN(discount))
				{
					discount = 0;
				}

				price = newvalue * price;
				price = price - (discount/100) * price;
				EstimateParts.jqxGrid('setcellvalue', row, "final_amount", price);

			} },
			{ 
				text: '<?php echo lang("discount") ?>', datafield: 'discount', width: '10%', columntype: 'numberinput', 
				validation: function( cell, value ) {
					if( value > ALLOWED_DISCOUNT || value < 0) {
						return { result: false, message: "Cannot provide such discount." };
					}
					return true;
				},
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					if( newvalue > ALLOWED_DISCOUNT || newvalue < 0) {
						return false;
					}
					
					var price = parseFloat(EstimateParts.jqxGrid('getcellvalue', row, "price"));
					var quantity = parseFloat(EstimateParts.jqxGrid('getcellvalue', row, "quantity"));
					price = quantity * price;
					price = price - (newvalue/100) * price;
					EstimateParts.jqxGrid('setcellvalue', row, "final_amount", price);

				} 
			},
			{ 
				text: '<?php echo lang("total")?>', datafield: 'final_amount', width: '10%', editable: false,
				aggregates: [
				{ 
					'<b>Total</b>':
					function (aggregatedValue, currentValue, column, record) {
						var total = currentValue;
						total = aggregatedValue + total; 
						$('#total_parts').val(total);

						estimate_cal_cash_discount_percent();
						// estimate_cal_cash_discount_percent();
						return total;
					}
				}
				]  
			},
			]
		}); 

		$("#jqxPopupWindowAddPart").jqxWindow({ 
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '50%',  
			maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false,
			cancelButton: $('#add_parts-close'),
		}); 

		$("#jqxPopupWindowAddJob").jqxWindow({ 
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '70%',  
			maxHeight: '70%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false,
			cancelButton: $('#add_jobs-close'),
		}); 

		$('#estimate_add_part').on('click', function(){
			openPopupWindow('jqxPopupWindowAddPart', '<?php echo lang("general_add")  . "&nbsp;" .  lang("part"); ?>');
		});

		$('#estimate_add_job').on('click', function(){
			openPopupWindow('jqxPopupWindowAddJob', '<?php echo lang("general_add")  . "&nbsp;" .  lang("part"); ?>');
		});


		$('#add_jobs-submit').on('click', function(){
			var validationResult = function (isValid) {
				if (isValid) {
					$('#jqxPopupWindowAddJob').block({ 
						message: '<span>Processing your request. Please be patient.</span>',
						css: { 
							width                   : '75%',
							border                  : 'none', 
							padding                 : '50px', 
							backgroundColor         : '#000', 
							'-webkit-border-radius' : '10px', 
							'-moz-border-radius'    : '10px', 
							opacity                 : .7, 
							color                   : '#fff',
							cursor                  : 'wait' 
						}, 
					});
					var data = getFormData('form-add_jobs');
					var datarow = {
						'customer_voice'			: data.customer_voice,
						'job_id'					: data.job_id,
						'job_code'					: $('#add_jobs-job_code').text(),
						'description'				: $('#add_jobs-description').text(),
						'price'						: data.price,
						'discount'					: data.discount,
						'total_amount'				: data.price - (data.discount *data.price )/100
					};
					EstimateJobs.jqxGrid('addrow', null, datarow);
					// $('#jqxPopupWindowAddJob').jqxWindow('close');
					EstimateJobs.jqxGrid('sortby', 'id', 'asc');
					$('#jqxPopupWindowAddJob').unblock();


				}
			};

			$('#form-add_jobs').jqxValidator('validate', validationResult);

		});

		$('#form-add_jobs').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ input: '#add_jobs-job_id', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#add_jobs-job_id').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#add_jobs-price', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#add_jobs-price').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			]
		});


	});
</script>

<script type="text/javascript">
	function estimate_cal_cash_discount_amt() {
		var total_job = (parseFloat($('#total_jobs').val()))?parseFloat($('#total_jobs').val()):0;
		var total_parts = (parseFloat($('#total_parts').val()))?parseFloat($('#total_parts').val()):0;
		var total_discount_amount = parseFloat($('#cash_discount_amt').val());
		var total_discount_percentage = total_discount_amount * 100 / total_job;
		var total_vat = parseFloat($('#vat_percent').val());

		var discounted_amount = total_job - total_discount_amount;
		var total_vat_job = cal_vat_value(total_vat, discounted_amount,'vat_amount_job');
		var total_vat_parts = cal_vat_value(total_vat,total_parts,'vat_amount_parts');
		// var total_amount = total_vat_job + total_vat_parts + discounted_amount + total_parts;
		// $('#net_total').val(total_amount);
		cal_total_amt(discounted_amount, total_parts, total_vat_job, total_vat_parts);
		$('#cash_percent').val(total_discount_percentage);
	}
</script>
<script type="text/javascript">
	function estimate_cal_cash_discount_percent() {
		var total_job = (parseFloat($('#total_jobs').val()))?parseFloat($('#total_jobs').val()):0;
		var total_parts = (parseFloat($('#total_parts').val()))?parseFloat($('#total_parts').val()):0;
		var total_discount_percentage = parseFloat($('#cash_percent').val());
		var total_discount_amount = total_discount_percentage * total_job / 100;
		var total_vat = parseFloat($('#vat_percent').val());

		var discounted_amount = total_job - total_discount_amount;
		var total_vat_job = cal_vat_value(total_vat, discounted_amount,'vat_amount_job');
		var total_vat_parts = cal_vat_value(total_vat,total_parts,'vat_amount_parts');
		// var total_amount = total_vat_job + total_vat_parts + discounted_amount + total_parts;
		// $('#net_total').val(total_amount);
		cal_total_amt(discounted_amount, total_parts, total_vat_job, total_vat_parts );
		$('#cash_discount_amt').val(total_discount_percentage);
	}
</script>
<script type="text/javascript">
	function cal_vat_value(vat, total, id) {
		console.log(vat);
		console.log(total);
		vat_amt = total * vat / 100;
		console.log('#'+id);
		$('#'+id).val(vat_amt);
		return vat_amt;
	}
</script>
<script type="text/javascript">
	function cal_total_amt(total_job, total_part, vat_job, vat_part) {
		// body...
		var total_amount = total_job + total_part + vat_job + vat_part;
		$('#net_total').val(Math.round(parseFloat(total_amount) * 100) / 100);
	}
</script>
<script type="text/javascript">
	$('#jqxEstimate_detailPrintButton').click(function(){
		var id = $('#estimate_details-estimate_doc_no').val();
		// var job_card = $('#estimate_details-jobcard_group').val()
		// $.post('<?php echo site_url('job_cards/print_preview')?>',{id:id,type:'Estimate',jobcard:job_card},function(){

		// },'json')
		var type = 'Estimate';

		var url = '<?php echo site_url('job_cards/print_preview?jobcard=') ?>' + id + '&type=' + type;


		myWindow = window.open(url, type, "height=900,width=1300");

		myWindow.document.close(); 

		myWindow.focus();
		myWindow.print();
	})
</script>

<script type="text/javascript">
	function get_jobcard_detail() {
		var job_card_detail = $('#estimate_details-jobcard_group').val();
		var vehicle_register_no = $('#vehicle_register_no').val();
		var chassis_no = $('chassis_no').val();
		var engine_no = $('engine_no').val();

		$.post('<?php echo site_url("estimate_details/get_estimate_detail")?>',{'job_card_detail':get_jobcard_detail, 'vehicle_register_no':vehicle_register_no,'chassis_no':chassis_no,'engine_no':engine_no},function(data){

		},'json')
	}
</script>