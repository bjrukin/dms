<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('daily_credits'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('daily_credits'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDaily_creditToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDaily_creditUpload"><?php echo 'Import'; ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDaily_creditFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDaily_credit">
					Please fix this issue and reupload. Thank you.<br>
					Error:

					<div class="row">
	
						<!-- ./col -->
						<?php foreach ($error as $key => $value) {?>
							<div class="col-md-4">
							<div class="box box-solid">
								<div class="box-header with-border">
									<i class="fa fa-text-width"></i>
									<h3 class="box-title"><?php echo ucfirst($key)?></h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<ol>
										<?php foreach ($value as $k => $val) {?>
											<li><?php echo $val?></li>
										<?php }?>
									</ol>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
							</div>
							<!-- ./col -->
						<?php }?>
					</div>
				</div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->



