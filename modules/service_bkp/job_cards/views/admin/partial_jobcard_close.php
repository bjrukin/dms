<div id="jqxPopupWindowCloseJobCard">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Job Close</span>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php echo form_open('', array('id' =>'form-close_jobcard', 'onsubmit' => 'return false')); ?>
			<fieldset>
				<legend>Job Card</legend>
				<div class="row form-group">
					<div class="col-md-3">Job Card No.</div>
					<div class="col-md-5"><input type="text" name="jobcard_group" class="form-control" readonly ></div>
				</div>
				<div class="row form-group">
					<!-- <div class="col-md-3">Date</div> -->
					<!-- <div class="col-md-5"><div name="date" class="date form-control" ></div></div> -->
					<div class="col-md-4"> <button type="button" class="btn btn-default btn-flat job-status" value="" >Job Status</button></div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<label for="close_jobcard-send_sms"><input type="checkbox" name="send_sms" id="close_jobcard-send_sms" value="1">Send SMS after save</label>
					</div>
				</div>
			</fieldset>
			<?php echo form_close(); ?>
			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-primary btn-flat" id="btn-close_jobcard"> Close Job Card</button>
					<button type="button" class="btn btn-default btn-flat"> Exit</button>
				</div>
			</div>

		</div>
	</div>
</div>


<div id="jqxPopupWindowReopenJob">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="reopen_window_poptup_title"></span>
	</div>

	<div>
		<div class="row">
			<div class="col-md-12">
				<form id="form-jobcard_reopen">

					<div class="form_fields_area" id="reopen_form">
						<div class="row form-group">
							<div class="col-md-3">Job Card No.</div>
							<div class="col-md-5"><input type="text" name="jobcard_group" class="form-control" readonly ></div>
						</div>
						<div class="row">
							<div class="col-md-2"><label><?php echo lang('reopen_reason')?></label></div>
							<div class="col-md-7"><input type="text" name="reason" id="reopen_reason" class="form-control" required></div>
							<div class="col-md-2"><button type="button" class="btn btn-default btn-flat job-status" value="" onclick="asdfds()" >Job Status</button></div>
						</div>
						<!-- <input type="hidden" name="jobcard_group" id="reopen_job_index"> -->
					</div>
				</form>

				<button class="btn btn-primary btn-flat" id="btn-jobcard_reopen">Reopen Jobcard</button>
				<button class="btn btn-default btn-flat" id="close_detail">Close</button>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// initialize function
	$(function(){
		$("#jqxPopupWindowCloseJobCard").jqxWindow({ 
			theme: theme,
			width: '45%',
			maxWidth: '50%',
			height: '45%',  
			maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.2,
			showCollapseButton: false 
		});

		$("#jqxPopupWindowReopenJob").jqxWindow({ 
			theme: theme,
			width: '40%',
			maxWidth: '40%',
			height: '35%',  
			maxHeight: '35%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		// $(".date").jqxDateTimeInput({ width: '80%',formatString: "yyyy-MM-dd hh:mm" });


	});
	// END initialize function

	function close_job(index){
		var job = $('#jqxGridJob_card').jqxGrid('getrowdata', index);
		// console.log(job);

		$('#form-close_jobcard input[name="jobcard_group"]').val(job.jobcard_group);
		$('.job-status').val(job.jobcard_group);
		openPopupWindow('jqxPopupWindowCloseJobCard');
		/*if(confirm('Do you want to close this job?')){
			$.post('<?php echo site_url("job_cards/job_status")?>',{ job:job, status: '<?php echo JOB_CLOSE?>' }, function(data){
				$('#jqxGridJob_card').jqxGrid('refresh');
			},'json');
		}*/
	}

	function reopen_job_form(index){
		$('#reopen_job_index').val(index);

		var job = $('#jqxGridJob_card').jqxGrid('getrowdata', index);
		$('.job-status').val(job.jobcard_group);
		$('#form-jobcard_reopen input[name="jobcard_group"]').val(job.jobcard_group);

		$('#reopen_window_poptup_title').html('<?php echo lang('reopen_title')?>');
		openPopupWindow('jqxPopupWindowReopenJob');
	}

	$('#btn-jobcard_reopen').click(function(){
		var data = getFormData('form-jobcard_reopen');
		if(data.reason == '') {
			alert("Reason required");
			return;
		}

		if(confirm('Do you want to reopen this job?')){
			$.post('<?php echo site_url("job_cards/job_status")?>',{ data:data, status: <?php echo JOB_REOPEN ?> }, function(result){
				if(result.success == false)
				{
					alert(result.msg);
					return;
				}
				$('#jqxGridJob_card').jqxGrid('updatebounddata');
				$('#jqxPopupWindowReopenJob').jqxWindow('hide');
			},'json');
		}
	});

	$('#btn-close_jobcard').click(function(){
		var data = getFormData('form-close_jobcard');
		if(confirm('Confirm to close this job?')){
			$.post('<?php echo site_url("job_cards/job_status")?>',{ data:data, status: <?php echo JOB_CLOSE ?> }, function(result){
				if(result.success == false){
					return;
				}
				$('#jqxGridJob_card').jqxGrid('updatebounddata');
				$('#jqxPopupWindowCloseJobCard').jqxWindow('hide');
			},'json');
		}
	});


</script>