<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.ico");?> " type="image/x-icon">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/project.min.css');?>"  />
    <style>
    * { font-family: 'Times New Roman'; }
	.right{text-align:right; padding-right: 10px;}
	.center{text-align:center;}
	.invoice-table>tr>td {
		text-align: left;
	}

	.invoice-table-head th, .invoice-table-head td{border: none!important; padding: 5px!important;}

	@media print {
	    * {
	        font-size: 99%
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

					<div class="row" style="padding:30px">
						<div class="col-xs-12 table-responsive">
							<table class="table invoice-table-head">	
								<tr>
									<td class="center">
										<!-- <h2><strong><?php echo $firm_name;?></strong></h2> -->
										<h2><strong><?php echo $info->firm;?></strong></h2>
										<br/>
										<h3>Order Confirmation</h3>
									</td>
								</tr>
							</table>

							<table class="table invoice-table-head">	
								<col width="13%">
								<col width="15%">
								<col width="8%">
								<col width="15%">
								<col width="8%">
								<col width="15%">
								<tr>
									<td colspan="6"><strong>Date:</strong> <?php echo date('Y-m-d');?></td>
								</tr>
								<?php if($info->bank_name == ''): ?>
									<tr style="font-weight:bold">                        
										<td>M/s</td>
										<td>: <?php echo $info->full_name ?></td>
									</tr>
								<?php else: ?>
									<tr style="font-weight:bold">                        
										<td>M/s</td>
										<td>: <?php echo $info->bank_name; ?></td>
									</tr>
									<tr style="font-weight:bold">
										<td>C/O</td>
										<td>: <?php echo $info->full_name ?></td>
									</tr>
								<?php endif; ?>
								<tr>
									<th>Tel (O):</th>
									<td><?php echo (isset($info->work_1)) ? $info->work_1 : '';?></td>
									<th>Fax:</th>
									<td><?php echo (isset($info->fax)) ? $info->fax : '';?></td>
									<th>Mobile:</th>
									<td><?php echo (isset($info->mobile_1)) ? $info->mobile_1 : '';?></td>
								</tr>
								<tr>
									<th>Tel (R):</th>
									<td><?php echo (isset($info->home_1)) ? $info->home_1 : '';?></td>
									<th>Email:</th>
									<td><?php echo (isset($info->email)) ? $info->email : '';?></td>
									<th>&nbsp;</th>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="6">
										<br />
										We are pleased to quote herewith the price of Suzuki vehicle as per details mentioned herein below:
										<br />
										<br />
									</td>
								</tr>
								<tr>
									<th>1.&nbsp;&nbsp;Model</th>
									<th colspan="5"><?php echo (isset($info->vehicle_name)) ? $info->vehicle_name : '';?> <?php echo (isset($info->variant_name)) ? $info->variant_name : '';?></th>
								</tr>
								<tr>
									<th>2.&nbsp;&nbsp;Color</th>
									<th colspan="5"><?php echo (isset($info->color_name)) ? $info->color_name : '';?></th>
								</tr>
								<tr>
									<th>3.&nbsp;&nbsp;Price</th>
									<th colspan="5"><?php echo (isset($actual_price)) ? 'NRs. ' . moneyFormat($actual_price). ' &nbsp; (In Words: ' . $acutal_price_words . ' Rupees only)': '';?>
											<span style="font-weight:normal;line-height:200%"><br />The above prices is subject to change without any prior notice in case of any changes in the prices of Maruti Suzuki India Ltd. or their Govt. Levies or the tax and other policies of Gov. of Nepal. The above price does not include contract tax. Maruti Suzuki India Ltd. reserves the right to change without notice color, equipments specifications and model and also the discontinue models.</span>
									</th>
								</tr>
								<tr>
									<th>4.&nbsp;&nbsp;Quanity</th>
									<!-- <th colspan="5"><?php echo (isset($quote_unit)) ? $quote_unit . ' Unit(s)' : '';?></th> -->
									<th colspan="5">1 Unit.</th>
								</tr>
								<tr>
									<th>5.&nbsp;&nbsp;Delivery</th>
									<td colspan="5">
										<span style="font-weight:normal;line-height:200%">Approximately within 90 days from the date of signing of order confirmation Delivery Date. Can get extended upto 120 days due to order shade/color non availability.</span>
									</td>
								</tr>
								<tr>
									<th>6.&nbsp;&nbsp;Booking Amount</th>
									<td colspan="5">
										<span style="font-weight:normal;line-height:200%">NRs. <?php echo moneyFormat($info->booking_amount);?>/- (In Words : <?php echo $booking_word;?>)</span>
									</td>
								</tr>
								<tr>
									<th>7.&nbsp;&nbsp;Cancellation</th>
									<td colspan="5">
										<span style="font-weight:normal;line-height:200%">If incase of cancellation of booking of the vehicle, minimum cancellation charge will be NRs. 5,000 /- (Five Thousand Only.)</span>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<br /><br /><br /><br /><br /><br />
										FOR <?php echo $info->firm;?>
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
