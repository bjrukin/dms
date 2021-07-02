<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('target_records'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('target_records'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">

					<div class="box-body">
						<form id="form-select_target">
							<div class="row form-group">
								<div class="col-md-2"> Dealer </div>
								<div class="col-md-6"> <div name="dealer_id" class="form-control"></div> </div>
							</div>
							<div class="row form-group">
								<div class="col-md-2"> Target Year </div>
								<div class="col-md-4"> <div name="target_year" class="form-control"></div> </div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default btn-flat pull-right" id="select_target-submit">GO</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<input type="button" class="btn btn-primary btn-flat" value="Editable Off" id="jqxButton-toggle_edit">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridTarget_recordToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridTarget_recordInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridTarget_recordFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridTarget_record"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->


	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowTarget_record">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-target_records', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "target_records_id"/>
		<div id='vehicle_classification' class='number_general' name='vehicle_classification' hidden></div>
		<div id='dealer_id' class='number_general' name='dealer_id' hidden></div>
		<input id='target_year' class='text_input' name='target_year' hidden>
		<!-- <td><div id='revision' class='number_general' name='revision' hidden></div></td> -->
		<table class="form-table">
			<tr>
				<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
				<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
			</tr>
			<tr>
				<td><label for='month'><?php echo lang('month')?></label></td>
				<td><div id='month' class='number_general' name='month' ></div></td>
			</tr>
			<tr>
				<td><label for='quantity'><?php echo lang('quantity')?></label></td>
				<td><div id='quantity' class='number_general' name='quantity'></div></td>
			</tr>
			
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxTarget_recordSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxTarget_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var target_recordsDataSource =
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
			{ name: 'vehicle_classification', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'target_year', type: 'string' },
			{ name: 'month', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'revision', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			
			],
			// url: '<?php echo site_url("admin/target_records/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	target_recordsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridTarget_record").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridTarget_record").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridTarget_record").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: target_recordsDataSource,
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
			container.append($('#jqxGridTarget_recordToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editTarget_recordRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("vehicle_classification"); ?>',datafield: 'vehicle_classification',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("target_year"); ?>',datafield: 'target_year',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("month"); ?>',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
		// { text: '<?php echo lang("revision"); ?>',datafield: 'revision',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridTarget_record").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridTarget_recordFilterClear', function () { 
		$('#jqxGridTarget_record').jqxGrid('clearfilters');
		$('#jqxGridTarget_record').jqxGrid('updatebounddata');
	});

	$(document).on('click','#jqxGridTarget_recordInsert', function () { 
		// openPopupWindow('jqxPopupWindowTarget_record', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowTarget_record").jqxWindow({ 
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

	$("#jqxPopupWindowTarget_record").on('close', function () {
		reset_form_target_records();
	});

	$("#jqxTarget_recordCancelButton").on('click', function () {
		reset_form_target_records();
		$('#jqxPopupWindowTarget_record').jqxWindow('close');
	});

    /*$('#form-target_records').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_classification', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_classification').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#target_year', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#target_year').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#month', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#month').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#revision', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#revision').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxTarget_recordSubmitButton").on('click', function () {
    	saveTarget_recordRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveTarget_recordRecord();
                }
            };
        $('#form-target_records').jqxValidator('validate', validationResult);
        */
    });

    
});

function editTarget_recordRecord(index){
	var toggled = $("#jqxButton-toggle_edit").jqxToggleButton('toggled');
	if(toggled == false)
	{
		return;
	}

	var row =  $("#jqxGridTarget_record").jqxGrid('getrowdata', index);
	if (row) {
		$('#target_records_id').val(row.id);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#vehicle_classification').jqxNumberInput('val', row.vehicle_classification);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#target_year').val(row.target_year);
		$('#month').jqxNumberInput('val', row.month);
		$('#quantity').jqxNumberInput('val', row.quantity);
		// $('#revision').jqxNumberInput('val', row.revision);
		
		openPopupWindow('jqxPopupWindowTarget_record', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveTarget_recordRecord(){
	var data = $("#form-target_records").serialize();
	
	$('#jqxPopupWindowTarget_record').block({ 
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
		url: '<?php echo site_url("admin/target_records/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_target_records();
				// $('#jqxGridTarget_record').jqxGrid('updatebounddata');
				$('#jqxPopupWindowTarget_record').jqxWindow('close');
			}
			$('#jqxPopupWindowTarget_record').unblock();
		}
	});
}

function reset_form_target_records(){
	$('#target_records_id').val('');
	$('#form-target_records')[0].reset();
}
</script>

<script type="text/javascript">
	$(function(){

		$("#jqxButton-toggle_edit").jqxToggleButton({ 
			// width: '200', 
			theme: 'metrodark',
			// template: 'primary',
		});

		var dealerDataSource = {
			url : '<?php echo site_url("admin/target_records/get_dealers_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		};

		dealerAdapter = new $.jqx.dataAdapter(dealerDataSource);

		$("#form-select_target div[name='dealer_id']").jqxComboBox({
			theme: theme,
			// width: 195,
			// height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: dealerAdapter,
			displayMember: "name",
			valueMember: "id",
		});

		var targetYearDataSource = {
			url : '<?php echo site_url("admin/target_records/get_target_year_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'target_year', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		};

		targetYearAdapter = new $.jqx.dataAdapter(targetYearDataSource);

		$("#form-select_target div[name='target_year']").jqxComboBox({
			theme: theme,
			// width: 195,
			// height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: targetYearAdapter,
			displayMember: "target_year",
			valueMember: "target_year",
		});



		$("#jqxButton-toggle_edit").on('click',function(){
			var toggled = $("#jqxButton-toggle_edit").jqxToggleButton('toggled');

			$.post('<?php echo site_url("admin/target_records/editable_toggle"); ?>',{toggled:toggled},function(){});
			if (toggled) {
				$("#jqxButton-toggle_edit")[0].value = 'Editable On';
			}
			else{
				$("#jqxButton-toggle_edit")[0].value = 'Editable Off';
			} 
		});

		$('#select_target-submit').on('click',function(){
			$('#jqxGridTarget_record').jqxGrid('clear');

			$.post('<?php echo site_url("admin/target_records/json"); ?>',$('#form-select_target').serialize(),function(result){
				$.each(result.rows, function(i,v){
					// console.log(v);
					var datarow = {
						id			: v.id,
						created_at	: v.created_at,
						created_by	: v.created_by,
						dealer_id	: v.dealer_id,
						deleted_at	: v.deleted_at,
						deleted_by	: v.deleted_by,
						month		: v.month,
						quantity	: v.quantity,
						revision	: v.revision,
						target_year	: v.target_year,
						updated_at	: v.updated_at,
						updated_by	: v.updated_by,
						vehicle_id	: v.vehicle_id,
						vehicle_name	: v.vehicle_name,
					};
					$("#jqxGridTarget_record").jqxGrid('addrow', null, datarow);
				});
			},'JSON');
		});
	});
</script>