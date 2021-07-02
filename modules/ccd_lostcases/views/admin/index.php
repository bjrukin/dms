<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_lostcases'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('ccd_lostcases'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCcd_lostcaseToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCcd_lostcaseInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCcd_lostcaseFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCcd_lostcase"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCcd_lostcase">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-ccd_lostcases', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "ccd_lostcases_id"/>
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
					<td><label for='customer_id'><?php echo lang('customer_id')?></label></td>
					<td><div id='customer_id' class='number_general' name='customer_id'></div></td>
				</tr>
				<tr>
					<td><label for='call_status'><?php echo lang('call_status')?></label></td>
					<td><input id='call_status' class='text_input' name='call_status'></td>
				</tr>
				<tr>
					<td><label for='date_of_call'><?php echo lang('date_of_call')?></label></td>
					<td><div id='date_of_call' class='date_box' name='date_of_call'></div></td>
				</tr>
				<tr>
					<td><label for='date_of_call_np'><?php echo lang('date_of_call_np')?></label></td>
					<td><input id='date_of_call_np' class='text_input' name='date_of_call_np'></td>
				</tr>
				<tr>
					<td><label for='voc'><?php echo lang('voc')?></label></td>
					<td><input id='voc' class='text_input' name='voc'></td>
				</tr>
				<tr>
					<td><label for='exact_view_id'><?php echo lang('exact_view_id')?></label></td>
					<td><div id='exact_view_id' class='number_general' name='exact_view_id'></div></td>
				</tr>
				<tr>
					<td><label for='brand_id'><?php echo lang('brand_id')?></label></td>
					<td><div id='brand_id' class='number_general' name='brand_id'></div></td>
				</tr>
				<tr>
					<td><label for='model'><?php echo lang('model')?></label></td>
					<td><input id='model' class='text_input' name='model'></td>
				</tr>
				<tr>
					<td><label for='same_segment'><?php echo lang('same_segment')?></label></td>
					<td><input id='same_segment' class='text_input' name='same_segment'></td>
				</tr>
				<tr>
					<td><label for='similar_feature'><?php echo lang('similar_feature')?></label></td>
					<td><input id='similar_feature' class='text_input' name='similar_feature'></td>
				</tr>
				<tr>
					<td><label for='reason_of_deviation'><?php echo lang('reason_of_deviation')?></label></td>
					<td><div id='reason_of_deviation' class='number_general' name='reason_of_deviation'></div></td>
				</tr>
				<tr>
					<td><label for='sub_reason'><?php echo lang('sub_reason')?></label></td>
					<td><div id='sub_reason' class='number_general' name='sub_reason'></div></td>
				</tr>
				<tr>
					<td><label for='third_sub_reason'><?php echo lang('third_sub_reason')?></label></td>
					<td><div id='third_sub_reason' class='number_general' name='third_sub_reason'></div></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCcd_lostcaseSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCcd_lostcaseCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var ccd_lostcasesDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'call_status', type: 'string' },
			{ name: 'date_of_call', type: 'date' },
			{ name: 'date_of_call_np', type: 'string' },
			{ name: 'voc', type: 'string' },
			{ name: 'exact_view_id', type: 'number' },
			{ name: 'brand_id', type: 'number' },
			{ name: 'model', type: 'string' },
			{ name: 'same_segment', type: 'string' },
			{ name: 'similar_feature', type: 'string' },
			{ name: 'reason_of_deviation', type: 'number' },
			{ name: 'sub_reason', type: 'number' },
			{ name: 'third_sub_reason', type: 'number' },
			
        ],
		url: '<?php echo site_url("admin/ccd_lostcases/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	ccd_lostcasesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCcd_lostcase").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCcd_lostcase").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCcd_lostcase").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: ccd_lostcasesDataSource,
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
			container.append($('#jqxGridCcd_lostcaseToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editCcd_lostcaseRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
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
			{ text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("call_status"); ?>',datafield: 'call_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("date_of_call"); ?>',datafield: 'date_of_call',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("date_of_call_np"); ?>',datafield: 'date_of_call_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("voc"); ?>',datafield: 'voc',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("exact_view_id"); ?>',datafield: 'exact_view_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("brand_id"); ?>',datafield: 'brand_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("model"); ?>',datafield: 'model',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("same_segment"); ?>',datafield: 'same_segment',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("similar_feature"); ?>',datafield: 'similar_feature',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("reason_of_deviation"); ?>',datafield: 'reason_of_deviation',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sub_reason"); ?>',datafield: 'sub_reason',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("third_sub_reason"); ?>',datafield: 'third_sub_reason',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCcd_lostcase").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCcd_lostcaseFilterClear', function () { 
		$('#jqxGridCcd_lostcase').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCcd_lostcaseInsert', function () { 
		openPopupWindow('jqxPopupWindowCcd_lostcase', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowCcd_lostcase").jqxWindow({ 
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

    $("#jqxPopupWindowCcd_lostcase").on('close', function () {
        reset_form_ccd_lostcases();
    });

    $("#jqxCcd_lostcaseCancelButton").on('click', function () {
        reset_form_ccd_lostcases();
        $('#jqxPopupWindowCcd_lostcase').jqxWindow('close');
    });

    /*$('#form-ccd_lostcases').jqxValidator({
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

			{ input: '#customer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#customer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#call_status', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#call_status').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#date_of_call_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date_of_call_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#voc', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#voc').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#exact_view_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#exact_view_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#brand_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#brand_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#model', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#model').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#same_segment', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#same_segment').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#similar_feature', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#similar_feature').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#reason_of_deviation', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#reason_of_deviation').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#sub_reason', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sub_reason').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#third_sub_reason', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#third_sub_reason').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxCcd_lostcaseSubmitButton").on('click', function () {
        saveCcd_lostcaseRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCcd_lostcaseRecord();
                }
            };
        $('#form-ccd_lostcases').jqxValidator('validate', validationResult);
        */
    });
});

function editCcd_lostcaseRecord(index){
    var row =  $("#jqxGridCcd_lostcase").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#ccd_lostcases_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#customer_id').jqxNumberInput('val', row.customer_id);
		$('#call_status').val(row.call_status);
		$('#date_of_call').jqxDateTimeInput('setDate', row.date_of_call);
		$('#date_of_call_np').val(row.date_of_call_np);
		$('#voc').val(row.voc);
		$('#exact_view_id').jqxNumberInput('val', row.exact_view_id);
		$('#brand_id').jqxNumberInput('val', row.brand_id);
		$('#model').val(row.model);
		$('#same_segment').val(row.same_segment);
		$('#similar_feature').val(row.similar_feature);
		$('#reason_of_deviation').jqxNumberInput('val', row.reason_of_deviation);
		$('#sub_reason').jqxNumberInput('val', row.sub_reason);
		$('#third_sub_reason').jqxNumberInput('val', row.third_sub_reason);
		
        openPopupWindow('jqxPopupWindowCcd_lostcase', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveCcd_lostcaseRecord(){
    var data = $("#form-ccd_lostcases").serialize();
	
	$('#jqxPopupWindowCcd_lostcase').block({ 
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
        url: '<?php echo site_url("admin/ccd_lostcases/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_ccd_lostcases();
                $('#jqxGridCcd_lostcase').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCcd_lostcase').jqxWindow('close');
            }
            $('#jqxPopupWindowCcd_lostcase').unblock();
        }
    });
}

function reset_form_ccd_lostcases(){
	$('#ccd_lostcases_id').val('');
    $('#form-ccd_lostcases')[0].reset();
}
</script>