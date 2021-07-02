<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo $header; ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('stock_records'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-md-2"><label for='vehicle_id'><?php echo lang('vehicle_name')?><span class='mandatory'>*</span></label></div>
			<div class="col-md-2"><div id='vehicle_id' name='vehicle_id'></div></div>
			<div class="col-md-2"><label for='variant_id'><?php echo lang('variant_id')?><span class='mandatory'>*</span></label></div>
			<div class="col-md-2"><div id='variant_id' name='variant_id'></div></div>
			<div class="col-md-2"><label for='color_id'><?php echo lang('color_name')?><span class='mandatory'>*</span></label></div>
			<div class="col-md-2"><div id='color_id' name='color_id'></div></div>
		</div>
		<div class="row">
			<div class="col-md-2"><button class="btn btn-success" id="check_vehicle_stock_btn">Search</button></div>
		</div>
		<div id="result"></div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">
	$(function()
	{
		//mst_vehicles
	    $("#vehicle_id").jqxComboBox({
	    	theme: theme,
	    	width: 195,
	    	height: 25,
	    	selectionMode: 'dropDownList',
	    	autoComplete: true,
	    	searchMode: 'containsignorecase',
	    	source: array_vehicles,
	    	displayMember: "name",
	    	valueMember: "id",
	    });
	});

	//mst_variants
	$("#vehicle_id").bind('select', function (event) {

		if (!event.args)
			return;

		vehicle_id = $("#vehicle_id").jqxComboBox('val');

		var variantDataSource  = {
			url : '<?php echo site_url("admin/customers/get_variants_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'variant_id', type: 'number' },
			{ name: 'variant_name', type: 'string' },
			],
			data: {
				vehicle_id: vehicle_id
			},
			async: false,
			cache: true
		}

		variantDataAdapter = new $.jqx.dataAdapter(variantDataSource, {autoBind: false});

		$("#variant_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: variantDataAdapter,
			displayMember: "variant_name",
			valueMember: "variant_id",
		});
	});

	// mst_color
	$("#variant_id").bind('select', function (event) {

		if (!event.args)
			return;

		vehicle_id = $("#vehicle_id").jqxComboBox('val');
		variant_id = $("#variant_id").jqxComboBox('val');

		var colorDataSource  = {
			url : '<?php echo site_url("admin/customers/get_colors_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'color_id', type: 'number' },
			{ name: 'color_name', type: 'string' },
			],
			data: {
				vehicle_id: vehicle_id,
				variant_id: variant_id
			},
			async: false,
			cache: true
		}

		colorDataAdapter = new $.jqx.dataAdapter(colorDataSource, {autoBind: false});
		$("#color_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: colorDataAdapter,
			displayMember: "color_name",
			valueMember: "color_id",
		});
	});

	$('#check_vehicle_stock_btn').click(function(){
		var vehicle_id = $('#vehicle_id').val();
		var variant_id = $('#variant_id').val();
		var color_id = $('#color_id').val();
		$.post('<?php echo site_url("admin/stock_records/check_stock_json")?>',{vehicle_id:vehicle_id, variant_id:variant_id, color_id:color_id},function(data){
			$('#result').html(data);
		},'html')
	})

</script>