<style type="text/css">
	
     .jobpage{            page-break-after: always;      padding-left: 304px;      page-break-before: always;        }        table td{            font-size: 12px;        }    

</style>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $jobcard->full_name; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li><a href="<?php echo site_url('admin/job_cards');?>"><?php echo lang('menu_job_cards'); ?></a></li>
			<li class="active"><?php echo lang('jobcard_details_view'); ?></a></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div id='jqxTabs_jobcardDetailsView'>
					<ul>
						<li style="margin-left: 30px;"><?php echo lang("customer_details");?></li>
						<li><?php echo lang("job_and_materials");?></li>
						<li><?php echo lang("advised_materials");?></li>
						<li><?php echo lang("outsideworks");?></li>
						<li><?php echo lang("job_card_billing");?></li>
					</ul>
					<div class="tab_content">
						<div class="col-md-12">
							<fieldset>
								<legend>Details (Closed status: <?php echo $jobcard->closed_status; ?>)</legend>
								<div class="row form-group">
									<div class="col-md-3"><label>Dealer Name: </label></div>
									<div class="col-md-3"> <?php echo $jobcard->dealer_name ?> </div>
									<div class="col-md-3"><label>Date</label></div>
									<div class="col-md-3"><?php echo $jobcard->jobcard_issue_date; ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"> <label>Service Advisor</label></div>
									<div class="col-md-3"> <?php echo $jobcard->service_advisor_name; ?></div>
									<div class="col-md-3"> <label>JobCard No.</label></div>
									<div class="col-md-3"> <?php echo "JC-".sprintf('%05d', $jobcard->jobcard_serial) ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"> <label>Service Type</label></div>
									<div class="col-md-3"> <?php echo "{$jobcard->service_type_name} - {$jobcard->service_count}"; ?></div>
									<div class="col-md-3"> <label></label></div>
									<div class="col-md-3"> <?php  ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"> <label>Vehicle No.</label></div>
									<div class="col-md-3"> <?php echo $jobcard->vehicle_no; ?></div>
									<div class="col-md-3"> <label>Chassis No.</label></div>
									<div class="col-md-3"> <?php echo $jobcard->chassis_no; ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"> <label>Engine No</label></div>
									<div class="col-md-3"> <?php echo $jobcard->engine_no; ?></div>
									<div class="col-md-3"> <label></label></div>
									<div class="col-md-3"> <?php  ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label>Vehicle Name</label></div>
									<div class="col-md-3"><?php echo $jobcard->vehicle_name. " " . $jobcard->variant_name; ?></div>
									<div class="col-md-3"><label>Color</label></div>
									<div class="col-md-3"><?php echo $jobcard->color_name; ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label>FloorSupervisor Name</label></div>
									<div class="col-md-3"><?php echo $jobcard->floor_supervisor_name; ?></div>
									<div class="col-md-3"><label>Mechanic Name</label></div>
									<div class="col-md-3"><?php echo $jobcard->mechanic_name; ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label>GearBox</label></div>
									<div class="col-md-3"><?php echo $jobcard->gear_box_no; ?></div>
									<div class="col-md-3"><label>Key</label></div>
									<div class="col-md-3"><?php echo $jobcard->key_no; ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label>KMS</label></div>
									<div class="col-md-3"><?php echo $jobcard->kms; ?></div>
									<div class="col-md-3"><label>Fuel</label></div>
									<div class="col-md-3"><?php echo $jobcard->fuel; ?></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label>Coupon</label></div>
									<div class="col-md-3"><?php echo $jobcard->coupon; ?></div>
									<div class="col-md-3"></div>
									<div class="col-md-3"></div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Customer Details</legend>
								<div class="row  form-group">
									<div class="col-md-3"><label>Name</label></div>
									<div class="col-md-3"><?php echo $jobcard->full_name; ?></div>
									<div class="col-md-3"><label>Address</label></div>
									<div class="col-md-3"><?php echo $jobcard->address1; ?></div>
								</div>
								<div class="row  form-group">
									<div class="col-md-3"><label></label></div>
									<div class="col-md-3"><label></label></div>
									<div class="col-md-3"></div>
									<div class="col-md-3"><?php echo $jobcard->address2; ?><?php echo $jobcard->address3; ?></div>
								</div>
								<div class="row  form-group">
									<div class="col-md-3"><label>Email</label></div>
									<div class="col-md-3"><?php echo $jobcard->email; ?></div>
									<div class="col-md-3"><label>Phone No</label></div>
									<div class="col-md-3"><?php echo $jobcard->phone_no. ", " .$jobcard->mobile; ?></div>
								</div>
								<div class="row  form-group">
									<div class="col-md-3"><label>Reciever Name</label></div>
									<div class="col-md-3"><?php echo $jobcard->reciever_name; ?></div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="tab_content">
						<div class="col-md-12">
							<!-- <fieldset> -->
								<h4><?php echo "JC-".sprintf('%05d', $jobcard->jobcard_serial); ?></h4>
								<table class="table table-striped table-responsive">
									<thead>
										<tr class="info">
											<th>Customer Voice</th>
											<th>Advisor Voice</th>
											<th>Job Code</th>
											<th>Description</th>
											<th>Price</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($job_details as $key => $value): ?>
											<tr>
												<td><?php echo $value->customer_voice; ?></td>
												<td><?php echo $value->advisor_voice; ?></td>
												<td><?php echo $value->job; ?></td>
												<td><?php echo $value->job_description; ?></td>
												<td><?php echo $value->customer_price; ?></td>
												<td><?php echo $value->status; ?></td>
											</tr>
										<?php endforeach; ?>

									</tbody>
								</table>
								<!-- </fieldset> -->
							</div>
							<div class="col-md-12">
<br>
								<!-- <fieldset> -->
									<h4><?php echo "MI-".sprintf('%05d', @$job_materials[0]->material_issue_no) ?></h4>
									<table class="table table-striped table-responsive table-bordered">
										<thead>
											<tr class="info">
												<th>Part Name</th>
												<th>Part Code</th>
												<th>Quantity</th>
												<th>Issued Date</th>
												<th>Warranty</th>
												<th>Consumable</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($job_materials as $key => $value): ?>
												<tr <?php echo ($value->is_consumable)?"class='success'":''; ?>>
													<td><?php echo $value->part_name; ?></td>
													<td><?php echo $value->part_code; ?></td>
													<td><?php echo $value->quantity; ?></td>
													<td><?php echo $value->issue_date; ?></td>
													<td><?php echo $value->warranty; ?></td>
													<td><?php echo ($value->is_consumable)?"<i class='fa fa-check'></i>":""; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<!-- </fieldset> -->
								</div>
							</div>
							<div class="tab_content">
								<div class="col-md-12">
									<!-- <fieldset> -->
										<table class="table table-striped table-responsive table-bordered">
											<thead >
												<tr class="info">
													<th>Parts Name</th>
													<th>Quantity</th>
													<th>Dispatched Qty</th>
													<th>Received Qty</th>
													<th>Returned Qty</th>
													<th>Received Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($job_supervisor_adviced as $key => $value): ?>
													<tr>
														<td><?php echo $value->part_name; ?></td>
														<td><?php echo $value->quantity; ?></td>
														<td><?php echo $value->dispatched_quantity; ?></td>
														<td><?php echo $value->received_quantity; ?></td>
														<td><?php echo $value->return_quantity; ?></td>
														<td><?php echo $value->received_status; ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<!-- </fieldset> -->
									</div>
								</div>
								<div class="tab_content"><?php //echo $this->load->view('partial_customer_test_drives');?></div>
								<div class="tab_content">
									<div class="jobpage" >

											<div class="btn-group btn-group-sm">
												<button class="btn btn-default btn-flat " id="" onclick="printPage(jobdetailPage.innerHTML)">Print</button>
											</div>
											<div id="jobdetailPage">
												<table cellspacing="0" cellpadding="0" width="750px">
													<!-- ------------- Header Starts ------------- -->
													<tr>
														<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo $jobcard_billing_details->dealer_name; ?></h2> </td>
													</tr>
													<tr>
														<td colspan="8" style="text-align:center;"> <?php echo $jobcard_billing_details->address1; ?>, <?php echo $jobcard_billing_details->address2; ?></td>
													</tr>
													
													<tr>
														<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;">Job Card Billing</td>
													</tr>
													<!-- -------------- Header Ends -------------- -->

													<!-- <?php //print_r($jobcard); ?> -->

													<!-- --------- Doc No Section Starts --------- -->


													<?php if(!$jobcard_billing_details):?>


													<?php else:?>

																<tr>
														<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
														<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$jobcard_billing_details->invoice_prefix. " TI-". sprintf('%05d', $jobcard_billing_details->invoice_no); ?></td>
														<td style="padding-top:20px">Date</td>
														<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$jobcard_billing_details->created_at; ?></td>
													</tr>
													<tr>
														<td colspan="2" style="">Party Name</td>
														<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo $jobcard_billing_details->customer_name; if($jobcard_billing_details->reciever_name) echo "({$jobcard_billing_details->reciever_name})"; ?></td>
														<td colspan="">Job Card No.</td>
														<td colspan="2" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo "JC-".sprintf('%05d',$jobcard_billing_details->jobcard_serial); ?></td>
													</tr>
													<tr>
														<td colspan="2" style="padding-top:20px">Model</td>
														<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$jobcard_billing_details->vehicle_name." ".@$jobcard_billing_details->variant_name ; ?></td>
														<td colspan="" style="padding-top:20px">Vehicle No.</td>
														<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$jobcard_billing_details->vehicle_no; ?></td>
													</tr>
													<tr>
														<td colspan="2" style="padding-top:5px">Engine No.</td>
														<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo @$jobcard_billing_details->engine_no; ?></td>
														<td colspan="" style="padding-top:5px">Chassis No.</td>
														<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo @$jobcard_billing_details->chassis_no; ?></td>
													</tr>
													<tr>
														<td colspan="8" style="padding-top: 20px">Dear sir, <br> We are submitting our prices of Spare Parts and Labour charges as required for you Vehicle.</td>
													</tr>
													<!-- ---------- Doc No Section Ends ---------- -->

												</table>
												<table cellspacing="0" cellpadding="0" width="750px">
													<!-- --------- Detail Section Starts --------- -->
													<tr>
														<td colspan="9" style="border-bottom-style: groove;padding-bottom:20px"></td>
													</tr>
													<tr>
														<td  style="padding-top:5px;">S.No</td>
														<td style="padding-top:5px;padding-left:20px">Job No.</td>
														<td colspan="2" style="padding-top:5px;padding-left:20px">Description</td>
														
														<td style="padding-top:5px;padding-left:20px">Payment Method</td>
														<td style="padding-top:5px;padding-left:20px">Discount %</td>
														<td style="padding-top:5px;padding-left:20px">Discount Amount</td>
														<td style="padding-top:5px;padding-left:20px">Parts Amount</td>
														<td style="padding-top:5px;padding-left:20px">Final Amount</td>
													</tr>
													
												
														<tr>
															<td style="padding-top:10px;">1.</td>
															<td style="padding-top:10px;padding-left:20px"><?php echo @$jobcard_billing_details->jobcard_serial; ?></td>
															<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo @$jobcard_billing_details->job_description; ?></td>
															<td style="padding-top:10px;padding-left:20px"><?php echo @$jobcard_billing_details->payment_type; ?></td>
															<td style="padding-top:10px;padding-left:20px"><?php echo @$jobcard_billing_details->cash_discount_percent; ?></td>
															<td style="padding-top:10px;padding-left:20px"><?php echo @$jobcard_billing_details->cash_discount_amt; ?></td>
															<td style="padding-top:10px;padding-left:20px"><?php echo @$jobcard_billing_details->total_parts; ?></td>
															<td style="padding-top:10px;padding-left:20px;text-align: right;padding-right:10px"><?php echo @$jobcard_billing_details->final_amount; ?></td>
														</tr>
													
													<!--Job Detail Ends-->
												</table>

												<table cellspacing="0" cellpadding="0" width="750px">

													<!------------ Detail Section Ends ------------>
													<tr>
														<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
													</tr>

													<!----- Price Calculation Section Starts ------>
													<tr>
														<td colspan="6" width="400px"></td>
														<td style="padding-top:30px;">Total Parts</td>
														<td style="padding-top:30px;text-align: right; padding-right: 5px;"><?php echo @$jobcard_billing_details->total_parts; ?></td>
													</tr>
													<tr>
														<td colspan="6"></td>
														<td style="padding-top:10px;">Total Jobs</td>
														<td style="padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard_billing_details->total_jobs; ?></td>
													</tr>
													<tr>
														<td colspan="6"></td>
														<td >Cash</td>
														<td style="padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard_billing_details->cash_discount_amt; ?></td>
													</tr>
													<tr>
														<td colspan="6"></td>
														<td >Discount</td>
														<td style="padding-top:10px;text-align: right; padding-right: 5px;">0</td>
													</tr>
													<tr>
														<td colspan="6"></td>
														<td style="border-bottom-style: groove;" >VAT</td>
														<td style="border-bottom-style: groove;padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard_billing_details->vat_parts + @$has_billed->vat_job; ?></td>
													</tr>
													<tr>
														<td colspan="6"></td>
														<td style="border-bottom-style: groove;" >Net Amount</td>
														<td style="border-bottom-style: groove;padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard_billing_details->net_total; ?></td>
													</tr>
													<!-- ---- Price Calculation Section Ends ----- -->



													<!-- --------- List Section Starts ----------- -->
													<tr>
														<td colspan="8" style="padding-top:30px;font-size: 0.75em">
															<ul style="padding-left: 18px">
																<li>ALL RATES MENTIONED ABOVE ARE EXCLUSIVE OF TAXES</li>
																<li>DURING VEHICLE MAINTENANCE IF ADDITIONAL INNER PARTS OF THE VEHICLE ARE FOUND TO BE DAMAGED WHICH HAVE NOT BEEN MENTIONED IN THE     QUOTATION AND NEED TO BE REPLACED THOSE PARTS WILL BE MENTIONED IN THE FINAL BILL AND THE CUSTOMER IS LIABLE TO PAY FOR THOSE PARTS</li>
															</ul>
														</td>
													</tr>
													<!-- ---------- List Section Ends ------------ -->



													<!-- ------- Signature Section Starts -------- -->
													<tr>
														<td colspan="4">
															<p style="padding-top:30px">--------------------------</p>
														</td>
														<td colspan="4">
															<p style="padding-top:30px;padding-left:150px;text-align: right;">---------------------------</p>
														</td>
													</tr>
													<tr>
														<td colspan="4">
															<p style="padding:0px; margin: 0px">Reciever's Signature</p>
														</td>
														<td colspan="4">
															<p style="padding:0px; margin: 0px;padding-left:160px;text-align: right;">Authorised Signatory</p>
														</td>
													</tr>
													<tr>
														<!-- <td colspan="8" style="border-bottom-style: dotted;padding-bottom:10px"></td> -->
													</tr>
													<!-- ------- Signature Section Ends ---------- -->
													<?php endif;?>
												
												</table>
											</div>
										</div>
									
								</div>
							</div>
						</div>
					</div>
					<!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<script language="javascript" type="text/javascript">

				$(function(){
					var initWidgets = function (tab) {
						var tabName = $('#jqxTabs_jobcardDetailsView').jqxTabs('getTitleAt', tab);
						switch (tabName) {
							default:
							break;
						}
					};

					$('#jqxTabs_jobcardDetailsView').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

				});
				
				function printPage(printContent) { 
				
				var display_setting="toolbar=yes,menubar=yes,"; 
			display_setting+="scrollbars=yes,width=650, height=600, left=100, top=25"; 


				var printpage=window.open("","",display_setting); 
				printpage.document.open(); 
				printpage.document.write('<html><head><title>Print Page</title></head>'); 
				printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>'); 
				printpage.document.close(); 
				printpage.focus(); 
				} 
			</script>
