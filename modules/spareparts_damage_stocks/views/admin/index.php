<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_damage_stocks'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('spareparts_damage_stocks'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_damage_stockToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_damage_stockInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_damage_stockFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_damage_stock"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_damage_stock">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-spareparts_damage_stocks', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "spareparts_damage_stocks_id"/>
            <table class="form-table">
				<tr>
					<td><label for='sparepart_id'><?php echo lang('sparepart_id')?></label></td>
					<td><div id='sparepart_id' class='number_general' name='sparepart_id'></div></td>
				</tr>
				<tr>
					<td><label for='quantity'><?php echo lang('quantity')?></label></td>
					<td><div id='quantity' class='number_general' name='quantity'></div></td>
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
					<td><label for='repair_date'><?php echo lang('repair_date')?></label></td>
					<td><div id='repair_date' class='date_box' name='repair_date'></div></td>
				</tr>
				<tr>
					<td><label for='repair_date_np'><?php echo lang('repair_date_np')?></label></td>
					<td><input id='repair_date_np' class='text_input' name='repair_date_np'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_damage_stockSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_damage_stockCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var spareparts_damage_stocksDataSource =
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
			{ name: 'quantity', type: 'number' },
			{ name: 'damage_date', type: 'date' },
			{ name: 'damage_date_np', type: 'string' },
			{ name: 'repair_date', type: 'date' },
			{ name: 'repair_date_np', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'latest_part_code', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/spareparts_damage_stocks/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_damage_stocksDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_damage_stock").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_damage_stock").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_damage_stock").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_damage_stocksDataSource,
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
			container.append($('#jqxGridSpareparts_damage_stockToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '';
					//var e = '<a href="javascript:void(0)" onclick="editSpareparts_damage_stockRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("damage_date"); ?>',datafield: 'damage_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("damage_date_np"); ?>',datafield: 'damage_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("repair_date"); ?>',datafield: 'repair_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("repair_date_np"); ?>',datafield: 'repair_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridSpareparts_damage_stock").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_damage_stockFilterClear', function () { 
		$('#jqxGridSpareparts_damage_stock').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_damage_stockInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_damage_stock', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowSpareparts_damage_stock").jqxWindow({ 
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

    $("#jqxPopupWindowSpareparts_damage_stock").on('close', function () {
        reset_form_spareparts_damage_stocks();
    });

    $("#jqxSpareparts_damage_stockCancelButton").on('click', function () {
        reset_form_spareparts_damage_stocks();
        $('#jqxPopupWindowSpareparts_damage_stock').jqxWindow('close');
    });

    /*$('#form-spareparts_damage_stocks').jqxValidator({
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

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#note', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#note').val();
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

        ]
    });*/

    $("#jqxSpareparts_damage_stockSubmitButton").on('click', function () {
        saveSpareparts_damage_stockRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSpareparts_damage_stockRecord();
                }
            };
        $('#form-spareparts_damage_stocks').jqxValidator('validate', validationResult);
        */
    });
});

function editSpareparts_damage_stockRecord(index){
    var row =  $("#jqxGridSpareparts_damage_stock").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#spareparts_damage_stocks_id').val(row.id);
        $('#sparepart_id').jqxNumberInput('val', row.sparepart_id);
		$('#quantity').jqxNumberInput('val', row.quantity);
		$('#damage_date').jqxDateTimeInput('setDate', row.damage_date);
		$('#damage_date_np').val(row.damage_date_np);
		$('#repair_date').jqxDateTimeInput('setDate', row.repair_date);
		$('#repair_date_np').val(row.repair_date_np);
		
        openPopupWindow('jqxPopupWindowSpareparts_damage_stock', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveSpareparts_damage_stockRecord(){
    var data = $("#form-spareparts_damage_stocks").serialize();
	
	$('#jqxPopupWindowSpareparts_damage_stock').block({ 
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
        url: '<?php echo site_url("admin/spareparts_damage_stocks/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_spareparts_damage_stocks();
                $('#jqxGridSpareparts_damage_stock').jqxGrid('updatebounddata');
                $('#jqxPopupWindowSpareparts_damage_stock').jqxWindow('close');
            }
            $('#jqxPopupWindowSpareparts_damage_stock').unblock();
        }
    });
}

function reset_form_spareparts_damage_stocks(){
	$('#spareparts_damage_stocks_id').val('');
    $('#form-spareparts_damage_stocks')[0].reset();
}
</script>