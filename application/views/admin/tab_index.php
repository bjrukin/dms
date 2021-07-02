<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Master Data</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('menu_masters');?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div id='jqxTabs'>
					<ul>
						<?php if(control('Dashboard Sales Report', FALSE)):?>
							<li><?php echo lang('sales_dashboard');?></li>
						<?php endif; ?>
						<?php if(control('Dashboard Logistic Report', False)):?>
							<li><?php echo lang('logistic_dashboard');?></li>
						<?php endif; ?>
					</ul>
					<?php if(control('Dashboard Sales Report', FALSE)):?>
						<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'dashboard');?></div>
					<?php endif; ?>					
					<?php if(control('Dashboard Sales Report', FALSE)):?>
						<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'dashboard_logistic');?></div>
					<?php endif; ?>
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
				case '<?php echo lang("sales_dashboard");?>':
				// sales_dashboard();
				break;
				case '<?php echo lang("logistic_dashboard");?>':
				// logistic_dashboard();
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