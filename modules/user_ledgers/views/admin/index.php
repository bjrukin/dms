<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('user_ledgers'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('user_ledgers'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridUser_ledgerToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridUser_ledgerInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridUser_ledgerFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridUser_ledger"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowUser_ledger">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-user_ledgers', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "user_ledgers_id"/>
		<fieldset>
			<legend><?php echo lang('add_details'); ?></legend>
			<div class="row">
				<div class="col-md-6">
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('title'); ?>*</div>
						<div class="col-md-3"><div name="title" id="title" class="form-control"></div></div>
						<div class="col-md-2"><?php echo lang('short_name'); ?></div>
						<div class="col-md-5"><input type="text" name="short_name" id="short_name" class="form-control" maxlength="12" ></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('full_name'); ?>*</div>
						<div class="col-md-10"><input type="text" name="full_name" id="full_name" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('address1'); ?>*</div>
						<div class="col-md-10"><input type="text" name="address1" id="address1" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php //echo lang("address2") ?></div>
						<div class="col-md-10"><input type="text" name="address2" id="address2" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php //echo lang("address3") ?></div>
						<div class="col-md-10"><input type="text" name="address3" id='address3' class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('district_id'); ?>*</div>
						<div class="col-md-4"><div name="district_id" id="district_id" class="form-control"></div></div>

						<div class="col-md-2"><?php echo lang("city") ?>*</div>
						<div class="col-md-4"><div name="city" id="city" class="form-control"></div></div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- <div class="row form-group">
						<div class="col-md-2"><?php echo lang('zone'); ?></div>
						<div class="col-md-10"><input type="text" name="zone" class="form-control"></div>
					</div> -->
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('area'); ?></div>
						<div class="col-md-4"><div name="area" id="area" class="form-control"></div></div>

						<div class="col-md-2"><?php echo 'Pan No'; ?></div>
						<div class="col-md-4"><input type="text" name="pan_no" id='pan_no' class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('pin_code'); ?> </div>
						<div class="col-md-4"><input type="text" name="pin_code" id='pin_code' class="form-control"></div>
						<div class="col-md-2"><?php echo lang('std_code'); ?> </div>
						<div class="col-md-4"><input type="text" name="std_code" id="std_code" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('mobile'); ?>*</div>
						<div class="col-md-10"><input type="text" name="mobile" id="mobile" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('phone_no'); ?></div>
						<div class="col-md-10"><input type="text" name="phone_no" id="phone_no" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('email'); ?></div>
						<div class="col-md-10"><input type="text" name="email" id="email" class="form-control"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-2"><?php echo lang('dob'); ?></div>
						<div class="col-md-10"><div name="dob" class="form-control" id="dob"></div></div>
					</div>
				</div>
			</div>
		</fieldset>

		<div class="btn-group pull-right">
			<button type="button" class="btn btn-success btn-sm btn-flat" id="jqxUser_ledgerSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-default btn-sm btn-flat" id="jqxUser_ledgerCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		var user_ledgersDataSource =
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
			{ name: 'title', type: 'string' },
			{ name: 'short_name', type: 'string' },
			{ name: 'full_name', type: 'string' },
			{ name: 'address1', type: 'string' },
			{ name: 'address2', type: 'string' },
			{ name: 'address3', type: 'string' },
			{ name: 'city', type: 'string' },
			{ name: 'area', type: 'string' },
			{ name: 'district_id', type: 'number' },
			{ name: 'district_name', type: 'string' },
			{ name: 'zone_id', type: 'number' },
			{ name: 'pin_code', type: 'number' },
			{ name: 'std_code', type: 'string' },
			{ name: 'mobile', type: 'number' },
			{ name: 'phone_no', type: 'number' },
			{ name: 'email', type: 'string' },
			{ name: 'dob', type: 'string' },
			{ name: 'pan_no', type: 'string' },

			],
			url: '<?php echo site_url("admin/user_ledgers/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				user_ledgersDataSource.totalrecords = data.total;
			},
			filter: function () {
				$("#jqxGridUser_ledger").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#jqxGridUser_ledger").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGridUser_ledger").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: user_ledgersDataSource,
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
				container.append($('#jqxGridUser_ledgerToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editUser_ledgerRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("title"); ?>',datafield: 'title',width: 50,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("short_name"); ?>',datafield: 'short_name',width: 75,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("full_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dob"); ?>',datafield: 'dob',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address1"); ?>',datafield: 'address1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("address2"); ?>',datafield: 'address2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("address3"); ?>',datafield: 'address3',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("city"); ?>',datafield: 'city',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("area"); ?>',datafield: 'area',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("district_name"); ?>',datafield: 'district_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("zone_id"); ?>',datafield: 'zone_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("pin_code"); ?>',datafield: 'pin_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("std_code"); ?>',datafield: 'std_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mobile"); ?>',datafield: 'mobile',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("phone_no"); ?>',datafield: 'phone_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("email"); ?>',datafield: 'email',width: 150,filterable: true,renderer: gridColumnsRenderer },

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridUser_ledger").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridUser_ledgerFilterClear', function () { 
			$('#jqxGridUser_ledger').jqxGrid('clearfilters');
		});

		$(document).on('click','#jqxGridUser_ledgerInsert', function () { 
			openPopupWindow('jqxPopupWindowUser_ledger', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		// initialize the popup window
		$("#jqxPopupWindowUser_ledger").jqxWindow({ 
			theme: theme,
			width: '75%',
			maxWidth: '75%',
			height: '75%',  
			maxHeight: '75%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.5,
			showCollapseButton: false 
		});

		$("#jqxPopupWindowUser_ledger").on('close', function () {
			reset_form_user_ledgers();
		});

		$("#jqxUser_ledgerCancelButton").on('click', function () {
			reset_form_user_ledgers();
			$('#jqxPopupWindowUser_ledger').jqxWindow('close');
		});

		$('#form-user_ledgers').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ input: '#title', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#title').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#full_name', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#full_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#address1', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#address1').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#city', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#city').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#district_id', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#district_id').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			/*{ input: '#mobile', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#mobile').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },*/
			/*{ input: '#email', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#email').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },*/
			]
		});

		//asdf
		$("#jqxUser_ledgerSubmitButton").on('click', function () {
			var validationResult = function (isValid) {
				if (isValid) {
					saveUser_ledgerRecord();
				}
			};
			$('#form-user_ledgers').jqxValidator('validate', validationResult);

		});

		var titleSource = ["Mr. ", "Mrs. ", "M.", "M/s", "Co."];
		$("#title").jqxComboBox({ 
			theme: theme,
			width: '95%', 
			source: titleSource, 
			selectionMode: 'dropDownList',
			autoDropDownHeight: true,
			placeHolder: "Title",
		});

		$("#district_id").jqxComboBox({
			theme: theme,
			width: '95%',
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: array_districts,
			displayMember: "name",
			valueMember: "id",
		});

		$("#city").jqxComboBox({
			theme: theme,
			width: '87%',
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			displayMember: "name",
			valueMember: "id",
			autoDropDownHeight: true,
		});

		$("#area").jqxComboBox({
			theme: theme,
			width: '95%',
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			displayMember: "name",
			valueMember: "id",
			autoDropDownHeight: true,
		});

		$('#dob').jqxDateTimeInput({ width: '20%', height: '18px', formatString: "yyyy-MM-dd", value: "2000-01-01" });

		$("#district_id").select('bind', function (event) {
			if (!event.args)
				return;

			var val = $("#district_id").jqxComboBox('val');

			var munVdcDataSource  = {
				url : '<?php echo site_url("admin/job_cards/get_mun_vdcs_combo_json"); ?>',
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

			$("#city").jqxComboBox({ source: munVdcDataAdapter, });
		});

		$("#city").select('bind', function (event) {

			if (!event.args)
			return;

			val = $("#city").jqxComboBox('val');

			var areaDataSource  = {
				url : '<?php echo site_url("admin/job_cards/get_cities_combo_json"); ?>',
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

			areaDataAdapter = new $.jqx.dataAdapter(areaDataSource);

			$("#area").jqxComboBox({ source: areaDataAdapter });
		});



	});

	//f
	function editUser_ledgerRecord(index){
		var row =  $("#jqxGridUser_ledger").jqxGrid('getrowdata', index);
		if (row) {
			$('#user_ledgers_id').val(row.id);
			$('#title').val(row.title);
			$('#short_name').val(row.short_name);
			$('#full_name').val(row.full_name);
			$('#address1').val(row.address1);
			$('#address2').val(row.address2);
			$('#address3').val(row.address3);
			$('#city').val(row.city);
			$('#area').val(row.area);
			$('#district_id').val(row.district_id);
			$('#zone_id').val(row.zone_id);
			$('#pin_code').val(row.pin_code);
			$('#std_code').val(row.std_code);
			$('#mobile').val(row.mobile);
			$('#phone_no').val(row.phone_no);
			$('#email').val(row.email);
			$('#pan_no').val(row.pan_no);

			openPopupWindow('jqxPopupWindowUser_ledger', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
		}
	}

	function saveUser_ledgerRecord(){
		var data = $("#form-user_ledgers").serialize();

		$('#jqxPopupWindowUser_ledger').block({ 
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
			url: '<?php echo site_url("admin/user_ledgers/save"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					reset_form_user_ledgers();
					$('#jqxGridUser_ledger').jqxGrid('updatebounddata');
					$('#jqxPopupWindowUser_ledger').jqxWindow('close');
				}
				$('#jqxPopupWindowUser_ledger').unblock();
			}
		});
	}

	function reset_form_user_ledgers(){
		$('#user_ledgers_id').val('');
		$('#form-user_ledgers')[0].reset();
	}
</script>