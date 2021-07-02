 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>Sales Bill</title>
 	<!-- Tell the browser to be responsive to screen width -->
 	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 	<link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.ico");?> " type="image/x-icon">
 	<!-- Bootstrap 3.3.4 -->
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/project.min.css');?>"  />
 	<style>
 		* { font-family: 'Times New Roman'; }
 		.right{text-align:right; padding-right: 10px;}
 		.center{text-align:center;}
 		.invoice-table>tr>td {
 			text-align: left;
 		}

 		.invoice-table-head th, .invoice-table-head td{border: none!important; padding: 5px!important;}

 		@media print {
 			* {
 				font-size: 99%
 			}
 			.row { padding: 0px!important}
 		}

 	</style>
 </head>
<body>
	<div class="page">
			<table cellspacing="0" cellpadding="0" width="750px">
				<!-- ------------- Header Starts ------------- -->
				<tr>
					<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo @$dealer_info->name; ?></h2> </td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:center;"> <?php echo @$dealer_info->address_1; ?></td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:center;"> Tel No: <?php echo @$dealer_info->phone_1; ?> </td>
				</tr>
				<tr>
					<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo @$header; ?></td>
				</tr>
				<!-- -------------- Header Ends -------------- -->



				<!-- --------- Doc No Section Starts --------- -->
				<tr>
					<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo @$bill_info->bill ?></td>
					<td style="padding-top:20px">Date</td>
					<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo date("Y-m-d");?></td>
				</tr>
				<tr>
					<td colspan="2" style="">Party Name</td>
					<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$bill_info->name; ?></td>
					<td style="">Vat Bill No.</td>
					<td colspan="2" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo @$bill_info->vat_bill_no; ?></td>
				</tr>
				<!-- ---------- Doc No Section Ends ---------- -->



				<!-- --------- Detail Section Starts --------- -->
				<tr>
					<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
				</tr>
				
				<?php if($rows): ?>
					<!--Part Detail Starts-->
					<tr>
						<td style="padding-top:20px;">S.No</td>
						<td style="padding-top:20px;padding-left:30px">Part Name</td>
						<td style="padding-top:20px;padding-left:30px">Part Code</td>
						<td style="padding-top:20px;padding-left:30px">Price</td>
						<td style="padding-top:20px;padding-left:30px">Quantity</td>
						<td style="padding-top:20px;padding-left:30px">Total</td>
					</tr>
					<?php foreach ($rows as $key => $value): ?>
						<tr>
							<td style="padding-top:10px;"><?php echo ++$key; ?></td>
							<td style="padding-top:10px;padding-left:30px"><?php echo $value->part_name; ?></td>
							<td style="padding-top:10px;padding-left:30px"><?php echo $value->part_code; ?></td>
							<td style="padding-top:10px;padding-left:30px"><?php echo $value->price; ?></td>
							<td style="padding-top:10px;padding-left:30px"><?php echo $value->quantity; ?></td>
							<td style="padding-top:10px;padding-left:30px"><?php echo ($value->price * $value->quantity); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif;?>
				<!--Part Detail Ends-->
				<!------------ Detail Section Ends ------------>

				<tr>
					<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
				</tr>

				<!----- Price Calculation Section Starts ------>
				<tr>
					<td colspan="5"></td>
					<td style="padding-top:30px;">Total Parts</td>
					<td style="padding-top:30px;text-align: center"><?php echo @$bill_info->taxable_total; ?></td>
				</tr>
				<tr>
					<td colspan="5"></td>
					<td >Discount</td>
					<td style="padding-top:10px;text-align: center"><?php echo @$bill_info->discount; ?></td>
				</tr>
				<tr>
					<td colspan="5"></td>
					<td style="border-bottom-style: groove;" >VAT</td>
					<td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo @$bill_info->vat_amount ?></td>
				</tr>
				<tr>
					<td colspan="5"></td>
					<td style="border-bottom-style: groove;" >Net Amount</td>
					<td style="border-bottom-style: groove;padding-top:10px;text-align: center"><?php echo @$bill_info->total_amount; ?></td>
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
						<p style="padding-top:30px">--------------------</p>
					</td>
					<td colspan="4">
						<p style="padding-top:30px;padding-left:150px;text-align: right;">---------------------</p>
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
