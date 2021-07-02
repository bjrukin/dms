<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_order_mismatches'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('msil_order_mismatches'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridMsil_order_mismatchToolbar' class='grid-toolbar'>
					
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridMsil_order_mismatchFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridMsil_order_mismatch"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowMsil_order_mismatch">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-msil_order_mismatches', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "msil_order_mismatches_id"/>
            <table class="form-table">
			
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='vehicle_id' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='variant_id'><?php echo lang('variant_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='variant_id' name='variant_id'></div></td>
				</tr>
				<tr>
					<td><label for='color_id'><?php echo lang('color')?><span class='mandatory'>*</span></label></td>
					<td><div id='color_id' name='color_id'></div></td>
				</tr>
				<tr>
					<td><label for='month'><?php echo lang('month')?></label></td>
					<td><div id='month' class='number_general' name='month'></div></td>
				</tr>
				<tr>
					<td><label for='year'><?php echo lang('year')?></label></td>
					<td><div id='year' class='number_general' name='year'></div></td>
				</tr>
				<tr>
					<td><label for='quantity'><?php echo lang('quantity')?></label></td>
					<td><div id='quantity' class='number_general' name='quantity'></div></td>
				</tr>
				<tr>
					<td><label for='firm_id'>Company<span class='mandatory'>*</span></label></td>
					<td><input class="text_input" id='firm_id' name='firm_id'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxMsil_order_mismatchSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxMsil_order_mismatchCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
	masterDataSource.data = {table_name: 'mst_vehicles'};

    vehicleAdapter = new $.jqx.dataAdapter(masterDataSource);

    $("#vehicle_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: vehicleAdapter,
        displayMember: "name",
        valueMember: "name",
    });

    //mst_variants
    masterDataSource.data = {table_name: 'mst_variants'};

    variantAdapter = new $.jqx.dataAdapter(masterDataSource);

    $("#variant_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: variantAdapter,
        displayMember: "name",
        valueMember: "name",
    });

    var colorDataSource  = {
		url : '<?php echo site_url("admin/msil_order_mismatches/get_colors_only_combo_json_mistmatch"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'name', type: 'string' },
		],
		async: false,
		cache: true
	}
    // mst_colors

    colorAdapter = new $.jqx.dataAdapter(colorDataSource);

    $("#color_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: colorAdapter,
        displayMember: "name",
        valueMember: "name",
    });	

    // masterDataSource.data = {table_name: 'mst_firms'};

    // firmAdapter = new $.jqx.dataAdapter(masterDataSource);

    // $("#firm_id").jqxComboBox({
    //     theme: theme,
    //     width: 195,
    //     height: 25,
    //     selectionMode: 'dropDownList',
    //     autoComplete: true,
    //     searchMode: 'containsignorecase',
    //     source: firmAdapter,
    //     displayMember: "prefix",
    //     valueMember: "prefix",
    // });

	var msil_order_mismatchesDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color', type: 'string' },
			{ name: 'month', type: 'number' },
			{ name: 'year', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'company', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/msil_order_mismatches/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	msil_order_mismatchesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridMsil_order_mismatch").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMsil_order_mismatch").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridMsil_order_mismatch").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: msil_order_mismatchesDataSource,
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
			container.append($('#jqxGridMsil_order_mismatchToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editMsil_order_mismatchRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color"); ?>',datafield: 'color',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("month"); ?>',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("company"); ?>',datafield: 'company',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridMsil_order_mismatch").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridMsil_order_mismatchFilterClear', function () { 
		$('#jqxGridMsil_order_mismatch').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridMsil_order_mismatchInsert', function () { 
		openPopupWindow('jqxPopupWindowMsil_order_mismatch', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowMsil_order_mismatch").jqxWindow({ 
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

    $("#jqxPopupWindowMsil_order_mismatch").on('close', function () {
        reset_form_msil_order_mismatches();
    });

    $("#jqxMsil_order_mismatchCancelButton").on('click', function () {
        reset_form_msil_order_mismatches();
        $('#jqxPopupWindowMsil_order_mismatch').jqxWindow('close');
    });

    $("#jqxMsil_order_mismatchSubmitButton").on('click', function () {
        saveMsil_order_mismatchRecord();
    });
});

function editMsil_order_mismatchRecord(index){
    var row =  $("#jqxGridMsil_order_mismatch").jqxGrid('getrowdata', index);
  	if (row) {
  		console.log(row);
  		// reset_form_msil_order_mismatches();
  		$('#vehicle_id').jqxComboBox('clearSelection');
		$('#color_id').jqxComboBox('clearSelection');
		$('#variant_id').jqxComboBox('clearSelection');
  		$('#msil_order_mismatches_id').val(row.id);
		// $('#vehicle_name').val(row.vehicle_name);
		// $('#variant_name').val(row.variant_name);
		// $('#color').val(row.color);
		$('#vehicle_id').jqxComboBox('val', row.vehicle_name);
		$('#color_id').jqxComboBox('val', row.color);
		$('#variant_id').jqxComboBox('val', row.variant_name);
		$('#firm_id').val(row.company);
		$('#month').jqxNumberInput('val', row.month);
		$('#year').jqxNumberInput('val', row.year);
		$('#quantity').jqxNumberInput('val', row.quantity);
		// $('#company').val(row.company);
		
        openPopupWindow('jqxPopupWindowMsil_order_mismatch', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveMsil_order_mismatchRecord(){
    var data = $("#form-msil_order_mismatches").serialize();
	
	$('#jqxPopupWindowMsil_order_mismatch').block({ 
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
        url: '<?php echo site_url("admin/msil_order_mismatches/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_msil_order_mismatches();
                $('#jqxGridMsil_order_mismatch').jqxGrid('updatebounddata');
                $('#jqxPopupWindowMsil_order_mismatch').jqxWindow('close');
            }
            $('#jqxPopupWindowMsil_order_mismatch').unblock();
        }
    });
}

function reset_form_msil_order_mismatches(){
	$('#msil_order_mismatches_id').val('');

	$('#vehicle_id').jqxComboBox('clearSelection');
	$('#color_id').jqxComboBox('clearSelection');
	$('#variant_id').jqxComboBox('clearSelection');
	$('#firm_id').val('');
	$('#month').val('');
	$('#year').val('');
	$('#quantity').val('');
    $('#form-msil_order_mismatches')[0].reset();
}
</script>