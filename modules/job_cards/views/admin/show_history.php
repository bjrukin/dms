<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title><?php echo 'Service Histoy'; ?></title>
	<style>        .page{            page-break-after: always;            page-break-before: always;        }        table td{            font-size: 12px;        }    </style>
</head>
<body>
	<?php foreach($jobcard as $key => $value): ?>
		<div class="page">
			<table cellspacing="0" cellpadding="0" width="750px">
				<tr>
					<td colspan="8" style="text-align:center;padding:0px"> <h2><?php echo $workshop->name; ?></h2> </td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:center;"> <?php echo $workshop->address_1; ?>, <?php echo $workshop->address_2; ?></td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:center;"> Tel No: <?php echo $workshop->phone_1; ?> </td>
				</tr>
				<tr>
					<td colspan="8" style="padding-bottom:10px;text-align:center; font-weight:bold;border-bottom-style: dotted;"><?php echo @$value->payment_type; ?></td>
				</tr>



				<tr>
				<td colspan="2" style="font-size: 14px; font-weight:bold;padding-top:20px; width: 100px;">Invoice No.</td>
				<td colspan="3" style="font-size: 14px; width:210px;padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->invoice_prefix. " TI-". sprintf('%05d', $value->invoice_no); ?></td>
				<td style="font-size: 14px; padding-top:20px">Date</td>
				<td colspan="2" style="font-size: 14px; padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->created_at; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; ">Party Name</td>
				<td colspan="3" style="font-size: 14px; padding-top: 5px;"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->customer_name; if($value->reciever_name) echo "({$value->reciever_name})"; ?></td>
				<td colspan="">Job Card No.</td>
				<td colspan="2" style="font-size: 14px; padding-top: 5px;"><span style="font-size: 14px; padding-right:10px">:</span><?php echo "JC-".sprintf('%05d',$value->jobcard_serial); ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; ">Address</td>
				<td colspan="3" style="font-size: 14px; padding-top: 5px;"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->address1; ?></td>
				<td colspan=""></td>
				<td colspan="2" style="font-size: 14px; padding-top: 5px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:20px">Model</td>
				<td colspan="3" style="font-size: 14px; padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->vehicle_name." ".@$value->variant_name ; ?></td>
				<td colspan="" style="font-size: 14px; padding-top:20px">Vehicle No.</td>
				<td colspan="2" style="font-size: 14px; padding-top:20px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->vehicle_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:5px">Engine No.</td>
				<td colspan="3" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->engine_no; ?></td>
				<td colspan="" style="font-size: 14px; padding-top:5px">Chassis No.</td>
				<td colspan="2" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->chassis_no; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:5px">Service Type.</td>
				<td colspan="3" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->service_type_name.' '.@$value->service_count ; ?></td>
				<td colspan="" style="font-size: 14px; padding-top:5px">Kms.</td>
				<td colspan="2" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->kms; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 14px; padding-top:5px">Coupen</td>
				<td colspan="3" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:</span><?php echo @$value->coupon; ?></td>
				<td style="font-size: 14px;" colspan="" style="font-size: 14px; padding-top:5px">Pan No</td>
				<td colspan="2" style="font-size: 14px; padding-top:5px"><span style="font-size: 14px; padding-right:10px">:<?php echo @$value->pan_no; ?></span></td>
			</tr>
			</table>

			<table cellspacing="0" cellpadding="0" width="750px">
			<!-- --------- Detail Section Starts --------- -->
				<caption>Parts</caption>
				<tr>
					<td colspan="9" style="border-bottom-style: groove;padding-bottom:20px"></td>
				</tr>
				<tr>
					<td  style="padding-top:5px;">S.No</td>
					<td style="padding-top:5px;padding-left:20px">Item No.</td>
					<td colspan="2" style="padding-top:5px;padding-left:20px">Description</td>
					<td style="padding-top:5px;padding-left:20px">Qty</td>
					<td style="padding-top:5px;padding-left:20px">Rate</td>
					<td style="padding-top:5px;padding-left:20px">Parts Amount</td>
				</tr>
				<tr>
					<td colspan="9" style="border-bottom-style: groove;padding-bottom:5px"></td>
				</tr>
				<?php $key =0;?>
				<?php if($value->parts): ?>
					<?php foreach ($value->parts as $k => $v): ?>
						<tr>
							<td style="padding-top:10px;"><?php echo ++$k; ?>.</td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->part_code; ?></td>
							<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $v->part_name; ?></td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->quantity; ?></td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->price; ?></td>
							<!-- <td style="padding-top:10px;padding-left:20px"><?php echo $v->warranty; ?></td> -->
							<td style="padding-top:10px;padding-left:20px;text-align: right;padding-right:10px"><?php echo $v->final_amount; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif;?>
		
			<!--Job Detail Ends-->
			</table>
			<table cellspacing="0" cellpadding="0" width="750px">
				<!-- --------- Detail Section Starts --------- -->
				<caption>Jobs</caption>
				<tr>
					<td colspan="9" style="border-bottom-style: groove;padding-bottom:20px"></td>
				</tr>
				<tr>
					<td  style="padding-top:5px;">S.No</td>
					<td style="padding-top:5px;padding-left:20px">Item No.</td>
					<td colspan="2" style="padding-top:5px;padding-left:20px">Description</td>
					<td style="padding-top:5px;padding-left:20px">Labour Amount</td>
					<td style="padding-top:5px;padding-left:20px">Discount</td>
					<td style="padding-top:5px;padding-left:20px">Final Amount</td>
				</tr>
				<tr>
					<td colspan="9" style="border-bottom-style: groove;padding-bottom:5px"></td>
				</tr>
				<?php $key =0;?>
				<?php if($value->jobs): ?>
					<?php foreach ($value->jobs as $k => $v): ?>
						<tr>
							<td style="padding-top:10px;"><?php echo ++$k; ?>.</td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->job; ?></td>
							<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $v->job_description; ?></td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->price; ?></td>
							<!-- <td style="padding-top:10px;padding-left:20px"><?php echo $v->warranty; ?></td> -->
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->discount_percentage; ?></td>
							<td style="padding-top:10px;padding-left:20px;text-align: right;padding-right:10px"><?php echo $v->final_amount; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif;?>
		
				<!--Job Detail Ends-->
			</table>

			<table cellspacing="0" cellpadding="0" width="750px">
				<!-- --------- Detail Section Starts --------- -->
				<caption>Outside Work</caption>
				<tr>
					<td colspan="9" style="border-bottom-style: groove;padding-bottom:20px"></td>
				</tr>
				<tr>
					<td  style="padding-top:5px;">S.No</td>
					<td style="padding-top:5px;padding-left:20px">Item No.</td>
					<td colspan="2" style="padding-top:5px;padding-left:20px">Description</td>
					<td style="padding-top:5px;padding-left:20px">Final Amount</td>
				</tr>
				<tr>
					<td colspan="9" style="border-bottom-style: groove;padding-bottom:5px"></td>
				</tr>
				<?php $key =0;?>
				<?php if($value->outside_work): ?>
					<?php foreach ($value->outside_work as $k => $v): ?>
						<tr>
							<td style="padding-top:10px;"><?php echo ++$k; ?>.</td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->job; ?></td>
							<td colspan="2" style="padding-top:10px;padding-left:20px"><?php echo $v->job_description; ?></td>
							<td style="padding-top:10px;padding-left:20px"><?php echo $v->final_amount; ?></td>
							<!-- <td style="padding-top:10px;padding-left:20px"><?php echo $v->warranty; ?></td> -->
						</tr>
					<?php endforeach; ?>
				<?php endif;?>
		
				<!--Job Detail Ends-->
			</table>
		</div>
		<br><br><hr><br>
	<?php endforeach; ?>
</body>
</html>
