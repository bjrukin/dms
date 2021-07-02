<div id="jqxPopupWindowCustomerIncharge">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_incharge">Edit Customers</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-customers-incharge', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "customers_id_incharge"/>
		<input type = "hidden" name='inquiry_no' id='inquiry_no_incharge' >
		<input type = "hidden" name='dealer_id' id='dealer_id_incharge' >
		
		<!-- <input type = "hidden" name='old_status_id' id='old_status_id_incharge' > -->
		<!-- <input type="hidden" name="inquiry_date_en" id="inquiry_date_en_incharge"> -->
		<!-- <input type="hidden" name="inquiry_date_np" id="inquiry_date_np_incharge"> -->
		<fieldset>
			<legend>Inquiry Information</legend>
			<table class="form-table">
				<tr>
					<td><label for='inquiry_no'><?php echo lang('inquiry_no')?></label></td>
					<td><span id="span_inquiry_no_incharge">Auto Generate</span></td>

					<tr>	
						<!-- <td><label for='payment_mode_id'><?php echo lang('payment_mode_id')?><span class='mandatory'>*</span></label></td> -->
						<!-- <td><div id='payment_mode_id' name='payment_mode_id'></div></td> -->
						<td><label for='source_id_incharge'><?php echo lang('source_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='source_id_incharge' name='source_id'></div></td>
						<td id="source-detail_incharge"></td>
						<td id="source-detail-combo_incharge"></td>
					</tr>

						<?php /*
						<td><label for='status_id'><?php echo lang('status_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='status_id' name='status_id'></div></td>
						*/?>
						<!-- <td><label for='inquiry_kind'><?php echo lang('inquiry_kind')?><span class='mandatory'>*</span></label></td>
						<td><div id='inquiry_kind_incharge' name='inquiry_kind'></div></td>
						<td><label for='institution_id'><?php echo lang('institution_id')?></label></td>
						<td><div id='institution_id_incharge' name='institution_id'></div></td> -->
					</tr>
					
					<tr>
						<td><label for='vehicle_id'><?php echo lang('vehicle_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='vehicle_id_incharge' name='vehicle_id'></div></td>
						<td><label for='variant_id'><?php echo lang('variant_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='variant_id_incharge' name='variant_id'></div></td>
						<td><label for='color_id'><?php echo lang('color_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='color_id_incharge' name='color_id'></div></td>
					</tr>
					<tr>
						<td><label for="vehicle_make_year"><?php echo lang('vehicle_make_year') ?><span class='mandatory'>*</span></label></td>
						<td><input type="text" name="vehicle_make_year" id="vehicle_make_year_incharge" class="text_input" ></td>
						
					</tr> 
					<tr>
						
						<td><label for='customer_type_id'><?php echo lang('customer_type_id')?></label></td>
						<td><div id='incharge_customer_type_id' name='customer_type_id'></div></td>
					</tr> 
					<tr class="incharge_replacement">
						<td><label for='exchange_car_make'><?php echo lang('exchange_car_make')?><span class='mandatory'>*</span></label></td>
						<td><input id='incharge_exchange_car_make' class='text_input' name='exchange_car_make'></td>
						<td><label for='exchange_car_model'><?php echo lang('exchange_car_model')?><span class='mandatory'>*</span></label></td>
						<td><input id='incharge_exchange_car_model' class='text_input' name='exchange_car_model'></td>
						<td><label for='exchange_car_year'><?php echo lang('exchange_car_year')?><span class='mandatory'>*</span></label></td>
						<td><input id='incharge_exchange_car_year' class='text_input' name='exchange_car_year'></td>
					</tr>
					<tr class="incharge_replacement">
						<td><label for='exchange_car_kms'><?php echo lang('exchange_car_kms')?><span class='mandatory'>*</span></label></td>
						<td><div id='incharge_exchange_car_kms' class='number_general' name='exchange_car_kms'></div></td>
						<td><label for='exchange_car_value'><?php echo lang('exchange_car_value')?><span class='mandatory'>*</span></label></td>
						<td><div id='incharge_exchange_car_value' class='number_general' name='exchange_car_value'></div></td>
						<td><label for='exchange_car_bonus'><?php echo lang('exchange_car_bonus')?></label></td>
						<td><div id='incharge_exchange_car_bonus' class='number_general' name='exchange_car_bonus'></div></td>
					</tr>
					<tr class="replacement">
						<td><label for='exchange_car_variant'><?php echo lang('exchange_car_variant')?><span class='mandatory'>*</span></label></td>
						<td><input id='incharge_exchange_car_variant' class='text_input' name='exchange_car_variant'></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>	
				</table>
			</fieldset>
			<fieldset>
				<legend>Customers Information</legend>
				<table class="form-table">
					
					<tr>
						<td><label for='first_name'><?php echo lang('first_name')?><span class='mandatory'>*</span></label></td>
						<td><input id='first_name_incharge' class='text_input' name='first_name' readonly></td>
						<td><label for='middle_name'><?php echo lang('middle_name')?></label></td>
						<td><input id='middle_name_incharge' class='text_input' name='middle_name' readonly></td>
						<td><label for='last_name'><?php echo lang('last_name')?><span class='mandatory'>*</span></label></td>
						<td><input id='last_name_incharge' class='text_input' name='last_name' readonly></td>
					</tr>
					<tr>
						<td><label for='home_1'><?php echo lang('home_1')?></label></td>
						<td><input id='home_1_incharge' class='text_input' name='home_1' placeholder='<?php echo lang("general_phone_number_format");?>' readonly></td>
						<td><label for='work_1'><?php echo lang('work_1')?></label></td>
						<td><input id='work_1_incharge' class='text_input' name='work_1' placeholder='<?php echo lang("general_phone_number_format");?>' readonly></td>
						<td><label for='mobile_1'><?php echo lang('mobile_1')?><span class='mandatory'>*</span></label></td>
						<td><input id='mobile_1_incharge' class='text_input' name='mobile_1' placeholder='<?php echo lang("general_mobile_number_format");?>' readonly></td>
					</tr>
				</table>
			</fieldset>
			<table class="form-table">
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomerSubmitButtonIncharge"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomerCancelButtonIncharge"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>