<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('daily_credits'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('daily_credits'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDaily_creditToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDaily_creditUpload"><?php echo 'Import'; ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDaily_creditFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDaily_credit"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDaily_credit">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-daily_credits', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "daily_credits_id"/>
            <table class="form-table">
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='date_en'><?php echo lang('date_en')?></label></td>
					<td><div id='date_en' class='date_box' name='date_en'></div></td>
				</tr>
				<tr>
					<td><label for='date_np'><?php echo lang('date_np')?></label></td>
					<td><input id='date_np' class='text_input' name='date_np'></td>
				</tr>
				<tr>
					<td><label for='credit_amount'><?php echo lang('credit_amount')?></label></td>
					<td><input id='credit_amount' class='text_input' name='credit_amount'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDaily_creditSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDaily_creditCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="jqxPopupWindowDaily_credit_upload">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title">Upload Daily Credit</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open_multipart(site_url("daily_credits/upload_file"), array('id' =>'form-daily_credits')); ?>
            <table class="form-table">
				<tr>
					<!-- <td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td> -->
					<td><input type="file" name="userfile"></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button class="btn btn-success btn-xs btn-flat" id="jqxDaily_credit_uploadSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDaily_credit_uploadCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var daily_creditsDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'date_en', type: 'date' },
			{ name: 'date_np', type: 'string' },
			{ name: 'credit_amount', type: 'number' },
			// { name: 'total_credit_amount', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/daily_credits/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	daily_creditsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDaily_credit").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDaily_credit").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDaily_credit").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: daily_creditsDataSource,
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
			container.append($('#jqxGridDaily_creditToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			// {
			// 	text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			// 	cellsrenderer: function (index) {
			// 		// var e = '<a href="javascript:void(0)" onclick="editDaily_creditRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
			// 		var v = '<a href="javascript:void(0)" onclick="view_creditRecord(' + index + '); return false;" title="View Detail"><i class="fa fa-eye"></i></a>';
			// 		return '<div style="text-align: center; margin-top: 8px;">' + v + '</div>';
			// 	}
			// },
			
			{ text: '<?php echo lang("dealer"); ?>',datafield: 'dealer_name',width: 300,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("date_en"); ?>',datafield: 'date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("date_np"); ?>',datafield: 'date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("credit_amount"); ?>',datafield: 'credit_amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDaily_credit").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDaily_creditFilterClear', function () { 
		$('#jqxGridDaily_credit').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDaily_creditInsert', function () { 
		openPopupWindow('jqxPopupWindowDaily_credit', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDaily_credit").jqxWindow({ 
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

    $("#jqxPopupWindowDaily_credit").on('close', function () {
        reset_form_daily_credits();
    });

    $("#jqxDaily_creditCancelButton").on('click', function () {
        reset_form_daily_credits();
        $('#jqxPopupWindowDaily_credit').jqxWindow('close');
    });


    $(document).on('click','#jqxGridDaily_creditUpload', function () { 
		openPopupWindow('jqxPopupWindowDaily_credit_upload', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDaily_credit_upload").jqxWindow({ 
        theme: theme,
        width: '25%',
        maxWidth: '25%',
        height: '15%',  
        maxHeight: '15%',  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    // $("#jqxPopupWindow_uploadDaily_credit").on('close', function () {
        // reset_form_daily_credits();
    // });

    $("#jqxDaily_credit_uploadCancelButton").on('click', function () {
        // reset_form_daily_credits();
        $('#jqxPopupWindowDaily_credit_upload').jqxWindow('close');
    });

    /*$('#form-daily_credits').jqxValidator({
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

			{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#credit_amount', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#credit_amount').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDaily_creditSubmitButton").on('click', function () {
        saveDaily_creditRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDaily_creditRecord();
                }
            };
        $('#form-daily_credits').jqxValidator('validate', validationResult);
        */
    });
});

function editDaily_creditRecord(index){
    var row =  $("#jqxGridDaily_credit").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#daily_credits_id').val(row.id);
        $('#created_by').jqxNumberInput('val', row.created_by);
		$('#updated_by').jqxNumberInput('val', row.updated_by);
		$('#deleted_by').jqxNumberInput('val', row.deleted_by);
		$('#created_at').val(row.created_at);
		$('#updated_at').val(row.updated_at);
		$('#deleted_at').val(row.deleted_at);
		$('#dealer_id').jqxNumberInput('val', row.dealer_id);
		$('#date_en').jqxDateTimeInput('setDate', row.date_en);
		$('#date_np').val(row.date_np);
		$('#credit_amount').val(row.credit_amount);
		
        openPopupWindow('jqxPopupWindowDaily_credit', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDaily_creditRecord(){
    var data = $("#form-daily_credits").serialize();
	
	$('#jqxPopupWindowDaily_credit').block({ 
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
        url: '<?php echo site_url("admin/daily_credits/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_daily_credits();
                $('#jqxGridDaily_credit').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDaily_credit').jqxWindow('close');
            }
            $('#jqxPopupWindowDaily_credit').unblock();
        }
    });
}

function reset_form_daily_credits(){
	$('#daily_credits_id').val('');
    $('#form-daily_credits')[0].reset();
}
</script>