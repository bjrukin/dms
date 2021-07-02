<html>
<head>
    <meta charset="UTF-8">
    <title>CREDIT NOTE</title>
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
                    <div style="padding-bottom: -20px;"><img src="<?php echo base_url("assets/images/suzuki-logo.jpg")?>" alt="suzuki logo"></div>
                    <table cellspacing="5" cellpadding="0" style="width:700px">
                        <tr><td colspan="3" style="padding-left:300px; text-decoration:underline"><h2>CREDIT NOTE</h2></td>
                        </tr>

                        <tr>
                            <td colspan="3">Date:</td>
                        </tr>

                        <tr>
                            <td colspan="3">Dear Customer,</td>
                        </tr>

                        <tr>
                            <td colspan="3">As a special privilege,we are pleased to offer you a net Cash discount of Rs.<b><?php echo moneyFormat(($info->customer_discount_amount)?$info->customer_discount_amount:$info->normal_discount);?>/-</b> (Amount
                                in words: <b><?php echo ucwords($discount_amount); ?> Only</b>). Against the purchase of brand new Suzuki vehicle having details as under:</td>
                            </tr>

                            <tr>
                                <td style="width:20%; padding-top: 15px;">Model  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"> <?php echo $info->vehicle_name.' '.$info->variant_name; ?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Vehicle Cost  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;">Rs. <?php echo moneyFormat($info->quote_mrp); ?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Engine No  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"> <?php echo $info->engine_no;?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Chasis No  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"> <?php echo $info->chass_no;?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Vehicle Regd No</td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight:bold;">Customer Name and Financing Institute</td>
                            </tr>

                            <tr>
                                <td style="width:20%; padding-top: 15px;">Name  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"><?php echo $info->full_name ?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Address  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"><?php echo $info->address_1 ?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Financing Institute  </td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"><?php echo $info->bank_name ?></td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Loan Amount</td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;">Rs. <?php echo moneyFormat($loan_amount); ?>

                                </td>
                            </tr>
                            <tr>
                                <td style="width:20%; padding-top: 15px;">Mobile No</td>
                                <td style="width:5%; padding-top: 15px;">:</td>
                                <td style="width:75%; padding-top: 15px;"><?php echo $info->mobile_1 ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight:bold">Dealership Stamp & Authorized Signature</td>
                            </tr>

                            <tr>
                                <td colspan="3" style="font-weight:bold;padding-top:20%; padding-top: 15px;">..............................</td>
                            </tr>

                            <tr>
                                <td style="width:30%; padding-top: 15px;" style="font-weight:bold;border:3%; padding-top: 15px; border: 2px solid black;">Customer Acceptance</td>
                                <td style="width:70%; padding-top: 15px;" colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight:bold; padding-top: 15px;">I hearby accept that I am responsible for the ownership transfer and clear all dues amount of above mentioned vehicles before 30days from the date of delivery.Further, I am liable if the date exceeds and will bear privailling interest rate of the remaining (Loan) amount to the company as per the CG| Motocorp Policy.</td>
                            </tr>

                            <tr>
                                <td colspan="3" style="padding-top:20%; padding-top: 15px;;font-weight:bold">........................................<br>
                                    Customer Signature(Stamp)<br>
                                    <span style="text-decoration:underline;">Thank you once agian for patronizing Suzuki Brand of Vehicles</span>    
                                </td>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>