<?php if(control('Dashboard Sales Report', FALSE)):?>
	<a class='select-tab' href="javascript:void(0)" data-tabindex="01"><div class="master-menu-box"><?php echo lang('sales_dashboard');?></div></a>
<?php endif; ?>
<?php if(control('Dashboard Logistic Report', False)):?>
	<a class='select-tab' href="javascript:void(0)" data-tabindex="02"><div class="master-menu-box"><?php echo lang('logistic_dashboard');?></div></a>
<?php endif; ?>
<?php if(control('Dashboard Dealer Report', False)):?>
	<a class='select-tab' href="javascript:void(0)" data-tabindex="03"><div class="master-menu-box"><?php echo lang('dealer_dashboard');?></div></a>
<?php endif; ?>
