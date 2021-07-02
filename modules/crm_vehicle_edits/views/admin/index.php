<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('crm_vehicle_edits'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('crm_vehicle_edits'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCrm_vehicle_editToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCrm_vehicle_editInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCrm_vehicle_editFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCrm_vehicle_edit"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCrm_vehicle_edit">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-crm_vehicle_edits', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "crm_vehicle_edits_id"/>
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
					<td><label for='customer_id'><?php echo lang('customer_id')?></label></td>
					<td><div id='customer_id' class='number_general' name='customer_id'></div></td>
				</tr>
				<tr>
					<td><label for='prev_vehicle'><?php echo lang('prev_vehicle')?></label></td>
					<td><div id='prev_vehicle' class='number_general' name='prev_vehicle'></div></td>
				</tr>
				<tr>
					<td><label for='prev_variant'><?php echo lang('prev_variant')?></label></td>
					<td><div id='prev_variant' class='number_general' name='prev_variant'></div></td>
				</tr>
				<tr>
					<td><label for='prev_color'><?php echo lang('prev_color')?></label></td>
					<td><div id='prev_color' class='number_general' name='prev_color'></div></td>
				</tr>
				<tr>
					<td><label for='new_vehicle'><?php echo lang('new_vehicle')?></label></td>
					<td><div id='new_vehicle' class='number_general' name='new_vehicle'></div></td>
				</tr>
				<tr>
					<td><label for='new_variant'><?php echo lang('new_variant')?></label></td>
					<td><div id='new_variant' class='number_general' name='new_variant'></div></td>
				</tr>
				<tr>
					<td><label for='new_color'><?php echo lang('new_color')?></label></td>
					<td><div id='new_color' class='number_general' name='new_color'></div></td>
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
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCrm_vehicle_editSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCrm_vehicle_editCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var crm_vehicle_editsDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'prev_vehicle', type: 'number' },
			{ name: 'prev_variant', type: 'number' },
			{ name: 'prev_color', type: 'number' },
			{ name: 'new_vehicle', type: 'number' },
			{ name: 'new_variant', type: 'number' },
			{ name: 'new_color', type: 'number' },
			{ name: 'date', type: 'date' },
			{ name: 'date_np', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/crm_vehicle_edits/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	crm_vehicle_editsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCrm_vehicle_edit").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCrm_vehicle_edit").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCrm_vehicle_edit").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: crm_vehicle_editsDataSource,
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
			container.append($('#jqxGridCrm_vehicle_editToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editCrm_vehicle_editRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("prev_vehicle"); ?>',datafield: 'prev_vehicle',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("prev_variant"); ?>',datafield: 'prev_variant',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("prev_color"); ?>',datafield: 'prev_color',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("new_vehicle"); ?>',datafield: 'new_vehicle',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("new_variant"); ?>',datafield: 'new_variant',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("new_color"); ?>',datafield: 'new_color',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("date_np"); ?>',datafield: 'date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCrm_vehicle_edit").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCrm_vehicle_editFilterClear', function () { 
		$('#jqxGridCrm_vehicle_edit').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCrm_vehicle_editInsert', function () { 
		openPopupWindow('jqxPopupWindowCrm_vehicle_edit', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowCrm_vehicle_edit").jqxWindow({ 
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

    $("#jqxPopupWindowCrm_vehicle_edit").on('close', function () {
        reset_form_crm_vehicle_edits();
    });

    $("#jqxCrm_vehicle_editCancelButton").on('click', function () {
        reset_form_crm_vehicle_edits();
        $('#jqxPopupWindowCrm_vehicle_edit').jqxWindow('close');
    });

    /*$('#form-crm_vehicle_edits').jqxValidator({
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

			{ input: '#customer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#prev_vehicle', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#prev_vehicle').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#prev_variant', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#prev_variant').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#prev_color', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#prev_color').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#new_vehicle', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_vehicle').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#new_variant', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_variant').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#new_color', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#new_color').jqxNumberInput('val');
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

    $("#jqxCrm_vehicle_editSubmitButton").on('click', function () {
        saveCrm_vehicle_editRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCrm_vehicle_editRecord();
                }
            };
        $('#form-crm_vehicle_edits').jqxValidator('validate', validationResult);
        */
    });
});

function editCrm_vehicle_editRecord(index){
    var row =  $("#jqxGridCrm_vehicle_edit").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#crm_vehicle_edits_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#customer_id').jqxNumberInput('val', row.customer_id);
		$('#prev_vehicle').jqxNumberInput('val', row.prev_vehicle);
		$('#prev_variant').jqxNumberInput('val', row.prev_variant);
		$('#prev_color').jqxNumberInput('val', row.prev_color);
		$('#new_vehicle').jqxNumberInput('val', row.new_vehicle);
		$('#new_variant').jqxNumberInput('val', row.new_variant);
		$('#new_color').jqxNumberInput('val', row.new_color);
		$('#date').jqxDateTimeInput('setDate', row.date);
		$('#date_np').val(row.date_np);
		
        openPopupWindow('jqxPopupWindowCrm_vehicle_edit', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveCrm_vehicle_editRecord(){
    var data = $("#form-crm_vehicle_edits").serialize();
	
	$('#jqxPopupWindowCrm_vehicle_edit').block({ 
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
        url: '<?php echo site_url("admin/crm_vehicle_edits/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_crm_vehicle_edits();
                $('#jqxGridCrm_vehicle_edit').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCrm_vehicle_edit').jqxWindow('close');
            }
            $('#jqxPopupWindowCrm_vehicle_edit').unblock();
        }
    });
}

function reset_form_crm_vehicle_edits(){
	$('#crm_vehicle_edits_id').val('');
    $('#form-crm_vehicle_edits')[0].reset();
}
</script>