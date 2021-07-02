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
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSms_templateInsert"><?php echo lang('general_create'); ?></button> -->
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
		<div class="row">
			<div class="col-md-2"><label for='type'><?php echo lang('type')?></label></div>
			<div class="col-md-3"><div id="type" name="type" class="form-control"></div></div>	
		</div>
		<fieldset>
			<legend>Message</legend>
			<div id="add_item">
				<?php $c=0; for ($i=0; $i < 7; $i++) : ?> 
				<div class="row form-group">
					<div class="col-md-8"><input type="text" name="message[]" id="message-<?php echo $c++;?>" class="form-control input-sm"></div>
					<div class="col-md-4"><div class="form-control input-sm variables" name="variables[]" id="variables-<?php echo $c++;?>"></div></div>
				</div>
			<?php endfor; ?>
		</div>
	</fieldset>

	<div class="row">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-2">Sample: </div>
				<div class="col-md-10"> <textarea class="form-control" rows="4" id="messageboard" name="messageboard" readonly></textarea> </div>
			</div>

		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSms_templateSubmitButton"><?php echo lang('general_save'); ?></button>
			<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSms_templateCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>
	</div>

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

	$(function(){
		var messageboard;

		$('#add_item').on('change keyup',function(){
			messageboard = '';

			var sms_templates = getFormData('form-sms_templates');
			var messages = sms_templates['message[]'];
			var variables = sms_templates['variables[]'];

			$.each(messages, function(i,v) {				
				messageboard += v + variables[i];
			});

			$("#messageboard").text(messageboard);

		});

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
			{ name: 'skeleton', type: 'string' },
			
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
		{ text: '<?php echo lang("message"); ?>',datafield: 'message',filterable: true,renderer: gridColumnsRenderer },

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
		width: '80%',
		maxWidth: '80%',
		height: '80%',  
		maxHeight: '80%',  
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
		console.log(row);
		$('#sms_templates_id').val(row.id);
		$('#type').text(row.type);
		// $('#variables').val(row.variables);
		// $('#message').val(row.message);
		
		/*Dropdown list for variables*/
		var VariableSource =
		{
			datatype: "json",
			datafields: [
			// { name: 'CompanyName' },
			{ name: 'variables' }
			],
			url: '<?php echo site_url('admin/sms_templates/get_variables_list'); ?>/'+ row.id,
			// async: true
		};
		var VariableDataAdapter = new $.jqx.dataAdapter(VariableSource);

		$(".variables").jqxDropDownList({
			source: VariableDataAdapter, 
			displayMember: "variables", 
			valueMember: "variables", 
			width: 200, 
			height: 18,
			autoDropDownHeight: true,
		});

		$('#messageboard').text(row.message);

		if(isNaN(row.skeleton)) {

			var obj = jQuery.parseJSON(row.skeleton);
			$.each(obj,function(i,v){
				if( i % 2 === 0 ) {
					$('#message-'+i).val(v);
				} 
				else {
					$('#variables-'+i).jqxDropDownList('selectItem',v);
				}
			});
		}

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
		url: '<?php echo site_url("admin/sms_templates/save_template"); ?>',
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