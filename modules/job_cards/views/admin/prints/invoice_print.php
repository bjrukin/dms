<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title><?php echo $header; ?></title>
	<style>        .page{            page-break-after: always;            page-break-before: always;        }        table td{            font-size: 12px;        }    </style>
</head>
<body>
	<div class="page">
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

			<!-- <?php //print_r($jobcard); ?> -->

			<!-- --------- Doc No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-size: 14px; font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
				<td colspan="3" style="font-size: 14px; width:210px;padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->invoice_prefix. " TI-". sprintf('%05d', $jobcard->invoice_no); ?></td>
				<td style="font-size: 14px; padding-top:20px">Date</td>
				<td colspan="2" style="font-size: 14px; padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->created_at; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; ">Party Name</td>
				<td colspan="3" style="font-size: 14px; padding-top: 5px;"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->customer_name; if($jobcard->reciever_name) echo "({$jobcard->reciever_name})"; ?></td>
				<td colspan="">Job Card No.</td>
				<td colspan="2" style="font-size: 14px; padding-top: 5px;"><span style="font-size: 14px; padding-right:10px">:</span><?php echo "JC-".sprintf('%05d',$jobcard->jobcard_serial); ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; ">Address</td>
				<td colspan="3" style="font-size: 14px; padding-top: 5px;"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->address1; ?></td>
				<td colspan=""></td>
				<td colspan="2" style="font-size: 14px; padding-top: 5px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:20px">Model</td>
				<td colspan="3" style="font-size: 14px; padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->vehicle_name." ".@$jobcard->variant_name ; ?></td>
				<td colspan="" style="font-size: 14px; padding-top:20px">Vehicle No.</td>
				<td colspan="2" style="font-size: 14px; padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:5px">Engine No.</td>
				<td colspan="3" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->engine_no; ?></td>
				<td colspan="" style="font-size: 14px; padding-top:5px">Chassis No.</td>
				<td colspan="2" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->chassis_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:5px">Service Type.</td>
				<td colspan="3" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->service_type_name.' '.@$jobcard->service_count ; ?></td>
				<td colspan="" style="font-size: 14px; padding-top:5px">Kms.</td>
				<td colspan="2" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->kms; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:5px">Coupen</td>
				<td colspan="3" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$jobcard->coupon; ?></td>
				<td style="font-size: 14px;" colspan="" style="font-size: 14px; padding-top:5px">Pan No</td>
				<td colspan="2" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:<?php echo @$jobcard->pan_no; ?></span></td>
			</tr>
			<tr>
				<td colspan="8" style="padding-top: 20px">Dear sir, <br> We are submitting our prices of Spare Parts and Labour charges as required for you Vehicle.</td>
			</tr>
			<!-- ---------- Doc No Section Ends ---------- -->

		</table>
		<table cellspacing="0" cellpadding="0" width="750px">
			<!-- --------- Detail Section Starts --------- -->
			<tr>
				<td colspan="9" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td  style="padding-top:5px;">S.No</td>
				<td style="padding-top:5px;padding-left:20px">Item No.</td>
				<td colspan="2" style="padding-top:5px;padding-left:20px">Description</td>
				<td style="padding-top:5px;padding-left:20px">Qty</td>
				<td style="padding-top:5px;padding-left:20px">Rate</td>
				<td style="padding-top:5px;padding-left:20px">Item Discount</td>
				<td style="padding-top:5px;padding-left:20px">Labour Amount</td>
				<td style="padding-top:5px;padding-left:20px">Parts Amount</td>
			</tr>
			<tr>
				<td colspan="9" style="border-bottom-style: groove;padding-bottom:5px"></td>
			</tr>
			<?php $key =0;?>
			<?php if($parts): ?>
				<?php foreach ($parts as $key => $value): ?>
					<?php if($value->final_amount != 0): ?>
						<tr>
							<td style="padding-top:10px;"><?php echo ++$key; ?>.</td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->part_code; ?></td>
							<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $value->part_name; ?></td>
							<td style="padding-top:10px;padding-left:20px"><?php echo ($value->lube_quantity > 0)?$value->lube_quantity:$value->quantity; ?></td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->price; ?></td>
							<!-- <td style="padding-top:10px;padding-left:20px"><?php echo $value->warranty; ?></td> -->
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->discount_percentage; ?></td>
							<td style="padding-top:10px;padding-left:20px"></td>
							<td style="padding-top:10px;padding-left:20px;text-align: right;padding-right:10px"><?php echo $value->final_amount; ?></td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif;?>
			<?php foreach ($jobs as $k => $value): ?>
				<?php if($value->final_amount != 0): ?>				
					<tr>
						<td style="padding-top:10px;"><?php echo ++$key; ?>.</td>
						<td style="padding-top:10px;padding-left:20px"><?php echo @$value->job ?></td>
						<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo @$value->job_description; ?></td>
						<td style="padding-top:10px;padding-left:20px"></td>
						<td style="padding-top:10px;padding-left:20px"><?php echo @$value->cost; ?></td>
						<td style="padding-top:10px;padding-left:20px"><?php echo @$value->discount_percentage; ?></td>
						<td style="padding-top:10px;padding-left:20px;text-align: right;padding-right:10px"><?php echo @$value->final_amount; ?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			<!--Job Detail Ends-->
		</table>

		<table cellspacing="0" cellpadding="0" width="750px">

			<!------------ Detail Section Ends ------------>
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>

			<!----- Price Calculation Section Starts ------>
			<tr>
				<td colspan="6" width="400px"></td>
				<td style="padding-top:30px;">Total Parts</td>
				<td style="padding-top:30px;text-align: right; padding-right: 5px;"><?php echo @$jobcard->total_parts; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="padding-top:10px;">Total Jobs</td>
				<td style="padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard->total_jobs; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td >Cash</td>
				<td style="padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard->cash_discount_amt; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td >Discount</td>
				<td style="padding-top:10px;text-align: right; padding-right: 5px;">0</td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >VAT</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard->vat_parts + @$jobcard->vat_job; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >Net Amount</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$jobcard->net_total; ?></td>
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
				<!-- <td colspan="8" style="border-bottom-style: dotted;padding-bottom:10px"></td> -->
			</tr>
			<!-- ------- Signature Section Ends ---------- -->
		</table>
	</div>
	<div class="page">
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
				<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo "Gatepass"; ?></td>
			</tr>
			<!-- -------------- Header Ends -------------- -->

			<tr>
				<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Pass No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">: 
					<?php echo "GP-".sprintf('%05d', @$gatepass['gatepass_no'] ); ?> 
				</td>
				<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Job Card No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:
					<?php echo "JC-".sprintf('%05d', $jobcard->jobcard_serial) ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Vehicle No.</td>
				<td colspan="3" style="width:210px;padding-top:20px">:<?php echo $jobcard->vehicle_no?></td>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Date</td>
				<td colspan="3" style="width:210px;padding-top:20px">:<?php echo $jobcard->created_at;?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
				<td colspan="3" style="width:210px;padding-top:20px">:<?php echo @$jobcard->invoice_prefix . "TI-".sprintf('%05d', $jobcard->invoice_no) ;?></td>
			</tr>


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
					<p style="padding:0px; margin: 0px">Advisor's Signature</p>
				</td>
				<td colspan="4">
					<p style="padding:0px; margin: 0px;padding-left:160px;text-align: right;">Cashier's Signature</p>
				</td>
			</tr>
			<tr>
				<!-- <td colspan="8" style="border-bottom-style: dotted;padding-bottom:10px"></td> -->
			</tr>
			<!-- ------- Signature Section Ends ---------- -->

		</table>
	</div>
</body>
</html>
