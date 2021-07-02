<p style="text-align: center;font-size: 18px"><b><U>Proforma Invoice</U></b></p>
<p style="text-align: center;margin-top: -7px">Shree Himalayan Enterprises Pvt. Ltd</p>
<p style="text-align: center;margin-top: -7px">Spare Parts Logistic - Satungal</p>
<br/>
<table style="width: 100%;">
	<tr>
		<th style="width: 25%">PI No:</th><th style="width: 25%">HPEL-<?php echo $pi_id; ?></th> 
		<th style="width: 25%">Order recv.</th><th style="width: 25%"><?php echo date_format(date_create($header_info->created_at),"Y-m-d"); ?></th>
	</tr>
	<tr>
		<th style="width: 25%">Dealer:</th><th style="width: 25%"><?php echo $header_info->dealer_name; ?></th> 
		<th style="width: 25%">PI Issue Date.</th><th style="width: 25%"><?php echo $header_info->pi_generated_date_time; ?></th>
	</tr>
	<tr>
		<th style="width: 25%">Address:</th><th style="width: 25%"><?php echo $header_info->address_1.', '.$header_info->district_name; ?></th> 
		<th style="width: 25%">Effective Date</th><th style="width: 25%"><?php echo date('Y-m-d'); ?></th>
	</tr>
	<tr>
		<th style="width: 25%"></th><th style="width: 25%"></th> 
		<th style="width: 25%">Ord. Type</th><th style="width: 25%"><?php echo  $header_info->order_type;?></th>
	</tr>
</table>
<br/>

<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;" border="1">
	<tr>
		<th style="width:20px;padding-top:7px; padding-left: 10px;">S.N.</th>
		<th style="width:150px;padding-top:7px; padding-left: 10px;">PART CODE</th>
		<th style="width:180px;padding-top:7px; padding-left: 10px;">PART NAME</th>
		<th style="width:30px;padding-top:7px; padding-left: 10px;">QTY</th>
		<th style="width:100px;padding-top:7px; padding-left: 10px;">RATE</th>	
		<th style="width:100px;padding-top:7px; padding-left: 10px;">TOTAL</th>	
	</tr>
	<?php $total = 0; ?>
	<?php foreach ($rows as $key => $value): ?>
		<tr>
			<th style="width:20px;padding-top:7px; padding-left: 10px;"><?php echo $key + 1; ?></th>
			<th style="width:150px;padding-top:7px; padding-left: 10px;"><?php echo $value->part_code; ?></th>
			<th style="width:180px;padding-top:7px; padding-left: 10px;"><?php echo $value->name; ?></th>
			<th style="width:30px;padding-top:7px; padding-left: 10px;"><?php echo $value->order_quantity; ?></th>
			<th style="width:100px;padding-top:7px; padding-left: 10px;"><?php echo moneyFormat($value->dealer_price);?></th>	
			<th style="width:100px;padding-top:7px; padding-left: 10px;"><?php echo moneyFormat($value->order_quantity * $value->dealer_price);?></th>	
		</tr>
		<?php  $total += $value->order_quantity * $value->dealer_price;?>
	<?php endforeach; ?>
	<tr><th colspan="5" style="text-align:right;padding-top:7px;padding-right: 5px;">Total Amount</th><th style="padding-left: 10px; padding-top:7px;"><?php echo moneyFormat($total);?></th></tr>	
</table>
<p><b>Note: Above mentioned rate is excluding the vat amount.</b></p>