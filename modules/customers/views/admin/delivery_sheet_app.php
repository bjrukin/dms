<style type="text/css">
    .bill-image{
        width: 100%;
        text-align: center;
    }
    .bill-image img{
        max-width: 100%;
        width: 130px;

    }
    ul{
        padding: 0;
        margin:20px 0px;
    }
    li{
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 14px;
    }
    li:last-of-type{
        margin-bottom: 0;
    }
    p{
        margin: 5px 0px;
    }
    .bill-content .right-cloumn-text{
        text-align: right;
    }
    .bill-title{
        text-align: center;
        text-decoration: underline;
    }
    .bill-information ul li{
        list-style: none;
    }
    .no-bold{
        font-weight: normal;
    }
</style>
<div class="bill-wrapper">

    <div class="custom-container">

        <div class="bill-content">

            <div class="bill-image">
                <img src="<?php echo base_url("assets/images/suzuki-logo.jpg")?>" >
            </div>

            <div class="right-cloumn-text">
                <p><?php echo $info->firm?></p>
                <p>Date: <?php echo date('Y-m-d'); ?></p>
            </div>

            <div class="bill-title">
                <h3>DELIVERY SHEET</h3>
            </div>

            <div class="bill-information">
                <ul>
                    <li>Name : <?php echo $info->first_name .' '.$info->middle_name.' '. $info->last_name ?></li>
                    <?php if($info->dealer_id == 75):  ?>
                    <li>Agent Name : <?php echo $info->contact_1_name ?></li>
                    <?php endif; ?>
                    <li>Address : <?php echo $info->address_1; ?></li>
                    <li>Mobile : <?php echo $info->mobile_1; ?></li>
                    <li>Inquiry No : <?php echo $info->inquiry_no; ?></li>
                    <li>Retail Date : <?php echo $info->vehicle_delivery_date; ?> </li>
                </ul>
                <ul>
                    <li class="no-bold">We are pleased to inform you that your order of one unit vehicle is ready for delivery at our authorized at <?php echo $info->firm?>, Kathmandu Tel:<?php echo $info->dealer_phone_1.','.$info->dealer_phone_2;?> . The details of the vehicles are as follows:-</li>
                    <li>SR Price:</li>
                    <li>Model: <?php echo $info->vehicle_name .' '.$info->variant_name ?></li>
                    <li>Color: <?php echo $info->color_name ?></li>
                    <li>Engine <?php echo $info->engine_no ?></li>
                    <li>Chasis No: <?php echo $info->chass_no ?> </li>
                </ul>
            </div>

            <div class="bill-info2">
                <p>The following equipment,tools and accessories will be issued along with the vehicle:</p>
                <ul>
                    <li>Spare Wheel with tyre</li>
                    <li>Wheel Wrench</li>
                    <li>jack and Handle</li>
                    <li>Owner's ,manual</li>
                    <li>Spare Key</li>
                    <li>One outside Mirror</li>
                    <li>Room Mirror</li>
                </ul>
                <p>Please note that vehicle, its equipment, tools and accessories, once handed over will not be taken back, any claims other than manufacturing defects as per warrenty policy, arising after the delivery of the vehicle will not be entertained by us.</p>
            </div>

            <div class="bill-info3">
                <h2>Thank You,</h2>
                <p>..................................</p>
                <p>(Authorized Signature)</p>
                <div class="customer-acceptance">
                    <ul>
                        <li>Customer's Acceptance:</li>
                        <li class="no-bold"> I have inspected the above mentioned vehicle including the equipment tools and acceessories in <b>the presence of the workshop authority and found them in good condition. I have signed this as the</b> Confirmation note for full acceptance.</li>
                    </ul>
                    <p>..................................</p>
                    <p>(Authorized Signature)</p>
                </div>
                <div class="showroom-item">
                    <ul>
                        <li>Showroom:</li>
                        <li><?php echo $info->dealer_address1.','.$info->dealer_city_name.','.$info->dealer_district_name.', Nepal';?> Tel.<?php echo $info->dealer_phone_1.','.$info->dealer_phone_2;?> <?php if($info->dealer_fax):?>Fax:<?php echo $info->dealer_fax;?><?php endif;?> <?php if($info->dealer_email):?>E-mail:<?php echo $info->dealer_email ?><?php endif;?></li>
                        <li>Mailing Address: P.O.BOX: 4896</li>
                    </ul>
                    <ul>
                        <li>Service Station:</li>
                        <li>Pulchwok, Lalitpur Tel:(977-1) 5545907</li>
                    </ul>
                    <ul>
                        <li>dealers Network:</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>