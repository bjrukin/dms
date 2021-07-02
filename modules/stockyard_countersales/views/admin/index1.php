<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('stockyard_countersales'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('stockyard_countersales'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridStockyard_countersaleToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStockyard_countersaleInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStockyard_countersaleFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridStockyard_countersale"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStockyard_countersale">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-stockyard_countersales', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "stockyard_countersales_id"/>
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
					<td><label for='issue_date'><?php echo lang('issue_date')?></label></td>
					<td><div id='issue_date' class='date_box' name='issue_date'></div></td>
				</tr>
				<tr>
					<td><label for='creadit_account'><?php echo lang('creadit_account')?></label></td>
					<td><input id='creadit_account' class='text_input' name='creadit_account'></td>
				</tr>
				<tr>
					<td><label for='price_option'><?php echo lang('price_option')?></label></td>
					<td><input id='price_option' class='text_input' name='price_option'></td>
				</tr>
				<tr>
					<td><label for='vro'><?php echo lang('vro')?></label></td>
					<td><input id='vro' class='text_input' name='vro'></td>
				</tr>
				<tr>
					<td><label for='countersale_no'><?php echo lang('countersale_no')?></label></td>
					<td><div id='countersale_no' class='number_general' name='countersale_no'></div></td>
				</tr>
				<tr>
					<td><label for='issueCountersaeIssueNo'><?php echo lang('issueCountersaeIssueNo')?></label></td>
					<td><div id='issueCountersaeIssueNo' class='number_general' name='issueCountersaeIssueNo'></div></td>
				</tr>
				<tr>
					<td><label for='total_for_parts'><?php echo lang('total_for_parts')?></label></td>
					<td><input id='total_for_parts' class='text_input' name='total_for_parts'></td>
				</tr>
				<tr>
					<td><label for='dealer_total_for_parts'><?php echo lang('dealer_total_for_parts')?></label></td>
					<td><input id='dealer_total_for_parts' class='text_input' name='dealer_total_for_parts'></td>
				</tr>
				<tr>
					<td><label for='cash_discount_percent'><?php echo lang('cash_discount_percent')?></label></td>
					<td><input id='cash_discount_percent' class='text_input' name='cash_discount_percent'></td>
				</tr>
				<tr>
					<td><label for='cash_discount_amt'><?php echo lang('cash_discount_amt')?></label></td>
					<td><input id='cash_discount_amt' class='text_input' name='cash_discount_amt'></td>
				</tr>
				<tr>
					<td><label for='vat'><?php echo lang('vat')?></label></td>
					<td><input id='vat' class='text_input' name='vat'></td>
				</tr>
				<tr>
					<td><label for='vat_parts'><?php echo lang('vat_parts')?></label></td>
					<td><input id='vat_parts' class='text_input' name='vat_parts'></td>
				</tr>
				<tr>
					<td><label for='net_total'><?php echo lang('net_total')?></label></td>
					<td><input id='net_total' class='text_input' name='net_total'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStockyard_countersaleSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStockyard_countersaleCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var stockyard_countersalesDataSource =
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
			{ name: 'issue_date', type: 'date' },
			{ name: 'creadit_account', type: 'string' },
			{ name: 'price_option', type: 'string' },
			{ name: 'vro', type: 'string' },
			{ name: 'countersale_no', type: 'number' },
			{ name: 'issueCountersaeIssueNo', type: 'number' },
			{ name: 'total_for_parts', type: 'string' },
			{ name: 'dealer_total_for_parts', type: 'string' },
			{ name: 'cash_discount_percent', type: 'string' },
			{ name: 'cash_discount_amt', type: 'string' },
			{ name: 'vat', type: 'string' },
			{ name: 'vat_parts', type: 'string' },
			{ name: 'net_total', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/stockyard_countersales/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stockyard_countersalesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStockyard_countersale").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStockyard_countersale").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStockyard_countersale").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stockyard_countersalesDataSource,
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
			container.append($('#jqxGridStockyard_countersaleToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editStockyard_countersaleRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("issue_date"); ?>',datafield: 'issue_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("creadit_account"); ?>',datafield: 'creadit_account',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price_option"); ?>',datafield: 'price_option',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vro"); ?>',datafield: 'vro',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("countersale_no"); ?>',datafield: 'countersale_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("issueCountersaeIssueNo"); ?>',datafield: 'issueCountersaeIssueNo',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("total_for_parts"); ?>',datafield: 'total_for_parts',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_total_for_parts"); ?>',datafield: 'dealer_total_for_parts',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("cash_discount_percent"); ?>',datafield: 'cash_discount_percent',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("cash_discount_amt"); ?>',datafield: 'cash_discount_amt',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vat"); ?>',datafield: 'vat',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vat_parts"); ?>',datafield: 'vat_parts',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("net_total"); ?>',datafield: 'net_total',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridStockyard_countersale").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStockyard_countersaleFilterClear', function () { 
		$('#jqxGridStockyard_countersale').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStockyard_countersaleInsert', function () { 
		openPopupWindow('jqxPopupWindowStockyard_countersale', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowStockyard_countersale").jqxWindow({ 
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

    $("#jqxPopupWindowStockyard_countersale").on('close', function () {
        reset_form_stockyard_countersales();
    });

    $("#jqxStockyard_countersaleCancelButton").on('click', function () {
        reset_form_stockyard_countersales();
        $('#jqxPopupWindowStockyard_countersale').jqxWindow('close');
    });

    /*$('#form-stockyard_countersales').jqxValidator({
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

			{ input: '#creadit_account', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#creadit_account').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#price_option', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#price_option').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vro', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vro').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#countersale_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#countersale_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#issueCountersaeIssueNo', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#issueCountersaeIssueNo').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#total_for_parts', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#total_for_parts').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_total_for_parts', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_total_for_parts').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#cash_discount_percent', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#cash_discount_percent').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#cash_discount_amt', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#cash_discount_amt').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vat', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vat').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vat_parts', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vat_parts').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#net_total', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#net_total').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxStockyard_countersaleSubmitButton").on('click', function () {
        saveStockyard_countersaleRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStockyard_countersaleRecord();
                }
            };
        $('#form-stockyard_countersales').jqxValidator('validate', validationResult);
        */
    });
});

function editStockyard_countersaleRecord(index){
    var row =  $("#jqxGridStockyard_countersale").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#stockyard_countersales_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#issue_date').jqxDateTimeInput('setDate', row.issue_date);
		$('#creadit_account').val(row.creadit_account);
		$('#price_option').val(row.price_option);
		$('#vro').val(row.vro);
		$('#countersale_no').jqxNumberInput('val', row.countersale_no);
		$('#issueCountersaeIssueNo').jqxNumberInput('val', row.issueCountersaeIssueNo);
		$('#total_for_parts').val(row.total_for_parts);
		$('#dealer_total_for_parts').val(row.dealer_total_for_parts);
		$('#cash_discount_percent').val(row.cash_discount_percent);
		$('#cash_discount_amt').val(row.cash_discount_amt);
		$('#vat').val(row.vat);
		$('#vat_parts').val(row.vat_parts);
		$('#net_total').val(row.net_total);
		
        openPopupWindow('jqxPopupWindowStockyard_countersale', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStockyard_countersaleRecord(){
    var data = $("#form-stockyard_countersales").serialize();
	
	$('#jqxPopupWindowStockyard_countersale').block({ 
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
        url: '<?php echo site_url("admin/stockyard_countersales/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_stockyard_countersales();
                $('#jqxGridStockyard_countersale').jqxGrid('updatebounddata');
                $('#jqxPopupWindowStockyard_countersale').jqxWindow('close');
            }
            $('#jqxPopupWindowStockyard_countersale').unblock();
        }
    });
}

function reset_form_stockyard_countersales(){
	$('#stockyard_countersales_id').val('');
    $('#form-stockyard_countersales')[0].reset();
}
</script>