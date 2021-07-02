<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_dealer_opening_credits'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('spareparts_dealer_opening_credits'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_dealer_opening_creditToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_dealer_opening_creditInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_dealer_opening_creditFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_dealer_opening_credit"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_dealer_opening_credit">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-spareparts_dealer_opening_credits', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "spareparts_dealer_opening_credits_id"/>
            <table class="form-table">
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='opening_credit'><?php echo lang('opening_credit')?></label></td>
					<td><div id='opening_credit' class='number_general' name='opening_credit'></div></td>
				</tr>
				<tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_dealer_opening_creditSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_dealer_opening_creditCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
	var dealer_listSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id' },
			{ name: 'name' }
			],
			url: '<?php echo site_url('admin/spareparts_dealer_opening_credits/get_spareparts_dealers_combo_json') ?>',
			async: false
		};
		var dealer_listdataAdapter = new $.jqx.dataAdapter(dealer_listSource);
		
		$("#dealer_id").jqxComboBox({ 
			selectedIndex: 0, 
			source: dealer_listdataAdapter, 
			displayMember: "name", 
			valueMember: "id", 
			width: 200, 
			height: 25,

		});

	var spareparts_dealer_opening_creditsDataSource =
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
			{ name: 'opening_credit', type: 'number' },
			{ name: 'date', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/spareparts_dealer_opening_credits/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_dealer_opening_creditsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_dealer_opening_credit").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_dealer_opening_credit").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_dealer_opening_credit").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_dealer_opening_creditsDataSource,
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
			container.append($('#jqxGridSpareparts_dealer_opening_creditToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editSpareparts_dealer_opening_creditRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("opening_credit"); ?>',datafield: 'opening_credit',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridSpareparts_dealer_opening_credit").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_dealer_opening_creditFilterClear', function () { 
		$('#jqxGridSpareparts_dealer_opening_credit').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_dealer_opening_creditInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_dealer_opening_credit', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowSpareparts_dealer_opening_credit").jqxWindow({ 
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

    $("#jqxPopupWindowSpareparts_dealer_opening_credit").on('close', function () {
        reset_form_spareparts_dealer_opening_credits();
    });

    $("#jqxSpareparts_dealer_opening_creditCancelButton").on('click', function () {
        reset_form_spareparts_dealer_opening_credits();
        $('#jqxPopupWindowSpareparts_dealer_opening_credit').jqxWindow('close');
    });

    /*$('#form-spareparts_dealer_opening_credits').jqxValidator({
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

			{ input: '#opening_credit', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#opening_credit').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxSpareparts_dealer_opening_creditSubmitButton").on('click', function () {
        saveSpareparts_dealer_opening_creditRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveSpareparts_dealer_opening_creditRecord();
                }
            };
        $('#form-spareparts_dealer_opening_credits').jqxValidator('validate', validationResult);
        */
    });
});

function editSpareparts_dealer_opening_creditRecord(index){
    var row =  $("#jqxGridSpareparts_dealer_opening_credit").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#spareparts_dealer_opening_credits_id').val(row.id);
        $('#dealer_id').jqxComboBox('val', row.dealer_id);
		$('#opening_credit').jqxNumberInput('val', row.opening_credit);
        openPopupWindow('jqxPopupWindowSpareparts_dealer_opening_credit', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveSpareparts_dealer_opening_creditRecord(){
    var data = $("#form-spareparts_dealer_opening_credits").serialize();
	
	$('#jqxPopupWindowSpareparts_dealer_opening_credit').block({ 
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
        url: '<?php echo site_url("admin/spareparts_dealer_opening_credits/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_spareparts_dealer_opening_credits();
                $('#jqxGridSpareparts_dealer_opening_credit').jqxGrid('updatebounddata');
                $('#jqxPopupWindowSpareparts_dealer_opening_credit').jqxWindow('close');
            }
            $('#jqxPopupWindowSpareparts_dealer_opening_credit').unblock();
        }
    });
}

function reset_form_spareparts_dealer_opening_credits(){
	$('#spareparts_dealer_opening_credits_id').val('');
    $('#form-spareparts_dealer_opening_credits')[0].reset();
}
</script>