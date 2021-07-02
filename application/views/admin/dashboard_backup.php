<style>
.info-box-text {font-size: 18px}
.info-box-number {font-size: 28px}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>DASHBOARD</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- statuses -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inqiury by Status</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Inquiries</span>
									<span class="info-box-number"><?php echo number_format(status_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Pending</span>
									<span class="info-box-number"><?php echo number_format(status_count('Pending')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Confirmed</span>
									<span class="info-box-number"><?php echo number_format(status_count('Confirmed')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Booked</span>
									<span class="info-box-number"><?php echo number_format(status_count('Booked')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Retail</span>
									<span class="info-box-number"><?php echo number_format(status_count('Retail')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-maroon"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Closed</span>
									<span class="info-box-number"><?php echo number_format(status_count('Closed')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_status?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- ./statuses -->

		<!-- inquiry_kind -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inquiry by Kind</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Warm</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count('Warm')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Hot</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count('Hot')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Cold</span>
									<span class="info-box-number"><?php echo number_format(inquiry_kind_count('Cold')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- ./inquiry_kind -->
		<!-- inquiry_source -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inquiry by Source</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Walk-In</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Walk-In')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Generated</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Generated')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Referral</span>
									<span class="info-box-number"><?php echo number_format(inquiry_source_count('Referral')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_source?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- ./inquiry_source -->
		

		<!-- inquiry_type -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inquiry by Type</h3>
					</div>
					<div class="box-body">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">First Tyme Buyer</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('First Tyme Buyer')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Additional Buyer</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('Additional Buyer')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Suzuki to Suzuki Exchange</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('Suzuki to Suzuki Exchange')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Other Brand to Suzuki Exchange</span>
									<span class="info-box-number"><?php echo number_format(inquiry_type_count('Other Brand to Suzuki Exchange')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<!-- <div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div> -->
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- ./inquiry_type -->
		<!-- inquiry_closed -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Closed Inquiries</h3>
					</div>
					<div class="box-body">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-navy"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count()); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-teal"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Lost</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count('Lost')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Booking Cancel</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count('Booking Cancel')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-olive"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Cancel</span>
									<span class="info-box-number"><?php echo number_format(closed_inquiry_count('Cancel')); ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
					<!-- <div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_type?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div> -->
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- ./inquiry_closed -->

		<!-- conversion_ratio -->
		<div class="row">
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
						<a href="<?php echo site_url('crm-reports/generate/inquiry_conversion?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Test Drive Conversion Ratio</h3>
					</div>
					<div class="box-body">
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Converted</span>
									<span class="info-box-number"><?php echo test_drive_conversion_ratio('Converted'); ?> %</span>
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
									<span class="info-box-number"><?php echo test_drive_conversion_ratio('Not Converted'); ?> %</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
					</div>
					<!-- ./box-body -->
					<div class="box-footer text-right">
						<a href="<?php echo site_url('crm-reports/generate/inquiry_test_drive_conversion?generate=1');?>" class="uppercase" target="_blank">View Detail Report</a>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.conversion_ratio -->

		<!-- inquiry_trend-->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-body">
						<div class="row">
							<div class="col-md-8">
								<div class="chart" id='chartContainer-1'>
								</div>
								<!-- /.chart-responsive -->
							</div>
							<!-- /.col -->
							<div class="col-md-4">
								<p class="text-center">
									<strong>Top 6 Model Inquiries (Last 6 Months)</strong>
									<?php $demand = vehicle_demand(-1); ?>
									<?php $total_demand = $demand['total'];?>
								</p>
								<?php if ($total_demand > 0):?>
									<?php $color = array('green', 'yellow', 'red', 'blue', 'aqua', 'light-blue');?>
									<?php for( $i = 0; $i < 6; $i++):?>
										<?php $demand = vehicle_demand($i); ?>
										<?php if ($demand == null) break; ?>
										<div class="progress-group">
											<span class="progress-text"><?php echo $demand['vehicle_name'];?></span>
											<span class="progress-number"><b><?php echo $demand['total'];?></b> | <?php echo $total_demand; ?></span>

											<div class="progress sm active">
												<div class="progress-bar progress-bar-striped progress-bar-<?php echo $color[$i];?>" style="width: <?php echo intval(($demand['total'] * 100)/$total_demand);?>%"></div>
											</div>
										</div>
									<?php endfor;?>
								<?php else:?>
									<div class="progress-group">
										<span class="progress-text">No Record Found</span>
										<span class="progress-number"></span>
										<div class="progress sm">
											<div class="progress-bar progress-striped progress-bar-red" style="width: 0%"></div>
										</div>
									</div>

								<?php endif;?>
								
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
		<!-- /.inquiry_trend -->

		<!-- followup n recent inquiry -->
		<div class="row">
			<div class='col-md-12'>
				<!-- TABLE: LATEST ORDERS -->
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Followup</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo $this->load->view($this->config->item('template_admin') .'partial_customer_followups_html');?>
					</div>

				</div>
				<!-- /.box -->
			</div> 
		</div>
		<!-- ./followup n recent inquiry -->
		<div class="row">
			<div class='col-md-12'>
				<!-- TABLE: LATEST ORDERS -->
				<div class="box box-solid">
					<div class="box-header">
						<h3 class="box-title">Discount</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo $this->load->view($this->config->item('template_admin') .'discount_schemes');?>
					</div>

				</div>
				<!-- /.box -->
			</div> 
		</div>
	</section>
	<!-- /.content -->
</div>

<script type="text/javascript">
	var chart = null,
	url = '<?php echo site_url("admin/crm_reports/get_datafield_sources");?>',
	colorsArray = ['#0000FF', '#FFFF00', '#FF0000', '#00FF00', '#0FFFF0',  '#F0FFF0'];

	$(function (){   
    // $.jqx._jqxChart.prototype.colorSchemes.push({ name: 'myScheme', colors: colorsArray });

    //create chart
    var settings = {
    	title: "Inquiry Trend - Last 6 Months",
    	description: "",
    	enableAnimations: true,
    	showLegend: true,
    	padding: { left: 10, top: 5, right: 10, bottom: 5 },
    	titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
    	source: null,
    	xAxis:
    	{
    		dataField: 'Duration',
    		showTickMarks: true,
    		tickMarksInterval: 1,
    		tickMarksColor: '#888888',
    		showGridLines: true,
    		gridLinesInterval: 3,
    		gridLinesColor: '#888888',
    		valuesOnTicks: true,
    		textRotationPoint: 'topright',
    		textOffset: {x: 0, y: 0},
    		rangeSelector: {
                // Uncomment the line below to render the selector in a separate container 
                //renderTo: $('#selectorContainer'),
                size: 80,
                padding: { /*left: 0, right: 0,*/top: 0, bottom: 0 },
                // minValue: new Date(2010, 5, 1),
                backgroundColor: 'white',
                dataField: 'inquiries',
                baseUnit: 'month',
                gridLines: { visible: false },
                serieType: 'area',
                /*labels: {
                    formatFunction: function (value) {
                        return months[value.getMonth()] + '\'' + value.getFullYear().toString().substring(2);
                    }
                }*/
            }
        },
        colorScheme: 'scheme05',
        seriesGroups:
        [{
        	type: 'area',
        	valueAxis:
        	{
        		displayValueAxis: true,
        		axisSize: 'auto',
        		tickMarksColor: '#888888'
        	},
        	series: []
        }]
    };
    $('#chartContainer-1').jqxChart(settings);
    chart = $('#chartContainer-1').jqxChart('getInstance');

    $('#chartContainer-1').css('height', 325);
    $('#chartContainer-1').css('width', '100%');

    load_trend_graph();

    customer_followups();

});

	function load_trend_graph()
	{
		var data = {};
		data.group_criteria = 'month';

		data.date_range = {};
		data.start_date = data.date_range.from = '<?php echo date("Y-m-d", strtotime("-6 month", time()));?>';
		data.end_date = data.date_range.to = '<?php echo date("Y-m-d");?>';

		data.column_name = 'inquiry_date_en::date';
		data.table_view = 'view_customers';

		$.getJSON( 
			'<?php echo site_url("admin/crm_reports/get_datafield_sources");?>',
			data
			).done(function(response) {
				var source =
				{
					datatype: "json",
					datafields: response.source,
					url: '<?php echo site_url("admin/crm_reports/inquiry_trend_json"); ?>',
					data: data
				};

				var dataAdapter = new $.jqx.dataAdapter(source, {
					async: true, 
					autoBind: true, 
					loadError: function (xhr, status, error) {
						alert('Error loading "' + source.url + '" : ' + error); 
					},
				});

				chart.seriesGroups[0].series = response.series;
				chart.seriesGroups[0].type = 'spline';
				$('#chartContainer-1').jqxChart({ source: dataAdapter });
			});
		}

/*
function today_followup()
{
	$.ajax({
        type: "GET",
        url: '<?php echo site_url("admin/customers/get_today_followup_json"); ?>',
        // data: data,
        success: function (result) {
            var result = eval('('+result+')');
            console.log(result);
             $('#report-table').html("<table class='table table-bordered table-striped dataTable' id='followup-data-table'></table>");
            buildHtmlTable(result.data,'followup-data-table');
            console.log($('#followup-data-table td:last-child'));
        }
    });
}*/


</script>
<?php echo $this->load->view($this->config->item('template_admin') .'partial_customer_followups_js');?>

