<div id="jqxPopupWindowRelation">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="relations_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-relations', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "relations_id"/>
        	<input type = "hidden" name = "table_name" id = "relations_table_name" value = "mst_relations"/>
            <table class="form-table">
				<tr>
					<td><label for='relations_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='relations_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='relations_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='relations_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxRelationSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxRelationCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridRelationToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridRelationInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridRelationFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridRelation"></div>

<script language="javascript" type="text/javascript">

var mst_relations = function(){

	var relationsDataSource =
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
		url: '<?php echo site_url("admin/masters/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data : { 
			'table_name' : 'mst_relations'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	relationsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridRelation").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridRelation").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridRelation").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: relationsDataSource,
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
			container.append($('#jqxGridRelationToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editRelationRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridRelation").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridRelationFilterClear', function () { 
		$('#jqxGridRelation').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridRelationInsert', function () { 
		$('#relations_window_poptup_title').html('<?php echo lang("general_add"); ?> Relations');
		openPopupWindow('jqxPopupWindowRelation', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowRelation").jqxWindow({ 
        theme: theme,
        width: 350,
        maxWidth: 350,
        height: 200,  
        maxHeight: 200,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowRelation").on('close', function () {
        reset_form_relations();
    });

    $("#jqxRelationCancelButton").on('click', function () {
        reset_form_relations();
        $('#jqxPopupWindowRelation').jqxWindow('close');
    });

    $('#form-relations').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#relations_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#relations_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#relations_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#relations_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_relations', field: 'name', value: val, id:$('input#relations_id').val()},
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

			{ input: '#relations_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#relations_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxRelationSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveRelationRecord();
                }
            };
        $('#form-relations').jqxValidator('validate', validationResult);

    });
};

function editRelationRecord(index){
    var row =  $("#jqxGridRelation").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#relations_id').val(row.id);
        $('#relations_name').val(row.name);
		$('#relations_rank').jqxNumberInput('val', row.rank);
		
        $('#relations_window_poptup_title').html('<?php echo lang("general_edit"); ?> Relations');
        openPopupWindow('jqxPopupWindowRelation', 'N/A');
    }
}

function saveRelationRecord(){
    var data = $("#form-relations").serialize();
	
	$('#jqxPopupWindowRelation').block({ 
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
                reset_form_relations();
                $('#jqxGridRelation').jqxGrid('updatebounddata');
                $('#jqxPopupWindowRelation').jqxWindow('close');
            }
            $('#jqxPopupWindowRelation').unblock();
        }
    });
}

function reset_form_relations(){
	$('#relations_id').val('');
    $('#form-relations')[0].reset();
}
</script>