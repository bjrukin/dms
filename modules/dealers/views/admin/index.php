<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealers'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('dealers'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDealerToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealerInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDealerFilterClear"><?php echo lang('general_clear'); ?></button>
					<a href="<?php echo site_url('admin/dealers/excel_export') ?>"><button  type="button" class="btn btn-warning btn-flat btn-xs"><?php echo "Export Excel" ?></button></a>
				</div>
				<div id="jqxGridDealer"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDealer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"><?php echo lang("general_edit")  . "&nbsp;" .  $header; ?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-dealers', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "dealers_id"/>
		<fieldset>
			<legend>Basic Information</legend>
			<table class="form-table">
				<tr>
					<td><label for='dealers_name'><?php echo lang('name')?><span class="mandatory">*</span></label></td>
					<td><input id='dealers_name' class='text_input' name='name'></td>
					<td><label for='incharge_id'><?php echo lang('incharge_id')?></label></td>
					<td><div id='incharge_id' name='incharge_id'></div></td>
				</tr>
				<tr>
					<td><label for="sparepart_incharge"><?php echo lang('sparepart_incharge') ?></label></td>
					<td><div id="sparepart_incharge" name="sparepart_incharge" ></div></td>
					<td><label for="service_incharge"><?php echo lang('service_incharge') ?></label></td>
					<td><div id="service_incharge" name="service_incharge" ></div></td>
				</tr>
				<tr>
					<td><label for='district_id'><?php echo lang('district_id')?><span class="mandatory">*</span></label></td>
					<td><div id='district_id' name='district_id'></div></td>
					<td><label for='mun_vdc_id'><?php echo lang('mun_vdc_id')?><span class="mandatory">*</span></label></td>
					<td><div id='mun_vdc_id' name='mun_vdc_id'></div></td>
				</tr>
				<tr>
					<td><label for='city_place_id'><?php echo lang('city_place_id')?><span class="mandatory">*</span></label></td>
					<td><div id='city_place_id' name='city_place_id'></div></td>
					<td colspan= "2">&nbsp;</td>
				</tr>
				<tr>
					<td><label for='address_1'><?php echo lang('address_1')?><span class="mandatory">*</span></label></td>
					<td><input id='address_1' class='text_input' name='address_1'></td>
					<td><label for='address_2'><?php echo lang('address_2')?></label></td>
					<td><input id='address_2' class='text_input' name='address_2'></td>
				</tr>
				<tr>
					<td><label for='phone_1'><?php echo lang('phone_1')?><span class="mandatory">*</span></label></td>
					<td><input id='phone_1' class='text_input' name='phone_1' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
					<td><label for='phone_2'><?php echo lang('phone_2')?></label></td>
					<td><input id='phone_2' class='text_input' name='phone_2' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
				</tr>
				<tr>
					<td><label for='email'><?php echo lang('email')?></label></td>
					<td><input id='email' class='text_input' name='email'></td>
					<td><label for='fax'><?php echo lang('fax')?></label></td>
					<td><input id='fax' class='text_input' name='fax' placeholder='<?php echo lang("general_phone_number_format");?>'></td>
				</tr>
				<tr>
					<td><label for='rank'><?php echo lang('rank')?></label></td>
					<td><input id='rank' class='text_input' name='rank' placeholder='Rank'></td>
					<td><label for='remarks'><?php echo lang('remarks')?></label></td>
					<td><textarea id='remarks' class='text_area' name='remarks'></textarea></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Google Map</legend>
			<table class="form-table">
				<tr>
					<td><label for='latitude'><?php echo lang('latitude')?></label></td>
					<td><div id='latitude' name='latitude' ></div></td>
					<td><label for='longitude'><?php echo lang('longitude')?></label></td>
					<td><div id='longitude' name='longitude'></div></td>
				</tr>
				<tr>
					<td colspan="4">
						<?php if(internet_connection()): ?>
							<input id="pac-input" class="controls" type="text" placeholder="Search Box" >
							<div id="mapCanvas" style="width: 100%; height: 350px; margin-top: 10px;"></div>
						<?php else: ?>
							<div class="alert alert-warning" style="margin-top: 10px;"><strong>Note:</strong>Could Not Load Google Maps. Internet Connection Not Available</div>
						<?php endif;?>
					</td>
				</tr>

			</table>
		</fieldset>
		<table class="form-table">
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealerSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDealerCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<div id="jqxPopupWindowImport_Target">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<form action="<?php echo site_url('target_records/import_target')?>" method="POST" enctype="multipart/form-data">
			<input type = "hidden" name = "dealers_import_id" id = "dealers_import_id"/>
			<div class="row">
				<div class="col-md-3">
					<label for="input_year"><?php echo lang('enter_year')?></label>
				</div>
				<div class="col-md-9">
					<input type="text" name="year" class="text_input">
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6">
					<input type="file" name="userfile">
				</div>
				<div class="col-md-6">
					<button type="submit">Read</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script language="javascript" type="text/javascript">

	$(function(){
		$("#jqxPopupWindowImport_Target").jqxWindow({ 
			theme: theme,
			width: 500,
			maxWidth: 500,
			height: 300,  
			maxHeight: 300,  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});
		//$("#dealers_name").jqxInput({ width: 350});
		$("#latitude, #longitude").jqxNumberInput({ width: 195,height: 25, inputMode: 'simple', spinButtons: false, digits:5, decimalDigits: 10, theme: theme });

		var inchargeDataSource = {
			url : '<?php echo site_url("admin/dealers/get_dealer_incharges_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'user_id', type: 'number' },
			{ name: 'username', type: 'string' },
			],
			async: true,
			cache: true
		}

		inchargeDataAdapter = new $.jqx.dataAdapter(inchargeDataSource);

		$("#incharge_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: inchargeDataAdapter,
			displayMember: "username",
			valueMember: "user_id",
		});

		var sparepartinchargeDataSource = {
			url : '<?php echo site_url("admin/dealers/get_sparepart_dealer_incharges_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'user_id', type: 'number' },
			{ name: 'username', type: 'string' },
			],
			async: true,
			cache: true
		}

		sparepartinchargeDataAdapter = new $.jqx.dataAdapter(sparepartinchargeDataSource);

		$("#sparepart_incharge").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: sparepartinchargeDataAdapter,
			displayMember: "username",
			valueMember: "user_id",
		});

		var serviceInchargeDataSource = {
			url : '<?php echo site_url("admin/dealers/get_service_incharges_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'user_id', type: 'number' },
			{ name: 'username', type: 'string' },
			],
			async: true,
			cache: true
		}

		serviceInchargeDataAdapter = new $.jqx.dataAdapter(serviceInchargeDataSource);

		$("#service_incharge").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: serviceInchargeDataAdapter,
			displayMember: "username",
			valueMember: "user_id",
		});

		//districts
		var districtDataSource = {
			url : '<?php echo site_url("admin/dealers/get_districts_combo_json"); ?>',
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
				url : '<?php echo site_url("admin/dealers/get_mun_vdcs_combo_json"); ?>',
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
				url : '<?php echo site_url("admin/dealers/get_cities_combo_json"); ?>',
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

		var dealersDataSource =
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
			{ name: 'district_name', type: 'string' },
			{ name: 'mun_vdc_name', type: 'string' },
			{ name: 'city_name', type: 'string' },
			{ name: 'incharge_name', type: 'string' },
			{ name: 'rank', type: 'number' },
			{ name: 'spares_incharge_id', type: 'string' },
			{ name: 'service_incharge_id', type: 'string' },
			{ name: 'spares_incharge', type: 'string' },
			{ name: 'service_incharge', type: 'string' },

			],
			url: '<?php echo site_url("admin/dealers/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
	        	//callback called when a page or page size is changed.
	        },
	        beforeprocessing: function (data) {
	        	dealersDataSource.totalrecords = data.total;
	        },
		    // update the grid and send a request to the server.
		    filter: function () {
		    	$("#jqxGridDealer").jqxGrid('updatebounddata', 'filter');
		    },
		    // update the grid and send a request to the server.
		    sort: function () {
		    	$("#jqxGridDealer").jqxGrid('updatebounddata', 'sort');
		    },
		    processdata: function(data) {
		    }
		};
		
		$("#jqxGridDealer").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: dealersDataSource,
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
				container.append($('#jqxGridDealerToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDealerRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp';
					e += '<a href="javascript:void(0)" onclick="import_target(' + index + '); return false;" title="Import"><i class="fa fa-file"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("incharge_id"); ?>',datafield: 'incharge_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sparepart_incharge"); ?>',datafield: 'spares_incharge',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("service_incharge"); ?>',datafield: 'service_incharge',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("district_id"); ?>',datafield: 'district_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mun_vdc_id"); ?>',datafield: 'mun_vdc_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("city_place_id"); ?>',datafield: 'city_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address_1"); ?>',datafield: 'address_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address_2"); ?>',datafield: 'address_2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("phone_1"); ?>',datafield: 'phone_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("phone_2"); ?>',datafield: 'phone_2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("email"); ?>',datafield: 'email',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("fax"); ?>',datafield: 'fax',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
				/*{ text: '<?php echo lang("latitude"); ?>',datafield: 'latitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("longitude"); ?>',datafield: 'longitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },*/
				
				],
				rendergridrows: function (result) {
					return result.data;
				}
			});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridDealer").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridDealerFilterClear', function () { 
			$('#jqxGridDealer').jqxGrid('clearfilters');
		});

		$(document).on('click','#jqxGridDealerInsert', function () { 
			<?php if(internet_connection()):?>
			googlemaps(0,0);
			<?php endif; ?>
			openPopupWindow('jqxPopupWindowDealer', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		// initialize the popup window
		$("#jqxPopupWindowDealer").jqxWindow({ 
			theme: theme,
			width: 980,
			maxWidth: 980,
			height: 600,  
			maxHeight: 600,  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		$("#jqxPopupWindowDealer").on('close', function () {
			reset_form_dealers();
		});

		$("#jqxDealerCancelButton").on('click', function () {
			reset_form_dealers();
			$('#jqxPopupWindowDealer').jqxWindow('close');
		});

		$('#form-dealers').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ 
				input: '#dealers_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealers_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ 
				input: '#district_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#district_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ 
				input: '#mun_vdc_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#mun_vdc_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			/*{ 
				input: '#city_place_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#city_place_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
*/
			{ 
				input: '#address_1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#address_1').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ 
				input: '#phone_1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#phone_1').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ 
				input: '#phone_1', message: 'Invalid Format.', action: 'blur', 
				rule: function(input) {
					val = $('#phone_1').val();
					return (val.match(phone_pattern)) ? true : false;
				}
			},

			{ 
				input: '#phone_2', message: 'Invalid Format.', action: 'blur', 
				rule: function(input) {
					val = $('#phone_2').val();
					return (val.match(phone_pattern)) ? true : false;
				}
			},

			{ 
				input: '#fax', message: 'Invalid Format.', action: 'blur', 
				rule: function(input) {
					val = $('#fax').val();
					return (val.match(phone_pattern)) ? true : false;
				}
			},

			{ input: '#email', message: 'Invalid Email Address', action: 'blur', rule: 'email'},
			]
		});

		$("#jqxDealerSubmitButton").on('click', function () {
			var validationResult = function (isValid) {
				if (isValid) {
					saveDealerRecord();
				}
			};
			$('#form-dealers').jqxValidator('validate', validationResult);

		});
	});

function editDealerRecord(index){
	var row =  $("#jqxGridDealer").jqxGrid('getrowdata', index);
	if (row) {
		$('#dealers_id').val(row.id);
		$('#dealers_name').val(row.name);
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
		$('#latitude').jqxNumberInput('val', row.latitude);
		$('#longitude').jqxNumberInput('val', row.longitude);
		$('#remarks').val(row.remarks);
		$('#rank').val(row.rank);
		$('#sparepart_incharge').val(row.spares_incharge_id);
		$('#service_incharge').val(row.service_incharge_id);
		<?php if(internet_connection()):?>
		googlemaps(row.latitude, row.longitude);
		<?php endif; ?>
		openPopupWindow('jqxPopupWindowDealer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveDealerRecord(){
	var data = $("#form-dealers").serialize();

	$('#jqxPopupWindowDealer').block({ 
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
		url: '<?php echo site_url("admin/dealers/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_dealers();
				$('#jqxGridDealer').jqxGrid('updatebounddata');
				$('#jqxPopupWindowDealer').jqxWindow('close');
			}
			$('#jqxPopupWindowDealer').unblock();
		}
	});
}

function reset_form_dealers(){
	$('#dealers_id').val('');
	$('#form-dealers')[0].reset();

	$('#incharge_id').jqxComboBox('clearSelection');
	$('#district_id').jqxComboBox('clearSelection');
	$('#mun_vdc_id').jqxComboBox('clearSelection');
	$('#city_place_id').jqxComboBox('clearSelection');

	$('#incharge_id').jqxComboBox('selectIndex', '-1');
	$('#district_id').jqxComboBox('selectIndex', '-1');
	$('#mun_vdc_id').jqxComboBox('selectIndex', '-1');
	$('#city_place_id').jqxComboBox('selectIndex', '-1');
}

function import_target(index)
{
	var row =  $("#jqxGridDealer").jqxGrid('getrowdata', index);
	if(row)
	{
		$('#dealers_import_id').val(row.id);
	}
	openPopupWindow('jqxPopupWindowImport_Target', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');


}
</script>