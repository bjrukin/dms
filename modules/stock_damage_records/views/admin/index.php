<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('stock_damage_records'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('stock_damage_records'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridStock_damage_recordToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_damage_recordInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_damage_recordFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridStock_damage_record"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStock_damage_record">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-stock_damage_records', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "stock_damage_records_id"/>
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
					<td><label for='stock_record_id'><?php echo lang('stock_record_id')?></label></td>
					<td><div id='stock_record_id' class='number_general' name='stock_record_id'></div></td>
				</tr>
				<tr>
					<td><label for='damage_date'><?php echo lang('damage_date')?></label></td>
					<td><div id='damage_date' class='date_box' name='damage_date'></div></td>
				</tr>
				<tr>
					<td><label for='damage_date_np'><?php echo lang('damage_date_np')?></label></td>
					<td><input id='damage_date_np' class='text_input' name='damage_date_np'></td>
				</tr>
				<tr>
					<td><label for='repair_commitment_date'><?php echo lang('repair_commitment_date')?></label></td>
					<td><div id='repair_commitment_date' class='date_box' name='repair_commitment_date'></div></td>
				</tr>
				<tr>
					<td><label for='repair_date'><?php echo lang('repair_date')?></label></td>
					<td><div id='repair_date' class='date_box' name='repair_date'></div></td>
				</tr>
				<tr>
					<td><label for='repair_date_np'><?php echo lang('repair_date_np')?></label></td>
					<td><input id='repair_date_np' class='text_input' name='repair_date_np'></td>
				</tr>
				<tr>
					<td><label for='remarks'><?php echo lang('remarks')?></label></td>
					<td><input id='remarks' class='text_input' name='remarks'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_damage_recordSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_damage_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var stock_damage_recordsDataSource =
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
			{ name: 'stock_record_id', type: 'number' },
			{ name: 'damage_date', type: 'date' },
			{ name: 'damage_date_np', type: 'string' },
			{ name: 'repair_commitment_date', type: 'date' },
			{ name: 'repair_date', type: 'date' },
			{ name: 'repair_date_np', type: 'string' },
			{ name: 'remarks', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/stock_damage_records/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stock_damage_recordsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStock_damage_record").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStock_damage_record").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStock_damage_record").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stock_damage_recordsDataSource,
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
			container.append($('#jqxGridStock_damage_recordToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editStock_damage_recordRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("stock_record_id"); ?>',datafield: 'stock_record_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("damage_date"); ?>',datafield: 'damage_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("damage_date_np"); ?>',datafield: 'damage_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("repair_commitment_date"); ?>',datafield: 'repair_commitment_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("repair_date"); ?>',datafield: 'repair_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("repair_date_np"); ?>',datafield: 'repair_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridStock_damage_record").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStock_damage_recordFilterClear', function () { 
		$('#jqxGridStock_damage_record').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStock_damage_recordInsert', function () { 
		openPopupWindow('jqxPopupWindowStock_damage_record', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowStock_damage_record").jqxWindow({ 
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

    $("#jqxPopupWindowStock_damage_record").on('close', function () {
        reset_form_stock_damage_records();
    });

    $("#jqxStock_damage_recordCancelButton").on('click', function () {
        reset_form_stock_damage_records();
        $('#jqxPopupWindowStock_damage_record').jqxWindow('close');
    });

    /*$('#form-stock_damage_records').jqxValidator({
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

			{ input: '#stock_record_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stock_record_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#damage_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#damage_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#repair_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#repair_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remarks', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remarks').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxStock_damage_recordSubmitButton").on('click', function () {
        saveStock_damage_recordRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStock_damage_recordRecord();
                }
            };
        $('#form-stock_damage_records').jqxValidator('validate', validationResult);
        */
    });
});

function editStock_damage_recordRecord(index){
    var row =  $("#jqxGridStock_damage_record").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#stock_damage_records_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#stock_record_id').jqxNumberInput('val', row.stock_record_id);
		$('#damage_date').jqxDateTimeInput('setDate', row.damage_date);
		$('#damage_date_np').val(row.damage_date_np);
		$('#repair_commitment_date').jqxDateTimeInput('setDate', row.repair_commitment_date);
		$('#repair_date').jqxDateTimeInput('setDate', row.repair_date);
		$('#repair_date_np').val(row.repair_date_np);
		$('#remarks').val(row.remarks);
		
        openPopupWindow('jqxPopupWindowStock_damage_record', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStock_damage_recordRecord(){
    var data = $("#form-stock_damage_records").serialize();
	
	$('#jqxPopupWindowStock_damage_record').block({ 
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
        url: '<?php echo site_url("admin/stock_damage_records/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_stock_damage_records();
                $('#jqxGridStock_damage_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowStock_damage_record').jqxWindow('close');
            }
            $('#jqxPopupWindowStock_damage_record').unblock();
        }
    });
}

function reset_form_stock_damage_records(){
	$('#stock_damage_records_id').val('');
    $('#form-stock_damage_records')[0].reset();
}
</script>