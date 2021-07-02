<style>
.cls-red { background-color: #F56969; }
}
</style>
<style type="text/css">
table.form-table td:nth-child(odd){
	width:13%;
}
table.form-table td:nth-child(even){
	width:20%;
}

@media only screen and (min-device-width: 1024px) {
	table.form-table{
		font-size: 95%;
	}
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('customers'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('customers'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCustomerToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCustomerInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomerFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCustomer"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCustomer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-customers', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "customers_id"/>
		<input type = "hidden" name='inquiry_no' id='inquiry_no' >
		<input type = "hidden" name='old_status_id' id='old_status_id' >
		<input type="hidden" name="inquiry_date_en" id="inquiry_date_en">
		<input type="hidden" name="inquiry_date_np" id="inquiry_date_np">
		<fieldset>
			<legend>Inquiry Information</legend>
			<table class="form-table">
				<tr>
					<td><label for='inquiry_no'><?php echo lang('inquiry_no')?></label></td>
					<td><span id="span_inquiry_no">Auto Generate</span></td>
						<?php /*
						<td><label for='status_id'><?php echo lang('status_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='status_id' name='status_id'></div></td>
						*/?>
						<td><label for='inquiry_kind'><?php echo lang('inquiry_kind')?><span class='mandatory'>*</span></label></td>
						<td><div id='inquiry_kind' name='inquiry_kind'></div></td>
						<td><label for='institution_id'><?php echo lang('institution_id')?></label></td>
						<td><div id='institution_id' name='institution_id'></div></td>
					</tr>
					<tr>
						<td class="dealer-selection"><label for='dealer_id'><?php echo lang('dealer_id')?><span class='mandatory'>*</span></label></td>
						<td class="dealer-selection"><div id='dealer_id' name='dealer_id'></div></td>
						<td class="executive-selection"><label for='executive_id'><?php echo lang('executive_id')?><span class='mandatory'>*</span></label></td>
						<td class="executive-selection"><div id='executive_id' name='executive_id'></div></td>
					</tr>
					<tr>	
						<td><label for='payment_mode_id'><?php echo lang('payment_mode_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='payment_mode_id' name='payment_mode_id'></div></td>
						<td><label for='source_id'><?php echo lang('source_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='source_id' name='source_id'></div></td>
						<td id="source-detail"></td>
						<td id="source-detail-combo"></td>
					</tr>
					<tr>
						<td><label for='vehicle_id'><?php echo lang('vehicle_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='vehicle_id' name='vehicle_id'></div></td>
						<td><label for='variant_id'><?php echo lang('variant_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='variant_id' name='variant_id'></div></td>
						<td><label for='color_id'><?php echo lang('color_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='color_id' name='color_id'></div></td>
					</tr>
					<tr>
						<td><label for='customer_type_id'><?php echo lang('customer_type_id')?></label></td>
						<td><div id='customer_type_id' name='customer_type_id'></div></td>
					</tr> 
					<tr class="replacement">
						<td><label for='exchange_car_make'><?php echo lang('exchange_car_make')?><span class='mandatory'>*</span></label></td>
						<td><input id='exchange_car_make' class='text_input' name='exchange_car_make'></td>
						<td><label for='exchange_car_model'><?php echo lang('exchange_car_model')?><span class='mandatory'>*</span></label></td>
						<td><input id='exchange_car_model' class='text_input' name='exchange_car_model'></td>
						<td><label for='exchange_car_year'><?php echo lang('exchange_car_year')?><span class='mandatory'>*</span></label></td>
						<td><input id='exchange_car_year' class='text_input' name='exchange_car_year'></td>
					</tr>
					<tr class="replacement">
						<td><label for='exchange_car_kms'><?php echo lang('exchange_car_kms')?><span class='mandatory'>*</span></label></td>
						<td><div id='exchange_car_kms' class='number_general' name='exchange_car_kms'></div></td>
						<td><label for='exchange_car_value'><?php echo lang('exchange_car_value')?><span class='mandatory'>*</span></label></td>
						<td><div id='exchange_car_value' class='number_general' name='exchange_car_value'></div></td>
						<td><label for='exchange_car_bonus'><?php echo lang('exchange_car_bonus')?></label></td>
						<td><div id='exchange_car_bonus' class='number_general' name='exchange_car_bonus'></div></td>
					</tr>	
				</table>
			</fieldset>
			<fieldset>
				<legend>Customers Information</legend>
				<table class="form-table">
					
					<tr>
						<td><label for='first_name'><?php echo lang('first_name')?><span class='mandatory'>*</span></label></td>
						<td><input id='first_name' class='text_input' name='first_name'></td>
						<td><label for='middle_name'><?php echo lang('middle_name')?></label></td>
						<td><input id='middle_name' class='text_input' name='middle_name'></td>
						<td><label for='last_name'><?php echo lang('last_name')?><span class='mandatory'>*</span></label></td>
						<td><input id='last_name' class='text_input' name='last_name'></td>
					</tr>
					<tr>
						<td><label for='gender'><?php echo lang('gender')?></label></td>
						<td><div id='gender' name='gender'></div></td>
						<td><label for='marital_status'><?php echo lang('marital_status')?></label></td>
						<td><div id='marital_status' name='marital_status'></div></td>
						<td><label for='family_size'><?php echo lang('family_size')?></label></td>
						<td><div id='family_size' class='number_general' name='family_size'></div></td>
					</tr>
					<tr>
						<td>
							<label for='dob_en'><?php echo lang('dob_en')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer" data-arg4="dob_en" data-arg5="dob_np"> <?php echo lang('general_ad_to_bs')?></a>
						</td>
						<td><div id='dob_en' class='date_box' name='dob_en'></div></td>
						<td>
							<label for='dob_np'><?php echo lang('dob_np')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer" data-arg4="dob_np" data-arg5="dob_en"> <?php echo lang('general_bs_to_ad')?></a>
						</td>
						<td><input id='dob_np' class='text_input' name='dob_np'></td>
					</tr>
					<tr>
						<td>
							<label for='anniversary_en'><?php echo lang('anniversary_en')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer" data-arg4="anniversary_en" data-arg5="anniversary_np"> <?php echo lang('general_ad_to_bs')?></a>
						</td>
						<td><div id='anniversary_en' class='date_box' name='anniversary_en'></div></td>
						<td>
							<label for='anniversary_np'><?php echo lang('anniversary_np')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer" data-arg4="anniversary_np" data-arg5="anniversary_en"> <?php echo lang('general_bs_to_ad')?></a>
						</td>
						<td><input id='anniversary_np' class='text_input' name='anniversary_np'></td>
					</tr>
					<tr>
						<td><label for='occupation_id'><?php echo lang('occupation_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='occupation_id' name='occupation_id'></div></td>
						<td><label for='education_id'><?php echo lang('education_id')?></label></td>
						<td><div id='education_id' name='education_id'></div></td>
					</tr>
					<tr>
						<td><label for='remarks'><?php echo lang('remarks')?></label></td>
						<td colspan="5"><textarea id='remarks' class='text_area' name='remarks'></textarea></td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>Contact Information</legend>
				<table class="form-table">
					<tr>
						<td><label for='district_id'><?php echo lang('district_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='district_id' name='district_id'></div></td>
						<td><label for='mun_vdc_id'><?php echo lang('mun_vdc_id')?></label></td>
						<td><div id='mun_vdc_id' name='mun_vdc_id'></div></td>
					</tr>
					<tr>
						<td><label for='address_1'><?php echo lang('address_1')?><span class='mandatory'>*</span></label></td>
						<td><input id='address_1' class='text_input' name='address_1'></td>
						<td><label for='address_2'><?php echo lang('address_2')?></label></td>
						<td><input id='address_2' class='text_input' name='address_2'></td>
					</tr>
					<tr>
						<td><label for='home_1'><?php echo lang('home_1')?></label></td>
						<td><input id='home_1' class='text_input' name='home_1' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
						<td><label for='work_1'><?php echo lang('work_1')?></label></td>
						<td><input id='work_1' class='text_input' name='work_1' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
						<td><label for='mobile_1'><?php echo lang('mobile_1')?><span class='mandatory'>*</span></label></td>
						<td><input id='mobile_1' class='text_input' name='mobile_1' placeholder='<?php echo lang("general_mobile_number_format");?>'></td>
					</tr>
					<?php /* ?>
					<tr><td><label for='home_2'><?php echo lang('home_2')?></label></td>
						<td><input id='home_2' class='text_input' name='home_2' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
						<td><label for='work_2'><?php echo lang('work_2')?></label></td>
						<td><input id='work_2' class='text_input' name='work_2' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
						<td><label for='mobile_2'><?php echo lang('mobile_2')?></label></td>
						<td><input id='mobile_2' class='text_input' name='mobile_2' placeholder='<?php echo lang("general_mobile_number_format");?>'></td>
					</tr>
					<?php */ ?>
					<tr>
						<td><label for='email'><?php echo lang('email')?></label></td>
						<td><input id='email' class='text_input' name='email'></td>
						<td><label for='pref_communication'><?php echo lang('pref_communication')?></label></td>
						<td><div id='pref_communication' name='pref_communication'></div></td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>Other Informations</legend>
				<table class="form-table">
					
					<tr>
						<td><label for='contact_1_name'><?php echo lang('contact_1_name')?></label></td>
						<td><input id='contact_1_name' class='text_input' name='contact_1_name'></td>
						<td><label for='contact_1_mobile'><?php echo lang('contact_1_mobile')?></label></td>
						<td><input id='contact_1_mobile' class='text_input' name='contact_1_mobile'></td>
						<td><label for='contact_1_relation_id'><?php echo lang('contact_1_relation_id')?></label></td>
						<td><div id='contact_1_relation_id' name='contact_1_relation_id'></div></td>
					</tr>
					<tr>
						<td><label for='contact_2_name'><?php echo lang('contact_2_name')?></label></td>
						<td><input id='contact_2_name' class='text_input' name='contact_2_name'></td>
						<td><label for='contact_2_mobile'><?php echo lang('contact_2_mobile')?></label></td>
						<td><input id='contact_2_mobile' class='text_input' name='contact_2_mobile'></td>
						<td><label for='contact_2_relation_id'><?php echo lang('contact_2_relation_id')?></label></td>
						<td><div id='contact_2_relation_id' name='contact_2_relation_id'></div></td>
					</tr>
				</table>
			</fieldset>
			<table class="form-table">
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomerSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomerCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div id="jqxPopupWindowConfirm_booking">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Confirm Booking</span>
		</div>
		<div class="form_fields_area">
			<?php echo form_open('', array('id' => 'form-confirm_booking', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "customer_id" id = "customer_id"/>
			<table class="form-table">
				<tr>
					<th colspan="4" style="text-align: center !important;">
						<button type="button" class="btn btn-success btn-lg" id="jqxConfirm_bookingSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-lg" id="jqxConfirm_bookingCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div id="jqxPopupWindowBooking_cancel">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title'>Booking Cancel Details</span>
		</div>
		<div class="form_fields_area">
			<div><strong>Booking Cancel Details</strong></div>
			<table class="form-table">
				<tr>
					<td><?php echo lang('full_name')?> : </td>
					<td><div id="customer_name"></div></td>
				</tr>
				<tr>
					<td><?php echo lang('vehicle_name')?> : </td>
					<td><div id="vehicle_details"></div></td>
				</tr>
				<tr>
					<td><?php echo lang('cancel_amount')?> : </td>
					<td><div id="cancellation_amount"></div></td>
				</tr>
				<tr>
					<td><?php echo lang('reason_id')?> : </td>
					<td><div id="reason_notes"></div></td>
				</tr>
			</table>
		</div>
	</div>

	<script language="javascript" type="text/javascript">

		$(function()
		{

			var cellclassname =  function (row, column, value, data) {

				var d = data.is_edited;
				if(d == 1)
				{
					return 'cls-red';
				}
			};
			$('#dob_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
			$('#anniversary_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});

	//mst_customer_types
	$("#customer_type_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: array_customer_types,
		displayMember: "name",
		valueMember: "id",
	});

    //mst_relations
    $("#contact_1_relation_id, #contact_2_relation_id").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_relations,
    	displayMember: "name",
    	valueMember: "id",
    });

    //mst_payment_modes
    $("#payment_mode_id").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_payment_modes,
    	displayMember: "name",
    	valueMember: "id",
    });

    //gender
    $("#gender").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_gender,
    	displayMember: "name",
    	valueMember: "id",
    });

    //
    $("#marital_status").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_marital_status,
    	displayMember: "name",
    	valueMember: "id",
    });

    <?php /* ?>
    // $("#family_size").jqxComboBox({
    //     theme: theme,
    //     width: 195,
    //     height: 25,
    //     selectionMode: 'dropDownList',
    //     autoComplete: true,
    //     searchMode: 'containsignorecase',
    //     source: array_family_size,
    //     displayMember: "name",
    //     valueMember: "id",
    // });
    <?php */ ?>
    //mst_inquiry_statuses
    <?php /*
    $("#status_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: array_inquiry_statuses,
        displayMember: "name",
        valueMember: "id",
    });
    */?>

    //mst_inquiry_kinds
    $("#inquiry_kind").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_inquiry_kind,
    	displayMember: "name",
    	valueMember: "id",
    	selectedIndex:0
    });

	//mst_educations
	$("#education_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: array_educations,
		displayMember: "name",
		valueMember: "id",
	});

    //mst_sources
    $("#source_id").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_sources,
    	displayMember: "name",
    	valueMember: "id",
    });

    //mst_vehicles
    $("#vehicle_id").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_vehicles,
    	displayMember: "name",
    	valueMember: "id",
    });

    //mst_occupations
    $("#occupation_id").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: array_occupations,
    	displayMember: "name",
    	valueMember: "id",
    });

	// //mst_institutions
	$("#institution_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: array_institutions,
		displayMember: "name",
		valueMember: "id",
	});

	//pref_communication
	$("#pref_communication").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: array_prefered_communication,
		displayMember: "name",
		valueMember: "id",
		selectedIndex:0
	});

	//mst_districts
	$("#district_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: array_districts,
		displayMember: "name",
		valueMember: "id",
	});

	$(".replacement").hide();

	$('#dob_en, #anniversary_en').jqxDateTimeInput({ value: null});

	$('.convert-date').on('click', function(){
		var arg1 = this.getAttribute("data-arg1"),
		arg2 = this.getAttribute("data-arg2"),
		arg3 = this.getAttribute("data-arg3"),
		arg4 = this.getAttribute("data-arg4"),
		arg5 = this.getAttribute("data-arg5");

		window[arg1](arg2,arg3,arg4,arg5);
	});

	var customersDataSource =
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
		{ name: 'inquiry_no', type: 'string' },
		{ name: 'fiscal_year_id', type: 'number' },
		{ name: 'inquiry_date_en', type: 'date' },
		{ name: 'inquiry_date_np', type: 'string' },
		{ name: 'inquiry_kind', type: 'string' },
		{ name: 'customer_type_id', type: 'number' },
		{ name: 'first_name', type: 'string' },
		{ name: 'middle_name', type: 'string' },
		{ name: 'last_name', type: 'string' },
		{ name: 'gender', type: 'string' },
		{ name: 'marital_status', type: 'string' },
		{ name: 'family_size', type: 'string' },
		{ name: 'dob_en', type: 'date' },
		{ name: 'dob_np', type: 'string' },
		{ name: 'anniversary_en', type: 'date' },
		{ name: 'anniversary_np', type: 'string' },
		{ name: 'district_id', type: 'number' },
		{ name: 'mun_vdc_id', type: 'number' },
		{ name: 'address_1', type: 'string' },
		{ name: 'address_2', type: 'string' },
		{ name: 'email', type: 'string' },
		{ name: 'home_1', type: 'string' },
		{ name: 'home_2', type: 'string' },
		{ name: 'work_1', type: 'string' },
		{ name: 'work_2', type: 'string' },
		{ name: 'mobile_1', type: 'string' },
		{ name: 'mobile_2', type: 'string' },
		{ name: 'pref_communication', type: 'string' },
		{ name: 'occupation_id', type: 'number' },
		{ name: 'education_id', type: 'number' },
		{ name: 'dealer_id', type: 'number' },
		{ name: 'executive_id', type: 'number' },
		{ name: 'payment_mode_id', type: 'number' },
		{ name: 'source_id', type: 'number' },
		{ name: 'status_id', type: 'number' },
		{ name: 'contact_1_name', type: 'string' },
		{ name: 'contact_1_mobile', type: 'string' },
		{ name: 'contact_1_relation_id', type: 'number' },
		{ name: 'contact_2_name', type: 'string' },
		{ name: 'contact_2_mobile', type: 'string' },
		{ name: 'contact_2_relation_id', type: 'number' },
		{ name: 'remarks', type: 'string' },
		{ name: 'vehicle_id', type: 'number' },
		{ name: 'variant_id', type: 'number' },
		{ name: 'color_id', type: 'number' },
		{ name: 'walkin_source_id', type: 'number' },
		{ name: 'event_id', type: 'number' },
		{ name: 'institution_id', type: 'number' },
		{ name: 'exchange_car_make', type: 'string'},
		{ name: 'exchange_car_model', type: 'string'},
		{ name: 'exchange_car_year', type: 'string'},
		{ name: 'exchange_car_kms', type: 'number'},
		{ name: 'exchange_car_value', type: 'number'},
		{ name: 'exchange_car_bonus', type: 'number'},
		{ name: 'exchange_total_offer', type: 'number'},
		{ name: 'full_name', type: 'string'},
		{ name: 'fiscal_year', type: 'string'},
		{ name: 'customer_type', type: 'string'},
		{ name: 'district_name', type: 'string'},
		{ name: 'mun_vdc_name', type: 'string'},
		{ name: 'occupation_name', type: 'string'},
		{ name: 'education_name', type: 'string'},
		{ name: 'dealer_name', type: 'string'},
		{ name: 'executive_name', type: 'string'},
		{ name: 'payment_mode_name', type: 'string'},
		{ name: 'source_name', type: 'string'},
		{ name: 'status_name', type: 'string'},
		{ name: 'contact_1_relation_name', type: 'string'},
		{ name: 'contact_2_relation_name', type: 'string'},
		{ name: 'vehicle_name', type: 'string'},
		{ name: 'variant_name', type: 'string'},
		{ name: 'color_name', type: 'string'},
		{ name: 'walkin_source_name', type: 'string'},
		{ name: 'event_name', type: 'string'},
		{ name: 'institution_name', type: 'string'},
		{ name: 'is_booked', type: 'number'},
		{ name: 'booking_canceled', type: 'number'},
		{ name: 'booking_age', type: 'number'},
		{ name: 'actual_status_rank', type: 'number'},
		{ name: 'cancel_amount', type: 'number'},
		{ name: 'notes', type: 'string'},
		{ name: 'booking_receipt_no', type: 'string'},
		{ name: 'status_remarks', type: 'string'},
		{ name: 'inquiry_age', type: 'number'},
		{ name: 'inquiry_type', type: 'string'},
		{ name: 'sub_status_name', type: 'string'},
		{ name: 'status_date', type: 'date'},
		{ name: 'booked_date', type: 'date'},
		{ name: 'notes', type: 'string'},
		{ name: 'test_drive_status', type: 'string'},
		{ name: 'customer_type_name', type: 'string'},
		{ name: 'is_edited', type: 'number'},
		{ name: 'booking_cancel_reason', type: 'string'},
		],
		url: '<?php echo site_url("admin/customers/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	customersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCustomer").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCustomer").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCustomer").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: customersDataSource,
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
		selectionmode: 'multiplecellsadvanced',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridCustomerToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
				var rows = $("#jqxGridCustomer").jqxGrid('getrowdata', index);

				var e = '<a href="javascript:void(0)" onclick="editCustomerRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
				d = '<a href="<?php echo site_url("admin/customers/detail/'+columnproperties.id+'") ?>" title="Details" target="_blank"><i class="fa fa-th"></i></a>&nbsp;';

				if(rows.actual_status_rank >= 3 && rows.actual_status_rank <= 15)
				{
					f = '<a href="<?php echo site_url("admin/customers/vehicle_process/'+columnproperties.id+'") ?>" title="Confirm Booking" target="_blank"><i class="fa fa-bars" aria-hidden="true"></i></a>';
				}
				else 
				{
					f = '<i class="fa fa-book" aria-hidden="true"></i>';
				}		

				if(rows.actual_status_rank == 19)
				{
					f = '<a href="javascript:void(0)" onclick="ShowCancelDetails(' + index + '); return false;" title="Cancel Details"><i class="fa fa-times" aria-hidden="true"></i>';
				}
				return '<div style="text-align: center; margin-top: 8px;">' + e + d + f +'</div>';
			}
		},
		{ text: '<?php echo lang("inquiry_no"); ?>',datafield: 'inquiry_no',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("inquiry_age"); ?>',datafield: 'inquiry_age',width: 90,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("booking_age"); ?>',datafield: 'booking_age',width: 90,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("inquiry_date_en"); ?>',datafield: 'inquiry_date_en',width: 120,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("booked_date"); ?>',datafield: 'booked_date',width: 120,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("inquiry_kind"); ?>',datafield: 'inquiry_kind',width: 90,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("status_id"); ?>',datafield: 'status_name',width: 100,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("sub_status_name"); ?>',datafield: 'sub_status_name',width: 125,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("status_date"); ?>',datafield: 'status_date',width: 120,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("source_name"); ?>',datafield: 'source_name',width: 110,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("receipt_no"); ?>',datafield: 'booking_receipt_no',width: 110,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("full_name"); ?>',datafield: 'full_name',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("executive_id"); ?>',datafield: 'executive_name',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 110,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 110,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("color_id"); ?>',datafield: 'color_name',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("home_1"); ?>',datafield: 'home_1',width: 100,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("mobile_1"); ?>',datafield: 'mobile_1',width: 100,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pref_communication"); ?>',datafield: 'pref_communication',width: 90,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("customer_type_name"); ?>',datafield: 'customer_type_name',width: 170,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("test_drive"); ?>',datafield: 'test_drive_status',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("status_remarks"); ?>',datafield: 'status_remarks',width: 120,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("notes"); ?>',datafield: 'booking_cancel_reason',width: 150,filterable: true,cellclassname:cellclassname,renderer: gridColumnsRenderer },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridCustomer").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridCustomerFilterClear', function () { 
	$('#jqxGridCustomer').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridCustomerInsert', function () { 
	$('#span_inquiry_no').html('Auto Generate');
	<?php if( !control('Dealer Selection', FALSE)):?>
	$('.dealer-selection').hide();
	$('#dealer_id').jqxComboBox('val','<?php echo $this->session->userdata("employee")["dealer_id"]; ?>');
	<?php endif;?>
	<?php if( !control('Executive Selection', FALSE)):?>
	$('.executive-selection').hide();
	$('#executive_id').jqxComboBox('val','<?php echo $this->session->userdata("employee")["employee_id"]; ?>');
	<?php endif;?>
	openPopupWindow('jqxPopupWindowCustomer', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});	


// initialize the popup window
$("#jqxPopupWindowBooking_cancel").jqxWindow({
	theme: theme,
	width: '40%',
	maxWidth: '40%',
	height: '40%',
	maxHeight: '40%',
	isModal: true,
	autoOpen: false,
	modalOpacity: 0.7,
	showCollapseButton: false
});

$("#jqxPopupWindowConfirm_booking").jqxWindow({
	theme: theme,
	width: 300,
	maxWidth: 300,
	height: 100,
	maxHeight: 100,
	isModal: true,
	autoOpen: false,
	modalOpacity: 0.7,
	showCollapseButton: false
});

$("#jqxPopupWindowConfirm_booking").on('close', function () {
});

$("#jqxConfirm_bookingCancelButton").on('click', function () {
	$('#jqxPopupWindowConfirm_booking').jqxWindow('close');
});
$("#jqxConfirm_bookingSubmitButton").on('click', function () {
	saveConfirm_booking();
});
$("#jqxPopupWindowCustomer").jqxWindow({ 
	theme: theme,
	width: 1024,
	maxWidth: 1024,
	height: 600,  
	maxHeight: 600,  
	isModal: true, 
	autoOpen: false,
	modalOpacity: 0.7,
	showCollapseButton: false 
});

$("#jqxPopupWindowCustomer").on('close', function () {
	reset_form_customers();
});

$("#jqxCustomerCancelButton").on('click', function () {
	reset_form_customers();
	$('#jqxPopupWindowCustomer').jqxWindow('close');
});

$('#form-customers').jqxValidator({
	hintType: 'label',
	animationDuration: 500,
	rules: [
	{ input: '#first_name', message: 'Required', action: 'blur', 
	rule: function(input) {
		val = $('#first_name').val();
		return (val == '' || val == null || val == 0) ? false: true;
	}
},

{ input: '#last_name', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#last_name').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#address_1', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#address_1').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#district_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#district_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

/*{ input: '#inquiry_date_en', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#inquiry_date_en').jqxDateTimeInput('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#inquiry_date_np', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#inquiry_date_np').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#inquiry_date_np', message: 'Invalid Format', action: 'blur', 
rule: function(input) {
	val = $('#inquiry_date_np').val();
	return (val.match(date_pattern)) ? true : false;
}
},*/

/*{ input: '#dealer_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#dealer_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#executive_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#executive_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},*/

{ input: '#vehicle_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#vehicle_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},


{ input: '#variant_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#variant_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#color_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#color_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#source_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#source_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#home_1', message: 'Invalid Format.', action: 'blur', 
rule: function(input) {
	val = $('#home_1').val();
	return (val.match(phone_pattern)) ? true : false;
}
},

{ input: '#work_1', message: 'Invalid Format.', action: 'blur', 
rule: function(input) {
	val = $('#work_1').val();
	return (val.match(phone_pattern)) ? true : false;
}
},

{ input: '#mobile_1', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#mobile_1').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#payment_mode_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#payment_mode_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#inquiry_kind', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#inquiry_kind').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},
/*{ input: '#walkin_source_id', message: 'Required', action: 'blur', 
rule: function(input) {
	source_id = $('#source_id').jqxComboBox('val');
	if (source_id == <?php echo SOURCE_WALKIN; ?>)
	val = $('#walkin_source_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},*/

	{ input: '#exchange_car_make', message: 'Required', action: 'blur', 
	rule: function(input) {
		customer_type_id = $('#customer_type_id').jqxComboBox('val');
		if (customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_SUZUKI; ?> || customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_OTHERS;?>)
		val = $('#exchange_car_make').val();
		return (val == '' || val == null || val == 0) ? false: true;
	}
	},

	{ input: '#exchange_car_model', message: 'Required', action: 'blur', 
	rule: function(input) {
		customer_type_id = $('#customer_type_id').jqxComboBox('val');
		if (customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_SUZUKI; ?> || customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_OTHERS;?>)
		val = $('#exchange_car_model').val();
		return (val == '' || val == null || val == 0) ? false: true;
	}
	},

	{ input: '#exchange_car_year', message: 'Required', action: 'blur', 
	rule: function(input) {
		customer_type_id = $('#customer_type_id').jqxComboBox('val');
		if (customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_SUZUKI; ?> || customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_OTHERS;?>)
		val = $('#exchange_car_year').val();
		return (val == '' || val == null || val == 0) ? false: true;
	}
	},

	{ input: '#exchange_car_kms', message: 'Required', action: 'blur', 
	rule: function(input) {
		customer_type_id = $('#customer_type_id').jqxComboBox('val');
		if (customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_SUZUKI; ?> || customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_OTHERS;?>)
		val = $('#exchange_car_kms').jqxNumberInput('val');
		return (val == '' || val == null || val == 0) ? false: true;
	}
	},

	{ input: '#exchange_car_value', message: 'Required', action: 'blur', 
	rule: function(input) {
		customer_type_id = $('#customer_type_id').jqxComboBox('val');
		if (customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_SUZUKI; ?> || customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_OTHERS;?>)
		val = $('#exchange_car_value').jqxNumberInput('val');
		return (val == '' || val == null) ? false: true;
	}
	},
	{ input: '#occupation_id', message: 'Required', action: 'blur', 
	rule: function(input) {
		val = $('#occupation_id').jqxComboBox('val');
		return (val == '' || val == null || val == 0) ? false: true;
	}
	},
	{ input: '#dob_np', message: 'Invalid Format', action: 'blur', 
	rule: function(input) {
		val = $('#dob_np').val();
		if (val != '') {
			return (val.match(date_pattern)) ? true : false;
		} else {
			return true;
		}
	}
	},

	{ input: '#anniversary_np', message: 'Invalid Format', action: 'blur', 
	rule: function(input) {
		val = $('#anniversary_np').val();
		if (val != '') {
			return (val.match(date_pattern)) ? true : false;
		} else {
			return true;
		}
	}
	},
{ input: '#source-detail-combo', message: 'Required', action: 'blur', 
rule: function(input) {
	source_id = $('#source_id').jqxComboBox('val');
	if (source_id == <?php echo SOURCE_WALKIN; ?>)
	{
	val = $('#walkin_source_id').jqxComboBox('val');
		return (val == '' || val == null || val == 0) ? false: true;
	}
}
},

			<?php /*?>
			{ input: '#exchange_car_bonus', message: 'Required', action: 'blur', 
				rule: function(input) {

					customer_type_id = $('#customer_type_id').jqxComboBox('val');
					if (customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_SUZUKI; ?> || customer_type_id == <?php echo CUSTOMER_TYPE_XCHG_OTHERS;?>)
					val = $('#exchange_car_bonus').jqxNumberInput('val');
					return (val == '' || val == null) ? false: true;
				}
			},
			<?php */?>
			]
		});

$("#jqxCustomerSubmitButton").on('click', function () {
	var validationResult = function (isValid) {
		if (isValid) {
			saveCustomerRecord();
		}
	};
	$('#form-customers').jqxValidator('validate', validationResult);
});

$("#customer_type_id").bind('select', function (event) {

	if (!event.args)
		return;

	customer_type_id = $("#customer_type_id").jqxComboBox('val');

	if (customer_type_id == 1 || customer_type_id == 2){
		$('#exchange_car_make').val('');
		$('#exchange_car_model').val('');
		$('#exchange_car_year').val('');
		$('#exchange_car_kms').jqxNumberInput('val', '');
		$('#exchange_car_value').jqxNumberInput('val', '');
		$('#exchange_car_bonus').jqxNumberInput('val', '');
		$(".replacement").hide();	
	} else {
		$(".replacement").show();
	}
});

$("#source_id").bind('select', function (event) {

	if (!event.args)
		return;

	source_id = $("#source_id").jqxComboBox('val');

	if (source_id == 1) {
		if ($("#event_id")[0]){
			$("#event_id").jqxComboBox('destroy');
		}
		$('#source-detail').html('<label>Walkin Source <span class="mandatory">*</span></label>');
		$('#source-detail-combo').html("<div id='walkin_source_id' name='walkin_source_id'></div>");
		    //mst_walkin_source
		    masterDataSource.data = {table_name: 'mst_walkin_sources'};

		    walkinSourceAdapter = new $.jqx.dataAdapter(masterDataSource, {autoBind: false});

		    $("#walkin_source_id").jqxComboBox({
		    	theme: theme,
		    	width: 195,
		    	height: 25,
		    	selectionMode: 'dropDownList',
		    	autoComplete: true,
		    	searchMode: 'containsignorecase',
		    	source: walkinSourceAdapter,
		    	displayMember: "name",
		    	valueMember: "id",
		    });
		} else if (source_id == 2) {

			if ($("#walkin_source_id")[0]){
				$("#walkin_source_id").jqxComboBox('destroy');
			}

			dealer_id = $('#dealer_id').jqxComboBox('val');
			if (dealer_id == '' || dealer_id == null || dealer_id == 0) {
				alert('Select Dealer/Showroom');
				$('#source_id').jqxComboBox('clearSelection');
				$('#source_id').jqxComboBox('selectIndex', '-1');
				return;
			}

			$('#source-detail').html('<label>Event</label>');
			$('#source-detail-combo').html("<div id='event_id' name='event_id'></div>");
			var dealerEventDataSource  = {
				url : '<?php echo site_url("admin/customers/get_dealer_events_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				data: {
					dealer_id: dealer_id
				},
				async: false,
				cache: true
			}

			dealerEventSourceAdapter = new $.jqx.dataAdapter(dealerEventDataSource);

			$("#event_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: dealerEventSourceAdapter,
				displayMember: "name",
				valueMember: "id",
			});
		} else {
			$('#source-detail').html('');
			if ($("#walkin_source_id")[0]){
				$("#walkin_source_id").jqxComboBox('destroy');
			}
			if ($("#event_id")[0]){
				$("#event_id").jqxComboBox('destroy');
			}
		}
	});

	//mst_variants
	$("#vehicle_id").bind('select', function (event) {

		if (!event.args)
			return;

		vehicle_id = $("#vehicle_id").jqxComboBox('val');

		var variantDataSource  = {
			url : '<?php echo site_url("admin/customers/get_variants_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'variant_id', type: 'number' },
			{ name: 'variant_name', type: 'string' },
			],
			data: {
				vehicle_id: vehicle_id
			},
			async: false,
			cache: true
		}

		variantDataAdapter = new $.jqx.dataAdapter(variantDataSource, {autoBind: false});

		$("#variant_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: variantDataAdapter,
			displayMember: "variant_name",
			valueMember: "variant_id",
		});
	});

	$("#variant_id").bind('select', function (event) {

		if (!event.args)
			return;

		vehicle_id = $("#vehicle_id").jqxComboBox('val');
		variant_id = $("#variant_id").jqxComboBox('val');

		var colorDataSource  = {
			url : '<?php echo site_url("admin/customers/get_colors_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'color_id', type: 'number' },
			{ name: 'color_name', type: 'string' },
			],
			data: {
				vehicle_id: vehicle_id,
				variant_id: variant_id
			},
			async: false,
			cache: true
		}

		colorDataAdapter = new $.jqx.dataAdapter(colorDataSource, {autoBind: false});
		$("#color_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: colorDataAdapter,
			displayMember: "color_name",
			valueMember: "color_id",
		});
	});

	$("#district_id").bind('select', function (event) {

		if (!event.args)
			return;

		val = $("#district_id").jqxComboBox('val');

		munVdcDataSource  = {
			url : '<?php echo site_url("admin/customers/get_mun_vdcs_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			data: {
				parent_id: val
			},
			async: false,
			cache: true
		}

		munVdcDataAdapter = new $.jqx.dataAdapter(munVdcDataSource, {autoBind: false});
		$("#mun_vdc_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: munVdcDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});
	});

	//dealers
	var dealerDataSource = {
		url : '<?php echo site_url("admin/customers/get_dealers_combo_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'name', type: 'string' },
		],
		async: false,
		cache: true
	}

	dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

	$("#dealer_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: dealerDataAdapter,
		displayMember: "name",
		valueMember: "id",
	});

	$("#dealer_id").bind('select', function (event) {
		
		if (!event.args)
			return;

		val = $("#dealer_id").jqxComboBox('val');
	    //dealers
	    executiveDataSource  = {
	    	url : '<?php echo site_url("admin/customers/get_executives_combo_json"); ?>',
	    	datatype: 'json',
	    	datafields: [
	    	{ name: 'id', type: 'number' },
	    	{ name: 'name', type: 'string' },
	    	],
	    	data: {
	    		dealer_id: val
	    	},
	    	async: false,
	    	cache: true
	    }

	    executiveDataAdapter = new $.jqx.dataAdapter(executiveDataSource, {autoBind: false});
	    
	    $("#executive_id").jqxComboBox({
	    	theme: theme,
	    	width: 195,
	    	height: 25,
	    	selectionMode: 'dropDownList',
	    	autoComplete: true,
	    	searchMode: 'containsignorecase',
	    	source: executiveDataAdapter,
	    	displayMember: "name",
	    	valueMember: "id",
	    });
	});

});

function editCustomerRecord(index){
	var row =  $("#jqxGridCustomer").jqxGrid('getrowdata', index);
	if (row) {

		if (row.inquiry_no != '' && row.inquiry_no != null) {
			$('#span_inquiry_no').html(row.inquiry_no);
		}

		$('#customers_id').val(row.id);
		$('#inquiry_no').val(row.inquiry_no);
		$('#fiscal_year_id').val(row.fiscal_year_id);
		// $('#inquiry_date_en').jqxDateTimeInput('setDate', row.inquiry_date_en);
		var enq_date = new Date(row.inquiry_date_en);
		var inquiry_date = enq_date.toLocaleDateString();
		$('#inquiry_date_en').val(inquiry_date);
		$('#inquiry_date_np').val(row.inquiry_date_np);
		$('#customer_type_id').jqxComboBox('val', row.customer_type_id);
		$('#first_name').val(row.first_name);
		$('#middle_name').val(row.middle_name);
		$('#last_name').val(row.last_name);
		$('#gender').jqxComboBox('val', row.gender);
		$('#marital_status').jqxComboBox('val', row.marital_status);
		$('#family_size').jqxNumberInput('val', row.family_size);
		$('#dob_en').jqxDateTimeInput('setDate', row.dob_en);
		$('#dob_np').val(row.dob_np);
		$('#anniversary_en').jqxDateTimeInput('setDate', row.anniversary_en);
		$('#anniversary_np').val(row.anniversary_np);
		$('#district_id').jqxComboBox('val', row.district_id);
		$('#mun_vdc_id').jqxComboBox('val', row.mun_vdc_id);
		$('#address_1').val(row.address_1);
		$('#address_2').val(row.address_2);
		$('#email').val(row.email);
		$('#home_1').val(row.home_1);
		// $('#home_2').val(row.home_2);
		$('#work_1').val(row.work_1);
		// $('#work_2').val(row.work_2);
		$('#mobile_1').val(row.mobile_1);
		// $('#mobile_2').val(row.mobile_2);
		$('#pref_communication').jqxComboBox('val',row.pref_communication);
		$('#occupation_id').jqxComboBox('val', row.occupation_id);
		$('#education_id').jqxComboBox('val', row.education_id);
		$('#dealer_id').jqxComboBox('val', row.dealer_id);
		$('#executive_id').jqxComboBox('val', row.executive_id);
		$('#payment_mode_id').jqxComboBox('val', row.payment_mode_id);
		$('#source_id').jqxComboBox('val', row.source_id);
		<?php /*
		$('#status_id').jqxComboBox('val', row.status_id);
		$('#old_status_id').val(row.status_id);
		*/?>
		$('#inquiry_kind').jqxComboBox('val', row.inquiry_kind);
		<?php if(is_admin()):?>
		$('#contact_1_name').val(row.contact_1_name);
		$('#contact_1_mobile').val(row.contact_1_mobile);
		<?php else: ?>
		$('#contact_1_name').prop('readonly',true).val(row.contact_1_name);
		$('#contact_1_mobile').prop('readonly',true).val(row.contact_1_mobile);
		<?php endif; ?>
		$('#contact_1_relation_id').val(row.contact_1_relation_id);
		$('#contact_2_name').val(row.contact_2_name);
		$('#contact_2_mobile').val(row.contact_2_mobile);
		$('#contact_2_relation_id').val(row.contact_2_relation_id);
		$('#remarks').val(row.remarks);
		$('#vehicle_id').jqxComboBox('val', row.vehicle_id);
		$('#variant_id').jqxComboBox('val', row.variant_id);
		$('#color_id').jqxComboBox('val', row.color_id);

		$("#institution_id").jqxComboBox('val', row.institution_id);

		if (row.source_id == 1)
			$('#source-detail').html('<label>Walkin Source</label>');
		else if (row.source_id == 2)
			$('#source-detail').html('<label>Event</label>');
		
		if ($("#walkin_source_id")[0]){
			$("#walkin_source_id").jqxComboBox('val', row.walkin_source_id);
		}
		if ($("#event_id")[0]){
			$("#event_id").jqxComboBox('val', row.event_id);
		}

		if(row.customer_type_id == 3 || row.customer_type_id == 4) {
			$('#exchange_car_make').val(row.exchange_car_make);
			$('#exchange_car_model').val(row.exchange_car_model);
			$('#exchange_car_year').val(row.exchange_car_year);
			$('#exchange_car_kms').jqxNumberInput('val', row.exchange_car_kms);
			$('#exchange_car_value').jqxNumberInput('val', row.exchange_car_value);
			$('#exchange_car_bonus').jqxNumberInput('val', row.exchange_car_bonus);
			$(".replacement").show();
		}

		
		<?php if( !control('Dealer Selection', FALSE)):?>
		$('.dealer-selection').hide();
		<?php endif;?>
		<?php if( !control('Executive Selection', FALSE)):?>
		$('.executive-selection').hide();
		<?php endif;?>

		openPopupWindow('jqxPopupWindowCustomer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');

	}
}

function saveCustomerRecord(){
	var data = $("#form-customers").serialize();
	
	$('#jqxPopupWindowCustomer').block({ 
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

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/customers/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_customers();
				$('#jqxGridCustomer').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCustomer').jqxWindow('close');
			}
			$('#jqxPopupWindowCustomer').unblock();
		}
	});
}

function reset_form_customers(){
	$('#customers_id').val('');
	$('#old_status_id').val('');
	$('#inquiry_no').val('');
	$('#inquiry_date_en').val('');
	$('#inquiry_date_np').val('');
	$('#form-customers')[0].reset();

	$('#occupation_id').jqxComboBox('clearSelection');
	$('#executive_id').jqxComboBox('clearSelection');
	$('#source_id').jqxComboBox('clearSelection');
	$('#vehicle_id').jqxComboBox('clearSelection');
	$('#variant_id').jqxComboBox('clearSelection');
	$('#color_id').jqxComboBox('clearSelection');
	$('#dealer_id').jqxComboBox('clearSelection');
	$('#executive_id').jqxComboBox('clearSelection');
	$('#payment_mode_id').jqxComboBox('clearSelection');
	$('#customer_type_id').jqxComboBox('clearSelection');
	$('#district_id').jqxComboBox('clearSelection');
	$('#occupation_id').jqxComboBox('clearSelection');
	$('#education_id').jqxComboBox('clearSelection');
	$('#contact_1_relation_id').jqxComboBox('clearSelection');
	$('#contact_2_relation_id').jqxComboBox('clearSelection');
	<?php
	/*$('#status_id').jqxComboBox('clearSelection');
	*/?>
	$('#inquiry_kind').jqxComboBox('clearSelection');
	$('#pref_communication').jqxComboBox('clearSelection');
	$('#mun_vdc_id').jqxComboBox('clearSelection');

	$('#occupation_id').jqxComboBox('selectIndex', '-1');
	$('#executive_id').jqxComboBox('selectIndex', '-1');
	$('#source_id').jqxComboBox('selectIndex', '-1');
	$('#vehicle_id').jqxComboBox('selectIndex', '-1');
	$('#variant_id').jqxComboBox('selectIndex', '-1');
	$('#color_id').jqxComboBox('selectIndex', '-1');
	$('#dealer_id').jqxComboBox('selectIndex', '-1');
	$('#executive_id').jqxComboBox('selectIndex', '-1');
	$('#payment_mode_id').jqxComboBox('selectIndex', '-1');
	$('#customer_type_id').jqxComboBox('selectIndex', '-1');
	$('#district_id').jqxComboBox('selectIndex', '-1');
	$('#occupation_id').jqxComboBox('selectIndex', '-1');
	$('#education_id').jqxComboBox('selectIndex', '-1');
	$('#contact_1_relation_id').jqxComboBox('selectIndex', '-1');
	$('#contact_2_relation_id').jqxComboBox('selectIndex', '-1');
	$('#pref_communication').jqxComboBox('selectIndex', '-1');
	<?php /*$('#status_id').jqxComboBox('selectIndex', '-1');*/?>
	$('#inquiry_kind').jqxComboBox('selectIndex', '-1');
	$('#mun_vdc_id').jqxComboBox('selectIndex', '-1');

	$('#source-detail').html('');
	$('#span_inquiry_no').html('Auto Generate');

	$('#exchange_car_make').val('');
	$('#exchange_car_model').val('');
	$('#exchange_car_year').val('');
	$('#exchange_car_kms').jqxNumberInput('val', '');
	$('#exchange_car_value').jqxNumberInput('val', '');
	$('#exchange_car_bonus').jqxNumberInput('val', '');
	$(".replacement").hide();
	$('#contact_1_name').prop('readonly',false);
	$('#contact_1_mobile').prop('readonly',false);
}

function confirmBooking(id) 
{
	$('#customer_id').val(id);
	openPopupWindow('jqxPopupWindowConfirm_booking', '<?php echo "Booking Confirmation" . "&nbsp;" .  $header; ?>');
}
function saveConfirm_booking()
{
	var data = $("#form-confirm_booking").serialize();

	$('#jqxPopupWindowConfirm_booking').block({
		message: '<span>Processing your request. Please be patient.</span>',
		css: {
			width: '300',
			border: 'none',
			padding: '50px',
			backgroundColor: '#000',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			opacity: .7,
			color: '#fff',
			cursor: 'wait'
		},
	});

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/customers/booking_save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				reset_form_booking_confirm();
				$('#jqxGridCustomer').jqxGrid('updatebounddata');
				$('#jqxPopupWindowConfirm_booking').jqxWindow('close');
			}
			$('#jqxPopupWindowConfirm_booking').unblock();
		}
	});

}

function reset_form_booking_confirm() {
	$('#customer_id').val('');
	$('#form-confirm_booking')[0].reset();
}

function ShowCancelDetails(index)
{
	var row =  $("#jqxGridCustomer").jqxGrid('getrowdata', index);
	if(row)
	{
		$('#customer_name').html(row.full_name);
		$('#vehicle_details').html(row.vehicle_name+' '+ row.variant_name);
		$('#cancellation_amount').html('NRs. '+row.cancel_amount);
		$('#reason_notes').html(row.notes);
		openPopupWindow('jqxPopupWindowBooking_cancel', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	}
}
</script>