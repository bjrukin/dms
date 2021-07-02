<?php echo form_open('', array('id' =>'form-assign_jobcards', 'onsubmit' => 'return false')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang("floor_supervisor_id"); ?></label></div>
			<div class="col-md-8"><div id="combo_floor_supervisor" name="combo_floor_supervisor"></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang("mechanics_id") ?></label></div>
			<div class="col-md-8"><div id="combo_mechanics" name="combo_mechanics"></div></div>
		</div>
		<div class="row form-group">
			<div class="col-md-4"><label><?php echo lang("cleaner_id"); ?></label></div>
			<div class="col-md-8"><div id="combo_cleaner" name="combo_cleaner"></div></div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxAssign_JobcardSubmitButton"><?php echo lang('general_save'); ?></button>
				<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxAssign_JobcardCancelButton"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id='jobcard_group_id' name='jobcard_group'>

<?php echo form_close(); ?>


<script type="text/javascript">
	$(function(){

	});

	/*$('#form-assign_jobcards').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [ 
		{ input: '#form-assign_jobcards input[name=combo_floor_supervisor]', message: 'Required', action: 'blur', rule: 'required'}, 
		{ input: '#form-assign_jobcards input[name=combo_mechanics]', message: 'Required', action: 'blur', rule: 'required'},
		{ input: '#form-assign_jobcards input[name=combo_cleaner]', message: 'Required', action: 'blur', rule: 'required'},
		]
	});*/

	$("#jqxAssign_JobcardSubmitButton").on('click', function () {        
		saveAssign_JobcardRecord();
		/*var validationResult = function (isValid) {
			if (isValid) {
				saveAssign_JobcardRecord();
			}
		};
		$('#form-assign_jobcards').jqxValidator('validate', validationResult);*/

	});

	function saveAssign_JobcardRecord(){
		var data = $("#form-assign_jobcards").serialize();

		$('#jqxPopupWindowAssign').block({
			message: '<span>Processing your request. Please be patient.</span>',
			css: {
				width: '75%',
				border: 'none',
				padding: '50px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .7,
				color: '#fff',
				cursor: 'wait'
			},
		});

		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/job_cards/save_assign_jobcard"); ?>',
			data: data,
			success: function (result) {
				var result = eval('(' + result + ')');
				if (result.success) {
                // reset_form_dispatch_records();
                $('#jqxGridJob_card').jqxGrid('updatebounddata');
                $('#jqxPopupWindowAssign').jqxWindow('close');
            }
            $('#jqxPopupWindowAssign').unblock();
        }
    });
	}
</script>