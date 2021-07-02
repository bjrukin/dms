<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->	
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li><a href="<?php echo site_url('admin/customers');?>"><?php echo lang('menu_customers'); ?></a></li>
			<li class="active"><?php echo lang('inquiry_transfer'); ?></a></li>
		</ol>
	</section>
	<div class="container">
	<h3>Inquiry Transfer</h3>
		<br/>
		<?php echo form_open('', array('id' =>'form-inquiry_transfer', 'onsubmit' => 'return false')); ?>
		<div class="row">
			<div class="col-md-2"> <label for="dealer"> From Dealer: </label> </div>
			<div class="col-md-3"><div id="from_dealer_id" name="from_dealer_id"></div></div>
			<div class="col-md-2"> <label for="dealer"> To Dealer: </label> </div>
			<div class="col-md-3"><div id="to_dealer_id" name="to_dealer_id"></div></div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-2"> <label for="from">From Executive:</label></div>
			<div class="col-md-3"> <div id="from_executive_id" name="from_executive_id"></div> </div>

			<div class="col-md-2"> <label for="from">To Executive:</label> </div>
			<div class="col-md-3"> <div id="to_executive_id" name="to_executive_id"></div> </div>
		</div><br/>
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success btn-md btn-flat" id="submit_btn"><?php echo "Transfer" ?></button>
			</div>
		</div>
		<?php echo form_close();?>
		<br/>
		<h3><div id="msg_box"></div></h3>
	</div>

</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var dealerDataSource = {
			url : '<?php echo site_url("admin/customers/get_dealers_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

		$("#from_dealer_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: dealerDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		$("#to_dealer_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: dealerDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		$("#from_dealer_id").bind('select', function (event) {

			if (!event.args)
				return;

			val = $("#from_dealer_id").jqxComboBox('val');
			executiveDataSource  = {
				url : '<?php echo site_url("admin/customers/get_executives_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				data: {
					dealer_id: val
				},
				async: false,
				cache: true
			}

			executiveDataAdapter = new $.jqx.dataAdapter(executiveDataSource, {autoBind: false});

			$("#from_executive_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: executiveDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});
		});

		$("#to_dealer_id").bind('select', function (event) {

			if (!event.args)
				return;

			val = $("#to_dealer_id").jqxComboBox('val');
			executiveDataSource  = {
				url : '<?php echo site_url("admin/customers/get_executives_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				data: {
					dealer_id: val
				},
				async: false,
				cache: true
			}

			executiveDataAdapter = new $.jqx.dataAdapter(executiveDataSource, {autoBind: false});

			$("#to_executive_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: executiveDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});
		});

		$("#submit_btn").on('click', function () {
			save_inquiry_transfer();
		});
	});

	function save_inquiry_transfer()
	{
		var data = $("#form-inquiry_transfer").serialize();

		$('.container').block({ 
			message: '<span>Processing your request. Please be patient.</span>',
			css: { 
				width                   : '75%',
				border                  : 'none', 
				padding                 : '50px', 
				backgroundColor         : '#000', 
				'-webkit-border-radius' : '10px', 
				'-moz-border-radius'    : '10px', 
				opacity                 : .7, 
				color                   : '#fff',
				cursor                  : 'wait' 
			}, 
		});

		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/customers/save_inquiry_transfer"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					reset_inquiry_transfer();
					$('.container').jqxWindow('close');
					var msg = result.data.count_inquiry+' Inquiry has been transferred from '+ result.data.from_name+' to '+result.data.to_name;
					$('#msg_box').html(msg);
				}
				$('.container').unblock();
			}
		});

	}
	function reset_inquiry_transfer()
	{
	}

</script>
