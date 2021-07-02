<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('service_types'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('service_types'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridService_typeToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridService_typeInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridService_typeFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridService_type"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowService_type">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-service_types', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "service_types_id"/>
            <table class="form-table">
            	<tr>
            		<th><?php echo lang('service_type') ?></th>
            		<td><input type="text" name="name" id="service_name" class="form-control"></td>
            	</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxService_typeSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxService_typeCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var service_typesDataSource =
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
			{ name: 'rank', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/service_types/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	service_typesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridService_type").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridService_type").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridService_type").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: service_typesDataSource,
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
		selectionmode: 'singlecell',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridService_typeToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editService_typeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridService_type").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridService_typeFilterClear', function () { 
		$('#jqxGridService_type').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridService_typeInsert', function () { 
		openPopupWindow('jqxPopupWindowService_type', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowService_type").jqxWindow({ 
        theme: theme,
        width: '45%',
        height: '35%',  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowService_type").on('close', function () {
        reset_form_service_types();
    });

    $("#jqxService_typeCancelButton").on('click', function () {
        reset_form_service_types();
        $('#jqxPopupWindowService_type').jqxWindow('close');
    });

    /*$('#form-service_types').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
        ]
    });*/

    $("#jqxService_typeSubmitButton").on('click', function () {
        saveService_typeRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveService_typeRecord();
                }
            };
        $('#form-service_types').jqxValidator('validate', validationResult);
        */
    });
});

function editService_typeRecord(index){
    var row =  $("#jqxGridService_type").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#service_types_id').val(row.id);
  		$('#service_name').val(row.name);
        
        openPopupWindow('jqxPopupWindowService_type', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveService_typeRecord(){
    var data = $("#form-service_types").serialize();
	
	$('#jqxPopupWindowService_type').block({ 
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
        url: '<?php echo site_url("admin/service_types/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_service_types();
                $('#jqxGridService_type').jqxGrid('updatebounddata');
                $('#jqxPopupWindowService_type').jqxWindow('close');
            }
            $('#jqxPopupWindowService_type').unblock();
        }
    });
}

function reset_form_service_types(){
	$('#service_types_id').val('');
    $('#form-service_types')[0].reset();
}
</script>