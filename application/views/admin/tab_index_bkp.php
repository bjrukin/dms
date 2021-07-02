<div class="content-wrapper">
	<section class="content">		

		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<?php if(control('Dashboard Sales Report', FALSE)):?>
				<li><?php echo lang('sales_dashboard') ?></li>
				<?php endif;?>
				<?php if(control('Dashboard Logistic Report', False)):?>
				<li><?php echo lang('logistic_dashboard') ?></li>
				<?php endif;?>
				<?php if(control('Dashboard Dealer Report', False)):?>
				<li><?php echo lang('dealer_dashboard') ?></li>
				<?php endif;?>
			</ul>
			<?php if(control('Dashboard Sales Report', FALSE)):?>
			<div>
				<?php echo $this->load->view($this->config->item('template_admin') .'dashboard');?>
			</div>
			<?php endif;?>
			<?php if(control('Dashboard Logistic Report', False)):?>
			<div>
				<?php echo $this->load->view($this->config->item('template_admin') .'dashboard_logistic');?>
			</div>
			<?php endif;?>
			<?php if(control('Dashboard Dealer Report', False)):?>
			<div>
				<?php echo $this->load->view($this->config->item('template_admin') .'dashboard_dealer');?>
			</div>
			<?php endif;?>
		</div>
	</section>
</div>
<script language="javascript" type="text/javascript">

	$(function(){
		var initWidgets = function (tab) {
			var tabName = $('#jqxTabs').jqxTabs('getTitleAt', tab);
			switch (tabName) {
				case '<?php echo lang("sales_dashboard");?>':
				break;
				case '<?php echo lang("logistic_dashboard");?>':
				break;
				case '<?php echo lang("dealer_dashboard");?>':
				break; 
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script> 

