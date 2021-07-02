<!-- Main content -->
<section class="content">
	<!-- row -->
	<div class="row">
		<div class="col-xs-12 connectedSortable">
			<?php echo displayStatus(); ?>
			<div id='jqxGridReceiveToolbar' class='grid-toolbar'>
				<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridReceiveInsert"><?php echo lang('general_create'); ?></button> -->
				<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridReceiveFilterClear"><?php echo lang('general_clear'); ?></button>
			</div>
			<div id="jqxGridReceive"></div>
		</div><!-- /.col -->
	</div>
	<!-- /.row -->
</section><!-- /.content -->

<div id="jqxPopupWindowRecive">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title">Recive</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-recive', 'onsubmit' => 'return false')); ?>
        	<!-- <input type = "hidden" name = "id" id = "id"/> -->
            <table class="form-table">
				<input type="hidden" name="id" id="recive_form_id">
				<tr>
					<td><label for='stock_to'><?php echo lang('stockyard_from')?></label></td>
					<td><div id="recive_form_stockyard_from"></div></td>
				</tr>
				<tr>
					<td><label for='stock_to'><?php echo lang('dispatch_date_en')?></label></td>
					<td><div id="recive_form_dispatch_date_en"></div></td>
					<td><label for='stock_to'><?php echo lang('dispatch_date_np')?></label></td>
					<td><div id="recive_form_dispatch_date_np"></div></td>
				</tr>
				<tr>
					<td colspan="4"><div id="jqxGridReciveList"></div></td>
				</tr>
				
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxReciveSubmitButton">Accept</button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxReciveCancelButton"><?php echo lang('general_cancel'); ?></button>
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
		{ name: 'fullname', type: 'string' },
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
		displayMember: "fullname",
		valueMember: "user_id",
		checkboxes: true,
		multiSelect: true,
	});

	var stockyardsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'from_stockyard', type: 'string' },
			{ name: 'to_stockyard', type: 'string' },
			{ name: 'dispatch_date_en', type: 'date' },
			{ name: 'dispatch_date_np', type: 'string' },
			{ name: 'accepted_date_en', type: 'date' },
			{ name: 'accepted_date_np', type: 'string' },
			{ name: 'status', type: 'string' },
			
        ],
		url: '<?php echo site_url("sparepart_stocks/transfer/recive_json"); ?>',
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
	    	$("#jqxGridReceive").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridReceive").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridReceive").jqxGrid({
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
			container.append($('#jqxGridReceiveToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var r = '<a href="javascript:void(0)" onclick="editStockyardRecord(' + index + '); return false;" title="Recive"><i class="fa fa-edit"></i></a>';
					// var u = '<a href="javascript:void(0)" onclick="add_users(' + index + '); return false;" title="Add Users"><i class="fa fa-users"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + r + '</div>';
					// return '<div style="text-align: center; margin-top: 8px;">' + e + ' | ' + u + '</div>';
				}
			},
			{ text: '<?php echo lang("stockyard_to"); ?>',datafield: 'to_stockyard',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatch_date_en"); ?>',datafield: 'dispatch_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("dispatch_date_np"); ?>',datafield: 'dispatch_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("accepted_date_en"); ?>',datafield: 'accepted_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("accepted_date_np"); ?>',datafield: 'accepted_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridReceive").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridReceiveFilterClear', function () { 
		$('#jqxGridReceive').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridReceiveInsert', function () { 
		openPopupWindow('jqxPopupWindowRecive', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowRecive").jqxWindow({ 
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

    $("#jqxPopupWindowRecive").on('close', function () {
        reset_form_stockyards();
    });

    $("#jqxReciveCancelButton").on('click', function () {
        reset_form_stockyards();
        $('#jqxPopupWindowRecive').jqxWindow('close');
    });

    $("#jqxReciveSubmitButton").on('click', function () {
        saveStockyardRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveStockyardRecord();
                }
            };
        $('#form-recive').jqxValidator('validate', validationResult);
        */
    });

    
});

function editStockyardRecord(index){
    var row =  $("#jqxGridReceive").jqxGrid('getrowdata', index);
  	if (row) {
		$('#recive_form_stockyard_from').html(row.from_stockyard);
		$('#recive_form_dispatch_date_np').html(row.dispatch_date_np);
		$('#recive_form_dispatch_date_en').html(row.dispatch_date_en);
		$('#dispatched_date').html(row.dispatched_date);
		$('#recive_form_id').val(row.id);

		// -----------------------------------
		var recent_dispatchDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'transfer_id', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'return_qty', type: 'number' },
			{ name: 'accepted_quantity', type: 'number' },
			{ name: 'name', type: 'string' },
			// { name: 'available', type: 'bool' },
			],
			url: '<?php echo site_url("sparepart_stocks/transfer/get_recent_dispatch_list")?>',
			data: {id : row.id},
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
	        	//callback called when a page or page size is changed.
	        },
	        beforeprocessing: function (data) {
	        	recent_dispatchDataSource.totalrecords = data.total;
	        },
		    // update the grid and send a request to the server.
		    filter: function () {
		    	$("#jqxGridReciveList").jqxGrid('updatebounddata', 'filter');
		    },
		    // update the grid and send a request to the server.
		    sort: function () {
		    	$("#jqxGridReciveList").jqxGrid('updatebounddata', 'sort');
		    },
		    processdata: function(data) {
		    }
		};

		$("#jqxGridReciveList").jqxGrid({
			theme: theme,
			width: '100%',
			height: 500,
			source: recent_dispatchDataSource,
			altrows: true,
			pageable: true,
			sortable: true,
			rowsheight: 30,
			columnsheight:30,
			showfilterrow: false,
			filterable: true,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			selectionmode: 'none',
			editable: true,
			virtualmode: true,
			enableanimations: false,
			pagesizeoptions: pagesizeoptions,
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				// var container = $("<div style='margin: 5px; height:50px'></div>");
				// container.append($('#jqxReceived_orderlistToolbar').html());
				// toolbar.append(container);
			},
			columns: [
			// { text: 'Available', datafield: 'available', columntype: 'checkbox', width: 70, filterable: false },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',editable: false,width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("id"); ?>',datafield: 'id',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("sparepart_id"); ?>',datafield: 'sparepart_id',hidden:true,editable: false, width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("accepted_quantity"); ?>',datafield: 'accepted_quantity',editable: true,width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("return_quantity"); ?>',datafield: 'return_qty',editable: true,width: 150,filterable: true,renderer: gridColumnsRenderer },
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

        openPopupWindow('jqxPopupWindowRecive', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveStockyardRecord(){
    // var data = $("#form-recive").serialize();
    var rows = $('#jqxGridReciveList').jqxGrid('getrows');
    var transfer_id = $('#recive_form_id').val();
	
	$('#jqxPopupWindowRecive').block({ 
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
        url: '<?php echo site_url("sparepart_stocks/transfer/accept_stock"); ?>',
        data: {transfer_id:transfer_id, rows:rows},
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                // reset_form_stockyards();
                $('#jqxGridReceive').jqxGrid('updatebounddata');
                $('#jqxPopupWindowRecive').jqxWindow('close');
            }
            $('#jqxPopupWindowRecive').unblock();
        }
    });
}

function reset_form_stockyards(){
	$('#stockyards_id').val('');
    $('#form-recive')[0].reset();
}

</script>