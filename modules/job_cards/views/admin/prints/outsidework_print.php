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
            
            
            
            <!-- --------- Doc No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Ledger Name</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo $outside_work->workshop_id; ?></td>
				<td style="padding-top:20px">OSW No.</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php //echo "OW-".sprintf('%05d', @$outside_work->); ?></td>
			</tr>
            			<tr>
				<td colspan="2" style="padding-top:20px">Supplier</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $outside_work->mechanic_name; ?></td>
                <td colspan="" style="padding-top:20px">Date</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $outside_work->send_date; ?></td>
			</tr>
            <tr>
				<td colspan="2" style="padding-top:5px">Splr Inv No</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $outside_work->splr_invoice_no; ?></td>
                <td colspan="" style="padding-top:5px">Splr Date</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $outside_work->splr_invoice_date; ?></td>
			</tr>
            <tr>
				<td colspan="2" style="padding-top:5px">Jobcard No</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo "JC-".sprintf("%05d",$outside_work->jobcard_serial); ?></td>
                <td colspan="" style="padding-top:5px">	Vehicle No</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $outside_work->vehicle_no; ?></td>
			</tr>
            <!-- ---------- Doc No Section Ends ---------- -->
            
            
            
            <!-- --------- Detail Section Starts --------- -->
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td style="padding-top:20px;">Job No. / Vehicle No.</td>
				<td colspan="2" style="padding-top:20px;padding-left:20px">Work No. / Description</td>
                <td style="padding-top:20px;padding-left:20px">Amount</td>
				<td colspan="2" style="padding-top:20px;padding-left:20px">Tax Amt</td>
				<td style="padding-top:20px;padding-left:20px">Discount</td>
				<td style="padding-top:20px;padding-left:20px">Net Amount</td>
			</tr>
			<?php foreach ($works as $key => $value): ?>
            <tr>
				<td style="padding-top:10px;"><?php echo $value->jobcard_serial; ?><br><?php echo $value->description; ?></td>
				<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $value->job_code; ?><br><?php echo $value->vehicle_no; ?></td>
				<td style="padding-top:10px;padding-left:20px"><?php echo moneyFormat($value->amount); ?></td>
				<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $value->taxes; ?></td>
				<td style="padding-top:10px;padding-left:20px"><?php echo moneyFormat($value->discount); ?></td>
				<td style="padding-top:10px;padding-left:20px"><?php echo moneyFormat($value->total_amount); ?></td>
            </tr>
			<?php endforeach; ?>
			<!-- ---------- Detail Section Ends ---------- -->
            
            
            
			<!-- --- Price Calculation Section Starts ---- -->
            <tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
            <tr>
                <td colspan="6"></td>
                <td style="padding-top:30px;">Gross Total</td>
                <td style="padding-top:30px;text-align: right"><?php echo moneyFormat($outside_work->gross_total); ?></td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td style="border-bottom-style: groove;">Round Off</td>
                <td style="border-bottom-style: groove;padding-top:10px;text-align: right"><?php echo moneyFormat($outside_work->round_off); ?></td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td style="border-bottom-style: groove;" >Net Amount</td>
                <td style="border-bottom-style: groove;padding-top:10px;text-align: right"><?php echo moneyFormat($outside_work->net_amount); ?></td>
            </tr>
            <!-- ---- Price Calculation Section Ends ----- -->
            
            
            
            <!-- ------- Signature Section Starts -------- -->
            <tr>
				<td colspan="4">
					<p style="padding-top:30px;">--------------------------</p>
				</td>
				<td colspan="4">
					<p style="padding-top:30px;padding-left:150px;text-align: right;">-------------------------</p>
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
