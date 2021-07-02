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
                     ARUN INTERCONTINENTAL TRADERS PVT.LTD.                     
                                   JHAMSIKHEL                                   
                                    PULCHOWK                                    
                                    Lalitpur                                    
                             Phone : 977-1-5545907                              


                                  OutSide Work                                  
                                  ============                                  

Ledger      : UTAM GENERAL WORKSHOP              OSW No.   : 4                   
Supplier    :                                    Date      : 19/07/2016
Splr Inv No.:                                    Splr Date : 19/07/2016

________________________________________________________________________________
Job No.          Work No.                 Amount   Tax Amt  Discount  Net Amount
Vehicle No.      Description                   
________________________________________________________________________________
246              L198                   1,200.00                        1,200.00
BA5CHA8943       DISC TURNING                  
246              D17                      700.00                          700.00
BA5CHA8943       DRUM TURNING                  










________________________________________________________________________________

                                                                        ========
                                                    Net Amount   :      1,900.00
                                                                        ========
________________________________________________________________________________


	<div class="page">
		<table cellspacing="0" cellpadding="0" width="750px">
			<tr>
				<td colspan="6" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="6" style="text-align:center;"> Corporate Office: <?php echo $workshop->address1; echo $workshop->address2?$workshop->address2:''; ?></td>
			</tr>
			<tr>
				<td colspan="6" style="text-align:center;"> Tel No: 5545891-5 Fax No. 5546223 </td>
			</tr>
			<tr>
				<td colspan="6" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
			</tr>

			<tr>
				<td colspan="" style="font-weight:bold;padding-top:20px; width: 100px;">Ledger Name</td>
				<td colspan="2" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo $outside_work->workshop_id; ?></td>
				<td colspan="2" style="padding-top:20px;">OSW No.</td>
				<td style="padding-top:20px"><span style="">:</span></td>
			</tr>
			<tr>
				<td colspan="" style="">Supplier</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $outside_work->mechanic_name; ?></td>
				<td colspan="2" style="padding-top:10px;">Date: </td>
				<td  style="padding-top:10px"><span style="padding-right:10px">:</span><?php echo $outside_work->send_date; ?></td>
			</tr>
			<tr>
				<td colspan="">Splr Inv No.</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $outside_work->splr_invoice_no; ?></td>
				<td colspan="" style="">Splr Date</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $outside_work->splr_invoice_date; ?></td>
			</tr>
			<tr>
				<td>Jobcard No.</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $outside_work->jobcard_group; ?></td>
				<td colspan="" style="">Vehicle No.</td>
				<td colspan="2"><span style="padding-right:10px">:</span><?php echo $outside_work->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="6" style="padding-bottom:10px"></td>
			</tr>
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<!-- Parts -->
			<tr>
				<!-- <td  style="padding-top:20px;width: 15px;">S.No</td> -->
				<td colspan="" style="padding-top:20px;">Job No. / Vehicle No.</td>
				<td colspan="" style="padding-top:20px;">Work No. / Description</td>
				<td colspan="" style="padding-top:20px;width: 15px;">Amount</td>
				<td colspan="" style="padding-top:20px;width: 15px;">Tax Amt</td>
				<td colspan="" style="padding-top:20px;width: 15px;">Discount</td>
				<td colspan="" style="padding-top:20px;width: 15px;">Net Amount</td>
			</tr>
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<?php foreach ($works as $key => $value): ?>
				<tr>
					<!-- <td style="padding-top:20px;"><?php echo ++$key; ?></td> -->
					<td colspan="" style="width:80px;padding-top:20px"> <?php echo $value->jobcard_group; ?><br><?php echo $value->description; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->job_code; ?><br><?php echo $value->vehicle_no; ?> </td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->amount; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->taxes; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->discount; ?></td>
					<td colspan="" style="vertical-align:top;padding-top:20px"> <?php echo $value->total_amount; ?></td>
				</tr>
			<?php endforeach; ?>
			<!-- END Parts -->
			<tr>
				<td colspan="6" style="border-bottom-style: groove;padding-bottom:10px"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Gross Total</td>
				<td style="text-align: right;"><?php echo $outside_work->gross_total; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Round Off</td>
				<td style="text-align: right;"><?php echo $outside_work->round_off; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-bottom-style: groove; border-top-style: groove;">NET AMOUNT</td>
				<td style="border-bottom-style: groove; border-top-style: groove;text-align: right;"><?php echo $outside_work->net_amount; ?></td>
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
