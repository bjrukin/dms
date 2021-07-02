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

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui.min.js');?>"></script>

<!-- PivotTable.js libs from ../dist -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/pivot/pivot.css');?>">
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/pivot.js');?>"></script>

<style type="text/css">
    .data-table{
        width:100%;
        border-collapse:collapse;
        table-layout:fixed; 
    }
    .data-table th, .data-table td{
        text-align: center;
        vertical-align: middle;
        font-weight: normal!important;       
    }
</style>

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Inquiry Status</h3>
            </div><!-- /.box-header -->

			<div class="box-body">
				<div class="margin">
					<label for='dealer_id'><?php echo lang('dealer_id')?></label>
					<div id='dealer_id' name='dealer_id'></div>
				</div>
				<div id="customer_status">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<!-- stock position -->
	<div class="col-md-12">
		<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Current Stock Position</h3>
            </div><!-- /.box-header -->

			<div class="box-body">
                <div id ="report-table">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<!-- Bill Detail -->
	<div class="col-md-12">
		<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Bill Detail</h3>
            </div><!-- /.box-header -->

			<div class="box-body">
                <div id ="report-billing-table">-----something is wrong------</div>
			</div>
		</div>
	</div>
	<!-- Retail Detail -->
	<div class="col-md-12">
		<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Retail Detail</h3>
            </div><!-- /.box-header -->

			<div class="box-body">
                <div id ="report-retail-table">-----something is wrong------</div>
			</div>
		</div>
	</div>

	<!-- Inquiry -->
	<?php /*<div class="col-md-12">
		<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Retail Detail</h3>
            </div><!-- /.box-header -->

			<div class="box-body">
                <div id ="report-inquiry-table">-----something is wrong------</div>
			</div>
		</div>
	</div>*/?>
</div>

