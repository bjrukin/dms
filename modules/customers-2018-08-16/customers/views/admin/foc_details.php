<?php
if(is_admin()): 
	if(isset($foc_details->foc_request_id)):?>
	<h4><a href="<?php echo site_url('admin/customers/cancel_foc_document') ?>/<?php echo $foc_details->foc_request_id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a> Cancel FOC</h4>
<?php endif; endif;?>
<fieldset>
	<?php if( ! $error_msg):?>
		<div class="row">
			<div class="col-md-12">
				<h4>FOC DETAILS</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label> Fuel </label>
			</div>
			<div class="col-md-10">
				: <?php echo $foc_details->fuel;?> ltr
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label> Free Servicing </label>
			</div>
			<div class="col-md-10">
				: <?php echo $foc_details->free_servicing;?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label> Road Tax </label>
			</div>
			<div class="col-md-10">
				: Rs.<?php echo $foc_details->road_tax;?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label> Name Transfer </label>
			</div>
			<div class="col-md-10">
				: <?php if($foc_details->name_transfer == 1):?>
				Transfered
			<?php else: ?>
				Not Transfered
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<label> Accessories </label>
		</div>
		<div class="col-md-10">
			<table>
				<?php foreach ($accessories as  $value): ?>
					<tr>
						<td><?php echo $value->name; ?></td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
	<h3> <a href="<?php echo site_url('admin/customers/foc_document')?>/<?php echo $process_detail->id ?>" target="_blank" id="print-icon"><i class="fa fa-print fa-lg" aria-hidden="true"></i>Print</a></h3>
<?php else: ?>
	<div class="row">
		<div class="col-md-12">
			<h2><?php echo $error_msg;?></h2>
		</div>
	</div>
<?php endif; ?>
</fieldset>