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
									<div class="col-md-3"> <label>Vehicle Sold On</label></div>
									<div class="col-md-3"> <?php  echo $jobcard->vehicle_sold_on ?></div>
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
													<th>SN</th>
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
														<td><?php echo $key+ 1; ?></td>
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

			</script>
