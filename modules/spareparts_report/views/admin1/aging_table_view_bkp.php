<?php print_r($rows); ?>
<div class="content-wrapper">
	<table class="table">
		<thead>
			<tr>
				<th>Product Code</th>
				<th>Product Name</th>
				<?php foreach ($rows as $key => $value):?>
					<th><?php echo $key; ?></th>
				<?php endforeach; ?>				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rows as $key => $value):?>
				<?php foreach ($value as $k => $v):?>
					<tr>
						<td><?php echo $v->part_code; ?></td>
						<td><?php echo $v->part_name; ?></td>
						<?php if($key == $v->interval_range):?>
							<td><?php echo $v->price; ?></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>				

		</tbody>
	</table>
</div>
