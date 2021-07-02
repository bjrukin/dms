<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_categories'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('spareparts_categories'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_categoryToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_categoryInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_categoryFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_category"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_category">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-spareparts_categories', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "spareparts_categories_id"/>
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
					<td><label for='spareparts_categories_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><div id='spareparts_categories_name' class='number_general' name='name'></div></td>
				</tr>
				<tr>
					<td><label for='spareparts_categories_rank'><?php echo lang('rank')?><span class='mandatory'>*</span></label></td>
					<td><div id='spareparts_categories_rank' class='number_general' name='rank'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_categorySubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_categoryCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var spareparts_categoriesDataSource =
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
			{ name: 'name', type: 'number' },
			{ name: 'rank', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/spareparts_categories/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_categoriesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_category").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_category").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_category").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_categoriesDataSource,
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
			container.append($('#jqxGridSpareparts_categoryToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editSpareparts_categoryRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("rank"); ?>',datafield: 'rank',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridSpareparts_category").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_categoryFilterClear', function () { 
		$('#jqxGridSpareparts_category').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_categoryInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_category', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowSpareparts_category").jqxWindow({ 
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

    $("#jqxPopupWindowSpareparts_category").on('close', function () {
        reset_form_spareparts_categories();
    });

    $("#jqxSpareparts_categoryCancelButton").on('click', function () {
        reset_form_spareparts_categories();
        $('#jqxPopupWindowSpareparts_category').jqxWindow('close');
    });

    /*$('#form-spareparts_categories').jqxValidator({
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

			{ input: '#spareparts_categories_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#spareparts_categories_name').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#spareparts_categories_rank', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#spareparts_categories_rank').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxSpareparts_categorySubmitButton").on('click', function () {
        saveSpareparts_categoryRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSpareparts_categoryRecord();
                }
            };
        $('#form-spareparts_categories').jqxValidator('validate', validationResult);
        */
    });
});

function editSpareparts_categoryRecord(index){
    var row =  $("#jqxGridSpareparts_category").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#spareparts_categories_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#spareparts_categories_name').jqxNumberInput('val', row.name);
		$('#spareparts_categories_rank').jqxNumberInput('val', row.rank);
		
        openPopupWindow('jqxPopupWindowSpareparts_category', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveSpareparts_categoryRecord(){
    var data = $("#form-spareparts_categories").serialize();
	
	$('#jqxPopupWindowSpareparts_category').block({ 
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
        url: '<?php echo site_url("admin/spareparts_categories/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_spareparts_categories();
                $('#jqxGridSpareparts_category').jqxGrid('updatebounddata');
                $('#jqxPopupWindowSpareparts_category').jqxWindow('close');
            }
            $('#jqxPopupWindowSpareparts_category').unblock();
        }
    });
}

function reset_form_spareparts_categories(){
	$('#spareparts_categories_id').val('');
    $('#form-spareparts_categories')[0].reset();
}
</script>