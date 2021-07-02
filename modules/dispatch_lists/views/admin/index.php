<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dispatch_lists'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('dispatch_lists'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDispatch_listToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDispatch_listInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDispatch_listFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDispatch_list"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDispatch_list">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-dispatch_lists', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "dispatch_lists_id"/>
            <table class="form-table">
				<tr>
					<td><label for='created_by'><?php echo lang('created_by')?></label></td>
					<td><div id='created_by' class='number_general' name='created_by'></div></td>
				</tr>
				<tr>
					<td><label for='updated_by'><?php echo lang('updated_by')?></label></td>
					<td><div id='updated_by' class='number_general' name='updated_by'></div></td>
				</tr>
				<tr>
					<td><label for='deleted_by'><?php echo lang('deleted_by')?></label></td>
					<td><div id='deleted_by' class='number_general' name='deleted_by'></div></td>
				</tr>
				<tr>
					<td><label for='created_at'><?php echo lang('created_at')?></label></td>
					<td><input id='created_at' class='text_input' name='created_at'></td>
				</tr>
				<tr>
					<td><label for='updated_at'><?php echo lang('updated_at')?></label></td>
					<td><input id='updated_at' class='text_input' name='updated_at'></td>
				</tr>
				<tr>
					<td><label for='deleted_at'><?php echo lang('deleted_at')?></label></td>
					<td><input id='deleted_at' class='text_input' name='deleted_at'></td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='order_id'><?php echo lang('order_id')?></label></td>
					<td><div id='order_id' class='number_general' name='order_id'></div></td>
				</tr>
				<tr>
					<td><label for='part_code'><?php echo lang('part_code')?></label></td>
					<td><div id='part_code' class='number_general' name='part_code'></div></td>
				</tr>
				<tr>
					<td><label for='dispatch_quantity'><?php echo lang('dispatch_quantity')?></label></td>
					<td><div id='dispatch_quantity' class='number_general' name='dispatch_quantity'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDispatch_listSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDispatch_listCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var dispatch_listsDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'order_id', type: 'number' },
			{ name: 'part_code', type: 'number' },
			{ name: 'dispatch_quantity', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/dispatch_lists/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dispatch_listsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDispatch_list").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDispatch_list").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDispatch_list").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dispatch_listsDataSource,
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
			container.append($('#jqxGridDispatch_listToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDispatch_listRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("order_id"); ?>',datafield: 'order_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatch_quantity"); ?>',datafield: 'dispatch_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDispatch_list").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDispatch_listFilterClear', function () { 
		$('#jqxGridDispatch_list').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDispatch_listInsert', function () { 
		openPopupWindow('jqxPopupWindowDispatch_list', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDispatch_list").jqxWindow({ 
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

    $("#jqxPopupWindowDispatch_list").on('close', function () {
        reset_form_dispatch_lists();
    });

    $("#jqxDispatch_listCancelButton").on('click', function () {
        reset_form_dispatch_lists();
        $('#jqxPopupWindowDispatch_list').jqxWindow('close');
    });

    /*$('#form-dispatch_lists').jqxValidator({
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

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#order_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#order_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#part_code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#part_code').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatch_quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatch_quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDispatch_listSubmitButton").on('click', function () {
        saveDispatch_listRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDispatch_listRecord();
                }
            };
        $('#form-dispatch_lists').jqxValidator('validate', validationResult);
        */
    });
});

function editDispatch_listRecord(index){
    var row =  $("#jqxGridDispatch_list").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#dispatch_lists_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#order_id').jqxNumberInput('val', row.order_id);
		$('#part_code').jqxNumberInput('val', row.part_code);
		$('#dispatch_quantity').jqxNumberInput('val', row.dispatch_quantity);
		
        openPopupWindow('jqxPopupWindowDispatch_list', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDispatch_listRecord(){
    var data = $("#form-dispatch_lists").serialize();
	
	$('#jqxPopupWindowDispatch_list').block({ 
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
        url: '<?php echo site_url("admin/dispatch_lists/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_dispatch_lists();
                $('#jqxGridDispatch_list').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDispatch_list').jqxWindow('close');
            }
            $('#jqxPopupWindowDispatch_list').unblock();
        }
    });
}

function reset_form_dispatch_lists(){
	$('#dispatch_lists_id').val('');
    $('#form-dispatch_lists')[0].reset();
}
</script>