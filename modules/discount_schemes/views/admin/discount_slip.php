 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>Discount Slip</title>
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
			<div class="container">      			<!-- Main content -->
				<section class="invoice" style="max-width: 210mm;">
					<h3 align="center"><U>DISCOUNT SLIP</U></h3>
					<span style="float: right;">Date: <?php echo date('Y-m-d');?></span>
					<br/> <br/>
					<div class="row">						
						<div class="col-md-12">
							<?php if($rows->approval == 2): ?>
								<span>Discount request of inquiry number <?php echo @$rows->inquiry_no ?> with amount Rs. <?php echo @moneyFormat($rows->discount_request) ?>/- on date <?php echo @date_format(date_create($rows->created_at),"Y-m-d");?> of the customer <?php echo @$rows->full_name?> has been approved.</span>
								<?php else: ?>
									<span>Discount request of inquiry number <?php echo @$rows->inquiry_no ?> with amount Rs. <?php echo @moneyFormat($rows->discount_request) ?>/- by <?php echo @$rows->request_name;?> on date <?php echo @date_format(date_create($rows->created_at),"Y-m-d");?> of the customer <?php echo @$rows->full_name?> has been approved by <?php echo @$rows->approved_name ?> with amount Rs. <?php echo @moneyFormat(
										($rows->reduced_discount)?$rows->reduced_discount : $rows->discount_request)?>/- on the date <?php echo @$rows->approved_date?>.</span>
									<?php endif; ?>
								</div>
								<br/><br/><br/>
								<div class="col-md-12">
									<h4><b><u>Vehicle Details</u></b></h4>
									<table>
										<tr>
											<th><label>Vehicle</label></th>
											<td> : </td>
											<td><?php echo @$rows->vehicle_name?></td>
										</tr>
										<tr>
											<th><label>Varinat</label></th>
											<td> : </td>
											<td><?php echo @$rows->variant_name ?></td>
										</tr>
										<tr>
											<th><label>Color</label></th>
											<td> : </td>
											<td><?php echo @$rows->color_name ?></td>
										</tr>
									</table>
									<br/><br/><br/><br/><br/>
									<div class="col-md-12" style="margin-left: 2px">
										<table style="width: 90%">
											<tr>
												<td><b>.......................................</b></td>
											</tr>
											<tr>
												<td>( Authorized Signature )</td>
											</tr>
										</table>					
									</div>
								</div>
							</div>
						</section>
					</div><!-- /.container -->
				</div><!-- /.content-wrapper -->
			</div><!-- ./wrapper -->
		</body>
		</html>
