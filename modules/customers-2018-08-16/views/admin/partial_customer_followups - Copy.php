<style type="text/css">
	table.form-table td:nth-child(1){
		width:13%;
	}
	table.form-table td:nth-child(odd){
		width:13%;
	}
	table.form-table td:nth-child(even){
		width:20%;
	}
</style>

<div id="jqxPopupWindowCustomer_followup">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="customer_follups_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-customer_followups', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "customer_followups_id"/>
        	<input type = "hidden" name = "customer_id" id = "customer_followups_customer_id" value="<?php echo $customer_info->id;?>"/>
        	<input type = "hidden" name = "old_status_id" id = "old_status_id"/>
        	<fieldset>
        		<legend>Current Followup</legend>
	            <table class="form-table">
					<tr>
						<td class="executive-selection"><label for='executive_id'><?php echo lang('executive_id')?><span class='mandatory'>*</span></label></td>
						<td class="executive-selection"><div id='followup_executive_id' name='executive_id'></div></td>
						<td><label for='status_id'><?php echo lang('status_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='status_id' name='status_id'></div></td>
					</tr>
					<tr id='reason-row' style="display:none">
						<td><label for='reason_id'><?php echo lang('reason_id')?><span class='mandatory'>*</span></label></td>
						<td><div id='reason_id' name='reason_id'></div></td>
					</tr>
					<tr>
						<td><label for='followup_mode'><?php echo lang('followup_mode')?><span class='mandatory'>*</span></label></td>
						<td><div id='followup_mode' name='followup_mode'></div></td>
						<td><label for='followup_status'><?php echo lang('followup_status')?><span class='mandatory'>*</span></label></td>
						<td><div id='followup_status' name='followup_status'></div></td>
					</tr>
					<tr>
						<td>
							<label for='followup_date_en'><?php echo lang('followup_date_en')?><span class='mandatory'>*</span></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="followup_date_en" data-arg5="followup_date_np"> <?php echo lang('general_ad_to_bs')?></a>
						</td>
						<td><div id='followup_date_en' class='date_box' name='followup_date_en'></div></td>
						<td>
							<label for='followup_date_np'><?php echo lang('followup_date_np')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="followup_date_np" data-arg5="followup_date_en"> <?php echo lang('general_bs_to_ad')?></a>

						</td>
						<td><input id='followup_date_np' class='text_input' name='followup_date_np'></td>
					</tr>
					<tr>
						<td><label for='followup_notes'><?php echo lang('followup_notes')?></label></td>
						<td colspan="3"><textarea id='followup_notes' class='text_area' name='followup_notes'></textarea></td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
        		<legend>Next Followup</legend>
	            <table class="form-table">
					<tr>
						<td><label for='next_followup'><?php echo lang('next_followup')?></label><input id="next_followup"  type="checkbox" name="next_followup" value="1"/></td>
					</tr>
					<tr id="next_followup_details" style="display:none">
						<td>
							<label for='next_followup_date_en'><?php echo lang('next_followup_date_en')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="next_followup_date_en" data-arg5="next_followup_date_np"> <?php echo lang('general_ad_to_bs')?></a>
						</td>
						<td><div id='next_followup_date_en' class='date_box' name='next_followup_date_en'></div></td>
						<td>
							<label for='next_followup_date_np'><?php echo lang('next_followup_date_np')?></label>
							<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer_followup" data-arg4="next_followup_date_np" data-arg5="next_followup_date_en"> <?php echo lang('general_bs_to_ad')?></a>
						</td>
						<td><input id='next_followup_date_np' class='text_input' name='next_followup_date_np'></td>
					</tr>
				</table>
			</fieldset>
            <table class="form-table">
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomer_followupSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomer_followupCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
	          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridCustomer_followupToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCustomer_followupInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomer_followupFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridCustomer_followup"></div>

<script language="javascript" type="text/javascript">

var customer_followups = function(){

	$('#next_followup_date_np').val('');
	$('#next_followup_date_en').jqxDateTimeInput({ value: null });

	$('#next_followup').change(function(){
  		if (this.checked) {
		    $('#next_followup_details').show();
		} else {
			$('#next_followup_details').hide();
			$('#next_followup_date_np').val('');
			$('#next_followup_date_en').jqxDateTimeInput({ value: null });
		 }                   
	});

	$('.convert-date').on('click', function(){
		var arg1 = this.getAttribute("data-arg1"),
			arg2 = this.getAttribute("data-arg2"),
			arg3 = this.getAttribute("data-arg3"),
			arg4 = this.getAttribute("data-arg4"),
			arg5 = this.getAttribute("data-arg5");

			console.log(arg1,arg2,arg3,arg4,arg5);
			window[arg1](arg2,arg3,arg4,arg5);
	});

	//followup_mode
	$("#followup_mode").jqxComboBox({
    	theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: array_followup_modes,
        displayMember: "name",
        valueMember: "id",
		selectedIndex:0
    });

    //followup_status
	$("#followup_status").jqxComboBox({
    	theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: array_followup_status,
        displayMember: "name",
        valueMember: "id",
		selectedIndex:0
    });

	//mst_inquiry_statuses
    $("#status_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: array_inquiry_statuses,
        displayMember: "name",
        valueMember: "id",
    });

    //reason
    $("#status_id").select('bind', function (event) {
	    status_id = $("#status_id").jqxComboBox('val');
	    
	     if (status_id > 3) {
			$('#reason-row').show();
			//mst_reasons
		    masterDataSource.data = {table_name: 'mst_reasons'};

		    reasonDataAdapter = new $.jqx.dataAdapter(masterDataSource);

		    $("#reason_id").jqxComboBox({
		        theme: theme,
		        width: 195,
		        height: 25,
		        selectionMode: 'dropDownList',
		        autoComplete: true,
		        searchMode: 'containsignorecase',
		        source: reasonDataAdapter,
		        displayMember: "name",
		        valueMember: "id",
		    });
		} else {
			$('#reason-row').hide();
		}
	});

	
	//executive
    var executiveDataSource  = {
        url : '<?php echo site_url("admin/customers/get_executives_combo_json"); ?>',
        datatype: 'json',
        datafields: [
            { name: 'id', type: 'number' },
            { name: 'name', type: 'string' },
        ],
        data: {
            dealer_id: '<?php echo $customer_info->dealer_id;?>'
        },
        async: false,
        cache: true
    }

    executiveDataAdapter = new $.jqx.dataAdapter(executiveDataSource);
    $("#followup_executive_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: executiveDataAdapter,
        displayMember: "name",
        valueMember: "id",
    });

	var customer_followupsDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'executive_id', type: 'number' },
			{ name: 'status_id', type: 'number' },
			{ name: 'followup_date_en', type: 'date' },
			{ name: 'followup_date_np', type: 'string' },
			{ name: 'followup_mode', type: 'string' },
			{ name: 'followup_status', type: 'string' },
			{ name: 'followup_notes', type: 'string' },
			{ name: 'next_followup', type: 'bool' },
			{ name: 'next_followup_date_en', type: 'date' },
			{ name: 'next_followup_date_np', type: 'string' },
			{ name: 'status_name', type: 'string'},
			{ name: 'executive_name', type: 'string'},
			
        ],
		url: '<?php echo site_url("admin/customers/customer_followups_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data: {
			customer_id: '<?php echo $customer_info->id;?>'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	customer_followupsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCustomer_followup").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCustomer_followup").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCustomer_followup").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: customer_followupsDataSource,
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
			container.append($('#jqxGridCustomer_followupToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					var e = '<i class="fa fa-edit" style="color:#CCC"></i>';

					if (columnproperties.followup_status != 'Completed'){
						e = '<a href="javascript:void(0)" onclick="editCustomer_followupRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					}
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			// { text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("followup_date_en"); ?>',datafield: 'followup_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("executive_id"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("followup_mode"); ?>',datafield: 'followup_mode',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("followup_status"); ?>',datafield: 'followup_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("status_id"); ?>',datafield: 'status_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			//{ text: '<?php echo lang("followup_date_np"); ?>',datafield: 'followup_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("followup_notes"); ?>',datafield: 'followup_notes', filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("next_followup"); ?>', datafield: 'next_followup', width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox', filtertype: 'bool' },
			// { text: '<?php echo lang("next_followup_date_en"); ?>',datafield: 'next_followup_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("next_followup_date_np"); ?>',datafield: 'next_followup_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCustomer_followup").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCustomer_followupFilterClear', function () { 
		$('#jqxGridCustomer_followup').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCustomer_followupInsert', function () { 
		$('#customer_follups_window_poptup_title').html('<?php echo lang("general_add")  . "&nbsp;" . lang("customer_followups")  ?>');
		<?php if( !control('Executive Selection', FALSE)):?>
		$('.executive-selection').hide();
		$('#followup_executive_id').jqxComboBox('val','<?php echo $this->session->userdata("employee")["employee_id"]; ?>');
		<?php endif;?>
		openPopupWindow('jqxPopupWindowCustomer_followup', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowCustomer_followup").jqxWindow({ 
        theme: theme,
        width: 900,
        maxWidth: 900,
        height: 550,  
        maxHeight: 550,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowCustomer_followup").on('close', function () {
        reset_form_customer_followups();
    });

    $("#jqxCustomer_followupCancelButton").on('click', function () {
        reset_form_customer_followups();
        $('#jqxPopupWindowCustomer_followup').jqxWindow('close');
    });

    $('#form-customer_followups').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			

			{ input: '#followup_executive_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#followup_executive_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#status_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#status_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#reason_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#status_id').jqxComboBox('val');
					if (val > 3) {
						val = $('#reason_id').val();
						return (val == '' || val == null || val == 0) ? false: true;
					} else {
						return true;
					}
				}
			},

			{ input: '#followup_mode', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#followup_mode').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#followup_status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#followup_status').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#followup_date_en', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#followup_date_en').jqxDateTimeInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#next_followup_date_en', message: 'Required', action: 'blur', 
				rule: function(input) {
					if ($('#next_followup').is(":checked") == true) {
						val = $('#next_followup_date_en').jqxDateTimeInput('val');
						return (val == '' || val == null || val == 0) ? false: true;
					} else {
						return true;
					}
				}
			},
			{ input: '#next_followup_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					if ($('#next_followup').is(":checked") == true) {
						val = $('#next_followup_date_np').val();
						return (val == '' || val == null || val == 0) ? false: true;
					} else {
						return true;
					}
				}
			},

        ]
    });

    $("#jqxCustomer_followupSubmitButton").on('click', function () {
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCustomer_followupRecord();
                }
            };
        $('#form-customer_followups').jqxValidator('validate', validationResult);
    });
};

function editCustomer_followupRecord(index){
    var row =  $("#jqxGridCustomer_followup").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#customer_followups_id').val(row.id);
		$('#followup_executive_id').jqxComboBox('val', row.executive_id);
		$('#status_id').jqxComboBox('val', row.status_id);
		$('#old_status_id').val(row.status_id);
		$('#followup_date_en').jqxDateTimeInput('setDate', row.followup_date_en);
		$('#followup_date_np').val(row.followup_date_np);
		$('#followup_mode').jqxComboBox('val', row.followup_mode);
		$('#followup_status').jqxComboBox('val', row.followup_status);
		$('#followup_notes').val(row.followup_notes);
		// $('#next_followup').val(row.next_followup);
		// $('#next_followup_date_en').jqxDateTimeInput('setDate', row.next_followup_date_en);
		// $('#next_followup_date_np').val(row.next_followup_date_np);

		if (row.status_id == 4)
		{
			$('#reason').html('<label>Reason</label>');
		}

		<?php if( !control('Executive Selection', FALSE)):?>
		$('.executive-selection').hide();
		<?php endif;?>
		
		$('#customer_follups_window_poptup_title').html('<?php echo lang("general_edit")  . "&nbsp;" . lang("customer_followups")  ?>');
        openPopupWindow('jqxPopupWindowCustomer_followup', 'N/A');
    }
}

function saveCustomer_followupRecord(){
    var data = $("#form-customer_followups").serialize();
	
	$('#jqxPopupWindowCustomer_followup').block({ 
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
        url: '<?php echo site_url("admin/customers/save_customer_followup"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_customer_followups();
                $('#jqxGridCustomer_followup').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCustomer_followup').jqxWindow('close');
            }
            $('#jqxPopupWindowCustomer_followup').unblock();
        }
    });
}

function reset_form_customer_followups(){
	$('#customer_followups_id').val('');
    $('#form-customer_followups')[0].reset();

    $('#followup_executive_id').jqxComboBox('clearSelection');
	$('#status_id').jqxComboBox('clearSelection');
	$('#followup_mode').jqxComboBox('clearSelection');
	$('#followup_status').jqxComboBox('clearSelection');

    $('#followup_executive_id').jqxComboBox('selectIndex', '-1');
	$('#status_id').jqxComboBox('selectIndex', '-1');
	$('#followup_mode').jqxComboBox('selectIndex', '-1');
	$('#followup_status').jqxComboBox('selectIndex', '-1');

	$('#next_followup_details').hide();
	$('#next_followup_date_np').val('');
	$('#next_followup_date_en').jqxDateTimeInput({ value: null });
	$('#followup_date_en').jqxDateTimeInput({ value: null });

	$('#next_followup').val('1');

	$('#reason-row').hide();
}
</script>