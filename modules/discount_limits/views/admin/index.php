<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('discount_limits'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('discount_limits'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDiscount_limitToolbar' class='grid-toolbar'>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDiscount_limitInsert"><?php echo lang('general_create'); ?></button>
							<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDiscount_limitFilterClear"><?php echo lang('general_clear'); ?></button>
							<a  href="<?php echo site_url('admin/discount_limits/downloadExcel') ?>" class="btn btn-default btn-flat btn-xs" >Download Excel</a>
						</div>
						<div class="col-md-9">
							<form action="<?php echo base_url('admin/discount_limits/uploadExcel') ?>" method="post" enctype="multipart/form-data">
								<div class="col-md-3"><input type="file" name="userfile" style="float: left;"></div>
								<div class="col-md-2"><button>Read</button></div>
							</form>
							
						</div>
					</div>
					
				</div>
				<div id="jqxGridDiscount_limit"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDiscount_limit">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-discount_limits', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "discount_limits_id"/>
		<table class="form-table">
			<tr>
				<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
				<td><div id='vehicle_id' class='' name='vehicle_id'></div></td>
			</tr>
			<tr>
				<td><label for='variant_id'><?php echo lang('variant_id')?></label></td>
				<td><div id='variant_id' class='' name='variant_id'></div></td>
			</tr>
			<tr>
				<td><label for='staff_limit'><?php echo lang('staff_limit')?></label></td>
				<td><div id='staff_limit' class='number_general' name='staff_limit'></div></td>
			</tr>
			<tr>
				<td><label for='incharge_limit'><?php echo lang('incharge_limit')?></label></td>
				<td><div id='incharge_limit' class='number_general' name='incharge_limit'></div></td>
			</tr>
			<tr>
				<td><label for='sales_head_limit'><?php echo lang('sales_head_limit')?></label></td>
				<td><div id='sales_head_limit' class='number_general' name='sales_head_limit'></div></td>
			</tr>
			<!-- <tr>
				<td><label for='manager_limit'><?php echo lang('manager_limit')?></label></td>
				<td><div id='manager_limit' class='number_general' name='manager_limit'></div></td>
			</tr> -->
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDiscount_limitSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDiscount_limitCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var discount_limitsDataSource =
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
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'staff_limit', type: 'number' },
			{ name: 'incharge_limit', type: 'number' },
			{ name: 'sales_head_limit', type: 'number' },
			// { name: 'manager_limit', type: 'number' },
			
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			],
			url: '<?php echo site_url("admin/discount_limits/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
				// callback called when a page or page size is changed.
			},
			beforeprocessing: function (data) {
				discount_limitsDataSource.totalrecords = data.total;
			},
			// update the grid and send a request to the server.
			filter: function () {
				$("#jqxGridDiscount_limit").jqxGrid('updatebounddata', 'filter');
			},
			// update the grid and send a request to the server.
			sort: function () {
				$("#jqxGridDiscount_limit").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#jqxGridDiscount_limit").jqxGrid({
			theme: theme,
			width: '100%',
			height: gridHeight,
			source: discount_limitsDataSource,
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
				container.append($('#jqxGridDiscount_limitToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDiscount_limitRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("staff_limit"); ?>',datafield: 'staff_limit',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("incharge_limit"); ?>',datafield: 'incharge_limit',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sales_head_limit"); ?>',datafield: 'sales_head_limit',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("manager_limit"); ?>',datafield: 'manager_limit',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridDiscount_limit").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridDiscount_limitFilterClear', function () { 
			$('#jqxGridDiscount_limit').jqxGrid('clearfilters');
		});

		$(document).on('click','#jqxGridDiscount_limitInsert', function () { 
			openPopupWindow('jqxPopupWindowDiscount_limit', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		// initialize the popup window
		$("#jqxPopupWindowDiscount_limit").jqxWindow({ 
			theme: theme,
			width: '50%',
			maxWidth: '75%',
			height: '50%',  
			maxHeight: '75%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});

		$("#jqxPopupWindowDiscount_limit").on('close', function () {
			reset_form_discount_limits();
		});

		$("#jqxDiscount_limitCancelButton").on('click', function () {
			reset_form_discount_limits();
			$('#jqxPopupWindowDiscount_limit').jqxWindow('close');
		});

		$('#form-discount_limits').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#vehicle_id').jqxComboBox('val');
				return (val == '' || val == null || val == 0) ? false: true;
			} },

			{ input: '#variant_id', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#variant_id').jqxComboBox('val');
				return (val == '' || val == null || val == 0) ? false: true;
			} },

			{ input: '#staff_limit', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#staff_limit').jqxNumberInput('val');
				return (val == '' || val == null || val == 0) ? false: true;
			} },

			{ input: '#incharge_limit', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#incharge_limit').jqxNumberInput('val');
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#sales_head_limit', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#sales_head_limit').jqxNumberInput('val');
				return (val == '' || val == null || val == 0) ? false: true;
			} },

			/*{ input: '#manager_limit', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#manager_limit').jqxNumberInput('val');
				return (val == '' || val == null || val == 0) ? false: true;
			} },*/

			]
		});

		$("#jqxDiscount_limitSubmitButton").on('click', function () {
			// saveDiscount_limitRecord();
			var validationResult = function (isValid) {
				if (isValid) {
					saveDiscount_limitRecord();
				}
			};
			$('#form-discount_limits').jqxValidator('validate', validationResult);
			
		});

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

		$("#vehicle_id").bind('select', function (event) {

			if (!event.args)
				return;

			vehicle_id = $("#vehicle_id").jqxComboBox('val');

			var variantDataSource  = {
				url : '<?php echo site_url("admin/discount_limits/get_variants_combo_json"); ?>',
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

	});
	// end fucntion


	function editDiscount_limitRecord(index){
		var row =  $("#jqxGridDiscount_limit").jqxGrid('getrowdata', index);
		if (row) {
			$('#discount_limits_id').val(row.id);
			$('#vehicle_id').jqxComboBox('val', row.vehicle_id);
			$('#variant_id').jqxComboBox('val', row.variant_id);
			$('#staff_limit').jqxNumberInput('val', row.staff_limit);
			$('#incharge_limit').jqxNumberInput('val', row.incharge_limit);
			$('#sales_head_limit').jqxNumberInput('val', row.sales_head_limit);
			// $('#manager_limit').jqxNumberInput('val', row.manager_limit);
			
			openPopupWindow('jqxPopupWindowDiscount_limit', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
		}
	}

	function saveDiscount_limitRecord(){
		var data = $("#form-discount_limits").serialize();
		
		$('#jqxPopupWindowDiscount_limit').block({ 
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
			url: '<?php echo site_url("admin/discount_limits/save"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					reset_form_discount_limits();
					$('#jqxGridDiscount_limit').jqxGrid('updatebounddata');
					$('#jqxPopupWindowDiscount_limit').jqxWindow('close');
				}
				$('#jqxPopupWindowDiscount_limit').unblock();
			}
		});
	}

	function reset_form_discount_limits(){
		$('#discount_limits_id').val('');
		$('#form-discount_limits')[0].reset();
	}
</script>