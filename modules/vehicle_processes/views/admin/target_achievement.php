<style type="text/css">
	#data-table{
		width:100%;
		border-collapse:collapse;
		table-layout:fixed; 
	}
	#data-table th, #data-table td{
		text-align: center;
		vertical-align: middle;
	}
	#data-table td:first-child {
		width: 300px!important;
		font-size: 105%
	}
	.box.box-solid>.box-header .btn:hover, .box.box-solid>.box-header a:hover {
		background-color: #367fa9;
	}
	.report-cell {min-width: 100px;max-width: 350px}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12 col-sm-6 col-xs-12">
				<div class="box box-solid">
					<div class="box-body">
						<form action="<?php echo site_url('vehicle_processes/target_achievement_report') ?>" method="POST">
							<table class="table table-responsive table-striped">
								<tr>
									<td><label for='Year'>Year</label></td>
									<td><input type="text" name="year" class="text_input"></td>
									<td><label for='month'>Month</label></td>
									<td><input type="text" name="month" class="text_input"></td>
									<td><button type="submit">Generate</button></td>
								</tr>						
							</table>
						</form>
					</div>
					<br/>                
				</div>
			</div>			
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


