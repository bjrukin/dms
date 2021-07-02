<!-- <?php //echo '<pre>';print_r($rows); exit; ?> -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Binning List</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.ico");?> " type="image/x-icon">
	<!-- Bootstrap 3.3.4 -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/project.min.css');?>"  />
	<style>
		* { font-family: 'Times New Roman'; }
		.right{text-align:right; padding-right: 10px;}
		.center{text-align:center;}

		@media print {
			* {
				font-size: 99%
			}
			.row { padding: 5px!important}
		}
		.text-main{
			font-size: 18px;
			margin-left: 10px;
			font-weight: bold;
			letter-spacing: .75px;
		}
		span{ 
			font-size: 16px;
			margin-left: 10px;
			font-weight: bold;
		}

		span{ 
			font-size: 16px;
			margin-left: 10px;
			font-weight: bold;
		}

		th,td{
			height: 25px;
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
					<span style="text-align: center;"><h3><U>Binning List</U></h3></span>

					<h4>
						Invoice Number: <b><?php echo isset($rows[0]->invoice_no)?$rows[0]->invoice_no:''?></b>
					</h4>
					<h5>
						Invoice Number: <b><?php echo isset($rows[0]->invoice_no)?$rows[0]->invoice_no:''?></b>
					</h5>
					<!-- <span style="text-align: center;"><h4><U>Order No.:<?php echo $order_no;?></U></h4></span> -->
					<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;" border="1">
						<tr>
							<!-- <th style="width:40px;padding-top:7px; padding-left: 10px;">Box No.</th> -->
							<th style="width:150px;padding-top:7px; padding-left: 10px;">Part Code</th>
							<th style="width:80px;padding-top:7px; padding-left: 10px;">Part Name</th>
							<th style="width:20px;padding-top:7px; padding-left: 10px;">Qty</th>	
							<th style="width:250px;padding-top:7px; padding-left: 10px;">Scanner Name</th>	
							<th style="width:150px;padding-top:7px; padding-left: 10px;">location</th>
						</tr>
						<?php $total = 0; ?><?php ?>
						<?php foreach ($rows as $key => $value): ?>
								<!-- <?php // if($key != 0 && $rows[$key]->box_no !=  $rows[$key-1]->box_no): ?>
									<tr>
										<td colspan="5"></td>
									</tr>
								<?php //endif; ?>	 -->
							<tr> 
								<!-- <td  style="padding-top:7px;padding-left:10px"><?php echo $value->box_no;?></td> -->
								<td  style="padding-top:7px;padding-left:10px;" ><?php echo $value->part_code;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo substr($value->part_name,0,10); ?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->quantity;?></td>						     
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->scanner_name;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->location;?></td>
							</tr>
							<?php  
							$total += $value->quantity;
							?>
						<?php endforeach; ?>
						<tr><td colspan="2" style="text-align:right">Total Quantity</td><td colspan="3" style="padding-left: 10px"><?php echo $total;?></td></tr>
					</table>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
<?php exit; ?>
