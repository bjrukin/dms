<form method="post" action="<?php echo site_url('sparepart_orders/custom_changes/save_recent_dispatch')?>">
	<select name="dealer" class="form-control">
		<option value="">--choose dealer--</option>
		<?php foreach ($dealers as $key => $value) {?>
			<option value="<?php echo $value->id?>"><?php echo $value->name?></option>
		<?php }?>
	</select>
	<input type="submit">
</form>