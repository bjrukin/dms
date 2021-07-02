<!DOCTYPE html>
<html>
<head>
	<title>Job Card</title>
	<style>        .page{            page-break-after: always;            page-break-before: always;        }        table td{            font-size: 12px;        }    </style>
</head>
<body>
	<div class="page">

		<table cellspacing="0" cellpadding="0" width="750px">
			<!--------------- Header Starts ------------- -->

			<!-- <?php print_r($customer); ?> -->
			<tr>
				<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> Corporate Office: <?php echo $workshop->address_1; ?> </td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"> Tel No: <?php echo $workshop->phone_1; ?> </td>
			</tr>

			<tr>
				<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"> Job Card </td>
			</tr>
			<!---------------- Header Ends -------------- -->



			<!----------- Job No Section Starts --------- -->
			<tr>
				<td colspan="2" style="font-weight:bold;padding-top:20px; width: 100px;">Job No.</td>
				<td colspan="3" style="width:210px;padding-top:20px"><span style="padding-right:10px">:</span><?php echo "JC-".sprintf('%05d', $customer->jobcard_serial) ?></td>
			</tr>
			<tr>
				<td colspan="2" style="">Job Date</td>
				<td colspan="3" style="padding-top: 5px;"><span style="padding-right:10px">:</span><?php echo ($customer->jobcard_issue_date) ?></td>
				<td colspan=""></td>
				<td colspan="2" style="padding-top: 5px;"><!-- <span style="padding-right:10px">:</span> --></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px;font-weight:bold">Model</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_name." ".$customer->variant_name ; ?></td>
				<td colspan="" style="padding-top:20px">Colour</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->color_name; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Service</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo "{$customer->service_type_name} - {$customer->service_count}" ?> </td>
				<td colspan="" style="padding-top:5px">Coupon</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->coupon; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px">Vehicle No</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Chassis No</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->chassis_no; ?></td>
				<td colspan="" style="padding-top:5px">Fuel</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->fuel; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Engine No.</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->engine_no; ?></td>
				<td colspan="" style="padding-top:5px">KMs</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->kms; ?> km</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Gear Box No</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->gear_box_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Supervisor</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->floor_supervisor_name; ?></td>
				<td colspan="" style="padding-top:5px">Customer</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->full_name; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Service Advisor</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->service_advisor_name; ?></td>
				<td colspan="" style="padding-top:5px">Mechanic</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->mechanic_name; ?></td>
			</tr>

			<tr>
				<td colspan="2" style="padding-top:20px;font-weight:bold">Sell. Dealer</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->sell_dealer; ?></td>
				<td colspan="" style="padding-top:20px;font-weight:bold">Sold On</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->vehicle_sold_on; ?></td>
			</tr>

			<tr>
				<td colspan="2" style="padding-top:20px;font-weight:bold"></td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span></td>
				<td colspan="" style="padding-top:20px;font-weight:bold">Delv Date</td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->delivery_date; ?></td>
			</tr>
			<!-- ---------- Doc No Section Ends ---------- -->



			<!-- --------- Customer Section Starts --------- -->
			<tr>
				<td style="padding-top:20px;font-weight:bold" colspan="2">Customer Name</td>
				<td style="padding-top:20px;" colspan="6"><span style="padding-right:10px">:</span><?php echo $customer->full_name; if($customer->reciever_name) echo "({$customer->reciever_name})"; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px">Address</td>
				<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->address1 ?></td>
				<td colspan="" style="padding-top:5px">Mobile/SMS</td>
				<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->mobile ?></td>
			</tr>
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<!-- --------- Customer Section Ends --------- -->


		</table>
		<table cellspacing="0" cellpadding="0" width="750px">

			<!-- ---------- Detail Section Starts ---------- -->
			<tr>
				<?php if($customer->dob): ?>
					<td colspan="2" style="padding-top:5px">Date of Birth</td>
					<td colspan="3" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->dob ?></td>
				<?php endif; ?>
				<?php if($customer->email): ?>
					<td colspan="" style="padding-top:5px">Email</td>
					<td colspan="2" style="padding-top:5px"><span style="padding-right:10px">:</span><?php echo $customer->email ?></td>
				<?php endif; ?>
			</tr>
			<tr style="text-decoration: underline;">
				<td style="padding-top:40px;">S.No </td>
				<td style="padding-top:40px;" colspan="2">Customer Voice</td>
				<td style="padding-top:40px;" colspan="2">Advisor Voice</td>
				<td style="padding-top:40px;" colspan="3">Work to be Done</td>
			</tr>
			<?php foreach ($jobcard as $key => $value): ?>
				<tr>
					<td style="padding-top:5px;"><?php echo ++$key; ?>.</td>
					<td style="padding-top:5px;" colspan="2"><?php echo $value->customer_voice; ?></td>
					<td style="padding-top:5px;" colspan="2"><?php echo $value->advisor_voice; ?></td>
					<td style="padding-top:5px;" colspan="3"><?php echo $value->job_description ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="8" style="padding-top: 20px">(The Dealer will not be responsible for any damage to the vehicle during repair, testing and storage.)</td>
			</tr>
			<!-- ---------- Detail Section Ends ---------- -->

			<!-- ---------- Accessories Listing Starts-->
			<?php if( isset($accessories) ): ?>
				<tr>
					<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
				</tr>
				<tr>
					<td colspan="8" style="padding-top:20px;font-weight: bold">Accessories List: </td>
				</tr>
				<?php foreach ($accessories as $key => $value ): ?>
					<?php if($key % 4 == 0): ?>
						<tr>
						<?php endif; ?>

						<td style="padding-top:10px;" colspan="2"><?php echo ++$key.") {$value->name}"; ?></td>

						<?php if($key % 4 == 0): ?>
						</tr>
					<?php endif; ?>
				<?php endforeach;  ?>
			<?php  endif;  ?>

			<!-- ---------- Accessories Listing Ends -->

			<!----------- List Section Starts ----------- -->
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>

			<tr>
				<td colspan="8" style="padding-bottom:50px"></td>
			</tr>

			<tr>
				<td colspan="8" style="padding-bottom:50px"></td>
			</tr>

			<tr>
				<td colspan="4">
					<p >---------------------------</p>
				</td>
				<td colspan="4">
					<p >----------------------------</p>
				</td>
				<td colspan="4">
					<p >---------------------------</p>
				</td>

				
			</tr>
			<tr>
				<td colspan="4">
					<p >Client Signature</p>
				</td>

				<td colspan="4">
					<p >Floor Supervisor Signature</p>
				</td>

				<td colspan="4">
					<p >Service Advsior Signature</p>
				</td>
			</tr>




			<!--------- Signature Section Ends ---------- -->
		</table>
	</div>
	<div class="page">

		<table cellspacing="0" cellpadding="0" width="750px">
			<tr>
				<td colspan="8" style="padding-top:20px;text-align:center;padding:0px;"> <h3 style="margin-bottom: 0px"><?php echo $workshop->name; ?></h3> </td>
			</tr>
			<tr>
				<td colspan="8" style="border-bottom-style: groove;padding-bottom:20px"></td>
			</tr>
			<tr>
				<td colspan="8" style="padding-bottom:20px"></td>
			</tr>
			<tr>
				<td colspan="8" style="text-align:center;"><b>Reciept of Vehicles</b></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px;font-weight: bold">Job No.</td>
				<td colspan="3" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo "JC-".sprintf('%05d', $customer->jobcard_serial) ?></td>
				<td colspan="" style="padding-top:20px;font-weight: bold">Delivery on </td>
				<td colspan="2" style="padding-top:20px"><span style="padding-right:10px">:</span><?php echo $customer->delivery_date; ?></td>
			</tr>
			<tr>
				<td colspan="8" style="padding-top: 20px">I have received  <?php echo "{$customer->vehicle_name} {$customer->variant_name} ( {$customer->vehicle_no} )"; ?> </td>
			</tr>


			<tr>
				<td colspan="8" style="padding-bottom:50px"></td>
			</tr>

			<tr>
				<td colspan="8" style="padding-bottom:50px"></td>
			</tr>
			<tr>
				<td colspan="3">
					<p >---------------------------</p>
				</td>
			
				
				
				<td colspan="3">
					<p style="text-align: right;">---------------------------</p>
				</td>

				

				
			</tr>
			<tr>
				

				<td colspan="3">
					<p >Client Signature</p>
				</td>
			
				

				<td colspan="3">
					<p style="text-align: right;">Customer Signature</p>
				</td>


			</tr>
			<tr>
				<td colspan="8" style="padding-top: 20px"> Please bring this receipt at the time of collecting your Vehicle.</td>
			</tr>
			<tr>
				<td colspan="8">
					<p style="padding-top:5px;font-weight:bold">E. &amp; O.E.</p>
				</td>
			</tr>


		</table>
	</div>
	
</body>
</html>