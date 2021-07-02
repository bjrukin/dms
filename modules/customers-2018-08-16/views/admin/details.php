<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $customer_info->first_name; ?> <?php echo $customer_info->last_name; ?>
		</h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li><a href="<?php echo site_url('admin/customers');?>"><?php echo lang('menu_customers'); ?></a></li>
	        <li class="active"><?php echo lang('customer_detail'); ?></a></li>
      	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div id='jqxTabs'>
					<ul>
						<li style="margin-left: 30px;"><?php echo lang("customer_detail");?></li>
						<li><?php echo lang("customer_statuses");?></li>
						<li><?php echo lang("customer_followups");?></li>
						<li><?php echo lang("customer_test_drives");?></li>
						<li><?php echo lang("quotations");?></li>
						<li><?php echo lang("discounts");?></li>
					</ul>
					<div class="tab_content"><?php echo $this->load->view('partial_customer_details');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_customer_statuses');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_customer_followups');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_customer_test_drives');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_quotations');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_discounts');?></div>
				</div>
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
			case '<?php echo lang("customer_statuses");?>':
				customer_statuses();
				break;
			case '<?php echo lang("customer_followups");?>':
				customer_followups();
				break;
			case '<?php echo lang("customer_test_drives");?>':
				customer_test_drives();
				break;
			case '<?php echo lang("quotations");?>':
				quotations();
				break;
			case '<?php echo lang("discounts");?>':
				discounts();
				break;
		}
	};

	$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

});

</script>
