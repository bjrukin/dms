<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('settings'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('settings'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSettingToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSettingInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSettingFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSetting"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSetting">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-settings', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "settings_id"/>
            <table class="form-table">
				<tr>
					<td><label for='code'><?php echo lang('code')?></label></td>
					<td><input id='code' class='text_input' name='code'></td>
				</tr>
				<tr>
					<td><label for='key'><?php echo lang('key')?></label></td>
					<td><input id='key' class='text_input' name='key'></td>
				</tr>
				<tr>
					<td><label for='value'><?php echo lang('value')?></label></td>
					<td><input id='value' class='text_input' name='value'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSettingSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSettingCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var settingsDataSource =
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
			{ name: 'code', type: 'string' },
			{ name: 'key', type: 'string' },
			{ name: 'value', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/settings/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	settingsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSetting").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSetting").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSetting").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: settingsDataSource,
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
			container.append($('#jqxGridSettingToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editSettingRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("code"); ?>',datafield: 'code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("key"); ?>',datafield: 'key',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("value"); ?>',datafield: 'value',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridSetting").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSettingFilterClear', function () { 
		$('#jqxGridSetting').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSettingInsert', function () { 
		openPopupWindow('jqxPopupWindowSetting', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowSetting").jqxWindow({ 
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

    $("#jqxPopupWindowSetting").on('close', function () {
        reset_form_settings();
    });

    $("#jqxSettingCancelButton").on('click', function () {
        reset_form_settings();
        $('#jqxPopupWindowSetting').jqxWindow('close');
    });

    /*$('#form-settings').jqxValidator({
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

			{ input: '#code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#key', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#key').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#value', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#value').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxSettingSubmitButton").on('click', function () {
        saveSettingRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSettingRecord();
                }
            };
        $('#form-settings').jqxValidator('validate', validationResult);
        */
    });
});

function editSettingRecord(index){
    var row =  $("#jqxGridSetting").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#settings_id').val(row.id);
		$('#code').val(row.code);
		$('#key').val(row.key);
		$('#value').val(row.value);
		
        openPopupWindow('jqxPopupWindowSetting', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveSettingRecord(){
    var data = $("#form-settings").serialize();
	
	$('#jqxPopupWindowSetting').block({ 
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
        url: '<?php echo site_url("admin/settings/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_settings();
                $('#jqxGridSetting').jqxGrid('updatebounddata');
                $('#jqxPopupWindowSetting').jqxWindow('close');
            }
            $('#jqxPopupWindowSetting').unblock();
        }
    });
}

function reset_form_settings(){
	$('#settings_id').val('');
    $('#form-settings')[0].reset();
}
</script>