<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('opening_stocks'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('opening_stocks'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridOpening_stockToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridOpening_stockInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridOpening_stockFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridOpening_stock"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowOpening_stock">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-opening_stocks', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "opening_stocks_id"/>
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
					<td><label for='opening_stock_date'><?php echo lang('opening_stock_date')?></label></td>
					<td><div id='opening_stock_date' class='date_box' name='opening_stock_date'></div></td>
				</tr>
				<tr>
					<td><label for='year'><?php echo lang('year')?></label></td>
					<td><input id='year' class='text_input' name='year'></td>
				</tr>
				<tr>
					<td><label for='month'><?php echo lang('month')?></label></td>
					<td><input id='month' class='text_input' name='month'></td>
				</tr>
				<tr>
					<td><label for='quantity'><?php echo lang('quantity')?></label></td>
					<td><div id='quantity' class='number_general' name='quantity'></div></td>
				</tr>
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxOpening_stockSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxOpening_stockCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var opening_stocksDataSource =
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
			{ name: 'opening_stock_date', type: 'date' },
			{ name: 'year', type: 'string' },
			{ name: 'month', type: 'string' },
			{ name: 'quantity', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/opening_stocks/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	opening_stocksDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridOpening_stock").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridOpening_stock").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridOpening_stock").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: opening_stocksDataSource,
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
			container.append($('#jqxGridOpening_stockToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editOpening_stockRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("opening_stock_date"); ?>',datafield: 'opening_stock_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("month"); ?>',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridOpening_stock").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridOpening_stockFilterClear', function () { 
		$('#jqxGridOpening_stock').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridOpening_stockInsert', function () { 
		openPopupWindow('jqxPopupWindowOpening_stock', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowOpening_stock").jqxWindow({ 
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

    $("#jqxPopupWindowOpening_stock").on('close', function () {
        reset_form_opening_stocks();
    });

    $("#jqxOpening_stockCancelButton").on('click', function () {
        reset_form_opening_stocks();
        $('#jqxPopupWindowOpening_stock').jqxWindow('close');
    });

    /*$('#form-opening_stocks').jqxValidator({
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

			{ input: '#year', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#year').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#month', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#month').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxOpening_stockSubmitButton").on('click', function () {
        saveOpening_stockRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveOpening_stockRecord();
                }
            };
        $('#form-opening_stocks').jqxValidator('validate', validationResult);
        */
    });
});

function editOpening_stockRecord(index){
    var row =  $("#jqxGridOpening_stock").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#opening_stocks_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#sparepart_id').jqxNumberInput('val', row.sparepart_id);
		$('#opening_stock_date').jqxDateTimeInput('setDate', row.opening_stock_date);
		$('#year').val(row.year);
		$('#month').val(row.month);
		$('#quantity').jqxNumberInput('val', row.quantity);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		
        openPopupWindow('jqxPopupWindowOpening_stock', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveOpening_stockRecord(){
    var data = $("#form-opening_stocks").serialize();
	
	$('#jqxPopupWindowOpening_stock').block({ 
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
        url: '<?php echo site_url("admin/opening_stocks/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_opening_stocks();
                $('#jqxGridOpening_stock').jqxGrid('updatebounddata');
                $('#jqxPopupWindowOpening_stock').jqxWindow('close');
            }
            $('#jqxPopupWindowOpening_stock').unblock();
        }
    });
}

function reset_form_opening_stocks(){
	$('#opening_stocks_id').val('');
    $('#form-opening_stocks')[0].reset();
}
</script>