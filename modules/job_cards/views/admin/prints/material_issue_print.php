<!DOCTYPE html>
<html>
<head>
	<title><?php echo $header; ?></title>
	
</head>
<body>
	<table cellspacing="0" cellpadding="0" width="750px">
		<!-- ------------- Header Starts ------------- -->
		<tr>
			<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center;"> <?php echo $workshop->address_1; ?>, <?php echo $workshop->address_2; ?></td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center;"> Tel No: <?php echo $workshop->phone_1; ?> </td>
		</tr>
		<tr>
			<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
		</tr>
		<!-- -------------- Header Ends -------------- -->



		<!-- --------- Doc No Section Starts --------- -->
		<tr>
			<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">MIssue No:</td>
			<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo "MI-".sprintf('%05d', @$customer->material_issue_no); ?></td>
			<td style="padding-top:20px">Date:</td>
			<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$customer->issue_date; ?></td>
		</tr>
		<tr>
			<td colspan="2" style="">Job Card No:</td>
			<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo "JC-".sprintf('%05d', $customer->jobcard_serial); ?></td>
			<td colspan="">Vehicle No:</td>
			<td colspan="2" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$customer->vehicle_no; ?></td>
		</tr>
		<tr>
			<td colspan="2" style="">Party Name:</td>
			<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$customer->customer_name; ?></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-top: 20px">We received material against Job Card No. <?php echo $customer->jobcard_serial ?> detail as per following-</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-top: 20px">Mechanic:</td>
			<td colspan="3" style="padding-top: 20px"><?php echo $customer->mechanics_id; ?></td>
		</tr>
		<!-- ---------- Doc No Section Ends ---------- -->



		<!-- --------- Detail Section Starts --------- -->
		<tr>
			<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
		</tr>
		<!-- Job Detail Starts -->
		<tr>
			<td  style="padding-top:20px;padding-bottom:10px">S.No</td>
			<td style="padding-top:20px;padding-bottom:10px;padding-left:20px">Part No.</td>
			<td colspan="2" style="padding-top:20px;padding-bottom:10px;padding-left:20px">Part Name</td>
			<td style="padding-top:20px;padding-bottom:10px;padding-left:20px">Bin</td>
			<td style="padding-top:20px;padding-bottom:10px;padding-left:20px">Qty.</td>
			<td style="padding-top:20px;padding-bottom:10px;padding-left:20px">Price</td>
			<td style="padding-top:20px;padding-bottom:10px;padding-left:20px">Amount</td>
		</tr>
		<?php if($parts): $total = 0; foreach ($parts as $key => $value): ?>
			<tr>
				<td style="padding-top:5px;padding-bottom:5px"><?php echo ++$key; ?></td>
				<td style="padding-top:5px;padding-bottom:5px;padding-left:20px"><?php echo $value->part_code ?></td>
				<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $value->part_name; ?></td>
				<td style="padding-top:5px;padding-bottom:5px;padding-left:20px"></td>
				<td style="padding-top:5px;padding-bottom:5px;padding-left:20px"> 
					<?php if($value->part_id == ULTRA_SYNTHETIC || $value->part_id == SYNTHETIC || $value->part_id == NORMAL): ?>
						<?php echo $value->lube_quantity; ?> Ltr.
					<?php else: ?>
						<?php echo $value->quantity; ?> Pcs.
					<?php endif; ?>
				</td>
				<td style="padding-top:5px;padding-bottom:5px;padding-left:20px"><?php echo moneyFormat($value->price); ?></td>
				<td style="padding-top:5px;padding-bottom:5px;padding-left:20px">
					<?php if($value->part_id == ULTRA_SYNTHETIC || $value->part_id == SYNTHETIC || $value->part_id == NORMAL): ?>
						<?php echo moneyFormat($value->lube_quantity * $value->price);  $total+= $value->lube_quantity * $value->price; ?>
					<?php else: ?>
						<?php echo moneyFormat($value->quantity * $value->price); $total+= $value->quantity * $value->price; ?>
						
					<?php endif; ?>
			</tr>
		<?php endforeach; endif; ?>
		<tr>
			<td style="padding-top:10px"></td>
			<td style="padding-top:10px"></td>
			<td style="padding-top:10px"></td>
			<td style="padding-top:10px"></td>
			<td style="padding-top:10px"></td>
			<td style="padding-top:10px"></td>
			<td style="padding-top:10px;padding-left:20px">Total Amount</td>
			<td style="padding-top:10px;padding-left:20px"><?php echo moneyFormat($total); ?></td>
		</tr>
		<!-- Job Detail Ends -->
		<tr>
			<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
		</tr>
		<!-- ---------- Detail Section Ends ---------- -->
		<!-- --------- List Section Starts ----------- -->
		<tr>
			<td colspan="2" style="padding-top: 20px">Remarks Narration:</td>
			<td colspan="6" style="padding-top: 20px"><?php echo @$customer->narration; ?></td>
		</tr>
		<!-- ---------- List Section Ends ------------ -->



		<!-- ------- Signature Section Starts -------- -->
		<tr>
			<td colspan="4">
				<p style="padding-top:30px">--------------------------</p>
			</td>
			<td colspan="4">
				<p style="padding-top:30px;padding-left:150px;text-align: right;">---------------------------</p>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<p style="padding:0px; margin: 0px">Reciever's Signature</p>
			</td>
			<td colspan="4">
				<p style="padding:0px; margin: 0px;padding-left:160px;text-align: right;">Authorised Signatory</p>
			</td>
		</tr>
		<tr>
			<td colspan="8" style="border-bottom-style: dotted;padding-bottom:10px"></td>
		</tr>
		<!-- ------- Signature Section Ends ---------- -->
	</table>
</body>
</html>
