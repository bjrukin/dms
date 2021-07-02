<?php 
$total_partial_payment = 0;  
foreach ($partial_payment as $key => $value){
	$total_partial_payment += $value->amount;
} 
?>

<?php 
if($process_detail->dealer_id == 75) { 
	$discount_amt = $process_detail->customer_discount_amount;
}
else
{
	if($process_detail->customer_discount_amount){
		$discount_amt =  $process_detail->customer_discount_amount;
	}
	else
	{
		$discount_amt = $process_detail->normal_discount;
	}
}
if(!is_null($process_detail->special_discount_amount)){
	$special_discount_amount = $process_detail->special_discount_amount;
}else{
	$special_discount_amount = 0;
}
?>
<div class="col-md-12">
	<button class="btn btn-warning btn-sm btn-flat" style="float: right;" onclick="OpenReceipt()">Add Receipt</button>
</div>
<div class="col-md-12">
	<fieldset>
		<legend>Payment Summary</legend>
		<div class="row">
			<div class="col-md-2"><label for='quote_price'><?php echo lang('quote_price')?></label></div>
			<div class="col-md-10">NRs. <?php if($process_detail->quote_price): ?><?php echo moneyFormat($process_detail->quote_price);?><?php else: echo '0';?><?php endif; ?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='actual_discount'><?php echo lang('actual_discount')?></label></div>
			<div class="col-md-10">NRs. <?php echo moneyFormat(($discount_amt == NULL)? 0 : $discount_amt); ?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='booking_amount'><?php echo lang('booking_amount')?></label></div>
			<div class="col-md-10">NRs. <?php if($process_detail->booking_amount): ?><?php echo moneyFormat($process_detail->booking_amount);?><?php else: echo '0';?><?php endif; ?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='downpayment_amount'><?php echo lang('downpayment_amount')?></label></div>
			<div class="col-md-10">NRs. <?php if($total_partial_payment): ?><?php echo moneyFormat($total_partial_payment);?><?php else: echo '0';?><?php endif; ?></div>
		</div>	
		<div class="row">
			<div class="col-md-2"><label for='fullpayment_amount'><?php echo lang('fullpayment_amount')?></label></div>
			<div class="col-md-10">NRs. <?php if($process_detail->fullpayment_amount): ?><?php echo moneyFormat($process_detail->fullpayment_amount);?><?php else: echo '0';?><?php endif; ?></div>
		</div>

			<div class="row">
				<div class="col-md-2"><label for='booking_receipt_no'><?php echo 'Special Discount Amount'?></label></div>
				<div class="col-md-3"><?php echo $special_discount_amount;?></div>
			</div>
		<div class="row">
			<div class="col-md-2"><label for='remaining_amount'><?php echo lang('remaining_amount')?></label></div>
			<div class="col-md-10">NRs. <?php echo moneyFormat($process_detail->quote_price - $discount_amt - $process_detail->booking_amount - $total_partial_payment - $process_detail->fullpayment_amount - $special_discount_amount);?></div>
		</div>
	</table>
</fieldset>
</div>

<div class="col-md-12">
	<fieldset>
		<legend>Booking Details</legend>
		<div class="row">
			<div class="col-md-2"><label for='booking_receipt_no'><?php echo lang('booking_receipt_no')?></label></div>
			<div class="col-md-3"><?php echo $process_detail->booking_receipt_no;?></div>
			<?php if(is_admin()): ?>
				<div class="col-md-2"><button onclick = 'edit_payment("booking")'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button onclick = 'payment_delete(<?php echo $process_detail->vehicle_process_id; ?>,"booking")'><i class="fa fa-remove" aria-hidden="true"></i></button></div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='booking_amount'><?php echo lang('booking_amount')?></label></div>
			<div class="col-md-10">NRs. <?php if($process_detail->booking_amount):?> <?php echo moneyFormat($process_detail->booking_amount);?><?php else: echo '0';?><?php endif; ?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='booking_receipt_image'><?php echo lang('booking_receipt_image')?></label></div>
			<div class="col-md-10"><?php if($process_detail->booking_receipt_image):?><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->booking_receipt_image;?>" style="max-height: 200px"><?php endif; ?></div>
		</div>

		<br><br>
		<?php if(!is_null($process_detail->special_discount_amount)): ?>
			<div class="row">
				<div class="col-md-2"><label for='booking_receipt_no'><?php echo 'Special Discount Amount'?></label></div>
				<div class="col-md-3"><?php echo $process_detail->special_discount_amount;?></div>
				<?php if($process_detail->delivery_sheet_status != 'Delivered'): ?>
					<div class="col-md-2"><button onclick="edit_discount()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> </div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</table>
</fieldset>
</div>

<div class="col-md-12">
	<fieldset>
		<legend>Partial Payment Details</legend>
		<?php foreach ($partial_payment as $key => $value): ?>
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-12">
					<u><?php echo $key+1;?> Payment : </u>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='downpayment_receipt_no'><?php echo lang('downpayment_receipt_no')?></label></div>
				<div class="col-md-3"><?php echo $value->receipt_no;?></div>
				<?php if(is_admin()): ?>
					<div class="col-md-2"><button onclick = 'edit_payment("partial_payment","<?php echo $value->id; ?>")'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button onclick = 'payment_delete(<?php echo $value->id; ?>,"partial_payment")'><i class="fa fa-remove" aria-hidden="true"></i></button></div>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='downpayment_amount'><?php echo lang('downpayment_amount')?></label></div>
				<div class="col-md-10">NRs. <?php if($value->amount): ?><?php echo moneyFormat($value->amount);?><?php else: echo '0';?><?php endif; ?></div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='downpayment_date'><?php echo lang('downpayment_date')?></label></div>
				<div class="col-md-10"><?php echo $value->payment_date;?></div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='downpayment_receipt_image'><?php echo lang('downpayment_receipt_image')?></label></div>
				<div class="col-md-10"><?php if($value->receipt_image):?><img src="<?php echo base_url().'uploads/customer/'.$value->customer_id.'/'.$value->receipt_image;?>" style="max-height: 150px"><?php endif; ?></div>
			</div>
			-------------------------------------------------------------------------------------------------------------------------------
		<?php endforeach; ?>
	</fieldset>
</div>

<div class="col-md-12">
	<fieldset>
		<legend>Fullpayment Details</legend>
		<div class="row">
			<div class="col-md-2"><label for='fullpayment_receipt_no'><?php echo lang('fullpayment_receipt_no')?></label></div>
			<div class="col-md-10"><?php echo $process_detail->fullpayment_receipt_no;?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='fullpayment_amount'><?php echo lang('fullpayment_amount')?></label></div>
			<div class="col-md-10">NRs. <?php if($process_detail->fullpayment_amount): ?><?php echo moneyFormat($process_detail->fullpayment_amount);?><?php else: echo '0';?><?php endif; ?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='fullpayment_date'><?php echo lang('fullpayment_date')?></label></div>
			<div class="col-md-10"><?php echo $process_detail->fullpayment_date;?></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='fullpayment_receipt_image'><?php echo lang('fullpayment_receipt_image')?></label></div>
			<div class="col-md-10"><?php if($process_detail->fullpayment_receipt_image):?><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->fullpayment_receipt_image;?>" style="max-height: 200px"><?php endif; ?></div>
		</div>
	</table>
</fieldset>
</div>

<div id="jqxPopupWindowreceipt">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Receipt <span class="required-booking" style="display: none">*</span></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-receipt', 'onsubmit' => 'return false')); ?>	
		<input type = "hidden" name = "vehicle_process_id" id = "payment_vehicle_process_id" value="<?php echo $process_detail->vehicle_process_id; ?>"/>
		<input type = "hidden" name = "customer_id" id = "payment_customer_id" value="<?php echo $process_detail->id; ?>"/>
		<input type="hidden" name="receipt_type" id="receipt_type">	
		<table class="form-table">
			<tr><td><label for="receipt_no">Receipt No: <span class="required-booking" style="display: none">*</span></label><input class="form-control" type="text" name="receipt_no" id="receipt_no"></td></tr>
			<tr><td><label for="amount">Amount : <span class="required-booking" style="display: none">*</span></label><input class="form-control" type="text" name="amount" id="amount"></td></tr>
			<tr><td>
				<label for="receipt_image">Receipt Image : <span class="required-booking" style="display: none">*</span></label>
				<input type="text" name="image_name" id="payment_image_name" hidden>
				<div id="payment_jqxFileUpload"></div>
				<div id="payment_output"></div>
				<button type="button" class="btn btn-default waves-effect" id="payment_change_image" title="Change Image" style="display:none"><i class="fa fa-exchange" aria-hidden="true"></i>Change Image</button> 
			</td></tr>

			<tr id="customer_discount_amount_form" hidden>
				<td ><label for="receipt_image">Special Discount Amount :</label>
					<input type="text" name="customer_discount" id="customer_discount" class="form-control">
					
				</td>
			</tr>
			<tr>
				<td><label for="receipt_image">Receipt Type :</label>
					<div id='jqxradiobutton1'>Booking</div>
					<div id='jqxradiobutton2'>Partial Payment</div>
					<div id='jqxradiobutton3'>Fullpayment</div></td>
				</tr>
				<tr>
					<th>
						<button type="submit" class="btn btn-success btn-flat  btn-md" id="jqxreceiptSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default  btn-flat btn-md" id="jqxreceiptCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>	

	<div id="jqxPopupWindowreceipt_discount">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title">Receipt</span>
		</div>
		<div class="form_fields_area">
			<?php echo form_open('', array('id' =>'form-discount', 'onsubmit' => 'return false')); ?>	
			
				<input type = "hidden" name = "customer_id" id = "payment_customer_id" value="<?php echo $process_detail->id; ?>"/>
				<table class="form-table">
					<tr><td><label for="amount">Special Discount Amount :</label><input class="form-control" value="<?php echo @$process_detail->customer_discount_amount ?>" type="text" name="discountamount" id="discountamount"></td></tr>
					
					<tr>
						<th>
							<button type="submit" class="btn btn-success btn-flat  btn-md" id="jqxreceiptSubmitButton_discount"><?php echo lang('general_save'); ?></button>
							<button type="button" class="btn btn-default  btn-flat btn-md" id="jqxreceiptCancelButton_discount"><?php echo lang('general_cancel'); ?></button>
						</th>
					</tr>
				</table>
			<?php echo form_close(); ?>
		</div>
	</div>

	<script type="text/javascript">
		var value = 0;
		var fileName = '';
		var customer_id = $('#payment_customer_id').val();
		$(function(){
			$('#payment_jqxFileUpload').jqxFileUpload({
				width: 300,
				accept: 'image/*',
				uploadUrl: '<?php  echo site_url('admin/customers/fileupload')?>',
				fileInputName: 'fileToUpload'
			});
			$("#payment_jqxFileUpload").on('uploadStart', function(){
				$('form[action="<?php  echo site_url('admin/customers/fileupload')?>"]').append('<input type="hidden" name="customer_id" value="'+customer_id+'" />');
			});
			$('#payment_jqxFileUpload').on('uploadEnd', function (event) {
				var args = event.args;
				// console.log(args);
				var fileName = args.file;
				var serverResponse = args.response;
				if(serverResponse == 'Sorry, only JPG, JPEG, PNG &amp; GIF files are allowed.Sorry, your file was not uploaded.'){
					$('#payment_output').html(args.response);
				}else{
					// console.log(serverResponse);
					$('#payment_image_name').val(fileName);     
					$('#payment_output').html("<img src='"+base_url+"/uploads/customer/"+customer_id+"/"+fileName+"' max-width='800px' height='200px'>");   
					$('#payment_jqxFileUpload').hide();
					$("#payment_change_image").show();
					
				}

			});

			$("#jqxradiobutton1").jqxRadioButton({ width: 120, height: 25 });
			$("#jqxradiobutton2").jqxRadioButton({ width: 120, height: 25 });
			$("#jqxradiobutton3").jqxRadioButton({ width: 120, height: 25 });
			$("#jqxradiobutton1").bind('change', function (event) {
				$('#receipt_type').val(1);
				$('#customer_discount_amount_form').show();
			});
			$("#jqxradiobutton2").bind('change', function (event) {
				$('#receipt_type').val(2);
				$('#customer_discount_amount_form').hide();

			});
			$("#jqxradiobutton3").bind('change', function (event) {
				$('#receipt_type').val(3);
				$('#customer_discount_amount_form').hide();

			});

			$("#jqxPopupWindowreceipt").jqxWindow({
				theme: theme,
				width: '50%',
				maxWidth: '50%',
				height: '90%',
				maxHeight: '90%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			$("#jqxPopupWindowreceipt").on('close', function () {
			});

			$("#jqxreceiptCancelButton").on('click', function () {
				$('#jqxPopupWindowreceipt').jqxWindow('close');
			});		

			$("#jqxreceiptSubmitButton").on('click', function () {
				save_Receipt();
			});


			$("#jqxPopupWindowreceipt_discount").jqxWindow({
				theme: theme,
				width: '50%',
				maxWidth: '50%',
				height: '20%',
				maxHeight: '20%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			$("#jqxPopupWindowreceipt_discount").on('close', function () {
			});

			$("#jqxreceiptCancelButton_discount").on('click', function () {
				$('#jqxPopupWindowreceipt_discount').jqxWindow('close');
			});		

			$("#jqxreceiptSubmitButton_discount").on('click', function () {
				save_discount();
			});


		});

		function OpenReceipt() 
		{		
			openPopupWindow('jqxPopupWindowreceipt', '<?php echo "Delivery Sheet" . "&nbsp;" .  $header; ?>');
		}
		
		/*Change Image*/
		$("#payment_change_image").click(function(){
			var filename = $('#image_name').val();
			$.post("<?php echo site_url('admin/customers/upload_delete')?>", {filename:filename}, function(){
				$("#payment_change_image").hide();
				$('#payment_jqxFileUpload').show();
				$('#payment_image_name').text('');
				$('#payment_output').hide();			
			});
		});

		function save_Receipt()
		{
			var data = $("#form-receipt").serialize();
			if($('#receipt_type').val() == 1){
				$('.required-booking').css('display','block');
				if($('#receipt_no').val() == null || $('#receipt_no').val() == ''){
					alert('Provide Discount First');
					return false;
				}
				if($('#customer_discount').val() == null || $('#customer_discount').val() == ''){
					alert('Provide Discount First');
					return false;
				}

				if($('#amount').val() == null || $('#amount').val() == ''){
					alert('Provide Booking Amount First');
					return false;
				}

				if($('#payment_image_name').val() == '' || $('#payment_image_name').val() == null){
					alert('Please Provide Receipt Image');
					return false;
				}
				
			}else{
				$('.required-booking').css('display','none');

			}

			$('#jqxPopupWindowreceipt').block({ 
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
				url: '<?php echo site_url("admin/customers/save_receipt"); ?>',
				data: data,
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						reset_form_receipt();
						$('#jqxPopupWindowreceipt').jqxWindow('close');						
					}
					$('#jqxPopupWindowreceipt').unblock();
					location.reload();

				}
			});
			function reset_form_receipt()
			{
				$('#vehicle_process_id').val('');
				$('#form-receipt')[0].reset();
			}
		}

		function save_discount()
		{
			var data = $("#form-discount").serialize();

			$('#jqxPopupWindowreceipt_discount').block({ 
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
				url: '<?php echo site_url("admin/customers/save_discount"); ?>',
				data: data,
				success: function (result) {
					var result = eval('('+result+')');
					if (result.success) {
						// reset_form_receipt();
						$('#jqxPopupWindowreceipt_discount').jqxWindow('close');						
					}
					$('#jqxPopupWindowreceipt_discount').unblock();
					location.reload();

				}
			});

		}

		function edit_payment(type,p_id)
		{
			// console.log(type);
			$.post("<?php echo site_url('customers/get_payment_detail')?>",{type : type,customer_id:customer_id,p_id:p_id},function(result)
			{
				$('#receipt_no').val(result.receipt_no);
				$('#amount').val(result.amount);
				$('#partial_payment_id').val(p_id);
				if(type == 'booking')
				{
					$("#jqxradiobutton1").jqxRadioButton({checked:true });
				}
				else
				{
					$("#jqxradiobutton2").jqxRadioButton({checked:true });
				}

				openPopupWindow('jqxPopupWindowreceipt', '<?php echo "Payment" . "&nbsp;" .  $header; ?>');

			},'json');
		}

		function payment_delete(id,type)
		{
			if(confirm('Confirm Delete ?'))
			{
				$.post('<?php echo site_url('customers/delete_payment')?>',{id:id,type:type},function(result)
				{
					if(result)
					{
						location.reload();
					}					
				},'json');

			}
		}

		function edit_discount()
		{
			openPopupWindow('jqxPopupWindowreceipt_discount', '<?php echo "Payment" . "&nbsp;" .  $header; ?>');
		}
	</script>

