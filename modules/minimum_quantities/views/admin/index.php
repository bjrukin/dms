<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('minimum_quantities'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('minimum_quantities'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridMinimum_quantityToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridMinimum_quantityInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridMinimum_quantityFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridMinimum_quantity"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowMinimum_quantity">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-minimum_quantities', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "minimum_quantities_id"/>
            <table class="form-table">
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<td><div id='vehicle_id' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='variant_id'><?php echo lang('variant_id')?></label></td>
					<td><div id='variant_id' name='variant_id'></div></td>
				</tr>
				<tr>
					<td><label for='color_id'><?php echo lang('color_id')?></label></td>
					<td><div id='color_id' name='color_id'></div></td>
				</tr>
				<tr>
					<td><label for='quantity'><?php echo lang('quantity')?></label></td>
					<td><div id='quantity' class='number_general' name='quantity'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxMinimum_quantitySubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxMinimum_quantityCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
	$('#variant_id').hide();
	$('#color_id').hide();
	var minimum_quantitiesDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'color_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/minimum_quantities/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	minimum_quantitiesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridMinimum_quantity").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMinimum_quantity").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridMinimum_quantity").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: minimum_quantitiesDataSource,
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
        showAggregates: true,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridMinimum_quantityToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editMinimum_quantityRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_id"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, aggregates: ['sum'] },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridMinimum_quantity").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridMinimum_quantityFilterClear', function () { 
		$('#jqxGridMinimum_quantity').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridMinimum_quantityInsert', function () { 
		openPopupWindow('jqxPopupWindowMinimum_quantity', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowMinimum_quantity").jqxWindow({ 
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

    $("#jqxPopupWindowMinimum_quantity").on('close', function () {
        reset_form_minimum_quantities();
    });

    $("#jqxMinimum_quantityCancelButton").on('click', function () {
        reset_form_minimum_quantities();
        $('#jqxPopupWindowMinimum_quantity').jqxWindow('close');
    });

    $("#vehicle_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: array_vehicles,
        displayMember: "name",
        valueMember: "id",
    });

    $("#vehicle_id").bind('select', function (event) {

        if (!event.args)
            return;

        vehicle_id = $("#vehicle_id").jqxComboBox('val');
        $('#variant_id').show();	
        var variantDataSource = {
            url: '<?php echo site_url("admin/dealer_orders/get_variants_combo_json"); ?>',
            datatype: 'json',
            datafields: [
            {name: 'variant_id', type: 'number'},
            {name: 'variant_name', type: 'string'},
            ],
            data: {
                vehicle_id: vehicle_id
            },
            async: false,
            cache: true
        }
        variantDataAdapter = new $.jqx.dataAdapter(variantDataSource, {autoBind: false});

        $("#variant_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: variantDataAdapter,
            displayMember: "variant_name",
            valueMember: "variant_id",
        });
    });

    $("#variant_id").bind('select', function (event) {

        if (!event.args)
            return;

        vehicle_id = $("#vehicle_id").jqxComboBox('val');
        variant_id = $("#variant_id").jqxComboBox('val');
	$('#color_id').show();

        var colorDataSource = {
            url: '<?php echo site_url("admin/dealer_orders/get_colors_combo_json"); ?>',
            datatype: 'json',
            datafields: [
            {name: 'color_id', type: 'number'},
            {name: 'color_name', type: 'string'},
            ],
            data: {
                vehicle_id: vehicle_id,
                variant_id: variant_id
            },
            async: false,
            cache: true
        }

        colorDataAdapter = new $.jqx.dataAdapter(colorDataSource, {autoBind: false});
        $("#color_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: colorDataAdapter,
            displayMember: "color_name",
            valueMember: "color_id",
        });
    });
    /*$('#form-minimum_quantities').jqxValidator({
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

			{ input: '#variant_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#variant_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#color_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#color_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxMinimum_quantitySubmitButton").on('click', function () {
        saveMinimum_quantityRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveMinimum_quantityRecord();
                }
            };
        $('#form-minimum_quantities').jqxValidator('validate', validationResult);
        */
    });
});

function editMinimum_quantityRecord(index){
    var row =  $("#jqxGridMinimum_quantity").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#minimum_quantities_id').val(row.id);
		$('#vehicle_id').jqxComboBox('val', row.vehicle_id);
		$('#variant_id').jqxComboBox('val', row.variant_id);
		$('#color_id').jqxComboBox('val', row.color_id);
		$('#quantity').jqxNumberInput('val', row.quantity);
		
        openPopupWindow('jqxPopupWindowMinimum_quantity', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveMinimum_quantityRecord(){
    var data = $("#form-minimum_quantities").serialize();
	
	$('#jqxPopupWindowMinimum_quantity').block({ 
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
        url: '<?php echo site_url("admin/minimum_quantities/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_minimum_quantities();
                $('#jqxGridMinimum_quantity').jqxGrid('updatebounddata');
                $('#jqxPopupWindowMinimum_quantity').jqxWindow('close');
            }
            $('#jqxPopupWindowMinimum_quantity').unblock();
        }
    });
}

function reset_form_minimum_quantities(){
	$('#minimum_quantities_id').val('');
    $('#form-minimum_quantities')[0].reset();
}
</script>