<div id="jqxPopupWindowVehicle">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="vehicles_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-vehicles', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "vehicles_id"/>
        	<input type = "hidden" name = "table_name" id = "vehicles_table_name" value = "mst_vehicles"/>
            <table class="form-table">
            	<tr>
					<td><label for='firm_id'><?php echo lang('firm_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='firm_id' name='firm_id'></div></td>
				</tr>
				<tr>
					<td><label for='vehicles_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='vehicles_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='vehicles_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='vehicles_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxVehicleSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxVehicleCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridVehicleToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridVehicleInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridVehicleFilterClear"><?php echo lang('general_clear'); ?></button>
	<a href="<?php echo site_url('masters/generate_excel')?>/mst_vehicles"><button type="button" class="btn btn-success btn-flat btn-xs">Export Excel</button></a>
</div>
<div id="jqxGridVehicle"></div>

<script language="javascript" type="text/javascript">

var mst_vehicles = function(){

	//mst_firms
    masterDataSource.data = {table_name: 'mst_firms'};

    firmAdapter = new $.jqx.dataAdapter(masterDataSource);

    $("#firm_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: firmAdapter,
        displayMember: "name",
        valueMember: "id",
    });

	var vehiclesDataSource =
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
			{ name: 'firm_id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'rank', type: 'number' },
			{ name: 'firm_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/masters/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data : { 
			'table_name' : 'view_mst_vehicles'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	vehiclesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridVehicle").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridVehicle").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridVehicle").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: vehiclesDataSource,
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
			container.append($('#jqxGridVehicleToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editVehicleRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("firm_id"); ?>',datafield: 'firm_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridVehicle").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridVehicleFilterClear', function () { 
		$('#jqxGridVehicle').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridVehicleInsert', function () { 
		$('#vehicles_window_poptup_title').html('<?php echo lang("general_add"); ?> Vehicles');
		openPopupWindow('jqxPopupWindowVehicle', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowVehicle").jqxWindow({ 
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

    $("#jqxPopupWindowVehicle").on('close', function () {
        reset_form_vehicles();
    });

    $("#jqxVehicleCancelButton").on('click', function () {
        reset_form_vehicles();
        $('#jqxPopupWindowVehicle').jqxWindow('close');
    });

    $('#form-vehicles').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#vehicles_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicles_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicles_name', message: 'Already Exists', action: 'blur', 
				rule: function(input,commit) {
					val = $('#vehicles_name').val();
					if (val != '') {
						$.ajax({
	                        url: "<?php echo site_url('admin/masters/check_duplicate'); ?>",
	                        type: 'POST',
	                        data: {table_name: 'mst_vehicles', field: 'name', value: val, id:$('input#vehicles_id').val()},
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

			{ input: '#vehicles_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicles_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxVehicleSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveVehicleRecord();
                }
            };
        $('#form-vehicles').jqxValidator('validate', validationResult);

    });
};

function editVehicleRecord(index){
    var row =  $("#jqxGridVehicle").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#vehicles_id').val(row.id);
        $('#firm_id').jqxComboBox('val', row.firm_id);
        $('#vehicles_name').val(row.name);
		$('#vehicles_rank').jqxNumberInput('val', row.rank);
		
        $('#vehicles_window_poptup_title').html('<?php echo lang("general_edit"); ?> Vehicles');
        openPopupWindow('jqxPopupWindowVehicle', 'N/A');
    }
}

function saveVehicleRecord(){
    var data = $("#form-vehicles").serialize();
	
	$('#jqxPopupWindowVehicle').block({ 
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
                reset_form_vehicles();
                $('#jqxGridVehicle').jqxGrid('updatebounddata');
                $('#jqxPopupWindowVehicle').jqxWindow('close');
            }
            $('#jqxPopupWindowVehicle').unblock();
        }
    });
}

function reset_form_vehicles(){
	$('#vehicles_id').val('');
    $('#form-vehicles')[0].reset();

    $('#firm_id').jqxComboBox('clearSelection');

    $('#firm_id').jqxComboBox('selectIndex', '-1');
}
</script>