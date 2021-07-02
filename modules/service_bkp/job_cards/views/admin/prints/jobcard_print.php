<!DOCTYPE html>
<html>
<head>
	<title>Job Card</title>
	
</head>
<body>
	<table cellspacing="0" cellpadding="0" width="750px">
		<tr>
			<td colspan="6" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:center;"> Corporate Office: <?php echo $workshop->address1; ?> </td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:center;"> Tel No: <?php echo $workshop->phone1; ?> </td>
		</tr>

		<tr>
			<td colspan="6" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"> Job Card </td>
		</tr>
				
		<tr>
			<td colspan="" style="font-weight:bold;padding-top:20px; width: 100px;">Job No.</td>
			<td colspan="2" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->jobcard_group ?></td>
			<td colspan="2" style="padding-top:20px;padding-left:160px">Job Date</td>
			<td style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->created_at; ?></td>
		</tr>
		<tr>
			<td colspan=""></td>
			<td colspan="2"></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Job Time</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->created_at; ?></td>
		</tr>
		<tr>
			<td colspan="" style="font-weight:bold">Model</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_name." ".$customer->variant_name ; ?></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Colour</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->color_name; ?></td>
		</tr>
		<tr>
			<td colspan="" style="font-weight:bold">Service</td>
			<td colspan="2"><span style="padding-right:10px">:</span>FREE FIRST</td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Coupon</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span>31513</td>
		</tr>
		<tr>
			<td colspan="" style="">Vehicle No.</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_no; ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Chassis No</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->chassis_no; ?></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Fuel</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->fuel; ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Engine No.</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->engine_no; ?></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">KMs</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->kms; ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Gear Box No.</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->gear_box_no; ?></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px"><!-- Coupon --></td>
		</tr>
		<tr>
			<td colspan="" style="">Sell. Dealer</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->sell_dealer; ?> </td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Sold On</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_sold_on; ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Delv Date</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->delivery_date; ?></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Delv Time</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->delivery_date; ?></td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>

		<tr>
			<td colspan="" style="font-weight:bold">Customer</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->full_name ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Address</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->address1 ?></td>
		</tr>
		<tr>
			<td colspan="" style=""></td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->address2 ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Mobile/SMS</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->mobile; ?></td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>


		<!-- JOBS -->
		<tr>
			<td  style="width:50px;text-align:center;vertical-align:top;padding-top:20px">S.No</td>
			<td colspan="3" style="width:500px;padding-top:20px;">Work To Be Done</td>
			<td colspan="2" style="width:100px;padding-top:20px;">Customer Voice</td>
		</tr>
		<?php foreach ($jobcard as $key => $value): ?>
			<tr>
			<td style="padding-top:20px;text-align:center;vertical-align:top;padding-top:20px"><?php echo ++$key; ?></td>
				<td colspan="3" style="width:80px;padding-top:20px"> <?php echo $value->job_description ?></td>
				<td colspan="2" style="vertical-align:top;padding-top:20px"> <?php echo $value->customer_voice; ?> </td>
			</tr>
		<?php endforeach; ?>
		<!-- END JOBS -->


		<tr>
			<td colspan="6" style="padding-top:20px;">
				(The Dealer will not be responsible for any damage to the vehicle during repair, testing and storage.)
			</td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>

		<tr>
			<td colspan="" style="font-weight:bold">SuperVisor</td>
			<td colspan="2"><span style="padding-right:10px">:</span>ALTO-800 </td>
			<td colspan="2" style="padding-top:10px;padding-left:160px">Customer</td>
			<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $customer->full_name ?></td>
		</tr>
		<tr>
			<td colspan="" style="font-weight:bold">Mechanic</td>
			<td colspan="2"><span style="padding-right:10px">:</span>ALTO-800 </td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: center;padding-top: 15px">SATISFACTION NOTE</td>
		</tr>
		<tr >
			<td colspan="6" style="text-align: center;">My Vehicle is duly serviced/repaired to my entire satisfaction.</td>
		</tr>
		<tr>
			<td colspan="3">
				<p style="padding-top:30px">--------------------------</p>
			</td>
			<td colspan="3">
				<p style="padding-top:30px;padding-left:150px;text-align: right;">---------------------------</p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<p style="padding:0px; margin: 0px">Supervisor Signature</p>
			</td>
			<td colspan="3">
				<p style="padding:0px; margin: 0px;padding-left:160px;text-align: right;">Customer Signature</p>
			</td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>

		<tr>
			<td colspan="6" style="text-align:center;padding-top:10px"><?php echo $workshop->name; ?></td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:center;padding:0px">Reciept of Vehicles</td>
		</tr>
		<tr>
			<td colspan="" style="">Job No.</td>
			<td colspan="2"><?php echo $customer->jobcard_group ?></td>
			<td colspan="" style="    text-align: right;">Delivery on </td>
			<td colspan="2" style="text-align: right;">17/07/2016 at 20:00 </td>
		</tr>
		<tr>
			<td colspan="6">I have received  <?php echo $customer->vehicle_name." ".$customer->variant_name ; ?> (<?php echo $customer->vehicle_no; ?>) </td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: right;">---------------------------</td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: right;">Customer Signature</td>
		</tr>
		<tr>
			<td colspan="6">Please bring this receipt at the time of collecting your Vehicle.</td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>
		<tr>
			<td colspan="6">
				<p style="padding-top:5px;font-weight:bold">E. & O.E.</p>
			</td>
		</tr>
	</table>
</body>
</html>