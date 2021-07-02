<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header common-content-header">
		<div class="box-body">
			<div class="content-header-title">
				<h4> SPAREPART DASHBOARD</h4>
			</div>
	

		</div>
	</section>
	<!-- Main content -->
	<section class="content">

		<!-- stock position -->
	  	<div class="box-body">
	  		<?php echo $this->load->view($this->config->item('template_admin') .'spareparts_stock_position');?>
	  		
	  	</div>
		<!-- ./stock position -->
				
	</section>
	<!-- /.content -->
</div>
<?php echo $this->load->view($this->config->item('template_admin') .'spareparts_stock_position_js');?>
