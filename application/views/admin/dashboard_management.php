<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Management Dashboard</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo "Management Dashboard"; ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div id='jqxTabs'>
					<ul>
						<li style="margin-left: 30px;"><?php echo lang('tab_index');?></li>
						<li><?php echo lang('tab_sales');?></li>
						<li><?php echo lang('tab_logistic');?></li>						
					</ul>
					
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_management_index');?></div>
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_sales');?></div>
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_logistic');?></div>
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
				case '<?php echo lang("tab_sales");?>':
				partial_sales();
				break;
				case '<?php echo lang("tab_logistic");?>':
				partial_logistic();
				break;
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

		$('.select-tab').on('click', function(){
			var tabindex = parseInt(this.getAttribute("data-tabindex"));
			$('#jqxTabs').jqxTabs({ selectedItem: tabindex });
		});
	});



</script>
