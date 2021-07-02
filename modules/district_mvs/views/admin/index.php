<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('district_mvs'); ?></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDistrict_mvToolbar' class='grid-toolbar'>
					<?php /*<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDistrict_mvInsert"><?php echo lang('create'); ?></button>*/?>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDistrict_mvFilterClear"><?php echo lang('clear'); ?></button>
				</div>
				<div id="jqxGridDistrict_mv"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDistrict_mv">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-district_mvs', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "id"/>
            <table class="form-table">
				<tr>
					<td><label for='code'><?php echo lang('code')?></label></td>
					<td><input id='code' class='text_input' name='code'></td>
				</tr>
				
				<tr>
					<td><label for='parent_id'><?php echo lang('parent_id')?></label></td>
					<td><div id='parent_id' class='combo_box' name='parent_id'></div></td>
				</tr>

				<tr>
					<td><label for='name'><?php echo lang('name')?></label></td>
					<td><input id='name' class='text_input' name='name'></td>
				</tr>
				
				<tr>
					<td><label for='type'><?php echo lang('type')?></label></td>
					<td><input id='type' class='text_input' name='type'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDistrict_mvSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDistrict_mvCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
	districtsDataSource = {
		url : "<?php echo site_url('admin/district_mvs/get_districts_combo_json');?>",
        datatype: 'json',
        datafields: [ 
            { name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
        ],
        cache: true,
        async: false
	};

	var districtsDataAdapter = new $.jqx.dataAdapter(districtsDataSource);

	$("#parent_id").jqxComboBox({
		theme: theme, 
    	width: 195, 
		height: 25, 
		autoComplete: true,
		selectionMode: 'dropDownList', 
		source: districtsDataAdapter, 
		autoComplete: true, 
		displayMember: "name", 
		valueMember: "id", 
	});

	var district_mvsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'code', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'parent_id', type: 'number' },
			{ name: 'parent_code', type: 'string' },
			{ name: 'parent_name', type: 'string' },
			{ name: 'type', type: 'string' },
			{ name: 'boundary_coordinate', type: 'string' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'date' },
			{ name: 'updated_at', type: 'date' },
			{ name: 'delete_at', type: 'date' },
			
        ],
		url: '<?php echo site_url("admin/district_mvs/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	district_mvsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDistrict_mv").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDistrict_mv").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDistrict_mv").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: district_mvsDataSource,
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
			container.append($('#jqxGridDistrict_mvToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDistrict_mvRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("code"); ?>',datafield: 'code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("parent_id"); ?>',datafield: 'parent_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("type"); ?>',datafield: 'type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDistrict_mv").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDistrict_mvFilterClear', function () { 
		$('#jqxGridDistrict_mv').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDistrict_mvInsert', function () { 
		openPopupWindow('jqxPopupWindowDistrict_mv', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDistrict_mv").jqxWindow({ 
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

    $("#jqxPopupWindowDistrict_mv").on('close', function () {
        $('#id').val('');
        $('#form-district_mvs')[0].reset();
    });

    $("#jqxDistrict_mvCancelButton").on('click', function () {
        $('#id').val('');
        $('#form-district_mvs')[0].reset();
        $('#jqxPopupWindowDistrict_mv').jqxWindow('close');
    });

    /*$('#form-district_mvs').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#parent_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#parent_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#type', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#type').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDistrict_mvSubmitButton").on('click', function () {
        saveDistrict_mvRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDistrict_mvRecord();
                }
            };
        $('#form-district_mvs').jqxValidator('validate', validationResult);
        */
    });
});

function editDistrict_mvRecord(index){
    var row =  $("#jqxGridDistrict_mv").jqxGrid('getrowdata', index);
  	if (row) {
        $('#id').val(row.id);
		$('#code').val(row.code);
		$('#name').val(row.name);
		$('#parent_id').jqxComboBox('val', row.parent_id);
		$('#type').val(row.type);
		
        openPopupWindow('jqxPopupWindowDistrict_mv', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDistrict_mvRecord(){
    var data = $("#form-district_mvs").serialize();
	
    $('#jqxPopupWindowDistrict_mv').block({ 
        message: '<span>Processing your request. Please be patient.</span>',
        css: { 
            height                  : '90%',
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
        url: '<?php echo site_url("admin/district_mvs/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                $('#id').val('');
                $('#form-district_mvs')[0].reset();
                $('#jqxGridDistrict_mv').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDistrict_mv').jqxWindow('close');
            }
            $('#jqxPopupWindowDistrict_mv').unblock();
        }
    });
}
</script>