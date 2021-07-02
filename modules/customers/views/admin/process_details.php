<style>
	.myImg {
		border-radius: 5px;
		cursor: pointer;
		transition: 0.3s;
	}

	.myImg:hover {opacity: 0.7;}

	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 999; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.9); /* Black w/ opacity */		
	}

	/* Modal Content (image) */
	.modal-content {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 500px;
	}

	@-webkit-keyframes zoom {
		from {-webkit-transform:scale(0)} 
		to {-webkit-transform:scale(1)}
	}

	@keyframes zoom {
		from {transform:scale(0)} 
		to {transform:scale(1)}
	}

	/* The Close Button */
	.close {
		position: absolute;
		top: 15px;
		right: 35px;
		color: #f1f1f1;
		font-size: 40px;
		font-weight: bold;
		transition: 0.3s;
	}

	.close:hover,
	.close:focus {
		color: #bbb;
		text-decoration: none;
		cursor: pointer;
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
		.modal-content {
			width: 100%;
		}
	}
</style>

<div class="col-md-12">
	<div class="btn-group btn-group-sm"  style="float: right;">
		<a href="<?php echo site_url('admin/customers/generate_document?doc_type=4&id='.$process_detail->id) ?>" class="btn btn-warning" target="_blank">Order Confirmation</a>
		<!-- <button class="btn btn-warning" onclick = "delivery_sheet()" >Delivery Sheet</button> -->
		<?php if($process_detail->delivery_sheet_status == 'Not Delivered'):?>
			<button class="btn btn-warning" onclick = "delivery_sheet()" >Delivery Sheet</button>
		<?php endif; ?>
		<?php if($process_detail->payment_mode_id == 2): ?>
			<a href="<?php echo site_url('admin/customers/generate_document?doc_type=1&id='.$process_detail->id) ?>" class="btn btn-warning" target="_blank">Allotment Letter</a>
		<?php endif; ?>
		<button class="btn btn-warning" onclick = "credit_note()" >Credit Note</button>
		<!-- <a href="<?php echo site_url('admin/customers/generate_document?doc_type=2&id='.$process_detail->id) ?>" class="btn btn-warning" target="_blank">Credit Note</a> -->
		<?php if(is_showroom_incharge()): ?>
			<a href="<?php echo site_url('admin/customers/generate_document?doc_type=3&id='.$process_detail->id) ?>" class="btn btn-warning" target="_blank">Vat Bill</a>
		<?php endif; ?>
		<?php if(!isset($foc_details->foc_request_id)):?>
			<button class="btn btn-warning" onclick = "foc_sheet()" >FOC</button>
		<?php endif; ?>
		<button class="btn btn-warning" onclick = "name_transfer()" >Name Transfer</button>
	</div>
</div>
<div class="col-md-12">
	<fieldset>
		<legend>Process Details</legend>
		<div class="row">			
			<div class="col-md-2"><label for='payment_mode'><?php echo lang('payment_mode')?></label></div>
			<div class="col-md-10"><?php echo $process_detail->payment_mode_name;?></div>
		</div>
		<div class="row">			
			<div class="col-md-2"><label for='booked_date'><?php echo lang('booked_date')?></label></div>
			<div class="col-md-10"><?php echo $process_detail->booked_date;?></div>
		</div>
	</fieldset>
</div>
<div class="col-md-12">
	<fieldset>
		<legend>Documents Details</legend>
		<?php if($process_detail->payment_mode_id == 2): ?>
			<div class="row">
				<div class="col-md-2"><label for='quotation_issue'><?php echo lang('quotation_issue')?></label></div>
				<div class="col-md-10"><?php echo ($process_detail->quotation_issue_date == 0) ? "Not generated" : "Generated";?></div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='delivery_order_flag'><?php echo lang('delivery_order_flag')?></label></div>
				<div class="col-md-10">
					<?php if($process_detail->do_image == NULL):?>
						<button class="btn btn-xs btn-info btn-flat" id="do_btn" onclick="Opendocument()">Upload Delivery Order</button>
					<?php else: ?>
						<div><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->do_image;?>" style="max-height: 100px" class="myImg"><a href="<?php echo site_url('customers/remove_image').'/'.$process_detail->vehicle_process_id.'/do_image/'.$process_detail->id.'/'.$process_detail->do_image?>">Remove Image</a></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='bluebook_received_flag'><?php echo lang('bluebook_received_flag')?></label></div>
				<div class="col-md-10">
					<?php if($process_detail->bluebook_image == NULL):?>
						<button class="btn btn-xs btn-info btn-flat" id="bluebook_btn" onclick="Opendocument()">Upload Bluebook</button>
					<?php else: ?>
						<div><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->bluebook_image;?>" style="max-height: 100px" class="myImg"><a href="<?php echo site_url('customers/remove_image').'/'.$process_detail->vehicle_process_id.'/bluebook_image/'.$process_detail->id.'/'.$process_detail->bluebook_image?>">Remove Image</a></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='insurance'><?php echo lang('insurance')?></label></div>
				<div class="col-md-10">
					<?php if($process_detail->insurance_image == NULL):?>
						<button class="btn btn-xs btn-info btn-flat" id="insurance_btn" onclick="Opendocument()">Upload Insurance</button>
					<?php else: ?>
						<div><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->insurance_image;?>" style="max-height: 100px" class="myImg"><a href="<?php echo site_url('customers/remove_image').'/'.$process_detail->vehicle_process_id.'/insurance_image/'.$process_detail->id.'/'.$process_detail->insurance_image?>">Remove Image</a></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-2"><label for='delivery_sheet'><?php echo lang('delivery_sheet')?></label></div>
			<div class="col-md-10">
				<?php if($process_detail->deliverysheet_image == NULL):?>
					<button class="btn btn-xs btn-info btn-flat" id="deliverysheet_btn" onclick="Opendocument()">Upload Delivery Sheet</button>
				<?php else: ?>
					<div><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->deliverysheet_image;?>" style="max-height: 100px" class="myImg"><a href="<?php echo site_url('customers/remove_image').'/'.$process_detail->vehicle_process_id.'/deliverysheet_image/'.$process_detail->id.'/'.$process_detail->deliverysheet_image?>">Remove Image</a></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='creditnote_image'><?php echo lang('creditnote_image')?></label></div>
			<div class="col-md-10">
				<?php if($process_detail->creditnote_image == NULL):?>
					<button class="btn btn-xs btn-info btn-flat" id="creditnote_btn" onclick="Opendocument()">Upload Credit Note</button>
				<?php else: ?>
					<div><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->creditnote_image;?>" style="max-height: 100px" class="myImg"><a href="<?php echo site_url('customers/remove_image').'/'.$process_detail->vehicle_process_id.'/creditnote_image/'.$process_detail->id.'/'.$process_detail->creditnote_image?>">Remove Image</a></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='vat_bill'><?php echo lang('vat_bill')?></label></div>
			<div class="col-md-10">
				<?php if($process_detail->vat_bill_image == NULL):?>
					<button class="btn btn-xs btn-info btn-flat" id="vatbill_btn" onclick="Opendocument()">Upload Vat Bill</button>
				<?php else: ?>
					<div><img src="<?php echo base_url().'uploads/customer/'.$process_detail->id.'/'.$process_detail->vat_bill_image;?>" style="max-height: 100px" class="myImg"><a href="<?php echo site_url('customers/remove_image').'/'.$process_detail->vehicle_process_id.'/vat_bill_image/'.$process_detail->id.'/'.$process_detail->vat_bill_image?>">Remove Image</a></div>
				<?php endif; ?>
			</div>
		</div>
	</fieldset>
</div>
<div id="jqxPopupWindowdocument">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Upload Document</span>
	</div>
	<div class="form_fields_area">
		<div class="col-md-12" style="margin-bottom: 20px;">
			<?php echo form_open('', array('id' =>'form-document', 'onsubmit' => 'return false')); ?>	
			<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id" value="<?php echo $process_detail->vehicle_process_id; ?>"/>
			<input type = "hidden" name = "customer_id" id = "customer_id" value="<?php echo $process_detail->id; ?>"/>
			<input type = "hidden" name = "document_type" id = "document_type"/>
			<input type="text" name="image_name" id="image_name" hidden>
			<div id="jqxFileUpload"></div>
			<div id="output"></div>
			<button type="button" class="btn btn-default waves-effect" id="change_image" title="Change Image" style="display:none"><i class="fa fa-exchange" aria-hidden="true"></i>Change Image</button> 
		</div>
		<div class="col-md-12">			
			<button type="submit" class="btn btn-success btn-md btn-flat" id="jqxdocumentSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-default btn-md btn-flat" id="jqxdocumentCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="documentModal" class="modal">
	<span class="close">&times;</span>
	<img class="modal-content" id="img01">
</div>	
<div id="jqxPopupWindowdelivery_sheet">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Delivery Sheet</span>
	</div>
	<div class="form_fields_area">
		<form method="post" accept-charset="utf-8" action="<?php echo site_url('admin/customers/generate_deliverysheet');?>">
			<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id" value="<?php echo $process_detail->vehicle_process_id; ?>"/>
			<input type = "hidden" name = "customer_id" id = "customer_id" value="<?php echo $process_detail->id; ?>"/>
			<input type = "hidden" name = "vehicle_name" id = "vehicle_name" value="<?php echo $process_detail->vehicle_name; ?>"/>
			<input type = "hidden" name = "variant_name" id = "variant_name" value="<?php echo $process_detail->variant_name; ?>"/>
			<input type = "hidden" name = "color_name" id = "color_name" value="<?php echo $process_detail->color_name; ?>"/>
			<input type = "hidden" name="engine_no" id="engine_no">
			<input type = "hidden" name="stock_id" id="stock_id">
			<input type = "hidden" name="msil_dispatch_id" id="msil_dispatch_id">
			<table class="form-table">
				<tr><td><label for="vehicle_name">VEHICLE :</label></td><td><input type="hidden" name="vehicle_id"  id="vehicle_id" value="<?php echo $process_detail->vehicle_id; ?>"><?php echo $process_detail->vehicle_name; ?></td></tr>
				<tr><td><label for="variant_name">VARIANT :</label></td><td><input type="hidden" name="variant_id" id="variant_id"  value="<?php echo $process_detail->variant_id; ?>"><?php echo $process_detail->variant_name; ?></td></tr>
				<tr><td><label for="color_name">COLOR :</label></td><td><input type="hidden" name="color_id"  id="color_id" value="<?php echo $process_detail->color_id;?>"><?php echo $process_detail->color_name; ?></td></tr>
				<tr><td><label for="engine_no">ENGINE NO:</label></td><td><div id="chass_no" name="chass_no"></div></td></tr>
				<tr><td><label for='chassis_no'>CHASSIS NO:</label></td><td><div id="displaychassis"></div></td></tr>			
				<tr>
					<th>
						<button type="submit" class="btn btn-success btn-md btn-flat" id="jqxdelivery_sheetSubmitButton"><?php echo "Generate"//lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-md btn-flat" id="jqxdelivery_sheetCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
		</form>
	</div>
</div>	
<div id="jqxPopupWindowcredit_note">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Credit Note</span>
	</div>
	<div class="form_fields_area">
		<form method="post" accept-charset="utf-8" action="<?php echo site_url('admin/customers/generate_credit_note');?>">
			<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id_credit" value="<?php echo $process_detail->vehicle_process_id; ?>"/>
			<input type = "hidden" name = "customer_id" id = "customer_id_credit" value="<?php echo $process_detail->id; ?>"/>			
			<table class="form-table">
				<tr>
					<td><label for="loan_amount">Loan Amount :</label></td>
					<td><input type="text" class="text_input" name="loan_amount" id="loan_amount"></td>
				</tr>
				<tr>
					<th>
						<button type="submit" class="btn btn-success btn-md btn-flat" id="jqxcredit_noteSubmitButton"><?php echo "Generate"?></button>
						<button type="button" class="btn btn-default btn-md btn-flat" id="jqxcredit_noteCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
		</form>
	</div>
</div>	
<div id="jqxPopupWindowfoc_sheet">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Free Of Cost</span>
	</div>
	<div class="form_fields_area">
		<h4>Free of Cost (FOC)</h4>
		<?php echo form_open('', array('id' =>'form-foc_sheet', 'onsubmit' => 'return false')); ?>			
		<input type = "hidden" name = "customer_id" id = "customer_id" value="<?php echo $process_detail->id; ?>"/>
		<table class="form-table">
			<tbody> 
				<tr>
					<td style="width: 15%"><label for="fuel">Accessories:</label></td>
					<td style="width: 90%"><div id="acc_list" name="accessories_list"></div></td>
				</tr>
				<tr>
					<td style="width: 15%"><label for="fuel">Fuel:</label></td>
					<td style="width: 90%"><input type="text" class='text_input' name="fuel" placeholder="Enter quantity in Ltrs."></td>
				</tr>
				<tr>
					<td style="width: 15%"><label for="fuel">Free Servecing:</label></td>
					<td style="width: 90%"><input type="text" class='text_input' name="free_servicing_coupon" placeholder="Enter Coupon Number."></td>
				</tr>				
			</tbody>
			<tfoot>			
				<tr>
					<td><button type="submit" class="btn btn-success btn-md btn-flat" id="jqxfoc_sheetSubmitButton"><?php echo "Generate"//lang('general_save'); ?></button></td>
					<td><button type="button" class="btn btn-default btn-md btn-flat" id="jqxfoc_sheetCancelButton"><?php echo lang('general_cancel'); ?></button></td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="<?php echo site_url('admin/customers/foc_document')?>/<?php echo $process_detail->id ?>" style="display: none" target="_blank" id="print-icon"><i class="fa fa-print fa-lg" aria-hidden="true"></i>Print</a></h3>
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
</div>	
<div id="jqxPopupWindowname_Transfer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Name Transfer & Road Tax</span>
	</div>
	<div class="form_fields_area">
		<h4>Name Transfer & Road Tax</h4>
		<?php echo form_open('', array('id' =>'form-name_transfer', 'onsubmit' => 'return false')); ?>			
		<input type = "hidden" name = "customer_id" value="<?php echo $process_detail->id; ?>"/>
		<table class="form-table">
			<tbody> 				
				<tr>
					<td style="width: 15%"><label for="fuel">Name Transfer:</label></td>
					<td style="width: 90%"><div id="name" name="name_transfer"></div></td>
				</tr>
				<tr>
					<td style="width: 15%"><label for="fuel">Road Tax:</label></td>
					<td style="width: 90%"><input type="text" class='text_input' name="road_tax_amount" placeholder="Enter Amount." ></td>
				</tr>
			</tbody>
			<tfoot>			
				<tr>
					<td><button type="submit" class="btn btn-success btn-md btn-flat" id="jqxname_transferSubmitButton"><?php echo "Generate"//lang('general_save'); ?></button></td>
					<td><button type="button" class="btn btn-default btn-md btn-flat" id="jqxname_transferCancelButton"><?php echo lang('general_cancel'); ?></button></td>
				</tr>
			</tfoot>
		</table>
	</form>
</div>
</div>

<script type="text/javascript">
	var value = 0;
	var customer_id = $('#customer_id').val();
	var fileName = '';
	$(function(){
		$('#jqxFileUpload').jqxFileUpload({
			width: 300,
			accept: 'image/*',
			uploadUrl: '<?php  echo site_url('admin/customers/fileupload')?>',
			fileInputName: 'fileToUpload'
		});
		$("#jqxFileUpload").on('uploadStart', function(){
			$('form[action="<?php  echo site_url('admin/customers/fileupload')?>"]').append('<input type="hidden" name="customer_id" value="'+customer_id+'" />');
		});
		$('#jqxFileUpload').on('uploadEnd', function (event) {
			var args = event.args;
			var fileName = args.file;
			var serverResponse = args.response;

			$('#image_name').val(fileName);     
			$('#output').html("<img src='"+base_url+"/uploads/customer/"+customer_id+"/"+fileName+"' max-width='800px' height='200px'>"); 
			$('#jqxFileUpload').hide();
			$("#change_image").show();

		});

		$("#jqxPopupWindowdocument").jqxWindow({
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '65%',
			maxHeight: '65%',
			isModal: true,
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false
		});

		$("#jqxPopupWindowdocument").on('close', function () {
		});

		$("#jqxdocumentCancelButton").on('click', function () {
			$('#jqxPopupWindowdocument').jqxWindow('close');
		});		

		$("#jqxdocumentSubmitButton").on('click', function () {
			save_document();
		});

		// credit note
		$("#jqxPopupWindowcredit_note").jqxWindow({
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '40%',
			maxHeight: '40%',
			isModal: true,
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false
		});

		$("#jqxPopupWindowcredit_note").on('close', function () {
		});

		$("#jqxcredit_noteCancelButton").on('click', function () {
			$('#jqxPopupWindowcredit_note').jqxWindow('close');
		});	

		$("#jqxPopupWindowfoc_sheet").jqxWindow({
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '60%',
			maxHeight: '60%',
			isModal: true,
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false
		});

		$("#jqxPopupWindowfoc_sheet").on('close', function () {
			reset_foc_sheet();
		});

		$("#jqxfoc_sheetCancelButton").on('click', function () {
			$('#jqxPopupWindowfoc_sheet').jqxWindow('close');
			reset_foc_sheet();
		});
		$("#jqxfoc_sheetSubmitButton").on('click', function () {
			save_foc_sheet();
		});

		$("#jqxPopupWindowname_Transfer").jqxWindow({
			theme: theme,
			width: '50%',
			maxWidth: '50%',
			height: '65%',
			maxHeight: '65%',
			isModal: true,
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false
		});

		$("#jqxPopupWindowname_Transfer").on('close', function () {
		});

		$("#jqxname_transferCancelButton").on('click', function () {
			$('#jqxPopupWindowname_Transfer').jqxWindow('close');
		});		

		$("#jqxname_transferSubmitButton").on('click', function () {
			save_name_transfer();
		});


		// var AccessoriesDataSource  = {
		// 	url : '<?php //echo site_url("admin/customers/get_Accessories_list"); ?>',
		// 	datatype: 'json',
		// 	datafields: [
		// 	{ name: 'id', type: 'number' },
		// 	{ name: 'name', type: 'string' },
		// 	],			
		// 	async: false,
		// 	cache: true
		// }	
		// AccessoriesDataAdapter = new $.jqx.dataAdapter(AccessoriesDataSource);
		// $("#acc_list").jqxComboBox({
		// 	source: AccessoriesDataAdapter,
		// 	theme: 'energyblue',
		// 	width: '225px',
		// 	height: '25px',
		// 	searchMode:'endswith',
		// 	checkboxes:true,
		// 	displayMember: "name",
		// 	valueMember: "id"

		// });
		vehicle_id = $('#vehicle_id').val();

		var AccessoriesDataSource  = {
			url : '<?php echo site_url("admin/customers/get_Accessories_partcode_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			],
			data : {vehicle_id : vehicle_id},			
			async: false,
			cache: true
		}	

		AccessoriesDataAdapter = new $.jqx.dataAdapter(AccessoriesDataSource);
		$("#acc_list").jqxComboBox({
			source: AccessoriesDataAdapter,
			theme: 'energyblue',
			width: '225px',
			height: '25px',
			searchMode:'endswith',
			checkboxes:true,
			displayMember: "name",
			placeHolder: 'Select Accessories',
			valueMember: "id"

		});
		$("#name").jqxCheckBox({ width: 120, height: 25 });

	});

function Opendocument() 
{		
	openPopupWindow('jqxPopupWindowdocument', '<?php echo "Document Upload" . "&nbsp;" .  $header; ?>');
}

/*Change Image*/
$("#change_image").click(function(){
	var filename = $('#image_name').val();
	$.post("<?php echo site_url('admin/customers/upload_delete')?>", {filename:filename}, function(){
		$("#change_image").hide();
		$('#jqxFileUpload').show();
		$('#image_name').text('');
		$('#output').hide();			
	});
});

function save_document()
{
	var data = $("#form-document").serialize();

	$('#jqxPopupWindowdocument').block({ 
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
		url: '<?php echo site_url("admin/customers/save_document"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_document();
				$('#jqxPopupWindowdocument').jqxWindow('close');						
				location.reload(); 
			}
			$('#jqxPopupWindowdocument').unblock();
				// location.reload();

			}
		});
	function reset_form_document()
	{
		$('#vehicle_process_id').val('');
		$('#form-document')[0].reset();
	}
}

$('#do_btn').click(function()
{
	$('#document_type').val('do')
});
$('#bluebook_btn').click(function()
{
	$('#document_type').val('bluebook')
});
$('#insurance_btn').click(function()
{
	$('#document_type').val('insurance')
});
$('#deliverysheet_btn').click(function()
{
	$('#document_type').val('delivery_sheet')
});
$('#creditnote_btn').click(function()
{
	$('#document_type').val('creditnote')
});
$('#vatbill_btn').click(function()
{
	$('#document_type').val('vatbill')
});


	//image in modal
	$('.myImg').click(function(e){ 
		$('#documentModal').show();
		$('#img01').attr('src',e.currentTarget.currentSrc)

	});

	$('.close').click(function(){
		$('#documentModal').hide();
	});

	function foc_sheet() 
	{
		var vehicle_id = $('#vehicle_id').val();

		if(vehicle_id == 12){
			$("#acc_list").jqxComboBox('selectItem', '141');
 			$("#acc_list").jqxComboBox('selectItem', '143');
		}
		if(vehicle_id == 11){
 			$("#acc_list").jqxComboBox('checkItem', '157');
 			$("#acc_list").jqxComboBox('checkItem', '158');
		}
		if(vehicle_id == 7){
			$("#acc_list").jqxComboBox('checkItem', '115');
 			$("#acc_list").jqxComboBox('checkItem', '156');
		}
		openPopupWindow('jqxPopupWindowfoc_sheet', '<?php echo "Delivery Sheet" . "&nbsp;" .  $header; ?>');
	}
	function save_foc_sheet()
	{
		var data = $("#form-foc_sheet").serialize();

		$('#jqxPopupWindowfoc_sheet').block({ 
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
			url: '<?php echo site_url("admin/customers/save_foc_doc"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success == true) {
					reset_foc_sheet();
					$("#acc_list").jqxComboBox('uncheckAll');
					$('#print-icon').show();
					// $('#jqxPopupWindowfoc_sheet').jqxWindow('close');
				}
				else if(result.success == 'approve')
				{
					if(confirm('Approval Required. Send Request?'))
					{
						$.ajax({
							url: '<?php echo site_url('customers/send_foc_request') ?>',
							type: "POST",
							data: {part_codes:result.required,customer_id:<?php echo $process_detail->id;?>,approval_type : result.approval_type},
							success: function (result) {
								var result = eval('('+result+')');
								if (result.success == true) {
									reset_foc_sheet();
									$("#acc_list").jqxComboBox('uncheckAll');
									$('#jqxPopupWindowfoc_sheet').unblock();
								}

							}
						});

					}
				}
				$('#jqxPopupWindowfoc_sheet').unblock();
			}
		});

	}

	function save_name_transfer()
	{
		var data = $("#form-name_transfer").serialize();

		$('#jqxPopupWindowname_Transfer').block({ 
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
			url: '<?php echo site_url("admin/customers/save_name_transfer"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success == true) {
					reset_name_transfer();
					$('#jqxPopupWindowname_Transfer').jqxWindow('close');
				}
				
				$('#jqxPopupWindowname_Transfer').unblock();
			}
		});

	}

	function reset_foc_sheet()
	{
		$('#form-foc_sheet')[0].reset();
		$("#acc_list").jqxComboBox('uncheckAll');
		$("#name").jqxCheckBox('uncheck')
	}

	function reset_name_transfer()
	{
		$('#form-name_transfer')[0].reset();
		$("#name").jqxCheckBox('uncheck')
	}

	function credit_note() 
	{
		openPopupWindow('jqxPopupWindowcredit_note', '<?php echo "Credit Note" . "&nbsp;" .  $header; ?>');
	}
	function name_transfer() 
	{
		openPopupWindow('jqxPopupWindowname_Transfer', '<?php echo "Name Transfer" . "&nbsp;" .  $header; ?>');
	}
</script>
