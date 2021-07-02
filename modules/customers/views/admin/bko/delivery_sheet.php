<html>
<head>
    <meta charset="UTF-8">
    <title>Delivery Sheet</title>
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
                    <!-- <img src="<?php echo base_url("assets/images/cgMotoCorp-logo.jpg")?>" style="margin-left:300px; margin-top:20px"> -->
                    <div style="margin-left: 500px; margin-top: -55px;"><h3><?php echo $dealer->name?></h3></div>

                    <table  width="750px" cellspacing="5px">       
                        <tr>
                            <td align="right">Date: <?php echo date('Y-m-d'); ?></td>
                        </tr>

                        <tr>
                            <td style="text-align: center;"><h2 style="text-decoration:underline">DELIVERY SHEET</h2></td>
                        </tr>

                        <tr>
                            <td style="font-weight:bold">Name :  <?php echo $info->first_name .' '. $info->last_name ?> </td>
                        </tr>

                        <tr>
                            <td style="font-weight:bold">Address : <?php echo $info->address_1; ?></td>
                        </tr>

                        <tr>
                            <td style="font-weight:bold">Mobile : <?php echo $info->mobile_1; ?></td>
                        </tr>


                        <tr>
                            <td style="padding-left:10px">             
                                We are pleased to inform you that your order of one unit vehicle is ready for delivery at our authorized at Pulchwok, Kathmandu Tel:(977-1) 5547165/6. The details of the vehicles are as follows:-
                            </td>        
                        </tr>
                    </table>    
                    <table  width="750px" cellspacing="5px">   
                        <tr>
                            <td colspan="4" style="font-weight:bold;">SR Price: Rs.<?php echo moneyFormat($info->price);?></td>           
                        </tr>

                        <tr>
                            <td colspan="2" style="font-weight:bold">Model: <?php echo $info->vehicle_name .' '.$info->variant_name ?></td>
                            <td colspan="2" style="font-weight:bold;">Engine No: <?php echo $info->engine_no ?></td>
                        </tr>

                        <tr>
                            <td colspan="2" style="font-weight:bold">Color: <?php echo $info->color_name ?></td>
                            <td colspan="2" style="font-weight:bold">Chasis No: <?php echo $info->chass_no ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-left:10px">The following equipment,tools and accessories will be issued along with the vehicle:</td>
                        </tr>     
                        <tr>
                            <td style="padding-left:29px;padding-right: 29px">
                                Spare wheel with tyre.<br>
                                Spare Key
                            </td>
                            <td style="padding-left:29px;padding-right: 29px">
                                Wheel Wrench<br>
                                oue outside mirror
                            </td>
                            <td style="padding-left:29px;padding-right: 29px">
                                Jack and Handle<br>
                                Room Mirror
                            </td>
                            <td style="padding-left:29px;padding-right: 29px;padding-bottom:18px">
                                Owner's ,manual
                            </td>
                        </tr>
                    </table>
                    <table  width="750px" cellspacing="5px">   
                        <tr>
                            <td colspan="2" style="padding-left:10px">Please note that vehicle, its equipment, tools and accessories, once handed over will not be taken back, any claims other than manufacturing defects as per warrenty policy, arising after the delivery of the vehicle wll not be entertained by us.</td>
                        </tr>

                        <tr>
                            <td colspan="2" style="font-weight:bold;padding-top:50px;">Thanking You,</td>
                        </tr>

                        <tr>
                            <td colspan="2" style="padding-top:20px">
                                ..........................................<br>
                                (Authorized Signatory)
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 50px">
                                Customer's Acceptance:
                            </td>
                            <td  style="padding-top:20px;padding-left:10px; width: 250px;">
                                I have inspected the above mentioned vehicle including the equipment tools and acceessories in <span style="font-weight:bold">the presence of the workshop authority and found them in good condition. I have signed this as the</span> Confirmation note for full acceptance.
                            </td>
                        </tr>

                        <tr>
                            <td  colspan="2"  style="font-weight:bold;padding-left:480px;padding-top:50px;">
                                Signature: ..................................
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight:bold;">
                                Showroom
                            </td>
                            <td style="padding-top:20px;padding-left:10px; width: 250px;">
                                Maruti Plaza, Pulchwok,Kathmandu, Nepal Tel.(977-1)5547165, 5547166, 5525066 Fax:(977-1)5548429, E-mail:maruti@wink.com.np Mailing Address: P.O.BOX: 4896, Kathmandu
                            </td>
                        </tr>
                        <tr>
                            <td  style="font-weight:bold;">
                                Service Station:
                            </td>
                            <td style="padding-left:10px;">
                                Pulchwok, Lalitpur Tel: (977-1) 5545907 <span style="padding:left:100px">Dealers Network:</span>
                            </td>
                        </tr>
                    </table>

                </section>
            </div>
        </div>
    </div>
</body>
</html>
