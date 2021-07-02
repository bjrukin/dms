<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dispatch_dealers'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('dispatch_dealers'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDispatch_dealerToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDispatch_dealerInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDispatch_dealerFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDispatch_dealer"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDispatch_dealer">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-dispatch_dealers', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "dispatch_dealers_id"/>
            <table class="form-table">
				<tr>
					<td><label for='challan_no'><?php echo lang('challan_no')?></label></td>
					<td><div id='challan_no' class='number_general' name='challan_no'></div></td>
				</tr>				
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='stock_yard_id'><?php echo lang('stock_yard_id')?></label></td>
					<td><div id='stock_yard_id' class='number_general' name='stock_yard_id'></div></td>
				</tr>
				<tr>
					<td><label for='driver_name'><?php echo lang('driver_name')?></label></td>
					<td><input id='driver_name' class='text_input' name='driver_name'></td>
				</tr>
				<tr>
					<td><label for='driver_address'><?php echo lang('driver_address')?></label></td>
					<td><input id='driver_address' class='text_input' name='driver_address'></td>
				</tr>
				<tr>
					<td><label for='driver_contact'><?php echo lang('driver_contact')?></label></td>
					<td><input id='driver_contact' class='text_input' name='driver_contact'></td>
				</tr>
				<tr>
					<td><label for='driver_liscense_no'><?php echo lang('driver_liscense_no')?></label></td>
					<td><input id='driver_liscense_no' class='text_input' name='driver_liscense_no'></td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='received_status'><?php echo lang('received_status')?></label></td>
					<td><div id='received_status' class='number_general' name='received_status'></div></td>
				</tr>
				<tr>
					<td><label for='driver_doc_path'><?php echo lang('driver_doc_path')?></label></td>
					<td><input id='driver_doc_path' class='text_input' name='driver_doc_path'></td>
				</tr>
				<tr>
					<td><label for='received_date'><?php echo lang('received_date')?></label></td>
					<td><input id='received_date' class='text_input' name='received_date'></td>
				</tr>
				<tr>
					<td><label for='dispatched_date'><?php echo lang('dispatched_date')?></label></td>
					<td><input id='dispatched_date' class='text_input' name='dispatched_date'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDispatch_dealerSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDispatch_dealerCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var dispatch_dealersDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'stock_yard_id', type: 'number' },
			{ name: 'driver_name', type: 'string' },
			{ name: 'driver_address', type: 'string' },
			{ name: 'driver_contact', type: 'string' },
			{ name: 'driver_liscense_no', type: 'string' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'received_status', type: 'number' },
			{ name: 'driver_doc_path', type: 'string' },
			{ name: 'received_date', type: 'string' },
			{ name: 'dispatched_date', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/dispatch_dealers/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dispatch_dealersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDispatch_dealer").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDispatch_dealer").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDispatch_dealer").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dispatch_dealersDataSource,
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
			container.append($('#jqxGridDispatch_dealerToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDispatch_dealerRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("challan_no"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("stock_yard_id"); ?>',datafield: 'stock_yard_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_name"); ?>',datafield: 'driver_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_address"); ?>',datafield: 'driver_address',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_contact"); ?>',datafield: 'driver_contact',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_liscense_no"); ?>',datafield: 'driver_liscense_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("received_status"); ?>',datafield: 'received_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("driver_doc_path"); ?>',datafield: 'driver_doc_path',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("received_date"); ?>',datafield: 'received_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dispatched_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDispatch_dealer").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDispatch_dealerFilterClear', function () { 
		$('#jqxGridDispatch_dealer').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDispatch_dealerInsert', function () { 
		openPopupWindow('jqxPopupWindowDispatch_dealer', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDispatch_dealer").jqxWindow({ 
        theme: theme,
        width: '75%',
        maxWidth: '75%',
        height: '75%',  
        maxHeight: '75%',  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowDispatch_dealer").on('close', function () {
        reset_form_dispatch_dealers();
    });

    $("#jqxDispatch_dealerCancelButton").on('click', function () {
        reset_form_dispatch_dealers();
        $('#jqxPopupWindowDispatch_dealer').jqxWindow('close');
    });

    /*$('#form-dispatch_dealers').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#challan_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#challan_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#stock_yard_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stock_yard_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_address', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_address').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_contact', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_contact').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_liscense_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_liscense_no').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#received_status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#received_status').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#driver_doc_path', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#driver_doc_path').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#received_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#received_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatched_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatched_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDispatch_dealerSubmitButton").on('click', function () {
        saveDispatch_dealerRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDispatch_dealerRecord();
                }
            };
        $('#form-dispatch_dealers').jqxValidator('validate', validationResult);
        */
    });
});

function editDispatch_dealerRecord(index){
    var row =  $("#jqxGridDispatch_dealer").jqxGrid('getrowdata', index);
    
  	if (row) {
  		$('#dispatch_dealers_id').val(row.id);
        $('#challan_no').jqxNumberInput('val', row.challan_no);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#stock_yard_id').jqxNumberInput('val', row.stock_yard_id);
		$('#driver_name').val(row.driver_name);
		$('#driver_address').val(row.driver_address);
		$('#driver_contact').val(row.driver_contact);
		$('#driver_liscense_no').val(row.driver_liscense_no);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#received_status').jqxNumberInput('val', row.received_status);
		$('#driver_doc_path').val(row.driver_doc_path);
		$('#received_date').val(row.received_date);
		$('#dispatched_date').val(row.dispatched_date);
		
        openPopupWindow('jqxPopupWindowDispatch_dealer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDispatch_dealerRecord(){
    var data = $("#form-dispatch_dealers").serialize();
	
	$('#jqxPopupWindowDispatch_dealer').block({ 
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
        url: '<?php echo site_url("admin/dispatch_dealers/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_dispatch_dealers();
                $('#jqxGridDispatch_dealer').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDispatch_dealer').jqxWindow('close');
            }
            $('#jqxPopupWindowDispatch_dealer').unblock();
        }
    });
}

function reset_form_dispatch_dealers(){
	$('#dispatch_dealers_id').val('');
    $('#form-dispatch_dealers')[0].reset();
}
</script>