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
						<li style="margin-left: 30px;"><?php echo lang('tab_index');?></li>
						<li><?php echo lang('tab_firm');?></li>
						<li><?php echo lang('tab_vehicle');?></li>
						<li><?php echo lang('tab_variant');?></li>
						<li><?php echo lang('tab_color');?></li>
						<li><?php echo lang('tab_education');?></li>
						<li><?php echo lang('tab_occupation');?></li>
						<li><?php echo lang('tab_relation');?></li>
						<li><?php echo lang('tab_designation');?></li>
						<li><?php echo lang('tab_walkin_source');?></li>
						<li><?php echo lang('tab_reason');?></li>
						<li><?php echo lang('tab_institution');?></li>
						<li><?php echo lang('tab_bank');?></li>
						<?php /* ?><li><?php echo lang('tab_inquiry_status');?></li>
						<li><?php echo lang('tab_customer_type');?></li>
						<li><?php echo lang('tab_payment_mode');?></li>
						<li><?php echo lang('tab_title');?></li>
						<li><?php echo lang('tab_source');?></li>
						<?php */ ?>
					</ul>
					
					<div class="tab_content"><?php echo $this->load->view('partial_index');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_firms');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_vehicles');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_variants');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_colors');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_educations');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_occupations');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_relations');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_designations');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_walkin_sources');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_reasons');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_institutions');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_banks');?></div>
					<?php /* ?><div class="tab_content"><?php echo $this->load->view('partial_inquiry_statuses');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_customer_types');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_payment_modes');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_titles');?></div>
					<div class="tab_content"><?php echo $this->load->view('partial_sources');?></div>
					<?php */ ?>
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
			case '<?php echo lang("tab_firm");?>':
				mst_firms();
				break;
			case '<?php echo lang("tab_vehicle");?>':
				mst_vehicles();
				break;
			case '<?php echo lang("tab_variant");?>':
				mst_variants();
				break;
			case '<?php echo lang("tab_color");?>':
				mst_colors();
				break;
			case '<?php echo lang("tab_education");?>':
				mst_educations();
				break;
			case '<?php echo lang("tab_occupation");?>':
				mst_occupations();
				break;
			case '<?php echo lang("tab_relation");?>':
				mst_relations();
				break;
			case '<?php echo lang("tab_designation");?>':
				mst_designations();
				break;
			case '<?php echo lang("tab_walkin_source");?>':
				mst_walkin_sources();
				break;
			case '<?php echo lang("tab_reason");?>':
				mst_reasons();
				break;
			case '<?php echo lang("tab_institution");?>':
				mst_institutions();
				break;
			case '<?php echo lang("tab_bank");?>':
				mst_banks();
				break;
			<?php /* ?>case '<?php echo lang("tab_inquiry_status");?>':
				mst_inquiry_statuses();
				break;
			case '<?php echo lang("tab_customer_type");?>':
				mst_customer_types();
				break;
			case '<?php echo lang("tab_payment_mode");?>':
				mst_payment_modes();
				break;
			
			case '<?php echo lang("tab_title");?>':
				mst_title();
				break;
			case '<?php echo lang("tab_source");?>':
				mst_sources();
				break;
			<?php */ ?>
		}
	};

	$('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

	$('.select-tab').on('click', function(){
		var tabindex = parseInt(this.getAttribute("data-tabindex"));
		$('#jqxTabs').jqxTabs({ selectedItem: tabindex });
	});
});



</script>
