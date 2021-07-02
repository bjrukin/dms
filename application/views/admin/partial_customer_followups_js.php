<style>
.cls-yellow { background-color: #F2E477; }
.cls-red { background-color: #F56969; }
}
</style>

<script>
var customer_followups = function(){

	var cellclassname =  function (row, column, value, data) {
		
		var d = data.followup_date_en;

		if (d.compareTo(Date.parse('today')) >= 0 ) {
			return;
		} else if ( d.compareTo(Date.parse('yesterday')) == 0) {
			if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
				return 'cls-yellow';
			}
		} else {
			if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
				return 'cls-red';
			}
		}

	};

	$('#followup_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
	$('#next_followup_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});

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
	
	//executive
    var executiveDataSource  = {
        url : '<?php echo site_url("admin/customers/get_executives_combo_json"); ?>',
        datatype: 'json',
        datafields: [
            { name: 'id', type: 'number' },
            { name: 'name', type: 'string' },
        ],
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
			{ name: 'id', type: 'number'},
			{ name: 'created_by', type: 'number'},
			{ name: 'updated_by', type: 'number'},
			{ name: 'deleted_by', type: 'number'},
			{ name: 'created_at', type: 'date'},
			{ name: 'updated_at', type: 'date'},
			{ name: 'deleted_at', type: 'date'},
			{ name: 'customer_id', type: 'number'},
			{ name: 'executive_id', type: 'number'},
			{ name: 'followup_date_en', type: 'date'},
			{ name: 'followup_date_np', type: 'string'},
			{ name: 'followup_mode', type: 'string'},
			{ name: 'followup_status', type: 'string'},
			{ name: 'followup_notes', type: 'string'},
			{ name: 'next_followup', type: 'string'},
			{ name: 'next_followup_date_en', type: 'date'},
			{ name: 'next_followup_date_np', type: 'string'},
			{ name: 'inquiry_no', type: 'string'},
			{ name: 'inquiry_date_en', type: 'date'},
			{ name: 'inquiry_date_np', type: 'string'},
			{ name: 'dealer_id', type: 'number'},
			{ name: 'vehicle_name', type: 'string'},
			{ name: 'variant_name', type: 'string'},
			{ name: 'color_name', type: 'string'},
			{ name: 'status_name', type: 'string'},
			{ name: 'dealer_name', type: 'string'},
			{ name: 'executive_name', type: 'string'},
			{ name: 'customer_name', type: 'string'},
        ],
		url: '<?php echo site_url("admin/customers/get_today_followup_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
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
	
	customer_followupsDataAdapter = new $.jqx.dataAdapter(customer_followupsDataSource);

	$("#jqxGridCustomer_followup").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight),
		source: customer_followupsDataAdapter,
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
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer ,  cellclassname: cellclassname },
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', cellclassname: cellclassname ,
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					var e = '<i class="fa fa-edit" style="color:#CCC"></i>';

					if (columnproperties.followup_status != 'Completed'){
						// e = '<a href="javascript:void(0)" onclick="editCustomer_followupRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
						e = '<a href="<?php echo site_url('customers/detail')?>/'+columnproperties.customer_id+'" return false;" title="Edit" target="_blank"><i class="fa fa-edit"></i></a>';

					}
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("inquiry_date_en"); ?>',datafield: 'inquiry_date_en',width: 150,renderer: gridColumnsRenderer, columntype: 'date',  cellsformat:  formatString_yyyy_MM_dd, cellclassname: cellclassname },
			{ text: '<?php echo lang("followup_date_en"); ?>',datafield: 'followup_date_en',width: 150,renderer: gridColumnsRenderer, columntype: 'date',  cellsformat:  formatString_yyyy_MM_dd, cellclassname: cellclassname },
			{ text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_name',width: 200,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 150,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("executive_id"); ?>',datafield: 'executive_name',width: 150,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("status_id"); ?>',datafield: 'status_name',width: 100,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 100,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 100,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			
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

			{ input: '#followup_date_np', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#followup_date_np').val();
					if (val != '') {
						return (val.match(date_pattern)) ? true : false;
					} else {
						return true;
					}
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

			{ input: '#next_followup_date_np', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#next_followup_date_np').val();
					if (val != '') {
						return (val.match(date_pattern)) ? true : false;
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
  		console.log(row);
  		$('#customer_followups_id').val(row.id);
  		$('#customer_followups_customer_id').val(row.customer_id);
		$('#followup_executive_id').jqxComboBox('val', row.executive_id);
		$('#followup_date_en').jqxDateTimeInput('setDate', row.followup_date_en);
		$('#followup_date_np').val(row.followup_date_np);
		$('#followup_mode').jqxComboBox('val', row.followup_mode);
		$('#followup_status').jqxComboBox('val', row.followup_status);
		$('#followup_notes').val(row.followup_notes);

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
	$('#followup_mode').jqxComboBox('clearSelection');
	$('#followup_status').jqxComboBox('clearSelection');

    $('#followup_executive_id').jqxComboBox('selectIndex', '-1');
	$('#followup_mode').jqxComboBox('selectIndex', '-1');
	$('#followup_status').jqxComboBox('selectIndex', '-1');

	$('#next_followup_details').hide();
	$('#next_followup_date_np').val('');
	$('#next_followup_date_en').jqxDateTimeInput({ value: null });
	$('#followup_date_en').jqxDateTimeInput({ value: null });

	$('#next_followup').val('1');
}

</script>