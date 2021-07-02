<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('foc_documents'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('foc_documents'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridFoc_documentToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridFoc_documentInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridFoc_documentFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridFoc_document"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowFoc_document">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-foc_documents', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "foc_documents_id"/>
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
					<td><label for='customer_id'><?php echo lang('customer_id')?></label></td>
					<td><div id='customer_id' class='number_general' name='customer_id'></div></td>
				</tr>
				<tr>
					<td><label for='accessories_id'><?php echo lang('accessories_id')?></label></td>
					<td><input id='accessories_id' class='text_input' name='accessories_id'></td>
				</tr>
				<tr>
					<td><label for='free_servicing'><?php echo lang('free_servicing')?></label></td>
					<td><div id='free_servicing' class='number_general' name='free_servicing'></div></td>
				</tr>
				<tr>
					<td><label for='name_transfer'><?php echo lang('name_transfer')?></label></td>
					<td><div id='name_transfer' class='number_general' name='name_transfer'></div></td>
				</tr>
				<tr>
					<td><label for='fuel'><?php echo lang('fuel')?></label></td>
					<td><div id='fuel' class='number_general' name='fuel'></div></td>
				</tr>
				<tr>
					<td><label for='road_tax'><?php echo lang('road_tax')?></label></td>
					<td><div id='road_tax' class='number_general' name='road_tax'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxFoc_documentSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxFoc_documentCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var foc_documentsDataSource =
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
			{ name: 'accessories_id', type: 'string' },
			{ name: 'free_servicing', type: 'number' },
			{ name: 'name_transfer', type: 'number' },
			{ name: 'fuel', type: 'number' },
			{ name: 'road_tax', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/foc_documents/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	foc_documentsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridFoc_document").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridFoc_document").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridFoc_document").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: foc_documentsDataSource,
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
			container.append($('#jqxGridFoc_documentToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editFoc_documentRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("accessories_id"); ?>',datafield: 'accessories_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("free_servicing"); ?>',datafield: 'free_servicing',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name_transfer"); ?>',datafield: 'name_transfer',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("fuel"); ?>',datafield: 'fuel',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("road_tax"); ?>',datafield: 'road_tax',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridFoc_document").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridFoc_documentFilterClear', function () { 
		$('#jqxGridFoc_document').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridFoc_documentInsert', function () { 
		openPopupWindow('jqxPopupWindowFoc_document', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowFoc_document").jqxWindow({ 
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

    $("#jqxPopupWindowFoc_document").on('close', function () {
        reset_form_foc_documents();
    });

    $("#jqxFoc_documentCancelButton").on('click', function () {
        reset_form_foc_documents();
        $('#jqxPopupWindowFoc_document').jqxWindow('close');
    });

    /*$('#form-foc_documents').jqxValidator({
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

			{ input: '#customer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#accessories_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#accessories_id').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#free_servicing', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#free_servicing').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#name_transfer', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#name_transfer').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#fuel', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#fuel').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#road_tax', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#road_tax').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxFoc_documentSubmitButton").on('click', function () {
        saveFoc_documentRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveFoc_documentRecord();
                }
            };
        $('#form-foc_documents').jqxValidator('validate', validationResult);
        */
    });
});

function editFoc_documentRecord(index){
    var row =  $("#jqxGridFoc_document").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#foc_documents_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#customer_id').jqxNumberInput('val', row.customer_id);
		$('#accessories_id').val(row.accessories_id);
		$('#free_servicing').jqxNumberInput('val', row.free_servicing);
		$('#name_transfer').jqxNumberInput('val', row.name_transfer);
		$('#fuel').jqxNumberInput('val', row.fuel);
		$('#road_tax').jqxNumberInput('val', row.road_tax);
		
        openPopupWindow('jqxPopupWindowFoc_document', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveFoc_documentRecord(){
    var data = $("#form-foc_documents").serialize();
	
	$('#jqxPopupWindowFoc_document').block({ 
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
        url: '<?php echo site_url("admin/foc_documents/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_foc_documents();
                $('#jqxGridFoc_document').jqxGrid('updatebounddata');
                $('#jqxPopupWindowFoc_document').jqxWindow('close');
            }
            $('#jqxPopupWindowFoc_document').unblock();
        }
    });
}

function reset_form_foc_documents(){
	$('#foc_documents_id').val('');
    $('#form-foc_documents')[0].reset();
}
</script>