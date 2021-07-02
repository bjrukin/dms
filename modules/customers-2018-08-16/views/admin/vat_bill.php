<?php 

$vat_amt = 13 * $info->quote_price/100;
?>
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
            <div class="container">  
                <section class="invoice" style="max-width: 210mm;">
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="text-align:center;">
                                <h1>Karan Motor Company</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                Showroom: Thapathali 4226722, Pulchwock 554828
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                Corporate Office: Chaudhary Towers, Jhamsikhel, Lalitpur
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                Tel No: 5545891-5 Fax No. 5546223
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                TPIN : 500026700
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom:10px;text-align:center; font-weight:bold;">
                                Tax Invoice
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; text-align: center;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="font-weight:bold;padding-top:7px">M/s</td>
                            <td style="width:200px;padding-top:7px"><?php echo $info->first_name .' '. $info->last_name ?></td>
                            <td style="padding-top:7px;padding-left:160px;">BillNo</td>
                            <td style="padding-top:7px"><span style="padding-right:10px">:</span></td>
                        </tr>
                        <tr>       
                            <td colspan="2" style="padding-left: 109px"> <?php echo $info->place_name .', '. $info->address_1 ?> </td>
                            <td style="padding-top:7px;padding-left:160px;">Date</td>
                            <td style="padding-top:7px"><span style="padding-right:10px">:</span><?php echo date('Y-m-d'); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold">A/c.</td>
                            <td><?php echo $info->first_name .' '. $info->last_name ?></td>
                            <td style="padding-top:7px;padding-left:160px;">Miti</td>
                            <td style="padding-top:7px"><span style="padding-right:10px">:</span><?php echo date('Y-m-d'); ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">TPIN</td>
                            <td colspan="3" style="padding-top:7px">:</td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">Mode of Payment</td>
                            <td colspan="3" style="padding-top:7px"><span style="padding-right:50px">:</span> Cash/ Chique/ Credit</td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">Delivery Term</td>
                            <td colspan="3" style="padding-top:7px">:</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-weight: bold; text-align: center;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                        </tr>     
                    </table>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="width:30px;text-align:center;vertical-align:top;padding-top:10px">S.No</td>
                            <td style="width:275px;padding-top:10px;text-align:center;">Particulars</td>
                            <td style="width:60px;padding-top:10px;text-align:center">Qty.</td>
                            <td style="width:100px;padding-top:10px;text-align:center">Rate</td>
                            <td style="width:130px;padding-top:10px;text-align:center">Amount</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="font-weight: bold; text-align: center;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                        </tr>    
                        <tr>
                            <td style="padding-top:20px;text-align:center;vertical-align:top;">1</td>
                            <td style="width:150px;">
                                <div style="margin-top: 20px; margin-left: 40px">Model : <?php echo $info->vehicle_name .' '. $info->variant_name;?></div>
                                <div style="margin-top: 18px; margin-left: 40px">Colour : <?php echo $info->color_name ?></div>
                                <div style="margin-top: 18px; margin-left: 40px">Chasis No : <?php echo $info->chass_no ?></div>
                                <div style="margin-top: 18px; margin-left: 40px">Engine No : <?php echo $info->engine_no ?></div>
                                <div style="margin-top: 18px; margin-left: 40px">Reg No.</div>
                            </td>
                            <td style="width:60px;text-align:center;vertical-align:top;padding-top:23px"><?php echo $info->quote_unit;?></td>
                            <td style="width:100px;text-align:center;vertical-align:top;padding-top:23px"><?php echo $info->quote_price;?></td>
                            <td style="width:130px;text-align:center;vertical-align:top;padding-top:23px"><?php echo $info->quote_price;?></td>    
                        </tr>
                        <tr>
                            <td colspan="5">
                                (With Standard Accessories)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="font-weight: bold; text-align: center;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                        </tr>   

                    </table>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td rowspan="5" style="padding-top:10px; padding-right:90px"">
                                <p>In Words</p>
                                <p>NRS Eighteen Lakh Ninety-FOur Thousand Only</p>
                            </td>
                            <td style="padding-top:7px">Total</td>
                            <td style="padding-top:7px"><span style="padding-right:10px"> : </span><?php echo $info->quote_price;?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">Less Discount</td>
                            <td style="padding-top:7px"><span style="padding-right:10px"> : </span><?php echo $info->quote_discount;?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">Taxable Amount</td>
                            <td style="padding-top:7px"><span style="padding-right:10px"> : </span><?php echo $info->quote_price;?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">VAT @ 13%</td>
                            <td style="padding-top:7px"><span style="padding-right:10px"> : </span><?php echo $vat_amt;?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:7px">Grand Total</td>
                            <td style="padding-top:7px"><span style="padding-right:10px"> : </span><?php echo ($info->quote_price + $vat_amt);?></td>
                        </tr>   
                        <tr>
                            <td colspan="3" style="font-weight: bold;text-align: center;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                        </tr>   
                        <tr style="font-weight:bold;">
                            <td colspan="2" style="padding-top:10px; text-align: right;">For</td>
                            <td style="padding-top:10px; text-align: right;"><span>: </span> Karan Motor Co. Pvt.Ltd.</td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="width: 50%">
                                <p style="padding-top:60px;">----------------------------</p>
                            </td>
                            <td>
                                <p style="padding-top:60px;padding-left:160px">-----------------------------</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding-top:-10px">Customer Signature</p>
                            </td>
                            <td>
                                <p style="padding-left:160px;padding-top:-10px">Authorised Signature</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding-top:5px;font-weight:bold">E. & O.E.</p>
                            </td>
                        </tr>
                    </table>

                </section>
            </div>
        </div>
    </div>
</body>
</html>