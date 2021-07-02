<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('sparepart_stocks'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('sparepart_stocks'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">		

		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<li>Dispatch<?php echo lang('own_stock') ?></li>
				<li>Dispatch List<?php echo lang('own_stock') ?></li>
				<li>Receive<?php echo lang('other_dealer_stock') ?></li>
			</ul>

			<div>
				<?php echo $this->load->view('sparepart_stocks/admin/transfer/dispatch'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_stocks/admin/transfer/dispatch_list'); ?>
			</div>
			<div>
				<?php echo $this->load->view('sparepart_stocks/admin/transfer/receive'); ?>
			</div>

		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$(function(){
		var initWidgets = function (tab) {
			var tabName = $('#jqxTabs').jqxTabs('getTitleAt', tab);
			console.log(tabName);
			switch (tabName) {
				case '<?php echo lang("own_stock");?>':
				//customer_statuses();
				break;
				case '<?php echo lang("other_dealer_stock");?>':
				// customer_followups();
				break;

			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script>
