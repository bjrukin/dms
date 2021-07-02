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

        hr{
            border-top: 1px dashed black;
            margin: 7px;
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
                    <table class="row" cellspacing="5" cellpadding="0" style="width:700px">
                        <tr><td class="col-md-3" colspan="3" style="text-align: center;"><h2><?php echo ($bill_detail->dealer_name)?$bill_detail->dealer_name:'SATUNGAL';?></h2></td>
                        <br>
                        </tr>
                            <!-- <pre><?php print_r($bill_detail)?></pre> -->
                            <!-- <pre><?php print_r($bill_list)?></pre> -->

                        <tr>
                            <td class="col-md-3" colspan="3">Date: <?php echo $bill_detail->billed_date_np;?></td>
                        </tr>
                        <tr>
                            <td class="col-md-3" colspan="3">Bill No.: <?php echo $bill_detail->bill_no;?></td>
                        </tr>

                        <tr>
                            <td class="col-md-3" colspan="3">Dealer Name: <?php echo ($bill_detail->billed_to_dealer)?$bill_detail->billed_to_dealer:'SATUNGAL';?></td>
                        </tr>
                    </table>
                    <br>
                    <table class="row" style="width: 100%">
                        <tr>
                            <td class="col-md-1" colspan="1" style="width: 8.33333333%">SN.</td>
                            <td class="col-md-3" colspan="3" style="width: 25%">Part Code</td>
                            <td class="col-md-3" colspan="3" style="width: 25%">Part Name</td>
                            <td class="col-md-2" colspan="2" style="width: 16.66%">Price</td>
                            <td class="col-md-1" colspan="1" style="width: 8.33333333%">Quantity</td>
                            <td class="col-md-2" colspan="2" style="width: 16.66%">Total</td>
                        </tr>
                    </table>
                    <hr>
                    <table class="row" style="width: 100%">
                        <?php foreach ($bill_list as $key => $value) {?>
                            <tr>
                                <td class="col-md-1" colspan="1" style="width: 8.33333333%"><?php echo $key + 1;?></td>
                                <td class="col-md-3" colspan="3" style="width: 25%"><?php echo $value->part_code;?></td>
                                <td class="col-md-3" colspan="3" style="width: 25%"><?php echo $value->part_name;?></td>
                                <td class="col-md-2" colspan="2" style="width: 16.66%"><?php echo $value->price;?></td>
                                <td class="col-md-1" colspan="1" style="width: 8.33333333%"><?php echo $value->quantity;?></td>
                                <td class="col-md-2" colspan="2" style="width: 16.66%"><?php echo $value->total_price;?></td>
                            </tr>
                        <?php }?>
                    </table>
                    <hr>
                    <table class="row" style="width: 100%">
                        <tr>
                            <td class="col-md-10" style="width: 83.3333333%; text-align: right;">Total</td>
                            <td class="col-md-2" style="width: 16.66%"><?php echo $bill_detail->total_amt;?></td>
                        </tr>
                    </table>
                    <table class="row" style="width: 100%">
                        <tr>
                            <td class="col-md-10" style="width: 83.3333333%; text-align: right;">TAX</td>
                            <td class="col-md-2" style="width: 16.66%"><?php echo $invoice_detail->vat_percent;?></td>
                        </tr>
                    </table>
                    <table class="row" style="width: 100%">
                        <tr>
                            <td class="col-md-10" style="width: 83.3333333%; text-align: right;">Net Amount</td>
                            <td class="col-md-2" style="width: 16.66%"><?php echo $invoice_detail->net_total;?></td>
                        </tr>
                    </table>
                    <hr>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>