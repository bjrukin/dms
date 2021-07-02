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
		<table cellspacing="0" cellpadding="0" width="750px">
			<!-- ------------- Header Starts ------------- -->
			<tr>
				<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> <?php echo $workshop->address1; ?>, <?php echo $workshop->address2; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> Tel No: <?php echo $workshop->phone1; ?> </td>
			</tr>
			<tr>
				<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
			</tr>
			<!-- -------------- Header Ends -------------- -->



			<!-- --------- Doc No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->purchase_invoice_serial; ?></td>
				<td style="padding-top:20px">Date</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->created_at; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="">Splr No:</td>
				<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo $invoice->splr_inv_no; ?></td>
				<td colspan="">Splr Date:</td>
				<td colspan="2" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo $invoice->splr_date; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px">Pinv No:</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->pinv_no; ?></td>
				<!-- <td colspan="" style="padding-top:20px">Vehicle No.</td> -->
				<!-- <td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->vehicle_no; ?></td> -->
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Chalan No:</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $invoice->challan_no; ?></td>
				<td colspan="" style="padding-top:5px">Order.</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $invoice->ord_no; ?></td>
			</tr>

			<tr>
				<td colspan="2" style="padding-top:20px">Ledger</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $invoice->ledger; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="padding-top: 20px">Dear sir, <br> We are submitting our prices of Spare Parts and Labour charges as required for you Vehicle.</td>
			</tr>
			<!-- ---------- Doc No Section Ends ---------- -->



			<!-- --------- Detail Section Starts --------- -->
			
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>

			<!--Part Detail Starts-->
			<tr>
				<td  style="padding-top:20px;">S.No</td>
				<td style="padding-top:20px;padding-left:20px">Part Name</td>
				<td style="padding-top:20px;padding-left:20px">Part Code</td>
				<td style="padding-top:20px;padding-left:20px">Price</td>
				<td style="padding-top:20px;padding-left:20px">Quantity</td>
				<td style="padding-top:20px;padding-left:20px">Warranty</td>
				<td style="padding-top:20px;padding-left:20px">Discount Amount</td>
				<td style="padding-top:20px;padding-left:20px">Final Amount</td>
			</tr>
			<?php foreach ($invoice_parts as $key => $value): ?>
				<tr>
					<td style="padding-top:10px;"><?php echo ++$key; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo $value->part_id; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo $value->part_code; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo $value->price; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo $value->qty; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php //echo $value->warranty; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo $value->disc; ?></td>
					<td style="padding-top:10px;padding-left:20px"><?php echo $value->amount; ?></td>
				</tr>
			<?php endforeach; ?>
			<!--Part Detail Ends-->
			<!------------ Detail Section Ends ------------>



			<!----- Price Calculation Section Starts ------>
			<tr>
				<td colspan="6"></td>
				<td style="padding-top:30px;">Total Parts</td>
				<td style="padding-top:30px;text-align: center"><?php echo $invoice->gross_total; ?></td>
			</tr>
			<!-- <tr>
				<td colspan="6"></td>
				<td STYLE="padding-top:10px;">Total Jobs</td>
				<td style="padding-top:10px;text-align: center"><?php echo $invoice->gross_total; ?></td>
			</tr> -->
			<tr>
				<td colspan="6"></td>
				<td >Cash</td>
				<td style="padding-top:10px;text-align: center"><?php echo $invoice->discount; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td >Discount</td>
				<td style="padding-top:10px;text-align: center">0</td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >VAT</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo $invoice->vatamount; ?></td>
			</tr>
			<tr>
				<td colspan="6"></td>
				<td style="border-bottom-style: groove;" >Net Amount</td>
				<td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo $invoice->netamount; ?></td>
			</tr>
            <!-- ---- Price Calculation Section Ends ----- -->
            
            
            
            <!-- --------- List Section Starts ----------- -->
            <tr>
				<td colspan="8" style="padding-top:30px;font-size: 0.75em">
                    <ul style="padding-left: 18px">
                        <!-- <li>ALL RATES MENTIONED ABOVE ARE EXCLUSIVE OF TAXES</li> -->
                        <!-- <li>DURING VEHICLE MAINTENANCE IF ADDITIONAL INNER PARTS OF THE VEHICLE ARE FOUND TO BE DAMAGED WHICH HAVE NOT BEEN MENTIONED IN THE     QUOTATION AND NEED TO BE REPLACED THOSE PARTS WILL BE MENTIONED IN THE FINAL BILL AND THE CUSTOMER IS LIABLE TO PAY FOR THOSE PARTS</li> -->
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
	</div>
</body>
</html>
