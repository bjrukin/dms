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
				<td colspan="8" style="text-align:center;"> <?php echo $workshop->address_1; ?>, <?php echo $workshop->address_2; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> Tel No: <?php echo $workshop->phone_1; ?> </td>
			</tr>
			<tr>
				<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
			</tr>
			<!-- -------------- Header Ends -------------- -->

			<tr>
				<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Pass No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">: <?php echo "GP-".sprintf('%05d', $gatepass['gatepass_no'] ); ?> </td>
					<td colspan="2"  style="font-weight:bold;padding-top:20px; width: 100px;">Job Card No.</td>
					<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:<?php echo "JC-".sprintf('%05d', $jobcard->jobcard_serial) ?></td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Vehicle No.</td>
						<td colspan="3" style="width:210px;padding-top:20px">:<?php echo $jobs[0]->vehicle_no?></td>
						<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Date</td>
						<td colspan="3" style="width:210px;padding-top:20px">:<?php echo $gatepass['date']?></td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
						<td colspan="3" style="width:210px;padding-top:20px">:<?php echo "TI-".sprintf('%05d', @$gatepass['invoice_no']) ;?></td>
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
