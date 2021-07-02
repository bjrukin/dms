<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('service_jobs'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('service_jobs'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridService_jobToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridService_jobInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridService_jobFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridService_job"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowService_job">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-service_jobs', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "service_jobs_id"/>

		<div class="row">
			<div class="col-md-2"><label for='job_code'><?php echo lang('job_code')?></label></div>
			<div class="col-md-3"><input id='job_code' class='form-control' name='job_code'></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='description'><?php echo lang('description')?></label></div>
			<div class="col-md-4"><input id='description' class='form-control' name='description'></div>
			<div class="col-md-2"><label for='apply_tax'><?php echo lang('apply_tax')?></label></div>
			<div class="col-md-4"> <input id='apply_tax' type="checkbox" class='' name='apply_tax' value="1"><small>(Apply Service Tax)</small> </div>
		</div>
		<div class="row">
			<div class="col-md-3"><label for='outsidework_margin'><?php echo lang('outsidework_margin')?></label></div>
			<div class="col-md-2"><input id='outsidework_margin' class='form-control' name='outsidework_margin'></div>
			<div class="col-md-3"><label for='number_vehicles'><?php echo lang('number_vehicles')?></label></div>
			<div class="col-md-2"><input id='number_vehicles' class='form-control' name='number_vehicles'></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-3">
				<input id="mechanic_incentive" type="checkbox" class='' name='mechanic_incentive'>
				<label for='mechanic_incentive'><?php echo lang('mechanic_incentive')?></label>
			</div>
			<div class="col-md-3">
				<input id="top_complaints" type="checkbox" name='top_complaints'>
				<label for='top_complaints'><?php echo lang('top_complaints')?></label>
			</div>
			<div class="col-md-3">
				<input id="under_warranty" type="checkbox" name='under_warranty'>
				<label for='under_warranty'><?php echo lang('under_warranty')?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="grid_modelwise"></div>
			</div>
		</div>

		<table class="form-table">
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxService_jobSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxService_jobCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">
	function getFormData(formId) {
		return $('#' + formId).serializeArray().reduce(function (obj, item) {
			var name = item.name,
			value = item.value;

			if (obj.hasOwnProperty(name)) {
				if (typeof obj[name] == "string") {
					obj[name] = [obj[name]];
					obj[name].push(value);
				} else {
					obj[name].push(value);
				}
			} else {
				obj[name] = value;
			}
			return obj;
		}, {});
	}

	var vehicle_list =  <?php print_r($vehicle_list); ?>;

	$(function(){

		var service_jobsDataSource =
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
			{ name: 'rank', type: 'number' },
			{ name: 'job_code', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'group_id', type: 'number' },
			{ name: 'apply_tax', type: 'number' },
			{ name: 'outsidework_margin', type: 'string' },
			{ name: 'number_vehicles', type: 'number' },
			{ name: 'mechanic_incentive', type: 'number' },
			{ name: 'top_complaints', type: 'number' },
			{ name: 'under_warranty', type: 'number' },
			
			],
			url: '<?php echo site_url("admin/service_jobs/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	service_jobsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridService_job").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridService_job").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridService_job").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: service_jobsDataSource,
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
			container.append($('#jqxGridService_jobToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editService_jobRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("job_code"); ?>',datafield: 'job_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("group_id"); ?>',datafield: 'group_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("apply_tax"); ?>',datafield: 'apply_tax',width: 50,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox' },
		{ text: '<?php echo lang("outsidework_margin"); ?>',datafield: 'outsidework_margin',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("number_vehicles"); ?>',datafield: 'number_vehicles',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("mechanic_incentive"); ?>',datafield: 'mechanic_incentive',width: 50,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox' },
		{ text: '<?php echo lang("top_complaints"); ?>',datafield: 'top_complaints',width: 50,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox' },
		{ text: '<?php echo lang("under_warranty"); ?>',datafield: 'under_warranty',width: 50,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox' },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridService_job").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridService_jobFilterClear', function () { 
		$('#jqxGridService_job').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridService_jobInsert', function () { 

		// $.post('<?php echo site_url('service_jobs/get_vehicles'); ?>',function(result){
		// },'JSON');
			$("#grid_modelwise").jqxGrid('clear');

			$.each(vehicle_list,function(i,v){

				var datarow = {
					// 'id'            	:0,
					'vehicle_id'    	:v.vehicle_id,
					'vehicle_name'  	:v.vehicle_name,
					'variant_id'    	:v.variant_id,
					'variant_name'  	:v.variant_name,
					'status'     		:1,
					'price'     		:0,
					'duration_hours'	:0,
					'duration_minutes'	:0,
				};

				$("#grid_modelwise").jqxGrid('addrow', null, datarow);
			});
			openPopupWindow('jqxPopupWindowService_job', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');

	});

	// initialize the popup window
	$("#jqxPopupWindowService_job").jqxWindow({ 
		theme: theme,
		width: '60%',
		maxWidth: '75%',
		height: '75%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowService_job").on('close', function () {
		reset_form_service_jobs();
	});

	$("#jqxService_jobCancelButton").on('click', function () {
		reset_form_service_jobs();
		$('#jqxPopupWindowService_job').jqxWindow('close');
	});

    $('#form-service_jobs').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [

			{ input: '#job_code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#job_code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#description', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#description').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},			
			/*{ input: '#outsidework_margin', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#outsidework_margin').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},*/

			/*{ input: '#number_vehicles', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#number_vehicles').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},*/
        ]
    });

    $("#jqxService_jobSubmitButton").on('click', function () {
    	// saveService_jobRecord();
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveService_jobRecord();
                }
            };
        $('#form-service_jobs').jqxValidator('validate', validationResult);
        
    });
});

function editService_jobRecord(index){
	var row =  $("#jqxGridService_job").jqxGrid('getrowdata', index);
	$('#grid_modelwise').jqxGrid('clear');
	if (row) {
		$('#service_jobs_id').val(row.id);
		$('#job_code').val(row.job_code);
		$('#description').val(row.description);
		$('#apply_tax').prop('checked', row.apply_tax);
		$('#outsidework_margin').val(row.outsidework_margin);
		$('#number_vehicles').jqxNumberInput('val', row.number_vehicles);
		$('#mechanic_incentive').prop('checked', row.mechanic_incentive);
		$('#top_complaints').prop('checked', row.top_complaints);
		$('#under_warranty').prop('checked', row.under_warranty);

		$.post('<?php echo site_url('service_jobs/get_vehicles'); ?>',{ id:row.id },function(result){
			$.each(result,function(i,v){
				var datarow = {
					'id'            	:v.id,
					'vehicle_id'    	:v.vehicle_id,
					'vehicle_name'  	:v.vehicle_name,
					'variant_id'    	:v.variant_id,
					'variant_name'  	:v.variant_name,
					'status'     		:v.status,
					'price'     		:v.price,
					'duration_hours'	:v.duration_hours,
					'duration_minutes'	:v.duration_minutes,
				};
				$("#grid_modelwise").jqxGrid('addrow', null, datarow);
			});
		},'JSON');

		openPopupWindow('jqxPopupWindowService_job', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveService_jobRecord(){
	var data = getFormData('form-service_jobs');
	// JSON.stringify
	var modelwise = ($("#grid_modelwise").jqxGrid('getrows'));
	
	$('#jqxPopupWindowService_job').block({ 
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
		url: '<?php echo site_url("admin/service_jobs/save"); ?>',
		data: {
			data: data,
			modelwise
		},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_service_jobs();
				$('#jqxGridService_job').jqxGrid('updatebounddata');
				$('#jqxPopupWindowService_job').jqxWindow('close');
			}
		}
	});
	$('#jqxPopupWindowService_job').unblock();
}

function reset_form_service_jobs(){
	$('#service_jobs_id').val('');
	$('#form-service_jobs')[0].reset();
}
</script>

<script type="text/javascript">
	$(function(){
		var grid_modelwiseDataSource = {
			datatype: "local",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'status', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'duration_hours', type: 'number' },
			{ name: 'duration_minutes', type: 'number' },
			
			],
			// url: '<?php //echo site_url("admin/service_jobs/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
				// callback called when a page or page size is changed.
			},
			beforeprocessing: function (data) {
				grid_modelwiseDataSource.totalrecords = data.total;
			},
			// update the grid and send a request to the server.
			filter: function () {
				$("#grid_modelwise").jqxGrid('updatebounddata', 'filter');
			},
			// update the grid and send a request to the server.
			sort: function () {
				$("#grid_modelwise").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};
		var grid_modelwisedataAdapter = new $.jqx.dataAdapter(grid_modelwiseDataSource);

		$("#grid_modelwise").jqxGrid({
			theme: theme,
			width: '100%',
			height: '60%',
			source: grid_modelwisedataAdapter,
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
			editable: true,
			rendertoolbar: function (toolbar) {
				var container = $("<div style='margin: 5px; height:50px'></div>");
				// container.append($('#jqxGridService_jobToolbar').html());
				toolbar.append(container);
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo ("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true, editable: false, renderer: gridColumnsRenderer },
			{ text: '<?php echo ("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true, editable: false, renderer: gridColumnsRenderer },
			{ text: '<?php echo ("status"); ?>',datafield: 'status',width: 30,filterable: false, columntype: 'checkbox', renderer: gridColumnsRenderer },
			{ text: '<?php echo ("price"); ?>',datafield: 'price',width: 150,filterable: true, columntype: 'numberinput', renderer: gridColumnsRenderer },
			{ text: '<?php echo ("duration_hours"); ?>',datafield: 'duration_hours',filterable: false, columntype: 'numberinput', renderer: gridColumnsRenderer },
			{ text: '<?php echo ("duration_minutes"); ?>',datafield: 'duration_minutes',filterable: false, columntype: 'numberinput', renderer: gridColumnsRenderer },


			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

	});
</script>