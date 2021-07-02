<div id="jqxPopupWindowEmployee_contact">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="employee_contacts_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-employee_contacts', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "employee_contact_id"/>
        	<input type = "hidden" name = "employee_id" id = "employee_contacts_employee_id" value="<?php echo $employee_info->id;?>"/>
            <table class="form-table">
				<tr>
					<td><label for='employee_contacts_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='employee_contacts_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='relation_id'><?php echo lang('relation_id')?></label></td>
					<td><div id='relation_id' name='relation_id'></div></td>
				</tr>
				<tr>
					<td><label for='home'><?php echo lang('home')?></label></td>
					<td><input id='home' class='text_input' name='home'></td>
				</tr>
				<tr>
					<td><label for='work'><?php echo lang('work')?></label></td>
					<td><input id='work' class='text_input' name='work'></td>
				</tr>
				<tr>
					<td><label for='mobile'><?php echo lang('mobile')?></label></td>
					<td><input id='mobile' class='text_input' name='mobile'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxEmployee_contactSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxEmployee_contactCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridEmployee_contactToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridEmployee_contactInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridEmployee_contactFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridEmployee_contact"></div>

<script language="javascript" type="text/javascript">

var employee_contacts = function() {


	//mst_relations
    masterDataSource.data = {table_name: 'mst_relations'};

    relationsDataAdapter = new $.jqx.dataAdapter(masterDataSource);

    $("#relation_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: relationsDataAdapter,
        displayMember: "name",
        valueMember: "id",
    });

	var employee_contactsDataSource =
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
			{ name: 'employee_id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'relation_id', type: 'number' },
			{ name: 'home', type: 'string' },
			{ name: 'work', type: 'string' },
			{ name: 'mobile', type: 'string' },
			{ name: 'relation_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/employees/employee_contacts_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data : {
			employee_id: '<?php echo $employee_info->id; ?>'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	employee_contactsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridEmployee_contact").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridEmployee_contact").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridEmployee_contact").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: employee_contactsDataSource,
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
			container.append($('#jqxGridEmployee_contactToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editEmployee_contactRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("relation_id"); ?>',datafield: 'relation_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("home"); ?>',datafield: 'home',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("work"); ?>',datafield: 'work',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mobile"); ?>',datafield: 'mobile',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridEmployee_contact").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridEmployee_contactFilterClear', function () { 
		$('#jqxGridEmployee_contact').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridEmployee_contactInsert', function () { 
		$('#employee_contacts_window_poptup_title').html('<?php echo lang("general_add")  . "&nbsp;" .  lang("employee_contacts"); ?>');
		openPopupWindow('jqxPopupWindowEmployee_contact', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowEmployee_contact").jqxWindow({ 
        theme: theme,
        width: 450,
        maxWidth: 450,
        height: 350,  
        maxHeight: 350,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowEmployee_contact").on('close', function () {
        reset_form_employee_contacts();
    });

    $("#jqxEmployee_contactCancelButton").on('click', function () {
        reset_form_employee_contacts();
        $('#jqxPopupWindowEmployee_contact').jqxWindow('close');
    });

    $('#form-employee_contacts').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#employee_contacts_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#employee_contacts_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#relation_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#relation_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#home', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#home').val();
					return (val.match(phone_pattern)) ? true : false;
				}
			},

			{ input: '#work', message: 'Invalid Format.', action: 'blur', 
				rule: function(input) {
					val = $('#work').val();
					return (val.match(phone_pattern)) ? true : false;
				}
			},

			{ input: '#mobile', message: 'Invalid Format.', action: 'blur', 
				rule: function(input) {
					val = $('#mobile').val();
					return (val.match(mobile_pattern)) ? true : false;
				}
			},

        ]
    });

    $("#jqxEmployee_contactSubmitButton").on('click', function () {
        var validationResult = function (isValid) {
                if (isValid) {
                   saveEmployee_contactRecord();
                }
            };
        $('#form-employee_contacts').jqxValidator('validate', validationResult);
    });
};

function editEmployee_contactRecord(index){
    var row =  $("#jqxGridEmployee_contact").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#employee_contact_id').val(row.id);
		$('#employee_contacts_employee_id').val(row.employee_id);
		$('#employee_contacts_name').val(row.name);
		$('#relation_id').jqxComboBox('val', row.relation_id);
		$('#home').val(row.home);
		$('#work').val(row.work);
		$('#mobile').val(row.mobile);

		$('#employee_contacts_window_poptup_title').html('<?php echo lang("general_edit")  . "&nbsp;" .  lang("employee_contacts"); ?>');
		
        openPopupWindow('jqxPopupWindowEmployee_contact', 'N/A');
    }
}

function saveEmployee_contactRecord(){
    var data = $("#form-employee_contacts").serialize();
	
	$('#jqxPopupWindowEmployee_contact').block({ 
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
        url: '<?php echo site_url("admin/employees/save_employee_contact"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_employee_contacts();
                $('#jqxGridEmployee_contact').jqxGrid('updatebounddata');
                $('#jqxPopupWindowEmployee_contact').jqxWindow('close');
            }
            $('#jqxPopupWindowEmployee_contact').unblock();
        }
    });
}

function reset_form_employee_contacts(){
	$('#employee_contacts_id').val('');
    $('#form-employee_contacts')[0].reset();

    $('#relation_id').jqxComboBox('clearSelection');

    $('#relation_id').jqxComboBox('selectIndex', '-1');
}
</script>