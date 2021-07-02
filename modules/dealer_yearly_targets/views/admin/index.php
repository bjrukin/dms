<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_yearly_targets'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('dealer_yearly_targets'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDealer_yearly_targetToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_yearly_targetInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDealer_yearly_targetFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDealer_yearly_target"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDealer_yearly_target">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-dealer_yearly_targets', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "dealer_yearly_targets_id"/>
            <table class="form-table">
				<tr>
					<td><label for='dealer'><?php echo lang('dealer')?></label></td>
					<td><div id='dealer_id' name='dealer_id'></div></td>
				</tr>
				<tr>
					<td><label for='year'><?php echo lang('year')?></label></td>
					<td><input id='year' class='text_input' name='year'></td>
				</tr>
				<tr>
					<td><label for='month'><?php echo lang('month')?></label></td>
					<td><div id="month" name="month"></div></td>
				</tr>
				<tr>
					<td><label for='target'><?php echo lang('target')?></label></td>
					<td><input id='target' class='text_input' name='target'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealer_yearly_targetSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDealer_yearly_targetCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
		var dealerDataSource = {
            url: '<?php echo site_url("admin/dealer_yearly_targets/get_spareparts_dealers_combo_json"); ?>',
            datatype: 'json',
            datafields: [
            {name: 'id', type: 'number'},
            {name: 'name', type: 'string'},
            ]
        };

        dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

        $("#dealer_id").jqxComboBox({ 
            source: dealerDataAdapter, 
            selectedIndex: 0, 
            width: '200px', 
            height: '25px',
            placeHolder:'Select Dealer',
            displayMember: "name",
            valueMember: "id",

        });
        var monthDataSource = {
            url: '<?php echo site_url("admin/dealer_yearly_targets/get_nepali_month_list"); ?>',
            datatype: 'json',
            datafields: [
            {name: 'id', type: 'number'},
            {name: 'name', type: 'string'},
            ]
        };

        monthDataAdapter = new $.jqx.dataAdapter(monthDataSource);

        $("#month").jqxComboBox({ 
            source: monthDataAdapter, 
            selectedIndex: 0, 
            width: '200px', 
            height: '25px',
            placeHolder:'Select Dealer',
            displayMember: "name",
            valueMember: "id",

        });

	var dealer_yearly_targetsDataSource =
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
			{ name: 'year', type: 'string' },
			{ name: 'nepali_month', type: 'string' },
			{ name: 'target', type: 'number' },
			{ name: 'month', type: 'number' },
			{ name: 'dealer_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/dealer_yearly_targets/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_yearly_targetsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDealer_yearly_target").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDealer_yearly_target").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDealer_yearly_target").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dealer_yearly_targetsDataSource,
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
			container.append($('#jqxGridDealer_yearly_targetToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editDealer_yearly_targetRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("dealer"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("month"); ?>',datafield: 'nepali_month',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("target"); ?>',datafield: 'target',width: 150,filterable: true, cellsformat:'F2', renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDealer_yearly_target").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDealer_yearly_targetFilterClear', function () { 
		$('#jqxGridDealer_yearly_target').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDealer_yearly_targetInsert', function () { 
		openPopupWindow('jqxPopupWindowDealer_yearly_target', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowDealer_yearly_target").jqxWindow({ 
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

    $("#jqxPopupWindowDealer_yearly_target").on('close', function () {
        reset_form_dealer_yearly_targets();
    });

    $("#jqxDealer_yearly_targetCancelButton").on('click', function () {
        reset_form_dealer_yearly_targets();
        $('#jqxPopupWindowDealer_yearly_target').jqxWindow('close');
    });

    /*$('#form-dealer_yearly_targets').jqxValidator({
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

			{ input: '#year', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#year').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#target', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#target').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxDealer_yearly_targetSubmitButton").on('click', function () {
        saveDealer_yearly_targetRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveDealer_yearly_targetRecord();
                }
            };
        $('#form-dealer_yearly_targets').jqxValidator('validate', validationResult);
        */
    });
});

function editDealer_yearly_targetRecord(index){
    var row =  $("#jqxGridDealer_yearly_target").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#dealer_yearly_targets_id').val(row.id);       
		$('#dealer_id').jqxComboBox('val', row.dealer_id);
		$('#month').jqxComboBox('val', row.month);
		$('#year').val(row.year);
		$('#target').val(row.target);
		
        openPopupWindow('jqxPopupWindowDealer_yearly_target', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveDealer_yearly_targetRecord(){
    var data = $("#form-dealer_yearly_targets").serialize();
	
	$('#jqxPopupWindowDealer_yearly_target').block({ 
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
        url: '<?php echo site_url("admin/dealer_yearly_targets/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_dealer_yearly_targets();
                $('#jqxGridDealer_yearly_target').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDealer_yearly_target').jqxWindow('close');
            }
            $('#jqxPopupWindowDealer_yearly_target').unblock();
        }
    });
}

function reset_form_dealer_yearly_targets(){
	$('#dealer_yearly_targets_id').val('');
    $('#form-dealer_yearly_targets')[0].reset();
}
</script>