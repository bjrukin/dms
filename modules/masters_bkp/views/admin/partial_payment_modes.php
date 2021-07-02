<div id="jqxPopupWindowPayment_mode">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="payment_modes_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-payment_modes', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "payment_modes_id"/>
        	<input type = "hidden" name = "table_name" id = "payment_modes_table_name" value = "mst_payment_modes"/>
            <table class="form-table">
				<tr>
					<td><label for='payment_modes_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='payment_modes_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='payment_modes_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='payment_modes_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPayment_modeSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPayment_modeCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridPayment_modeToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPayment_modeInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPayment_modeFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridPayment_mode"></div>

<script language="javascript" type="text/javascript">

var mst_payment_modes = function(){

	var payment_modesDataSource =
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
			'table_name' : 'mst_payment_modes'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	payment_modesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPayment_mode").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPayment_mode").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPayment_mode").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: payment_modesDataSource,
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
			container.append($('#jqxGridPayment_modeToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editPayment_modeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
	    setTimeout(function() {$("#jqxGridPayment_mode").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPayment_modeFilterClear', function () { 
		$('#jqxGridPayment_mode').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPayment_modeInsert', function () { 
		$('#payment_modes_window_poptup_title').html('<?php echo lang("general_add"); ?> Payment Modes');
		openPopupWindow('jqxPopupWindowPayment_mode', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowPayment_mode").jqxWindow({ 
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

    $("#jqxPopupWindowPayment_mode").on('close', function () {
        reset_form_payment_modes();
    });

    $("#jqxPayment_modeCancelButton").on('click', function () {
        reset_form_payment_modes();
        $('#jqxPopupWindowPayment_mode').jqxWindow('close');
    });

    $('#form-payment_modes').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#payment_modes_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#payment_modes_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#payment_modes_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#payment_modes_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_payment_modes', field: 'name', value: val, id:$('input#payment_modes_id').val()},
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

			{ input: '#payment_modes_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#payment_modes_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxPayment_modeSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   savePayment_modeRecord();
                }
            };
        $('#form-payment_modes').jqxValidator('validate', validationResult);

    });
};

function editPayment_modeRecord(index){
    var row =  $("#jqxGridPayment_mode").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#payment_modes_id').val(row.id);
        $('#payment_modes_name').val(row.name);
		$('#payment_modes_rank').jqxNumberInput('val', row.rank);
		
        $('#payment_modes_window_poptup_title').html('<?php echo lang("general_edit"); ?> Payment Modes');
        openPopupWindow('jqxPopupWindowPayment_mode', 'N/A');
    }
}

function savePayment_modeRecord(){
    var data = $("#form-payment_modes").serialize();
	
	$('#jqxPopupWindowPayment_mode').block({ 
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
                reset_form_payment_modes();
                $('#jqxGridPayment_mode').jqxGrid('updatebounddata');
                $('#jqxPopupWindowPayment_mode').jqxWindow('close');
            }
            $('#jqxPopupWindowPayment_mode').unblock();
        }
    });
}

function reset_form_payment_modes(){
	$('#payment_modes_id').val('');
    $('#form-payment_modes')[0].reset();
}
</script>