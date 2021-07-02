<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('vehicles'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('vehicles'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridVehicleToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridVehicleInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridVehicleFilterClear"><?php echo lang('general_clear'); ?></button>
					<button type="button" class="btn btn-success btn-flat btn-xs" id="jqxImport"><?php echo lang('import');?></button>
					<a href="<?php echo site_url('vehicles/generate_excel') ?>"><button type="button" class="btn btn-warning btn-flat btn-xs"><?php echo lang('export');?></button></a>
				</div>
				<div id="jqxGridVehicle"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowVehicle">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-vehicles', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "vehicles_id"/>
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
					<td><label for='color_id'><?php echo lang('color_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='color_id' name='color_id'></div></td>
				</tr>
				<tr>
					<td><label for='price'><?php echo lang('price')?><span class='mandatory'>*</span></label></td>
					<td><input type="text" name="price" id="price" class="text_input"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><span><label class='jqx-validator-error-label' id="combination-exists"></span></td>
				</tr>
                <tr>
                    <th colspan="2">
                    <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxVehicleSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxVehicleCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="jqxPopupWindowVehicle_import">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Upload a File</span>
	</div>
	<div class="form_fields_area">
		<span><h4>Upload a File</h4></span>
		<form action="<?php echo site_url('admin/vehicles/upload_vehicles') ?>" id="order_form" method="post" enctype="multipart/form-data">			
			<input type="file" name="userfile" style="float: left;">
			<button type="submit">Import</button>
		</form>				
	</div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	//mst_vehicles
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
        valueMember: "id",
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
        valueMember: "id",
    });

    // mst_colors
    masterDataSource.data = {table_name: 'mst_colors'};

    colorAdapter = new $.jqx.dataAdapter(masterDataSource);

    $("#color_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: colorAdapter,
        displayMember: "name",
        valueMember: "id",
    });

	var vehiclesDataSource =
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
			{ name: 'variant_id', type: 'number' },
			{ name: 'color_id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'price', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/vehicles/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	vehiclesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridVehicle").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridVehicle").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridVehicle").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: vehiclesDataSource,
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
			container.append($('#jqxGridVehicleToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editVehicleRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color_id"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridVehicle").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridVehicleFilterClear', function () { 
		$('#jqxGridVehicle').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridVehicleInsert', function () { 
		openPopupWindow('jqxPopupWindowVehicle', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });
    $(document).on('click','#jqxImport', function () { 
		openPopupWindow('jqxPopupWindowVehicle_import', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});


	// initialize the popup window
    $("#jqxPopupWindowVehicle").jqxWindow({ 
        theme: theme,
        width: 500,
        maxWidth: 500,
        height: 300,  
        maxHeight: 300,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowVehicle").on('close', function () {
        reset_form_vehicles();
    });

    $("#jqxVehicleCancelButton").on('click', function () {
        reset_form_vehicles();
        $('#jqxPopupWindowVehicle').jqxWindow('close');
    });
    $("#jqxPopupWindowVehicle_import").jqxWindow({ 
		theme: theme,
		width: '50%',
		maxWidth: '50%',
		height: '40%',  
		maxHeight: '40%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

    $('#form-vehicles').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#variant_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#variant_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#color_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#color_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			// { input: '#vehicles_id', message: 'Combination Already Exists', action: 'blur', 
			// 	rule: function(input,commit) {
			// 		vehicle_id 	= $('#vehicle_id').jqxComboBox('val'); 
   //              	variant_id 	= $('#variant_id').jqxComboBox('val'); 
   //              	color_id 	= $('#color_id').jqxComboBox('val');
                	
   //              	if(vehicle_id > 0 && variant_id> 0 && color_id> 0) {
			// 			$.ajax({
	  //                       url: "<?php echo site_url('admin/vehicles/check_duplicate'); ?>",
	  //                       type: 'POST',
	  //                       data: {
	  //                       	id 			: $('input#vehicles_id').val(), 
	  //                       	vehicle_id 	: vehicle_id, 
	  //                       	variant_id 	: variant_id, 
	  //                       	color_id 	: color_id
	  //                       },
	  //                       success: function (result) {
	  //                           var result = eval('('+result+')');
	  //                           msg = '';
	  //                           if(result.success == false){
	  //                           	msg = 'Combination Already Exists';	
	  //                           } 

	  //                           $('#combination-exists').html(msg);
	  //                           return commit(result.success);
	  //                       },
	  //                       error: function(result) {
	                        	
	  //                           return commit(false);
	  //                       }
	  //                   });
			// 		} else {
			// 			return true;
			// 		}
			// 	}
			// },

        ]
    });

    $("#jqxVehicleSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveVehicleRecord();
                }
            };
        $('#form-vehicles').jqxValidator('validate', validationResult);
        
    });
});

function editVehicleRecord(index){
    var row =  $("#jqxGridVehicle").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#vehicles_id').val(row.id);
        $('#vehicle_id').jqxComboBox('val', row.vehicle_id);
		$('#variant_id').jqxComboBox('val', row.variant_id);
		$('#color_id').jqxComboBox('val', row.color_id);
		$('#price').val(row.price);
		
        openPopupWindow('jqxPopupWindowVehicle', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveVehicleRecord(){
    var data = $("#form-vehicles").serialize();
	
	$('#jqxPopupWindowVehicle').block({ 
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
        url: '<?php echo site_url("admin/vehicles/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_vehicles();
                $('#jqxGridVehicle').jqxGrid('updatebounddata');
                $('#jqxPopupWindowVehicle').jqxWindow('close');
            }
            $('#jqxPopupWindowVehicle').unblock();
        }
    });
}

function reset_form_vehicles(){
	$('#vehicles_id').val('');
	$('#price').val('');
    $('#form-vehicles')[0].reset();

    $('#vehicle_id').jqxComboBox('clearSelection');
    $('#variant_id').jqxComboBox('clearSelection');
    $('#color_id').jqxComboBox('clearSelection');

    $('#vehicle_id').jqxComboBox('selectIndex', '-1');
	$('#variant_id').jqxComboBox('selectIndex', '-1');
	$('#color_id').jqxComboBox('selectIndex', '-1');

	$('#combination-exists').html('');
}
</script>