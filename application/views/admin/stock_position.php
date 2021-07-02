<style type="text/css">
table.form-table td:nth-child(1){
	width:13%;
}
table.form-table td:nth-child(odd){
	width:13%;
}
table.form-table td:nth-child(even){
	width:20%;
}
</style>
<script src="<?php echo base_url()?>assets/js/Chart.min.js"></script>

<div class="row">
	<div class="col-md-3">

		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Stock Summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<canvas id="pieChart" style="height:50px"></canvas>
			</div>

			<div class="box-footer no-padding">
				<ul class="nav nav-pills nav-stacked" id="chart_detail">
				</ul>
			</div><!-- /.footer -->
		</div>

	</div>
	<div class="col-md-9">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Mfg Year</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="mgf_year">-----something is wrong------</div>
			</div>
		</div>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Display Count</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div id="display_count">-----something is wrong------</div>
            </div>
        </div>
	</div>
</div>
<div class="row">
	<?php /*<div class="col-md-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Dispatch Request</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="dispatch_request">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Retail Request</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="retail_request">-----something is wrong------</div>
			</div>
		</div>
	</div>*/?>
	<div class="col-md-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Retail Detail</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="sales_graph" style="height: 300px">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Bill Detail</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="last_year_sales_graph" style="height: 300px">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Dealership Position</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="dealership_position">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<!-- stock position -->
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Stock position</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="stock_position_table">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<!-- billing -->
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Billing</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="billing_record">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<!-- retail -->
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Retail</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="retail_record">-----something is wrong------</div>
			</div>
		</div>
	</div>
</div>

