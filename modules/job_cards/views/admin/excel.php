<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Upload</h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li class="active">excel upload</li>
      	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<form action="<?php echo site_url('admin/job_cards/excelUpload')?>" method="post" enctype="multipart/form-data">
					<input type="file" name="userfile">
					<input type="submit">
				</form>
			</div>
		</div>
	</section>
</div>