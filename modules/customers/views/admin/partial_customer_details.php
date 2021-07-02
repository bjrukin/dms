<div class="col-md-12">
	<fieldset>
		<legend>Inquiry Information</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='inquiry_no'><?php echo lang('inquiry_no')?></label></td>
				<td><?php echo $customer_info->inquiry_no;?></td>
				<td><label for='status_id'><?php echo lang('status_id')?></label></td>
				<td id="td-customer-inquiry-status"><?php echo $customer_info->status_name;?></td>
			</tr>
			<tr>
				<td><label for='inquiry_date_en'><?php echo lang('inquiry_date_en')?></label></td>
				<td><?php echo $customer_info->inquiry_date_en;?></td>
				<td><label for='inquiry_date_np'><?php echo lang('inquiry_date_np')?></label></td>
				<td><?php echo $customer_info->inquiry_date_np;?></td>
				<td><label for='source_id'><?php echo lang('source_id')?></label></td>
				<td><?php echo $customer_info->source_name;?></td>
			</tr>
			<tr>
				<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
				<td><?php echo $customer_info->vehicle_name;?></td>
				<td><label for='variant_id'><?php echo lang('variant_id')?></label></td>
				<td><?php echo $customer_info->variant_name;?></td>
				<td><label for='color_id'><?php echo lang('color_id')?></label></td>
				<td><?php echo $customer_info->color_name;?></td>
			</tr>
			<tr>
				<td><label for='customer_type_id'><?php echo lang('customer_type_id')?></label></td>
				<td><?php echo $customer_info->customer_type_name;?></td>
			</tr>
			<tr>
				<td><label for='exchange_car_make'><?php echo lang('exchange_car_make')?></label></td>
				<td><?php echo $customer_info->exchange_car_make; ?></td>
				<td><label for='exchange_car_model'><?php echo lang('exchange_car_model')?></label></td>
				<td><?php echo $customer_info->exchange_car_model; ?></td>
				<td><label for='exchange_car_year'><?php echo lang('exchange_car_year')?></label></td>
				<td><?php echo $customer_info->exchange_car_year; ?></td>
			</tr>
			<tr>
				<td><label for='exchange_car_kms'><?php echo lang('exchange_car_kms')?></label></td>
				<td><?php echo $customer_info->exchange_car_kms; ?></td>
				<td><label for='exchange_car_value'><?php echo lang('exchange_car_value')?></label></td>
				<td><?php echo $customer_info->exchange_car_value; ?></td>
				<td><label for='exchange_car_bonus'><?php echo lang('exchange_car_bonus')?></label></td>
				<td><?php echo $customer_info->exchange_car_bonus; ?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Dealer & Status</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
				<td><?php echo $customer_info->dealer_name;?></td>
				<td><label for='executive_id'><?php echo lang('executive_id')?></label></td>
				<td><?php echo $customer_info->executive_name;?></td>
				<td><label for='payment_mode_id'><?php echo lang('payment_mode_id')?></label></td>
				<td><?php echo $customer_info->payment_mode_name;?></td>
			</tr>
			<tr>
				<td><label for='bank_id'><?php echo lang('bank_id')?></label></td>
				<td><?php echo $customer_info->bank_name;?></td>
				<td><label for='bank_branch'><?php echo lang('bank_branch')?></label></td>
				<td><?php echo $customer_info->bank_branch;?></td>
				<td><label for='bank_staff'><?php echo lang('bank_staff')?></label></td>
				<td><?php echo $customer_info->bank_staff;?></td>
				<td><label for='bank_contact'><?php echo lang('bank_contact')?></label></td>
				<td><?php echo $customer_info->bank_contact;?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Customers Information</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='first_name'><?php echo lang('first_name')?></label></td>
				<td><?php echo $customer_info->first_name;?></td>
				<td><label for='middle_name'><?php echo lang('middle_name')?></label></td>
				<td><?php echo $customer_info->middle_name;?></td>
				<td><label for='last_name'><?php echo lang('last_name')?></label></td>
				<td><?php echo $customer_info->last_name;?></td>
			</tr>
			<tr>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><?php echo nl2br($customer_info->remarks); ?></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Contact Information</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='district_id'><?php echo lang('district_id')?></label></td>
				<td><?php echo $customer_info->district_name;?></td>
				<td><label for='mun_vdc_id'><?php echo lang('mun_vdc_id')?></label></td>
				<td><?php echo $customer_info->mun_vdc_name;?></td>
			</tr>
			<tr>
				<td><label for='address_1'><?php echo lang('address_1')?></label></td>
				<td><?php echo $customer_info->address_1;?></td>
				<td><label for='address_2'><?php echo lang('address_2')?></label></td>
				<td><?php echo $customer_info->address_2;?></td>
			</tr>
			<tr>
				<td><label for='home_1'><?php echo lang('home_1')?></label></td>
				<td><?php echo $customer_info->home_1;?></td>
				<td><label for='work_1'><?php echo lang('work_1')?></label></td>
				<td><?php echo $customer_info->work_1;?></td>
				<td><label for='mobile_1'><?php echo lang('mobile_1')?></label></td>
				<td><?php echo $customer_info->mobile_1;?></td>
			</tr>
			<?php /* ?>
			<tr><td><label for='home_2'><?php echo lang('home_2')?></label></td>
				<td><?php echo $customer_info->home_2;?></td>
				<td><label for='work_2'><?php echo lang('work_2')?></label></td>
				<td><?php echo $customer_info->work_2;?></td>
				<td><label for='mobile_2'><?php echo lang('mobile_2')?></label></td>
				<td><?php echo $customer_info->mobile_2;?></td>
			</tr>
			<?php */ ?>
			<tr>
				<td><label for='email'><?php echo lang('email')?></label></td>
				<td><?php echo $customer_info->email;?></td>
				<td><label for='pref_communication'><?php echo lang('pref_communication')?></label></td>
				<td><div id='pref_communication' name='pref_communication'></div></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Other Informations</legend>
		<table class="table table-condensed no-border">
			<tr>
				<td><label for='dob_en'><?php echo lang('dob_en')?></label></td>
				<td><?php echo $customer_info->dob_en;?></td>
				<td><label for='dob_np'><?php echo lang('dob_np')?></label></td>
				<td><?php echo $customer_info->dob_np;?></td>
			</tr>
			<tr>
				<td><label for='anniversary_en'><?php echo lang('anniversary_en')?></label></td>
				<td><?php echo $customer_info->anniversary_en;?></td>
				<td><label for='anniversary_np'><?php echo lang('anniversary_np')?></label></td>
				<td><?php echo $customer_info->anniversary_np;?></td>
			</tr>
			<tr>
				<td><label for='occupation_id'><?php echo lang('occupation_id')?></label></td>
				<td><?php echo $customer_info->occupation_name;?></td>
				<td><label for='education_id'><?php echo lang('education_id')?></label></td>
				<td><?php echo $customer_info->education_name;?></td>
			</tr>
			<tr>
				<td><label for='contact_1_name'><?php echo lang('contact_1_name')?></label></td>
				<td><?php echo $customer_info->contact_1_name;?></td>
				<td><label for='contact_1_mobile'><?php echo lang('contact_1_mobile')?></label></td>
				<td><?php echo $customer_info->contact_1_mobile;?></td>
				<td><label for='contact_1_relation_id'><?php echo lang('contact_1_relation_id')?></label></td>
				<td><?php echo $customer_info->contact_1_relation_name;?></td>
			</tr>
			<tr>
				<td><label for='contact_2_name'><?php echo lang('contact_2_name')?></label></td>
				<td><?php echo $customer_info->contact_2_name;?></td>
				<td><label for='contact_2_mobile'><?php echo lang('contact_2_mobile')?></label></td>
				<td><?php echo $customer_info->contact_2_mobile;?></td>
				<td><label for='contact_2_relation_id'><?php echo lang('contact_2_relation_id')?></label></td>
				<td><?php echo $customer_info->contact_2_relation_name;?></td>
			</tr>
			<?php if($customer_info->document){?>
				<td><label for='document'><?php echo lang('document')?></label></td>
				<td><img src="<?php echo site_url('uploads/customer_doc/'.$customer_info->document)?>" height="500px" width="500px"></td>
			<?php }?>
		</table>
	</fieldset>
</div>
<!-- ./Customer Basic Information -->
