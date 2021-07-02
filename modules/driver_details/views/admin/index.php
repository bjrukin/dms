<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('driver_details'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('driver_details'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDriver_detailToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDriver_detailInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDriver_detailFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDriver_detail"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDriver_detail">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-driver_details', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "driver_details_id"/>
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
					<td><label for='driver_name'><?php echo lang('driver_name')?></label></td>
					<td><input id='driver_name' class='text_input' name='driver_name'></td>
				</tr>
				<tr>
					<td><label for='driver_number'><?php echo lang('driver_number')?></label></td>
					<td><input id='driver_number' class='text_input' name='driver_number'></td>
				</tr>
				<tr>
					<td><label for='driver_address'><?php echo lang('driver_address')?></label></td>
					<td><input id='driver_address' class='text_input' name='driver_address'></td>
				</tr>
				<tr>
					<td><label for='source'><?php echo lang('source')?></label></td>
					<td><input id='source' class='text_input' name='source'></td>
				</tr>
				<tr>
					<td><label for='destination'><?php echo lang('destination')?></label></td>
					<td><input id='destination' class='text_input' name='destination'></td>
				</tr>
				<tr>
					<td><label for='photo'><?php echo lang('photo')?></label></td>
					<td><input id='photo' class='text_input' name='photo'></td>
				</tr>
				<tr>
					<td><label for='license_no'><?php echo lang('license_no')?></label></td>
					<td><input id='license_no' class='text_input' name='license_no'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDriver_detailSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDriver_detailCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var driver_detailsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'driver_name', type: 'string' },
			{ name: 'driver_number', type: 'string' },
			{ name: 'driver_address', type: 'string' },
			{ name: 'source', type: 'string' },
			{ name: 'destination', type: 'string' },
			{ name: 'photo', type: 'string' },
			{ name: 'license_no', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/driver_details/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	driver_detailsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDriver_detail").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDriver_detail").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDriver_detail").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: driver_detailsDataSource,
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
			container.append($('#jqxGridDriver_detailToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDriver_detailRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_name"); ?>',datafield: 'driver_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_number"); ?>',datafield: 'driver_number',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_address"); ?>',datafield: 'driver_address',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("source"); ?>',datafield: 'source',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("destination"); ?>',datafield: 'destination',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("photo"); ?>',datafield: 'photo',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("license_no"); ?>',datafield: 'license_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDriver_detail").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDriver_detailFilterClear', function () { 
		$('#jqxGridDriver_detail').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDriver_detailInsert', function () { 
		openPopupWindow('jqxPopupWindowDriver_detail', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDriver_detail").jqxWindow({ 
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

    $("#jqxPopupWindowDriver_detail").on('close', function () {
        reset_form_driver_details();
    });

    $("#jqxDriver_detailCancelButton").on('click', function () {
        reset_form_driver_details();
        $('#jqxPopupWindowDriver_detail').jqxWindow('close');
    });

    /*$('#form-driver_details').jqxValidator({
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

			{ input: '#driver_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_number', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_number').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_address', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_address').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#source', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#source').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#destination', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#destination').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#photo', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#photo').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#license_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#license_no').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDriver_detailSubmitButton").on('click', function () {
        saveDriver_detailRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDriver_detailRecord();
                }
            };
        $('#form-driver_details').jqxValidator('validate', validationResult);
        */
    });
});

function editDriver_detailRecord(index){
    var row =  $("#jqxGridDriver_detail").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#driver_details_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#driver_name').val(row.driver_name);
		$('#driver_number').val(row.driver_number);
		$('#driver_address').val(row.driver_address);
		$('#source').val(row.source);
		$('#destination').val(row.destination);
		$('#photo').val(row.photo);
		$('#license_no').val(row.license_no);
		
        openPopupWindow('jqxPopupWindowDriver_detail', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDriver_detailRecord(){
    var data = $("#form-driver_details").serialize();
	
	$('#jqxPopupWindowDriver_detail').block({ 
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
        url: '<?php echo site_url("admin/driver_details/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_driver_details();
                $('#jqxGridDriver_detail').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDriver_detail').jqxWindow('close');
            }
            $('#jqxPopupWindowDriver_detail').unblock();
        }
    });
}

function reset_form_driver_details(){
	$('#driver_details_id').val('');
    $('#form-driver_details')[0].reset();
}
</script>