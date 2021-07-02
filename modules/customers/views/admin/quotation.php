 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>Quotation</title>
 	<!-- Tell the browser to be responsive to screen width -->
 	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 	<link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.ico");?> " type="image/x-icon">
 	<!-- Bootstrap 3.3.4 -->
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/project.min.css');?>"  />
 	<style>
 		* { 
 			font-family: 'Times New Roman';
 			font-size: 16px;
 			line-height: 1.4em !important; 
 		}

 		p{
 			margin-bottom: 10px
 		}
 		.right{text-align:right; padding-right: 10px;}
 		.center{text-align:center;}
 		.invoice-table>tr>td {
 			text-align: left;
 		}

 		.invoice-table-head th, .invoice-table-head td{
 			border: none!important; 
 			padding: 0 0 10px 0 !important;
 		}

 		@media print {
 			* {
 				font-size: 10px;
 				line-height: 0.7em;
 			}
 			.row { padding: 0px!important}
 		}

 	</style>
 </head>
 <body class="skin-blue layout-top-nav">
 	<div class="wrapper">      
 		<!-- Full Width Column -->
 		<div class="content-wrapper">
 			<div class="container">
 				<!-- Main content -->
 				<section class="invoice">

 					<div class="row" style="padding:10px">
 						<div class="col-xs-12 table-responsive">
 							<table class="table invoice-table-head">	
 								<tr>
 									<td><img src="<?php echo base_url('assets/images/logo_png.png') ?>" width ="60px" ></td>
 									<td>
 										<?php if(is_admin() ||  $dealer_id == 1 || $dealer_id == 2 || $dealer_id = 75 || $dealer_id = 111): ?> 
 										<?php else: ?>
 											<span style="font-size: 22px;"><strong><?php echo $firm_name;?></strong></span></br>
 										<?php endif; ?>

 										<span style="font-size: 18px;">Quotation</span></br>
 									</td>	
 								</tr>
 							</table>

 							<table class="table invoice-table-head" >	
 								<col width="13%">
 								<col width="15%">
 								<col width="8%">
 								<col width="15%">
 								<col width="8%">
 								<col width="15%">
 								<tr>
 									<td colspan="6"><p style="float: right"><strong>Date:</strong> <?php echo $quotation_date_en;?></p></td>
 								</tr>
 								<!-- <tr>
 									<td colspan="6">
 										<br />
 										M/s <?php echo "{$first_name} {$middle_name} {$last_name}";?>
 										<br />
 										<br />
 									</td>
 								</tr> -->
 								<?php if($bank_name == ''): ?>
 									<tr style="font-weight:bold">                        
 										<td>M/s</td>
 										<td>: <?php "{$first_name} {$middle_name} {$last_name}"?></td>
 									</tr>
 								<?php else: ?>
 									<tr style="font-weight:bold">                        
 										<td>M/s</td>
 										<td>: <?php echo $bank_name; ?></td>
 									</tr>
 									<tr style="font-weight:bold">
 										<td>C/O</td>
 										<td>: <?php echo "{$first_name} {$middle_name} {$last_name}" ?></td>
 									</tr>
 								<?php endif; ?> 
 								<tr>
 									<th>Tel (O):</th>
 									<td><?php echo (isset($work_1)) ? $work_1 : '';?></td>
 									<th>Fax:</th>
 									<td><?php echo (isset($fax)) ? $fax : '';?></td>
 									<th>Mobile:</th>
 									<td><?php echo (isset($mobile_1)) ? $mobile_1 : '';?></td>
 								</tr>
 								<tr>
 									<th>Tel (R):</th>
 									<td><?php echo (isset($home_1)) ? $home_1 : '';?></td>
 									<th>Email:</th>
 									<td><?php echo (isset($email)) ? $email : '';?></td>
 									<th>&nbsp;</th>
 									<td>&nbsp;</td>
 								</tr>
 								<tr>
 									<th>Inquiry No.:</th>
 									<th><?php echo (isset($inquiry_no))? $inquiry_no: ''; ?></th>
 								</tr>
 								<tr>
 									<td colspan="6">
 										We are pleased to quote herewith the price of Suzuki vehicle as per details mentioned herein below:
 										<br />
 									</td>
 								</tr>
 								<tr>
 									<th>1.&nbsp;&nbsp;Model</th>
 									<th colspan="5"><?php echo (isset($vehicle_name)) ? $vehicle_name : '';?></th>
 								</tr>
 								<tr>
 									<th>2.&nbsp;&nbsp;Variant</th>
 									<th colspan="5"><?php echo (isset($variant_name)) ? $variant_name : '';?></th>
 								</tr>
 								<tr>
 									<th>3.&nbsp;&nbsp;Color</th>
 									<th colspan="5"><?php echo (isset($color_name)) ? $color_name : '';?></th>
 								</tr>
 								<tr>
 									<th>4.&nbsp;&nbsp;Price</th>
 									<th colspan="5"><?php echo (isset($quote_price)) ? 'NRs. ' . $quote_price . ' &nbsp; (In Words: ' . $in_words . ' Rupees Only)': '';?>
 										<span style="font-weight:normal;line-height:180%"><br />The above prices is subject to change without any prior notice in case of any changes in the prices of Maruti Suzuki India Ltd. or their Govt. Levies or the tax and other policies of Gov. of Nepal. The above price does not include contract tax. Maruti Suzuki India Ltd. reserves the right to change without notice color, equipments specifications and model and also the discontinue models.</span>
 									</th>
 								</tr>
 								<tr>
 									<th>5.&nbsp;&nbsp;Quanity</th>
 									<th colspan="5"><?php echo (isset($quote_unit)) ? $quote_unit . ' Unit(s)' : '';?></th>
 								</tr>
 								<tr>
 									<th>6.&nbsp;&nbsp;Delivery</th>
 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">Approximately within 90 days from the date of signing of order confirmation Delivery Date</span>
 									</td>
 								</tr>
 								<tr>
 									<th>7.&nbsp;&nbsp;Payment Terms:</th>
 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">Should be 100 % secured by bank / cash payment or Delivery Order (DO)/ Purchase Order (PO). . Interest will be charged @ 12% p.a. for any payment of DO / PO not received within 30 days of delivery.</span>
 									</td>
 								</tr>
 								<tr>
 									<th>8.&nbsp;&nbsp;Force Majeure</th>
 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">The delivery clause is subject to "Force Majeure" circumstance.</span>
 									</td>
 								</tr>
 								<tr>
 									<th>9.&nbsp;&nbsp;Validity</th>
 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">The quotation is valid for 30 days, however theprice may change without prior notice in case of any change in the price of Maruti Suzuki India Ltd of their Govt Levies or the tax and other policies of Gov. of Nepal.</span>
 									</td>
 								</tr>
 								<tr>
 									<th>10.&nbsp;&nbsp;After Sales Service</th>
 									<!-- <td colspan="5">
 										<span style="font-weight:normal;line-height:180%">We also provide 4 free servicing or a year whichever is earlier form the date of delivery at Suzuki Authorized Service Station only.</span>
 									</td> -->
 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">We also provide <?php echo ($vehicle_id == 7 || $vehicle_id == 12 || $vehicle_id == 11 || $vehicle_id == 15 || $vehicle_id == 38)?'4':'8' ?> free servicing upto 30000 KM or two year whichever is earlier form the date of delivery at Suzuki Authorized Service Station only.</span>
 									</td>
 								</tr>
 								<tr>
 									<th>11.&nbsp;&nbsp;Warranty</th>
 									<!-- <td colspan="5">
 										<span style="font-weight:normal;line-height:180%">The vehicle will be covered under warranty for manufacturing defect for 2 years or 24000 KMS whichever is earlier from the date of delivery. This warranty applies to the repair of replacement of <strong>manufacturing defects only as</strong> as per acceptance of Maruti Suzuki India Ltd Warranty is covered as per the warranty policy of Maruti Suzuki India Ltd.</span>
 									</td> -->

 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">The vehicle will be covered under warranty for manufacturing defect for <?php echo ($vehicle_id == 7 || $vehicle_id == 12 || $vehicle_id == 11 || $vehicle_id == 15 || $vehicle_id == 38)?'2':'4' ?>  years or 60000 KMS whichever is earlier from the date of delivery. This warranty applies to the repair of replacement of <strong>manufacturing defects only as</strong> as per acceptance of Maruti Suzuki India Ltd Warranty is covered as per the warranty policy of Maruti Suzuki India Ltd.</span>
 									</td>
 								</tr>
 								<tr>
 									<th>12.&nbsp;&nbsp;Cancellation</th>
 									<!-- <td colspan="5">
 										<span style="font-weight:normal;line-height:180%">2% of the order amount is to be paid by the client in case of order cancellation as cancellation charge.</span>
 									</td> -->
 									<td colspan="5">
 										<span style="font-weight:normal;line-height:180%">Nrs.5,000/- of the order amount is to be paid by the client in case of order cancellation as cancellation charge.</span>
 									</td>
 								</tr>
 								<?php if(is_admin() || $dealer_id != 75):?>
 									<!-- <tr>
 										<th>13.&nbsp;&nbsp;Discount</th>
 										<td colspan="5">
 											<span style="font-weight:normal;line-height:180%">NRs. <?php echo $discount;?> (<?php echo $dis_inword;?>)</span>
 										</td>
 									</tr> -->
 									<tr>
 										<th>13.&nbsp;&nbsp;Remarks</th>
 										<td colspan="5">
 											<span style="font-weight:normal;line-height:180%"><?php echo $remarks;?></span>
 										</td>
 									</tr>
 								<?php endif; ?>
 								<tr>
									<?php if(is_admin() ||  $dealer_id == 1 || $dealer_id == 2 || $dealer_id = 75 || $dealer_id = 111): ?> 
 										<tr>
 											<th></th>
 											<td colspan="5">
 												<span style="font-weight:normal;line-height:120%"><b>Note : Below mentioned companies are our sister concern companies and we hereby delcare that the delivery of the vehicles shall be provided from any of these companies: Arun Intercontinental Traders, Shree Himalayan Enterprises Pvt. Ltd., Associated Automoblies Pvt. Ltd., Wheels Auto Pvt. Ltd. , Surya Automobiles Pvt. Ltd. and KMC Automobiles Pvt. Ltd.</b> </span> 										
 											</td>
 										</tr>
 									<?php endif; ?>
 									<td colspan="6">
 									</br> </br> </br>

 										FOR,<br> 
 										<?php if(is_admin() ||  $dealer_id == 1 || $dealer_id == 2 || $dealer_id = 75 || $dealer_id = 111): ?> 
	 										KMC Automobiles Pvt. Ltd.<br>
											Surya Automobiles Pvt. Ltd.<br>
											Wheels Auto Pvt. Ltd.<br>
											Associated Automobiles Pvt. Ltd. 	
 										<?php else: ?>
 											<?php echo $firm_name;?>
 										<?php endif; ?>

 										<!-- FOR <?php echo $dealer->name;?> -->
 									</td>
 								</tr>

 							</table>
 						</div><!-- /.col -->
 					</div><!-- /.row -->
 				</section>
 			</div><!-- /.container -->
 		</div><!-- /.content-wrapper -->
 	</div><!-- ./wrapper -->
 </body>
 </html>
