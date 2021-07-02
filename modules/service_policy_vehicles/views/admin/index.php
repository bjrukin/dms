<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('service_policy_vehicles'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('service_policy_vehicles'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridService_policy_vehicleToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridService_policy_vehicleInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridService_policy_vehicleFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridService_policy_vehicle"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowService_policy_vehicle">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-service_policy_vehicles', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "service_policy_vehicles_id"/>
            <table class="form-table">
				<tr>
					<td><label for='created_by'><?php echo lang('created_by')?></label></td>
					<td><div id='created_by' class='number_general' name='created_by'></div></td>
				</tr>
				<tr>
					<td><label for='updated_by'><?php echo lang('updated_by')?></label></td>
					<td><div id='updated_by' class='number_general' name='updated_by'></div></td>
				</tr>
				<tr>
					<td><label for='deleted_by'><?php echo lang('deleted_by')?></label></td>
					<td><div id='deleted_by' class='number_general' name='deleted_by'></div></td>
				</tr>
				<tr>
					<td><label for='created_at'><?php echo lang('created_at')?></label></td>
					<td><input id='created_at' class='text_input' name='created_at'></td>
				</tr>
				<tr>
					<td><label for='updated_at'><?php echo lang('updated_at')?></label></td>
					<td><input id='updated_at' class='text_input' name='updated_at'></td>
				</tr>
				<tr>
					<td><label for='deleted_at'><?php echo lang('deleted_at')?></label></td>
					<td><input id='deleted_at' class='text_input' name='deleted_at'></td>
				</tr>
				<tr>
					<td><label for='policy_id'><?php echo lang('policy_id')?></label></td>
					<td><div id='policy_id' class='number_general' name='policy_id'></div></td>
				</tr>
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='varient_id'><?php echo lang('varient_id')?></label></td>
					<td><div id='varient_id' class='number_general' name='varient_id'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxService_policy_vehicleSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxService_policy_vehicleCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var service_policy_vehiclesDataSource =
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
			{ name: 'policy_id', type: 'number' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'varient_id', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/service_policy_vehicles/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	service_policy_vehiclesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridService_policy_vehicle").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridService_policy_vehicle").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridService_policy_vehicle").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: service_policy_vehiclesDataSource,
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
			container.append($('#jqxGridService_policy_vehicleToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editService_policy_vehicleRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("policy_id"); ?>',datafield: 'policy_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("varient_id"); ?>',datafield: 'varient_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridService_policy_vehicle").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridService_policy_vehicleFilterClear', function () { 
		$('#jqxGridService_policy_vehicle').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridService_policy_vehicleInsert', function () { 
		openPopupWindow('jqxPopupWindowService_policy_vehicle', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowService_policy_vehicle").jqxWindow({ 
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

    $("#jqxPopupWindowService_policy_vehicle").on('close', function () {
        reset_form_service_policy_vehicles();
    });

    $("#jqxService_policy_vehicleCancelButton").on('click', function () {
        reset_form_service_policy_vehicles();
        $('#jqxPopupWindowService_policy_vehicle').jqxWindow('close');
    });

    /*$('#form-service_policy_vehicles').jqxValidator({
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

			{ input: '#policy_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#policy_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#varient_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#varient_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxService_policy_vehicleSubmitButton").on('click', function () {
        saveService_policy_vehicleRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveService_policy_vehicleRecord();
                }
            };
        $('#form-service_policy_vehicles').jqxValidator('validate', validationResult);
        */
    });
});

function editService_policy_vehicleRecord(index){
    var row =  $("#jqxGridService_policy_vehicle").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#service_policy_vehicles_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#policy_id').jqxNumberInput('val', row.policy_id);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#varient_id').jqxNumberInput('val', row.varient_id);
		
        openPopupWindow('jqxPopupWindowService_policy_vehicle', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveService_policy_vehicleRecord(){
    var data = $("#form-service_policy_vehicles").serialize();
	
	$('#jqxPopupWindowService_policy_vehicle').block({ 
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
        url: '<?php echo site_url("admin/service_policy_vehicles/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_service_policy_vehicles();
                $('#jqxGridService_policy_vehicle').jqxGrid('updatebounddata');
                $('#jqxPopupWindowService_policy_vehicle').jqxWindow('close');
            }
            $('#jqxPopupWindowService_policy_vehicle').unblock();
        }
    });
}

function reset_form_service_policy_vehicles(){
	$('#service_policy_vehicles_id').val('');
    $('#form-service_policy_vehicles')[0].reset();
}
</script>