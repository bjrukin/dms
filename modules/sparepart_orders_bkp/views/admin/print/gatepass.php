<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title><?php echo 'Gatepass'; ?></title>
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
					<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo 'Shree Himalayan Traders'; ?></h2> </td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:center;"> <?php echo 'Satungal'; ?></td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:center;"> Tel No: <?php echo '01-4222222'; ?> </td>
				</tr>
				<tr>
					<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"></td>
				</tr>
				<!-- -------------- Header Ends -------------- -->

				<tr>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Pass No.</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:<?php echo @($gatepass_no); ?></td>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Billl No.</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:SSB- <?php echo @$bill_no?></td>
				</tr>
				<tr>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Dealer Name</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:<?php echo @($dealer_data->name); ?></td>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Bill Date</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:<?php echo @($bill_data->dispatched_date_nepali) ?></td>
				</tr>
				<tr>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Total Amount</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:<?php echo @(moneyFormat($bill_data->amount)); ?></td>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Total Quantity</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:<?php echo @($bill_data->total_qty) ?></td>
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
					<td colspan="8" style="border-bottom-style: dotted;padding-bottom:10px"></td>
				</tr>
				<!-- ------- Signature Section Ends ---------- -->
			</table>
		</div>
	</body>
	</html>
