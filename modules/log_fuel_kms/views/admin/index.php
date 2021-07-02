<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('log_fuel_kms'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('log_fuel_kms'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridLog_fuel_kmToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridLog_fuel_kmInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridLog_fuel_kmFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridLog_fuel_km"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowLog_fuel_km">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-log_fuel_kms', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "log_fuel_kms_id"/>
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
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='fuel'><?php echo lang('fuel')?></label></td>
					<td><input id='fuel' class='text_input' name='fuel'></td>
				</tr>
				<tr>
					<td><label for='kms'><?php echo lang('kms')?></label></td>
					<td><input id='kms' class='text_input' name='kms'></td>
				</tr>
				<tr>
					<td><label for='date'><?php echo lang('date')?></label></td>
					<td><div id='date' class='date_box' name='date'></div></td>
				</tr>
				<tr>
					<td><label for='date_np'><?php echo lang('date_np')?></label></td>
					<td><input id='date_np' class='text_input' name='date_np'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxLog_fuel_kmSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxLog_fuel_kmCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var log_fuel_kmsDataSource =
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
			{ name: 'fuel', type: 'string' },
			{ name: 'kms', type: 'string' },
			{ name: 'date', type: 'date' },
			{ name: 'date_np', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/log_fuel_kms/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	log_fuel_kmsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridLog_fuel_km").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridLog_fuel_km").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridLog_fuel_km").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: log_fuel_kmsDataSource,
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
			container.append($('#jqxGridLog_fuel_kmToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editLog_fuel_kmRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("fuel"); ?>',datafield: 'fuel',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("kms"); ?>',datafield: 'kms',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("date_np"); ?>',datafield: 'date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridLog_fuel_km").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridLog_fuel_kmFilterClear', function () { 
		$('#jqxGridLog_fuel_km').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridLog_fuel_kmInsert', function () { 
		openPopupWindow('jqxPopupWindowLog_fuel_km', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowLog_fuel_km").jqxWindow({ 
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

    $("#jqxPopupWindowLog_fuel_km").on('close', function () {
        reset_form_log_fuel_kms();
    });

    $("#jqxLog_fuel_kmCancelButton").on('click', function () {
        reset_form_log_fuel_kms();
        $('#jqxPopupWindowLog_fuel_km').jqxWindow('close');
    });

    /*$('#form-log_fuel_kms').jqxValidator({
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

			{ input: '#fuel', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#fuel').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#kms', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#kms').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxLog_fuel_kmSubmitButton").on('click', function () {
        saveLog_fuel_kmRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveLog_fuel_kmRecord();
                }
            };
        $('#form-log_fuel_kms').jqxValidator('validate', validationResult);
        */
    });
});

function editLog_fuel_kmRecord(index){
    var row =  $("#jqxGridLog_fuel_km").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#log_fuel_kms_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#fuel').val(row.fuel);
		$('#kms').val(row.kms);
		$('#date').jqxDateTimeInput('setDate', row.date);
		$('#date_np').val(row.date_np);
		
        openPopupWindow('jqxPopupWindowLog_fuel_km', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveLog_fuel_kmRecord(){
    var data = $("#form-log_fuel_kms").serialize();
	
	$('#jqxPopupWindowLog_fuel_km').block({ 
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
        url: '<?php echo site_url("admin/log_fuel_kms/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_log_fuel_kms();
                $('#jqxGridLog_fuel_km').jqxGrid('updatebounddata');
                $('#jqxPopupWindowLog_fuel_km').jqxWindow('close');
            }
            $('#jqxPopupWindowLog_fuel_km').unblock();
        }
    });
}

function reset_form_log_fuel_kms(){
	$('#log_fuel_kms_id').val('');
    $('#form-log_fuel_kms')[0].reset();
}
</script>