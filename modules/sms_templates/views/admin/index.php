<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('sms_templates'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('sms_templates'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSms_templateToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSms_templateInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSms_templateFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSms_template"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSms_template">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-sms_templates', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "sms_templates_id"/>
            <table class="form-table">
				<tr>
					<td><label for='type'><?php echo lang('type')?></label></td>
					<td><input id='type' class='text_input' name='type'></td>
				</tr>
				<tr>
					<td><label for='variables'><?php echo lang('variables')?></label></td>
					<td><input id='variables' class='text_input' name='variables'></td>
				</tr>
				<tr>
					<td><label for='message'><?php echo lang('message')?></label></td>
					<td><input id='message' class='text_input' name='message'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSms_templateSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSms_templateCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var sms_templatesDataSource =
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
			{ name: 'type', type: 'string' },
			{ name: 'variables', type: 'string' },
			{ name: 'message', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/sms_templates/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sms_templatesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSms_template").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSms_template").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSms_template").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: sms_templatesDataSource,
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
			container.append($('#jqxGridSms_templateToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editSms_templateRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("type"); ?>',datafield: 'type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variables"); ?>',datafield: 'variables',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("message"); ?>',datafield: 'message',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridSms_template").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSms_templateFilterClear', function () { 
		$('#jqxGridSms_template').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSms_templateInsert', function () { 
		openPopupWindow('jqxPopupWindowSms_template', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowSms_template").jqxWindow({ 
        theme: theme,
        width: '50%',
        maxWidth: '75%',
        height: '35%',  
        maxHeight: '75%',  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowSms_template").on('close', function () {
        reset_form_sms_templates();
    });

    $("#jqxSms_templateCancelButton").on('click', function () {
        reset_form_sms_templates();
        $('#jqxPopupWindowSms_template').jqxWindow('close');
    });

    /*$('#form-sms_templates').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#type', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#type').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#variables', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#variables').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#message', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#message').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxSms_templateSubmitButton").on('click', function () {
        saveSms_templateRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSms_templateRecord();
                }
            };
        $('#form-sms_templates').jqxValidator('validate', validationResult);
        */
    });
});

function editSms_templateRecord(index){
    var row =  $("#jqxGridSms_template").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#sms_templates_id').val(row.id);
		$('#type').val(row.type);
		$('#variables').val(row.variables);
		$('#message').val(row.message);
		
        openPopupWindow('jqxPopupWindowSms_template', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveSms_templateRecord(){
    var data = $("#form-sms_templates").serialize();
	
	$('#jqxPopupWindowSms_template').block({ 
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
        url: '<?php echo site_url("admin/sms_templates/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_sms_templates();
                $('#jqxGridSms_template').jqxGrid('updatebounddata');
                $('#jqxPopupWindowSms_template').jqxWindow('close');
            }
            $('#jqxPopupWindowSms_template').unblock();
        }
    });
}

function reset_form_sms_templates(){
	$('#sms_templates_id').val('');
    $('#form-sms_templates')[0].reset();
}
</script>