<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('spareparts_dealer_claims'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('spareparts_dealer_claims'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridSpareparts_dealer_claimToolbar' class='grid-toolbar'>
					<!-- <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridSpareparts_dealer_claimInsert"><?php echo lang('general_create'); ?></button> -->
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridSpareparts_dealer_claimFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridSpareparts_dealer_claim"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowSpareparts_dealer_claim">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-spareparts_dealer_claims', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "spareparts_dealer_claims_id"/>
            <table class="form-table">
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_name')?></label></td>
					<td><input id='dealer_name' class='text_input' name='dealer_name' readonly="readonly"></td>
				</tr>
				<tr>
					<td><label for='part_name'><?php echo lang('part_name')?></label></td>
					<td><input id='part_name' class='text_input' name='part_name' readonly="readonly"></td>
				</tr>
				<tr>
					<td><label for='latest_part_code'><?php echo lang('latest_part_code')?></label></td>
					<td><input id='latest_part_code' class='text_input' name='latest_part_code' readonly="readonly"></td>
				</tr>
				<tr>
					<td><label for='requested_date'><?php echo lang('requested_date')?></label></td>
					<td><input id='requested_date' class='text_input' name='requested_date' readonly="readonly"></td>
				</tr>
				<tr>
					<td><label for='defecit_quantity'><?php echo lang('defecit_quantity')?></label></td>
					<td><input id='defecit_quantity' class='text_input' name='defecit_quantity' readonly="readonly"></td>
				</tr>
				<tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSpareparts_dealer_claimSubmitButton" value="1"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSpareparts_dealer_claimCancelButton" value="2"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var spareparts_dealer_claimsDataSource =
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
			{ name: 'sparepart_id', type: 'number' },
			{ name: 'requested_by', type: 'number' },
			{ name: 'requested_date', type: 'date' },
			{ name: 'requested_date_np', type: 'number' },
			{ name: 'defecit_quantity', type: 'number' },
			{ name: 'latest_part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/spareparts_dealer_claims/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	spareparts_dealer_claimsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSpareparts_dealer_claim").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSpareparts_dealer_claim").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSpareparts_dealer_claim").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: spareparts_dealer_claimsDataSource,
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
			container.append($('#jqxGridSpareparts_dealer_claimToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="claim_approved(' + index + '); return false;" title="Claim Status"><i class="fa fa-check"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("latest_part_code"); ?>',datafield: 'latest_part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("requested_by"); ?>',datafield: 'requested_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("requested_date"); ?>',datafield: 'requested_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("defecit_quantity"); ?>',datafield: 'defecit_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridSpareparts_dealer_claim").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSpareparts_dealer_claimFilterClear', function () { 
		$('#jqxGridSpareparts_dealer_claim').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridSpareparts_dealer_claimInsert', function () { 
		openPopupWindow('jqxPopupWindowSpareparts_dealer_claim', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowSpareparts_dealer_claim").jqxWindow({ 
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

    $("#jqxPopupWindowSpareparts_dealer_claim").on('close', function () {
        reset_form_spareparts_dealer_claims();
    });

    $("#jqxSpareparts_dealer_claimCancelButton").on('click', function () {
    	var status = $(this).val();
        saveSpareparts_dealer_claimRecord(status);
    });

    
    $("#jqxSpareparts_dealer_claimSubmitButton").on('click', function () {
        var status = $(this).val();
        saveSpareparts_dealer_claimRecord(status);
    });
});

function claim_approved(index){
    var row =  $("#jqxGridSpareparts_dealer_claim").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#spareparts_dealer_claims_id').val(row.id);
		$('#dealer_name').val(row.dealer_name);
		$('#part_name').val(row.part_name);
		$('#latest_part_code').val(row.latest_part_code);
		$('#requested_date').val(row.requested_date);
		$('#defecit_quantity').val(row.defecit_quantity);
		
        openPopupWindow('jqxPopupWindowSpareparts_dealer_claim', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveSpareparts_dealer_claimRecord(status){
    var data = $("#form-spareparts_dealer_claims").serialize();
	
	$('#jqxPopupWindowSpareparts_dealer_claim').block({ 
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
        url: '<?php echo site_url("admin/spareparts_dealer_claims/save_approve"); ?>/'+status,
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_spareparts_dealer_claims();
                $('#jqxGridSpareparts_dealer_claim').jqxGrid('updatebounddata');
                $('#jqxPopupWindowSpareparts_dealer_claim').jqxWindow('close');
            }
            $('#jqxPopupWindowSpareparts_dealer_claim').unblock();
        }
    });
}

function reset_form_spareparts_dealer_claims(){
	$('#spareparts_dealer_claims_id').val('');
    $('#form-spareparts_dealer_claims')[0].reset();
}
</script>