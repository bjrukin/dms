<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_sales'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('dealer_sales'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDealer_saleToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_saleInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDealer_saleFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDealer_sale"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDealer_sale">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-dealer_sales', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "dealer_sales_id"/>
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
					<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
					<td><div id='sparepart_id' class='number_general' name='sparepart_id'></div></td>
				</tr>
				<tr>
					<td><label for='party_name'><?php echo lang('party_name')?></label></td>
					<td><input id='party_name' class='text_input' name='party_name'></td>
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
					<td><label for='date'><?php echo lang('date')?></label></td>
					<td><div id='date' class='date_box' name='date'></div></td>
				</tr>
				<tr>
					<td><label for='nep_date'><?php echo lang('nep_date')?></label></td>
					<td><input id='nep_date' class='text_input' name='nep_date'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealer_saleSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDealer_saleCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var dealer_salesDataSource =
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
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'party_name', type: 'string' },
			{ name: 'quantity', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'date', type: 'date' },
			{ name: 'nep_date', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/dealer_sales/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_salesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDealer_sale").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDealer_sale").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDealer_sale").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dealer_salesDataSource,
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
			container.append($('#jqxGridDealer_saleToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDealer_saleRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("party_name"); ?>',datafield: 'party_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("nep_date"); ?>',datafield: 'nep_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDealer_sale").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDealer_saleFilterClear', function () { 
		$('#jqxGridDealer_sale').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDealer_saleInsert', function () { 
		openPopupWindow('jqxPopupWindowDealer_sale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDealer_sale").jqxWindow({ 
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

    $("#jqxPopupWindowDealer_sale").on('close', function () {
        reset_form_dealer_sales();
    });

    $("#jqxDealer_saleCancelButton").on('click', function () {
        reset_form_dealer_sales();
        $('#jqxPopupWindowDealer_sale').jqxWindow('close');
    });

    /*$('#form-dealer_sales').jqxValidator({
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

			{ input: '#sparepart_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sparepart_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#party_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#party_name').val();
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

			{ input: '#nep_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#nep_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDealer_saleSubmitButton").on('click', function () {
        saveDealer_saleRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDealer_saleRecord();
                }
            };
        $('#form-dealer_sales').jqxValidator('validate', validationResult);
        */
    });
});

function editDealer_saleRecord(index){
    var row =  $("#jqxGridDealer_sale").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#dealer_sales_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#sparepart_id').jqxNumberInput('val', row.sparepart_id);
		$('#party_name').val(row.party_name);
		$('#quantity').jqxNumberInput('val', row.quantity);
		$('#price').jqxNumberInput('val', row.price);
		$('#date').jqxDateTimeInput('setDate', row.date);
		$('#nep_date').val(row.nep_date);
		
        openPopupWindow('jqxPopupWindowDealer_sale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDealer_saleRecord(){
    var data = $("#form-dealer_sales").serialize();
	
	$('#jqxPopupWindowDealer_sale').block({ 
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
        url: '<?php echo site_url("admin/dealer_sales/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_dealer_sales();
                $('#jqxGridDealer_sale').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDealer_sale').jqxWindow('close');
            }
            $('#jqxPopupWindowDealer_sale').unblock();
        }
    });
}

function reset_form_dealer_sales(){
	$('#dealer_sales_id').val('');
    $('#form-dealer_sales')[0].reset();
}
</script>