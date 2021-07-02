<div class="content-wrapper" style="margin-left: 20px !important">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>SALES DASHBOARD</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Billing ( Target Vs Actual )</h3>
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div class="row">
							<div class="col-md-1">Dealer: </div>
							<div class="col-md-2"><div id="dealer_id_bill" class="dealer_list" name="dealer_id"></div></div>
							<div class="col-md-1"><a href="javascript:void(0)" id="dealer_search"><i class="fa fa-search fa-2x"></i></a></div>
						</div>
						<div id="dealerwise_bill"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div class="row">
							<div class="col-md-1">Vehicle: </div>
							<div class="col-md-2"><div id="vehicle_id_bill" class="vehicle_list" name="vehicle_id"></div></div>
							<div class="col-md-1"><a href="javascript:void(0)" id="vehicle_search"><i class="fa fa-search fa-2x"></i></a></div>
						</div>
						<div id="modelwise"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h4 class="box-title">Retail Target Vs Actual</h4>			
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div class="row">
							<div class="col-md-1">Dealer: </div>
							<div class="col-md-2"><div id="dealer_id_retail" class="dealer_list" name="dealer_id"></div></div>
							<div class="col-md-1"><a href="javascript:void(0)" id="dealer_search_retail"><i class="fa fa-search fa-2x"></i></a></div>
						</div>
						<div id="dealerwise_retail"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div class="row">
							<div class="col-md-1">Vehicle: </div>
							<div class="col-md-2"><div id="vehicle_id_retail" class="vehicle_list" name="vehicle_id"></div></div>
							<div class="col-md-1"><a href="javascript:void(0)" id="vehicle_search_retail"><i class="fa fa-search fa-2x"></i></a></div>
						</div>
						<div id="modelwise_retail"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h4 class="box-title">Inquiry Target Vs Actual</h4>			
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div class="row">
							<div class="col-md-1">Dealer: </div>
							<div class="col-md-2"><div id="dealer_id_inquiry" class="dealer_list" name="dealer_id"></div></div>
							<div class="col-md-1"><a href="javascript:void(0)" id="dealer_search_inquiry"><i class="fa fa-search fa-2x"></i></a></div>
						</div>
						<div id="dealerwise_inquiry"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div class="row">
							<div class="col-md-1">Vehicle: </div>
							<div class="col-md-2"><div id="vehicle_id_inquiry" class="vehicle_list" name="vehicle_id"></div></div>
							<div class="col-md-1"><a href="javascript:void(0)" id="vehicle_search_inquiry"><i class="fa fa-search fa-2x"></i></a></div>
						</div>
						<div id="modelwise_inquiry"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Billing Segmentwise</h3>
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div id="passenger_billing" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="van_billing" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="utility_billing" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="commercial_billing" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="hybrid_billing" class="col-md-6" style="width:850px; height:350px;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Retail Segmentwise</h3>
					</div><!-- /.box-header -->					
					<div class="box-body">
						<div id="passenger_retail" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="van_retail" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="utility_retail" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="commercial_retail" class="col-md-6" style="width:850px; height:350px;"></div>
						<div id="hybrid_retail" class="col-md-6" style="width:850px; height:350px;"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Order Status</h3>
					</div>
					<div class="box-body">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Pending Order</span>
									<span class="info-box-number"><?php echo number_format(sales_order_status('pending')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Rejected Order</span>
									<span class="info-box-number"><?php echo number_format(sales_order_status('rejected')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div> <!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<!-- <a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a> -->
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inqiury Conversion Ratio</h3>
					</div>
					<div class="box-body">
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Not Converted</span>
									<span class="info-box-number"><?php echo inquiry_conversion_ratio('Not Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
					</div>
					<!-- ./box-body -->
					<div class="box-footer text-right">
						<!-- <a href="<?php echo site_url('crm-reports/generate/inquiry_conversion?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a> -->
					</div>
				</div>
				<!-- /.box -->
			</div>
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p class="text-center">
									<h4><strong>Regionwise Billing</strong></h4>
								</p>
								<?php $color = array('green', 'yellow', 'red', 'blue', 'aqua');?>
								<?php $billing = get_regionwise_bill(); ?>
								<?php $total_billing = get_all_billing(); ?>
								<?php if ($billing == null) break; ?>
								<?php foreach ($billing as $key => $value): ?>
									<div class="progress-group">
										<span class="progress-text"><?php echo $value['region_name'];?></span>
										<span class="progress-number"><b><?php echo $value['total_bill'];?></b> | <?php echo $total_billing->total_bill; ?></span>
										<div class="progress sm active">
											<div class="progress-bar progress-bar-striped progress-bar-<?php echo $color[$key];?>" style="width: <?php echo intval(($value['total_bill'] * 100)/$total_billing->total_bill);?>%"></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="col-md-6">
								<p class="text-center">
									<h4><strong>Regionwise Retail</strong></h4>
								</p>
								<?php $color_ret = array('green', 'yellow', 'red', 'blue', 'aqua');?>
								<?php $retail = get_regionwise_retail(); ?>
								<?php $total_retail = get_regionwise_all_retail(); ?>
								<?php if ($retail == null) break; ?>
								<?php foreach ($retail as $key => $value): ?>
									<div class="progress-group">
										<span class="progress-text"><?php echo $value['region_name'];?></span>
										<span class="progress-number"><b><?php echo $value['total_retail'];?></b> | <?php echo $total_retail->total_retail; ?></span>
										<div class="progress sm active">
											<div class="progress-bar progress-bar-striped progress-bar-<?php echo $color_ret[$key];?>" style="width: <?php echo intval(($value['total_retail'] * 100)/$total_retail->total_retail);?>%"></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- ./box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
</div>

<?php echo $this->load->view($this->config->item('template_admin') .'partial_sales_js.php');?>