<?php 

$vat_amt = 13 * @$info->quote_price/100;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tax</title>
    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body>
<div class="foc-page">
    <div class="custom-container">
        <div class="foc-title">
            <h2>Karan Motor Company</h2>
            <ul class="">
                <li>Showroom: Thapathali 4226722,<br> Pulchwock 554828</li>
                <li>Corporate Office: Chaudhary Towers, Jhamsikhel, Lalitpur</li>
                <li>Tel No: 5545891-5</li>
                <li>Fax No. 5546223</li>
                <li>TPIN : 500026700</li>
                <li><b><h3>Tax Invoice</h3></b></li>
            </ul>
            <ul>
                <li>M/s: <?php echo @$info->first_name .' '. @$info->last_name ?></li>
                <li>Address: <?php echo @$info->place_name .', '. @$info->address_1 ?></li>
                <li>Bill No. :</li>
                <li>A/c. : <?php echo @$info->first_name .' '. @$info->last_name ?></li>
                <li>Date : <?php echo date('Y-m-d'); ?></li>
                <li>Miti :<?php echo get_nepali_date(date('Y-m-d'),1); ?></li>
                <li>TPIN :</li>
                <li>Mode of Payment	: Cash/ Chique/ Credit</li>
                <li>Delivery Term :</li>
            </ul>
            <ul>
                <li>S.No : 1</li>
                <li><b>Particulars</b>
                    <ul class="no-margin">
                        <li>Model : <?php echo @$info->vehicle_name .' '. @$info->variant_name;?></li>
                        <li>Colour : <?php echo @$info->color_name ?></li>
                        <li>Chasis No : <?php echo @$info->chass_no ?></li>
                        <li>Engine No : <?php echo @$info->engine_no ?></li>
                    </ul>
                </li>
                <li>Qty : <?php echo @$info->quote_unit;?></li>
                <li>Rate : <?php echo @$info->quote_price;?></li>
                <li>Amount : <?php echo @$info->quote_price;?></li>
                <li>Reg No. :
                <p>(With Standard Accessories)</p></li>

            </ul>
            <ul>
                <li>In Words : NRS Eighteen Lakh Ninety-FOur Thousand Only</li>
                <li>Total : <?php echo @$info->quote_price;?></li>
                <li>Less Discount : <?php echo @$info->quote_discount;?></li>
                <li>Taxable Amount	: <?php echo @$info->quote_price;?></li>
                <li>VAT @ 13% : <?php echo @$vat_amt;?></li>
                <li>Grand Total : <?php echo (@$info->quote_price + $vat_amt);?></li>
            </ul>
            <ul>
                <li>For	: Karan Motor Co. Pvt.Ltd.</li>
                <br>
                <li>----------------------------
                <p>Customer Signature</p>
                </li>
                <li><h4>E. & O.E.</h4></li>

                <li class="right-align">-----------------------------
                <p>Authorised Signature</p>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
<style type="text/css">

    body{
        font-family: 'Source Sans Pro', sans-serif;
    }
    h3{
        font-size: 24px;
        font-weight: normal;
        text-align: center;
        margin: 15px 0px;
    }

    ul{
        padding: 0;
        margin:0;
        margin:25px 0px;
        border-bottom: 1px dashed black;
    }
    ul:last-of-type{
        border-bottom: 0px;
    }
    li{
        margin-bottom: 8px;
        font-size: 14px;
        list-style: none;
        line-height: 1.4em;
    }
    li:last-of-type{
        margin-bottom: 0;
    }

    label{
        line-height: 1.4em;
    }
    span{
        line-height: 1.4em;
    }
    h2{
        margin: 0;
        text-align: center;
    }
    ul li:last-of-type{
        margin-bottom: 15px;
    }
    .no-margin{
        margin-bottom: 0;
        margin-top: 5px;
        border-bottom: 0;
    }
    li p{
        margin: 5px 0px;
    }
    .right-align{
        text-align: right;
    }
</style>