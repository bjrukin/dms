<html>
<head>
    <meta charset="UTF-8">
    <title>Allotment Letter</title>
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
                    <img src="<?php echo base_url("assets/images/suzuki-logo.jpg")?>" style="height:100px">
                    <table  cellspacing="0" cellpadding="7" style="width:'85%'">
                        <tr>
                            <td colspan="2" style="text-align:center;text-decoration:underline">
                                <h1>VEHICLE DETAILS</h1>
                            </td>
                        </tr>

                        <tr style="font-weight:bold">
                            <td style="width:15%">Date</td>
                            <td style="width:85%">: <?php echo date('Y-m-d'); ?></td>
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
                            <td colspan="2" style="padding-top:20px">
                                <p>Dear Sir/Madam,</p>
                                <p>The details of vehicle are mentioned as below:</p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-top:30px">Model</td>
                            <td style="padding-top:30px">: <?php echo $info->vehicle_name.' '.$info->variant_name; ?></td>
                        </tr>
                        <tr>
                            <td>Engine No</td>
                            <td>: <?php echo $info->engine_no;?></td>
                        </tr>
                        <tr>
                            <td>Chasis No</td>
                            <td>: <?php echo $info->chass_no;?> </td>
                        </tr>
                        <tr>
                            <td>Regestration No</td>
                            <td>: <?php //echo $info  ?></td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td>: <?php echo $info->color_name ?></td>
                        </tr>
                        <tr>
                            <td>Mfg Year</td>
                            <td>: <?php echo $info->year ?></td>
                        </tr>

                        <tr>
                            <td  colspan="2" style="font-weight:bold;padding-top:50px">Thanking you,</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:bold;padding-top:20px">..............................</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:bold;padding-top:40px">Yours Faithfully</td>
                        </tr>


                        <tr>
                            <td colspan="2" style="border:1px solid black;padding-top:20px; ">
                                <div style="width: 700px; margin-bottom: 15px">
                                    Note: We request you to arrange for the transfer of ownership of the above mentioned vehicle in your bank's name as per the requirement and make payment to us upon completion of regestration.
                                </div>
                                <div style="margin-bottom: 15px;">
                                    Please contact following person for Ownership transfer ONLY.
                                </div>
                                <div style="margin-bottom: 15px;">
                                    Mr. Basanta Mishra #9841161323
                                </div>
                                <div>
                                    Mr. Wosti Jee #9841540775
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div style="margin-left: 10px;margin-top: 20px;"><h4><?php echo $info->firm;?></h4></div>
                </div>
            </div>
        </div>
    </body>
    </html>


