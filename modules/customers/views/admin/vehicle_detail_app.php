<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Allotment Letter</title>
    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body>
<div class="allotment-page">
    <div class="custom-container">
        <div class="allotment-image">
            <img src="img/Suzuki-logo-5000x2500.png">
        </div>
        <div class="allotment-title">
            <h2>VEHICLE DETAILS</h2>
        </div>
        <div class="allotment-content">
            <ul>
                <li>Date : <?php echo date('Y-m-d'); ?></li>
                <li>M/s	: <?php echo $info->full_name ?></li>
                <?php if($info->bank_name == ''): ?>
                <?php else: ?>
                <li>CO: <?php echo $info->bank_name; ?></li>
                <?php endif; ?> 
            </ul>
            <p>Dear Sir/Madam,</p>
            <p>The details of vehicle are mentioned as below:</p>

            <ul>
                <li>Model :<?php echo $info->vehicle_name.' '.$info->variant_name; ?></li>
                <li>Engine No : <?php echo $info->engine_no;?></li>
                <li>Chasis No : <?php echo $info->chass_no;?></li>
                <li>Regestration No	:</li>
                <li>Color : <?php echo $info->color_name ?></li>
                <li>Mfg Year : <?php echo $info->year ?></li>
            </ul>
        </div>
        <div class="allotment-signature">
            <label>Thanking you,</label><br>
            <label>......................</label>
        </div>
        <div class="allotment-msg">
            <ul>
                <li>Yours Faithfully</li>
                <li class="box-text">
                    <p>Note: We request you to arrange for the transfer of ownership of the above mentioned vehicle in your bank's name as per the requirement and make payment to us upon completion of regestration.</p>
                    <p>Please contact following person for Ownership transfer ONLY.</p>
                    <p>Mr. Basanta Mishra #9841161323</p>
                    <p>Mr. Wosti Jee #9841540775</p>

                </li>
            </ul>
            <label><?php echo $info->firm;?></label>
        </div>
    </div>
</div>
</body>
</html>
<style type="text/css">
    body{
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 14px;
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
        font-weight: bold;
        display: block;
    }
    span{
        line-height: 1.4em;
    }
    h2{
        margin: 15px 0px;
        font-weight: 500;
        text-align: center;
        text-decoration: underline;
    }
    
     img{
        max-width: 100%;
        width: 130px;
    }
    .allotment-image{
        text-align: center;
    }
    p{
        margin: 0;
        margin-bottom: 5px;


    }
    .allotment-msg .box-text{
        border:1px solid black;
        padding: 3px;
    }
    .allotment-msg .box-text p{
        margin-bottom: 10px;
    }
</style>