<!-- applicarion/views/admin -->

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

		<!-- stock position -->
	  	<div class="box-body">
	  		<?php echo $this->load->view($this->config->item('template_admin') .'sales_detail');?>
	  	</div>
		<!-- ./stock position -->
				
	</section>
	<!-- /.content -->
</div>

<?php echo $this->load->view($this->config->item('template_admin') .'sales_detail_js');?>