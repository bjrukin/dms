

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('purchase_methods'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('purchase_methods'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPurchase_methodToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPurchase_methodInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPurchase_methodFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridPurchase_method"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPurchase_method">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-purchase_methods', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "purchase_methods_id"/>
            <table class="form-table">
				<!-- <tr>
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
				</tr> -->
				<tr>
					<td><label for='type'><?php echo lang('type')?></label></td>
					<td><input id='type' class='text_input' name='type'></td>
				</tr>
				<tr>
					<td><label for='part_no'><?php echo lang('part_no')?></label></td>
					<td><input id='part_no' class='text_input' name='part_no'></td>
				</tr>
				<tr>
					<td><label for='description'><?php echo lang('description')?></label></td>
					<td><input id='description' class='text_input' name='description'></td>
				</tr>
				<tr>
					<td><label for='qty'><?php echo lang('qty')?></label></td>
					<td><div id='qty' class='number_general' name='qty'></div></td>
				</tr>
				<tr>
					<td><label for='ord_no	'><?php echo lang('ord_no')?></label></td>
					<td><div id='ord_no	' class='number_general' name='ord_no'></div></td>
				</tr>
				<tr>
					<td><label for='price'><?php echo lang('price')?></label></td>
					<td><div id='price' class='number_general' name='price'></div></td>
				</tr>
				<tr>
					<td><label for='disc'><?php echo lang('disc')?></label></td>
					<td><input id='disc' class='text_input' name='disc'></td>
				</tr>
				<tr>
					<td><label for='amount'><?php echo lang('amount')?></label></td>
					<td><div id='amount' class='number_general' name='amount'></div></td>
				</tr>
				<tr>
					<td><label for='bin'><?php echo lang('bin')?></label></td>
					<td><input id='bin' class='text_input' name='bin'></td>
				</tr>
				<tr>
					<td><label for='vat'><?php echo lang('vat')?></label></td>
					<td><input id='vat' class='text_input' name='vat'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPurchase_methodSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPurchase_methodCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var purchase_methodsDataSource =
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
			{ name: 'type', type: 'string' },
			{ name: 'part_no', type: 'number' },
			{ name: 'description', type: 'string' },
			{ name: 'qty', type: 'number' },
			{ name: 'ord_no	', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'disc', type: 'string' },
			{ name: 'amount', type: 'number' },
			{ name: 'bin', type: 'string' },
			{ name: 'vat', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/purchase_methods/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	purchase_methodsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPurchase_method").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPurchase_method").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPurchase_method").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: purchase_methodsDataSource,
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
			container.append($('#jqxGridPurchase_methodToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editPurchase_methodRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
			{ text: '<?php echo lang("type"); ?>',datafield: 'type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_no"); ?>',datafield: 'part_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("qty"); ?>',datafield: 'qty',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("ord_no"); ?>',datafield: 'ord_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("disc"); ?>',datafield: 'disc',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("bin"); ?>',datafield: 'bin',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vat"); ?>',datafield: 'vat',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridPurchase_method").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPurchase_methodFilterClear', function () { 
		$('#jqxGridPurchase_method').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPurchase_methodInsert', function () { 
		openPopupWindow('jqxPopupWindowPurchase_method', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowPurchase_method").jqxWindow({ 
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

    $("#jqxPopupWindowPurchase_method").on('close', function () {
        reset_form_purchase_methods();
    });

    $("#jqxPurchase_methodCancelButton").on('click', function () {
        reset_form_purchase_methods();
        $('#jqxPopupWindowPurchase_method').jqxWindow('close');
    });

    /*$('#form-purchase_methods').jqxValidator({
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

			{ input: '#type', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#type').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#part_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#part_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#description', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#description').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#qty', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#qty').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#ord_no	', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#ord_no	').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#price').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#disc', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#disc').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#amount', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#amount').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bin', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bin').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vat', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vat').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxPurchase_methodSubmitButton").on('click', function () {
        savePurchase_methodRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   savePurchase_methodRecord();
                }
            };
        $('#form-purchase_methods').jqxValidator('validate', validationResult);
        */
    });
});

function editPurchase_methodRecord(index){
    var row =  $("#jqxGridPurchase_method").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#purchase_methods_id').val(row.id);
  
		$('#type').val(row.type);
		$('#part_no').jqxNumberInput('val', row.part_no);
		$('#description').val(row.description);
		$('#qty').jqxNumberInput('val', row.qty);
		$('#ord_no	').jqxNumberInput('val', row.ord_no	);
		$('#price').jqxNumberInput('val', row.price);
		$('#disc').val(row.disc);
		$('#amount').jqxNumberInput('val', row.amount);
		$('#bin').val(row.bin);
		$('#vat').val(row.vat);
		

        openPopupWindow('jqxPopupWindowPurchase_method', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function savePurchase_methodRecord(){
    var data = $("#form-purchase_methods").serialize();
	
	$('#jqxPopupWindowPurchase_method').block({ 
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
        url: '<?php echo site_url("admin/purchase_methods/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_purchase_methods();
                $('#jqxGridPurchase_method').jqxGrid('updatebounddata');
                $('#jqxPopupWindowPurchase_method').jqxWindow('close');
            }
            $('#jqxPopupWindowPurchase_method').unblock();
        }
    });
}

function reset_form_purchase_methods(){
	$('#purchase_methods_id').val('');
    $('#form-purchase_methods')[0].reset();
}
</script>