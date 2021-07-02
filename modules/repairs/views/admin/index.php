<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('repairs'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('repairs'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridRepairToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridRepairInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridRepairFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridRepair"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowRepair">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-repairs', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "repairs_id"/>
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
					<td><label for='vehicle_name'><?php echo lang('vehicle_name')?></label></td>
					<td><input id='vehicle_name' class='text_input' name='vehicle_name'></td>
				</tr>
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='color_name'><?php echo lang('color_name')?></label></td>
					<td><input id='color_name' class='text_input' name='color_name'></td>
				</tr>
				<tr>
					<td><label for='variant_name'><?php echo lang('variant_name')?></label></td>
					<td><input id='variant_name' class='text_input' name='variant_name'></td>
				</tr>
				<tr>
					<td><label for='description'><?php echo lang('description')?></label></td>
					<td><input id='description' class='text_input' name='description'></td>
				</tr>
				<tr>
					<td><label for='image'><?php echo lang('image')?></label></td>
					<td><input id='image' class='text_input' name='image'></td>
				</tr>
				<tr>
					<td><label for='chass_no'><?php echo lang('chass_no')?></label></td>
					<td><div id='chass_no' class='number_general' name='chass_no'></div></td>
				</tr>
				<tr>
					<td><label for='engine_no'><?php echo lang('engine_no')?></label></td>
					<td><div id='engine_no' class='number_general' name='engine_no'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxRepairSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxRepairCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var repairsDataSource =
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
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'color_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'image', type: 'string' },
			{ name: 'chass_no', type: 'number' },
			{ name: 'engine_no', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/repairs/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	repairsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridRepair").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridRepair").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridRepair").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: repairsDataSource,
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
			container.append($('#jqxGridRepairToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editRepairRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("image"); ?>',datafield: 'image',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridRepair").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridRepairFilterClear', function () { 
		$('#jqxGridRepair').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridRepairInsert', function () { 
		openPopupWindow('jqxPopupWindowRepair', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowRepair").jqxWindow({ 
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

    $("#jqxPopupWindowRepair").on('close', function () {
        reset_form_repairs();
    });

    $("#jqxRepairCancelButton").on('click', function () {
        reset_form_repairs();
        $('#jqxPopupWindowRepair').jqxWindow('close');
    });

    /*$('#form-repairs').jqxValidator({
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

			{ input: '#vehicle_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#color_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#color_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#variant_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#variant_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#description', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#description').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#image', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#image').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#chass_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#chass_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#engine_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#engine_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxRepairSubmitButton").on('click', function () {
        saveRepairRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveRepairRecord();
                }
            };
        $('#form-repairs').jqxValidator('validate', validationResult);
        */
    });
});

function editRepairRecord(index){
    var row =  $("#jqxGridRepair").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#repairs_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#vehicle_name').val(row.vehicle_name);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#color_name').val(row.color_name);
		$('#variant_name').val(row.variant_name);
		$('#description').val(row.description);
		$('#image').val(row.image);
		$('#chass_no').jqxNumberInput('val', row.chass_no);
		$('#engine_no').jqxNumberInput('val', row.engine_no);
		
        openPopupWindow('jqxPopupWindowRepair', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveRepairRecord(){
    var data = $("#form-repairs").serialize();
	
	$('#jqxPopupWindowRepair').block({ 
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
        url: '<?php echo site_url("admin/repairs/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_repairs();
                $('#jqxGridRepair').jqxGrid('updatebounddata');
                $('#jqxPopupWindowRepair').jqxWindow('close');
            }
            $('#jqxPopupWindowRepair').unblock();
        }
    });
}

function reset_form_repairs(){
	$('#repairs_id').val('');
    $('#form-repairs')[0].reset();
}
</script>