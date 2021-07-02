<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">		
		<h1><?php echo lang('billing'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('billing'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">		

		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<li><?php echo lang('billing') ?></li>
				<li><?php echo lang('no_order_billing') ?></li>
				<li><?php echo lang('billing_list') ?></li>
			</ul>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/dispatch_list'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/dispatch_list_no_bill'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_orders/admin/billing_list'); ?>
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
				case '<?php echo lang("billing");?>':
				break;
				case '<?php echo lang("no_order_billing");?>':
				break;
				case '<?php echo lang("billing_list");?>':
				break;
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script>
