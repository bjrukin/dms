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
				<td colspan="15" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="15" style="text-align:center;"> <?php echo $workshop->address_1; ?>, <?php echo $workshop->address_2; ?></td>
			</tr>
			<tr>
				<td colspan="15" style="text-align:center;"> Tel No: <?php echo $workshop->phone_1; ?> </td>
			</tr>
			<tr>
				<td colspan="15" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo $header; ?></td>
			</tr>
            <!-- -------------- Header Ends -------------- -->
            
            
            
            <!-- --------- Doc No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">PInv No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo $detail->invoice_no; ?></td>
			</tr>
			<tr>
				<td style="padding-top:20px">PInv Date</td>
				<td colspan="13" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $detail->purchased_date?></td>
			</tr>
			<tr>
				<td style="padding-top:20px">Splr Inv No.</td>
				<td colspan="13" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $detail->invoice_no?></td>
			</tr>
			<tr>
				<td style="padding-top:20px">Splr Inv Date.</td>
				<td colspan="13" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $detail->purchased_date?></td>
			</tr>

			<tr>
				<td style="padding-top:20px">Supplier</td>
				<td colspan="13" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $detail->party_name?></td>
			</tr>
            <!-- ---------- Doc No Section Ends ---------- -->
            
            
            
            <!-- --------- Detail Section Starts --------- -->
			<tr>
				<td colspan="15" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td style="padding-top:20px;">Sr#</td>
				<td colspan="3" style="padding-top:20px;padding-left:20px; width:200px">Part No.</td>
                <td colspan="7" style="padding-top:20px;padding-left:20px; width:280px">Part Description</td>
				<td style="padding-top:20px;padding-left:20px">Quantity</td>
				<td style="padding-top:20px;padding-left:20px">Price Disc</td>
				<td style="padding-top:20px;padding-left:20px">Amount</td>
				<td style="padding-top:20px;padding-left:20px">Bin No.</td>
			</tr>
			<?php $total_quantity = 0?>
			<?php foreach ($rows as $key => $value): ?>
            <tr>
				<td><?php echo $key + 1?></td>
				<td colspan="3"><?php echo $value->part_code?></td>
				<td colspan="7"><?php echo $value->name?></td>
				<td style="text-align: right"><?php echo $value->quantity?></td>
				<td></td>
				<td style="text-align: right"><?php echo $value->quantity * $value->price?></td>
				<td></td>
				<?php $total_quantity += $value->quantity?>
            </tr>
			<?php endforeach; ?>
			<!-- ---------- Detail Section Ends ---------- -->
            
            
			<!-- --- Price Calculation Section Starts ---- -->
            <tr>
				<td colspan="15" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
            <tr>
                <td colspan="7"></td>
                <td colspan="4">Sub Total</td>
                <td style="text-align: right"><?php echo $total_quantity; ?></td>
                <td></td>
                <td style="text-align: right"><?php echo $detail->total_amount?></td>
            </tr>
            <tr>
                <td colspan="12"></td>
                <td style="border-bottom-style: groove;">Gross Amount</td>
                <td style="border-bottom-style: groove;padding-top:10px;text-align: right"><?php echo $detail->total_amount ?></td>
            </tr>
            <tr>
                <td colspan="12"></td>
                <td style="border-bottom-style: groove;" >Add Taxes @13.00%</td>
                <td style="border-bottom-style: groove;padding-top:10px;text-align: right"><?php echo $detail->total_amount * 0.13 ?></td>
            </tr>

            <tr>
                <td colspan="12"></td>
                <td style="border-bottom-style: groove;" >Net Amount</td>
                <td style="border-bottom-style: groove;padding-top:10px;text-align: right"><?php echo $detail->total_amount * 1.13 ?></td>
            </tr>
            <!-- ---- Price Calculation Section Ends ----- -->
            <tr>
				<td colspan="15" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td colspan="3">
					Amount in words : 
				</td>
				<td colspan="12">
					<?php $total = sprintf('%0.2f',$detail->total_amount * 1.13);?>
					<?php 
						$amount_array = explode('.',$total);
						$rupees = $amount_array[0];
						if(count($amount_array) == 2){
							$paisa = $amount_array[1];
						}else{
							$paisa = 0;
						}
					?> 
					Rs. <?php echo $this->number_to_words->convert_number($rupees) . (($paisa > 0)? (' And ' . $this->number_to_words->convert_number($paisa) . ' Paisa'):'');?> Only
				</td>
			</tr>
            
            
            
		</table>
	</div>

</body>
</html>
