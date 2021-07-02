<div class="content-wrapper">
	<section class="content">
		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<li><?php echo lang('ccd_threedays') ?></li>
				<li><?php echo lang('ccd_thirtydays') ?></li>
				<?php /*<li><?php echo lang('ccd_sixtydays') ?></li>*/?>
			</ul>
			<div>
				<?php echo $this->load->view('ccd_threedays/admin/index');?>
			</div>
			<div>
				<?php echo $this->load->view('ccd_thirtydays/admin/index');?>
			</div>
			<?php /*<div>
				<?php echo $this->load->view('ccd_sixtydays/admin/index');?>
			</div>*/?>
		</div>
	</section>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		var initWidgets = function (tab) {
			var tabName = $('#jqxTabs').jqxTabs('getTitleAt', tab);
			switch (tabName) {
				case '<?php echo lang("ccd_threedays");?>':
				break;
				case '<?php echo lang("ccd_thirtydays");?>':
				break;
				/*case '<?php echo lang("ccd_sixtydays");?>':
				break; */
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script>
