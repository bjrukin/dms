<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $employee_info->first_name; ?> <?php echo $employee_info->last_name; ?>
		</h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li><a href="<?php echo site_url('admin/employees');?>"><?php echo lang('menu_employees'); ?></a></li>
	        <li class="active"><?php echo lang('employee_detail'); ?></a></li>
      	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div id='jqxTabs'>
					<ul>
						<li style="margin-left: 30px;"><?php echo lang("employee_detail");?></li>
						<li><?php echo lang("employee_contacts");?></li>
						<li><?php echo lang("customer_followups");?></li>
					</ul>
					<div class="tab_content"><?php echo $this->load->view('partial_employee_details');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_employee_contacts');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_customer_followups');?></div>
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
			case '<?php echo lang("employee_contacts");?>':
				employee_contacts();
				break;
			case '<?php echo lang("customer_followups");?>':
				customer_followups();
				break;
		}
	};

	$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

});

</script>
