<div id="jqxPopupWindowWalkin_source">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="walkin_sources_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-walkin_sources', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "walkin_sources_id"/>
        	<input type = "hidden" name = "table_name" id = "walkin_sources_table_name" value = "mst_walkin_sources"/>
            <table class="form-table">
				<tr>
					<td><label for='walkin_sources_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='walkin_sources_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='walkin_sources_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='walkin_sources_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxWalkin_sourceSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxWalkin_sourceCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridWalkin_sourceToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridWalkin_sourceInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridWalkin_sourceFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridWalkin_source"></div>

<script language="javascript" type="text/javascript">

var mst_walkin_sources = function(){

	var walkin_sourcesDataSource =
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
			'table_name' : 'mst_walkin_sources'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	walkin_sourcesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridWalkin_source").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridWalkin_source").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridWalkin_source").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: walkin_sourcesDataSource,
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
			container.append($('#jqxGridWalkin_sourceToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editWalkin_sourceRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
	    setTimeout(function() {$("#jqxGridWalkin_source").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridWalkin_sourceFilterClear', function () { 
		$('#jqxGridWalkin_source').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridWalkin_sourceInsert', function () { 
		$('#walkin_sources_window_poptup_title').html('<?php echo lang("general_add"); ?> Walkin Sources');
		openPopupWindow('jqxPopupWindowWalkin_source', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowWalkin_source").jqxWindow({ 
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

    $("#jqxPopupWindowWalkin_source").on('close', function () {
        reset_form_walkin_sources();
    });

    $("#jqxWalkin_sourceCancelButton").on('click', function () {
        reset_form_walkin_sources();
        $('#jqxPopupWindowWalkin_source').jqxWindow('close');
    });

    $('#form-walkin_sources').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#walkin_sources_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#walkin_sources_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#walkin_sources_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#walkin_sources_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_walkin_sources', field: 'name', value: val, id:$('input#walkin_sources_id').val()},
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

			{ input: '#walkin_sources_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#walkin_sources_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxWalkin_sourceSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveWalkin_sourceRecord();
                }
            };
        $('#form-walkin_sources').jqxValidator('validate', validationResult);

    });
};

function editWalkin_sourceRecord(index){
    var row =  $("#jqxGridWalkin_source").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#walkin_sources_id').val(row.id);
        $('#walkin_sources_name').val(row.name);
		$('#walkin_sources_rank').jqxNumberInput('val', row.rank);
		
        $('#walkin_sources_window_poptup_title').html('<?php echo lang("general_edit"); ?> Walkin Sources');
        openPopupWindow('jqxPopupWindowWalkin_source', 'N/A');
    }
}

function saveWalkin_sourceRecord(){
    var data = $("#form-walkin_sources").serialize();
	
	$('#jqxPopupWindowWalkin_source').block({ 
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
                reset_form_walkin_sources();
                $('#jqxGridWalkin_source').jqxGrid('updatebounddata');
                $('#jqxPopupWindowWalkin_source').jqxWindow('close');
            }
            $('#jqxPopupWindowWalkin_source').unblock();
        }
    });
}

function reset_form_walkin_sources(){
	$('#walkin_sources_id').val('');
    $('#form-walkin_sources')[0].reset();
}
</script>