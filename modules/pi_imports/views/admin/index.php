<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('pi_imports'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('pi_imports'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPi_importToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPi_importInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPi_importFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridPi_import"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPi_import">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-pi_imports', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "pi_imports_id"/>
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
					<td><label for='order_no'><?php echo lang('order_no')?></label></td>
					<td><div id='order_no' class='number_general' name='order_no'></div></td>
				</tr>
				<tr>
					<td><label for='part_code'><?php echo lang('part_code')?></label></td>
					<td><input id='part_code' class='text_input' name='part_code'></td>
				</tr>
				<tr>
					<td><label for='quantity'><?php echo lang('quantity')?></label></td>
					<td><div id='quantity' class='number_general' name='quantity'></div></td>
				</tr>
				<tr>
					<td><label for='price'><?php echo lang('price')?></label></td>
					<td><div id='price' class='number_general' name='price'></div></td>
				</tr>
				<tr>
					<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
					<td><div id='sparepart_id' class='number_general' name='sparepart_id'></div></td>
				</tr>
				<tr>
					<td><label for='pi_number'><?php echo lang('pi_number')?></label></td>
					<td><input id='pi_number' class='text_input' name='pi_number'></td>
				</tr>
				<tr>
					<td><label for='reached_date'><?php echo lang('reached_date')?></label></td>
					<td><div id='reached_date' class='date_box' name='reached_date'></div></td>
				</tr>
				<tr>
					<td><label for='reached_date_np'><?php echo lang('reached_date_np')?></label></td>
					<td><input id='reached_date_np' class='text_input' name='reached_date_np'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPi_importSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPi_importCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var pi_importsDataSource =
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
			{ name: 'order_no', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'quantity', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'pi_number', type: 'string' },
			{ name: 'reached_date', type: 'date' },
			{ name: 'reached_date_np', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/pi_imports/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	pi_importsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPi_import").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPi_import").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPi_import").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: pi_importsDataSource,
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
			container.append($('#jqxGridPi_importToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editPi_importRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("order_no"); ?>',datafield: 'order_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("pi_number"); ?>',datafield: 'pi_number',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("reached_date"); ?>',datafield: 'reached_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("reached_date_np"); ?>',datafield: 'reached_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridPi_import").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPi_importFilterClear', function () { 
		$('#jqxGridPi_import').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPi_importInsert', function () { 
		openPopupWindow('jqxPopupWindowPi_import', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowPi_import").jqxWindow({ 
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

    $("#jqxPopupWindowPi_import").on('close', function () {
        reset_form_pi_imports();
    });

    $("#jqxPi_importCancelButton").on('click', function () {
        reset_form_pi_imports();
        $('#jqxPopupWindowPi_import').jqxWindow('close');
    });

    /*$('#form-pi_imports').jqxValidator({
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

			{ input: '#order_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#order_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#part_code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#part_code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#price').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#sparepart_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sparepart_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#pi_number', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#pi_number').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#reached_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#reached_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxPi_importSubmitButton").on('click', function () {
        savePi_importRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   savePi_importRecord();
                }
            };
        $('#form-pi_imports').jqxValidator('validate', validationResult);
        */
    });
});

function editPi_importRecord(index){
    var row =  $("#jqxGridPi_import").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#pi_imports_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#order_no').jqxNumberInput('val', row.order_no);
		$('#part_code').val(row.part_code);
		$('#quantity').jqxNumberInput('val', row.quantity);
		$('#price').jqxNumberInput('val', row.price);
		$('#sparepart_id').jqxNumberInput('val', row.sparepart_id);
		$('#pi_number').val(row.pi_number);
		$('#reached_date').jqxDateTimeInput('setDate', row.reached_date);
		$('#reached_date_np').val(row.reached_date_np);
		
        openPopupWindow('jqxPopupWindowPi_import', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function savePi_importRecord(){
    var data = $("#form-pi_imports").serialize();
	
	$('#jqxPopupWindowPi_import').block({ 
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
        url: '<?php echo site_url("admin/pi_imports/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_pi_imports();
                $('#jqxGridPi_import').jqxGrid('updatebounddata');
                $('#jqxPopupWindowPi_import').jqxWindow('close');
            }
            $('#jqxPopupWindowPi_import').unblock();
        }
    });
}

function reset_form_pi_imports(){
	$('#pi_imports_id').val('');
    $('#form-pi_imports')[0].reset();
}
</script>