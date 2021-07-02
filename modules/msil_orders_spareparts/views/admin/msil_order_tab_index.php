<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">		
		<h1><?php echo lang('msil_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">		

		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<li><?php echo lang('msil_orders') ?></li>
				<li><?php echo lang('msil_dispatch') ?></li>
				<li><?php echo lang('export_binning') ?></li>
			</ul>
			<div>
				<?php echo $this->load->view('msil_orders_spareparts/admin/index'); ?>
			</div>
			<div>
				<?php echo $this->load->view('msil_orders_spareparts/admin/msil_dispatch'); ?>
			</div>
			<div>
				<?php echo $this->load->view('msil_orders_spareparts/admin/msil_binning'); ?>
			</div>
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){
		var initWidgets = function (tab) {
			var tabName = $('#jqxTabs').jqxTabs('getTitleAt', tab);
			switch (tabName) {
				case '<?php echo lang("msil_orders_spareparts");?>':
				break;
				case '<?php echo lang("msil_dispatch");?>':
				break;
				case '<?php echo lang("export_binning");?>':
				break;
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script>
