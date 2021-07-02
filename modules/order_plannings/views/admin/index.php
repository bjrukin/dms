<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('order_plannings'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('order_plannings'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridOrder_planningToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridOrder_planningInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridOrder_planningFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridOrder_planning"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
    <a href="<?php echo base_url('order_plannings/read_file')?>">read</a>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowOrder_planning">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-order_plannings', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "order_plannings_id"/>
            <table class="form-table">
				<tr>
					<td><label for='file'>Upload File</label></td>
                                        <td><input type="file"></td>
				</tr>
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?></label></td>
					<!--<td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>-->
					<!--<td><input id='vehicle_id' class='text_input' name='vehicle_id'></td>-->
                                        <td><div id='vehicle_id' name='vehicle_id'></div></td>
				</tr>
				<tr>
					<td><label for='varient'><?php echo lang('varient')?></label></td>
					<td><input id='varient' class='text_input' name='varient'></td>
				</tr>
				<tr>
					<td><label for='color'><?php echo lang('color')?></label></td>
					<td><input id='color' class='text_input' name='color'></td>
				</tr>
				<tr>
					<td><label for='code'><?php echo lang('code')?></label></td>
					<td><input id='code' class='text_input' name='code'></td>
				</tr>
				<tr>
					<td><label for='dealer'><?php echo lang('dealer')?></label></td>
					<td><input id='dealer' class='text_input' name='dealer'></td>
				</tr>
				<tr>
					<td><label for='year'><?php echo lang('year')?></label></td>
					<td><div id='year' class='number_general' name='year'></div></td>
				</tr>
				<tr>
					<td><label for='month'><?php echo lang('month')?></label></td>
					<td><div id='month' class='number_general' name='month'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxOrder_planningSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxOrder_planningCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
    
//    $("#vehicle_id").jqxComboBox({
//        theme: theme,
//        width: 195,
//        height: 25,
//        selectionMode: 'dropDownList',
//        autoComplete: true,
//        searchMode: 'containsignorecase',
//        source: vehicleAdapter,
//        displayMember: "name",
//        valueMember: "id",
//    });
    
	var order_planningsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'varient', type: 'string' },
			{ name: 'color', type: 'string' },
			{ name: 'code', type: 'string' },
			{ name: 'dealer', type: 'string' },
			{ name: 'year', type: 'number' },
			{ name: 'month', type: 'number' },
			{ name: 'name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/order_plannings/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	order_planningsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridOrder_planning").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridOrder_planning").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridOrder_planning").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: order_planningsDataSource,
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
			container.append($('#jqxGridOrder_planningToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editOrder_planningRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
//			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("varient"); ?>',datafield: 'varient',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("color"); ?>',datafield: 'color',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("code"); ?>',datafield: 'code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dealer"); ?>',datafield: 'dealer',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("month"); ?>',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridOrder_planning").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridOrder_planningFilterClear', function () { 
		$('#jqxGridOrder_planning').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridOrder_planningInsert', function () { 
		openPopupWindow('jqxPopupWindowOrder_planning', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowOrder_planning").jqxWindow({ 
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

    $("#jqxPopupWindowOrder_planning").on('close', function () {
        reset_form_order_plannings();
    });

    $("#jqxOrder_planningCancelButton").on('click', function () {
        reset_form_order_plannings();
        $('#jqxPopupWindowOrder_planning').jqxWindow('close');
    });

    /*$('#form-order_plannings').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#vehicle_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#varient', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#varient').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#color', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#color').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#code', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#code').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dealer', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#year', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#year').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#month', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#month').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxOrder_planningSubmitButton").on('click', function () {
        saveOrder_planningRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveOrder_planningRecord();
                }
            };
        $('#form-order_plannings').jqxValidator('validate', validationResult);
        */
    });
});

function editOrder_planningRecord(index){
    var row =  $("#jqxGridOrder_planning").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#order_plannings_id').val(row.id);
//        $('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
        $('#vehicle_id').val(row.name);
		$('#varient').val(row.varient);
		$('#color').val(row.color);
		$('#code').val(row.code);
		$('#dealer').val(row.dealer);
		$('#year').jqxNumberInput('val', row.year);
		$('#month').jqxNumberInput('val', row.month);
		
        openPopupWindow('jqxPopupWindowOrder_planning', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveOrder_planningRecord(){
    var data = $("#form-order_plannings").serialize();
	
	$('#jqxPopupWindowOrder_planning').block({ 
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
        url: '<?php echo site_url("admin/order_plannings/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_order_plannings();
                $('#jqxGridOrder_planning').jqxGrid('updatebounddata');
                $('#jqxPopupWindowOrder_planning').jqxWindow('close');
            }
            $('#jqxPopupWindowOrder_planning').unblock();
        }
    });
}

function reset_form_order_plannings(){
	$('#order_plannings_id').val('');
    $('#form-order_plannings')[0].reset();
}
</script>