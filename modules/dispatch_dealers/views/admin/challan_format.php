<html>
    <head>
    </head>
    <body>
        <table cellpadding="5"; style="font-size: 12px;">
            <tr>
                <td colspan="2"><label>VEHICLE CHALLAN</label></td>
                <td colspan="5" align="center"><?php echo strtoupper($data[0]->firm_name);?></td>
                <td><lable style="font-weight:bold;font">DATE</lable></td>
                <td><input type="text" name="date" style="width:150px;" value="<?php echo date('Y-m-d') ?>"></td>
            </tr>
            <tr>
                <td colspan="7"></td>
                <td><label>Challan No.</label></td>
                <td><input type="number" name="challan_no" value="<?php echo $rows[0]->dispatch_id ?>" style="width:150px;"></td>
            </tr>

            <tr>
                <td colspan="3"><label>CHALLAN FOR MARUTI/SUZUKI</label></td>
                <td colspan="2" ><label>COMPANY NAME</label></td>
                <td colspan="3">
                    <?php echo $dealer[0]->name?> 
                </td>
                <td></td>
            </tr>

    <tr>
        <td colspan="2">Chasis No</td>
        <td><input type="text" name="chasis_number" style="width:150px;" value="<?php echo $data[0]->chass_no ?>"></td>
        <td colspan="2">Drivers Name</td>
        <td><input type="text" name="driver_name" value="<?php echo $rows[0]->driver_name ?>" style="width:150px;"></td>
        <td colspan="2">Dispatch Date</td>
        <td><input type="text" name="dispatch_date" style="width:150px;" value="<?php echo date('Y-m-d',strtotime($rows[0]->dispatch_created_at))?>"></td>
    </tr>

    <tr>
        <td colspan="2">Engine No</td>
        <td><input type="text" name="engine_no" style="width:150px;" value="<?php echo $data['0']->engine_no ?>"></td>
        <td colspan="2">DL No</td>
        <td><input type="text" name="dl_no" value="<?php echo $rows[0]->driver_liscense_no ?>" style="width:150px;"></td>
        <td colspan="2">From</td>
        <td><input type="text" name="from" style="width:150px;" value="<?php echo $data[0]->stockyard_name ?>"></td>
    </tr>

    <tr>
        <td colspan="2">Model No</td>
        <td><input type="text" name="model_no" style="width:150px;" value="<?php echo $data[0]->vehicle_name. ' ' .$data[0]->variant_name?>"></td>
        <td colspan="2">Driver Cont No</td>
        <td><input type="text" name="driver_cont_no" style="width:150px;" value="<?php echo $rows[0]->driver_contact; ?>"></td>
        <td colspan="2">Destination</td>
        <td><input type="text" name="destination" style="width:150px;" value="<?php echo $dealer[0]->address_1?>"></td>
    </tr>

    <tr>
        <td colspan="2">Key No</td>
        <td><input type="text" name="key_no" style="width:150px;" value="<?php  echo $data['0']->key_no ?>"></td>
        <td colspan="2">Colour</td>
        <td><input type="text" name="colour" style="width:150px;" value="<?php echo $data['0']->color_name?>"></td>
        <td colspan="2">PIM No</td>
        <td><input type="text" name="pim_no" style="width:150px;" value="<?php  echo $data['0']->pragyapan_no ?>"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td></td>
        <td colspan="2"></td>
        <td></td>
        <td colspan="2">Pragyapan Date</td>
        <td><input type="text" style="width:150px;" value="<?php  echo $data['0']->pragyapan_date ?>"></td>

    </tr>

    <!-- Section Two-->

    <tr>
        <td colspan="9" align="center">
            <label style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;padding-bottom:3px;padding-left:5px;padding-top:3px;;padding-right:5px;font-weight:bold;">LU.A.A.CHAI</label>
            <input type="number" name="lu_a" style="border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black;margin-left:-4px;width:150;height:22;;padding:3px;padding-left:30px;">
        </td>
    </tr>

    <tr>
        <td colspan="9" align="left">
            <label style="font-weight:bold">BODY POSITION</label>
            <input type="text" name="body_position"style="margin-left:43px;width:150;padding:3px;padding-left:30px;">
        </td>
    </tr>


    <tr>
        <td colspan="6" rowspan="6" align="left" valign="top" style="border:1px solid black">Note: <?php echo $rows[0]->remarks;?><br/> <img src="<?php echo base_url('uploads/challan_damage').'/'.$rows[0]->image?>" style="max-width:300px"></td>
        <td colspan="2">
            <label>TOOL KIT</label>
        </td>
        <td>
            <input type="text" name="tool_kit" style="border:1px solid black; margin-left:5px;width:120px;">
        </td> 
    </tr>
    <tr>
        <td colspan="2">
            <label>ACCESSORIES KIT</label>
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
        <td colspan="2">
            <label>BHW TIME</label>
        </td>
        <td>
            <input type="text" name="bhw_time" style="border:1px solid black; margin-left:5px;width:120px;">
        </td> 
    </tr>
    <tr>
        <td colspan="2">
            <label>Invoice No</label>
        </td>
        <td>
            <input type="number" name="invoice_number" style="border:1px solid black; margin-left:5px;width:120px;" value="<?php echo $data[0]->invoice_no ;?>">
        </td> 
    </tr>

    <tr>
        <td colspan="2">
            <label>DEALERS NAME</label>
        </td>
        <td colspan="8">
            <?php echo $dealer[0]->name?>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <label>Contact No</label>
        </td>
        <td colspan="8">
            <?php echo $dealer[0]->phone_1?>
        </td>

    </tr>

    <tr>
        <td colspan="3" align="center" valign="bottom"  height="50px">
            <label>DRIVERS SIGN</label>
        </td>
        <td colspan="3" align="center" valign="bottom"  height="50px">
            <label>SENDERS SIGN</label>
        </td>
        <td colspan="3" align="center" valign="bottom"  height="50px">
            <label>RECEIVED BY</label>
        </td>
    </tr>


    <!-- Payment Voucher-->
    <tr>
        <td colspan="9" align="center">
            <label>PAYMENT VOUCHER</label>
        </td>
    </tr>

    <tr>
        <td colspan="3">
            <label>DRIVERS NAME</label>
        </td>
        <td colspan="4">
            <?php echo $rows[0]->driver_name?>
        </td>
        <td>
            <label>Challan No</label>
        </td>
        <td align="center">
            <?php echo $rows[0]->dispatch_id?>
        </td>
    </tr>

    <tr>
        <td colspan="2">MODEL</td>
        <td colspan="7"><?php echo $data[0]->vehicle_name. ' ' .$data[0]->variant_name?></td>
    </tr>

    <tr>
        <td colspan="2">CHASSIS NO</td>
        <td colspan="7"><?php echo $data[0]->chass_no?></td>
    </tr>

    <tr>
        <td colspan="2">ENGINE NO</td>
        <td colspan="7"><?php echo $data[0]->engine_no?></td>
    </tr>

    <tr>
        <td colspan="2">COLOR</td>
        <td colspan="7"><?php echo $data[0]->color_name. ' ' .$data[0]->color_code?></td>
    </tr>

    <tr>
        <td colspan="3"  height="50" valign="bottom">RECIVER'S SIGN</td>
        <td colspan="5"  height="50"></td>
        <td  height="50" valign="bottom">Payment RS ..........</td>
    </tr>

    <tr>
        <td colspan="9" align="center">ONLY IF THE VEHICLE RECIVED IN GOOD CONDITION STAMP AND SIGNATURE</td>
    </tr>
</table>
</body>    
</html>
