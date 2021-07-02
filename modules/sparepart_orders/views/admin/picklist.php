<html>
<head>
	<meta charset="UTF-8">
	<title>Picking List</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.ico");?> " type="image/x-icon">
	<!-- Bootstrap 3.3.4 -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/project.min.css');?>" />
	<style>
	* { font-family: 'Times New Roman'; }

	.right{text-align:right; padding-right: 80px;}
	.center{text-align:center;}

	@media print {
		* {
			font-size: 99%
		}
		.row { padding: 5px!important}
	}
	.text-main{
		font-size: 16px;
		margin-left: 10px;
		font-weight: bold;
		letter-spacing: .75px;
	}
	span{ 
		font-size: 16px;
		margin-left: 10px;
		font-weight: bold;
	}

	th,td{
		height: 20px;
	}

	.table-bordered>thead>tr>th, 
	.table-bordered>tbody>tr>th, 
	.table-bordered>tfoot>tr>th, 
	.table-bordered>thead>tr>td, 
	.table-bordered>tbody>tr>td, 
	.table-bordered>tfoot>tr>td {
		border: 1px solid #000000;
		font-size: 16px;
	}

</style>
</head>
<body class="skin-blue layout-top-nav">
	<div class="wrapper">      
		<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container">  
				<section class="invoice" style="max-width: 210mm;">
					<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;">
						<tr><td class="center" colspan="3"><b>PICKING LIST</b><br/></td></tr>
						<tr><td class="center" colspan="3"><label><?php echo @$dealer->name;?></label></td></tr>
						<tr><td class="right" colspan="3">Date: <?php echo date('Y-m-d');?></td></tr>
						<tr>
							<td>PI No.: <?php echo @$order_details->pi_number;?></td>
							<td class="center">Order No.: <?php echo $dealer->prefix."-".sprintf('%04d', @$order_no);?></td>
							<td class="right" >Picklist No.: <?php echo $rows[0]->picklist_format;?></td>
						</tr>
					</table>
					<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;">
						<tr>
							<td>Order Type: <?php echo @$order_details->order_type;?></td>
							<td class="center">Dispatch Mode: <?php echo @$order_details->dispatch_mode;?></td>
							<td class="right">Picker: <?php echo @$picker->picker_name;?></td>
						</tr>
					</table>
					<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;" border="1">
						<tr>
							<th style="width:40px;padding-top:7px; padding-left: 10px;">S.N.</th>
							<th style="width:80px;padding-top:7px; padding-left: 10px;">Part Code</th>
							<th style="width:80px;padding-top:7px; padding-left: 10px;">Ordered Code</th>
							<th style="width:100px;padding-top:7px; padding-left: 10px;">Part Name</th>
							<th style="width:60px;padding-top:7px; padding-left: 10px;">Req Qty</th>	
							<th style="width:140px;padding-top:7px; padding-left: 10px;">location</th>
							<th style="width:60px;padding-top:7px; padding-left: 10px;">Stock Qty</th>
						</tr>
						<?php $total = 0; ?>
						<?php foreach ($rows as $key => $value): ?>
							<tr> 
								<td  style="padding-top:7px;padding-left:10px"><?php echo $key + 1;?></td>
								<td  style="padding-top:7px;padding-left:10px;" ><?php echo $value->part_code;?></td>
								<td  style="padding-top:7px;padding-left:10px;" ><?php echo $value->ordered_part_code;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo substr($value->name,0,11);?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->dispatch_quantity;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo ($value->location)?$value->location:'not in action';?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo ($value->stock_quantity < 0 || $value->stock_quantity == '')?0:$value->stock_quantity;?></td>
							</tr>
							<?php  
							$total += $value->dispatch_quantity;
							?>
						<?php endforeach; ?>
						<tr><td colspan="4" style="text-align:right">Total Quantity</td><td colspan="3" style="padding-left: 10px"><?php echo $total;?></td></tr>
					</table>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
