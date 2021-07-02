<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ser_workshop_users'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('ser_workshop_users'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSer_workshop_userToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSer_workshop_userInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSer_workshop_userFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSer_workshop_user"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSer_workshop_user">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-ser_workshop_users', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "ser_workshop_users_id"/>
		<fieldset>
			<legend>Basic Information</legend>
			<table class="form-table">
				<tr>
					<?php if(is_admin()): ?>
						<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
						<td><div id='dealer_id' name='dealer_id'></div></td>
					<?php else:?>
						<input type="hidden" name="dealer_id" id="dealer_id" value="<?php echo $this->session->userdata('employee')['dealer_id']?>">
					<?php endif; ?>
					<td><label for='designation_id'><?php echo lang('designation_id')?></label></td>
					<td><div id='designation_id' name='designation_id'></div></td>
					<td id="parent_id_label" hidden><label for='designation_parent'><?php echo lang('designation_parent')?></label></td>
					<td id="parent_id" hidden><div id='designation_parent' name='designation_parent'></div></td>
				</tr>
				<tr>
					<td><label for='first_name'><?php echo lang('first_name')?></label></td>
					<td><input id='first_name' class='text_input' name='first_name'></td>
					<td><label for='middle_name'><?php echo lang('middle_name')?></label></td>
					<td><input id='middle_name' class='text_input' name='middle_name'></td>
					<td><label for='last_name'><?php echo lang('last_name')?></label></td>
					<td><input id='last_name' class='text_input' name='last_name'></td>
				</tr>
				<tr>
					<td><label for='phone_no'><?php echo lang('phone_no')?></label></td>
					<td><input id='phone_no' class='text_input' name='phone_no'></td>
					<td><label for='Address'><?php echo lang('Address')?></label></td>
					<td><input id='Address' class='text_input' name='Address'></td>
				</tr>

			</table>
		</fieldset>
		<table class="form-table">
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSer_workshop_userSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSer_workshop_userCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		<?php if(is_admin()): ?>
		var sparepart_dealerDataSource = {
			url : '<?php echo site_url("admin/ser_workshop_users/get_spareparts_dealers_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		spareparts_dealerDataAdapter = new $.jqx.dataAdapter(sparepart_dealerDataSource);

		$("#dealer_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: spareparts_dealerDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});
	<?php endif; ?>

		masterDataSource.data = {table_name: 'mst_designations'};

		designationDataAdapter = new $.jqx.dataAdapter(masterDataSource);

		$("#designation_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: designationDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		$("#designation_parent").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			displayMember: "first_name",
			valueMember: "id",
		});

		var ser_workshop_usersDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'first_name', type: 'string' },
			{ name: 'middle_name', type: 'string' },
			{ name: 'last_name', type: 'string' },
			{ name: 'phone_no', type: 'string' },
			{ name: 'Address', type: 'string' },
			{ name: 'designation_id', type: 'number' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'designation_name', type: 'string' },

			],
			url: '<?php echo site_url("admin/ser_workshop_users/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ser_workshop_usersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSer_workshop_user").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSer_workshop_user").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSer_workshop_user").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ser_workshop_usersDataSource,
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
			container.append($('#jqxGridSer_workshop_userToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editSer_workshop_userRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("first_name"); ?>',datafield: 'first_name',width: 130,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("middle_name"); ?>',datafield: 'middle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("last_name"); ?>',datafield: 'last_name',width: 130,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("phone_no"); ?>',datafield: 'phone_no',width: 130,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("Address"); ?>',datafield: 'Address',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("designation_id"); ?>',datafield: 'designation_name',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSer_workshop_user").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSer_workshop_userFilterClear', function () { 
		$('#jqxGridSer_workshop_user').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSer_workshop_userInsert', function () { 
		openPopupWindow('jqxPopupWindowSer_workshop_user', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowSer_workshop_user").jqxWindow({ 
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

	$("#jqxPopupWindowSer_workshop_user").on('close', function () {
		reset_form_ser_workshop_users();
	});

	$("#jqxSer_workshop_userCancelButton").on('click', function () {
		reset_form_ser_workshop_users();
		$('#jqxPopupWindowSer_workshop_user').jqxWindow('close');
	});

	$('#form-ser_workshop_users').jqxValidator({
		hintType: 'label',
		animationDuration: 500,
		rules: [
		// { 
		// 	input: '#dealer_id', message: 'Required', action: 'blur', 
		// 	rule: function(input) {
		// 		val = $('#dealer_id').jqxComboBox('val');
		// 		return (val == '' || val == null || val == 0) ? false: true;
		// 	}
		// },

		{ 
			input: '#first_name', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#first_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},


		{ 
			input: '#last_name', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#last_name').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		{ 
			input: '#phone_no', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#phone_no').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		{ 
			input: '#Address', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#Address').val();
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		{ 
			input: '#designation_id', message: 'Required', action: 'blur', 
			rule: function(
				input) {
				val = $('#designation_id').jqxComboBox('val');
				return (val == '' || val == null || val == 0) ? false: true;
			}
		},

		]
	});

	$("#jqxSer_workshop_userSubmitButton").on('click', function () {
    	// saveSer_workshop_userRecord();

    	var validationResult = function (isValid) {
    		if (isValid) {
    			saveSer_workshop_userRecord();
    		}
    	};
    	$('#form-ser_workshop_users').jqxValidator('validate', validationResult);

    });


	$('#dealer_id').on('select', function(e){
		$('#designation_id').val(0);
	});

	$('#designation_id').on('select', function(e){
		var technician = <?php echo MECHANICS; ?>;
		var args = e.args.item.value;
		if(args == technician) {
			var dealer_id = $('#dealer_id').val();
			if(!dealer_id) {
				return;
			}
			var techHeadDataSource = {
				url : '<?php echo site_url("admin/ser_workshop_users/get_mechanic_heads"); ?>',
				data: {dealer_id: dealer_id },
				datatype: 'json',
				datafields: [
				{ name: 'id', type: 'number' },
				{ name: 'first_name', type: 'string' },
				{ name: 'last_name', type: 'string' },
				],
				async: false,
				cache: true
			};

			var techHeadAdapter = new $.jqx.dataAdapter(techHeadDataSource);

			$('#parent_id, #parent_id_label').show();
			$('#designation_parent').jqxComboBox({source: techHeadAdapter});
		} else {
			$('#parent_id, #parent_id_label').hide();
			$('#designation_parent').val('');
		}

	});


});

function editSer_workshop_userRecord(index){
	var row =  $("#jqxGridSer_workshop_user").jqxGrid('getrowdata', index);
	if (row) {
		$('#ser_workshop_users_id').val(row.id);
		<?php if(is_admin()){?>
			$('#dealer_id').jqxComboBox('val', row.dealer_id);
		<?php } ?>
		// if(row.dealer_id){

		// 	
		// }
		$('#first_name').val(row.first_name);
		$('#middle_name').val(row.middle_name);
		$('#last_name').val(row.last_name);
		$('#phone_no').val(row.phone_no);
		$('#Address').val(row.Address);
		$('#designation_id').jqxComboBox('val', row.designation_id);
		
		openPopupWindow('jqxPopupWindowSer_workshop_user', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveSer_workshop_userRecord(){
	var data = $("#form-ser_workshop_users").serialize();
	
	$('#jqxPopupWindowSer_workshop_user').block({ 
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
		url: '<?php echo site_url("admin/ser_workshop_users/save"); ?>',
		data: data,
		success: function (result) {
			console.log(result);
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_ser_workshop_users();
				$('#jqxGridSer_workshop_user').jqxGrid('updatebounddata');
				$('#jqxPopupWindowSer_workshop_user').jqxWindow('close');
			}
			$('#jqxPopupWindowSer_workshop_user').unblock();
		}
	});
}

function reset_form_ser_workshop_users(){
	$('#ser_workshop_users_id').val('');
	$('#form-ser_workshop_users')[0].reset();
	// $('#dealer_id').jqxComboBox('clearSelection');
	$('#designation_id').jqxComboBox('clearSelection');
}
</script>