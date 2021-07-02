<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">		
		<h1><?php echo lang('sparepart_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('sparepart_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">		

		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<li><?php echo lang('dealer_order') ?></li>
				<li><?php echo lang('dealer_order_list') ?></li>
				<li><?php echo lang('back_order') ?></li>
				<li><?php echo lang('recent_dispatch') ?></li>
				<li><?php echo lang('received_order') ?></li>
				
			</ul>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/dealer_order'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/proforma_list'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/back_order'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/recent_dispatch'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/received_order'); ?>
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
				case '<?php echo lang("sparepart_orders");?>':
				break;
				case '<?php echo lang("proforma_list");?>':
				break;
				case '<?php echo lang("back_order");?>':
				break;
				case '<?php echo lang("recent_dispatch");?>':
				break;
				case '<?php echo lang("received_order");?>':
				break;
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script>
