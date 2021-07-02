<!-- applicarion/views/admin -->

<style>
.info-box-text {font-size: 18px}
.info-box-number {font-size: 28px}

.common-content-header .box-body{
	display: inline-block;
	vertical-align: top;
	width: 100%
}
.common-content-header .content-header-title{
	float: left;
	width: 50%;
}

.common-content-header .content-header-switcher{
	float: left;
	width: 50%;
	text-align: right;
	display: flex;
	align-items: center;
    justify-content: flex-end;
}

.common-content-header .content-header-switcher .switcher-title{
	margin-right: 10px;
	display:block;
}

.common-content-header .content-header-switcher .dropdown{
	display: inline-block;
	vertical-align: top;
}

.common-content-header .content-header-switcher .dropdown .dropdown-menu{
	right: 0;
    left: inherit;
    min-width: 135px;
    top: 30px;
    background-color: #e6e6e6
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header common-content-header">
		<div class="box-body">
			<div class="content-header-title">
				<h4>DASHBOARD</h4>
			</div>
	
			<div class="content-header-switcher">
				<div class="switcher-title">Select Fiscal Year:</div>
				<div class="dropdown">
				  	<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php echo explode('-',explode(' - ',$active_fiscal)[0])[0] .' - '. explode('-',explode(' - ',$active_fiscal)[1])[0]  ?>
				  	<span class="caret"></span></button>
				  	<ul class="dropdown-menu">
						<?php foreach ($fiscal_years as $key => $value): ?>
						    <li class = "<?php echo ($active_fiscal == $value->nepali_start_date.' - '.$value->nepali_end_date)?'active':'' ?>" ><a href="<?php echo site_url('logistic_dashboard/'.$value->nepali_start_date.' - '.$value->nepali_end_date) ?>"><?php echo explode('-', $value->nepali_start_date)[0].' - '. explode('-', $value->nepali_end_date)[0] ?></a></li>					   
						<?php endforeach; ?>
				  	</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Main content -->
	<section class="content">

		<!-- stock position -->
	  	<div class="box-body">
	  		<?php echo $this->load->view($this->config->item('template_admin') .'stock_position');?>
	  	</div>
		<!-- ./stock position -->
				
	</section>
	<!-- /.content -->
</div>

<?php echo $this->load->view($this->config->item('template_admin') .'stock_position_js');?>