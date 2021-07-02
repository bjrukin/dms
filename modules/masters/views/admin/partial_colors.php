<div id="jqxPopupWindowColor">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="colors_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-colors', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "colors_id"/>
        	<input type = "hidden" name = "table_name" id = "colors_table_name" value = "mst_colors"/>
            <table class="form-table">
				<tr>
					<td><label for='colors_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='colors_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='color_code'><?php echo lang('code')?><span class='mandatory'>*</span></label></td>
					<td><input id='color_code' class='text_input' name='code'></td>
				</tr>
				<tr>
					<td><label for='colors_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='colors_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxColorSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxColorCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridColorToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridColorInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridColorFilterClear"><?php echo lang('general_clear'); ?></button>
	<a href="<?php echo site_url('masters/generate_excel')?>/mst_colors"><button type="button" class="btn btn-success btn-flat btn-xs">Export Excel</button></a>
</div>
<div id="jqxGridColor"></div>

<script language="javascript" type="text/javascript">

var mst_colors = function(){

	var colorsDataSource =
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
			{ name: 'code', type: 'string' },
			{ name: 'rank', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/masters/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data : { 
			'table_name' : 'mst_colors'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	colorsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridColor").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridColor").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridColor").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: colorsDataSource,
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
			container.append($('#jqxGridColorToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editColorRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("code"); ?>',datafield: 'code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridColor").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridColorFilterClear', function () { 
		$('#jqxGridColor').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridColorInsert', function () { 
		$('#colors_window_poptup_title').html('<?php echo lang("general_add"); ?> Colors');
		openPopupWindow('jqxPopupWindowColor', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowColor").jqxWindow({ 
        theme: theme,
        width: 400,
        maxWidth: 400,
        height: 250,  
        maxHeight: 250,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowColor").on('close', function () {
        reset_form_colors();
    });

    $("#jqxColorCancelButton").on('click', function () {
        reset_form_colors();
        $('#jqxPopupWindowColor').jqxWindow('close');
    });

    $('#form-colors').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#colors_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#colors_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#color_code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#color_code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#colors_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#colors_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_colors', field: 'name', value: val, id:$('input#colors_id').val()},
	                        success: function (result) {
	                            var result = eval('('+result+')');
	                            return commit(result.success);
	                        },
	                        error: function(result) {
	                            return commit(false);
	                        }
	                    });
					} else {
						return true;
					}
				}
			},

			{ input: '#color_code', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#color_code').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_colors', field: 'code', value: val, id:$('input#colors_id').val()},
	                        success: function (result) {
	                            var result = eval('('+result+')');
	                            return commit(result.success);
	                        },
	                        error: function(result) {
	                            return commit(false);
	                        }
	                    });
					} else {
						return true;
					}
				}
			},
        ]
    });

    $("#jqxColorSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveColorRecord();
                }
            };
        $('#form-colors').jqxValidator('validate', validationResult);

    });
};

function editColorRecord(index){
    var row =  $("#jqxGridColor").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#colors_id').val(row.id);
        $('#colors_name').val(row.name);
		$('#color_code').val(row.code);
		$('#colors_rank').jqxNumberInput('val', row.rank);
		
        $('#colors_window_poptup_title').html('<?php echo lang("general_edit"); ?> Colors');
        openPopupWindow('jqxPopupWindowColor', 'N/A');
    }
}

function saveColorRecord(){
    var data = $("#form-colors").serialize();
	
	$('#jqxPopupWindowColor').block({ 
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
        url: '<?php echo site_url("admin/masters/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_colors();
                $('#jqxGridColor').jqxGrid('updatebounddata');
                $('#jqxPopupWindowColor').jqxWindow('close');
            }
            $('#jqxPopupWindowColor').unblock();
        }
    });
}

function reset_form_colors(){
	$('#colors_id').val('');
    $('#form-colors')[0].reset();
}
</script>