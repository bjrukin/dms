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
		<!-- <pre>
			<?php print_r($jobs);
			print_r($jobcard);
			print_r($parts);
			print_r($invoice);
			//exit;?>
		</pre> -->
		<table cellspacing="0" cellpadding="0" width="750px">
			<tr>
				<td colspan="6" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="6" style="text-align:center;"> <?php echo $workshop->address1; ?>, <?php echo $workshop->address2; ?></td>
			</tr>
			<tr>
				<td colspan="6" style="text-align:center;"> Tel No: <?php echo $workshop->phone1; ?> </td>
			</tr>
			<tr>
				<td colspan="6" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
			</tr>

			<tr>
				<td colspan="" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
				<td colspan="2" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->invoice_prefix. " ". $invoice->invoice_no; ?></td>
				<td colspan="2" style="padding-top:20px;padding-left:160px">Date</td>
				<td style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->created_at; ?></td>
			</tr>
			<tr>
				<td colspan="" style="">Party Name</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $jobcard->full_name; ?></td>
			</tr>
			<tr>
				<td colspan="">Job Card No.</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $jobcard->jobcard_group; ?></td>
				<td colspan="2" style="padding-top:10px;padding-left:160px"></td>
				<td  style="padding-top:10px"></td>
			</tr>
			<tr>
				<td>Model</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $jobcard->vehicle_name." ".$jobcard->variant_name ; ?></td>
				<td colspan="" style="">Vehicle No.</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $jobcard->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="">Engine No.</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $jobcard->engine_no; ?></td>
				<td colspan="2" style="padding-top:10px;padding-left:160px">Chassis No.</td>
				<td  style="padding-top:10px"><?php echo $jobcard->chassis_no; ?></td>
			</tr>
			<tr>
				<td colspan="6" style="padding-bottom:10px"></td>
			</tr>
			<tr>
				<td colspan="6" style="padding-top: 30px">Dear sir, <br> We are submitting our prices of Spare Parts and Labour charges as required for you Vehicle.</td>
			</tr>
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<!-- Jobs -->
			<tr>
				<td  style="padding-top:20px;width: 15px;">S.No</td>
				<td colspan="" style="padding-top:20px;">Job No.</td>
				<td colspan="" style="padding-top:20px;">Description</td>
				<td colspan="" style="padding-top:20px;">Status</td>
				<td colspan="" style="padding-top:20px;">Cost</td>
				<td colspan="" style="padding-top:20px;">Discount%</td>
				<td colspan="" style="padding-top:20px;">Final Amount</td>
			</tr>
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<?php foreach ($jobs as $key => $value): ?>
				<tr>
					<td style="padding-top:20px;"><?php echo ++$key; ?></td>
					<td colspan="" style="width:80px;padding-top:20px"> <?php echo $value->job ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->job_description; ?> </td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->status; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->cost; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->discount_percentage; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->final_amount ?></td>
				</tr>
			<?php endforeach; ?>
			<!-- END Jobs -->
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<tr>
				<td  style="padding-top:20px;width: 15px;">S.No</td>
				<td colspan="" style="padding-top:20px;">Part Name</td>
				<td colspan="" style="padding-top:20px;">Part Code</td>
				<td colspan="" style="padding-top:20px;">Price</td>
				<td colspan="" style="padding-top:20px;">Quantity</td>
				<td colspan="" style="padding-top:20px;">Warranty</td>
				<td colspan="" style="padding-top:20px;">Discount%</td>
				<td colspan="" style="padding-top:20px;">Final Amount</td>
			</tr>
			<tr>
				<?php foreach ($parts as $key => $value): ?>
					<tr>
						<td style="padding-top:20px;"><?php echo @++$key; ?></td>
						<td colspan="" style="width:80px;padding-top:20px"> <?php echo $value->part_name ?></td>
						<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->part_code; ?> </td>
						<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->price; ?></td>
						<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->quantity; ?> Pcs.</td>
						<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->warranty; ?> Pcs.</td>
						<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->discount_percentage; ?> Pcs.</td>
						<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->final_price; ?></td>
					</tr>
				<?php endforeach; ?>
			</tr>
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Total Parts</td>
				<td style="text-align: right;"><?php echo $invoice->total_parts; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Total Jobs</td>
				<td style="text-align: right;"><?php echo $invoice->total_jobs; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Cash Discount</td>
				<td style="text-align: right;"><?php echo $invoice->cash_discount_amt; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>VAT</td>
				<td style="text-align: right;"><?php echo $invoice->vat_parts + $invoice->vat_job; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-bottom-style: groove; border-top-style: groove;">NET AMOUNT</td>
				<td style="border-bottom-style: groove; border-top-style: groove;text-align: right;"><?php echo $invoice->net_total; ?></td>
			</tr>

			<tr>
				<td colspan="4" style="padding-top:20px;font-size: 0.75em">
					- ALL RATES MENTIONED ABOVE ARE EXCLUSIVE OF TAXES <br>
					- DURING VEHICLE MAINTENANCE IF ADDITIONAL INNER PARTS OF THE VEHICLE ARE FOUND TO BE DAMAGED WHICH HAVE NOT BEEN MENTIONED IN THE QUOTATION AND NEED TO BE REPLACED THOSE PARTS WILL BE MENTIONED IN THE FINAL BILL AND THE CUSTOMER IS LIABLE TO PAY FOR THOSE PARTS
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
	</div>

	<?php 
	//echo "<pre>";
	//print_r($customer);
	//print_r($jobcard); ?>
</body>
</html>
