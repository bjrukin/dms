<div class="col-md-12">
	<fieldset>
		<legend>Basic Information</legend>
        <table class="table table-condensed no-border">
			<tr>
				<td><label for='first_name'><?php echo lang('first_name')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->first_name;?></td>
				<td><label for='middle_name'><?php echo lang('middle_name')?></label></td>
				<td><?php echo $employee_info->middle_name;?></td>
				<td><label for='last_name'><?php echo lang('last_name')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->last_name;?></td>
			</tr>
			<tr>
				<td><label for='dob_np'><?php echo lang('dob_np')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->dob_np;?></td>
				<td><label for='dob_en'><?php echo lang('dob_en')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->dob_en;?></td>
			</tr>
			<tr>
				<td><label for='gender'><?php echo lang('gender')?></label></td>
				<td><?php echo ($employee_info->gender == 1) ? 'Male' : 'Female';?></td>
				<td><label for='marital_status'><?php echo lang('marital_status')?></label></td>
				<td><?php echo ($employee_info->marital_status == 1) ? 'Single' : 'Married';?></td>
				</td>
			</tr>
			<tr>
				<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
				<td><?php echo $employee_info->dealer_name;?></td>
				<td><label for='designation_id'><?php echo lang('designation_id')?></label></td>
				<td><?php echo $employee_info->designation_name;?></td>
			</tr>
			<tr id="has-login-row">
			    <td><label for="has-login">Create Credential?</label></td>
				<td><?php echo ($employee_info->has_login) ? 'Yes' : 'No';?></td>
			</tr>
			<tr>
				<td><label for='employee_username'><?php echo lang('employee_username')?></label></td>
				<td><?php echo $employee_info->username;?></td>
				<td><label for='employee_group_id'><?php echo lang('employee_group_id')?></label></td>
				<td><?php echo $employee_info->group_name;?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Contacts</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='home'><?php echo lang('home')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->home;?></td>
				<td><label for='work'><?php echo lang('work')?></label></td>
				<td><?php echo $employee_info->work;?></td>
				<td><label for='mobile'><?php echo lang('mobile')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->mobile;?></td>
			</tr>
			<tr>
				<td><label for='work_email'><?php echo lang('work_email')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->work_email;?></td>
				<td><label for='personal_email'><?php echo lang('personal_email')?></label></td>
				<td><?php echo $employee_info->personal_email;?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Permanent Address</legend>
        <table class="table table-condensed no-border">
			<tr>
				<td><label for='permanent_district_id'><?php echo lang('permanent_district_id')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->permanent_district_name;?></td>
				<td><label for='permanent_mun_vdc_id'><?php echo lang('permanent_mun_vdc_id')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->permanent_mun_vdc_name;?></td>
				<td><label for='permanent_ward'><?php echo lang('permanent_ward')?></label></td>
				<td><?php echo $employee_info->permanent_ward;?></td>
			</tr>
			<tr>
				<td><label for='permanent_address_1'><?php echo lang('permanent_address_1')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->permanent_address_1;?></td>
				<td><label for='permanent_address_2'><?php echo lang('permanent_address_2')?></label></td>
				<td><?php echo $employee_info->permanent_address_2;?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Temporary Address</legend>
        <table class="table table-condensed no-border">
			<tr>
				<td><label for='temporary_district_id'><?php echo lang('temporary_district_id')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->temporary_district_name;?></td>
				<td><label for='temporary_mun_vdc_id'><?php echo lang('temporary_mun_vdc_id')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->temporary_mun_vdc_name;?></td>
				<td><label for='temporary_ward'><?php echo lang('temporary_ward')?></label></td>
				<td><?php echo $employee_info->temporary_ward;?></td>
			</tr>
			<tr>
				<td><label for='temporary_address_1'><?php echo lang('temporary_address_1')?><span class='mandatory'>*</span></label></td>
				<td><?php echo $employee_info->temporary_address_1;?></td>
				<td><label for='temporary_address_2'><?php echo lang('temporary_address_2')?></label></td>
				<td><?php echo $employee_info->temporary_address_2;?></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Citizenship Details</legend>
        <table class="table table-condensed no-border">
			<tr>
				<td><label for='citizenship_no'><?php echo lang('citizenship_no')?></label></td>
				<td><?php echo $employee_info->citizenship_no;?></td>
				<td><label for='citizenship_issued_on'><?php echo lang('citizenship_issued_on')?></label></td>
				<td><?php echo $employee_info->citizenship_issued_on;?></td>
				<td><label for='citizenship_issued_by'><?php echo lang('citizenship_issued_by')?></label></td>
				<td><?php echo $employee_info->citizenship_issued_by;?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Other Details</legend>
        <table class="table table-condensed no-border">
			<tr>
			    <td><label for="has-license">Has License?</label> <?php echo ($employee_info->license) ? 'Yes' : 'No';?></td></td>
			    <td><label for="has-passport">Has Passport?</label> <?php echo ($employee_info->passport) ? 'Yes' : 'No';?></td></td>
			</tr>
			<tr>
				<td>
					<table class="table table-condensed no-border">
						<tr>
							<td><label for='license_no'><?php echo lang('license_no')?></label></td>
							<td><?php echo $employee_info->license_no;?></td>
						</tr>
						<tr>
							<td><label for='license_issued_on'><?php echo lang('license_issued_on')?></label></td>
							<td><?php echo $employee_info->license_issued_on;?></td>
						</tr>
						<tr>
							<td><label for='license_issued_by'><?php echo lang('license_issued_by')?></label></td>
							<td><?php echo $employee_info->license_issued_by;?></td>
							
						</tr>
						<tr>
							<td><label for='license_expiry'><?php echo lang('license_expiry')?></label></td>
							<td><?php echo $employee_info->license_expiry;?></td>
						</tr>
					</table>
				</td>
				<td>
					<table class="table table-condensed no-border">
						<tr>
							<td><label for='passport_no'><?php echo lang('passport_no')?></label></td>
							<td><?php echo $employee_info->passport_no;?></td>
						</tr>
						<tr>
							<td><label for='passport_issued_on'><?php echo lang('passport_issued_on')?></label></td>
							<td><?php echo $employee_info->passport_issued_on;?></div></td>
						</tr>
						<tr>
							<td><label for='passport_issued_by'><?php echo lang('passport_issued_by')?></label></td>
							<td><?php echo $employee_info->passport_issued_by;?></td>
						</tr>
						<tr>
							<td><label for='passport_expiry'><?php echo lang('passport_expiry')?></label></td>
							<td><?php echo $employee_info->passport_expiry; ?></div></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Misc.</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='education_id'><?php echo lang('education_id')?></label></td>
				<td><?php echo $employee_info->education_name;?></td>
				
			</tr>
			<tr>
				<td><label for='interview_date_np'><?php echo lang('interview_date_np')?></label></td>
				<td><?php echo $employee_info->interview_date_np;?></td>
				<td><label for='interview_date_en'><?php echo lang('interview_date_en')?></label></td>
				<td><?php echo $employee_info->interview_date_en;?></td>
			</tr>
			<tr>
				<td><label for='probation_period'><?php echo lang('probation_period')?></label></td>
				<td><?php echo $employee_info->probation_period;?></td>
			</tr>
			<tr>
				<td><label for='joining_date_np'><?php echo lang('joining_date_np')?></label></td>
				<td><?php echo $employee_info->joining_date_np;?></td>
				<td><label for='joining_date_en'><?php echo lang('joining_date_en')?></label></td>
				<td><?php echo $employee_info->joining_date_en;?></td>
			</tr>
			<tr>
				<td><label for='confirmation_date_np'><?php echo lang('confirmation_date_np')?></label></td>
				<td><?php echo $employee_info->confirmation_date_np;?></td>
				<td><label for='confirmation_date_en'><?php echo lang('confirmation_date_en')?></label></td>
				<td><?php echo $employee_info->confirmation_date_en;?></td>
			</tr>
			<tr>
				<td><label for='leaving_date_np'><?php echo lang('leaving_date_np')?></label></td>
				<td><?php echo $employee_info->leaving_date_np;?></td>
				<td><label for='leaving_date_en'><?php echo lang('leaving_date_en')?></label></td>
				<td><?php echo $employee_info->leaving_date_en;?></td>
			</tr>
			<tr>
				<td><label for='leaving_reason'><?php echo lang('leaving_reason')?></label></td>
				<td><?php echo nl2br($employee_info->leaving_reason);?></td>
			</tr>
			
		</table>
	</fieldset>
</div>
<!-- ./Customer Basic Information -->
