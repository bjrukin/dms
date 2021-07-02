<div id="jqxPopupWindowBank">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="banks_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-banks', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "banks_id"/>
        	<input type = "hidden" name = "table_name" id = "banks_table_name" value = "mst_banks"/>
            <table class="form-table">
				<tr>
					<td><label for='banks_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='banks_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='bank_code'><?php echo lang('code')?><span class='mandatory'>*</span></label></td>
					<td><input id='bank_code' class='text_input' name='code'></td>
				</tr>
				<tr>
					<td><label for='banks_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='banks_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxBankSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxBankCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridBankToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridBankInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridBankFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridBank"></div>

<script language="javascript" type="text/javascript">

var mst_banks = function(){

	var banksDataSource =
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
			'table_name' : 'mst_banks'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	banksDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridBank").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridBank").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridBank").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: banksDataSource,
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
			container.append($('#jqxGridBankToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editBankRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
	    setTimeout(function() {$("#jqxGridBank").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridBankFilterClear', function () { 
		$('#jqxGridBank').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridBankInsert', function () { 
		$('#banks_window_poptup_title').html('<?php echo lang("general_add"); ?> Banks');
		openPopupWindow('jqxPopupWindowBank', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowBank").jqxWindow({ 
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

    $("#jqxPopupWindowBank").on('close', function () {
        reset_form_banks();
    });

    $("#jqxBankCancelButton").on('click', function () {
        reset_form_banks();
        $('#jqxPopupWindowBank').jqxWindow('close');
    });

    $('#form-banks').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#banks_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#banks_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bank_code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bank_code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#banks_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#banks_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_banks', field: 'name', value: val, id:$('input#banks_id').val()},
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

			{ input: '#banks_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#banks_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bank_code', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#bank_code').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_banks', field: 'code', value: val, id:$('input#banks_id').val()},
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

    $("#jqxBankSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveBankRecord();
                }
            };
        $('#form-banks').jqxValidator('validate', validationResult);

    });
};

function editBankRecord(index){
    var row =  $("#jqxGridBank").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#banks_id').val(row.id);
        $('#banks_name').val(row.name);
        $('#bank_code').val(row.code);
		$('#banks_rank').jqxNumberInput('val', row.rank);
		
        $('#banks_window_poptup_title').html('<?php echo lang("general_edit"); ?> Banks');
        openPopupWindow('jqxPopupWindowBank', 'N/A');
    }
}

function saveBankRecord(){
    var data = $("#form-banks").serialize();
	
	$('#jqxPopupWindowBank').block({ 
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
                reset_form_banks();
                $('#jqxGridBank').jqxGrid('updatebounddata');
                $('#jqxPopupWindowBank').jqxWindow('close');
            }
            $('#jqxPopupWindowBank').unblock();
        }
    });
}

function reset_form_banks(){
	$('#banks_id').val('');
    $('#form-banks')[0].reset();
}
</script>