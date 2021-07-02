<?php 
		$data['jobcard_group'] 	= $job_detail['jobcard_group'];
		$data['vehicle_id'] 	= $job_detail['vehicle_id'];
?>

<fieldset>
  	<legend>Vehicle Detail:</legend>
	<b>vehicle_reg_no: </b> <?php echo $vehicle_detail['0']->vehicle_register_no?><br>
	<b>model: </b> <?php echo $vehicle_detail['0']->vehicle_name?><br>
	<b>variant: </b> <?php echo $vehicle_detail['0']->variant_name?><br>
	<b>color: </b> <?php echo $vehicle_detail['0']->color_name?><br>
</fieldset>

<?php $this->load->view($this->config->item('template_admin') . 'job_table');?>
<hr>
Material Required
<?php $this->load->view($this->config->item('template_admin') . 'estimate_part_table',$data);?>



