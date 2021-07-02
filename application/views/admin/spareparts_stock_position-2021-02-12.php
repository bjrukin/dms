<div class="row">

	<div class="col-md-5">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">FMS summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="spareparts_stock_position">-----something is wrong------</div>
			</div>
		</div>
	</div>


	<div class="col-md-7">

		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Stock summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id='jqxTabs'>
					<ul>
					
						<li><?php echo lang('tab_fast');?></li>
						<li><?php echo lang('tab_medium');?></li>						
						<li><?php echo lang('tab_none');?></li>						
						<li><?php echo lang('tab_slow');?></li>						
					</ul>
			
		
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_fast');?></div>
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_medium');?></div>
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_none');?></div>
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_slow');?></div>
				</div>
			</div>
		</div>
	
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Daily and Monthly Sale summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id='jqxTabsSales'>
					<ul>
					
						<li><?php echo lang('tab_daily');?></li>
						<li><?php echo lang('tab_monthly');?></li>						
										
					</ul>
					
				
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_daily_sales');?></div>
					<div class="tab_content"><?php echo $this->load->view($this->config->item('template_admin') .'partial_monthly_sales');?></div>
			
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-7">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">PI Pending summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="jqxPiPending">-----something is wrong------</div>
			</div>
		</div>

	</div>
</div>
<div class="row">

	<div class="col-md-7">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Back Order summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="jqxbackorder">-----something is wrong------</div>
			</div>
		</div>

	</div>
	<div class="col-md-5">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Picklist summary</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="jqxPicklist">-----something is wrong------</div>
			</div>
		</div>

	</div>
	
	<div class="col-md-12">
		
			<label for='dealer_id'>Dealer Name</label>
			
			<div id='dealer_list' name='dealer_list'></div>
			
		
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Dispatch Detail</h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<div id="test_graph_div" style="height: 300px">-----something is wrong------</div>
			</div>
		</div>
	</div>



</div>



 