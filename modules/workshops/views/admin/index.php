<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('workshops'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('workshops'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridWorkshopToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridWorkshopInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridWorkshopFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridWorkshop"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowWorkshop">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-workshops', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "workshops_id"/>
            <table class="form-table">
				<tr>
					<td><label for='workshops_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='workshops_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='address1'><?php echo lang('address1')?></label></td>
					<td><input id='address1' class='text_input' name='address1'></td>
				</tr>
				<tr>
					<td><label for='address2'><?php echo lang('address2')?></label></td>
					<td><input id='address2' class='text_input' name='address2'></td>
				</tr>
				<tr>
					<td><label for='address3'><?php echo lang('address3')?></label></td>
					<td><input id='address3' class='text_input' name='address3'></td>
				</tr>
				<tr>
					<td><label for='phone1'><?php echo lang('phone1')?></label></td>
					<td><div id='phone1' class='number_general' name='phone1'></div></td>
				</tr>
				<tr>
					<td><label for='phone2'><?php echo lang('phone2')?></label></td>
					<td><div id='phone2' class='number_general' name='phone2'></div></td>
				</tr>
				<tr>
					<td><label for='office_address'><?php echo lang('office_address')?></label></td>
					<td><input id='office_address' class='text_input' name='office_address'></td>
				</tr>
				<tr>
					<td><label for='office_phone'><?php echo lang('office_phone')?></label></td>
					<td><div id='office_phone' class='number_general' name='office_phone'></div></td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='incharge_id'><?php echo lang('incharge_id')?></label></td>
					<td><div id='incharge_id' class='number_general' name='incharge_id'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxWorkshopSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxWorkshopCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var workshopsDataSource =
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
			{ name: 'address2', type: 'string' },
			{ name: 'address3', type: 'string' },
			{ name: 'phone1', type: 'number' },
			{ name: 'phone2', type: 'number' },
			{ name: 'office_address', type: 'string' },
			{ name: 'office_phone', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'incharge_id', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/workshops/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	workshopsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridWorkshop").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridWorkshop").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridWorkshop").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: workshopsDataSource,
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
			container.append($('#jqxGridWorkshopToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editWorkshopRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer, hidden:true },
			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address1"); ?>',datafield: 'address1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address2"); ?>',datafield: 'address2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("address3"); ?>',datafield: 'address3',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("phone1"); ?>',datafield: 'phone1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("phone2"); ?>',datafield: 'phone2',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("office_address"); ?>',datafield: 'office_address',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("office_phone"); ?>',datafield: 'office_phone',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("incharge_id"); ?>',datafield: 'incharge_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridWorkshop").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridWorkshopFilterClear', function () { 
		$('#jqxGridWorkshop').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridWorkshopInsert', function () { 
		openPopupWindow('jqxPopupWindowWorkshop', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowWorkshop").jqxWindow({ 
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

    $("#jqxPopupWindowWorkshop").on('close', function () {
        reset_form_workshops();
    });

    $("#jqxWorkshopCancelButton").on('click', function () {
        reset_form_workshops();
        $('#jqxPopupWindowWorkshop').jqxWindow('close');
    });

    /*$('#form-workshops').jqxValidator({
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

			{ input: '#workshops_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#workshops_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#address1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#address1').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#address2', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#address2').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#address3', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#address3').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#phone1', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#phone1').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#phone2', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#phone2').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#office_address', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#office_address').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#office_phone', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#office_phone').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#incharge_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#incharge_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxWorkshopSubmitButton").on('click', function () {
        saveWorkshopRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveWorkshopRecord();
                }
            };
        $('#form-workshops').jqxValidator('validate', validationResult);
        */
    });
});

function editWorkshopRecord(index){
    var row =  $("#jqxGridWorkshop").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#workshops_id').val(row.id);
		$('#workshops_name').val(row.name);
		$('#address1').val(row.address1);
		$('#address2').val(row.address2);
		$('#address3').val(row.address3);
		$('#phone1').jqxNumberInput('val', row.phone1);
		$('#phone2').jqxNumberInput('val', row.phone2);
		$('#office_address').val(row.office_address);
		$('#office_phone').jqxNumberInput('val', row.office_phone);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#incharge_id').jqxNumberInput('val', row.incharge_id);
		
        openPopupWindow('jqxPopupWindowWorkshop', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveWorkshopRecord(){
    var data = $("#form-workshops").serialize();
	
	$('#jqxPopupWindowWorkshop').block({ 
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
        url: '<?php echo site_url("admin/workshops/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_workshops();
                $('#jqxGridWorkshop').jqxGrid('updatebounddata');
                $('#jqxPopupWindowWorkshop').jqxWindow('close');
            }
            $('#jqxPopupWindowWorkshop').unblock();
        }
    });
}

function reset_form_workshops(){
	$('#workshops_id').val('');
    $('#form-workshops')[0].reset();
}
</script>