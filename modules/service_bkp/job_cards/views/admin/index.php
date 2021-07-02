<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('job_cards'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('job_cards'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridJob_cardToolbar' class='grid-toolbar'>
					<?php // if(is_service_advisor()){?>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridJob_cardInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="counter_btn"><?php echo lang('counter'); ?></button>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="partial_estimate"><?php echo lang('estimate'); ?></button>
					<?php //}?>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridJob_cardFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridJob_card"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowJob_card">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-job_cards', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "job_cards_id"/>
		<div class="row">
			<div class="col-md-6">
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='jobcard_group'><?php echo lang('jobcard_group')?></label>
					</div>
					<div class="col-md-2 ">
						<input id='jobcard_group' type="text" class='form-control input-sm' name='jobcard_group' value="<?php //echo $new_jobcard_group; ?>" readonly>
						<!-- <button type="button" class="btn btn-flat btn-sm" onclick="findJobCard()"><i class="fa fa-search"></i></button> -->
					</div>
					<div class="col-md-2 ">
						<label for='jobcard_group'><?php echo lang('issue_date')?></label>
					</div>
					<div class="col-md-4">
						<div name="issue_date" class="form-control" id="job_cards-issue_date"></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='vehicle_register_no'>Vehicle No.</label>
					</div>
					<div class="col-md-9 ">
						<input id='vehicle_register_no' class='form-control input-sm' name='vehicle_register_no' type="text" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='engine_no'><?php echo lang('engine_no')?></label>
					</div>
					<div class="col-md-9 ">
						<input id='engine_no' class='form-control input-sm' name='engine_no'>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='chassis_no'><?php echo lang('chassis_no')?></label>
					</div>
					<div class="col-md-4 ">
						<input id='chassis_no' class='form-control input-sm' name='chassis_no'>
					</div>
					<div class="col-md-2 ">
						<label for='gear_box_no'><?php echo lang('gear_box_no')?></label>
					</div>
					<div class="col-md-3 ">
						<input id='gear_box_no' class='form-control input-sm' name='gear_box_no'>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='vehicle_name'><?php echo lang('vehicle_name')?></label>
					</div>
					<div class="col-md-9 ">
						<!-- <input id='vehicle_name' class='form-control input-sm' name='vehicle_name'> -->
						<div id='vehicle_name' class='form-control input-sm' name='vehicle_name'></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='variant_name'><?php echo lang('variant_name')?></label>
					</div>
					<div class="col-md-9 ">
						<!-- <input id='variant_name' class='form-control input-sm' name='variant_name'> -->
						<div id='variant_name' class='form-control input-sm' name='variant_name'></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='color_name'><?php echo lang('color_name')?></label>
					</div>
					<div class="col-md-9 ">
						<!-- <input id='color_name' class='form-control input-sm' name='color_name'> -->
						<div id='color_name' class='form-control input-sm' name='color_name'></div>
					</div>
				</div>
			</div>	
			<div class="col-md-6">
				<div class="row form-group">
					<div class="col-md-3 ">
						<label for='service_type'><?php echo lang('service_type')?></label>
					</div>
					<div class="col-md-9 ">
						<div id='service_type' class=' form-control input-sm' name='service_type'></div>
					</div>
				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='service_no'><?php echo lang('service_no')?></label>
					</div>
					<div class="col-md-4 ">
						<input id='service_no' class='form-control input-sm' name='service_no' readonly>
					</div>
					<div class="col-md-2 ">
						<label for='key_no'><?php echo lang('key_no')?></label>
					</div>
					<div class="col-md-3 ">
						<input id='key_no' class='form-control input-sm' name='key_no'>
					</div>

				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='kms'><?php echo lang('kms')?></label>
					</div>
					<div class="col-md-4 ">
						<input id='kms' class=' form-control input-sm' name='kms'>
					</div>

					<div class="col-md-2 ">
						<label for='fuel'><?php echo lang('fuel')?></label>
					</div>
					<div class="col-md-3 ">
						<input id='fuel' class='form-control input-sm' name='fuel'>
					</div>
				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='floor_supervisor_id'><?php echo lang('floor_supervisor_id')?></label>
					</div>
					<div class="col-md-9 ">
						<div id='floor_supervisor_id' class='form-control input-sm' name='floor_supervisor_id'></div>
					</div>
				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='mechanics_id'><?php echo lang('mechanics_id')?></label>
					</div>
					<div class="col-md-9 ">
						<div id='mechanics_id' class='form-control input-sm' name='mechanics_id'></div>
					</div>
				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='mechanic_list'><?php echo lang('mechanic_list')?></label>
					</div>
					<div class="col-md-9 ">
						<div id='mechanic_list' class='form-control input-sm' name='mechanic_list'></div>
					</div>
				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='cleaner_id'><?php echo lang('cleaner_id')?></label>
					</div>
					<div class="col-md-9 ">
						<div id='cleaner_id' class='form-control input-sm' name='cleaner_id'></div>
					</div>
				</div>
				<div class="row form-group">

					<div class="col-md-3 ">
						<label for='accessories'><?php echo lang('accessories')?></label>
					</div>
					<div class="col-md-9 ">
						<div id='accessories' class='form-control input-sm' name='accessories'></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('coupon','coupon'); ?> 
					</div>
					<div class="col-md-4">
						<input id="coupon" class="form-control input-sm" name="coupon"> 
					</div>
					<div class="col-md-2 ">
						<label for='sell_dealer'><?php echo lang('sell_dealer')?></label>
					</div>
					<div class="col-md-3 ">
						<input id='sell_dealer' class='form-control input-sm' name='sell_dealer'>
					</div>
				</div>
			</div>
			<input type="hidden" id='vehicle_id' class='text_input' name='vehicle_id'>
			<input type="hidden" id='job_cards-jobcard_group' class='text_input' name='job_cards-jobcard_group'>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-1 "> <label for='party_name'><?php echo lang('party_name')?></label> </div>
			<div class="col-md-3"> <div id='party_name'  name='party_id'></div> </div>

			<div class="col-md-1">
				<label>Vehicle Sold On</label>
			</div>
			<div class="col-md-3">
				<div id="vehicle_sold_on" name="vehicle_sold_on" class="font-control"></div>
			</div>
		</div>


		<hr>
		<div id='jqxTabs-jobcard_create'>
			<ul style='margin-left: 20px;'>
				<li><div>Jobs Detail</div></li>
				<li><div>Materials Detail</div></li>
			</ul>
			<div>
				<div id="jqxgrid"> </div>
			</div>
			<div >
				<div id="materialJqxgrid" hidden></div>
			</div>
		</div>		

		<div class="row">
			<div class="col-md-12">
				<div>
					<input type="checkbox" name="print_preview" id="print_preview"> Print after save
					<button type="button" onclick="printPreview('JobCard')">PRINT</button>
				</div>
				<div class="pull-right">
					<button type="button" class="btn btn-success btn-sm btn-flat" id="jqxJob_cardSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-sm btn-flat" id="jqxJob_cardCancelButton"><?php echo lang('general_cancel'); ?></button>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowJob">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_job">Add Job</span>
	</div>
	<div class="form_fields_area">
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang('customer_voice')?></label></div>
			<div class="col-md-8"><textarea class="text_area" name="customer_voice" id="customer_voice"></textarea></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang('job')?></label></div>
			<div class="col-md-8"><div name="job" class="number_general" id="new_job_id" onchange="get_job_detail()"></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label>Description</label></div>
			<div class="col-md-6"><div id="new_job_description"></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label>Price</label></div>
			<div class="col-md-6"><input type="number" id="new_job_price"></div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<button class="btn btn-primary btn-xs btn-flat" id="job_to_table">Add</button>
				<button class="btn btn-danger btn-xs btn-flat" id="close_add_job"><?php echo lang('general_cancel')?></button>
			</div>
		</div>
		<input type="hidden" name="new_job_name" id="new_job_name">
	</div>
</div>

<!-- for parts form -->
<div id="jqxPopupWindowPart">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_job">Add Part</span>
	</div>
	<div class="form_fields_area">
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang('part_name')?></label></div>
			<div class="col-md-6"><div id="new_part_id" onchange="get_part_detail()"></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang('part_code')?></label></div>
			<div class="col-md-8"><span id="new_part_code"></span></div>
		</div>
		<div class="row form-group" hidden>
			<div class="col-md-4"><label><?php echo lang('price')?></label></div>
			<div class="col-md-6"  ><div type="number" class="number_general" id="new_part_price" ></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang('quantity')?></label></div>
			<div class="col-md-6"><div type="number" class="number_general" id="new_part_quantity"></div></div>
			<input type="hidden" id="new_part_stock_quantity">
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang('total')?></label></div>
			<div class="col-md-6"><input type="text" class="form-control input-sm" id="new_part_total" readonly></div>
		</div>

		<div class="row form-group">
			<div class="col-md-12">
				<button class="btn btn-primary btn-xs btn-flat partial_part_to_table" id="part_to_table">Add</button>
				<button class="btn btn-danger btn-xs btn-flat" id="close_add_part"><?php echo lang('general_cancel')?></button>
			</div>
		</div>
		<input type="hidden" name="new_part_name" id="new_part_name">
		<input type="hidden" name="new_min_price" id="new_min_price">
	</div>
</div>

<div id="popupWindow">
	<div> <?php echo lang("delete_a_row") ?> </div>
	<div>
		<p><?php echo lang('delete_a_row_confirm') ?></p>
		<button id="del">Yes</button>
		<button id="cancel">No</button>
	</div>
</div>

<div id="partpopupWindow">
	<div> <?php echo lang("delete_a_row") ?> </div>
	<div>
		<p><?php echo lang('delete_a_row_confirm') ?></p>
		<button id="partdel">Yes</button>
		<button id="partcancel">No</button>
	</div>
</div>

<!-- for estimate form -->
<div id="jqxPopupWindowEstimate">
	<div> Estimate </div>
	<div>
		<div id='form-estimate'></div>
		<button id="save_estimate" class="btn btn-xs btn-flat btn-primary"> Save</button>
		<button id="estimatecancel" class="btn btn-danger btn-flat btn-xs"> Close</button>
	</div>
</div>

<!-- for outside work -->
<div id="jqxPopupWindowOutsideWork">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="outsideWork_popup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo $this->load->view('partial_outside_work'); ?>
	</div>
</div>

<!-- for assign user to job -->
<div id="jqxPopupWindowAssign">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="assign_window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo $this->load->view('partial_assigns'); ?>
	</div>
</div>

<!-- for bill -->
<div id="jqxPopupWindowBill">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="bill_window_poptup_title"></span>
	</div>

	<div>
		<div class="form_fields_area" id="bill">
		</div>

		
	</div>

</div>

<!-- for COUNTER -->
<div id="jqxPopupWindowCounter">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="counter_window_poptup_title">Counter Sales</span>
	</div>

	<div>
		<div class="form_fields_area" id="counter_sales"> </div>
	</div>

</div>

<!-- for detail -->
<div id="jqxPopupWindowDetail">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="detail_window_poptup_title"></span>
	</div>

	<div>
		<div class="form_fields_area" id="detail_list">
		</div>

		<!-- <button class="btn btn-primary btn-flat btn-xs" id="save_detail">Save</button> -->
		<button class="btn btn-danger btn-flat btn-xs" id="close_detail">Close</button>
	</div>

</div>
<?php $this->load->view('partial_material_issue'); ?>
<?php 
// function reopen_job_form
// function close_job
$this->load->view('partial_jobcard_close'); 
?>


<?php $this->load->view('partial_estimate'); ?>

<?php $this->load->view('partial_job_status'); ?>
<script language="javascript" type="text/javascript">
	var Job_form_table = null;
	var part_total = null;

	function findJobCard() {
		
		
	}
	$(document).ready(function () {
		$('#jqxTabs-jobcard_create').jqxTabs({ width: '100%', height: '350px' });
	});

	$(function(){
		// $("#service_no").jqxNumberInput({ readOnly: true })
		$('#vehicle_sold_on').jqxDateTimeInput({ width: '250px', height: '25px', formatString: "yyyy-MM-dd" });
		$('#job_cards-issue_date').jqxDateTimeInput({ width: '87%', height: '21px', formatString: "yyyy-MM-dd hh:mm" });

		$('#jobcard_group').on('change',function(){
			return; //commenting 


			/*var jobcard = $('#jobcard_group').val();
			$.post('<?php echo site_url("admin/job_cards/get_jobCard_details"); ?>',{ jobcard_group: jobcard},
				function(result){
					
					Job_form_table.jqxGrid('updatebounddata');
					if(result.rows == false){
						// console.log(result);
						$('#vehicle_register_no').val('');
						$('#engine_no').val('');
						$('#chassis_no').val('');
						$('#vehicle_name').val('');
						$('#variant_name').val('');
						$('#color_name').val('');

						$('#sell_dealer').val('');
						$('#party_name').val('');
						// $('#party_id').val('');
						$('#vehicle_sold_on').val('');
						$('#service_no').val('');
						alert('Job Order not found!')
						return;
					}
					// console.log(result);
					// return;

					$('#vehicle_register_no').val(result.rows['vehicle_no']);
					$('#engine_no').val(result.rows['engine_no']);
					$('#chassis_no').val(result.rows['chassis_no']);
					$('#vehicle_name').val(result.rows['vehicle_id']);
					$('#variant_name').val(result.rows['variant_id']);
					$('#color_name').val(result.rows['color_id']);

					$('#sell_dealer').val('8010');
					$('#party_name').val(result.rows['id']);
					$('#vehicle_sold_on').val(result.rows['vehicle_sold_on']);
					// $('#party_id').val(row['customer']['customer_id']);
					$('#service_no').val(result.number_of_service + 1);

					$.each(result.jobs, function(i,v){
						var datarow = {
							'customer_voice': v.customer_voice,
							'job_id'		: v.job_id,
							'job'			: v.job,
							'description'	: v.job_description,
							'price'			: v.min_price,
							'status'		: v.status,
							'id'			: v.id
						};
						Job_form_table.jqxGrid('addrow', null, datarow);

					});

				} ,'JSON');*/
			});

		/*var jobCardGroupSource = {
			url : '<?php echo site_url("admin/job_cards/get_jobCard_groups"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'jobcard_group', type: 'number' },
				// { name: 'name', type: 'number' },
				],
				async: false,
				cache: true
			}

			jobCardGroupAdapter = new $.jqx.dataAdapter(jobCardGroupSource);

			$("#jobcard_group").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				autoDropDownHeight:true,
				// selectionMode: 'dropDownList',
				// autoComplete: true,
				searchMode: 'containsignorecase',
				source: jobCardGroupAdapter,
				displayMember: "jobcard_group",
				valueMember: "jobcard_group",
			});*/

			/*var ledgerDataSource = {
				url : '<?php echo site_url("admin/job_cards/get_ledger_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'short_name', type: 'string' },
				{ name: 'full_name', type: 'string' },
				{ name: 'address1', type: 'string' },
				],
				async: false,
				cache: true,
				method: 'post',
			}

			ledgerDataAdapter = new $.jqx.dataAdapter(ledgerDataSource);*/

			$("#party_name").jqxComboBox({
				theme: theme,
				width: '95%',
				// height: '34px',
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: ledgerDataAdapter,
				displayMember: "full_name",
				valueMember: "id",
				placeHolder: "Enter User" 
			});

	//vehicles_register_no
	/*var vehicleDataSource = {
		url : '<?php echo site_url("admin/job_cards/get_vehicle_no_json"); ?>',
		datatype: 'json',
		datafields: [
		// { name: 'id', type: 'number' },
		{ name: 'vehicle_no', type: 'string' },
		],
		async: false,
		cache: true
	}
	var vehicle_no_array = new Array();
	vehicleRegAdapter = new $.jqx.dataAdapter(vehicleDataSource, { 
		autoBind: true, loadComplete: function (data) {
			for (var i = 0; i < data.length; i++) {
				vehicle_no_array.push(data[i].name);
			};
		}
	});*/
	
	/*$("#partial_vehicle_register").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: vehicleRegAdapter,
		displayMember: "vehicle_no",
		valueMember: "vehicle_no",
	});*/

	// service type
	var serviceDataSource = {
		url : '<?php echo site_url("admin/service_types/get_service_type_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'name', type: 'string' },
		],
		async: false,
		cache: true
	}

	serviceAdapter = new $.jqx.dataAdapter(serviceDataSource);

	$("#service_type").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: serviceAdapter,
		displayMember: "name",
		valueMember: "id",
		placeHolder: "Select Service Type"
	});

	//Vehicle
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

	$("#vehicle_name").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: vehicleAdapter,
		valueMember: "vehicle_id",
		displayMember: "vehicle_name",
		placeHolder: "Select Vehicle"
	});

	$("#vehicle_name").on('select', function (event) {
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

				$("#variant_name").jqxComboBox({
					theme: theme,
					width: 195,
					height: 25,
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

	$("#variant_name").on('select', function (event) {
		if (event.args) {
			var item = event.args.item;
			// console.log(item);
			// return;
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

				$("#color_name").jqxComboBox({
					theme: theme,
					width: 195,
					height: 25,
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

		//supervisor combobox
		var supervisorDataSource = {
			url : '<?php echo site_url("admin/job_cards/get_user_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			data : {group: 'Floor Supervisor'},
			async: false,
			cache: true,
			method: 'post',
		}

		supervisorAdapter = new $.jqx.dataAdapter(supervisorDataSource);

		$("#floor_supervisor_id, #combo_floor_supervisor").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: supervisorAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		//Mechanics combo json
		var mechanicsDataSource = {
			url : '<?php echo site_url("admin/job_cards/get_mechanic_lists"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'designation_id', type: 'string' },
			{ name: 'employee_name', type: 'string' },
			],
			data : {group: 'mechanic_leader'}, //possible values: { mechanic_leader, mechanics }
			async: false,
			cache: true,
			method: 'post',
		}

		mechanicsAdapter = new $.jqx.dataAdapter(mechanicsDataSource);

		$("#mechanics_id, #combo_mechanics, #add_outside_work-mechanic_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: mechanicsAdapter,
			displayMember: "employee_name",
			valueMember: "id",
		});

		$('#mechanics_id').on('change',function(event){
			if (event.args) {
				var item = event.args.item;
				var mechanic_list_DataSource = {
					url : '<?php echo site_url("admin/job_cards/get_mechanic_lists"); ?>',
					datatype: 'json',
					datafields: [
					{ name: 'id', type: 'number' },
					{ name: 'name', type: 'string' },
					{ name: 'designation_id', type: 'string' },
					{ name: 'employee_name', type: 'string' },
					],
					data : {group: item.originalItem.designation_id, mechanic: item.value}, 
					// possible values: { mechanic_leader, mechanics }
					async: false,
					cache: true,
					method: 'post',
				}

				mechanic_listAdapter = new $.jqx.dataAdapter(mechanic_list_DataSource);

				$("#mechanic_list").jqxComboBox({
					theme: theme,
					width: 195,
					height: 25,
					selectionMode: 'dropDownList',
					autoComplete: true,
					searchMode: 'containsignorecase',
					source: mechanic_listAdapter,
					displayMember: "employee_name",
					valueMember: "id",
				});
			}
		});

		var cleanersDataSource = {
			url : '<?php echo site_url("admin/job_cards/get_cleaners_lists"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'employee_name', type: 'string' },
			],
			data : {group: 'cleaner'},
			async: false,
			cache: true,
			method: 'post',
		}

		cleanersAdapter = new $.jqx.dataAdapter(cleanersDataSource);

		$("#cleaner_id, #combo_cleaner").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: cleanersAdapter,
			displayMember: "employee_name",
			valueMember: "id",
		});

		// job combobox
		var jobDataSource = {
			url : '<?php echo site_url("admin/service_jobs/get_jobs"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'service_job_id', type: 'number' },
			{ name: 'job_description', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		jobAdapter = new $.jqx.dataAdapter(jobDataSource);

		$("#new_job_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: jobAdapter,
			displayMember: "job_description",
			valueMember: "service_job_id",
			placeHolder: "Enter Job Code",
		});

		// accessories combobox
		var accessoriesDataSource = {
			url : '<?php echo site_url("admin/accessories/get_accessories_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		accessoriesAdapter = new $.jqx.dataAdapter(accessoriesDataSource);

		$("#accessories").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: accessoriesAdapter,
			displayMember: "name",
			valueMember: "id",
			checkboxes: true,
		});

	// part name combobox
	var partDataSource = {
		url : '<?php echo site_url("admin/spareparts/get_spareparts_combo_json"); ?>',
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
			if ($("#new_part_id").jqxComboBox('searchString') != undefined) {
				data.name_startsWith = $("#new_part_id").jqxComboBox('searchString');
				return data;
			}
		}
	}
	);

	$("#new_part_id").jqxComboBox({
		width: 195,
		height: 25,
		source: partAdapter,
		remoteAutoComplete: true,
		autoDropDownHeight: true, 
		selectedIndex: 0,
		displayMember: "part_name",
		valueMember: "sparepart_id",
		renderer: function (index, label, value) {
			var item = partAdapter.records[index];
			if (item != null) {
				var label = item.part_name + "(" + item.part_name + ", " + item.part_name + ")";
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

	var job_cardsDataSource =
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
		{ name: 'vehicle_id', type: 'number' },
		{ name: 'jobcard_group', type: 'number' },
		{ name: 'description', type: 'string' },
		{ name: 'before_image', type: 'string' },
		{ name: 'after_image', type: 'string' },
		{ name: 'material_required', type: 'number' },
		{ name: 'floor_supervisor_id', type: 'number' },
		{ name: 'mechanics_id', type: 'number' },
		{ name: 'cleaner_id', type: 'number' },
		{ name: 'gear_box_no', type: 'number' },
		{ name: 'service_type', type: 'number' },
		{ name: 'kms', type: 'number' },
		{ name: 'fuel', type: 'number' },
		{ name: 'party_id', type: 'number' },
		{ name: 'sell_dealer', type: 'string' },
		{ name: 'vehicle_name', type: 'string' },
		{ name: 'variant_name', type: 'string' },
		{ name: 'color_name', type: 'string' },
		{ name: 'engine_no', type: 'string' },
		{ name: 'chassis_no', type: 'string' },
		{ name: 'vehicle_register_no', type: 'string' },
		{ name: 'closed_status', type: 'string' },
		{ name: 'vehicle_no', type: 'string' },

		],
		url: '<?php echo site_url("admin/job_cards/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
					//callback called when a page or page size is changed.
				},
				beforeprocessing: function (data) {
					job_cardsDataSource.totalrecords = data.total;
				},
			// update the grid and send a request to the server.
			filter: function () {
				$("#jqxGridJob_card").jqxGrid('updatebounddata', 'filter');
			},
			// update the grid and send a request to the server.
			sort: function () {
				$("#jqxGridJob_card").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGridJob_card").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: job_cardsDataSource,
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
				container.append($('#jqxGridJob_cardToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'Action', datafield: 'action', width:140, sortable:false,filterable:false, pinned:true, align: 'left' , cellsalign: 'left', cellclassname: 'grid-column-left', 
			cellsrenderer: function (index,b,c,d,e,rows) {
				var p = ' | ';
				var edit = '<a href="javascript:void(0)" onclick="editJob_cardRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>'+p;
					// v = '<a href="javascript:void(0)" onclick="viewJob_cardRecord(' + index + '); return false;" title="View Detail"><i class="fa fa-eye"></i></a>';
					var m = ' <a href="javascript:void(0)" onclick="material_issue(' + index + '); return false;" title="Material Issue"><i class="fa fa-cogs"></i></a>' +p;
					var e = ' <a href="javascript:void(0)" onclick="estimateJob_cardRecord(' + index + '); return false;" title="Estimate"><i class="fa fa-file"></i></a>' +p;
					var a = ' <a href="javascript:void(0)" onclick="assign(' + index + '); return false;" title="<?php echo lang('assign')?>"><i class="fa fa-user-plus"></i></a>' +p;
					var i = ' <a href="javascript:void(0)" onclick="bill_invoice(' + index + '); return false;" title="<?php echo lang('invoice')?>"><i class="fa fa-money"></i></a>' +p;
					var o = ' <a href="javascript:void(0)" onclick="outside_work(' + index + '); return false;" title="<?php echo lang('outside_work')?>"><i class="fa fa-external-link"></i></a>' +p;
					var l = ' <a href="javascript:void(0)" onclick="detail(' + index + '); return false;" title="<?php echo lang('detail')?>"><i class="fa fa-list-alt"></i></a>' +p;

					if(rows.closed_status == 1){
						//function definition for jobclose and open in partial_jobcard_close.php
						var r = '<a href="javascript:void(0)" onclick="reopen_job_form(' + index + '); return false;" title="<?php echo lang('reopen_job')?>"><i class="fa fa-folder-open"></i></a>' +p;
					}
					else {
						var r = '<a href="javascript:void(0)" onclick="close_job(' + index + '); return false;" title="<?php echo lang('close_job')?>"><i class="fa fa-times"></i></a>' +p;
						i = '';
					}
					
					<?php if(!is_floor_supervisor()){?>

						return '<div style="text-align: left; margin-top: 8px;">' +edit + m + a + o + r + i +'</div>';

						<?php }else{?>
							return '<div style="text-align: left; margin-top: 8px;">' +edit + m+ l  + a  + o  + r +'</div>';
							<?php }?>
						}
					},
					{ text: '<?php echo lang("jobcard_group"); ?>',datafield: 'jobcard_group',width: 150,filterable: true,renderer: gridColumnsRenderer },
					{ text: '<?php echo lang("vehicle_register_no"); ?>',datafield: 'vehicle_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
					{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
					{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
					{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
					<?php if(!is_floor_supervisor()){?>
						{ text: '<?php echo lang("close_job"); ?>',datafield: 'closed_status', columntype:'checkbox', width: 150,filterable: true,renderer: gridColumnsRenderer, filterable: false },
						<?php }?>
						// { text: '<?php echo lang("floor_supervisor_id"); ?>',datafield: 'floor_supervisor_id',width: 150,filterable: true,renderer: gridColumnsRenderer },

						],
						rendergridrows: function (result) {
							return result.data;
						}
					});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridJob_card").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridJob_cardFilterClear', function () { 
	$('#jqxGridJob_card').jqxGrid('clearfilters');
});


$(document).on('click','#jqxGridJob_cardInsert', function () { 
	Job_form_table.jqxGrid('clear');
	// $('#warranty_claim_list').jqxGrid('updatebounddata');
	$.post('<?php echo site_url('job_cards/get_jobcard_number'); ?>', function(id){
		$('#jobcard_group').val(id);
		$('#jobcard_group').focus();
	});
	openPopupWindow('jqxPopupWindowJob_card', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowJob_card").jqxWindow({ 
		theme: theme,
		width: '75%',
		maxWidth: '75%',
		height: '75%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowJob").jqxWindow({ 
		theme: 'dark',
		width: '50%',
		maxWidth: '50%',
		height: '50%',  
		maxHeight: '50%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});
	$("#jqxPopupWindow_AddOutsideWork").jqxWindow({ 
		theme: 'dark',
		width: '70%',
		maxWidth: '80%',
		height: '60%',  
		maxHeight: '80%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

		//initialize part popup
		$("#jqxPopupWindowPart").jqxWindow({ 
			theme: 'dark',
			width: '50%',
			maxWidth: '50%',
			height: '50%',  
			maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});  

		// initialize Assign popup
		$("#jqxPopupWindowAssign").jqxWindow({ 
			theme: theme,
			width: '50%',
			maxWidth: '75%',
			height: '40%',  
			maxHeight: '75%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		}); 

		// initialize Bill popup
		$("#jqxPopupWindowBill").jqxWindow({ 
			theme: theme,
			width: '95%',
			maxWidth: '95%',
			height: '90%',  
			maxHeight: '90%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});  

		// initialize Outside Works popup
		$("#jqxPopupWindowOutsideWork").jqxWindow({ 
			theme: theme,
			width: '85%',
			maxWidth: '90%',
			height: '85%',  
			maxHeight: '90%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		// initialize detail popup
		$("#jqxPopupWindowDetail").jqxWindow({ 
			theme: theme,
			width: '75%',
			maxWidth: '75%',
			height: '75%',  
			maxHeight: '75%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});	

		$("#jqxPopupWindowJob_card").on('close', function () {
			reset_form_job_cards();
		});

		$("#jqxJob_cardCancelButton").on('click', function () {
			reset_form_job_cards();
			$('#jqxPopupWindowJob_card').jqxWindow('close');
		});

		$('#form-job_cards').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: 
			[
			{ input: '#engine_no', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#engine_no').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#engine_no', message: 'Engine number should be of 17 letters', action: 'blur', 
			rule: function(input) {
				val = $('#engine_no').val();
				return(val.length == 11)?true:false;
			} },			
			{ input: '#chassis_no', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#chassis_no').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#chassis_no', message: 'Chassis number should be of 11 letters', action: 'blur', 
			rule: function(input) {
				val = $('#chassis_no').val();
				return(val.length == 17)?true:false;
			} },
			{ input: "#kms", message: 'Required', action: 'blur',
			rule: function(input) {
				val = $('#kms').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: "#service_type", message: 'Required', action: 'blur',
			rule: function(input) {
				val = $('#service_type').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: "#party_name", message: 'Required', action: 'blur',
			rule: function(input) {
				val = $('#party_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			]
		});


		$("#jqxJob_cardSubmitButton").on('click', function () {
			// saveJob_cardRecord();

			var validationResult = function (isValid) {
				if (isValid) {
					saveJob_cardRecord();
				}
			};
			$('#form-job_cards').jqxValidator('validate', validationResult);

		});

		// for form table
		var data = {};

		var source =
		{
			localdata: data,
			datatype: "local",
			datafields:
			[
			{ name: 'customer_voice', type: 'string' },
			{ name: 'job_id', type: 'number' },
			{ name: 'job', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'status', type: 'string' },
			],
			addrow: function (rowid, rowdata, position, commit) {
						//     // synchronize with the server - send insert command
						//     // call commit with parameter true if the synchronization with the server is successful 
						//     //and with parameter false if the synchronization failed.
						//     // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
						commit(true);
					},
				};
				var dataAdapter = new $.jqx.dataAdapter(source);
		// initialize jqxGrid
		Job_form_table = $("#jqxgrid").jqxGrid(
		{
			width: '100%',
			height: '60%',
			source: dataAdapter,
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				var me = this;
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append('<input id="addrowbutton" type="button" value="Add Job" />');
				container.append('<span class="pull-right">*For free service, Oil and filters are added by default*<span>');
				$("#addrowbutton").jqxButton();
						 // create new row.
						 $("#addrowbutton").on('click', function () {
								// var datarow = generaterow();
								// var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);
								var vehicle_id = $('#vehicle_name').val();
								var variant_id = $('#variant_name').val();
								if(vehicle_id && variant_id){
									openPopupWindow('jqxPopupWindowJob', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
								} else {
									alert("Please select a vehicle.");
									$('#vehicle_name').focus();
								}
							});
						},
						columns: [
						{ text: '<?php echo lang("customer_voice")?>', datafield: 'customer_voice', width: '10%' },
						{ text: 'Job ID', datafield: 'job_id', width: '10%' },
						{ text: 'Job', datafield: 'job', width: '20%' },
						{ text: 'Description', datafield: 'description', width: '30%' },
						{ text: 'Price', datafield: 'price', width: '10%', cellsalign: 'right' },
						{ text: 'Starus', datafield: 'status', width: '10%' },
						{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
							return "Delete row";
						}, buttonclick: function (row) {
							 // open the popup window when the user clicks a button.
							 id = $("#jqxgrid").jqxGrid('getrowid', row);
							 var offset = $("#jqxgrid").offset();
							 $("#popupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
							 // show the popup window.
							 $("#popupWindow").jqxWindow('show');
							}
						},
						]
					});  
		// initialize the popup window and buttons.
		$("#popupWindow").jqxWindow({ width: 250, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.05 });
		$("#del").jqxButton({ theme: theme });
		$("#cancel").jqxButton({ theme: theme });
		$("#del").click(function () {
			$('#jqxgrid').jqxGrid('deleterow', id);
			$("#popupWindow").jqxWindow('hide');
		});
		$("#cancel").click(function () {
			$("#popupWindow").jqxWindow('hide');
		});

		/************** for part grid *******************/

		var data = {};

		var materialSource =
		{
			localdata: data,
			datatype: "local",
			datafields:
			[
			{ name: 'id', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'total', type: 'number' },
			],
			addrow: function (rowid, rowdata, position, commit) {
						//     // synchronize with the server - send insert command
						//     // call commit with parameter true if the synchronization with the server is successful 
						//     //and with parameter false if the synchronization failed.
						//     // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
						commit(true);
					},
				};
				var dataAdapter = new $.jqx.dataAdapter(materialSource);
		// initialize jqxGrid
		Part_form_table = $("#materialJqxgrid").jqxGrid(
		{
			width: '100%',
			height: '100%',
			source: dataAdapter,
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				var me = this;
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append('<input id="partsaddrowbutton" type="button" value="Add Parts" />');
				container.append('<span class="pull-right">*For free service, Oil and filters are added by default*<span>');
				$("#partsaddrowbutton").jqxButton();
						 // create new row.
						 $("#partsaddrowbutton").on('click', function () {
								// var datarow = generaterow();
								// var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);
								openPopupWindow('jqxPopupWindowPart', '<?php echo lang("general_add")  . "&nbsp;" .  lang("part"); ?>');
							});
						},
						columns: [
						{ text: '<?php echo lang("part_id")?>', datafield: 'id', width: '10%' },
						{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', width: '30%' },
						{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '10%' },
						{ text: '<?php echo lang("price")?>', datafield: 'price', width: '10%', cellsalign: 'right' },
						{ text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%' },
						{ text: '<?php echo lang("total")?>', datafield: 'total', width: '20%' },
						{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
							return "Delete row";
						}, buttonclick: function (row) {
							 // open the popup window when the user clicks a button.
							 id = $("#materialJqxgrid").jqxGrid('getrowid', row);
							 var offset = $("#materialJqxgrid").offset();
							 $("#partpopupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
							 // show the popup window.
							 $("#partpopupWindow").jqxWindow('show');
							}
						},
						]
					});  
		// initialize the popup window and buttons.
		$("#partpopupWindow").jqxWindow({ width: 250, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.05 });
		$("#partdel").jqxButton({ theme: theme });
		$("#partcancel").jqxButton({ theme: theme });
		/*$("#partdel").click(function () {
			$('#jqGrid_partial_material_issue').jqxGrid('deleterow', id);
			$("#partpopupWindow").jqxWindow('hide');
		});*/
		$("#partcancel").click(function () {
			$("#partpopupWindow").jqxWindow('hide');
		});
		/* material grid ends */


		// initialize the estimate popup window and buttons.
		$("#jqxPopupWindowEstimate").jqxWindow({ 
			width: '90%', 
			height: '80%', 
			maxWidth: '90%', 
			maxHeight: '80%', 
			resizable: false, 
			theme: theme, 
			isModal: true, 
			autoOpen: false, 
			cancelButton: $("#Cancel"), 
			modalOpacity: 0.8 });
		$("#estimatecancel").click(function () {
			$("#jqxPopupWindowEstimate").jqxWindow('hide');
		});

		/********************************************* counter sell ****************************************/

		// initialize popup window and buttons.
		$("#jqxPopupWindowCounter").jqxWindow({ 
			width: '90%', 
			height: '80%', 
			maxWidth: '90%', 
			maxHeight: '80%', 
			resizable: false, 
			theme: theme, 
			isModal: true, 
			autoOpen: false, 
			cancelButton: $("#Cancel"), 
			modalOpacity: 0.8 });

		// close popup
		$("#close_counter").click(function () {
			$("#jqxPopupWindowCounter").jqxWindow('hide');
		});

		// opent popup
		$(document).on('click','#counter_btn', function () { 
			$.post('<?php echo site_url("job_cards/counter")?>',function(data){
				$('#counter_sales').html(data);
				openPopupWindow('jqxPopupWindowCounter', '<?php echo lang("general_add")  . "&nbsp;" . 'Counter Sales'; ?>');
			});
		});

		/******************************************** end counter sell **************************************/

	});

function editJob_cardRecord(index){
	$('#jqxgrid').jqxGrid('updatebounddata');
	$('#materialJqxgrid').jqxGrid('updatebounddata');
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	if (row) {
		// console.log(row);
		$.post('<?php echo site_url("admin/job_cards/get_jobCard_details"); ?>',{ jobcard_group: row.jobcard_group, vehicle_no: row.vehicle_no}, function(result){
			var details = result.jobs[0];

			$('#jobcard_group').val(row.jobcard_group);
			$('#vehicle_register_no').val(details['vehicle_no']);
			$('#job_cards-issue_date').val(details['jobcard_issue_date']);
			$('#engine_no').val(details['engine_no']);
			$('#chassis_no').val(details['chassis_no']);
			/*GearBox here*/
			$('#vehicle_name').val(details['vehicle_id']);
			$('#variant_name').val(details['variant_id']);
			$('#color_name').val(details['color_id']);

			$('#service_type').jqxComboBox('val',details.service_type);
			$('#service_no').val(result.number_of_service );

			$('#key_no').val(details.key_no);
			$('#kms').val(details.kms);
			$('#fuel').val(details.fuel);
			$('#gear_box_no').val(details.gear_box_no);

			$('#floor_supervisor_id').val(details.floor_supervisor_id);
			$('#mechanics_id').val(details.mechanics_id);
			$('#cleaner_id').val(details.cleaner_id);
			$('#mechanic_list').val(details.mechanic_list);

			$('#coupon').val(details.coupon);
			$('#sell_dealer').val(details.sell_dealer);

			
			$('#party_name').val(details['party_id']);
			$('#vehicle_sold_on').val(details.vehicle_sold_on);

			$.each(result.jobs, function(i,v){
				var datarow = {
					'customer_voice': v.customer_voice,
					'job_id'		: v.job_id,
					'job'			: v.job,
					'description'	: v.job_description,
					'price'			: v.final_amount,
					'status'		: v.status,
					'id'			: v.id
				};
				Job_form_table.jqxGrid('addrow', null, datarow);

			});

		}, 'JSON');

		openPopupWindow('jqxPopupWindowJob_card', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveJob_cardRecord(){
	// var data = $("#form-job_cards").serialize();
	var data = getFormData("form-job_cards");

	var partData = $('#materialJqxgrid').jqxGrid('getrows');
	var jobData = $('#jqxgrid').jqxGrid('getrows');

	/*$('#jqxPopupWindowJob_card').block({ 
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
		url: '<?php echo site_url("admin/job_cards/save"); ?>',
		data: {	
			data: data,
			jobData,
			partData
		},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_job_cards();
				$('#jqxGridJob_card').jqxGrid('updatebounddata');
				$('#jqxPopupWindowJob_card').jqxWindow('close');

				var print = $('#print_preview').prop("checked");
				if(print == true) {
					printPreview('JobCard',result.jobno);
				}

			}
			$('#jqxPopupWindowJob_card').unblock();
		}
	});
}

function reset_form_job_cards(){
	$('#job_cards_id').val('');
	$('#form-job_cards')[0].reset();
	$('#service_type').jqxComboBox('clearSelection'); 
	$('#mechanics_id').jqxComboBox('clearSelection'); 
	$('#vehicle_name').jqxComboBox('clearSelection'); 
	$('#variant_name').jqxComboBox('clearSelection'); 
	$('#color_name').jqxComboBox('clearSelection'); 
	$('#party_name').jqxComboBox('clearSelection'); 

	$('#job_cards-issue_date').val(null);

}

/*function get_vehicle_detail(field){
	var value = $('#'+field).val();
	if(value ){

		if(field == 'vehicle_register_no'){
			field = 'id';
		}

		// $('#party_name').val('');
		// $('#party_id').val('');

		$.post("<?php echo site_url('job_cards/vehicle_detail')?>", {field:field, value:value}, function(row){
			$('#chassis_no').val(row[0]['chass_no']);
			$('#engine_no').val(row[0]['engine_no']);
			$('#vehicle_name').val(row[0]['vehicle_name']);
			$('#variant_name').val(row[0]['variant_name']);
			$('#color_name').val(row[0]['color_name']);
			$('#sell_dealer').val(row['dealer'][0]['dealer_name']);
			// $('#party_name').val(row['customer']['full_name']);
			// $('#party_id').val(row['customer']['customer_id']);
			$('#service_no').val(row['number_of_service'] + 1);

		},'json');
	}
}*/

function get_job_detail(){
	var id = $('#new_job_id').val();
	var vehicle_id = $('#vehicle_name').val();
	var variant_id = $('#variant_name').val();

	$('#new_job_description').text('');
	$('#new_job_price').val('');
	$('#new_job_name').val('');

	if(id){
		$.post("<?php echo site_url('service_jobs/get_jobs')?>",{id:id, vehicle_id:vehicle_id, variant_id: variant_id},function(result){
			if(result != false){
				$('#new_job_description').text(result.description);
				$('#new_job_price').val(result.price);
				$('#new_job_name').val(result.job_code);
			}
		},'json');
	}
}

$('#job_to_table').click(function(){
	var customer_voice = $('#customer_voice').val();
	var job_id = $('#new_job_id').val();
	var job_name = $('#new_job_name').val();
	var description = $('#new_job_description').text();
	var price = $('#new_job_price').val();
	// console.log(customer_voice);
	if(job_id != null && job_name != null && description != 0 && price != null){
		if(price == ''){
			alert('Price is required');
		}else{
			var datarow = {
				'customer_voice'  : customer_voice,
				'job_id'		  : job_id,
				'job'			  : job_name,
				'description'	  : description,
				'price'			  : price,
				'status'		  : 'INCOMPLETE'
			};

			Job_form_table.jqxGrid('addrow', null, datarow);
			$('#jqxPopupWindowJob').jqxGrid('addrow', null, datarow);
			
			// $('#jqxPopupWindowJob').jqxWindow('close');
		 //    $('#jqxPopupWindowJob').unblock();
		}
	}else{
		alert('Please enter all fields');
	}
});

$('#close_add_job').click(function(){
	$('#jqxPopupWindowJob').jqxWindow('close');
	$('#jqxPopupWindowJob').unblock();
});

$('#close_add_part').click(function(){
	$('#jqxPopupWindowPart').jqxWindow('close');
	$('#jqxPopupWindowPart').unblock();
});

$('#close_assign').click(function(){
	$('#jqxPopupWindowAssign').jqxWindow('close');
	$('#jqxPopupWindowAssign').unblock();
});

$('#close_bill').click(function(){
	$('#jqxPopupWindowBill').jqxWindow('close');
	$('#jqxPopupWindowBill').unblock();
});

function get_part_detail(){
	var part_detail = $('#new_part_id').jqxComboBox('getSelectedItem')['originalItem']; 
	$('#new_part_code').html(part_detail.part_code);
	$('#new_part_price').jqxNumberInput('val',part_detail.price);
	$('#new_part_name').val(part_detail.name);
	$('#new_min_price').val(part_detail.price);
	$('#new_part_stock_quantity').val(part_detail.quantity);
	return;

	/*var id = $('#new_part_id').val();

	$('#new_part_code').html('');
	$('#new_part_price').jqxNumberInput('val',0);
	$('#new_part_name').val('');
	$('#new_min_price').val(0);
	$('#new_part_total').jqxNumberInput('val',0);
	$('#new_part_quantity').jqxNumberInput('val',0);
	console.log(id);
	$.post("<?php echo site_url('spareparts/getDetail')?>", {id:id}, function(data){
		if(data.success){
			$('#new_part_code').html(data.part_code);
			$('#new_part_price').jqxNumberInput('val',data.price);
			$('#new_part_name').val(data.name);
			$('#new_min_price').val(data.price);
		}
	},'json');*/
}

// calculate total
$('#new_part_quantity, #new_part_price').on('change',function(){
	price 		= $('#new_part_price').val();
	quantity 	= $('#new_part_quantity').val();
	min_price 	= $('#new_min_price').val();
	var stock_quantity = $('#new_part_stock_quantity').val();

	if(price >= min_price && min_price != ''){
		total_price = price * quantity
		$('#new_part_total').val(total_price);
	}else{
		alert('Minimum price is ' + min_price);
		$('#new_part_price').jqxNumberInput('val',min_price);
	}

	if(quantity > stock_quantity) {
		$('#new_part_quantity').val(0);
		alert("Quantity out of stock");
	}

});

// part to table
$('#part_to_table').click(function(){
	var part_id = $('#new_part_id').val();
	var part_name = $('#new_part_name').val();
	var part_price = $('#new_part_price').val();
	var part_quantity = $('#new_part_quantity').val();
	var part_total = $('#new_part_total').val();
	var part_code = $('#new_part_code').html();
	if(new_part_id != null && new_part_name != null){
		if(part_quantity == 0 || part_total == 0){
			alert('Quantity is required');
		}else{
			var datarow = {
				'id'			:part_id,
				'part_name'		:part_name,
				'part_code'		:part_code,
				'price'			:part_price,
				'quantity'		:part_quantity,
				'total'			:part_total,
			};
			// console.log(datarow);

			Part_form_table.jqxGrid('addrow', null, datarow);
			$('#jqxPopupWindowPart').jqxGrid('addrow', null, datarow);
			
			// $('#jqxPopupWindowPart').jqxWindow('close');
		 //    $('#jqxPopupWindowPart').unblock();
		}
	}else{
		alert('Please enter all fields');
	}
});

// for estimate 
function estimateJob_cardRecord(index){
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	if (row) {       
		$.post('<?php echo site_url("job_cards/estimate_form/")?>',{jobcard_group: row.jobcard_group, vehicle_id: row.vehicle_id},function (data){
			$('#form-estimate').html(data);
			openPopupWindow('jqxPopupWindowEstimate', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');

		},'html').done(function(){

		});
	}
}

// for saving estimate
$('#save_estimate').click(function(){
	var estimate_part_datas = JSON.stringify($('#jqxGridPart').jqxGrid('getrows'));
	var estimate_job_datas = JSON.stringify($('#jqxGridEstimate').jqxGrid('getrows'));
	var data = $('#total').serialize() + '&jobs=' + estimate_job_datas + '&parts=' + estimate_part_datas;

	$.ajax({
		type:       "POST",
		url:        "<?php echo site_url('admin/job_cards/save_estimate')?>",
		data:       data,
		success:    function(){
			$('#jqxPopupWindowEstimate').jqxWindow('close');
			$('#jqxPopupWindowEstimate').unblock();

		},
	});

});

// assign user to job
function assign(index) {

	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	$("#jobcard_group_id").val(row.jobcard_group);

	$('#assign_window_poptup_title').html('<?php echo lang("assign"); ?>');
	openPopupWindow('jqxPopupWindowAssign');
}

// generate bill
function bill_invoice(index) {
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	// console.log(row);
	$.post("<?php echo site_url('job_cards/billing')?>", {
		jobcard_group: row.jobcard_group, 
		vehicle_id: row.vehicle_id, 
		vehicle_no: row.vehicle_register_no
	},function(result){
		$('#bill').html(result);
		$('#bill_window_poptup_title').html('<?php echo lang("bill"); ?>');
		openPopupWindow('jqxPopupWindowBill');
		
	},'html');
}

// jobcard detail to list jobs
function detail(index) {
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	var jobcard_group = row.jobcard_group;
	var vehicle_id = row.vehicle_id;

	$.post("<?php echo site_url('job_cards/job_card_detail')?>", {jobcard_group:jobcard_group, vehicle_id: vehicle_id},function(data){
		$('#detail_list').html(data);
		$('#detail_window_poptup_title').html('<?php echo lang("detail"); ?>');
		openPopupWindow('jqxPopupWindowDetail');
	},'html');
}

function material_issue( index ) {
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	/*
	closed_status : 1
	color_name : "SUNSHINE RAY"
	jobcard_group : 5
	uid : 0
	variant_name : "LX"
	vehicle_id : 1
	vehicle_name : "ALTO 800"
	vehicle_no : "BA4JA5678"
	*/
	if(row) {
		$('.job-status').val(row.jobcard_group);

		$("#jqGrid_partial_material_issue").jqxGrid('updatebounddata');
		$.post('<?php echo site_url('admin/job_cards/get_material_issue'); ?>',{jobcard_group: row.jobcard_group},function(result){
			console.log(result);
			var narration;
			var details = result.parts[0]; 
			$.each(result.parts,function(i,v){
				var datarow = {
					'id'			: v.id,
					'part_id'		: v.part_id,
					'part_name'		: v.part_name,
					'part_code'		: v.part_code,
					'price'			: v.price,
					'quantity'		: v.quantity,
					'total'			: v.final_price,
					'issue_date'	: v.issue_date,
					'warranty'		: v.warranty,
				};
				narration = v.narration;

				$("#jqGrid_partial_material_issue").jqxGrid('addrow', null, datarow);
			});
			$('#material_issue-narration').val(narration);
			$('#material_issue-jobcard_group').val(row.jobcard_group);
			$('#material_issue-vehicle_no').val(row.vehicle_no);
			$('#material_issue-chassis_no').val(details.chassis_no);

			$('#material_issue-vehicle_name').val(row.vehicle_name);
			$('#material_issue-party_name').val(details.full_name);
			$('#material_issue-mechanic_id').val(details.mechanics_id);

		},'JSON');
	}

	openPopupWindow('jqxPopupWindowMaterial_issue', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');

}



//Outside Work
function outside_work(index) {
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	console.log(row);
	if(row.closed_status == 1) {
		$('#outside_work-save').hide();
	} else {
		$('#outside_work-save').show();
	}
	$("#add_outside_work-jobcard_group").val(row.jobcard_group);
	$("#add_outside_work-vehicle_no").val(row.vehicle_no);

	/*var outsideDataSource = {
		url : '<?php echo site_url("admin/job_cards/combobox_outsidework_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'job', type: 'string' },
		{ name: 'job_description', type: 'string' },
		],
		data: { jobcard_group: row.jobcard_group },
		async: false,
		cache: true
	}*/

	// outsideJobAdapter = new $.jqx.dataAdapter(outsideDataSource);

	$("#combo_job_id").jqxComboBox({
		theme: theme,
		width: '90%',
		// height: 34,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: jobAdapter,
		displayMember: "job_description",
		valueMember: "service_job_id",
		placeHolder: "Enter Job Code",
	});

	 //FOR Workshop ID
	 var WorkshopDataSource = {
	 	url : '<?php echo site_url("admin/job_cards/combobox_workshop_json"); ?>',
	 	datatype: 'json',
	 	datafields: [
	 	{ name: 'id', type: 'number' },
	 	{ name: 'name', type: 'string' },
	 	],
	 	async: false,
	 	cache: true
	 }

	 outsideJobAdapter = new $.jqx.dataAdapter(WorkshopDataSource);

	 $("#combo_workshop_id").jqxComboBox({
	 	theme: theme,
	 	width: '100%',
	 	height: 34,
	 	selectionMode: 'dropDownList',
	 	autoComplete: true,
	 	searchMode: 'containsignorecase',
	 	source: outsideJobAdapter,
	 	displayMember: "name",
	 	valueMember: "id",
	 });

	 $('#outsideWork_popup_title').html('<?php echo lang("outside_work"); ?>');
	 openPopupWindow('jqxPopupWindowOutsideWork');

	 $.post("<?php echo site_url('admin/job_cards/get_grouped_outsideWorks')?>", {jobcard_group: row.jobcard_group}, function(result){
	 	$('#send_date').val(result.rows['send_date']);
	 	$('#outside_work-splr_invoice_no').val(result.rows['splr_invoice_no']);
	 	$('#splr_invoice_date').val(result.rows['splr_invoice_date']);
	 	$('#combo_workshop_id').val(result.rows['workshop_id']);
	 	$('#outside_work-remarks').val(result.rows['remarks']);
	 	$('#outside_work-gross_total').val(result.rows['gross_total']);
	 	$('#outside_work-round_off').val(result.rows['round_off']);
	 	$('#outside_work-net_amount').val(result.rows['net_amount']);

	 }, 'JSON');

	 $.post("<?php echo site_url('admin/job_cards/get_grid_outsideWorks')?>", {jobcard_group: row.jobcard_group}, function(result){
	 	// console.log(result.rows);
	 	$('#jqxGridOutside_work').jqxGrid('clear');
	 	$.each(result.rows, function(i,v){

	 		var datarow = {
	 			'prefix'			: v.prefix,
	 			'jobcard_group'		: v.jobcard_group,
	 			'workshop_job_id'	: v.workshop_job_id,
	 			'description'		: v.description,
	 			'amount'			: v.amount,
	 			'taxes'				: v.taxes,
	 			'discount'			: v.discount,
	 			'total_amount'		: v.total_amount,
	 			'mechanics_id'		: v.mechanics_id,
	 			'mechanic_name'		: v.mechanic_name,
	 			'id'				: v.id
	 		};
	 		$("#jqxGridOutside_work").jqxGrid('addrow', null, datarow);

	 	});

	 },'JSON');


	}

	
	function printPreview(type, id = null)
	{
		switch(type){
			case 'JobCard':
			if (id == null) {
				id = $('#jobcard_group').val();
			}

			break;

			case 'Material Issue':
			if (id == null) {
				id = $('#material_issue-jobcard_group').val();
			}
			break;

			case 'Estimate':
			if (id == null) {
				id = $('#partial-estimate_doc').val();
			}
			break;
			
			case 'Outside Work':
			if(id == null) {
				id = $('#add_outside_work-jobcard_group').val();
			}
			break;

			case 'Invoice':
			if(id == null) {
				id = $('#invoice_details input[name="job_no"]').val();
			}
			break;


		}
		var url = '<?php echo site_url('job_cards/print_preview?jobcard=') ?>' + id + '&type=' + type;


		myWindow = window.open(url, type, "height=900,width=1300");

		myWindow.document.close(); 

		myWindow.focus();
		myWindow.print();
	}




</script>