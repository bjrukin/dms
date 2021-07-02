<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('stock_yards'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('stock_yards'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridStock_yardToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_yardInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_yardFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridStock_yard"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStock_yard">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-stock_yards', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "stock_yards_id"/>
            <table class="form-table">
				
				<tr>
					<td><label for='stock_yards_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='stock_yards_name' class='text_input' name='name'></td>
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
					<td><label for='stock_yards_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='stock_yards_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_yardSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_yardCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var stock_yardsDataSource =
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
			{ name: 'name', type: 'string' },
			{ name: 'longitude', type: 'string' },
			{ name: 'latitude', type: 'string' },
			{ name: 'rank', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/stock_yards/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	stock_yardsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridStock_yard").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridStock_yard").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridStock_yard").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: stock_yardsDataSource,
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
			container.append($('#jqxGridStock_yardToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editStock_yardRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
//			{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
//			{ text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
//			{ text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
//			{ text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
//			{ text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
//			{ text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
//			{ text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("latitude"); ?>',datafield: 'latitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("longitude"); ?>',datafield: 'longitude',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridStock_yard").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridStock_yardFilterClear', function () { 
		$('#jqxGridStock_yard').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridStock_yardInsert', function () { 
		openPopupWindow('jqxPopupWindowStock_yard', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowStock_yard").jqxWindow({ 
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

    $("#jqxPopupWindowStock_yard").on('close', function () {
        reset_form_stock_yards();
    });

    $("#jqxStock_yardCancelButton").on('click', function () {
        reset_form_stock_yards();
        $('#jqxPopupWindowStock_yard').jqxWindow('close');
    });

    /*$('#form-stock_yards').jqxValidator({
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

			{ input: '#stock_yards_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stock_yards_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#longitude', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#longitude').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#latitude', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#latitude').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#stock_yards_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#stock_yards_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxStock_yardSubmitButton").on('click', function () {
        saveStock_yardRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStock_yardRecord();
                }
            };
        $('#form-stock_yards').jqxValidator('validate', validationResult);
        */
    });
});

function editStock_yardRecord(index){
    var row =  $("#jqxGridStock_yard").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#stock_yards_id').val(row.id);
//        $('#created_by').jqxNumberInput('val', row.created_by);
//		$('#updated_by').jqxNumberInput('val', row.updated_by);
//		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
//		$('#created_at').val(row.created_at);
//		$('#updated_at').val(row.updated_at);
//		$('#deleted_at').val(row.deleted_at);
		$('#stock_yards_name').val(row.name);
		$('#longitude').val(row.longitude);
		$('#latitude').val(row.latitude);
		$('#stock_yards_rank').jqxNumberInput('val', row.rank);
		
        openPopupWindow('jqxPopupWindowStock_yard', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStock_yardRecord(){
    var data = $("#form-stock_yards").serialize();
	
	$('#jqxPopupWindowStock_yard').block({ 
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
        url: '<?php echo site_url("admin/stock_yards/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_stock_yards();
                $('#jqxGridStock_yard').jqxGrid('updatebounddata');
                $('#jqxPopupWindowStock_yard').jqxWindow('close');
            }
            $('#jqxPopupWindowStock_yard').unblock();
        }
    });
}

function reset_form_stock_yards(){
	$('#stock_yards_id').val('');
    $('#form-stock_yards')[0].reset();
}
</script>