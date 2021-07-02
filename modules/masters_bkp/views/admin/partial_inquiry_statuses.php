<div id="jqxPopupWindowInquiry_status">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="inquiry_statuses_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-inquiry_statuses', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "inquiry_statuses_id"/>
        	<input type = "hidden" name = "table_name" id = "inquiry_statuses_table_name" value = "mst_inquiry_statuses"/>
            <table class="form-table">
				<tr>
					<td><label for='inquiry_statuses_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='inquiry_statuses_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='inquiry_statuses_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='inquiry_statuses_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxInquiry_statusSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxInquiry_statusCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridInquiry_statusToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridInquiry_statusInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridInquiry_statusFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridInquiry_status"></div>

<script language="javascript" type="text/javascript">

var mst_inquiry_statuses = function(){

	var inquiry_statusesDataSource =
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
			'table_name' : 'mst_inquiry_statuses'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	inquiry_statusesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridInquiry_status").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridInquiry_status").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridInquiry_status").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: inquiry_statusesDataSource,
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
			container.append($('#jqxGridInquiry_statusToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editInquiry_statusRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
	    setTimeout(function() {$("#jqxGridInquiry_status").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridInquiry_statusFilterClear', function () { 
		$('#jqxGridInquiry_status').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridInquiry_statusInsert', function () { 
		$('#inquiry_statuses_window_poptup_title').html('<?php echo lang("general_add"); ?> Inquiry Statuses');
		openPopupWindow('jqxPopupWindowInquiry_status', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowInquiry_status").jqxWindow({ 
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

    $("#jqxPopupWindowInquiry_status").on('close', function () {
        reset_form_inquiry_statuses();
    });

    $("#jqxInquiry_statusCancelButton").on('click', function () {
        reset_form_inquiry_statuses();
        $('#jqxPopupWindowInquiry_status').jqxWindow('close');
    });

    $('#form-inquiry_statuses').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#inquiry_statuses_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#inquiry_statuses_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#inquiry_statuses_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#inquiry_statuses_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_inquiry_statuses', field: 'name', value: val, id:$('input#inquiry_statuses_id').val()},
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

			{ input: '#inquiry_statuses_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#inquiry_statuses_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxInquiry_statusSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveInquiry_statusRecord();
                }
            };
        $('#form-inquiry_statuses').jqxValidator('validate', validationResult);

    });
};

function editInquiry_statusRecord(index){
    var row =  $("#jqxGridInquiry_status").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#inquiry_statuses_id').val(row.id);
        $('#inquiry_statuses_name').val(row.name);
		$('#inquiry_statuses_rank').jqxNumberInput('val', row.rank);
		
        $('#inquiry_statuses_window_poptup_title').html('<?php echo lang("general_edit"); ?> Inquiry Statuses');
        openPopupWindow('jqxPopupWindowInquiry_status', 'N/A');
    }
}

function saveInquiry_statusRecord(){
    var data = $("#form-inquiry_statuses").serialize();
	
	$('#jqxPopupWindowInquiry_status').block({ 
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
                reset_form_inquiry_statuses();
                $('#jqxGridInquiry_status').jqxGrid('updatebounddata');
                $('#jqxPopupWindowInquiry_status').jqxWindow('close');
            }
            $('#jqxPopupWindowInquiry_status').unblock();
        }
    });
}

function reset_form_inquiry_statuses(){
	$('#inquiry_statuses_id').val('');
    $('#form-inquiry_statuses')[0].reset();
}
</script>