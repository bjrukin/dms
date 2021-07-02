<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title><?php echo $header; ?></title>
	<style type="text/css" media="print">
	div.page {
		page-break-after: always;
		page-break-inside: : avoid;
		page-break-before: avoid;
	}
	@media print {
		div.page { 
			page-break-after: always;
		}
	}

</style>
</head>
<body>
	<div class="page">
		<?php if($data == 1){?>
		<table cellspacing="0" cellpadding="0" width="750px">
			<!-- ------------- Header Starts ------------- -->
			<tr>
				<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo @$workshop->name; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> <?php echo @$workshop->address_1; ?>, <?php echo @$workshop->address_2; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> Tel No: <?php echo @$workshop->phone_1; ?> </td>
			</tr>
			<tr>
				<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo @$header; ?></td>
			</tr>
			<!-- -------------- Header Ends -------------- -->



			<!-- --------- Doc No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Doc No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$estimate->estimate_doc_no; ?></td>
				<td style="padding-top:20px">Date</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$estimate->issued_date; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="">Party Name</td>
				<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$estimate->full_name; ?></td>
				<td colspan="">Job Card No.</td>
				<td colspan="2" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$estimate->jobcard_group; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px">Model</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$estimate->vehicle_name." ".@$estimate->variant_name ; ?></td>
				<td colspan="" style="padding-top:20px">Vehicle No.</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$estimate->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Engine No.</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo @$estimate->engine_no; ?></td>
				<td colspan="" style="padding-top:5px">Chassis No.</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo @$estimate->chassis_no; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="padding-top: 20px">Dear sir, <br> We are submitting our prices of Spare Parts and Labour charges as required for you Vehicle.</td>
			</tr>
			<!-- ---------- Doc No Section Ends ---------- -->



			<!-- --------- Detail Section Starts --------- -->
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td style="padding-top:20px;">S.No</td>
				<td colspan="2" style="padding-top:20px;padding-left:20px">Description</td>
				<td style="padding-top:20px;padding-left:20px">Qty</td>
				<td style="padding-top:20px;padding-left:20px">Price</td>
				<td style="padding-top:20px;padding-left:20px">Spares Amount</td>
				<td style="padding-top:20px;padding-left:20px">Labour Amount</td>
			</tr>
			<?php foreach ($parts as $key => $value): ?>
				<tr>
					<td style="padding-top:10px;"><?php echo ++$key; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo @$value->part_name; ?> Pcs.</td>
					<td colspan="2" style="padding-top:10px;padding-left:20px"> <?php echo @$value->quantity; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo @$value->price; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo @$value->final_amount; ?></td>
					<td colspan="2" style="padding-top:10px;padding-left:20px"><?php ?></td>
				</tr>
			<?php endforeach; ?>
			<?php foreach ($jobs as $k => $value): ?>
				<tr>
					<td style="padding-top:10px;"><?php echo ++$k; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo @$value->description; ?> Pcs.</td>
					<td colspan="2" style="padding-top:10px;padding-left:20px"> <?php  ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php  ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php  ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo @$value->total_amount; ?></td>
				</tr>
			<?php endforeach; ?>
			<!-- ---------- Detail Section Ends ---------- -->



			<!-- --- Price Calculation Section Starts ---- -->
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="padding-top:30px;">Total Parts</td>
				<td style="padding-top:30px;text-align: center"><?php echo $estimate->total_parts; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td STYLE="padding-top:10px;">Total Jobs</td>
				<td style="padding-top:10px;text-align: center"><?php echo $estimate->total_jobs; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >VAT</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo ($estimate->total_parts + $estimate->total_jobs)*$estimate->vat_percent/100; ?></td>
				<!-- <td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo $estimate->net_total*$estimate->vat_percent/100; ?></td> -->
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >Net Amount</td>
				<!-- <td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo $estimate->net_total; ?></td> -->
				<td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo (($estimate->total_parts + $estimate->total_jobs)*$estimate->vat_percent/100) + ($estimate->total_parts + $estimate->total_jobs);  ?></td>
			</tr>
			<!-- ---- Price Calculation Section Ends ----- -->



			<!-- --------- List Section Starts ----------- -->
			<tr>
				<td colspan="8" style="padding-top:30px;font-size: 0.75em">
					<ul style="padding-left: 18px">
						<li>ALL RATES MENTIONED ABOVE ARE EXCLUSIVE OF TAXES</li>
						<li>DURING VEHICLE MAINTENANCE IF ADDITIONAL INNER PARTS OF THE VEHICLE ARE FOUND TO BE DAMAGED WHICH HAVE NOT BEEN MENTIONED IN THE     QUOTATION AND NEED TO BE REPLACED THOSE PARTS WILL BE MENTIONED IN THE FINAL BILL AND THE CUSTOMER IS LIABLE TO PAY FOR THOSE PARTS</li>
					</ul>
				</td>
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
		<?php }else{?>
			<label>Data is not saved! Please save data to print</label>
		<?php }?>

		
	</div>

</body>
</html>
