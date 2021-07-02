<div id="jqxPopupWindowCustomer_type">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="customer_types_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-customer_types', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "customer_types_id"/>
        	<input type = "hidden" name = "table_name" id = "customer_types_table_name" value = "mst_customer_types"/>
            <table class="form-table">
				<tr>
					<td><label for='customer_types_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='customer_types_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='customer_types_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='customer_types_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomer_typeSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomer_typeCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridCustomer_typeToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCustomer_typeInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomer_typeFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridCustomer_type"></div>

<script language="javascript" type="text/javascript">

var mst_customer_types = function(){

	var customer_typesDataSource =
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
			'table_name' : 'mst_customer_types'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	customer_typesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCustomer_type").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCustomer_type").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCustomer_type").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: customer_typesDataSource,
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
			container.append($('#jqxGridCustomer_typeToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editCustomer_typeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
	    setTimeout(function() {$("#jqxGridCustomer_type").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCustomer_typeFilterClear', function () { 
		$('#jqxGridCustomer_type').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCustomer_typeInsert', function () { 
		$('#customer_types_window_poptup_title').html('<?php echo lang("general_add"); ?> Customer Types');
		openPopupWindow('jqxPopupWindowCustomer_type', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowCustomer_type").jqxWindow({ 
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

    $("#jqxPopupWindowCustomer_type").on('close', function () {
        reset_form_customer_types();
    });

    $("#jqxCustomer_typeCancelButton").on('click', function () {
        reset_form_customer_types();
        $('#jqxPopupWindowCustomer_type').jqxWindow('close');
    });

    $('#form-customer_types').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#customer_types_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_types_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#customer_types_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#customer_types_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_customer_types', field: 'name', value: val, id:$('input#customer_types_id').val()},
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

			{ input: '#customer_types_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_types_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxCustomer_typeSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCustomer_typeRecord();
                }
            };
        $('#form-customer_types').jqxValidator('validate', validationResult);

    });
};

function editCustomer_typeRecord(index){
    var row =  $("#jqxGridCustomer_type").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#customer_types_id').val(row.id);
        $('#customer_types_name').val(row.name);
		$('#customer_types_rank').jqxNumberInput('val', row.rank);
		
        $('#customer_types_window_poptup_title').html('<?php echo lang("general_edit"); ?> Customer Types');
        openPopupWindow('jqxPopupWindowCustomer_type', 'N/A');
    }
}

function saveCustomer_typeRecord(){
    var data = $("#form-customer_types").serialize();
	
	$('#jqxPopupWindowCustomer_type').block({ 
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
                reset_form_customer_types();
                $('#jqxGridCustomer_type').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCustomer_type').jqxWindow('close');
            }
            $('#jqxPopupWindowCustomer_type').unblock();
        }
    });
}

function reset_form_customer_types(){
	$('#customer_types_id').val('');
    $('#form-customer_types')[0].reset();
}
</script>