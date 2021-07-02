<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('stock_records'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('stock_records'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
                    <?php /*<div class="col-xs-12">
                        <select name="stock_yard_id" id='stock_yard_id'>
                            <option>--select stock-yard--</option>
                            <?php foreach($stock_yards as $key => $value){?>
                            <option value="<?php echo $value->id?>"><?php echo $value->name?></option>
                            <?php }?>
                        </select>
                    </div>*/?>
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
<!--				<div id='jqxGridStock_recordToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_recordInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_recordFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>-->
				<div id="jqxGridStock_record"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStock_record">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-stock_records', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "stock_records_id"/>
            <table class="form-table">
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='stock_yard_id'><?php echo lang('stock_yard_id')?></label></td>
					<td><div id='stock_yard_id' class='number_general' name='stock_yard_id'></div></td>
				</tr>
				<tr>
					<td><label for='reached_date'><?php echo lang('reached_date')?></label></td>
					<td><input id='reached_date' class='text_input' name='reached_date'></td>
				</tr>
				<tr>
					<td><label for='dispatched_date'><?php echo lang('dispatched_date')?></label></td>
					<td><input id='dispatched_date' class='text_input' name='dispatched_date'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_recordSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var stock_recordsDataSource =
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
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'stock_yard_id', type: 'number' },
			{ name: 'reached_date', type: 'string' },
			{ name: 'dispatched_date', type: 'string' },
                        { name: 'vehicle_name', type: 'string' },
                        { name: 'variant_name', type: 'string' },
                        { name: 'color_name', type: 'string' },
                        { name: 'color_code', type: 'string' },
                        { name: 'engine_no', type: 'string' },
                        { name: 'chass_no', type: 'string' },
                        { name: 'stockyard_name', type: 'string' },
                        { name: 'barcode', type: 'string' },
                        { name: 'dealer_name', type: 'string' },
                        { name: 'city_name', type: 'string' },
                        { name: 'district_name', type: 'string' },
                        { name: 'mun_vdc_name', type: 'string' },
                        { name: 'received_date', type: 'string' },
                        { name: 'vehicle_count', type: 'string' },
                        
			
        ],
		url: '<?php echo site_url("admin/stock_records/stock_yard_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stock_recordsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStock_record").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStock_record").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStock_record").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stock_recordsDataSource,
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
			container.append($('#jqxGridStock_recordToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
//			{
//				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
//				cellsrenderer: function (index) {
//					var e = '<a href="javascript:void(0)" onclick="editStock_recordRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
//					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
//				}
//			},
			{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_code"); ?>',datafield: 'color_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("stock_yard"); ?>',datafield: 'stockyard_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'vehicle_count',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridStock_record").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStock_recordFilterClear', function () { 
		$('#jqxGridStock_record').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStock_recordInsert', function () { 
		openPopupWindow('jqxPopupWindowStock_record', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowStock_record").jqxWindow({ 
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

    $("#jqxPopupWindowStock_record").on('close', function () {
        reset_form_stock_records();
    });

    $("#jqxStock_recordCancelButton").on('click', function () {
        reset_form_stock_records();
        $('#jqxPopupWindowStock_record').jqxWindow('close');
    });

    /*$('#form-stock_records').jqxValidator({
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

			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#stock_yard_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stock_yard_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#reached_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#reached_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatched_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatched_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxStock_recordSubmitButton").on('click', function () {
        saveStock_recordRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStock_recordRecord();
                }
            };
        $('#form-stock_records').jqxValidator('validate', validationResult);
        */
    });
    //for displaying record of selected stock_yard
//    $('#stock_yard_id').change(function(){
//        var id = $(this).val();
//        $.post('<?php echo site_url("admin/stock_records/stock_json"); ?>',{id:id},function(data){},'json');
//    })
    
});

function editStock_recordRecord(index){
    var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#stock_records_id').val(row.id);
		$('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
		$('#stock_yard_id').jqxNumberInput('val', row.stock_yard_id);
		$('#reached_date').val(row.reached_date);
		$('#dispatched_date').val(row.dispatched_date);
		
        openPopupWindow('jqxPopupWindowStock_record', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStock_recordRecord(){
    var data = $("#form-stock_records").serialize();
	
	$('#jqxPopupWindowStock_record').block({ 
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
        url: '<?php echo site_url("admin/stock_records/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_stock_records();
                $('#jqxGridStock_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowStock_record').jqxWindow('close');
            }
            $('#jqxPopupWindowStock_record').unblock();
        }
    });
}

function reset_form_stock_records(){
	$('#stock_records_id').val('');
    $('#form-stock_records')[0].reset();
}
</script>