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
					<!-- <span style="text-align: center;"><h4><U>Order No.:<?php echo $order_no;?></U></h4></span> -->
					<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;" border="1">
						<tr>
							<th style="width:50px;padding-top:7px; padding-left: 10px;">S.N.</th>
							<th style="width:150px;padding-top:7px; padding-left: 10px;">Part Name</th>
							<th style="width:150px;padding-top:7px; padding-left: 10px;">Part Code</th>
							<th style="width:150px;padding-top:7px; padding-left: 10px;">location</th>
							<th style="width:100px;padding-top:7px; padding-left: 10px;">quantity</th>	
						</tr>
						<?php $total = 0; ?><?php ?>
						<?php foreach ($rows as $key => $value): ?>
							<tr> 
								<td  style="padding-top:7px;padding-left:10px"><?php echo $key + 1;?></td>
								<td  style="padding-top:7px;padding-left:10px;" ><?php echo $value->part_code;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->part_name;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->location;?></td>
								<td  style="padding-top:7px;padding-left:10px;"><?php echo $value->quantity;?></td>								     
							</tr>
							<?php  
							$total += $value->quantity;
							?>
						<?php endforeach; ?>
						<tr><td colspan="4" style="text-align:right">Total Quantity</td><td style="padding-left: 10px"><?php echo $total;?></td></tr>
					</table>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
<?php exit; ?>
