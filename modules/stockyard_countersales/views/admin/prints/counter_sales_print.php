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
				<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo @$detail->stockyard; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> <?php echo @$detail->location; ?>, <?php echo @$workshop->address2; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> Tel No: <?php echo @$workshop->phone1; ?> </td>
			</tr>
			<tr>
				<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo @$header; ?></td>
			</tr>
			<!-- -------------- Header Ends -------------- -->



			<!-- --------- Doc No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$detail->invoice_prefix. " ". str_pad($detail->invoice_no, 6, '0', STR_PAD_LEFT); ?></td>
				<td style="padding-top:20px">Date</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$detail->issue_date; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="">Party Name</td>
				<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$detail->full_name; ?></td>
			</tr>
			<!-- <tr>
				<td colspan="2" style="padding-top:20px">Model</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice['vehicle_name']." ".$invoice['variant_name'] ; ?></td>
				<td colspan="" style="padding-top:20px">Vehicle No.</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $detail->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Engine No.</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $detail->engine_no; ?></td>
				<td colspan="" style="padding-top:5px">Chassis No.</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $detail->chasis_no; ?></td>
			</tr> -->
			<tr>
				<td colspan="8" style="padding-top: 20px">Dear sir, <br> We are submitting our prices of Spare Parts as required for you Vehicle.</td>
			</tr>
			<!-- ---------- Doc No Section Ends ---------- -->



			<!-- --------- Detail Section Starts --------- -->
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
		</table>
		<table cellspacing="0" cellpadding="0" width="750px">
			<!-- --------- Detail Section Starts --------- -->
			<tr>
				<td colspan="9" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td  style="padding-top:5px;">S.No</td>
				<td style="padding-top:5px;padding-left:20px">Part Code</td>
				<td colspan="2" style="padding-top:5px;padding-left:20px">Description</td>
				<td style="padding-top:5px;padding-left:20px">Price</td>
				<td style="padding-top:5px;padding-left:20px">Qty</td>
				<!-- <td style="padding-top:5px;padding-left:20px">Warranty</td> -->
				<!-- <td style="padding-top:5px;padding-left:20px">Discount Amount</td> -->
				<td style="padding-top:5px;padding-left:20px">Final Amount</td>
			</tr>
			<tr>
				<td colspan="9" style="border-bottom-style: groove;padding-bottom:5px"></td>
			</tr>
			<?php if($parts): ?>
				<?php foreach ($parts as $key => $value): ?>
					<tr>
						<td style="padding-top:10px;"><?php echo ++$key; ?></td>
						<td style="padding-top:10px;padding-left:20px"><?php echo $value->name; ?></td>
						<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $value->part_code; ?></td>
						<?php if($detail->price_option == 'price'){?>
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->mrp; ?></td>
						<?php }else{?>
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->drp; ?></td>
						<?php }?>
						<td style="padding-top:10px;padding-left:20px"><?php echo $value->quantity; ?></td>
						<!-- <td style="padding-top:10px;padding-left:20px"><?php echo $value->warranty; ?></td> -->
						<!-- <td style="padding-top:10px;padding-left:20px"><?php echo $value->discount_percentage; ?></td> -->
						<?php if($detail->price_option == 'price'){?>
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->total; ?></td>
						<?php }else{?>
							<td style="padding-top:10px;padding-left:20px"><?php echo $value->dealer_price_total; ?></td>
						<?php }?>
					</tr>
				<?php endforeach; ?>
			<?php endif;?>
		</table>
		<table cellspacing="0" cellpadding="0" width="750px">
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>

			<!----- Price Calculation Section Starts ------>
			<!-- <tr>
				<td colspan="6" width="400px"></td>
				<td style="padding-top:30px;">Total Parts</td>
				<td style="padding-top:30px;text-align: right; padding-right: 5px;"><?php echo @$detail->total_for_parts; ?></td>
			</tr> -->
			<tr>
				<td colspan="6"></td>
				<td >Cash</td>
				<td style="padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$detail->total_for_parts;; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td >Discount</td>
				<td style="padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$detail->cash_discount_amt;?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >VAT</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$detail->vat_parts; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >Net Amount</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: right; padding-right: 5px;"><?php echo @$detail->net_total ; ?></td>
			</tr>
			<!-- ---- Price Calculation Section Ends ----- -->



			<!-- --------- List Section Starts ----------- -->
			<tr>
				<td colspan="8" style="padding-top:30px;font-size: 0.75em">
					<ul style="padding-left: 18px">
						<li>ALL RATES MENTIONED ABOVE ARE EXCLUSIVE OF TAXES</li>
						
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
</body>
</html>
