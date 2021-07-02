<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->	
	<section class="content-header">
		<h1>
			<?php echo $process_detail->full_name; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li><a href="<?php echo site_url('admin/customers');?>"><?php echo lang('menu_customers'); ?></a></li>
			<li class="active"><?php echo lang('process_details'); ?></a></li>
		</ol>
	</section>
	<section class="content-header">
		<div class="row">
			<!-- <div class="col-md-12" ><a class="btn btn-danger btn-flat btn-sm" style="float: right;" onclick="cancelbooking()">Cancel Booking</a></div> -->
			<h3><div class="col-md-12"><label for="vehicle_name">VEHICLE :</label> <?php echo $process_detail->vehicle_name; ?></div>
				<div class="col-md-12"><label for="variant_name">VARIANT :</label> <?php echo $process_detail->variant_name; ?></div>
				<div class="col-md-12"><label for="color_name">COLOR :</label> <?php echo $process_detail->color_name; ?></div>
				<div class="col-md-12"><label for="deliverysheet_status">DELIVERY STATUS : </label> <?php echo $process_detail->delivery_sheet_status;?> <?php if($process_detail->delivery_sheet_status == "Delivered"):?> <a href="<?php echo site_url('customers/generate_document')."/".$process_detail->customer_id?>" target = "_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
					<?php if(is_admin()):?>
						<a href="<?php echo site_url('customers/delete_deliverysheet')."/".$process_detail->customer_id."/".$process_detail->vehicle_process_id."/".$process_detail->msil_dispatch_id ?>" ><i class="fa fa-remove" aria-hidden="true"></i></a>
					<?php endif ?>
				<?php endif; ?></div>
			</h3>
		</div>
	</section>
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<div id='jqxTabs'>
					<ul>
						<li style="margin-left: 30px;"><?php echo lang("process_details");?></li>
						<li><?php echo lang("payment_details");?></li>
						<li><?php echo lang("foc_details");?></li>
					</ul>
					<div class="tab_content"><?php echo $this->load->view('process_details');?></div>
					<div class="tab_content"><?php echo $this->load->view('payment_details');?></div>				
					<div class="tab_content"><?php echo $this->load->view('foc_details');?></div>				
				</div>
			</div>
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="jqxPopupWindowcancel_booking">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Cancel Booking</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-cancel_booking', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "customer_id" id = "customer_id" value="<?php echo $process_detail->id ?>" />
		<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id" value="<?php echo $process_detail->vehicle_process_id ?>"/>
		<table class="form-table">
			<tr>
				<td style="text-align: center"><textarea placeholder="Enter Reason" name="reason" style="width: 450px; height: 160px;"></textarea></td>
			</tr>
			<tr>
				<th colspan="4" style="text-align: center !important;">
					<button type="button" class="btn btn-success btn-flat btn-lg" id="jqxcancel_bookingSubmitButton"><?php echo "Yes"//lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-flat btn-lg" id="jqxcancel_bookingCancelButton"><?php echo "No"//lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<input type="hidden" name="msil_id" value="<?php echo $process_detail->msil_dispatch_id?>" id="msil_dispatch_id_script">


<script language="javascript" type="text/javascript">

	$(function(){
		var msil_dispatch_id = $('#msil_dispatch_id_script').val();
		console.log(msil_dispatch_id);
		var initWidgets = function (tab) {
			var tabName = $('#jqxTabs').jqxTabs('getTitleAt', tab);
			switch (tabName) {
				case '<?php echo lang("payment_details");?>':
				customer_statuses();
				break;		

				case '<?php echo lang("foc_details");?>':
				break;			
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

			// initialize the popup window
			$("#jqxPopupWindowcancel_booking").jqxWindow({
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

			$("#jqxPopupWindowcancel_booking").on('close', function () {
			});

			$("#jqxcancel_bookingCancelButton").on('click', function () {
				$('#jqxPopupWindowcancel_booking').jqxWindow('close');
			});
			$("#jqxcancel_bookingSubmitButton").on('click', function () {
				savecancel_booking();
			});

			$("#jqxPopupWindowdelivery_sheet").jqxWindow({
				theme: theme,
				width: '40%',
				maxWidth: '40%',
				height: '50%',
				maxHeight: '50%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			$("#jqxPopupWindowdelivery_sheet").on('close', function () {
			});

			$("#jqxdelivery_sheetCancelButton").on('click', function () {
				$('#jqxPopupWindowdelivery_sheet').jqxWindow('close');
			});		

		});

		// function cancelbooking() 
		// {
		// 	openPopupWindow('jqxPopupWindowcancel_booking', '<?php echo "Booking cancelation" . "&nbsp;" .  $header; ?>');
		// }
		// function savecancel_booking()
		// {
		// 	var data = $("#form-cancel_booking").serialize();

		// 	$('#jqxPopupWindowcancel_booking').block({
		// 		message: '<span>Processing your request. Please be patient.</span>',
		// 		css: {
		// 			width: '300',
		// 			border: 'none',
		// 			padding: '50px',
		// 			backgroundColor: '#000',
		// 			'-webkit-border-radius': '10px',
		// 			'-moz-border-radius': '10px',
		// 			opacity: .7,
		// 			color: '#fff',
		// 			cursor: 'wait'
		// 		},
		// 	});

		// 	$.ajax({
		// 		type: "POST",
		// 		url: '<?php //echo site_url("admin/customers/booking_cancel"); ?>',
		// 		data: data,
		// 		success: function (result) {
		// 			var result = eval('(' + result + ')');
		// 			if (result.success) {
		// 				reset_form_booking_cancel();
		// 				$('#jqxPopupWindowcancel_booking').jqxWindow('close');
		// 			}
		// 			$('#jqxPopupWindowcancel_booking').unblock();
		// 			window.location.replace('<?php //echo site_url('admin/customers');?>');
		// 		}
		// 	});

		// 	function reset_form_booking_cancel() 
		// 	{
		// 		$('#form-cancel_booking')[0].reset();
		// 	}
		// }
		
		function delivery_sheet() 
		{
			<?php if(is_null($process_detail->special_discount_amount ) ): ?>
				alert('Discount not provided yet');
			<?php else: ?>
				if(!msil_dispatch_id)
				{
					alert('Delivery Sheet Already Generated');
				}
				else
				{
					$('#displaychassis').html('');
					var vehicle_id = $('#vehicle_id').val();
					var variant_id = $('#variant_id').val();
					var color_id = $('#color_id').val();

					var stockrecordDatasource = {
						url : '<?php echo site_url("admin/customers/get_stock_json");?>',
						datatype: 'json',
						datafields: [
						{ name: 'chass_no', type: 'number' },
						{ name: 'stock_id', type: 'number' },
						{ name: 'msil_dispatch_id', type: 'number' },
						{ name: 'engine_no', type: 'string' },
						],
						data: {
							veh_id : vehicle_id,
							var_id : variant_id,
							color_id : color_id
						},
						async: false,
						cache: true
					}
					stockrecordDataAdapter = new $.jqx.dataAdapter(stockrecordDatasource);

					$("#chass_no").on('select', function (event) {
						if (event.args) {
							var item = event.args.item;
							if (item) {					
								$("#engine_no").val(item.label);
								$('#stock_id').val(item.originalItem.stock_id);
								$('#msil_dispatch_id').val(item.originalItem.msil_dispatch_id);
								var labelelement = $("<div></div>");
								labelelement.html(item.value);
								$("#displaychassis").children().remove();
								$("#displaychassis").append(labelelement);
							}				
						}
					});

					$("#chass_no").jqxComboBox({
						theme: theme,
						width: 195,
						height: 25,
						selectionMode: 'dropDownList',
						autoComplete: true,
						searchMode: 'containsignorecase',
						source: stockrecordDataAdapter,
						displayMember: "engine_no",
						valueMember: "chass_no",
					});

					openPopupWindow('jqxPopupWindowdelivery_sheet', '<?php echo "Delivery Sheet" . "&nbsp;" .  $header; ?>');
				}
			<?php endif; ?>
		}

	</script>
