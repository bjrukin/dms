<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Conformation</title>
    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body>
<div class="sapl-page">
    <div class="custom-container">
        <div class="sapl-title">
            <h2><?php echo $info->firm;?></h2>
        </div>
        <div class="sapl-subtitle">
            <h3>Order Confirmation</h3>
        </div>
        <div class="sapl-content">
            <ul>
                <li><b>Date:</b> <?php echo date('Y-m-d');?></li>
                <li>M/s	: <?php echo $info->full_name ?></li>
                <?php if($info->bank_name == ''): ?>
                <?php else: ?>
                <li>CO: <?php echo $info->bank_name; ?></li>
                <?php endif; ?> 
                <li><b>Tel (O): <?php echo (isset($info->work_1)) ? $info->work_1 : '';?></b></li>
                <li><b>Tel (R): <?php echo (isset($info->home_1)) ? $info->home_1 : '';?></b></li>
                <li><b>Fax: <?php echo (isset($info->fax)) ? $info->fax : '';?></b></li>
                <li><b>Mobile:</b>	<?php echo (isset($info->mobile_1)) ? $info->mobile_1 : '';?></li>
                <li><b>Email:</b><?php echo (isset($info->email)) ? $info->email : '';?></li>
            </ul>
        </div>
        <div class="sapl-other-detail">
            <span>We are pleased to quote herewith the price of Suzuki vehicle as per details mentioned herein below:</span>

            <ul>
                <li><b>1. <?php echo (isset($info->vehicle_name)) ? $info->vehicle_name : '';?> <?php echo (isset($info->variant_name)) ? $info->variant_name : '';?></b></li>
                <li><b>2. Color: <?php echo (isset($info->color_name)) ? $info->color_name : '';?></b></li>
                <li><b>3. Price: NRs. <?php echo (isset($actual_price)) ? 'NRs. ' . moneyFormat($actual_price). ' &nbsp; (In Words: ' . $acutal_price_words . ' Rupees only)': '';?></b></li>
            </ul>
            <label>The above prices is subject to change without any prior notice in case of any changes in the prices of Maruti
                Suzuki India Ltd. or their Govt. Levies or the tax and other policies of Gov. of Nepal.
                The above price does not include contract tax. Maruti Suzuki India Ltd.
                reserves the right to change without notice color, equipments specifications
                and model and also the discontinue models.</label>
            <ul>
                <li><b>4. Quanity:	1 Unit.</b></li>
                <li><b>5. Delivery:</b> Approximately within 90 days from the date of signing of order confirmation Delivery Date. Can get extended upto 120 days due to order shade/color non availability.</li>
                <li><b>6. Booking Amount:</b>	NRs. <?php echo moneyFormat($info->booking_amount);?>/- (In Words : <?php echo $booking_word;?>)</li>
                <li><b>7. Cancellation:</b>	If incase of cancellation of booking of the vehicle, minimum cancellation charge will be NRs. 5,000 /- (Five Thousand Only.)</li>
            </ul>
            <span>FOR <?php echo $info->firm;?></span>
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
    .sapl-title{
        text-align: center;
    }
    ul{
        padding: 0;
        margin:0;
        margin:25px 0px;
    }
    li{
        margin-bottom: 15px;
        font-size: 14px;
        list-style: none;
        line-height: 1.4em;
    }
    li:last-of-type{
        margin-bottom: 0;
    }
    .custom-container{
        padding: 15px;
    }
    label{
        line-height: 1.4em;
    }
    span{
        line-height: 1.4em;
    }
    h2{
        margin: 0;
    }

</style>