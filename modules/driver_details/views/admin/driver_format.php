<html>
<head>
</head>
<body>
    <table cellpadding="4"; style="font-size: 12px;">

        <tr>
            <td colspan="2"><label>VEHICLE CHALLAN</label></td>
            <td colspan="5" align="center"><h3><?php echo $rows[0]->company_name?></h3></td>
            <td><lable style="font-weight:bold;font">DATE</lable></td>
            <td><input type="text" name="date" style="width:150px;" value="<?php echo date('Y-m-d') ?>"></td>
        </tr>
        <tr>
            <td colspan="7"></td>
            <td><label>Challan No.</label></td>
            <td><?php echo $rows[0]->id ?><?php if($rows[0]->current_status == 'Display'){echo '/Display';}?></td>

        </tr>

        <tr>
            <td colspan="3"><label>CHALLAN FOR MARUTI/SUZUKI</label></td>
            <td colspan="3" ><label>DEALER NAME</label></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="2">Chasis No</td>
            <td><input type="text" name="chasis_number" style="width:150px;" value="<?php echo $rows[0]->chass_no ?>"></td>
            <td colspan="2">Drivers Name</td>
            <td><input type="text" name="driver_name" value="<?php echo $rows[0]->driver_name ?>" style="width:150px;"></td>
            <td colspan="2">Dispatch Date</td>
            <td><input type="text" name="dispatch_date" style="width:150px;" value="<?php echo $rows[0]->challan_date ;?>"></td>
        </tr>

        <tr>
            <td colspan="2">Engine No</td>
            <td><input type="text" name="engine_no" style="width:150px;" value="<?php echo $rows['0']->engine_no ?>"></td>
            <td colspan="2">DL No</td>
            <td><input type="text" name="dl_no" value="<?php echo $rows[0]->license_no ?>" style="width:150px;"></td>
            <td colspan="2">From</td>
            <td><input type="text" name="from" style="width:150px;" value="<?php echo $rows[0]->source ?>"></td>
        </tr>

        <tr>
            <td colspan="2">Model No</td>
            <td><input type="text" name="model_no" style="width:150px;" value="<?php echo $rows[0]->vehicle_name. ' ' .$rows[0]->variant_name?>"></td>
            <td colspan="2">Driver Cont No</td>
            <td><input type="text" name="driver_number" style="width:150px;" value="<?php echo $rows[0]->driver_number; ?>"></td>
            <td colspan="2">Destination</td>
            <td><input type="text" name="destination" style="width:150px;" value="<?php echo $rows[0]->current_location?>"></td>
        </tr>

        <tr>
            <td colspan="2">Key No</td>
            <td><input type="text" name="key_no" style="width:150px;"></td>
            <td colspan="2">Colour</td>
            <td><input type="text" name="colour" style="width:150px;" value="<?php echo $rows['0']->color_name ?>"></td>
            <td colspan="2">PIM No</td>
            <td><input type="text" name="pim_no" style="width:150px;"></td>
        </tr>

        <!-- Section Two-->

        <tr>
            <td colspan="9" align="center">
                <label style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;padding-bottom:3px;padding-left:5px;padding-top:3px;;padding-right:5px;font-weight:bold;">LU.A.A.CHAI</label>
                <input type="text" name="lu_a" style="border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black;margin-left:-4px;width:150;height:22;;padding:3px;padding-left:30px;">
            </td>
        </tr>

        <tr>
            <td colspan="2" align="left">
                <label style="font-weight:bold">BODY POSITION</label>
                <!-- <input type="text" name="body_position"style="margin-left:43px;width:150;padding:3px;padding-left:30px;border:1px solid black;"> -->
            </td>
            <!-- <td colspan="4" rowspan="4" align="left" valign="top" style="border:1px solid black"></td> -->
        </tr>


        <tr>
            <td colspan="6" rowspan="3" align="left" valign="top" style="border:1px solid black"></td>
            <td colspan="2">
                <label>TOOL KIT</label>
            </td>
            <td>
                <input type="number" name="km" style="border:1px solid black; margin-left:5px;width:120px;">
            </td>
            
        </tr>
<tr>
    <td colspan="2">
        <label>K.M</label>
    </td>
    <td>
        <input type="number" name="km" style="border:1px solid black; margin-left:5px;width:120px;">
    </td> 
</tr>
<tr>
    <td colspan="2">
        <label>Petrol</label>
    </td>
    <td>
        <input type="number" name="petrol" style="border:1px solid black; margin-left:5px;width:120px;">
    </td> 
</tr>

<tr>
    <td colspan="6" align="left">
        <label style="font-weight:bold">REMARKS</label>
    </td>
    <td colspan="2">
        <label>BHW TIME</label>
    </td>
    <td>
        <input type="text" name="bhw_time" style="border:1px solid black; margin-left:5px;width:120px;">
    </td> 
</tr>
<tr>
    <td colspan="6" rowspan="2" align="left" valign="top" style="border:1px solid black"></td>
    <td colspan="2">
        <label>Invoice No</label>
    </td>
    <td>
        <input type="number" name="invoice_number" style="border:1px solid black; margin-left:5px;width:120px;">
    </td> 
</tr>
<tr>
    <td colspan="2">
        <label>Accessories</label>
    </td>
    <td>
        <input type="text" name="accessories" style="border:1px solid black; margin-left:5px;width:120px;">
    </td> 
</tr>

<tr>
    <td colspan="2">
        <label>DEALERS NAME</label>
    </td>
    <td colspan="8">

    </td>
</tr>

<tr>
    <td colspan="2">
        <label>Contact No</label>
    </td>
    <td colspan="8">

    </td>

</tr>

<tr>
    <td colspan="3" align="left" valign="bottom"  height="50px">
        <label>DRIVERS SIGN</label>
    </td>
    <td colspan="3" align="left" valign="bottom"  height="50px">
        <label>SENDER'S NAME AND SIGN</label>
    </td>
</tr>
<tr>
    <td colspan="3"></td>
    <td colspan="6" align="left" valign="bottom"  height="50px">
        <label>RECIVER'S NAME AND SIGN</label>
    </td>
</tr>


<!-- Payment Voucher-->
<tr><td colspan="9"><hr></td></tr>
<tr>
    <td colspan="9" align="center">
        <label>PAYMENT VOUCHER</label>
    </td>
</tr>

<tr>
    <td colspan="3"> <label>DRIVERS NAME   &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; </label><?php echo $rows[0]->driver_name?></td>
    <td colspan="3"> <label>DRIVERS ADDRESS  &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; </label><?php echo $rows[0]->driver_address?></td>
    <td colspan="3"> <label>DRIVERS NUMBER &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; </label><?php echo $rows[0]->driver_number?></td>
</tr>
<tr>
    <td colspan="3"> <label>DRIVERS LICENSE NUMBER &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; </label><?php echo $rows[0]->license_no?> </td>
    <td colspan="3"> <label>CHALLAN NO. &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; </label><?php echo $rows[0]->id ?><?php if($rows[0]->current_status == 'Display'){echo '/Display';}?></td>
</tr>
<tr>
    <td colspan="2">MODEL</td>
    <td colspan="3"><?php echo $rows[0]->vehicle_name. ' ' .$rows[0]->variant_name?></td>
    <td colspan="2">ACCESSORIES</td>
    <td colspan="3"><input type="text" style="width:200px;"></td>
</tr>

<tr>
    <td colspan="2">CHASSIS NO</td>
    <td colspan="3"><?php echo $rows[0]->chass_no?></td>
    <td colspan="2">ANY REMARKS</td>
    <td colspan="3" rowspan="3"><input type="text" style="width:200px; height: 60px"></td>
</tr>

<tr>
    <td colspan="2">ENGINE NO</td>
    <td colspan="3"><?php echo $rows[0]->engine_no?></td>
</tr>

<tr>
    <td colspan="2">COLOR</td>
    <td colspan="7"><?php echo $rows[0]->color_name. ' ' .$rows[0]->color_code?></td>
</tr>

<tr>
    <td colspan="6"  height="50" valign="bottom">RECEIVER'S NAME AND SIGN</td>
    <td colspan="3" height="50" valign="bottom">Payment RS ..........</td>
</tr>
<tr>
    <td colspan="9" align="center">ONLY IF THE VEHICLE RECIVED IN GOOD CONDITION STAMP AND SIGNATURE</td>
</tr>
</table>
</body>    
</html>