<!-- applicarion/views/admin -->

<style>
.info-box-text {font-size: 18px}
.info-box-number {font-size: 28px}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 20px !important">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>LOGISTIC DASHBOARD</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-default">
					<body class='default'>
						<div id='chartContainer-stock_summary' style="width: 575px; height: 465px;"> </div>
					</body>
				</div>

			</div>			
			<div class="col-md-6">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Stock Status</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div id="stock_status"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-default">
					<body class='default'>
						<div id='chartContainer-yearwise' style="width: 575px; height: 405px;"> </div>
					</body>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-default">
					<body class='default'>
						<div id='chartContainer-segmentwise' style="width: 575px; height: 405px;"> </div>
					</body>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-default">
					<body class='default'>
						<div id='chartContainer-ageing' style="width: 575px; height: 405px;"> </div>
					</body>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>

<?php echo $this->load->view($this->config->item('template_admin') .'partial_logistic_js.php');?>