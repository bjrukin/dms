<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('stockyards'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('stockyards'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridStockyardToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStockyardInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStockyardFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridStockyard"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStockyard">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-stockyards', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "stockyards_id"/>
            <table class="form-table">
				<tr>
					<td><label for='stockyards_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='stockyards_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td><label for='location'><?php echo lang('location')?><span class='mandatory'>*</span></label></td>
					<td><input id='location' class='text_input' name='location'></td>
				</tr>
				<tr>
					<td><label for='latitude'><?php echo lang('latitude')?></label></td>
					<td><input id='latitude' class='text_input' name='latitude'></td>
				</tr>
				<tr>
					<td><label for='longitude'><?php echo lang('longitude')?></label></td>
					<td><input id='longitude' class='text_input' name='longitude'></td>
				</tr>
				<tr>
					<td><label for='stockyards_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='stockyards_rank' class='number_general' name='rank'></div></td>
				</tr>
				<!-- <tr>
					<td><label for='type'><?php echo lang('type')?></label></td>
					<td><div id='type' class='number_general' name='type'></div></td>
				</tr> -->
				<!-- <tr>
					<td><label for='incharge_id'><?php echo lang('incharge_id')?></label></td>
					<td><div id='incharge_id' class='number_general' name='incharge_id'></div></td>
				</tr> -->
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStockyardSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStockyardCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="jqxPopupWindowStockyard_users">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="sparepart_user_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-stockyards_user', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "user_stockyards_id"/>
            <table class="form-table">
				
				<tr>
					<td><label for='user_id'><?php echo lang('user_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='user_id' class='' name='user_id'></div></div></td>
				</tr>
                
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStockyardUserSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStockyardUserCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	// user combobox
	var userDataSource = {
		url : '<?php echo site_url("admin/stockyards/get_user_combo_json"); ?>',
		datatype: 'json',
		datafields: [
		{ name: 'user_id', type: 'number' },
		{ name: 'username', type: 'string' },
		],
		async: false,
		cache: true,
		method: 'post',
	}

	userAdapter = new $.jqx.dataAdapter(userDataSource);

	$("#user_id").jqxComboBox({
		theme: theme,
		width: 195,
		height: 25,
		selectionMode: 'dropDownList',
		autoComplete: true,
		searchMode: 'containsignorecase',
		source: userAdapter,
		displayMember: "username",
		valueMember: "user_id",
		checkboxes: true,
		multiSelect: true,
	});

	var stockyardsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'latitude', type: 'string' },
			{ name: 'longitude', type: 'string' },
			{ name: 'rank', type: 'number' },
			{ name: 'type', type: 'number' },
			{ name: 'incharge_id', type: 'number' },
			{ name: 'location', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/stockyards/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stockyardsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStockyard").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStockyard").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStockyard").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stockyardsDataSource,
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
			container.append($('#jqxGridStockyardToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editStockyardRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					var u = '<a href="javascript:void(0)" onclick="add_users(' + index + '); return false;" title="Add Users"><i class="fa fa-users"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + ' | ' + u + '</div>';
				}
			},
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("location"); ?>',datafield: 'location',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("latitude"); ?>',datafield: 'latitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("longitude"); ?>',datafield: 'longitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("type"); ?>',datafield: 'type',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("incharge_id"); ?>',datafield: 'incharge_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridStockyard").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStockyardFilterClear', function () { 
		$('#jqxGridStockyard').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStockyardInsert', function () { 
		openPopupWindow('jqxPopupWindowStockyard', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowStockyard").jqxWindow({ 
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

    $("#jqxPopupWindowStockyard").on('close', function () {
        reset_form_stockyards();
    });

    $("#jqxStockyardCancelButton").on('click', function () {
        reset_form_stockyards();
        $('#jqxPopupWindowStockyard').jqxWindow('close');
    });

    // initialize the popup window
    $("#jqxPopupWindowStockyard_users").jqxWindow({ 
        theme: theme,
        width: '40%',
        maxWidth: '40%',
        height: '40%',  
        maxHeight: '40%',  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowStockyard_users").on('close', function () {
        reset_form_stockyards_user();
    });

    $("#jqxStockyardUserCancelButton").on('click', function () {
        reset_form_stockyards_user();
        $('#jqxPopupWindowStockyard_users').jqxWindow('close');
    });

    /*$('#form-stockyards').jqxValidator({
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

			{ input: '#stockyards_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stockyards_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#latitude', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#latitude').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#longitude', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#longitude').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#stockyards_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stockyards_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#type', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#type').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#incharge_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#incharge_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxStockyardSubmitButton").on('click', function () {
        saveStockyardRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStockyardRecord();
                }
            };
        $('#form-stockyards').jqxValidator('validate', validationResult);
        */
    });

    $("#jqxStockyardUserSubmitButton").on('click', function () {
        saveStockyardUserRecord();
    });
});

function editStockyardRecord(index){
    var row =  $("#jqxGridStockyard").jqxGrid('getrowdata', index);
  	if (row) {
		$('#stockyards_id').val(row.id);
		$('#stockyards_name').val(row.name);
		$('#latitude').val(row.latitude);
		$('#longitude').val(row.longitude);
		$('#stockyards_rank').jqxNumberInput('val', row.rank);
		$('#location').jqxNumberInput('val', row.location);
		// $('#type').jqxNumberInput('val', row.type);
		// $('#incharge_id').jqxNumberInput('val', row.incharge_id);
		
        openPopupWindow('jqxPopupWindowStockyard', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStockyardRecord(){
    var data = $("#form-stockyards").serialize();
	
	$('#jqxPopupWindowStockyard').block({ 
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
        url: '<?php echo site_url("admin/stockyards/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_stockyards();
                $('#jqxGridStockyard').jqxGrid('updatebounddata');
                $('#jqxPopupWindowStockyard').jqxWindow('close');
            }
            $('#jqxPopupWindowStockyard').unblock();
        }
    });
}

function reset_form_stockyards(){
	$('#stockyards_id').val('');
    $('#form-stockyards')[0].reset();
}

function add_users(index){
    var row =  $("#jqxGridStockyard").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#user_stockyards_id').val(row.id);
		$('#sparepart_user_title').html('<h4>'+row.name+'</h4>');

		$.ajax({
	        type: "POST",
	        url: '<?php echo site_url("admin/stockyards/getUsers"); ?>',
	        data: {id:row.id},
	        success: function (result) {
	            var result = eval('('+result+')');
	            console.log(result.rows);
	            $("#user_id").jqxComboBox('uncheckAll')
	            $.each(result.rows,function(key,value){
	            	console.log(value.id);
	            	$("#user_id").jqxComboBox('checkItem',value.user_id);
	            });
	            
	        }
	    });
		
        openPopupWindow('jqxPopupWindowStockyard_users', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStockyardUserRecord(){
    var data = $("#form-stockyards_user").serialize();
	
	$('#jqxPopupWindowStockyard_users').block({ 
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
        url: '<?php echo site_url("admin/stockyards/save_user"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_stockyards_user();
                $('#jqxGridStockyard').jqxGrid('updatebounddata');
                $('#jqxPopupWindowStockyard_users').jqxWindow('close');
            }
            $('#jqxPopupWindowStockyard_users').unblock();
        }
    });
}

function reset_form_stockyards_user() {
	$("#user_id").jqxComboBox('uncheckAll')
}
</script>