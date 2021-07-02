
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.js"></script>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.plugin.html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/canvas2image.js"></script>

<style>
	.widget {
		display: inline-block;
		background-color: white;



		vertical-align: top;
		color: #333;

		/*display: inline-block;*/
		page-break-after: always;

	}
</style>
<div class="content-wrapper">
	<button href="#wrapper"  id="btnSave" class="btn  btn-default" style="margin-top:13px;margin-left:20px;">Download</button>
	<span id="widget" class="widget" style="width: 100%;height:100%">
		<section class="content-header">
			<h4 style="text-align: center;font-weight: 700;">SHREE HIMAYALAN ENTERPRISES PVT.LTD.</h4>
			<h5 style="text-align: center;font-weight: 600;">SPARE PARTS - DIVISION</h5>
			<h5 style=" text-align: center;font-weight: 500;">Thapathali, Kathmandu - Nepal</h5>

			<h5 style="float:right;padding-right: 151px;"><b>Date:</b> 2017-05-29</h5>
		</section>
		<section class="content">
			<div class="box">
				<table class="table table-bordered" style="margin-left:40px;width:90%">
					<th>S.N</th>
					<th>Part Code</th>
					<th>Name</th>
					<th>Price(in Nrs.)</th>
					<th>Quantity</th>
					<th>Total Amount(in Nrs.)</th>
					<?php $total_amount = 0;
					$vat=0;
					$discount = 0;
					$grand = 0;
					foreach($rows as $row):?>
					<tr>
						<td><?php echo $row->id;?></td>
						<td><?php echo $row->part_code;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo ($new_price = $row->price + (($row->price * $vor_percentage)/100));?></td>
						<td><?php echo $row->order_quantity;?></td>
						<td><?php echo $total = $new_price * $row->order_quantity;?></td>
						<?php $total_amount += $total;
						$discount += $total_amount * 0.5;
						$vat += ($total_amount -$discount) * 0.13;
						$grand = $total_amount + $vat - $discount;
						?>
					</tr>
				<?php endforeach;?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Total Amount</td>
					<td><?php echo $total_amount;?></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Discount (%)</td>
					<td><?php echo $discount;?></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Vat (13%)</td>
					<td><?php echo $vat;?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Grand Total</td>
					<td><?php echo $grand;?></td>
				</tr>
			</table>
		</div>
	</section> 
</span>
</div>
<script type="text/javascript">
	$(function() {
		$("#btnSave").click(function() {
			var transform=$(".gm-style>div:first>div").css("transform");
           //                    
           $(".gm-style>div:first>div").css({
           	"transform":"none",
           })
           html2canvas($("#widget"), {
       // useCORS: true,
       onrendered: function(canvas,link) {
       	var dataUrl= canvas.toDataURL('image/jpeg',1.0);
       	document.write('<img src="' + dataUrl + '"/>');
       	download.setAttribute("href", image);
       	link.href = document.getElementById(canvasId).toDataURL();
       	link.download = filename;
       }
   });
           document.getElementById('download').addEventListener('click', function() {
           	downloadCanvas(this, 'canvas', 'test.png');
           }, false);

       });

	});
</script>