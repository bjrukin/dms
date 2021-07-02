
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
 			<?php foreach ($parts as $key => $value):?>
 				<tr>
 					<td><?php echo $value['part_code']; ?></td>
 					<td><?php echo $value['part_name']; ?></td>

 					<?php foreach ($rows as $k => $v):?>
 						<?php if(array_key_exists($value['part_code'], $v)):?>
 							<?php $part_code = $value['part_code']?>
 							<td><?php echo $v[$part_code]['remaining_quantity'].'|'.($v[$part_code]['total_amount']); ?></td>
 						<?php else: ?>
 							<td>0|0</td>
 						<?php endif;?>
 					<?php endforeach; ?>
 				</tr>
 			<?php endforeach; ?>				

 		</tbody>
 	</table>
 </div>
