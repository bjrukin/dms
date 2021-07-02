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
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridTarget_recordToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridTarget_recordInsert"><?php echo lang('general_create'); ?></button>
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
					<td><label for='vehicle_classification'><?php echo lang('vehicle_classification')?></label></td>
					<td><div id='vehicle_classification' class='number_general' name='vehicle_classification'></div></td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='target_year'><?php echo lang('target_year')?></label></td>
					<td><input id='target_year' class='text_input' name='target_year'></td>
				</tr>
				<tr>
					<td><label for='shrawan'><?php echo lang('shrawan')?></label></td>
					<td><div id='shrawan' class='number_general' name='shrawan'></div></td>
				</tr>
				<tr>
					<td><label for='bhadra'><?php echo lang('bhadra')?></label></td>
					<td><div id='bhadra' class='number_general' name='bhadra'></div></td>
				</tr>
				<tr>
					<td><label for='ashwin'><?php echo lang('ashwin')?></label></td>
					<td><div id='ashwin' class='number_general' name='ashwin'></div></td>
				</tr>
				<tr>
					<td><label for='kartik'><?php echo lang('kartik')?></label></td>
					<td><div id='kartik' class='number_general' name='kartik'></div></td>
				</tr>
				<tr>
					<td><label for='mangsir'><?php echo lang('mangsir')?></label></td>
					<td><div id='mangsir' class='number_general' name='mangsir'></div></td>
				</tr>
				<tr>
					<td><label for='poush'><?php echo lang('poush')?></label></td>
					<td><div id='poush' class='number_general' name='poush'></div></td>
				</tr>
				<tr>
					<td><label for='magh'><?php echo lang('magh')?></label></td>
					<td><div id='magh' class='number_general' name='magh'></div></td>
				</tr>
				<tr>
					<td><label for='falgun'><?php echo lang('falgun')?></label></td>
					<td><div id='falgun' class='number_general' name='falgun'></div></td>
				</tr>
				<tr>
					<td><label for='chaitra'><?php echo lang('chaitra')?></label></td>
					<td><div id='chaitra' class='number_general' name='chaitra'></div></td>
				</tr>
				<tr>
					<td><label for='baishak'><?php echo lang('baishak')?></label></td>
					<td><div id='baishak' class='number_general' name='baishak'></div></td>
				</tr>
				<tr>
					<td><label for='jestha'><?php echo lang('jestha')?></label></td>
					<td><div id='jestha' class='number_general' name='jestha'></div></td>
				</tr>
				<tr>
					<td><label for='ashad'><?php echo lang('ashad')?></label></td>
					<td><div id='ashad' class='number_general' name='ashad'></div></td>
				</tr>
				<tr>
					<td><label for='revision'><?php echo lang('revision')?></label></td>
					<td><div id='revision' class='number_general' name='revision'></div></td>
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
			{ name: 'shrawan', type: 'number' },
			{ name: 'bhadra', type: 'number' },
			{ name: 'ashwin', type: 'number' },
			{ name: 'kartik', type: 'number' },
			{ name: 'mangsir', type: 'number' },
			{ name: 'poush', type: 'number' },
			{ name: 'magh', type: 'number' },
			{ name: 'falgun', type: 'number' },
			{ name: 'chaitra', type: 'number' },
			{ name: 'baishak', type: 'number' },
			{ name: 'jestha', type: 'number' },
			{ name: 'ashad', type: 'number' },
			{ name: 'revision', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/target_records/json"); ?>',
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
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_classification"); ?>',datafield: 'vehicle_classification',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("target_year"); ?>',datafield: 'target_year',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("shrawan"); ?>',datafield: 'shrawan',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("bhadra"); ?>',datafield: 'bhadra',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("ashwin"); ?>',datafield: 'ashwin',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("kartik"); ?>',datafield: 'kartik',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mangsir"); ?>',datafield: 'mangsir',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("poush"); ?>',datafield: 'poush',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("magh"); ?>',datafield: 'magh',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("falgun"); ?>',datafield: 'falgun',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("chaitra"); ?>',datafield: 'chaitra',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("baishak"); ?>',datafield: 'baishak',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("jestha"); ?>',datafield: 'jestha',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("ashad"); ?>',datafield: 'ashad',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("revision"); ?>',datafield: 'revision',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
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
	});

	$(document).on('click','#jqxGridTarget_recordInsert', function () { 
		openPopupWindow('jqxPopupWindowTarget_record', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
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

			{ input: '#shrawan', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#shrawan').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bhadra', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bhadra').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#ashwin', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#ashwin').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#kartik', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#kartik').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#mangsir', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#mangsir').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#poush', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#poush').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#magh', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#magh').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#falgun', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#falgun').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#chaitra', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#chaitra').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#baishak', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#baishak').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#jestha', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#jestha').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#ashad', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#ashad').jqxNumberInput('val');
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
    var row =  $("#jqxGridTarget_record").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#target_records_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#vehicle_classification').jqxNumberInput('val', row.vehicle_classification);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#target_year').val(row.target_year);
		$('#shrawan').jqxNumberInput('val', row.shrawan);
		$('#bhadra').jqxNumberInput('val', row.bhadra);
		$('#ashwin').jqxNumberInput('val', row.ashwin);
		$('#kartik').jqxNumberInput('val', row.kartik);
		$('#mangsir').jqxNumberInput('val', row.mangsir);
		$('#poush').jqxNumberInput('val', row.poush);
		$('#magh').jqxNumberInput('val', row.magh);
		$('#falgun').jqxNumberInput('val', row.falgun);
		$('#chaitra').jqxNumberInput('val', row.chaitra);
		$('#baishak').jqxNumberInput('val', row.baishak);
		$('#jestha').jqxNumberInput('val', row.jestha);
		$('#ashad').jqxNumberInput('val', row.ashad);
		$('#revision').jqxNumberInput('val', row.revision);
		
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
                $('#jqxGridTarget_record').jqxGrid('updatebounddata');
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