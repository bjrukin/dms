<!-- saved from url=(0058)http://192.168.1.197/cgdms/admin/customers/quotation/80070 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Quotation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="http://192.168.1.197/cgdms/assets/icons/favicon.ico" type="image/x-icon">
    <!-- Bootstrap 3.3.4 -->
    <!--<link rel="stylesheet" type="text/css" href="./Quotation_files/project.min.css">-->
    <style>
        * {
            font-family: Arial;
            font-size: 13px;
            line-height: 1.4em !important;
        }

        p {
            margin-bottom: 10px
        }

        .logo-container {
            display: flex;
            align-items: center;
            text-align: center;
            position: relative;
            height: 60px;
        }

        .logo-container img {
            position: absolute;
            left: 0;
            right: 0;
        }

        .logo-container p {
            width: 100%;
            text-align: center;
        }

        section {
            padding: 15px;
        }

        ul {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            width: 100%;
            margin: 0;
            font-size: 12px;
        }

        .content-head li {
            padding-bottom: 10px;
        }

        .content-head li:first-of-type {
            padding-right: 10px;
            font-weight: bold;
            width: calc(40% - 10px);
        }

        .content-head li:last-of-type {
            width: 60%;
        }

        .content-body ul {
            padding: 15px;
            width: calc(100% - 30px);
        }

        .content-body ul:nth-of-type(odd) {
            background: #f0f0f0;
        }

        .content-body ul:nth-of-type(even) {
            background: #e1e1e1;
        }

        .content-body li {
            width: 100%;
        }

        .content-body li:first-of-type {
            font-weight: bold;
        }

        .content-body li:last-of-type {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        @media print {
            * {
                font-size: 10px;
                line-height: 0.7em;
            }

            .row {
                padding: 0 !important
            }
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
                <div class="logo-container">
                    <img src="<?php echo base_url('assets/images/logo_png.png') ?>" width="60px">
                    <?php if(is_admin() ||  $dealer_id == 1 || $dealer_id == 2 || $dealer_id = 75 || $dealer_id = 111): ?> 
					<?php else: ?>
						<span><strong><?php echo $firm_name;?></strong></span></br>
					<?php endif; ?>
                    <p style="font-size: 18px;">Quotation</p>
                </div>
                <div class="date-container">
                    <p style="float: right"><strong>Date:</strong>  <?php echo $quotation_date_en;?></p>
                </div>
                <div class="content">
                    <div class="content-head">

                    	<?php if($bank_name == ''): ?>
						 	<ul style="font-weight: bold">
	                            <li>M/s:</li>
	                        </ul>
	                        <ul style="font-weight: bold">
	                            <li><?php "{$first_name} {$middle_name} {$last_name}"?></li>
	                        </ul>
						<?php else: ?>
							<ul style="font-weight: bold">
	                            <li>M/s:</li>
	                            <li>C/Os:</li>
	                        </ul>
	                        <ul style="font-weight: bold">
	                        	<?php echo $bank_name; ?>
	                            <li><?php "{$first_name} {$middle_name} {$last_name}"?></li>
	                        </ul>
						<?php endif; ?> 
                        <ul>
                            <li>Tel (O):</li>
                            <li><?php echo (isset($work_1)) ? $work_1 : '';?></li>
                        </ul>
                        <ul>
                            <li>Tel (R):</li>
                            <li><?php echo (isset($home_1)) ? $home_1 : '';?></li>
                        </ul>
                        <ul>
                            <li>Fax:</li>
                            <li><?php echo (isset($fax)) ? $fax : '';?></li>
                        </ul>
                        <ul>
                            <li>Mobile:</li>
                            <li><?php echo (isset($mobile_1)) ? $mobile_1 : '';?></li>
                        </ul>
                        <ul>
                            <li>Email:</li>
                            <li><?php echo (isset($email)) ? $email : '';?></li>
                        </ul>
                        <ul style="font-weight: bold">
                            <li>Inquiry No.:</li>
                            <li><?php echo (isset($inquiry_no))? $inquiry_no: ''; ?></li>
                        </ul>
                    </div>
                    <div class="content-body">
                        <p>We are pleased to quote herewith the price of Suzuki vehicle as per details
                            mentioned herein below:</p>
                        <ul>
                            <li>1.&nbsp;&nbsp;Model</li>
                            <li><?php echo (isset($vehicle_name)) ? $vehicle_name : '';?></li>
                        </ul>
                        <ul>
                            <li>2.&nbsp;&nbsp;Variant</li>
                            <li><?php echo (isset($variant_name)) ? $variant_name : '';?></li>
                        </ul>
                        <ul>
                            <li>3.&nbsp;&nbsp;Color</li>
                            <li><?php echo (isset($color_name)) ? $color_name : '';?></li>
                        </ul>
                        <ul>
                            <li>4.&nbsp;&nbsp;Price</li>
                            <li><b><?php echo (isset($quote_price)) ? 'NRs. ' . $quote_price . ' &nbsp; (In Words: ' . $in_words . ' Rupees Only)': '';?> </b><span style="font-weight:normal;line-height:180%"><br>The above prices is subject to change without any prior notice in case of any changes in the prices of Maruti Suzuki India Ltd. or their Govt. Levies or the tax and other policies of Gov. of Nepal. The above price does not include contract tax. Maruti Suzuki India Ltd. reserves the right to change without notice color, equipments specifications and model and also the discontinue models.</span>
                            </li>
                        </ul>
                        <ul>
                            <li>5.&nbsp;&nbsp;Quanity</li>
                            <li><?php echo (isset($quote_unit)) ? $quote_unit . ' Unit(s)' : '';?></li>
                        </ul>
                        <ul>
                            <li>6.&nbsp;&nbsp;Delivery</li>
                            <li>Approximately within 90 days from the date of signing of order confirmation Delivery
                                Date
                            </li>
                        </ul>
                        <ul>
                            <li>7.&nbsp;&nbsp;Payment Terms:</li>
                            <li>Should be 100 % secured by bank / cash payment or Delivery Order (DO)/ Purchase Order
                                (PO). . Interest will be charged @ 12% p.a. for any payment of DO / PO not received
                                within 30 days of delivery.
                            </li>
                        </ul>
                        <ul>
                            <li>8.&nbsp;&nbsp;Force Majeure</li>
                            <li>The delivery clause is subject to "Force Majeure" circumstance.</li>
                        </ul>
                        <ul>
                            <li>9.&nbsp;&nbsp;Validity</li>
                            <li>The quotation is valid for 30 days, however theprice may change without prior notice in
                                case of any change in the price of Maruti Suzuki India Ltd of their Govt Levies or the
                                tax and other policies of Gov. of Nepal.
                            </li>
                        </ul>
                        <ul>
                            <li>10.&nbsp;&nbsp;After Sales Service</li>
                            <li>We also provide 8 free servicing upto 30000 KM or two year whichever is earlier form the
                                date of delivery at Suzuki Authorized Service Station only.
                            </li>
                        </ul>
                        <ul>
                            <li>10.&nbsp;&nbsp;After Sales Service</li>
                            <li>We also provide 8 free servicing upto 30000 KM or two year whichever is earlier form the
                                date of delivery at Suzuki Authorized Service Station only.
                            </li>
                        </ul>
                        <ul>
                            <li>11.&nbsp;&nbsp;Warranty</li>
                            <li>The vehicle will be covered under warranty for manufacturing defect for 4 years or 60000
                                KMS whichever is earlier from the date of delivery. This warranty applies to the repair
                                of replacement of <strong>manufacturing defects only as</strong> as per acceptance of
                                Maruti Suzuki India Ltd Warranty is covered as per the warranty policy of Maruti Suzuki
                                India Ltd.
                            </li>
                        </ul>
                        <ul>
                            <li>12.&nbsp;&nbsp;Cancellation</li>
                            <li>Nrs.5,000/- of the order amount is to be paid by the client in case of order
                                cancellation as cancellation charge.
                            </li>
                        </ul>
                        <?php if(is_admin() || $dealer_id != 75):?>
	                        <ul>
	                            <li>13.&nbsp;&nbsp;Remarks</li>
	                            <li><?php echo $remarks;?></li>
	                        </ul>
						<?php endif; ?>
						<?php if(is_admin() ||  $dealer_id == 1 || $dealer_id == 2 || $dealer_id = 75 || $dealer_id = 111): ?> 
	                        <ul>
	                            <li></li>
	                            <li><b>Note : Below mentioned companies are our sister concern companies and we hereby
	                                delcare that the delivery of the vehicles shall be provided from any of these companies:
	                                Arun Intercontinental Traders, Shree Himalayan Enterprises Pvt. Ltd., Associated
	                                Automoblies Pvt. Ltd., Wheels Auto Pvt. Ltd. , Surya Automobiles Pvt. Ltd. and KMC
	                                Automobiles Pvt. Ltd.</b></li>
	                        </ul>
                        <?php endif; ?>
                    </div>
                    <div class="content-footer">
                        <p>FOR,<br>
                        	<?php if(is_admin() ||  $dealer_id == 1 || $dealer_id == 2 || $dealer_id = 75 || $dealer_id = 111): ?> 
								KMC Automobiles Pvt. Ltd.<br>
								Surya Automobiles Pvt. Ltd.<br>
								Wheels Auto Pvt. Ltd.<br>
								Associated Automobiles Pvt. Ltd. 	
							<?php else: ?>
								<?php echo $firm_name;?>
							<?php endif; ?>
                    </div>
                </div>
            </section>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->


</body>
</html>