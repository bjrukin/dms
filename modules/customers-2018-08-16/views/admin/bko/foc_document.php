<html>
<head>
	<meta charset="UTF-8">
	<title>FOC</title>
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
				<?php //echo '<pre>'; print_r($rows); print_r($accessories); exit; ?>
				<section class="invoice" style="max-width: 210mm;">
					<h2 align="center"><?php echo $dealer->name;?></h2>
					<h3 align="center"><U>MEMO FOR F.O.C. ACCESSORIES</U></h3>
					<div class="row">						
						<div class="col-md-11" style="margin-left: 3px">
							<span>Dear Sir,</span><br/>
							<span class="text-main"> We are glad to allow you to have the following accessories on Free of Cost</span><br/>
							<span class="text-main"> basis to be provided in your vehicle booked with vide our order confirmation </span><br/>
							<span class="text-main"> No. <?php echo $rows->customer_id; ?> dated <?php echo date("Y-m-d", strtotime($rows->created_at));;?>.
							</span><br/>
							<span>
								Vehicle Name: <?php echo $rows->vehicle_name.' '.$rows->variant_name .' '.$rows->color_name;?>  
							</span>
						</div>
					</div>
					<div class="row" style="padding:30px; height: 500px">
						<div class="col-xs-12 table-responsive">
							<table class="table table-bordered">
								<tr>
									<th style="width: 7%">S.No.</th>
									<th style="width: 73%">Particular</th>
									<th>Quantity</th>
								</tr>
								<tr>
									<td>1</td>
									<td>Fuel</td>
									<td><?php echo $rows->fuel;?></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Free Service</td>
									<td><?php echo $rows->free_servicing;?></td>
								</tr>
								<tr>
									<td>3</td>
									<td><?php if($rows->name_transfer == 1)
										{ 
											echo "Transfered";
										} 
										else 
										{
											echo "Not Transfered";
										} 
										?></td>
										<td></td>
									</tr>
									<tr>
										<td>4</td>
										<td>Road Tax</td>
										<td><?php echo $rows->road_tax;?></td>
									</tr>
									<?php  $count = 5;  ?>
									<?php foreach ($accessories as $key => $value):?>									
										<tr>
											<td><?php echo $count++; ?></td>
											<td><?php echo $value->name;?></td>
											<td>1</td>
										</tr>
									<?php endforeach; ?>

								</table>
								<table class="table table-bordered" style="width: 46%">
									<tr>
										<th>Engine No:</th>
										<td><?php echo $rows->engine_no; ?></td>
									</tr>
									<tr>
										<th>Chassis No:</th>
										<td><?php echo $rows->chass_no; ?></td>
									</tr>
								</table>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<span>This is being allowed to you as a special privilege.</span><br/>
												
						<span>Yours sincerely,</span><br/><br/>
						<span> From <?php echo $dealer->name; ?> ( <?php echo $dealer->address_1.', '.$dealer->district_name; ?> ),</span><br/><br/><br/>
						<div class="row">
							<div class="col-md-12" style="margin-left: 10px">
								<table style="width: 90%">
									<tr>
										<td><b>.......................................</b></td>
										<td style="text-align: right;"><b>..................................</b></td>
									</tr>
									<tr>
										<td>( Authorized Signature )</td>
										<td style="text-align: right;">( Signature of Client )</td>
									</tr>
								</table>					
							</div>
						</div>
					</section>
				</div><!-- /.container -->
			</div><!-- /.content-wrapper -->
		</div><!-- ./wrapper -->
	</body>
	</html>
