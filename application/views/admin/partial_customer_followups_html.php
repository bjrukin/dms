<style type="text/css">
	table.form-table td:nth-child(1){
		width:13%;
	}
	table.form-table td:nth-child(odd){
		width:13%;
	}
	table.form-table td:nth-child(even){
		width:20%;
	}
</style>
<div id="jqxPopupWindowCustomer_followup">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="customer_follups_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-customer_followups', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "customer_followups_id"/>
        	<input type = "hidden" name = "customer_id" id = "customer_followups_customer_id"/>
        	<fieldset>
        		<legend>Current Followup</legend>
	            <table class="form-table">
					<tr>
						<td class="executive-selection"><label for='executive_id'><?php echo lang('executive_id')?><span class='mandatory'>*</span></label></td>
						<td class="executive-selection"><div id='followup_executive_id' name='executive_id'></div></td>
					</tr>
					<tr>
						<td><label for='followup_mode'><?php echo lang('followup_mode')?><span class='mandatory'>*</span></label></td>
						<td><div id='followup_mode' name='followup_mode'></div></td>
						<td><label for='followup_status'><?php echo lang('followup_status')?><span class='mandatory'>*</span></label></td>
						<td><div id='followup_status' name='followup_status'></div></td>
					</tr>
					<tr>
						<td>
							<label for='followup_date_en'><?php echo lang('followup_date_en')?><span class='mandatory'>*</span></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="followup_date_en" data-arg5="followup_date_np"> <?php echo lang('general_ad_to_bs')?></a>
						</td>
						<td><div id='followup_date_en' class='date_box' name='followup_date_en'></div></td>
						<td>
							<label for='followup_date_np'><?php echo lang('followup_date_np')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="followup_date_np" data-arg5="followup_date_en"> <?php echo lang('general_bs_to_ad')?></a>

						</td>
						<td><input id='followup_date_np' class='text_input' name='followup_date_np'></td>
					</tr>
					<tr>
						<td><label for='followup_notes'><?php echo lang('followup_notes')?></label></td>
						<td colspan="3"><textarea id='followup_notes' class='text_area' name='followup_notes'></textarea></td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
        		<legend>Next Followup</legend>
	            <table class="form-table">
					<tr>
						<td><label for='next_followup'><?php echo lang('next_followup')?></label><input id="next_followup"  type="checkbox" name="next_followup" value="1"/></td>
					</tr>
					<tr id="next_followup_details" style="display:none">
						<td>
							<label for='next_followup_date_en'><?php echo lang('next_followup_date_en')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="next_followup_date_en" data-arg5="next_followup_date_np"> <?php echo lang('general_ad_to_bs')?></a>
						</td>
						<td><div id='next_followup_date_en' class='date_box' name='next_followup_date_en'></div></td>
						<td>
							<label for='next_followup_date_np'><?php echo lang('next_followup_date_np')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="next_followup_date_np" data-arg5="next_followup_date_en"> <?php echo lang('general_bs_to_ad')?></a>
						</td>
						<td><input id='next_followup_date_np' class='text_input' name='next_followup_date_np'></td>
					</tr>
				</table>
			</fieldset>
            <table class="form-table">
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomer_followupSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomer_followupCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
	          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridCustomer_followupToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomer_followupFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridCustomer_followup"></div>