<!DOCTYPE html>
<html>
<head>
	<title><?php echo $header; ?></title>
	
</head>
<body>
	<table cellspacing="0" cellpadding="0" width="750px">
		<tr>
			<td colspan="6" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
		</tr>
		<tr>
			<td colspan="6" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
		</tr>

		<tr>
			<td colspan="" style="font-weight:bold;padding-top:20px; width: 100px;">MIssue No.</td>
			<td colspan="2" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php //echo $jobcard[0]->jobcard_group ?></td>
			<td colspan="2" style="padding-top:20px;padding-left:160px">Date</td>
			<td style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $parts[0]->created_at; ?></td>
		</tr>
		<tr>
			<td colspan="">Job Card No.</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->jobcard_group; ?></td>
			<td colspan="2" style="padding-top:10px;padding-left:160px"></td>
			<td  style="padding-top:10px"></td>
		</tr>
		<tr>
			<td colspan="" style="">Vehicle No.</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_no; ?></td>
		</tr>
		<tr>
			<td colspan="" style="">Party Name</td>
			<td colspan="2"><span style="padding-right:10px">:</span><?php echo $customer->full_name; ?></td>
		</tr>
		<tr>
			<td colspan="6" style="padding-bottom:10px"></td>
		</tr>
		<tr>
			<td colspan="6" style="padding-top: 30px">I/We received material against Job Card No. 2 detail as per following- </td>
		</tr>
		<tr>
			<td colspan="" style="padding-top: 30px">Mechanic: </td>
			<td colspan="" style="padding-top: 30px"><span style="padding-right:10px">:</span>ssdfsdf</td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>

		<!-- Parts -->
		<tr>
			<td  style="padding-top:20px;width: 15px;">S.No</td>
			<td colspan="" style="padding-top:20px;">Part No.</td>
			<td colspan="" style="padding-top:20px;">Part Name</td>
			<td colspan="" style="padding-top:20px;">Bin</td>
			<td colspan="" style="padding-top:20px;">TM</td>
			<td colspan="" style="padding-top:20px;">Qty.</td>
			<td colspan="" style="padding-top:20px;">Price</td>
			<td colspan="" style="padding-top:20px;">Amount</td>
		</tr>
		<?php foreach ($parts as $key => $value): ?>
			<tr>
				<td style="padding-top:20px;"><?php echo ++$key; ?></td>
				<td colspan="" style="width:80px;padding-top:20px"> <?php echo $value->part_code ?></td>
				<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->part_name; ?> </td>
				<td colspan="" style="vertical-align:top;padding-top:20px"> <?php //echo $value->part_name; ?> </td>
				<td colspan="" style="vertical-align:top;padding-top:20px"> <?php //echo $value->part_name; ?> </td>
				<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->quantity; ?> Pcs.</td>
				<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->price; ?></td>
				<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->final_amount; ?></td>
			</tr>
		<?php endforeach; ?>
		<!-- END Parts -->
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Total Amount</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>Amount</td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>


		<tr>
			<td colspan="6" style="padding-top:20px;">
				Remarks	: <?php echo $parts[0]->narration; ?>
			</td>
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
				<p style="padding:0px; margin: 0px">Reciever's Signature</p>
			</td>
			<td colspan="3">
				<p style="padding:0px; margin: 0px;padding-left:160px;text-align: right;">Authorised Signatory</p>
			</td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>

	</table>

	<?php 
	//echo "<pre>";
	//print_r($customer);
	//print_r($jobcard); ?>
</body>
</html>
