<!-- saved from url=(0061)http://192.168.1.197/cgdms/admin/customers/foc_document/88339 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>FOC</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="http://192.168.1.197/cgdms/assets/icons/favicon.ico" type="image/x-icon">
    <!-- Bootstrap 3.3.4 -->
    <!--<link rel="stylesheet" type="text/css" href="./FOC_files/project.min.css">-->
    <style>
        * {
            font-family: 'Times New Roman';
        }

        @media print {
            * {
                font-size: 99%
            }

            .row {
                padding: 5px !important
            }
        }

        h2, h3 {
            font-weight: 500;
        }

        h2 {
            font-size: 20px;
        }

        h3 {
            font-size: 18px;
        }

        section {
            padding: 0 10px;
        }

        .text-main {
            font-size: 13px;
            font-weight: bold;
        }

        span {
            font-size: 12px;
            font-weight: bold;
        }

        span {
            font-size: 12px;
            font-weight: bold;
        }

        ul {
            display: flex;
            list-style: none;
            padding: 0;
            width: 100%;
            margin: 0;
            font-size: 12px;
        }

        .table li {
            padding: 5px;
        }

        .table ul:not(:last-of-type) li {
            border-bottom: none;
        }

        .table li:first-of-type {
            width: 10%;
            border: 1px solid black;
        }

        .table li:nth-of-type(2) {
            width: 70%;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .table li:last-of-type {
            width: 20%;
            border: 1px solid black;
        }

        .small-table {
            margin-top: 10px;
        }

        .small-table li {
            padding: 5px;
        }

        .small-table ul:not(:last-of-type) li {
            border-bottom: none;
        }

        .small-table li:first-of-type {
            width: 30%;
            border: 1px solid black;
            border-right: none;
        }

        .small-table li:nth-of-type(2) {
            width: 70%;
            border: 1px solid black;
        }

        .signature-box ul {
            justify-content: space-between;
        }

    </style>
</head>
<body class="skin-blue layout-top-nav">
<div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">                <!-- Main content -->
            <section class="invoice" style="max-width: 210mm;">
                <h2 align="center"><?php echo $rows->firm_name; ?></h2>
                <h3 align="center"><u>MEMO FOR F.O.C. ACCESSORIES</u></h3>
                <div class="row">
                    <div class="col-md-11" style="margin-left: 3px">
                        <span>Dear Sir,</span><br>
                        <span class="text-main"> We are glad to allow you to have the following accessories on Free of Cost</span><br>
                        <span class="text-main"> basis to be provided in your vehicle booked with vide our order confirmation </span><br>
                        <span class="text-main"> No. <?php echo $rows->customer_id; ?> dated <?php echo $rows->created_at;?>.
							</span><br>
                        <span>
								Vehicle Name: <?php echo $rows->vehicle_name.' '.$rows->variant_name .' '.$rows->color_name.'('.$rows->code.')';?>  
							</span><br>
                        <span>Customer Name: <?php echo $rows->first_name.' '.$rows->middle_name .' '.$rows->last_name;?></span>
                    </div>
                </div>
                <div class="row" style="padding:30px 0">
                    <div class="table">
                        <ul>
                            <li>S.No.</li>
                            <li>Particular</li>
                            <li>Quantity</li>
                        </ul>
                        <ul>
                            <li>1</li>
                            <li>Fuel</li>
                            <li><?php echo $rows->fuel;?></li>
                        </ul>
                        <ul>
                            <li>2</li>
                            <li>Free Service</li>
                            <li><?php echo $rows->free_servicing;?></li>
                        </ul>
                        <ul>
                            <li>3</li>
                            <li><?php if($rows->name_transfer == 1)
                                        { 
                                            echo "Transfered";
                                        } 
                                        else 
                                        {
                                            echo "Not Transfered";
                                        } 
                                        ?></li>
                            <li></li>
                        </ul>
                        <ul>
                            <li>4</li>
                            <li>Road Tax</li>
                            <li><?php echo $rows->road_tax;?></li>
                        </ul>
                        <?php  $count = 5;  ?>
                        <?php foreach ($accessories as $key => $value):?>                                   
                        <ul>
                            <li><?php echo $count++; ?></li>
                            <li><?php echo $value->name;?></li>
                            <li>1</li>
                            
                        </ul>
                        <?php endforeach; ?>
                    </div>
                    <div class="small-table">
                        <ul>
                            <li>Engine No:</li>
                            <li><?php echo $rows->engine_no; ?></li>
                        </ul>
                        <ul>
                            <li>Chassis No:</li>
                            <li><?php echo $rows->chass_no; ?></li>
                        </ul>
                    </div>
                    <!--<table class="table table-bordered" style="width: 46%">-->
                    <!--<tbody>-->
                    <!--<tr>-->
                    <!--<th>Engine No:</th>-->
                    <!--<td>K12MN4467329</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--<th>Chassis No:</th>-->
                    <!--<td>MA3EWB22SJJ576336</td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                    <!--</table>-->
                </div><!-- /.col -->
            </section>

            <section>
                <span>This is being allowed to you as a special privilege.</span><br>

                <span>Yours sincerely,</span><br><br>
                <span> From <?php echo $rows->firm_name;?></span><br><br><br>
                <div class="signature-box">
                    <ul>
                        <li><b>.......................................</b></li>
                        <li><b>..................................</b></li>
                    </ul>
                    <ul>
                        <li>( Authorized Signature )</li>
                        <li>( Signature of Client )</li>
                    </ul>
                </div>
            </section>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->


</body>
</html>