<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_dealers'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('spareparts_dealers'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_dealerToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_dealerInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_dealerFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_dealer"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_dealer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-spareparts_dealers', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "spareparts_dealers_id"/>
		<table class="form-table">				
			<tr>
				<td><label for='spareparts_dealers_name'><?php echo lang('name')?></label></td>
				<td><input id='spareparts_dealers_name' class='text_input' name='name'></td>				
				<td><label for='incharge_id'><?php echo lang('incharge_id')?></label></td>
				<td><div id='incharge_id' name='incharge_id'></div></td>
			</tr>

			<tr>
				<td><label for='district_id'><?php echo lang('district_id')?></label></td>
				<td><div id='district_id'  name='district_id'></div></td>
				<td><label for='mun_vdc_id'><?php echo lang('mun_vdc_id')?></label></td>
				<td><div id='mun_vdc_id'  name='mun_vdc_id'></div></td>
			</tr>
			<tr>
				<td><label for='city_place_id'><?php echo lang('city_place_id')?></label></td>
				<td><div id='city_place_id' name='city_place_id'></div></td>
				<td><label for='address_1'><?php echo lang('address_1')?></label></td>
				<td><input id='address_1' class='text_input' name='address_1'></td>
			</tr>
			<tr>
				<td><label for='address_2'><?php echo lang('address_2')?></label></td>
				<td><input id='address_2' class='text_input' name='address_2'></td>
				<td><label for='phone_1'><?php echo lang('phone_1')?></label></td>
				<td><input id='phone_1' class='text_input' name='phone_1'></td>
			</tr>
			<tr>
				<td><label for='phone_2'><?php echo lang('phone_2')?></label></td>
				<td><input id='phone_2' class='text_input' name='phone_2'></td>
				<td><label for='email'><?php echo lang('email')?></label></td>
				<td><input id='email' class='text_input' name='email'></td>
			</tr>
			<tr>
				<td><label for='fax'><?php echo lang('fax')?></label></td>
				<td><input id='fax' class='text_input' name='fax'></td>
				<td><label for='latitude'><?php echo lang('latitude')?></label></td>
				<td><input id='latitude' class='text_input' name='latitude'></td>
			</tr>
			<tr>
				<td><label for='longitude'><?php echo lang('longitude')?></label></td>
				<td><input id='longitude' class='text_input' name='longitude'></td>
				<td><label for='remarks'><?php echo lang('remarks')?></label></td>
				<td><input id='remarks' class='text_input' name='remarks'></td>
			</tr>
			<tr>
				<td><label for='credit_policy'><?php echo lang('credit_policy')?></label></td>
				<td><div id='credit_policy' class='number_general' name='credit_policy'></div></td>
				<td><label for='prefix'><?php echo lang('prefix')?></label></td>
				<td><input type="text" id="prefix" class="text_input" name='prefix'></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_dealerSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_dealerCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		var InchargeDataSource  = {
			url : '<?php echo site_url("admin/spareparts_dealers/get_sparepart_dealer_incharges_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'user_id', type: 'number' },
			{ name: 'username', type: 'string' },
			],			
			async: false,
			cache: true
		}

		InchargeDataAdapter = new $.jqx.dataAdapter(InchargeDataSource, {autoBind: false});

		$("#incharge_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: InchargeDataAdapter,
			displayMember: "username",
			valueMember: "user_id",
		});
		
		var districtDataSource = {
			url : '<?php echo site_url("admin/spareparts_dealers/get_districts_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: true,
			cache: true
		}

		districtDataAdapter = new $.jqx.dataAdapter(districtDataSource);

		$("#district_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: districtDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});


		$("#district_id").select('bind', function (event) {
			val = $("#district_id").jqxComboBox('val');
			var munVdcDataSource  = {
				url : '<?php echo site_url("admin/spareparts_dealers/get_mun_vdcs_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				data: {
					parent_id: val
				},
				async: false,
				cache: true
			},

			munVdcDataAdapter = new $.jqx.dataAdapter(munVdcDataSource);

			$("#mun_vdc_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: munVdcDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});
		});

		$("#mun_vdc_id").select('bind', function (event) {
			val = $("#mun_vdc_id").jqxComboBox('val');
			var cityDataSource  = {
				url : '<?php echo site_url("admin/spareparts_dealers/get_cities_combo_json"); ?>',
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'name', type: 'string' },
				],
				data: {
					mun_vdc_id: val
				},
				async: false,
				cache: true
			},

			cityDataAdapter = new $.jqx.dataAdapter(cityDataSource);

			$("#city_place_id").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: cityDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});
		});
		var spareparts_dealersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'incharge_id', type: 'number' },
			{ name: 'district_id', type: 'number' },
			{ name: 'mun_vdc_id', type: 'number' },
			{ name: 'city_place_id', type: 'number' },
			{ name: 'address_1', type: 'string' },
			{ name: 'address_2', type: 'string' },
			{ name: 'phone_1', type: 'string' },
			{ name: 'phone_2', type: 'string' },
			{ name: 'email', type: 'string' },
			{ name: 'fax', type: 'string' },
			{ name: 'latitude', type: 'string' },
			{ name: 'longitude', type: 'string' },
			{ name: 'remarks', type: 'string' },
			{ name: 'credit_policy', type: 'number' },
			{ name: 'incharge_name', type: 'string' },
			{ name: 'district_name', type: 'string' },
			{ name: 'mun_vdc_name', type: 'string' },
			{ name: 'city_name', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'prefix', type: 'string' },
			],
			url: '<?php echo site_url("admin/spareparts_dealers/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_dealersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_dealer").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_dealer").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_dealer").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_dealersDataSource,
		altrows: true,
		pageable: true,
		sortable: true,
		rowsheight: 30,
		columnsheight:30,
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		autoshowfiltericon: true,
		columnsreorder: true,
		selectionmode: 'none',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridSpareparts_dealerToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editSpareparts_dealerRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},

		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("incharge_id"); ?>',datafield: 'incharge_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("district_id"); ?>',datafield: 'district_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("mun_vdc_id"); ?>',datafield: 'mun_vdc_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("city_place_id"); ?>',datafield: 'city_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("address_1"); ?>',datafield: 'address_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("address_2"); ?>',datafield: 'address_2',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("phone_1"); ?>',datafield: 'phone_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("phone_2"); ?>',datafield: 'phone_2',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("email"); ?>',datafield: 'email',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("fax"); ?>',datafield: 'fax',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("credit_policy"); ?>',datafield: 'credit_policy',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("latitude"); ?>',datafield: 'latitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("longitude"); ?>',datafield: 'longitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("prefix"); ?>',datafield: 'prefix',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSpareparts_dealer").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_dealerFilterClear', function () { 
		$('#jqxGridSpareparts_dealer').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_dealerInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_dealer', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSpareparts_dealer").jqxWindow({ 
		theme: theme,
		width: '75%',
		maxWidth: '75%',
		height: '75%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowSpareparts_dealer").on('close', function () {
		reset_form_spareparts_dealers();
	});

	$("#jqxSpareparts_dealerCancelButton").on('click', function () {
		reset_form_spareparts_dealers();
		$('#jqxPopupWindowSpareparts_dealer').jqxWindow('close');
	});


	$("#jqxSpareparts_dealerSubmitButton").on('click', function () {
		saveSpareparts_dealerRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSpareparts_dealerRecord();
                }
            };
        $('#form-spareparts_dealers').jqxValidator('validate', validationResult);
        */
    });
});

function editSpareparts_dealerRecord(index){
	var row =  $("#jqxGridSpareparts_dealer").jqxGrid('getrowdata', index);
	if (row) {
		$('#spareparts_dealers_id').val(row.id);

		$('#spareparts_dealers_name').val(row.name);
		$('#incharge_id').jqxComboBox('val', row.incharge_id);
		$('#district_id').jqxComboBox('val', row.district_id);
		$('#mun_vdc_id').jqxComboBox('val', row.mun_vdc_id);
		$('#city_place_id').jqxComboBox('val', row.city_place_id);
		$('#address_1').val(row.address_1);
		$('#address_2').val(row.address_2);
		$('#phone_1').val(row.phone_1);
		$('#phone_2').val(row.phone_2);
		$('#email').val(row.email);
		$('#fax').val(row.fax);
		$('#latitude').val(row.latitude);
		$('#longitude').val(row.longitude);
		$('#remarks').val(row.remarks);
		$('#credit_policy').jqxNumberInput('val', row.credit_policy);
		$('#prefix').val(row.prefix);
		
		openPopupWindow('jqxPopupWindowSpareparts_dealer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSpareparts_dealerRecord(){
	var data = $("#form-spareparts_dealers").serialize();
	
	$('#jqxPopupWindowSpareparts_dealer').block({ 
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
		url: '<?php echo site_url("admin/spareparts_dealers/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_spareparts_dealers();
				$('#jqxGridSpareparts_dealer').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSpareparts_dealer').jqxWindow('close');
			}
			$('#jqxPopupWindowSpareparts_dealer').unblock();
		}
	});
}

function reset_form_spareparts_dealers(){
	$('#spareparts_dealers_id').val('');
	$('#form-spareparts_dealers')[0].reset();
}
</script>