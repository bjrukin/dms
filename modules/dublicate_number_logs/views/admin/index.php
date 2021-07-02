<div class="content-wrapper">
	<section class="content">
		<div id='jqxTabs'>
			<ul style='margin-left: 20px;'>
				<li>Dublicate Number Logs</li>
				<li>Duplicate Booked Number Logs</li>
				<li>Booking Document Logs</li>
				<li>Dublication Report</li>
				<?php /*<li><?php echo lang('ccd_sixtydays') ?></li>*/?>
			</ul>
			<div>
				<?php $this->load->view('dublicate_number_logs/admin/number_log'); ?>
			</div>
			<div>
				<?php $this->load->view('dublicate_number_logs/admin/booked_number_log'); ?>
			</div>
			<div>
				<?php $this->load->view('dublicate_number_logs/admin/document_log'); ?>
				<!-- Number -->
			</div>
			<div>
				<?php $this->load->view('dublicate_number_logs/admin/dublication_report'); ?>
				<!-- Number -->
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
				case 'Dublicate Number Logs':
				break;
				case 'Document Number Booked Logs':
				break;
				case 'Document Logs':
				break;
				case 'Dublication Report':
				break;
				/*case '<?php echo lang("ccd_sixtydays");?>':
				break; */
			}
		};

		$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	});

</script>
