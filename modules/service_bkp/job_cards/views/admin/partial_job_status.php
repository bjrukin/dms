
<div id="jqxPopupWindowJobCardStatus">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Job Close</span>
	</div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<form id="form-jobcard_status">
					<fieldset>
						<legend>Details</legend>
						<div class="row form-group">
							<div class="col-md-2">Job No.</div>
							<div class="col-md-4"><input type="text" name="jobcard_group" class="form-control" readonly></div>
							<div class="col-md-2">Chassis No.</div>
							<div class="col-md-4"><input type="text" name="chassis_no" class="form-control" readonly></div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">Vehicle No.</div>
							<div class="col-md-4"><input type="text" name="vehicle_no" class="form-control" readonly></div>
							<div class="col-md-2">Engine No.</div>
							<div class="col-md-4"><input type="text" name="engine_no" class="form-control" readonly></div>
						</div>
					</fieldset>
					<div class="col-md-4">
						<table class="table table-bordered table-striped">
							<tr class="info">
								<th>Job</th>
								<th>Status</th>
							</tr>

						</table>
					</div>
					<div class="col-md-8">
						<fieldset>
							<div class="row form-group">
								<div class="col-md-7">Mechanic</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">

								<div class="col-md-7">Job Card Status</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">
								<div class="col-md-7">Labour Amount as per Job Card</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">
								<div class="col-md-7">Parts Amount as per Job Card</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">
								<div class="col-md-7">Parts Amount as per Material Issue</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">
								<div class="col-md-7">Job Opening Date and Time</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">
								<div class="col-md-7">Work Allocation Date and Time</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
							<div class="row form-group">
								<div class="col-md-7">Job Closing Date and Time</div>
								<div class="col-md-5"><input type="text" name="" class="form-control" readonly></div>
							</div>
						</fieldset>
					</div>
				</form>
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-default btn-flat">Exit</button>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$("#jqxPopupWindowJobCardStatus").jqxWindow({ 
			theme: theme,
			width: '65%',
			maxWidth: '65%',
			height: '70%',  
			maxHeight: '70%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.2,
			showCollapseButton: false 
		});

		$('.job-status').on('click',function(){
			var jobno = $(this).val();
			$.post('<?php echo site_url("job_cards/get_job_status")?>',{jobcard_group: jobno},function(result){
				if(result.success) {

					$("#form-jobcard_status").find('input').val(function(i,v){
						return result.details[this.name];
					});
					var tr_string;
					var image_check = '<i class="fa fa-check text-success" aria-hidden="true" ></i>';
					var image;

					if(result.status.jobcard == 'TRUE') image = image_check;
					else image = '';
					tr_string += "<tr><td>Job Card</td><td>"+image+"</td></tr>";
					if(result.status.material == 'TRUE') image = image_check;
					else image = '';
					tr_string += "<tr><td>Material Issued</td><td>"+image+"</td></tr>";
					if(result.status.outside_work == 'TRUE') image = image_check;
					else image = '';
					tr_string += "<tr><td>Outside Work</td><td>"+image+"</td></tr>";
					if(result.status.closedstatus == 'TRUE') image = image_check;
					else image = '';
					tr_string += "<tr><td>Job Closed</td><td>"+image+"</td></tr>";
					if(result.status.billinvoice == 'TRUE') image = image_check;
					else image = '';
					tr_string += "<tr><td>Invoice Issued</td><td>"+image+"</td></tr>";

					$('#form-jobcard_status table').html('<tr class="info"> <th>Job</th> <th>Status</th> </tr>');
					$('#form-jobcard_status table').append(tr_string);
					openPopupWindow('jqxPopupWindowJobCardStatus');
				}

			},'JSON');
		});
	});
</script>