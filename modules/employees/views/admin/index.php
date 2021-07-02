<style type="text/css">
	table.form-table td:nth-child(odd){
		width:13%;
	}
	table.form-table td:nth-child(even){
		width:20%;
	}
	@media only screen and (max-device-width: 1024px) {
		table.form-table{
			font-size: 95%;
		}
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('employees'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('menu_employees'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridEmployeeToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridEmployeeInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridEmployeeFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridEmployee"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowEmployee">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-employees', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "employee_id"/>
		<input type = "hidden" name = "user_id" id = "employee_user_id"/>
		<fieldset>
			<legend>Basic Information</legend>
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
					<td>
						<label for='dob_np'><?php echo lang('dob_np')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="dob_np" data-arg5="dob_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="dob_np" id="dob_np" placeholder="YYYY-MM-DD" class="text_input"/></td>

					<td valign="top">
						<label for='dob_en'><?php echo lang('dob_en')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="dob_en" data-arg5="dob_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='dob_en' class='date_box' name='dob_en'></div>
					</td>
				</tr>
				<tr>
					<td valign="top"><label for='gender'><?php echo lang('gender')?></label></td>
					<td valign="top">
						<input type="radio" id="gender-1" name="gender" value="1"> Male
						<input type="radio" id="gender-2" name="gender" value="2"> Female
					</td>
					<td valign="top"><label for='marital_status'><?php echo lang('marital_status')?></label></td>
					<td valign="top">
						<input type="radio" id="marital-status-1" name="marital_status" value="1"> Single
						<input type="radio" id="marital-status-2" name="marital_status" value="2"> Married
					</td>
					<td valign="top"><label for='emp_type'><?php echo lang('emp_type')?></label></td>
					<td valign="top" hidden>
						<label class="radio-inline"><input type="radio" id="emp_type-1" name="employee_type" value="1"> Showroom</label>
						<label class="radio-inline"><input type="radio" id="emp_type-2" name="employee_type" value="2"> Workshop</label>
					</td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='dealer_id' name='dealer_id'></div></td>
					<td><label for='designation_id'><?php echo lang('designation_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='designation_id' name='designation_id'></div></td>

					<td><label for="mechanic_leader" hidden>Mechanic Leader</label></td>
					<td><div id="mechanic_leader" name="mechanic_leader"></div></td>
				</tr>
				<tr id="has-login-row">
					<td><label for="has-login">Create Credential?</label></td>
					<td><input id="has-login"  type="checkbox" name="has_login" value="1"/></td>
				</tr>
				<tr id="login-details" style="display:none">
					<td><label for='employee_username'><?php echo lang('employee_username')?></label></td>
					<td><input id='employee_username' class='text_input' name='username'></td>
					<td><label for='employee_group_id'><?php echo lang('employee_group_id')?></label></td>
					<td><div id='employee_group_id' name='group_id'></div></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Contacts</legend>
			<table class="form-table">
				<tr>
					<td><label for='home'><?php echo lang('home')?><span class='mandatory'>*</span></label></td>
					<td><input id='home' class='text_input' name='home' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
					<td><label for='work'><?php echo lang('work')?></label></td>
					<td><input id='work' class='text_input' name='work' placeholder='Phone or Extension'></td>
					<td><label for='mobile'><?php echo lang('mobile')?><span class='mandatory'>*</span></label></td>
					<td><input id='mobile' class='text_input' name='mobile' placeholder='<?php echo lang("general_mobile_number_format");?>'></td>
				</tr>
				<tr>
					<td><label for='work_email'><?php echo lang('work_email')?><span class='mandatory'>*</span></label></td>
					<td><input id='work_email' class='text_input' name='work_email'></td>
					<td><label for='personal_email'><?php echo lang('personal_email')?></label></td>
					<td><input id='personal_email' class='text_input' name='personal_email'></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Permanent Address</legend>
			<table class="form-table">
				<tr>
					<td><label for='permanent_district_id'><?php echo lang('permanent_district_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='permanent_district_id' name='permanent_district_id'></div></td>
					<td><label for='permanent_mun_vdc_id'><?php echo lang('permanent_mun_vdc_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='permanent_mun_vdc_id' name='permanent_mun_vdc_id'></div></td>
					<td><label for='permanent_ward'><?php echo lang('permanent_ward')?></label></td>
					<td><input id='permanent_ward' class='text_input' name='permanent_ward'></td>
				</tr>
				<tr>
					<td><label for='permanent_address_1'><?php echo lang('permanent_address_1')?><span class='mandatory'>*</span></label></td>
					<td><input id='permanent_address_1' class='text_input' name='permanent_address_1'></td>
					<td><label for='permanent_address_2'><?php echo lang('permanent_address_2')?></label></td>
					<td><input id='permanent_address_2' class='text_input' name='permanent_address_2'></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Temporary Address</legend>
			<table class="form-table">
				<tr>
					<td><label for='temporary_district_id'><?php echo lang('temporary_district_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='temporary_district_id' name='temporary_district_id'></div></td>
					<td><label for='temporary_mun_vdc_id'><?php echo lang('temporary_mun_vdc_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='temporary_mun_vdc_id' name='temporary_mun_vdc_id'></div></td>
					<td><label for='temporary_ward'><?php echo lang('temporary_ward')?></label></td>
					<td><input id='temporary_ward' class='text_input' name='temporary_ward'></td>
				</tr>
				<tr>
					<td><label for='temporary_address_1'><?php echo lang('temporary_address_1')?><span class='mandatory'>*</span></label></td>
					<td><input id='temporary_address_1' class='text_input' name='temporary_address_1'></td>
					<td><label for='temporary_address_2'><?php echo lang('temporary_address_2')?></label></td>
					<td><input id='temporary_address_2' class='text_input' name='temporary_address_2'></td>
					<td>&nbsp;</td>
					<td><a href="javascript:void(0)" id="copy-address">Copy Permanent Address</a></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Citizenship Details</legend>
			<table class="form-table">
				<tr>
					<td><label for='citizenship_no'><?php echo lang('citizenship_no')?></label></td>
					<td><input id='citizenship_no' class='text_input' name='citizenship_no'></td>
					<td><label for='citizenship_issued_on'><?php echo lang('citizenship_issued_on')?></label></td>
					<td><input id='citizenship_issued_on' class='text_input' name='citizenship_issued_on' placeholder="YYYY-MM-DD"></td>
					<td><label for='citizenship_issued_by'><?php echo lang('citizenship_issued_by')?></label></td>
					<td><input id='citizenship_issued_by' class='text_input' name='citizenship_issued_by'></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Other Details</legend>
			<table class="form-table">
				<tr>
					<td>
						<label for="has-license">Has License?</label>
						<input id="has-license"  type="checkbox" name="license" value="1"/>
						<span class="item-text">Yes</span>
					</td>
					<td>
						<label for="has-passport">Has Passport?</label>
						<input id="has-passport" type="checkbox" name="passport" value="1" />
						<span class="item-text">Yes</span>
					</td>
				</tr>
				<tr>
					<td>
						<table class="form-table" id="license-details" style="display:none;">
							<tr>
								<td><label for='license_no'><?php echo lang('license_no')?></label></td>
								<td><input id='license_no' class='text_input' name='license_no'></td>
							</tr>
							<tr>
								<td><label for='license_issued_on'><?php echo lang('license_issued_on')?></label></td>
								<td><input id='license_issued_on' class='text_input' name='license_issued_on' placeholder="YYYY-MM-DD"></td>
							</tr>
							<tr>
								<td><label for='license_issued_by'><?php echo lang('license_issued_by')?></label></td>
								<td><input id='license_issued_by' class='text_input' name='license_issued_by'></td>

							</tr>
							<tr>
								<td><label for='license_expiry'><?php echo lang('license_expiry')?></label></td>
								<td><input id='license_expiry' class='text_input' name='license_expiry' placeholder="YYYY-MM-DD"></td>
							</tr>
						</table>
					</td>
					<td>
						<table class="form-table" id="passport-details" style="display:none;">
							<tr>
								<td><label for='passport_no'><?php echo lang('passport_no')?></label></td>
								<td><input id='passport_no' class='text_input' name='passport_no'></td>
							</tr>
							<tr>
								<td><label for='passport_issued_on'><?php echo lang('passport_issued_on')?></label></td>
								<td><div id='passport_issued_on' class='date_box' name='passport_issued_on' ></div></td>
							</tr>
							<tr>
								<td><label for='passport_issued_by'><?php echo lang('passport_issued_by')?></label></td>
								<td><input id='passport_issued_by' class='text_input' name='passport_issued_by'></td>
							</tr>
							<tr>
								<td><label for='passport_expiry'><?php echo lang('passport_expiry')?></label></td>
								<td><div id='passport_expiry' class='date_box' name='passport_expiry' ></div></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Misc.</legend>
			<table class="form-table">
				<tr>
					<td><label for='education_id'><?php echo lang('education_id')?></label></td>
					<td><div id='education_id'name='education_id'></div></td>
				</tr>
				<tr>
					<td>
						<label for='interview_date_np'><?php echo lang('interview_date_np')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="interview_date_np" data-arg5="interview_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="interview_date_np" id="interview_date_np" placeholder="YYYY-MM-DD" class="text_input"/></td>

					<td valign="top">
						<label for='interview_date_en'><?php echo lang('interview_date_en')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="interview_date_en" data-arg5="interview_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='interview_date_en' class='date_box' name='interview_date_en'></div>
					</td>
				</tr>
				<tr>
					<td><label for='probation_period'><?php echo lang('probation_period')?></label></td>
					<td><input id='probation_period' class='text_input' name='probation_period'></td>
				</tr>
				<tr>
					<td>
						<label for='joining_date_np'><?php echo lang('joining_date_np')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="joining_date_np" data-arg5="joining_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="joining_date_np" id="joining_date_np" placeholder="YYYY-MM-DD" class="text_input"/></td>

					<td valign="top">
						<label for='joining_date_en'><?php echo lang('joining_date_en')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="joining_date_en" data-arg5="joining_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='joining_date_en' class='date_box' name='joining_date_en'></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for='confirmation_date_np'><?php echo lang('confirmation_date_np')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="confirmation_date_np" data-arg5="confirmation_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="confirmation_date_np" id="confirmation_date_np" placeholder="YYYY-MM-DD" class="text_input"/></td>

					<td valign="top">
						<label for='confirmation_date_en'><?php echo lang('confirmation_date_en')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="confirmation_date_en" data-arg5="confirmation_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='confirmation_date_en' class='date_box' name='confirmation_date_en'></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for='leaving_date_np'><?php echo lang('leaving_date_np')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="leaving_date_np" data-arg5="leaving_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="leaving_date_np" id="leaving_date_np" placeholder="YYYY-MM-DD" class="text_input"/></td>

					<td valign="top">
						<label for='leaving_date_en'><?php echo lang('leaving_date_en')?></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="employees" data-arg3="jqxPopupWindowEmployee" data-arg4="leaving_date_en" data-arg5="leaving_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='leaving_date_en' class='date_box' name='leaving_date_en'></div>
					</td>
				</tr>
				<tr>
					<td><label for='leaving_reason'><?php echo lang('leaving_reason')?></label></td>
					<td colspan="5"><textarea id='leaving_reason' class='text_area' name='leaving_reason'></textarea></td>
				</tr>

			</table>
		</fieldset>
		<table class="form-table">
			<tr>
				<td>
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxEmployeeSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxEmployeeCancelButton"><?php echo lang('general_cancel'); ?></button>
				</td>
			</tr>
		</table>

		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		$('#dob_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
		$('#citizenship_issued_on').jqxInput({ placeHolder: 'YYYY-MM-DD'});
		$('#interview_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
		$('#joining_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
		$('#confirmation_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
		$('#leaving_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});

		$("#dob_en, #passport_issued_on, #passport_expiry, #interview_date_en, #joining_date_en, #confirmation_date_en, #leaving_date_en").jqxDateTimeInput({ value: null });

		$('#copy-address').on('click', function(){
			$('#temporary_district_id').jqxComboBox('val', $('#permanent_district_id').jqxComboBox('val'));
			$('#temporary_mun_vdc_id').jqxComboBox('val', $('#permanent_mun_vdc_id').jqxComboBox('val'));
			$('#temporary_ward').val($('#permanent_ward').val());
			$('#temporary_address_1').val($('#permanent_address_1').val());
			$('#temporary_address_2').val($('#permanent_address_2').val());
		});

		$('#has-login').change(function(){
			if (this.checked) {
				$('#login-details').show();
			} else {
				$('#employee_username').val('');
				$('#employee_group_id').jqxComboBox('clearSelection');
				$('#employee_group_id').jqxComboBox('selectIndex', '-1');
				$('#login-details').hide();
			}                   
		});

		$('#has-license').change(function(){
			if (this.checked) {
				$('#license-details').show();
			} else {
				$('#license_no').val('');
				$('#license_issued_on').val('');
				$('#license_issued_by').val('');
				$('#license_expiry').val('');
				$('#license-details').hide();
			}                   
		});

		$('#has-passport').change(function(){
			if (this.checked) {
				$('#passport-details').show();
			} else {
				$('#passport_no').val('');
				$('#passport_issued_by').val('');
				$("#passport_issued_on, #passport_expiry").jqxDateTimeInput({ value: null });
				$('#passport-details').hide();
			}                   
		});

		$('.convert-date').on('click', function(){
			var arg1 = this.getAttribute("data-arg1"),
			arg2 = this.getAttribute("data-arg2"),
			arg3 = this.getAttribute("data-arg3"),
			arg4 = this.getAttribute("data-arg4"),
			arg5 = this.getAttribute("data-arg5");

			window[arg1](arg2,arg3,arg4,arg5);
		});

		var dealerDataSource = {
			url : base_url + 'admin/employees/get_dealers_combo_json',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],async: true,
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

		var groupDataSource = {
			url : base_url + 'admin/employees/get_groups_combo_json',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],async: true,
			cache: true
		}

		groupDataAdapter = new $.jqx.dataAdapter(groupDataSource);

		$("#employee_group_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: groupDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

	//districts
	var districtDataSource = {
		url : '<?php echo site_url("admin/employees/get_districts_combo_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'name', type: 'string' },
		],
		async: false,
		cache: true
	}

	districtDataAdapter = new $.jqx.dataAdapter(districtDataSource);

	$("#permanent_district_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: districtDataAdapter,
		displayMember: "name",
		valueMember: "id",
	});

	$("#permanent_district_id").select('bind', function (event) {
		val = $("#permanent_district_id").jqxComboBox('val');
	    //districts
	    munVdcDataSource  = {
	    	url : '<?php echo site_url("admin/employees/get_mun_vdcs_combo_json"); ?>',
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

	    munVdcDataAdapter = new $.jqx.dataAdapter(munVdcDataSource);
	    $("#permanent_mun_vdc_id").jqxComboBox({
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

	$("#temporary_district_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: districtDataAdapter,
		displayMember: "name",
		valueMember: "id",
	});


	$("#temporary_district_id").select('bind', function (event) {
		val = $("#temporary_district_id").jqxComboBox('val');
	    //districts
	    munVdcDataSource  = {
	    	url : '<?php echo site_url("admin/employees/get_mun_vdcs_combo_json"); ?>',
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

	    munVdcDataAdapter = new $.jqx.dataAdapter(munVdcDataSource);
	    $("#temporary_mun_vdc_id").jqxComboBox({
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

	masterDataSource.data = {table_name: 'mst_educations'};

	educationDataAdapter = new $.jqx.dataAdapter(masterDataSource);

	$("#education_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: educationDataAdapter,
		displayMember: "name",
		valueMember: "id",
	});

	masterDataSource.data = {table_name: 'mst_designations'};

	designationDataAdapter = new $.jqx.dataAdapter(masterDataSource);

	$("#designation_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: designationDataAdapter,
		displayMember: "name",
		valueMember: "id",
	});


	var employeesDataSource =
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
		{ name: 'dealer_id', type: 'number' },
		{ name: 'has_login', type: 'bool' },
		{ name: 'user_id', type: 'number' },
		{ name: 'first_name', type: 'string' },
		{ name: 'middle_name', type: 'string' },
		{ name: 'last_name', type: 'string' },
		{ name: 'dob_en', type: 'date' },
		{ name: 'dob_np', type: 'string' },
		{ name: 'gender', type: 'number' },
		{ name: 'marital_status', type: 'number' },
		{ name: 'permanent_district_id', type: 'number' },
		{ name: 'permanent_mun_vdc_id', type: 'number' },
		{ name: 'permanent_ward', type: 'string' },
		{ name: 'permanent_address_1', type: 'string' },
		{ name: 'permanent_address_2', type: 'string' },
		{ name: 'temporary_district_id', type: 'number' },
		{ name: 'temporary_mun_vdc_id', type: 'number' },
		{ name: 'temporary_ward', type: 'string' },
		{ name: 'temporary_address_1', type: 'string' },
		{ name: 'temporary_address_2', type: 'string' },
		{ name: 'home', type: 'string' },
		{ name: 'work', type: 'string' },
		{ name: 'mobile', type: 'string' },
		{ name: 'work_email', type: 'string' },
		{ name: 'personal_email', type: 'string' },
		{ name: 'photo', type: 'string' },
		{ name: 'nationality', type: 'string' },
		{ name: 'citizenship_no', type: 'string' },
		{ name: 'citizenship_issued_on', type: 'string' },
		{ name: 'citizenship_issued_by', type: 'string' },
		{ name: 'license', type: 'string' },
		{ name: 'license_type', type: 'string' },
		{ name: 'license_no', type: 'string' },
		{ name: 'license_issued_on', type: 'string' },
		{ name: 'license_issued_by', type: 'string' },
		{ name: 'license_expiry', type: 'string' },
		{ name: 'passport', type: 'string' },
		{ name: 'passport_type', type: 'string' },
		{ name: 'passport_no', type: 'string' },
		{ name: 'passport_issued_on', type: 'string' },
		{ name: 'passport_issued_by', type: 'string' },
		{ name: 'passport_expiry', type: 'string' },
		{ name: 'education_id', type: 'number' },
		{ name: 'designation_id', type: 'number' },
		{ name: 'interview_date_en', type: 'date' },
		{ name: 'interview_date_np', type: 'string' },
		{ name: 'probation_period', type: 'string' },
		{ name: 'joining_date_en', type: 'date' },
		{ name: 'joining_date_np', type: 'string' },
		{ name: 'confirmation_date_en', type: 'date' },
		{ name: 'confirmation_date_np', type: 'string' },
		{ name: 'leaving_date_en', type: 'date' },
		{ name: 'leaving_date_np', type: 'string' },
		{ name: 'leaving_reason', type: 'string' },
		{ name: 'employee_name', type: 'string' },
		{ name: 'username', type: 'string' },
		{ name: 'group_id', type: 'number' },
		{ name: 'group_name', type: 'string' },
		{ name: 'permanent_district', type: 'string' },
		{ name: 'permanent_mun_vdc', type: 'string' },
		{ name: 'temporary_district', type: 'string' },
		{ name: 'temporary_mun_vdc', type: 'string' },
		{ name: 'designation_name', type: 'string' },
		{ name: 'education_name', type: 'string' },
		{ name: 'dealer_name', type: 'string' },
		],
		url: '<?php echo site_url("admin/employees/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	employeesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridEmployee").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridEmployee").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridEmployee").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: employeesDataSource,
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
			container.append($('#jqxGridEmployeeToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
				var e = '<a href="javascript:void(0)" onclick="editEmployeeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
				d = '<a href="<?php echo site_url("admin/employees/detail/'+columnproperties.id+'") ?>" title="Details" target="_blank"><i class="fa fa-th"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + d +'</div>';
			}
		},
		{ text: '<?php echo lang("employee_name"); ?>',datafield: 'employee_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("designation_id"); ?>',datafield: 'designation_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("employee_username"); ?>',datafield: 'username',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("employee_group_id"); ?>',datafield: 'group_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("middle_name"); ?>',datafield: 'middle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("last_name"); ?>',datafield: 'last_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("dob"); ?>',datafield: 'dob',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("gender"); ?>',datafield: 'gender',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("marital_status"); ?>',datafield: 'marital_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("permanent_district_id"); ?>',datafield: 'permanent_district_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("permanent_mun_vdc_id"); ?>',datafield: 'permanent_mun_vdc_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("permanent_ward"); ?>',datafield: 'permanent_ward',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("permanent_address_1"); ?>',datafield: 'permanent_address_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("permanent_address_2"); ?>',datafield: 'permanent_address_2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("temporary_district_id"); ?>',datafield: 'temporary_district_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("temporary_mun_vdc_id"); ?>',datafield: 'temporary_mun_vdc_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("temporary_ward"); ?>',datafield: 'temporary_ward',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("temporary_address_1"); ?>',datafield: 'temporary_address_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("temporary_address_2"); ?>',datafield: 'temporary_address_2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("home"); ?>',datafield: 'home',width: 125,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("work"); ?>',datafield: 'work',width: 125,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mobile"); ?>',datafield: 'mobile',width: 125,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("work_email"); ?>',datafield: 'work_email',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("personal_email"); ?>',datafield: 'personal_email',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("photo"); ?>',datafield: 'photo',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("nationality"); ?>',datafield: 'nationality',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("citizenship_no"); ?>',datafield: 'citizenship_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("citizenship_issued_on"); ?>',datafield: 'citizenship_issued_on',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("citizenship_issued_by"); ?>',datafield: 'citizenship_issued_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("license"); ?>',datafield: 'license',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("license_type"); ?>',datafield: 'license_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("license_no"); ?>',datafield: 'license_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("license_issued_on"); ?>',datafield: 'license_issued_on',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("license_issued_by"); ?>',datafield: 'license_issued_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("license_expiry"); ?>',datafield: 'license_expiry',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("passport"); ?>',datafield: 'passport',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("passport_type"); ?>',datafield: 'passport_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("passport_no"); ?>',datafield: 'passport_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("passport_issued_on"); ?>',datafield: 'passport_issued_on',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("passport_issued_by"); ?>',datafield: 'passport_issued_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("passport_expiry"); ?>',datafield: 'passport_expiry',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("education_id"); ?>',datafield: 'education_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("designation_id"); ?>',datafield: 'designation_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("interview_date_en"); ?>',datafield: 'interview_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("interview_date_np"); ?>',datafield: 'interview_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("probation_period"); ?>',datafield: 'probation_period',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("joining_date_en"); ?>',datafield: 'joining_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("joining_date_np"); ?>',datafield: 'joining_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("confirmation_date_en"); ?>',datafield: 'confirmation_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("confirmation_date_np"); ?>',datafield: 'confirmation_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("leaving_date_en"); ?>',datafield: 'leaving_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("leaving_date_np"); ?>',datafield: 'leaving_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("leaving_reason"); ?>',datafield: 'leaving_reason',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

$("[data-toggle='offcanvas']").click(function(e) {
	e.preventDefault();
	setTimeout(function() {$("#jqxGridEmployee").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridEmployeeFilterClear', function () { 
	$('#jqxGridEmployee').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridEmployeeInsert', function () { 
	$('#gender-1').prop('checked', 'checked');
	$('#emp_type-1').prop('checked', 'checked');
	$('#marital-status-1').prop('checked', 'checked');
	openPopupWindow('jqxPopupWindowEmployee', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

	// initialize the popup window
	$("#jqxPopupWindowEmployee").jqxWindow({ 
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

	$("#jqxPopupWindowEmployee").on('close', function () {
		reset_employee_form();
	});

	$("#jqxEmployeeCancelButton").on('click', function () {
		reset_employee_form();
		$('#jqxPopupWindowEmployee').jqxWindow('close');
	});

	$('#form-employees').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [
		{ input: '#employee_username', message: 'Required', action: 'blur', 
		rule: function(input) {
			if ($('#has-login').is(":checked") == true) {
				val = $('#employee_username').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} else {
				return true;
			}
		}
	},

	{ input: '#employee_username', message: 'Username must be between 5 and 25 characters!', action: 'blur', 
	rule: function(input, commit) {
		if ($('#has-login').is(":checked") == true) {
			length = parseInt($("#employee_username").val().length);
			return (length < 5 || length > 25) ? false : true;
		} else {
			return true;
		}
	}
},
{ input: '#employee_username', message: 'Username already exists', action: 'blur', 
rule: function(input, commit) {
	if ($('#has-login').is(":checked") == true) {
		val = $("#employee_username").val();
		$.ajax({
			url: "<?php echo site_url('admin/employees/check_duplicate'); ?>",
			type: 'POST',
			data: {model: 'users/user_model', field: 'username', value: val, id:$('input#employee_user_id').val()},
			success: function (result) {
				var result = eval('('+result+')');
				return commit(result.success);
			},
			error: function(result) {
				return commit(false);
			}
		});
	} else {
		return true;
	}
}
},

{ input: '#dealer_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#dealer_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#designation_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#designation_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#designation_id', message: 'Team Incharge Already Exists', action: 'blur', 
rule: function(input,commit) {
	var designation_id 	= $('#designation_id').jqxComboBox('val'),
	dealer_id = $('#dealer_id').jqxComboBox('val'); 

	// console.log(designation_id, dealer_id);

	if (dealer_id > 0 && designation_id == 2) {
		$.ajax({
			url: "<?php echo site_url('admin/employees/check_team_leader'); ?>",
			type: 'POST',
			data: {
				id 				: $('input#employee_id').val(), 
				designation_id 	: designation_id, 
				dealer_id 		: dealer_id
			},
			success: function (result) {
				var result = eval('('+result+')');
				return commit(result.success);
			},
			error: function(result) {
				return commit(false);
			}
		});
	} else {
		return true;
	}
}
},

{ input: '#employee_group_id', message: 'Required', action: 'blur', 
rule: function(input) {
	if ($('#has-login').is(":checked") == true) {
		val = $('#employee_group_id').jqxComboBox('val');
		return (val == '' || val == null || val == 0) ? false: true;
	} else {
		return true;
	}
}
},

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

{ input: '#dob_en', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#dob_en').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},
{ input: '#dob_np', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#dob_np').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#permanent_district_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#permanent_district_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#permanent_mun_vdc_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#permanent_mun_vdc_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#permanent_address_1', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#permanent_address_1').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#temporary_district_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#temporary_district_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#temporary_mun_vdc_id', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#temporary_mun_vdc_id').jqxComboBox('val');
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#temporary_address_1', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#temporary_address_1').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#home', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#home').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},


{ input: '#mobile', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#mobile').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#work_email', message: 'Required', action: 'blur', 
rule: function(input) {
	val = $('#work_email').val();
	return (val == '' || val == null || val == 0) ? false: true;
}
},

{ input: '#work_email', message: 'Email already exists ', action: 'blur', 
rule: function(input, commit) {
	var val = $("#work_email").val();
	$.ajax({
		url: "<?php echo site_url('admin/employees/check_duplicate'); ?>",
		type: 'POST',
		data: {model: 'employees/employee_model', field: 'work_email', value: val, id:$('input#employee_id').val()},
		success: function (result) {
			var result = eval('('+result+')');
			return commit(result.success);
		},
		error: function(result) {
			return commit(false);
		}
	});

}
},

{ input: '#work_email', message: 'Email already exists', action: 'blur', 
rule: function(input, commit) {
	if ($('#has-login').is(":checked") == true) {
		val = $("#work_email").val();
		$.ajax({
			url: "<?php echo site_url('admin/employees/check_duplicate'); ?>",
			type: 'POST',
			data: {model: 'users/user_model', field: 'email', value: val, id:$('input#employee_user_id').val()},
			success: function (result) {
				var result = eval('('+result+')');
				return commit(result.success);
			},
			error: function(result) {
				return commit(false);
			}
		});
	} else {
		return true;
	}
}
},

{ input: '#work_email', message: 'Invalid Format', action: 'blur', rule: 'email' },

{ input: '#personal_email', message: 'Invalid Format', action: 'blur', rule: 'email' },

{ input: '#home', message: 'Invalid Format.', action: 'blur', 
rule: function(input) {
	val = $('#home').val();
	return (val.match(phone_pattern)) ? true : false;
}
},

{ input: '#mobile', message: 'Invalid Format.', action: 'blur', 
rule: function(input) {
	val = $('#mobile').val();
	return (val.match(mobile_pattern)) ? true : false;
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

{ input: '#citizenship_issued_on', message: 'Invalid Format', action: 'blur', 
rule: function(input) {
	val = $('#citizenship_issued_on').val();
	if (val != '') {
		return (val.match(date_pattern)) ? true : false;
	} else {
		return true;
	}
}
},

{ input: '#interview_date_np', message: 'Invalid Format', action: 'blur', 
rule: function(input) {
	val = $('#interview_date_np').val();
	if (val != '') {
		return (val.match(date_pattern)) ? true : false;
	} else {
		return true;
	}
}
},

{ input: '#joining_date_np', message: 'Invalid Format', action: 'blur', 
rule: function(input) {
	val = $('#joining_date_np').val();
	if (val != '') {
		return (val.match(date_pattern)) ? true : false;
	} else {
		return true;
	}
}
},

{ input: '#confirmation_date_np', message: 'Invalid Format', action: 'blur', 
rule: function(input) {
	val = $('#confirmation_date_np').val();
	if (val != '') {
		return (val.match(date_pattern)) ? true : false;
	} else {
		return true;
	}
}
},

{ input: '#leaving_date_np', message: 'Invalid Format', action: 'blur', 
rule: function(input) {
	val = $('#leaving_date_np').val();
	if (val != '') {
		return (val.match(date_pattern)) ? true : false;
	} else {
		return true;
	}
}
},


]
});

$("#jqxEmployeeSubmitButton").on('click', function () {
	var validationResult = function (isValid) {
		if (isValid) {
			saveEmployeeRecord();
		}
	};
	$('#form-employees').jqxValidator('validate', validationResult);
});
});

function editEmployeeRecord(index){
	var row =  $("#jqxGridEmployee").jqxGrid('getrowdata', index);
	if (row) {

		if (row.has_login == true) {
			$('#employee_username').attr('disabled', true);
			$('#employee_group_id').jqxComboBox('disabled',true);
			$('#has-login-row').hide();
			$('#has-login').prop('checked', false); 
			$('#login-details').show();
		} else {
			$('#has-login-row').show();
		}

		$('#employee_id').val(row.id);

		$('#dealer_id').jqxComboBox('val', row.dealer_id);
		$('#employee_user_id').val(row.user_id);
		$('#employee_group_id').jqxComboBox('val',row.group_id);
		$('#employee_username').val(row.username);

		$('#first_name').val(row.first_name);
		$('#middle_name').val(row.middle_name);
		$('#last_name').val(row.last_name);
		$('#dob_en').jqxDateTimeInput('setDate', row.dob_en);
		$('#dob_np').val(row.dob_np);
		if(row.gender == 1) {
			$('#gender-1').prop('checked', 'checked');   
		} else if(row.gender == 2) {
			$('#gender-2').prop('checked', 'checked');   
		}

		if(row.marital_status == 1) {
			$('#marital-status-1').prop('checked', 'checked');   
		} else if(row.marital_status == 2) {
			$('#marital-status-2').prop('checked', 'checked');   
		}

		if(row.employee_type == 1) {
			$('#emp_type-1').prop('checked', 'checked');   
		} else if(row.employee_type == 2) {
			$('#emp_type-2').prop('checked', 'checked');   
		}
		
		$('#permanent_district_id').jqxComboBox('val', row.permanent_district_id);
		$('#permanent_mun_vdc_id').jqxComboBox('val', row.permanent_mun_vdc_id);
		$('#permanent_ward').val(row.permanent_ward);
		$('#permanent_address_1').val(row.permanent_address_1);
		$('#permanent_address_2').val(row.permanent_address_2);
		$('#temporary_district_id').jqxComboBox('val', row.temporary_district_id);
		$('#temporary_mun_vdc_id').jqxComboBox('val', row.temporary_mun_vdc_id);
		$('#temporary_ward').val(row.temporary_ward);
		$('#temporary_address_1').val(row.temporary_address_1);
		$('#temporary_address_2').val(row.temporary_address_2);
		$('#home').val(row.home);
		$('#work').val(row.work);
		$('#mobile').val(row.mobile);
		$('#work_email').val(row.work_email);
		$('#personal_email').val(row.personal_email);
		$('#citizenship_no').val(row.citizenship_no);
		$('#citizenship_issued_on').val(row.citizenship_issued_on);
		$('#citizenship_issued_by').val(row.citizenship_issued_by);

		if(row.license == 1) {
			$('#license-details').show();
			$('#has-license').prop('checked', 'checked');
			$('#license_no').val(row.license_no);
			$('#license_issued_on').val(row.license_issued_on);
			$('#license_issued_by').val(row.license_issued_by);
			$('#license_expiry').val(row.license_expiry);	
		}
		if(row.passport == 1) {
			$('#passport-details').show();
			$('#has-passport').prop('checked', 'checked');
			$('#passport_no').val(row.passport_no);
			$('#passport_issued_on').jqxDateTimeInput('setDate', row.passport_issued_on);
			$('#passport_issued_by').val(row.passport_issued_by);
			$('#passport_expiry').jqxDateTimeInput('setDate', row.passport_expiry);
		}

		$('#education_id').jqxComboBox('val', row.education_id);
		$('#designation_id').jqxComboBox('val', row.designation_id);
		$('#interview_date_en').jqxDateTimeInput('setDate', row.interview_date_en);
		$('#interview_date_np').val(row.interview_date_np);
		$('#probation_period').val(row.probation_period);
		$('#joining_date_en').jqxDateTimeInput('setDate', row.joining_date_en);
		$('#joining_date_np').val(row.joining_date_np);
		$('#confirmation_date_en').jqxDateTimeInput('setDate', row.confirmation_date_en);
		$('#confirmation_date_np').val(row.confirmation_date_np);
		$('#leaving_date_en').jqxDateTimeInput('setDate', row.leaving_date_en);
		$('#leaving_date_np').val(row.leaving_date_np);
		$('#leaving_reason').val(row.leaving_reason);
		
		openPopupWindow('jqxPopupWindowEmployee', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveEmployeeRecord(){
	var data = $("#form-employees").serialize();
	
	$('#jqxPopupWindowEmployee').block({ 
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
		url: '<?php echo site_url("admin/employees/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_employee_form();
				$('#jqxGridEmployee').jqxGrid('updatebounddata');
				$('#jqxPopupWindowEmployee').jqxWindow('close');
			}
			$('#jqxPopupWindowEmployee').unblock();
		}
	});
}

function reset_employee_form()
{
	$('#employee_id').val('');
	$('#employee_user_id').val('');

	$('#permanent_district_id').jqxComboBox('clearSelection');
	$('#permanent_mun_vdc_id').jqxComboBox('clearSelection');
	$('#temporary_district_id').jqxComboBox('clearSelection');
	$('#temporary_mun_vdc_id').jqxComboBox('clearSelection');
	$('#dealer_id').jqxComboBox('clearSelection');
	$('#employee_group_id').jqxComboBox('clearSelection');
	$('#education_id').jqxComboBox('clearSelection');
	$('#designation_id').jqxComboBox('clearSelection');

	$('#permanent_district_id').jqxComboBox('selectIndex', '-1');
	$('#permanent_mun_vdc_id').jqxComboBox('selectIndex', '-1');
	$('#temporary_district_id').jqxComboBox('selectIndex', '-1');
	$('#temporary_mun_vdc_id').jqxComboBox('selectIndex', '-1');
	$('#dealer_id').jqxComboBox('selectIndex', '-1');
	$('#employee_group_id').jqxComboBox('selectIndex', '-1');
	$('#education_id').jqxComboBox('selectIndex', '-1');
	$('#designation_id').jqxComboBox('selectIndex', '-1');

	$("#dob_en, #passport_issued_on, #passport_expiry, #interview_date_en, #joining_date_en, #confirmation_date_en, #leaving_date_en").jqxDateTimeInput({ value: null });

	$('#employee_username').val('');
	$('#login-details').hide();

	$('#employee_username').attr('disabled', false);
	$('#employee_group_id').jqxComboBox('disabled',false);
	$('#has-login-row').show();

	$('#form-employees')[0].reset();
}

var MECHANICS = <?php echo MECHANICS; ?>;

$('#designation_id').on('change', function(event){
	if (! event.args) {
		return;
	}
	var item = event.args.item.value;
	if(item == MECHANICS) {
		var mechanicLeaderDataSource = {
			url : base_url + 'admin/employees/get_mechanic_lists',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'employee_name', type: 'string' },
			],
			data : {group: 'mechanic_leader'},
			async: true,
			cache: true
		}

		mechanicLeaderDataAdapter = new $.jqx.dataAdapter(mechanicLeaderDataSource);

		$("#mechanic_leader").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: mechanicLeaderDataAdapter,
			displayMember: "employee_name",
			valueMember: "id",
		});
		$("#mechanic_leader, label[for='mechanic_leader']").show();

	} else {
		$("#mechanic_leader, label[for='mechanic_leader']").hide();
	}
});

</script>