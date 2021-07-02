<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('outsidework_ledgers'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('outsidework_ledgers'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridOutsidework_ledgerToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridOutsidework_ledgerInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridOutsidework_ledgerFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridOutsidework_ledger"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowOutsidework_ledger">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-outsidework_ledgers', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "outsidework_ledgers_id"/>
            <table class="form-table">				
				<tr>
					<td><label for='outsidework_ledgers_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='outsidework_ledgers_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='address1'><?php echo lang('address1')?></label></td>
					<td><input id='address1' class='text_input' name='address1'></td>
				</tr>
				<tr>
					<td><label for='email'><?php echo lang('email')?></label></td>
					<td><input id='email' class='text_input' name='email'></td>
				</tr>
				<tr>
					<td><label for='phone_no'><?php echo lang('phone_no')?></label></td>
					<td><div id='phone_no' class='number_general' name='phone_no'></div></td>
				</tr>
				<!-- <tr>
					<td><label for='city'><?php echo lang('city')?></label></td>
					<td><input id='city' class='text_input' name='city'></td>
				</tr>
				<tr>
					<td><label for='area'><?php echo lang('area')?></label></td>
					<td><input id='area' class='text_input' name='area'></td>
				</tr>
				<tr>
					<td><label for='district_id'><?php echo lang('district_id')?></label></td>
					<td><div id='district_id' class='number_general' name='district_id'></div></td>
				</tr>
				<tr>
					<td><label for='zone_id'><?php echo lang('zone_id')?></label></td>
					<td><div id='zone_id' class='number_general' name='zone_id'></div></td>
				</tr> -->
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxOutsidework_ledgerSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxOutsidework_ledgerCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var outsidework_ledgersDataSource =
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
			{ name: 'address1', type: 'string' },
			{ name: 'email', type: 'string' },
			{ name: 'phone_no', type: 'number' },
			{ name: 'city', type: 'string' },
			{ name: 'area', type: 'string' },
			{ name: 'district_id', type: 'number' },
			{ name: 'zone_id', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/outsidework_ledgers/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	outsidework_ledgersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridOutsidework_ledger").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridOutsidework_ledger").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridOutsidework_ledger").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: outsidework_ledgersDataSource,
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
			container.append($('#jqxGridOutsidework_ledgerToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editOutsidework_ledgerRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address1"); ?>',datafield: 'address1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("email"); ?>',datafield: 'email',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("phone_no"); ?>',datafield: 'phone_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("city"); ?>',datafield: 'city',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("area"); ?>',datafield: 'area',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("district_id"); ?>',datafield: 'district_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("zone_id"); ?>',datafield: 'zone_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridOutsidework_ledger").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridOutsidework_ledgerFilterClear', function () { 
		$('#jqxGridOutsidework_ledger').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridOutsidework_ledgerInsert', function () { 
		openPopupWindow('jqxPopupWindowOutsidework_ledger', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowOutsidework_ledger").jqxWindow({ 
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

    $("#jqxPopupWindowOutsidework_ledger").on('close', function () {
        reset_form_outsidework_ledgers();
    });

    $("#jqxOutsidework_ledgerCancelButton").on('click', function () {
        reset_form_outsidework_ledgers();
        $('#jqxPopupWindowOutsidework_ledger').jqxWindow('close');
    });

    /*$('#form-outsidework_ledgers').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
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

			{ input: '#outsidework_ledgers_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#outsidework_ledgers_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#address1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#address1').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#email', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#email').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#phone_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#phone_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#city', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#city').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#area', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#area').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#district_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#district_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#zone_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#zone_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxOutsidework_ledgerSubmitButton").on('click', function () {
        saveOutsidework_ledgerRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveOutsidework_ledgerRecord();
                }
            };
        $('#form-outsidework_ledgers').jqxValidator('validate', validationResult);
        */
    });
});

function editOutsidework_ledgerRecord(index){
    var row =  $("#jqxGridOutsidework_ledger").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#outsidework_ledgers_id').val(row.id);
		$('#outsidework_ledgers_name').val(row.name);
		$('#address1').val(row.address1);
		$('#email').val(row.email);
		$('#phone_no').jqxNumberInput('val', row.phone_no);
		$('#city').val(row.city);
		$('#area').val(row.area);
		// $('#district_id').jqxNumberInput('val', row.district_id);
		// $('#zone_id').jqxNumberInput('val', row.zone_id);
		
        openPopupWindow('jqxPopupWindowOutsidework_ledger', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveOutsidework_ledgerRecord(){
    var data = $("#form-outsidework_ledgers").serialize();
	
	$('#jqxPopupWindowOutsidework_ledger').block({ 
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
        url: '<?php echo site_url("admin/outsidework_ledgers/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_outsidework_ledgers();
                $('#jqxGridOutsidework_ledger').jqxGrid('updatebounddata');
                $('#jqxPopupWindowOutsidework_ledger').jqxWindow('close');
            }
            $('#jqxPopupWindowOutsidework_ledger').unblock();
        }
    });
}

function reset_form_outsidework_ledgers(){
	$('#outsidework_ledgers_id').val('');
    $('#form-outsidework_ledgers')[0].reset();
}
</script>