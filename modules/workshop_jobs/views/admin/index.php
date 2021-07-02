<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('workshop_jobs'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('workshop_jobs'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridWorkshop_jobToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridWorkshop_jobInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridWorkshop_jobFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridWorkshop_job"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowWorkshop_job">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-workshop_jobs', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "workshop_jobs_id"/>
            <table class="form-table">
				<tr>
					<td><label for='workshop_jobs_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='workshop_jobs_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='description'><?php echo lang('description')?></label></td>
					<td><input id='description' class='text_input' name='description'></td>
				</tr>
				<tr>
					<td><label for='min_price'><?php echo lang('min_price')?></label></td>
					<td><div id='min_price' class='number_general' name='min_price'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxWorkshop_jobSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxWorkshop_jobCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var workshop_jobsDataSource =
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
			{ name: 'name', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'min_price', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/workshop_jobs/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	workshop_jobsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridWorkshop_job").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridWorkshop_job").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridWorkshop_job").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: workshop_jobsDataSource,
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
			container.append($('#jqxGridWorkshop_jobToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editWorkshop_jobRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 300,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("min_price"); ?>',datafield: 'min_price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridWorkshop_job").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridWorkshop_jobFilterClear', function () { 
		$('#jqxGridWorkshop_job').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridWorkshop_jobInsert', function () { 
		openPopupWindow('jqxPopupWindowWorkshop_job', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowWorkshop_job").jqxWindow({ 
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

    $("#jqxPopupWindowWorkshop_job").on('close', function () {
        reset_form_workshop_jobs();
    });

    $("#jqxWorkshop_jobCancelButton").on('click', function () {
        reset_form_workshop_jobs();
        $('#jqxPopupWindowWorkshop_job').jqxWindow('close');
    });

    /*$('#form-workshop_jobs').jqxValidator({
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

			{ input: '#workshop_jobs_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#workshop_jobs_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#description', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#description').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#min_price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#min_price').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxWorkshop_jobSubmitButton").on('click', function () {
        saveWorkshop_jobRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveWorkshop_jobRecord();
                }
            };
        $('#form-workshop_jobs').jqxValidator('validate', validationResult);
        */
    });
});

function editWorkshop_jobRecord(index){
    var row =  $("#jqxGridWorkshop_job").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#workshop_jobs_id').val(row.id);
		$('#workshop_jobs_name').val(row.name);
		$('#description').val(row.description);
		$('#min_price').jqxNumberInput('val', row.min_price);
		
        openPopupWindow('jqxPopupWindowWorkshop_job', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveWorkshop_jobRecord(){
    var data = $("#form-workshop_jobs").serialize();
	
	$('#jqxPopupWindowWorkshop_job').block({ 
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
        url: '<?php echo site_url("admin/workshop_jobs/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_workshop_jobs();
                $('#jqxGridWorkshop_job').jqxGrid('updatebounddata');
                $('#jqxPopupWindowWorkshop_job').jqxWindow('close');
            }
            $('#jqxPopupWindowWorkshop_job').unblock();
        }
    });
}

function reset_form_workshop_jobs(){
	$('#workshop_jobs_id').val('');
    $('#form-workshop_jobs')[0].reset();
}
</script>